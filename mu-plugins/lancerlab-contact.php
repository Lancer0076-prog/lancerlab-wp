<?php
/**
 * Plugin Name: LancerLab Contact Form -> n8n -> Telegram
 * Description: Provides /wp-json/lancerlab/v1/contact proxy to local n8n webhook and localized [lancerlab_contact_form] shortcode.
 */

add_action('rest_api_init', function () {
    register_rest_route('lancerlab/v1', '/contact', [
        'methods'             => 'POST',
        'permission_callback' => '__return_true',
        'callback'            => function (WP_REST_Request $req) {
            $params = $req->get_json_params();
            if (!is_array($params)) $params = $req->get_params();

            // Honeypot anti-spam
            if (!empty($params['website'])) {
                return new WP_REST_Response(['ok' => true], 200);
            }

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

            // Rate limit: max 3 per 10 min per IP + max 20 global per 10 min against botnets
            $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
            $rl_key = 'll_cf_rl_' . md5($ip);
            $gl_key = 'll_cf_rl_global';
            $count = (int) get_transient($rl_key);
            $gl_count = (int) get_transient($gl_key);
            if ($count >= 3 || $gl_count >= 20) {
                return new WP_REST_Response(['ok' => false, 'error' => 'Too many requests. Please wait a few minutes.'], 429);
            }

            $name    = sanitize_text_field(mb_substr($params['name'] ?? '', 0, 80));
            $contact = sanitize_text_field(mb_substr($params['contact'] ?? '', 0, 100));
            $message = sanitize_textarea_field(mb_substr($params['message'] ?? '', 0, 1500));
            $lang    = sanitize_text_field($params['lang'] ?? 'uk');
            $page    = sanitize_text_field($params['page'] ?? '/');

            if ($name === '' || $contact === '' || $message === '') {
                return new WP_REST_Response(['ok' => false, 'error' => 'Please fill in all fields.'], 400);
            }
            if (substr_count(strtolower($message), 'http') > 2) {
                return new WP_REST_Response(['ok' => false, 'error' => 'Too many links in message.'], 400);
            }

            set_transient($rl_key, $count + 1, 600);
            set_transient($gl_key, $gl_count + 1, 600);

            $resp = wp_remote_post('http://127.0.0.1:5678/webhook/lancerlab-contact', [
                'timeout' => 8,
                'headers' => ['Content-Type' => 'application/json'],
                'body'    => wp_json_encode([
                    'name'    => $name,
                    'contact' => $contact,
                    'message' => $message,
                    'lang'    => $lang,
                    'page'    => $page,
                ]),
            ]);

            if (is_wp_error($resp) || wp_remote_retrieve_response_code($resp) >= 400) {
                return new WP_REST_Response(['ok' => false, 'error' => 'Delivery error. Please try Telegram directly.'], 502);
            }

            return new WP_REST_Response(['ok' => true], 200);
        },
    ]);
});

add_shortcode('lancerlab_contact_form', function () {
    $lang = function_exists('ll_detect_lang') ? ll_detect_lang() : 'uk';
    $t = [
        'uk' => [
            'title'   => 'Швидке повідомлення в Telegram',
            'sub'     => 'Повідомлення миттєво прийде мені в бот із вашим контактом для відповіді.',
            'name'    => "Ваше ім'я",
            'contact' => 'Ваш Telegram (@username або телефон) або Email',
            'msg'     => 'Повідомлення (суть завдання або питання)',
            'btn'     => '✈️ Надіслати в Telegram',
            'sending' => 'Надсилання...',
            'ok'      => '✅ Надіслано! Відповім вам у Telegram найближчим часом.',
            'err'     => '❌ Помилка надсилання. Напишіть напряму в @Lancer0076.',
        ],
        'ru' => [
            'title'   => 'Быстрое сообщение в Telegram',
            'sub'     => 'Сообщение мгновенно придёт мне в бот с вашим контактом для ответа.',
            'name'    => 'Ваше имя',
            'contact' => 'Ваш Telegram (@username или телефон) или Email',
            'msg'     => 'Сообщение (суть задачи или вопрос)',
            'btn'     => '✈️ Отправить в Telegram',
            'sending' => 'Отправка...',
            'ok'      => '✅ Отправлено! Отвечу вам в Telegram в ближайшее время.',
            'err'     => '❌ Ошибка отправки. Напишите напрямую в @Lancer0076.',
        ],
        'en' => [
            'title'   => 'Quick Message to Telegram',
            'sub'     => 'Your message will be delivered straight to my Telegram bot with a direct reply link.',
            'name'    => 'Your name',
            'contact' => 'Your Telegram (@username or phone) or Email',
            'msg'     => 'Message (project details or question)',
            'btn'     => '✈️ Send to Telegram',
            'sending' => 'Sending...',
            'ok'      => '✅ Sent! I will reply to you on Telegram shortly.',
            'err'     => '❌ Failed to send. Please reach out directly at @Lancer0076.',
        ],
    ][$lang] ?? [];

    ob_start();
    ?>
    <div class="ll-cf-wrap">
      <h3 style="margin-top:0;margin-bottom:0.35rem;"><?php echo esc_html($t['title']); ?></h3>
      <p style="margin-top:0;margin-bottom:1rem;font-size:0.92rem;"><?php echo esc_html($t['sub']); ?></p>
      <form id="ll-contact-form" class="ll-cf-form">
        <div class="ll-cf-row">
          <input type="text" name="name" required maxlength="80" placeholder="<?php echo esc_attr($t['name']); ?>">
          <input type="text" name="contact" required maxlength="100" placeholder="<?php echo esc_attr($t['contact']); ?>">
        </div>
        <input type="text" name="website" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;opacity:0;" aria-hidden="true">
        <textarea name="message" rows="3" required maxlength="1500" placeholder="<?php echo esc_attr($t['msg']); ?>"></textarea>
        <div class="ll-cf-actions">
          <button type="submit" class="ll-cf-btn"><?php echo esc_html($t['btn']); ?></button>
          <span id="ll-cf-status" class="ll-cf-status" aria-live="polite"></span>
        </div>
      </form>
    </div>
    <script>
      (function() {
        var form = document.getElementById('ll-contact-form');
        if (!form) return;
        form.addEventListener('submit', function(e) {
          e.preventDefault();
          var btn = form.querySelector('.ll-cf-btn');
          var st = document.getElementById('ll-cf-status');
          btn.disabled = true;
          st.textContent = <?php echo wp_json_encode($t['sending']); ?>;
          fetch('/wp-json/lancerlab/v1/contact', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
              name: form.name.value,
              contact: form.contact.value,
              message: form.message.value,
              website: form.website.value,
              lang: <?php echo wp_json_encode($lang); ?>,
              page: window.location.pathname
            })
          })
          .then(function(r) { return r.json().then(function(d) { return { ok: r.ok && d.ok, d: d }; }); })
          .then(function(res) {
            if (res.ok) {
              st.textContent = <?php echo wp_json_encode($t['ok']); ?>;
              form.reset();
            } else {
              st.textContent = (res.d && res.d.error) ? res.d.error : <?php echo wp_json_encode($t['err']); ?>;
            }
          })
          .catch(function() {
            st.textContent = <?php echo wp_json_encode($t['err']); ?>;
          })
          .finally(function() {
            btn.disabled = false;
          });
        });
      })();
    </script>
    <?php
    return ob_get_clean();
});
