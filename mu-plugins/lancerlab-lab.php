<?php
/**
 * Plugin Name: LancerLab Interactive Lab (Telemetry, AI Architect, Pipeline Diagrams, n8n Draft API)
 */

// LL_INTERNAL_SECRET is defined outside git inside wp-config.php.
if (!function_exists('ll_sec_guard_public_post')) {
    function ll_sec_guard_public_post($scope, $ip_max, $global_max, $window_secs) {
        if (trim((string)($_SERVER['HTTP_USER_AGENT'] ?? '')) === '') {
            return new WP_REST_Response(['ok' => false, 'error' => 'Forbidden'], 403);
        }
        $origin = trim((string)($_SERVER['HTTP_ORIGIN'] ?? ''));
        if ($origin !== '') {
            $site_host = parse_url(home_url(), PHP_URL_HOST);
            $orig_host = parse_url($origin, PHP_URL_HOST);
            if ($site_host && $orig_host && strcasecmp($site_host, $orig_host) !== 0) {
                return new WP_REST_Response(['ok' => false, 'error' => 'Invalid origin'], 403);
            }
        }
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $ip_key = 'll_rl_' . $scope . '_' . md5($ip);
        $gl_key = 'll_rl_' . $scope . '_global';
        $ip_cnt = (int) get_transient($ip_key);
        $gl_cnt = (int) get_transient($gl_key);
        if ($ip_cnt >= $ip_max || $gl_cnt >= $global_max) {
            return new WP_REST_Response(['ok' => false, 'error' => 'Rate limit reached.'], 429);
        }
        set_transient($ip_key, $ip_cnt + 1, $window_secs);
        set_transient($gl_key, $gl_cnt + 1, $window_secs);
        return null;
    }
}

add_action('rest_api_init', function () {
    // 1. Live Lab Telemetry (cached 10s)
    register_rest_route('lancerlab/v1', '/lab/telemetry', [
        'methods'             => 'GET',
        'permission_callback' => '__return_true',
        'callback'            => function () {
            $cached = get_transient('ll_lab_telemetry');
            if ($cached !== false) return new WP_REST_Response($cached, 200);

            $uptime_raw = @file_get_contents('/proc/uptime');
            $up_secs = $uptime_raw ? (int)explode(' ', trim($uptime_raw))[0] : 0;
            $up_days = floor($up_secs / 86400);
            $up_hrs  = floor(($up_secs % 86400) / 3600);
            $load = function_exists('sys_getloadavg') ? sys_getloadavg() : [0, 0, 0];
            $cores = max(1, (int)@shell_exec('nproc 2>/dev/null') ?: 2);
            $cpu_pct = min(100, max(1, round(((float)$load[0] / $cores) * 100, 1)));

            $n8n_resp = wp_remote_get('http://127.0.0.1:5678/healthz', ['timeout' => 1.0]);
            $n8n_ok = (!is_wp_error($n8n_resp) && wp_remote_retrieve_response_code($n8n_resp) === 200);

            $gpu_resp = wp_remote_get('http://192.168.1.63:8020/api/telemetry', ['timeout' => 1.5]);
            $gpu_data = null;
            if (!is_wp_error($gpu_resp) && wp_remote_retrieve_response_code($gpu_resp) === 200) {
                $gpu_data = json_decode(wp_remote_retrieve_body($gpu_resp), true);
            }

            $vu = (int)preg_replace('/\D+/', '', $gpu_data['gpu']['vram_used'] ?? '0');
            $vt = max(1, (int)preg_replace('/\D+/', '', $gpu_data['gpu']['vram_total'] ?? '24576'));
            $gp = (int)preg_replace('/\D+/', '', $gpu_data['gpu']['utilization'] ?? '0');

            $out = [
                'control_plane' => [
                    'online'  => true,
                    'uptime'  => "{$up_days}d {$up_hrs}h",
                    'load'    => round((float)$load[0], 2),
                    'cpu_pct' => $cpu_pct,
                    'n8n'     => $n8n_ok,
                ],
                'worker_plane' => $gpu_data ? [
                    'online'    => true,
                    'gpu_name'  => $gpu_data['gpu']['name'] ?? 'RTX 3090',
                    'temp'      => $gpu_data['gpu']['temp'] ?? '—',
                    'util'      => $gpu_data['gpu']['utilization'] ?? '—',
                    'gpu_pct'   => min(100, $gp),
                    'vram_pct'  => min(100, round(($vu / $vt) * 100, 1)),
                    'vram_used' => $gpu_data['gpu']['vram_used'] ?? '—',
                    'vram_tot'  => $gpu_data['gpu']['vram_total'] ?? '24576 MiB',
                    'lm_studio' => !empty($gpu_data['lm_studio']),
                ] : ['online' => false, 'gpu_pct' => 0, 'vram_pct' => 0],
            ];
            set_transient('ll_lab_telemetry', $out, 3);
            return new WP_REST_Response($out, 200);
        },
    ]);

    // 2. AI Automation Architect
    register_rest_route('lancerlab/v1', '/lab/architect', [
        'methods'             => 'POST',
        'permission_callback' => '__return_true',
        'callback'            => function (WP_REST_Request $req) {
            $guard = ll_sec_guard_public_post('arch', 10, 45, 600);
            if ($guard instanceof WP_REST_Response) return $guard;

            $params = $req->get_json_params();
            $task = sanitize_textarea_field(mb_substr($params['task'] ?? '', 0, 600));
            $lang = sanitize_text_field($params['lang'] ?? 'uk');
            if ($task === '') {
                return new WP_REST_Response(['ok' => false, 'error' => 'Empty task'], 400);
            }
            $lang_inst = $lang === 'uk' ? 'Відповідай українською мовою.' : ($lang === 'en' ? 'Reply in English.' : 'Отвечай на русском языке.');
            $sys = "Ты системный архитектор по AI-автоматизации (стек: n8n, LLM, API, Webhooks, Telegram, CRM). {$lang_inst}\n"
                 . "Разложи задачу клиента на практичную архитектуру из 4 коротких блоков:\n"
                 . "1) Триггер и входные данные\n2) Цепочка нод в n8n + LLM/API\n3) Обработка ошибок и фолбек\n4) Оценка экономии времени (часов/мес).\n"
                 . "Пиши чётко, структурно, без воды, до 180 слов.";

            $resp = wp_remote_post('http://192.168.1.63:1234/v1/chat/completions', [
                'timeout' => 45,
                'headers' => ['Content-Type' => 'application/json'],
                'body'    => wp_json_encode([
                    'model'       => 'mistral-small-24b-instruct-2501',
                    'messages'    => [['role' => 'system', 'content' => $sys], ['role' => 'user', 'content' => $task]],
                    'temperature' => 0.4,
                    'max_tokens'  => 480,
                ]),
            ]);
            if (is_wp_error($resp) || wp_remote_retrieve_response_code($resp) !== 200) {
                return new WP_REST_Response(['ok' => false, 'error' => 'RTX 3090 LLM offline'], 503);
            }
            $d = json_decode(wp_remote_retrieve_body($resp), true);
            $plan = trim($d['choices'][0]['message']['content'] ?? '');
            return new WP_REST_Response(['ok' => true, 'plan' => $plan], 200);
        },
    ]);

    // 3. Internal n8n -> WordPress Draft/Post endpoint
    register_rest_route('lancerlab/v1', '/internal/draft', [
        'methods'             => 'POST',
        'permission_callback' => '__return_true',
        'callback'            => function (WP_REST_Request $req) {
            $provided = (string) $req->get_header('X-LancerLab-Secret');
            if (!defined('LL_INTERNAL_SECRET') || LL_INTERNAL_SECRET === '' || !hash_equals((string) LL_INTERNAL_SECRET, $provided)) {
                return new WP_REST_Response(['ok' => false, 'error' => 'Forbidden'], 403);
            }
            $p = $req->get_json_params();
            $title   = sanitize_text_field($p['title'] ?? 'Заметка из Telegram');
            $content = wp_kses_post($p['content'] ?? '');
            $status  = in_array($p['status'] ?? 'draft', ['draft', 'publish'], true) ? $p['status'] : 'draft';
            $cat_slug = sanitize_title($p['category'] ?? 'ai-automation');
            $term = get_term_by('slug', $cat_slug, 'category');
            $cat_id = $term ? (int)$term->term_id : 1;

            $id = wp_insert_post([
                'post_title'    => $title,
                'post_content'  => $content,
                'post_status'   => $status,
                'post_type'     => 'post',
                'post_author'   => 1,
                'post_category' => [$cat_id],
            ]);
            return new WP_REST_Response(['ok' => true, 'id' => $id, 'url' => get_permalink($id)], 200);
        },
    ]);
});

// Shortcode 1: Live Lab Monitor
add_shortcode('lancerlab_live_monitor', function () {
    $lang = function_exists('ll_detect_lang') ? ll_detect_lang() : 'uk';
    $lbl = [
        'uk' => ['title' => '⚡ Live Lab Monitor — домашня інфраструктура в реальному часі', 'cp' => 'Control Plane (Ubuntu)', 'wp' => 'Worker Plane (RTX 3090)', 'loading' => 'Опитування вузлів...'],
        'ru' => ['title' => '⚡ Live Lab Monitor — домашняя инфраструктура в реальном времени', 'cp' => 'Control Plane (Ubuntu)', 'wp' => 'Worker Plane (RTX 3090)', 'loading' => 'Опрос узлов...'],
        'en' => ['title' => '⚡ Live Lab Monitor — Home Infrastructure Live Status', 'cp' => 'Control Plane (Ubuntu)', 'wp' => 'Worker Plane (RTX 3090)', 'loading' => 'Polling nodes...'],
    ][$lang];
    ob_start();
    ?>
    <div class="alignwide ll-card ll-lab-bar" style="margin-bottom:2rem;padding:1.1rem 1.35rem;">
      <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:0.5rem;margin-bottom:0.75rem;">
        <strong style="font-size:0.95rem;color:var(--ll-dark);"><?php echo esc_html($lbl['title']); ?></strong>
        <button type="button" id="ll-lab-refresh" class="ll-theme-btn" style="font-size:0.75rem;">↻</button>
      </div>
      <div id="ll-lab-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:0.75rem;font-size:0.88rem;">
        <div class="ll-stat-box" style="padding:0.75rem 1rem;"><span class="ll-stat-label"><?php echo esc_html($lbl['cp']); ?></span><strong id="ll-cp-val"><?php echo esc_html($lbl['loading']); ?></strong></div>
        <div class="ll-stat-box" style="padding:0.75rem 1rem;"><span class="ll-stat-label"><?php echo esc_html($lbl['wp']); ?></span><strong id="ll-wp-val"><?php echo esc_html($lbl['loading']); ?></strong></div>
      </div>
    </div>
    <?php
    $GLOBALS['ll_lab_monitor_js'] = true;
    return ob_get_clean();
});

// Shortcode 2: Interactive Pipeline Diagrams
add_shortcode('lancerlab_pipeline_diagrams', function () {
    $lang = function_exists('ll_detect_lang') ? ll_detect_lang() : 'uk';
    $title1 = $lang === 'uk' ? 'Інтерактивна схема 1: Автономна відеофабрика (натисніть на вузол)' : ($lang === 'en' ? 'Interactive Diagram 1: Autonomous Video Factory (click any node)' : 'Интерактивная схема 1: Автономная видеофабрика (нажмите на узел)');
    $nodes1 = [
        ['id' => 'tg', 'label' => '1. Telegram Bot', 'uk' => 'Приймає ідею діалогом, зберігає контекст у пам’яті та запускає генерацію.', 'ru' => 'Принимает идею в диалоге, хранит контекст и запускает генерацию.', 'en' => 'Collects prompt ideas via chat and triggers the pipeline.'],
        ['id' => 'n8n', 'label' => '2. n8n (Ubuntu)', 'uk' => 'Оркестратор у Docker: каскадний фолбек LLM, черги та логи помилок.', 'ru' => 'Оркестратор в Docker: каскадный фолбек LLM, очереди и логи ошибок.', 'en' => 'Docker orchestrator handling LLM fallbacks, queues, and error logs.'],
        ['id' => 'wol', 'label' => '3. Keenetic WoL', 'uk' => 'Через RCI API роутера будить стаціонар RTX 3090 з глибокого сну.', 'ru' => 'Через RCI API роутера будит стационар RTX 3090 из гибернации.', 'en' => 'Wakes the RTX 3090 workstation via Keenetic router API.'],
        ['id' => 'comfy', 'label' => '4. ComfyUI (:8188)', 'uk' => 'Рендерить сцени на RTX 3090 із передачею останнього кадру в наступну сцену.', 'ru' => 'Рендерит сцены на RTX 3090 с передачей последнего кадра в следующую.', 'en' => 'Renders scenes on RTX 3090 with Frame-to-Frame Continuity.'],
        ['id' => 'ffmpeg', 'label' => '5. FFmpeg', 'uk' => 'Склеює фінальний ролик, накладає звук і віддає у Telegram.', 'ru' => 'Склеивает финальный ролик, накладывает звук и отправляет в Telegram.', 'en' => 'Stitches final clips + audio and delivers to Telegram.'],
    ];

    $title2 = $lang === 'uk' ? 'Інтерактивна схема 2: Оркестрація Cloud Architect ↔ Local RTX 3090 (Guardrails 24B–32B)' : ($lang === 'en' ? 'Interactive Diagram 2: Cloud Architect ↔ Local RTX 3090 Orchestration (24B–32B Guardrails)' : 'Интерактивная схема 2: Оркестрация Cloud Architect ↔ Local RTX 3090 (Guardrails 24B–32B)');
    $nodes2 = [
        ['id' => 'arch', 'label' => '1. Cloud Architect', 'uk' => 'Хмарний агент вирішує архітектуру, багатофайловий рефакторинг та складне налагодження, розбиваючи рутину на атомарні мікро-задачі.', 'ru' => 'Облачный агент решает архитектуру, многофайловый рефакторинг и сложную отладку, нарезая рутину на атомарные микро-задачи.', 'en' => 'Cloud agent handles high-level architecture, multi-file refactoring, and complex debugging, splitting bulk work into atomic micro-tasks.'],
        ['id' => 'guard', 'label' => '2. CLI Guardrails (<4k / SRP)', 'uk' => 'delegate_task.py (--timeout 60) та manage_oi.py: промпт суворо < 4,000 токенів (після 8,000 падає увага), принцип SRP (1 задача = 1 ціль), батчі ≤ 15 елементів.', 'ru' => 'delegate_task.py (--timeout 60) и manage_oi.py: промпт строго < 4,000 токенов (после 8,000 падает внимание), принцип SRP (1 задача = 1 цель), батчи ≤ 15 элементов.', 'en' => 'delegate_task.py (--timeout 60) & manage_oi.py: strict < 4,000 token prompt cap, Single Responsibility (1 task = 1 goal), and batches ≤ 15 items.'],
        ['id' => 'local', 'label' => '3. RTX 3090 (24B–32B)', 'uk' => 'Локальний інференс за $0/токен: LM Studio (mistral-small-24b-instruct-2501 :1234), Ollama (qwen2.5-coder:32b :11434) та Open Interpreter v0.4.3 в обхід інтерактивного REPL.', 'ru' => 'Локальный инференс за $0/токен: LM Studio (mistral-small-24b-instruct-2501 :1234), Ollama (qwen2.5-coder:32b :11434) и Open Interpreter v0.4.3 в обход интерактивного REPL.', 'en' => '$0/token local inference on RTX 3090: LM Studio (mistral-small-24b :1234), Ollama (qwen2.5-coder:32b :11434), and Open Interpreter v0.4.3 bypassing REPL.'],
        ['id' => 'skills', 'label' => '4. Local Skills & MCP', 'uk' => 'Кастомні скіли: starsector-translator (збереження тегів $faction, %s, ##green##), starsector-db-query (SQLite starsector.db), log-summarizer + MCP (sequential-thinking, sqlite, memory).', 'ru' => 'Кастомные скиллы: starsector-translator (сохранение тегов $faction, %s, ##green##), starsector-db-query (SQLite starsector.db), log-summarizer + MCP (sequential-thinking, sqlite, memory).', 'en' => 'Custom local skills: starsector-translator (preserving $faction, %s, ##green## tags), starsector-db-query (SQLite), log-summarizer + MCP tools.'],
        ['id' => 'val', 'label' => '5. Validation & Fallback', 'uk' => 'Пост-валідація батчів на дублікати й цілісність тегів; у продакшені (GramJS User-Bot + F5-TTS :8020) — миттєвий фолбек Local RTX 3090 ⇄ Cloud API при блекаутах.', 'ru' => 'Пост-валидация батчей на дубликаты и целостность тегов; в продакшене (GramJS User-Bot + F5-TTS :8020) — мгновенный фолбек Local RTX 3090 ⇄ Cloud API при блэкаутах.', 'en' => 'Batch post-validation for duplicates & tag integrity; in production (GramJS User-Bot + F5-TTS :8020) — instant Local RTX 3090 ⇄ Cloud API fallback.'],
    ];
    ob_start();
    ?>
    <div class="alignwide ll-card ll-pipe-card" style="margin-bottom:1.25rem;">
      <h3 style="margin-top:0;"><?php echo esc_html($title1); ?></h3>
      <div class="ll-pipe-row">
        <?php foreach ($nodes1 as $idx => $n): ?>
          <button type="button" class="ll-pipe-node<?php echo $idx === 0 ? ' active' : ''; ?>" data-desc="<?php echo esc_attr($n[$lang]); ?>"><?php echo esc_html($n['label']); ?></button>
          <?php if ($idx < count($nodes1) - 1): ?><span class="ll-pipe-arrow">→</span><?php endif; ?>
        <?php endforeach; ?>
      </div>
      <div id="ll-pipe-detail" class="ll-pipe-detail-box" style="margin-top:0.9rem;padding:0.85rem 1rem;border-radius:10px;background:var(--ll-bg);border:1px solid var(--ll-border);font-size:0.94rem;color:var(--ll-dark);">
        <?php echo esc_html($nodes1[0][$lang]); ?>
      </div>
    </div>

    <div class="alignwide ll-card ll-pipe-card" style="margin-bottom:1.75rem;">
      <h3 style="margin-top:0;"><?php echo esc_html($title2); ?></h3>
      <div class="ll-pipe-row">
        <?php foreach ($nodes2 as $idx => $n): ?>
          <button type="button" class="ll-pipe-node<?php echo $idx === 0 ? ' active' : ''; ?>" data-desc="<?php echo esc_attr($n[$lang]); ?>"><?php echo esc_html($n['label']); ?></button>
          <?php if ($idx < count($nodes2) - 1): ?><span class="ll-pipe-arrow">→</span><?php endif; ?>
        <?php endforeach; ?>
      </div>
      <div id="ll-pipe-detail-2" class="ll-pipe-detail-box" style="margin-top:0.9rem;padding:0.85rem 1rem;border-radius:10px;background:var(--ll-bg);border:1px solid var(--ll-border);font-size:0.94rem;color:var(--ll-dark);">
        <?php echo esc_html($nodes2[0][$lang]); ?>
      </div>
    </div>
    <style>
      .ll-pipe-row { display:flex; flex-wrap:wrap; align-items:center; gap:0.45rem; }
      .ll-pipe-node { padding:0.5rem 0.85rem; border-radius:10px; border:1px solid var(--ll-border); background:var(--ll-bg); color:var(--ll-dark); font-weight:600; font-size:0.85rem; cursor:pointer; }
      .ll-pipe-node.active, .ll-pipe-node:hover { background:var(--ll-accent); color:#fff; border-color:var(--ll-accent); }
      html[data-theme="dark"] .ll-pipe-node.active { color:#0b0f19; }
      .ll-pipe-arrow { color:var(--ll-muted); font-weight:700; }
    </style>
    <?php
    $GLOBALS['ll_pipe_js'] = true;
    return ob_get_clean();
});

// Shortcode 3: AI Automation Architect
add_shortcode('lancerlab_ai_architect', function () {
    $lang = function_exists('ll_detect_lang') ? ll_detect_lang() : 'uk';
    $t = [
        'uk' => [
            'title' => '🧠 AI-архітектор автоматизації (Демо на RTX 3090)',
            'sub'   => 'Опишіть рутинне завдання — локальна Mistral 24B розкладе його на архітектуру в n8n та оцінить економію часу.',
            'ph'    => 'Наприклад: щодня вручну переношу заявки з Telegram у Google Sheets і відповідаю на типові питання...',
            'btn'   => '⚙️ Спроєктувати пайплайн',
            'send'  => '📩 Надіслати цей бриф Іллі в Telegram',
            'ex'    => ['Заявки з Telegram → CRM', 'Автопостинг відео у соцмережі', 'AI-асистент підтримки 24/7'],
        ],
        'ru' => [
            'title' => '🧠 AI-архитектор автоматизации (Демо на RTX 3090)',
            'sub'   => 'Опишите рутинную задачу — локальная Mistral 24B разложит её на архитектуру в n8n и оценит экономию времени.',
            'ph'    => 'Например: каждый день вручную переношу заявки из Telegram в Google Sheets и отвечаю на типовые вопросы...',
            'btn'   => '⚙️ Спроектировать пайплайн',
            'send'  => '📩 Отправить этот бриф Илье в Telegram',
            'ex'    => ['Заявки из Telegram → CRM', 'Автопостинг видео в соцсети', 'AI-ассистент поддержки 24/7'],
        ],
        'en' => [
            'title' => '🧠 AI Automation Architect (Live on RTX 3090)',
            'sub'   => 'Describe a routine workflow — my local Mistral 24B will design an n8n architecture and estimate time saved.',
            'ph'    => 'E.g., manually copying leads from Telegram into CRM and answering repetitive client questions...',
            'btn'   => '⚙️ Design Pipeline',
            'send'  => '📩 Send this brief to Illya on Telegram',
            'ex'    => ['Telegram Leads → CRM', 'Automated Video Social Farm', '24/7 AI Support Assistant'],
        ],
    ][$lang];
    ob_start();
    ?>
    <div class="alignwide ll-card" style="margin-bottom:2rem;">
      <h2 style="margin-top:0;"><?php echo esc_html($t['title']); ?></h2>
      <p style="margin-top:0;"><?php echo esc_html($t['sub']); ?></p>
      <div style="display:flex;flex-wrap:wrap;gap:0.4rem;margin-bottom:0.75rem;">
        <?php foreach ($t['ex'] as $ex): ?>
          <button type="button" class="ll-cat-pill ll-arch-ex" style="cursor:pointer;"><?php echo esc_html($ex); ?></button>
        <?php endforeach; ?>
      </div>
      <form id="ll-arch-form" style="display:flex;flex-direction:column;gap:0.7rem;">
        <textarea id="ll-arch-input" rows="2" required maxlength="600" placeholder="<?php echo esc_attr($t['ph']); ?>" style="width:100%;box-sizing:border-box;padding:0.75rem;border-radius:10px;border:1px solid var(--ll-border);background:var(--ll-bg);color:var(--ll-dark);font-family:inherit;"></textarea>
        <div style="display:flex;flex-wrap:wrap;gap:0.6rem;align-items:center;">
          <button type="submit" id="ll-arch-btn" class="ll-cf-btn"><?php echo esc_html($t['btn']); ?></button>
          <button type="button" id="ll-arch-send" class="ll-theme-btn" style="display:none;padding:0.7rem 1rem;border-radius:10px;"><?php echo esc_html($t['send']); ?></button>
        </div>
      </form>
      <pre id="ll-arch-out" style="display:none;margin-top:1rem;white-space:pre-wrap;background:var(--ll-bg);color:var(--ll-dark);padding:1rem;border-radius:12px;border:1px solid var(--ll-border);font-family:inherit;line-height:1.55;"></pre>
    </div>
    <?php
    $GLOBALS['ll_arch_js'] = $lang;
    return ob_get_clean();
});

add_action('wp_footer', function () {
    if (!empty($GLOBALS['ll_lab_monitor_js']) || is_front_page()) {
        ?>
        <script data-ll-pjax="lab-mon">
        (function() {
          function loadTel() {
            fetch('/wp-json/lancerlab/v1/lab/telemetry')
              .then(function(r) { return r.json(); })
              .then(function(d) {
                var cp = document.getElementById('ll-cp-val');
                var wp = document.getElementById('ll-wp-val');
                if (cp && d.control_plane) {
                  cp.textContent = '🟢 Online • up ' + d.control_plane.uptime + ' • load ' + d.control_plane.load + ' • n8n ' + (d.control_plane.n8n ? 'OK' : '—');
                }
                if (wp) {
                  if (d.worker_plane && d.worker_plane.online) {
                    wp.textContent = '🟢 ' + d.worker_plane.temp + ' • VRAM ' + d.worker_plane.vram_used + ' • LM Studio ' + (d.worker_plane.lm_studio ? 'ON' : 'OFF');
                  } else {
                    wp.textContent = '🟡 Standby / Offline';
                  }
                }
              }).catch(function() {});
          }
          loadTel();
          var rb = document.getElementById('ll-lab-refresh');
          if (rb) rb.addEventListener('click', loadTel);
        })();
        </script>
        <?php
    }
    if (!empty($GLOBALS['ll_pipe_js'])) {
        ?>
        <script data-ll-pjax="lab-pipe">
        (function() {
          document.querySelectorAll('.ll-pipe-node').forEach(function(btn) {
            btn.addEventListener('click', function() {
              var card = btn.closest('.ll-pipe-card') || document;
              card.querySelectorAll('.ll-pipe-node').forEach(function(b) { b.classList.remove('active'); });
              btn.classList.add('active');
              var det = card.querySelector('.ll-pipe-detail-box') || document.getElementById('ll-pipe-detail');
              if (det) det.textContent = btn.getAttribute('data-desc');
            });
          });
        })();
        </script>
        <?php
    }
    if (!empty($GLOBALS['ll_arch_js'])) {
        $lang = $GLOBALS['ll_arch_js'];
        ?>
        <script data-ll-pjax="lab-arch">
        (function() {
          var form = document.getElementById('ll-arch-form');
          var inp = document.getElementById('ll-arch-input');
          var btn = document.getElementById('ll-arch-btn');
          var out = document.getElementById('ll-arch-out');
          var send = document.getElementById('ll-arch-send');
          var lastPlan = '';
          document.querySelectorAll('.ll-arch-ex').forEach(function(ex) {
            ex.addEventListener('click', function() { inp.value = ex.textContent; });
          });
          if (form) {
            form.addEventListener('submit', function(e) {
              e.preventDefault();
              var t = inp.value.trim();
              if (!t) return;
              btn.disabled = true;
              out.style.display = 'block';
              out.textContent = '⏳ Mistral 24B (RTX 3090)...';
              send.style.display = 'none';
              fetch('/wp-json/lancerlab/v1/lab/architect', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ task: t, lang: <?php echo wp_json_encode($lang); ?> })
              })
              .then(function(r) { return r.json(); })
              .then(function(d) {
                if (d.ok) {
                  lastPlan = d.plan;
                  out.textContent = d.plan;
                  send.style.display = 'inline-block';
                } else {
                  out.textContent = d.error || 'Error';
                }
              })
              .finally(function() { btn.disabled = false; });
            });
          }
          if (send) {
            send.addEventListener('click', function() {
              var contact = prompt('Telegram (@username) or Email:');
              if (!contact) return;
              fetch('/wp-json/lancerlab/v1/contact', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                  name: 'AI Architect Lead',
                  contact: contact,
                  message: 'Задача: ' + inp.value + '\n\nАрхитектура:\n' + lastPlan,
                  lang: <?php echo wp_json_encode($lang); ?>,
                  page: '/projects/'
                })
              }).then(function() { send.textContent = '✅ Sent!'; send.disabled = true; });
            });
          }
        })();
        </script>
        <?php
    }
}, 99);
