<?php
/**
 * Plugin Name: LancerLab Multi-Skin Engine & Swarm Morph Transitions
 * Description: Extensible design-skin registry, noticeable header skin deck switcher, Swarm-inspired Figma cursor morph animation, and synthesized Web Audio feedback.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Central skin registry.
 * Adding a new skin later requires:
 *  1) Adding a config entry here with id/labels/swatches/wave palette
 *  2) Adding corresponding html[data-skin="<id>"] CSS rules below
 */
function ll_get_skins_registry() {
    return [
        'editorial' => [
            'id'       => 'editorial',
            'badge'    => '01',
            'veil'     => '#fafaf9',
            'ambient'  => '',
            'names'    => ['uk' => 'Editorial', 'ru' => 'Editorial', 'en' => 'Editorial'],
            'short'    => ['uk' => 'Обкладинки', 'ru' => 'Обложки', 'en' => 'Skins'],
            'desc'     => [
                'uk' => 'Стерильна базова (світла/темна)',
                'ru' => 'Стерильная базовая (светлая/тёмная)',
                'en' => 'Clean minimalist (default)',
            ],
            'swatches' => ['#fafaf9', '#09090b', '#0f766e'],
            'hasTheme' => true,
            'wave'     => [
                'cpu' => '#2dd4bf', 'cpuGlow' => 'rgba(45, 212, 191, 0.55)',
                'gpu' => '#a78bfa', 'gpuGlow' => 'rgba(167, 139, 250, 0.55)',
                'vram' => '#fbbf24', 'vramGlow' => 'rgba(251, 191, 36, 0.40)',
                'grid' => 'rgba(255, 255, 255, 0.05)',
            ],
        ],
        'ribbon' => [
            'id'       => 'ribbon',
            'badge'    => '02',
            'veil'     => '#0c3442',
            'ambient'  => 'Cylinder Glass · D Lydian',
            'names'    => ['uk' => '3D Ribbon', 'ru' => '3D Ribbon', 'en' => '3D Ribbon'],
            'short'    => ['uk' => '3D-ленти', 'ru' => '3D-ленты', 'en' => '3D Ribbon'],
            'desc'     => [
                'uk' => 'Об’ємні 3D-стрічки 01–04',
                'ru' => 'Объёмные 3D-ленты 01–04',
                'en' => '3D cylindrical ribbons 01–04',
            ],
            'swatches' => ['#144554', '#FAF6EE', '#F16923', '#33A2B8'],
            'hasTheme' => false,
            'wave'     => [
                'cpu' => '#FAF6EE', 'cpuGlow' => 'rgba(250, 246, 238, 0.55)',
                'gpu' => '#F16923', 'gpuGlow' => 'rgba(241, 105, 35, 0.65)',
                'vram' => '#33A2B8', 'vramGlow' => 'rgba(51, 162, 184, 0.55)',
                'grid' => 'rgba(250, 246, 238, 0.08)',
            ],
        ],
        'okb1' => [
            'id'       => 'okb1',
            'badge'    => '03',
            'veil'     => '#0c100d',
            'ambient'  => 'Baikonur 1961 · Kosmos',
            'names'    => ['uk' => 'OKB-1 Retro', 'ru' => 'OKB-1 Retro', 'en' => 'OKB-1 Retro'],
            'short'    => ['uk' => 'ОКБ-1', 'ru' => 'ОКБ-1', 'en' => 'OKB-1'],
            'desc'     => [
                'uk' => 'Космічний пульт 1961 + ЕПТ',
                'ru' => 'Космический пульт 1961 + ЭЛТ',
                'en' => '1961 space console + CRT',
            ],
            'swatches' => ['#121712', '#ffb000', '#4ade80', '#313d32'],
            'hasTheme' => false,
            'wave'     => [
                'cpu' => '#4ade80', 'cpuGlow' => 'rgba(74, 222, 128, 0.65)',
                'gpu' => '#ffb000', 'gpuGlow' => 'rgba(255, 176, 0, 0.65)',
                'vram' => '#fb7185', 'vramGlow' => 'rgba(251, 113, 133, 0.45)',
                'grid' => 'rgba(74, 222, 128, 0.09)',
            ],
        ],
        'cyberpunk' => [
            'id'       => 'cyberpunk',
            'badge'    => '04',
            'veil'     => '#07060c',
            'ambient'  => 'Night City Rain · Am',
            'names'    => ['uk' => 'Cyberpunk', 'ru' => 'Cyberpunk', 'en' => 'Cyberpunk'],
            'short'    => ['uk' => 'Кіберпанк', 'ru' => 'Киберпанк', 'en' => 'Cyberpunk'],
            'desc'     => [
                'uk' => 'Night City HUD: неон і зрізані кути',
                'ru' => 'Night City HUD: неон и срезы углов',
                'en' => 'Netrunner neon & chamfered HUD',
            ],
            'swatches' => ['#07060c', '#fcee09', '#00f0ff', '#ff0055'],
            'hasTheme' => false,
            'wave'     => [
                'cpu' => '#00f0ff', 'cpuGlow' => 'rgba(0, 240, 255, 0.72)',
                'gpu' => '#fcee09', 'gpuGlow' => 'rgba(252, 238, 9, 0.68)',
                'vram' => '#ff0055', 'vramGlow' => 'rgba(255, 0, 85, 0.62)',
                'grid' => 'rgba(0, 240, 255, 0.09)',
            ],
        ],
        'japan' => [
            'id'       => 'japan',
            'badge'    => '05',
            'veil'     => '#f5efe2',
            'ambient'  => 'Kyoto Koto · Hirajōshi',
            'names'    => ['uk' => 'Japan Washi', 'ru' => 'Япония / Ваcи', 'en' => 'Japan Washi'],
            'short'    => ['uk' => 'Японія', 'ru' => 'Япония', 'en' => 'Japan'],
            'desc'     => [
                'uk' => 'Рисовий папір, туш і печатка інкан',
                'ru' => 'Рисовая бумага, тушь и печать ханко',
                'en' => 'Kyoto paper, indigo & vermilion seal',
            ],
            'swatches' => ['#f5efe2', '#1e3a5f', '#c8281c', '#1c1917'],
            'hasTheme' => false,
            'wave'     => [
                'cpu' => '#38bdf8', 'cpuGlow' => 'rgba(56, 189, 248, 0.55)',
                'gpu' => '#ef4444', 'gpuGlow' => 'rgba(239, 68, 68, 0.60)',
                'vram' => '#f59e0b', 'vramGlow' => 'rgba(245, 158, 11, 0.50)',
                'grid' => 'rgba(245, 239, 226, 0.08)',
            ],
        ],
        'china80' => [
            'id'       => 'china80',
            'badge'    => '06',
            'veil'     => '#110614',
            'ambient'  => 'Kowloon 1984 · VHS Dream',
            'names'    => ['uk' => '80s Neon HK', 'ru' => 'Китай 80-х', 'en' => '80s China Neon'],
            'short'    => ['uk' => 'Китай 80-х', 'ru' => 'Китай 80-х', 'en' => '80s China'],
            'desc'     => [
                'uk' => 'Неон Коулуна, золото та лак',
                'ru' => 'Неон 80-х, золото и красный лак',
                'en' => 'Kowloon neon, imperial gold & lacquer',
            ],
            'swatches' => ['#110614', '#ff2e4c', '#fbbf24', '#10d98c'],
            'hasTheme' => false,
            'wave'     => [
                'cpu' => '#10d98c', 'cpuGlow' => 'rgba(16, 217, 140, 0.70)',
                'gpu' => '#fbbf24', 'gpuGlow' => 'rgba(251, 191, 36, 0.65)',
                'vram' => '#ff2e4c', 'vramGlow' => 'rgba(255, 46, 76, 0.65)',
                'grid' => 'rgba(251, 191, 36, 0.08)',
            ],
        ],
        'fallout' => [
            'id'       => 'fallout',
            'badge'    => '07',
            'veil'     => '#040d04',
            'ambient'  => 'Vault 101 · RobCo Tape',
            'names'    => ['uk' => 'Fallout Pip-Boy', 'ru' => 'Fallout Pip-Boy', 'en' => 'Fallout Pip-Boy'],
            'short'    => ['uk' => 'Pip-Boy', 'ru' => 'Fallout', 'en' => 'Pip-Boy'],
            'desc'     => [
                'uk' => 'Екран RobCo CRT та зелений фосфор',
                'ru' => 'Экран RobCo CRT и зелёный фосфор',
                'en' => 'RobCo Vault-Tec monochrome CRT',
            ],
            'swatches' => ['#040d04', '#22ff88', '#14994d', '#0b260f'],
            'hasTheme' => false,
            'wave'     => [
                'cpu' => '#6ee7b7', 'cpuGlow' => 'rgba(110, 231, 183, 0.75)',
                'gpu' => '#22ff88', 'gpuGlow' => 'rgba(34, 255, 136, 0.85)',
                'vram' => '#10b981', 'vramGlow' => 'rgba(16, 185, 129, 0.55)',
                'grid' => 'rgba(34, 255, 136, 0.12)',
            ],
        ],
        'bauhaus' => [
            'id'       => 'bauhaus',
            'badge'    => '08',
            'veil'     => '#f3efe4',
            'ambient'  => 'Dessau Pulse · Minimal',
            'names'    => ['uk' => 'Bauhaus Poster', 'ru' => 'Баухаус Постер', 'en' => 'Bauhaus Poster'],
            'short'    => ['uk' => 'Баухаус', 'ru' => 'Баухаус', 'en' => 'Bauhaus'],
            'desc'     => [
                'uk' => 'Швейцарський бруталізм і жорсткі тіні',
                'ru' => 'Необрутализм: обводки и жёсткие тени',
                'en' => 'Bold neo-brutalist graphic poster',
            ],
            'swatches' => ['#f3efe4', '#e63946', '#ffb703', '#1d4ed8'],
            'hasTheme' => false,
            'wave'     => [
                'cpu' => '#ffb703', 'cpuGlow' => 'rgba(255, 183, 3, 0.60)',
                'gpu' => '#e63946', 'gpuGlow' => 'rgba(230, 57, 70, 0.65)',
                'vram' => '#38bdf8', 'vramGlow' => 'rgba(56, 189, 248, 0.55)',
                'grid' => 'rgba(255, 255, 255, 0.08)',
            ],
        ],
    ];
}

/**
 * Helper to render the top header skin switcher right next to the theme toggle.
 */
function ll_render_skin_switcher_html($lang = 'uk') {
    $skins = ll_get_skins_registry();
    $copy = [
        'uk' => [
            'btn'     => 'Обкладинки',
            'title'   => 'Дизайн-обкладинка сайту',
            'nudge'   => 'Спробуйте вау-обкладинки:',
            'sound'   => 'Звук переходу (Web Audio)',
            'replay'  => 'Повторити збірку роєм',
            'hint'    => 'Роєвий перехід з озвучкою · Також в ⌘K',
        ],
        'ru' => [
            'btn'     => 'Обложки',
            'title'   => 'Дизайн-обложка сайта',
            'nudge'   => 'Попробуйте вау-обложки:',
            'sound'   => 'Звук перехода (Web Audio)',
            'replay'  => 'Повторить сборку роем',
            'hint'    => 'Роевой переход с озвучкой · Также в ⌘K',
        ],
        'en' => [
            'btn'     => 'Covers',
            'title'   => 'Design Cover Skins',
            'nudge'   => 'Try bold site covers:',
            'sound'   => 'Transition audio (Web Audio)',
            'replay'  => 'Replay swarm transition',
            'hint'    => 'Swarm cursor morph + audio · Also in ⌘K',
        ],
    ][$lang] ?? [
        'btn' => 'Covers', 'title' => 'Design Cover Skins', 'nudge' => 'Try bold site covers:',
        'sound' => 'Transition audio', 'replay' => 'Replay swarm', 'hint' => 'Swarm cursor morph · Also in ⌘K',
    ];

    $out = '<div class="ll-skin-wrap" id="ll-skin-wrap">';
    $out .= '<button id="ll-skin-toggle" class="ll-skin-btn is-default" type="button" aria-haspopup="true" aria-expanded="false" title="' . esc_attr($copy['title']) . '">';
    $out .= '<span class="ll-skin-dots" aria-hidden="true">'
         . '<i style="background:#FAF6EE;border-color:rgba(0,0,0,0.2)"></i>'
         . '<i style="background:#F16923"></i>'
         . '<i style="background:#fcee09"></i>'
         . '<i style="background:#22ff88"></i>'
         . '</span>';
    $out .= '<span class="ll-skin-btn-txt" id="ll-skin-active-label">' . esc_html($copy['btn']) . '</span>';
    $out .= '<span class="ll-skin-new-badge" id="ll-skin-badge">' . count($skins) . '</span>';
    $out .= '<span class="ll-skin-caret" aria-hidden="true">▾</span>';
    $out .= '</button>';

    $out .= '<div id="ll-skin-menu" class="ll-skin-menu" role="menu" aria-hidden="true">';
    $out .= '<div class="ll-skin-menu-hd">';
    $out .= '<span class="ll-skin-menu-title">' . esc_html($copy['title']) . '</span>';
    $amb_lbl = $lang === 'uk' ? 'Фоновий ambient (музика стилю)' : ($lang === 'ru' ? 'Фоновый ambient (музыка стиля)' : 'Theme ambient music');
    $out .= '<div class="ll-skin-menu-ctrls">';
    $out .= '<button type="button" id="ll-amb-mute" class="ll-skin-icon-btn" title="' . esc_attr($amb_lbl) . '">♫</button>';
    $out .= '<button type="button" id="ll-swarm-replay" class="ll-skin-icon-btn" title="' . esc_attr($copy['replay']) . '">↻</button>';
    $out .= '<button type="button" id="ll-swarm-mute" class="ll-skin-icon-btn" title="' . esc_attr($copy['sound']) . '">🔊</button>';
    $out .= '</div></div>';

    $out .= '<div class="ll-skin-list">';
    foreach ($skins as $id => $s) {
        $sw = '';
        foreach ($s['swatches'] as $hex) {
            $sw .= '<span class="ll-sw" style="background:' . esc_attr($hex) . '"></span>';
        }
        $name = $s['names'][$lang] ?? $s['names']['en'];
        $desc = $s['desc'][$lang] ?? $s['desc']['en'];
        $out .= '<button type="button" class="ll-skin-opt" role="menuitemradio" data-skin-id="' . esc_attr($id) . '">';
        $out .= '<span class="ll-skin-opt-badge">' . esc_html($s['badge']) . '</span>';
        $out .= '<span class="ll-skin-opt-body">';
        $out .= '<span class="ll-skin-opt-top"><strong>' . esc_html($name) . '</strong><span class="ll-skin-swatches">' . $sw . '</span></span>';
        $out .= '<span class="ll-skin-opt-desc">' . esc_html($desc) . '</span>';
        $out .= '</span>';
        $out .= '<span class="ll-skin-check">✓</span>';
        $out .= '</button>';
    }
    $out .= '</div>';
    $out .= '<div class="ll-skin-menu-ft">' . esc_html($copy['hint']) . '</div>';
    $out .= '</div>';

    // Noticeable first-visit nudge anchored cleanly below the top switcher (3 featured pills + "All N" opener)
    $all_lbl = $lang === 'uk' ? 'Усі ' . count($skins) . ' ▾' : ($lang === 'ru' ? 'Все ' . count($skins) . ' ▾' : 'All ' . count($skins) . ' ▾');
    $out .= '<div id="ll-skin-nudge" class="ll-skin-nudge" hidden>';
    $out .= '<span class="ll-nudge-caret" aria-hidden="true"></span>';
    $out .= '<span class="ll-nudge-text">✦ ' . esc_html($copy['nudge']) . '</span>';
    $out .= '<span class="ll-nudge-pills">';
    foreach (['ribbon', 'cyberpunk', 'fallout'] as $fid) {
        if (!isset($skins[$fid])) continue;
        $s = $skins[$fid];
        $short = $s['short'][$lang] ?? $s['names']['en'];
        $accent = $s['swatches'][1] ?? $s['swatches'][0];
        $tc = in_array(strtolower($accent), ['#faf6ee', '#fcee09', '#22ff88', '#ffb703', '#fbbf24'], true) ? '#09090b' : '#ffffff';
        if ($fid === 'ribbon') $accent = '#F16923';
        $tc = in_array(strtolower($accent), ['#fcee09', '#22ff88'], true) ? '#09090b' : '#ffffff';
        $out .= '<button type="button" class="ll-nudge-pill" data-nudge-skin="' . esc_attr($fid) . '" style="--np-c:' . esc_attr($accent) . ';color:' . $tc . '">' . esc_html($short) . '</button>';
    }
    $out .= '<button type="button" class="ll-nudge-pill ll-nudge-all" id="ll-nudge-open-all" style="--np-c:#33A2B8;color:#ffffff">' . esc_html($all_lbl) . '</button>';
    $out .= '</span>';
    $out .= '<button type="button" id="ll-nudge-close" class="ll-nudge-close" aria-label="Close">×</button>';
    $out .= '</div>';

    $out .= '</div>';
    return $out;
}

/**
 * Inject early non-FOUC skin hydration + multi-skin CSS rules into <head>.
 */
add_action('wp_head', function () {
    $skins = ll_get_skins_registry();
    $skin_ids = array_keys($skins);
    ?>
    <script>
      (function() {
        var valid = <?php echo wp_json_encode($skin_ids); ?>;
        var saved = '';
        try { saved = localStorage.getItem('ll_skin') || 'editorial'; } catch (e) { saved = 'editorial'; }
        if (valid.indexOf(saved) === -1) saved = 'editorial';
        document.documentElement.setAttribute('data-skin', saved);
      })();
    </script>
    <style id="lancerlab-skins-css">
      /* Swarm Morph masking & GPU-composited card pop-in (zero layout reflow) */
      [data-sw-masked="1"] {
        visibility: hidden !important;
      }
      @keyframes llSwPop {
        0% { opacity: 0; transform: translate3d(0, 12px, 0) scale(0.96); }
        100% { opacity: 1; transform: translate3d(0, 0, 0) scale(1); }
      }
      .ll-sw-pop {
        animation: llSwPop 0.36s cubic-bezier(0.22, 1, 0.36, 1) both;
      }

      /* ========== Header Skin Switcher & Noticeable Top Bar Control ========== */
      .ll-skin-wrap {
        position: relative;
        display: inline-flex;
        align-items: center;
      }
      .ll-skin-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.38rem;
        border: 1px solid var(--ll-border);
        background: var(--ll-surface);
        color: var(--ll-dark);
        border-radius: 8px;
        padding: 0.22rem 0.55rem;
        font-family: var(--ll-font-sans);
        font-size: 0.76rem;
        font-weight: 600;
        cursor: pointer;
        line-height: 1.3;
        white-space: nowrap;
        transition: all 0.18s ease;
      }
      .ll-skin-btn:hover {
        border-color: var(--ll-accent);
        transform: translateY(-1px);
      }
      .ll-skin-btn.is-default {
        border-color: rgba(241, 105, 35, 0.55);
        background: linear-gradient(135deg, rgba(241, 105, 35, 0.10), rgba(51, 162, 184, 0.13));
        box-shadow: 0 0 0 0 rgba(241, 105, 35, 0.32);
        animation: llSkinBeacon 3.4s infinite ease-in-out;
      }
      html[data-theme="dark"] .ll-skin-btn.is-default {
        background: linear-gradient(135deg, rgba(241, 105, 35, 0.20), rgba(51, 162, 184, 0.22));
      }
      @keyframes llSkinBeacon {
        0%, 100% { box-shadow: 0 0 0 0 rgba(241, 105, 35, 0.28); }
        50% { box-shadow: 0 0 0 4px rgba(51, 162, 184, 0.0); }
      }
      .ll-skin-dots {
        display: inline-flex;
        align-items: center;
      }
      .ll-skin-dots i {
        display: block;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.35);
        margin-left: -2px;
      }
      .ll-skin-dots i:first-child { margin-left: 0; }
      .ll-skin-new-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 15px;
        height: 15px;
        padding: 0 4px;
        border-radius: 999px;
        background: #F16923;
        color: #ffffff;
        font-family: var(--ll-font-mono);
        font-size: 0.62rem;
        font-weight: 700;
        line-height: 1;
      }
      .ll-skin-btn:not(.is-default) .ll-skin-new-badge {
        display: none;
      }
      .ll-skin-caret { font-size: 0.66rem; opacity: 0.72; }

      /* Always keep sticky header above card layers when skin menu is open */
      header.wp-block-template-part { z-index: 120 !important; }

      /* Skin Popover Deck (2-column grid on desktop for 8+ covers, clean scroll on mobile) */
      .ll-skin-menu {
        display: none;
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        width: min(560px, calc(100vw - 24px));
        background: var(--ll-surface) !important;
        color: var(--ll-dark);
        border: 1px solid var(--ll-border);
        border-radius: 14px;
        box-shadow: 0 22px 52px rgba(0, 0, 0, 0.38);
        padding: 0.65rem;
        z-index: 250;
      }
      .ll-skin-menu.open {
        display: block;
      }
      html[data-skin="ribbon"] .ll-skin-menu { background: #0d3644 !important; border-color: rgba(51, 162, 184, 0.45); }
      html[data-skin="okb1"] .ll-skin-menu { background: #141a15 !important; border-color: #374637; }
      html[data-skin="cyberpunk"] .ll-skin-menu { background: #0e0b1a !important; border-color: #00f0ff; }
      html[data-skin="japan"] .ll-skin-menu { background: #fbf6eb !important; border-color: #d6c8b0; }
      html[data-skin="china80"] .ll-skin-menu { background: #1d0914 !important; border-color: #fbbf24; }
      html[data-skin="fallout"] .ll-skin-menu { background: #071709 !important; border-color: #22ff88; }
      html[data-skin="bauhaus"] .ll-skin-menu { background: #ffffff !important; border: 2px solid #09090b; box-shadow: 6px 6px 0 #09090b; }
      .ll-skin-menu-hd {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.25rem 0.35rem 0.55rem;
        border-bottom: 1px solid var(--ll-border);
        margin-bottom: 0.5rem;
      }
      .ll-skin-menu-title {
        font-family: var(--ll-font-mono);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--ll-muted);
      }
      .ll-skin-menu-ctrls {
        display: inline-flex;
        gap: 0.3rem;
      }
      .ll-skin-icon-btn {
        border: 1px solid var(--ll-border);
        background: var(--ll-surface-alt);
        color: var(--ll-dark);
        border-radius: 6px;
        width: 26px;
        height: 24px;
        font-size: 0.78rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
      }
      .ll-skin-icon-btn:hover { border-color: var(--ll-accent); }
      .ll-skin-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.42rem;
        max-height: 66vh;
        overflow-y: auto;
        overflow-x: hidden;
      }
      @media (max-width: 640px) {
        .ll-skin-list {
          grid-template-columns: minmax(0, 1fr);
          max-height: 58vh;
        }
      }
      .ll-skin-opt {
        display: flex;
        align-items: center;
        gap: 0.55rem;
        width: 100%;
        min-width: 0;
        box-sizing: border-box;
        text-align: left;
        padding: 0.55rem 0.6rem;
        border-radius: 10px;
        border: 1px solid var(--ll-border);
        background: var(--ll-bg);
        color: var(--ll-dark);
        cursor: pointer;
        transition: border-color 0.15s, transform 0.12s, background 0.15s;
      }
      .ll-skin-opt:hover {
        border-color: var(--ll-accent);
        transform: translateX(2px);
      }
      .ll-skin-opt.active {
        border-color: var(--ll-accent);
        background: var(--ll-accent-soft);
      }
      .ll-skin-opt-badge {
        font-family: var(--ll-font-mono);
        font-size: 0.74rem;
        font-weight: 700;
        color: var(--ll-muted);
        width: 22px;
        flex-shrink: 0;
      }
      .ll-skin-opt-body {
        display: flex;
        flex-direction: column;
        flex: 1;
        min-width: 0;
      }
      .ll-skin-opt-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.4rem;
        font-size: 0.84rem;
      }
      .ll-skin-opt-desc {
        font-size: 0.72rem;
        color: var(--ll-muted);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      .ll-skin-swatches {
        display: inline-flex;
        gap: 2px;
        flex-shrink: 0;
      }
      .ll-sw {
        width: 11px;
        height: 11px;
        border-radius: 3px;
        border: 1px solid rgba(128, 128, 128, 0.35);
      }
      .ll-skin-check {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--ll-accent);
        opacity: 0;
        flex-shrink: 0;
      }
      .ll-skin-opt.active .ll-skin-check { opacity: 1; }
      .ll-skin-menu-ft {
        margin-top: 0.5rem;
        padding-top: 0.45rem;
        border-top: 1px solid var(--ll-border);
        font-family: var(--ll-font-mono);
        font-size: 0.64rem;
        color: var(--ll-muted);
        text-align: center;
      }

      /* First-visit subtle attention callout anchored under header button */
      .ll-skin-nudge {
        position: absolute;
        top: calc(100% + 11px);
        right: 0;
        display: flex;
        align-items: center;
        gap: 0.45rem;
        background: #144554;
        color: #FAF6EE;
        border: 1px solid rgba(51, 162, 184, 0.55);
        border-radius: 999px;
        padding: 0.34rem 0.45rem 0.34rem 0.75rem;
        box-shadow: 0 14px 34px rgba(5, 25, 34, 0.38);
        font-size: 0.75rem;
        font-weight: 500;
        white-space: nowrap;
        z-index: 190;
        animation: llNudgeFloat 0.35s cubic-bezier(0.22, 1, 0.36, 1);
      }
      .ll-skin-nudge[hidden] { display: none !important; }
      @keyframes llNudgeFloat {
        from { opacity: 0; transform: translateY(-6px); }
        to { opacity: 1; transform: translateY(0); }
      }
      .ll-nudge-caret {
        position: absolute;
        top: -6px;
        right: 34px;
        width: 10px;
        height: 10px;
        background: #144554;
        border-left: 1px solid rgba(51, 162, 184, 0.55);
        border-top: 1px solid rgba(51, 162, 184, 0.55);
        transform: rotate(45deg);
      }
      .ll-nudge-pills { display: inline-flex; gap: 0.3rem; }
      .ll-nudge-pill {
        border: none;
        border-radius: 999px;
        padding: 0.16rem 0.52rem;
        font-family: var(--ll-font-mono);
        font-size: 0.68rem;
        font-weight: 700;
        background: var(--np-c, #F16923);
        color: #ffffff;
        cursor: pointer;
        transition: transform 0.12s;
      }
      .ll-nudge-pill:hover { transform: scale(1.06); }
      .ll-nudge-close {
        background: rgba(255, 255, 255, 0.12);
        color: #FAF6EE;
        border: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 0.85rem;
        line-height: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
      }
      .ll-nudge-close:hover { background: rgba(255, 255, 255, 0.25); }

      @media (max-width: 980px) {
        .wp-block-navigation ul { gap: 0.65rem !important; }
      }
      @media (max-width: 640px) {
        header.wp-block-template-part > .wp-block-group { padding: 0.5rem 0.7rem !important; }
        header.wp-block-template-part .wp-block-group.alignwide { gap: 0.4rem !important; }
        .wp-block-site-title a { font-size: 0.96rem !important; }
        .ll-nav-wrap { gap: 0.35rem !important; }
        .ll-toolbar { gap: 0.28rem !important; }
        #ll-cmdk-open { display: none !important; }
        .ll-lang-pill a { padding: 0.16rem 0.34rem !important; font-size: 0.66rem !important; }
        .ll-theme-btn { padding: 0.16rem 0.4rem !important; font-size: 0.76rem !important; }
        .ll-skin-btn { padding: 0.18rem 0.42rem !important; gap: 0.25rem !important; font-size: 0.7rem !important; }
        .ll-skin-dots i:nth-child(n+3) { display: none; }
        .ll-skin-new-badge { display: none !important; }
        .ll-skin-menu {
          position: fixed;
          top: 52px;
          right: 10px;
          width: min(320px, calc(100vw - 20px));
        }
        .ll-skin-nudge {
          position: fixed;
          top: 52px;
          right: 10px;
          max-width: calc(100vw - 20px);
          padding: 0.32rem 0.4rem 0.32rem 0.65rem;
        }
        .ll-nudge-text { display: none; }
        .ll-nudge-caret { right: 54px; }
      }
      @media (max-width: 420px) {
        .ll-skin-btn-txt { max-width: 56px; overflow: hidden; text-overflow: ellipsis; }
      }

      /* =====================================================================
         SKIN 02: 3D RIBBON (Pinterest 320811173465372670 — Petrol + 01-04 3D Drums)
         ===================================================================== */
      html[data-skin="ribbon"] {
        --ll-bg: #113f4e;
        --ll-surface: #144a5c;
        --ll-surface-alt: #0c303c;
        --ll-dark: #FAF6EE;
        --ll-text: #e2f1f5;
        --ll-muted: #9ad0dc;
        --ll-border: rgba(250, 246, 238, 0.16);
        --ll-accent: #F16923;
        --ll-accent-2: #33A2B8;
        --ll-accent-soft: rgba(51, 162, 184, 0.20);
        --ll-accent-border: rgba(51, 162, 184, 0.50);
        --ll-wave-cpu: #FAF6EE;
        --ll-wave-gpu: #F16923;
        --ll-wave-vram: #33A2B8;
      }
      html[data-skin="ribbon"],
      html[data-skin="ribbon"] body {
        background-color: #08232d !important;
        background-image: radial-gradient(ellipse at 50% 0%, #226478 0%, #144858 38%, #0a2d39 78%, #061c24 100%) !important;
        background-repeat: no-repeat !important;
        min-height: 100vh;
        color: #e2f1f5 !important;
      }
      html[data-skin="ribbon"] #ll-read-progress {
        height: 3px;
        background: linear-gradient(90deg, #FAF6EE, #F16923, #1A1C24, #33A2B8);
      }
      html[data-skin="ribbon"] header.wp-block-template-part {
        background: rgba(8, 36, 46, 0.88) !important;
        border-bottom: 1px solid rgba(51, 162, 184, 0.30) !important;
      }
      html[data-skin="ribbon"] .wp-block-site-title a { color: #FAF6EE !important; }
      html[data-skin="ribbon"] .wp-block-navigation a { color: #bfe4ec !important; }
      html[data-skin="ribbon"] .wp-block-navigation a:hover { color: #FAF6EE !important; }
      html[data-skin="ribbon"] .ll-lang-pill {
        background: rgba(9, 34, 43, 0.9);
        border-color: rgba(51, 162, 184, 0.35);
      }
      html[data-skin="ribbon"] .ll-lang-pill a { color: #9ad0dc !important; }
      html[data-skin="ribbon"] .ll-lang-pill a.active {
        background: #F16923;
        color: #FAF6EE !important;
      }
      html[data-skin="ribbon"] .ll-card {
        background: linear-gradient(180deg, #1b5669 0%, #12404f 22%, #0c2d38 82%, #081e26 100%);
        border: 1px solid rgba(51, 162, 184, 0.32);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.14), 0 16px 34px rgba(3, 14, 20, 0.42);
      }
      html[data-skin="ribbon"] .ll-cf-form input,
      html[data-skin="ribbon"] .ll-cf-form textarea,
      html[data-skin="ribbon"] .ll-twin-input,
      html[data-skin="ribbon"] #ll-arch-input {
        background: rgba(6, 24, 31, 0.85) !important;
        color: #FAF6EE !important;
        border-color: rgba(51, 162, 184, 0.38) !important;
      }
      html[data-skin="ribbon"] .ll-cf-form input::placeholder,
      html[data-skin="ribbon"] .ll-cf-form textarea::placeholder {
        color: #84b7c4 !important;
      }
      html[data-skin="ribbon"] .ll-cat-pill,
      html[data-skin="ribbon"] .ll-toc {
        background: #0d3441;
        border-color: rgba(51, 162, 184, 0.38);
      }
      html[data-skin="ribbon"] .ll-cat-pill.active {
        background: #F16923;
        color: #ffffff !important;
        border-color: #F16923;
      }

      /* Left Hero Card -> 01 Cream Cylindrical 3D Slab */
      html[data-skin="ribbon"] .ll-hero-card {
        background: linear-gradient(180deg, #ffffff 0%, #FAF6EE 18%, #f1e9d7 78%, #d4cab2 100%) !important;
        color: #1A1C24 !important;
        border: none !important;
        border-radius: 18px;
        box-shadow: inset 0 2px 1px rgba(255,255,255,0.95),
                    inset 0 -10px 18px rgba(120,104,78,0.18),
                    0 24px 48px rgba(2, 14, 19, 0.52) !important;
      }
      html[data-skin="ribbon"] .ll-hero-card h1,
      html[data-skin="ribbon"] .ll-hero-card .ll-hero-lead {
        color: #1A1C24 !important;
      }
      html[data-skin="ribbon"] .ll-hero-card .ll-mono-label {
        color: #545e6d !important;
      }
      html[data-skin="ribbon"] .ll-hero-card .ll-avatar-sm {
        border-color: #F16923;
        box-shadow: 0 4px 12px rgba(241, 105, 35, 0.25);
      }
      html[data-skin="ribbon"] .ll-hero-card .ll-status-inline {
        background: #1A1C24;
        color: #FAF6EE;
        border-color: #33A2B8;
      }
      html[data-skin="ribbon"] .ll-hero-card .ll-btn-solid {
        background: #F16923 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 0 #ab3f09, 0 10px 20px rgba(241, 105, 35, 0.28);
      }
      html[data-skin="ribbon"] .ll-hero-card .ll-btn-outline {
        background: rgba(26, 28, 36, 0.05);
        border-color: rgba(26, 28, 36, 0.25);
        color: #1A1C24 !important;
      }
      html[data-skin="ribbon"] .ll-hero-card .ll-btn-outline:hover {
        border-color: #F16923;
        background: rgba(241, 105, 35, 0.08);
      }

      /* Right Hero Card -> 03 Charcoal / Circle DATA 3D Cylinder */
      html[data-skin="ribbon"] .ll-terminal-card {
        background: linear-gradient(180deg, #2b3140 0%, #1A1C24 22%, #13151c 80%, #090a0e 100%) !important;
        border: 1px solid rgba(51, 162, 184, 0.38) !important;
        box-shadow: inset 0 2px 0 rgba(255,255,255,0.16),
                    inset 0 -10px 18px rgba(0,0,0,0.45),
                    0 24px 48px rgba(2, 14, 19, 0.56) !important;
      }
      html[data-skin="ribbon"] .ll-term-input-row span { color: #F16923 !important; }
      html[data-skin="ribbon"] .ll-term-cta a,
      html[data-skin="ribbon"] #ll-wp-val { color: #33A2B8 !important; }

      /* Section Headings on Petrol Backdrop */
      html[data-skin="ribbon"] .ll-sec-head {
        border-bottom: 2px solid rgba(51, 162, 184, 0.35);
      }
      html[data-skin="ribbon"] .ll-sec-head h2 {
        color: #FAF6EE !important;
        font-weight: 800 !important;
      }

      /* Focus Grid (3-column 3D Ribbon Fold: 01 Cream, 02 Orange, 03 Charcoal) */
      html[data-skin="ribbon"] .ll-focus-grid {
        gap: 0.75rem;
      }
      html[data-skin="ribbon"] .ll-focus-item {
        position: relative;
        border-radius: 14px;
        padding: 1.4rem 1.25rem;
        box-shadow: inset 0 2px 1px rgba(255,255,255,0.35),
                    inset 0 -10px 16px rgba(0,0,0,0.22),
                    0 18px 34px rgba(2, 14, 19, 0.45);
        transition: transform 0.2s cubic-bezier(0.22, 1, 0.36, 1);
      }
      html[data-skin="ribbon"] .ll-focus-item:hover { transform: translateY(-4px); }
      html[data-skin="ribbon"] .ll-focus-item::before {
        display: inline-block;
        font-family: var(--ll-font-sans);
        font-weight: 800;
        font-size: 1.55rem;
        line-height: 1;
        letter-spacing: -0.04em;
        margin-bottom: 0.55rem;
      }
      html[data-skin="ribbon"] .ll-focus-item:nth-child(1) {
        background: linear-gradient(180deg, #ffffff 0%, #FAF6EE 20%, #efe6d3 80%, #d4cab2 100%);
        color: #1A1C24;
      }
      html[data-skin="ribbon"] .ll-focus-item:nth-child(1)::before { content: "+ 01"; color: #1A1C24; }
      html[data-skin="ribbon"] .ll-focus-item:nth-child(1) h3,
      html[data-skin="ribbon"] .ll-focus-item:nth-child(1) p { color: #1A1C24 !important; opacity: 0.92; }
      html[data-skin="ribbon"] .ll-focus-item:nth-child(1) .ll-tag {
        background: rgba(26, 28, 36, 0.08); color: #1A1C24; border-color: rgba(26, 28, 36, 0.18);
      }

      html[data-skin="ribbon"] .ll-focus-item:nth-child(2) {
        background: linear-gradient(180deg, #ff9657 0%, #F16923 20%, #df5813 80%, #a53c07 100%);
        color: #1A1C24;
      }
      html[data-skin="ribbon"] .ll-focus-item:nth-child(2)::before { content: "▶ 02"; color: #FAF6EE; text-shadow: 0 2px 4px rgba(0,0,0,0.2); }
      html[data-skin="ribbon"] .ll-focus-item:nth-child(2) h3,
      html[data-skin="ribbon"] .ll-focus-item:nth-child(2) p { color: #1A1C24 !important; font-weight: 500; }
      html[data-skin="ribbon"] .ll-focus-item:nth-child(2) .ll-tag {
        background: rgba(26, 28, 36, 0.14); color: #1A1C24; border-color: rgba(26, 28, 36, 0.22);
      }

      html[data-skin="ribbon"] .ll-focus-item:nth-child(3) {
        background: linear-gradient(180deg, #323746 0%, #1d202a 20%, #15171f 80%, #090a0f 100%);
        color: #FAF6EE;
      }
      html[data-skin="ribbon"] .ll-focus-item:nth-child(3)::before { content: "❚❚ 03"; color: #33A2B8; }
      html[data-skin="ribbon"] .ll-focus-item:nth-child(3) h3 { color: #FAF6EE !important; }
      html[data-skin="ribbon"] .ll-focus-item:nth-child(3) p { color: #d1dce3 !important; }
      html[data-skin="ribbon"] .ll-focus-item:nth-child(3) .ll-tag {
        background: rgba(51, 162, 184, 0.14); color: #cbeaf1; border-color: rgba(51, 162, 184, 0.35);
      }

      /* Projects 4-Column Bento Grid -> Exact Pinterest 3D Cylindrical Ribbon Chart (01-04) */
      @media (min-width: 860px) {
        html[data-skin="ribbon"] .ll-bento-grid {
          grid-template-columns: repeat(4, 1fr);
          gap: 0;
          padding: 32px 0 38px;
          margin-top: 0.5rem;
          overflow: visible;
        }
        html[data-skin="ribbon"] .ll-bento-grid > .ll-card {
          position: relative;
          border: none !important;
          border-radius: 6px;
          padding: 1.25rem 1.05rem;
          min-height: 300px;
          display: flex;
          flex-direction: column;
          justify-content: space-between;
          z-index: 1;
          overflow: visible;
          transition: transform 0.24s cubic-bezier(0.22, 1, 0.36, 1), z-index 0s;
        }
        html[data-skin="ribbon"] .ll-bento-grid > .ll-card:hover {
          transform: translateY(-7px) scale(1.018);
          z-index: 5;
        }
        /* Vertical flat ribbon straps above and reflected below each 3D drum */
        html[data-skin="ribbon"] .ll-bento-grid > .ll-card::before {
          content: "";
          position: absolute;
          left: 0;
          right: 0;
          top: -28px;
          height: 28px;
          pointer-events: none;
          border-radius: 4px 4px 0 0;
          box-shadow: inset 0 -10px 14px rgba(0, 0, 0, 0.26);
        }
        html[data-skin="ribbon"] .ll-bento-grid > .ll-card::after {
          content: "";
          position: absolute;
          left: 0;
          right: 0;
          bottom: -30px;
          height: 30px;
          pointer-events: none;
          border-radius: 0 0 4px 4px;
          opacity: 0.42;
          -webkit-mask-image: linear-gradient(to bottom, #000 0%, transparent 100%);
          mask-image: linear-gradient(to bottom, #000 0%, transparent 100%);
        }
        html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(1) { border-top-left-radius: 16px; border-bottom-left-radius: 16px; }
        html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(4) { border-top-right-radius: 16px; border-bottom-right-radius: 16px; }
      }

      /* Mobile / Tablet fallback for 4 ribbons: stacked 3D cylindrical bars */
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card {
        border: none !important;
        box-shadow: inset 0 2px 1px rgba(255,255,255,0.35),
                    inset 0 -10px 18px rgba(0,0,0,0.28),
                    -8px 18px 34px rgba(2, 13, 18, 0.52);
      }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card .ll-mono-label::before {
        display: block;
        font-family: var(--ll-font-sans);
        font-size: 2.35rem;
        font-weight: 800;
        line-height: 1;
        letter-spacing: -0.05em;
        margin-bottom: 0.55rem;
      }

      /* 01 Cream */
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(1) {
        background: linear-gradient(180deg, #ffffff 0%, #FAF6EE 18%, #efe6d3 76%, #cec2aa 100%) !important;
        color: #1A1C24;
      }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(1)::before,
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(1)::after { background: #e8dfcc; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(1) .ll-mono-label::before { content: "+  01"; color: #1A1C24; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(1) .ll-mono-label { color: #5a6270; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(1) h3 a,
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(1) p { color: #1A1C24 !important; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(1) .ll-tag {
        background: rgba(26, 28, 36, 0.08); color: #1A1C24; border-color: rgba(26, 28, 36, 0.18);
      }

      /* 02 Tangy Orange */
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(2) {
        background: linear-gradient(180deg, #ff995c 0%, #F16923 18%, #df5813 76%, #9f3905 100%) !important;
        color: #1A1C24;
      }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(2)::before,
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(2)::after { background: #dd5a16; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(2) .ll-mono-label::before {
        content: "▶  02"; color: #1A1C24; text-shadow: 0 1px 0 rgba(255,255,255,0.22);
      }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(2) .ll-mono-label { color: #2d180e; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(2) h3 a,
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(2) p { color: #1A1C24 !important; font-weight: 500; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(2) .ll-tag {
        background: rgba(26, 28, 36, 0.14); color: #1A1C24; border-color: rgba(26, 28, 36, 0.24);
      }

      /* 03 Deep Charcoal */
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(3) {
        background: linear-gradient(180deg, #353a4a 0%, #1c1f29 18%, #15171f 76%, #08090d 100%) !important;
        color: #FAF6EE;
      }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(3)::before,
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(3)::after { background: #141720; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(3) .ll-mono-label::before { content: "❚❚  03"; color: #FAF6EE; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(3) .ll-mono-label { color: #33A2B8; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(3) h3 a { color: #FAF6EE !important; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(3) p { color: #d3dde4 !important; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(3) .ll-tag {
        background: rgba(51, 162, 184, 0.16); color: #d9f3f8; border-color: rgba(51, 162, 184, 0.35);
      }

      /* 04 Sky Cyan / Turquoise */
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(4) {
        background: linear-gradient(180deg, #64cde0 0%, #2c9ab0 18%, #1f7f94 76%, #115463 100%) !important;
        color: #ffffff;
      }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(4)::before,
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(4)::after { background: #268ca2; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(4) .ll-mono-label::before { content: "●  04"; color: #FAF6EE; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(4) .ll-mono-label { color: #0b262d; font-weight: 700; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(4) h3 a,
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(4) p { color: #ffffff !important; }
      html[data-skin="ribbon"] .ll-bento-grid > .ll-card:nth-child(4) .ll-tag {
        background: rgba(8, 32, 41, 0.28); color: #ffffff; border-color: rgba(255, 255, 255, 0.28);
      }

      /* Subpage project ribbon edge strips */
      html[data-skin="ribbon"] .wp-block-group.ll-card:nth-of-type(4n+1) { border-left: 6px solid #FAF6EE; }
      html[data-skin="ribbon"] .wp-block-group.ll-card:nth-of-type(4n+2) { border-left: 6px solid #F16923; }
      html[data-skin="ribbon"] .wp-block-group.ll-card:nth-of-type(4n+3) { border-left: 6px solid #1A1C24; }
      html[data-skin="ribbon"] .wp-block-group.ll-card:nth-of-type(4n+4) { border-left: 6px solid #33A2B8; }

      html[data-skin="ribbon"] .home .wp-block-query .ll-post-row {
        background: rgba(9, 36, 46, 0.55);
        border-bottom: 1px solid rgba(51, 162, 184, 0.28);
        padding: 0.9rem 0.9rem;
        margin-bottom: 0.35rem;
        border-radius: 10px;
      }
      html[data-skin="ribbon"] .home .wp-block-query .ll-post-row:hover {
        background: rgba(51, 162, 184, 0.16);
      }
      html[data-skin="ribbon"] .ll-contact-item {
        background: rgba(7, 29, 37, 0.72);
        border-color: rgba(51, 162, 184, 0.32);
        color: #FAF6EE !important;
      }
      html[data-skin="ribbon"] .ll-cf-btn,
      html[data-skin="ribbon"] .ll-print-btn {
        background: #F16923;
        color: #ffffff;
        box-shadow: 0 3px 0 #a53c07;
      }
      html[data-skin="ribbon"] .ll-footer-wrap {
        background: rgba(6, 24, 31, 0.85);
        border-top-color: rgba(51, 162, 184, 0.28);
      }

      /* =====================================================================
         SKIN 03: OKB-1 RETRO (1961 Space Console, Nixie Amber & CRT Phosphor)
         ===================================================================== */
      html[data-skin="okb1"] {
        --ll-bg: #0c100d;
        --ll-surface: #141a15;
        --ll-surface-alt: #0f1410;
        --ll-dark: #f4f1df;
        --ll-text: #c8d6c5;
        --ll-muted: #7f947e;
        --ll-border: #323f32;
        --ll-accent: #ffb000;
        --ll-accent-2: #4ade80;
        --ll-accent-soft: rgba(255, 176, 0, 0.13);
        --ll-accent-border: rgba(255, 176, 0, 0.45);
        --ll-wave-cpu: #4ade80;
        --ll-wave-gpu: #ffb000;
        --ll-wave-vram: #fb7185;
      }
      html[data-skin="okb1"],
      html[data-skin="okb1"] body {
        background-color: #0c100d !important;
        background-image:
          linear-gradient(rgba(74, 222, 128, 0.04) 1px, transparent 1px),
          linear-gradient(90deg, rgba(74, 222, 128, 0.04) 1px, transparent 1px) !important;
        background-size: 28px 28px !important;
        color: #c8d6c5 !important;
      }
      /* Ultra-subtle CRT phosphor scanline mask */
      html[data-skin="okb1"] body::after {
        content: "";
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 9998;
        opacity: 0.22;
        background: repeating-linear-gradient(
          0deg,
          rgba(0, 0, 0, 0.25) 0px,
          rgba(0, 0, 0, 0.25) 1px,
          transparent 1px,
          transparent 3px
        );
      }
      html[data-skin="okb1"] #ll-read-progress {
        background: linear-gradient(90deg, #4ade80, #ffb000);
      }
      html[data-skin="okb1"] header.wp-block-template-part {
        background: rgba(14, 19, 15, 0.92) !important;
        border-bottom: 2px solid #323f32 !important;
      }
      html[data-skin="okb1"] .wp-block-site-title a {
        font-family: var(--ll-font-mono) !important;
        color: #ffb000 !important;
        text-shadow: 0 0 10px rgba(255, 176, 0, 0.35);
      }
      html[data-skin="okb1"] .wp-block-navigation a {
        font-family: var(--ll-font-mono);
        text-transform: uppercase;
        font-size: 0.78rem !important;
        color: #9bb39a !important;
      }
      html[data-skin="okb1"] .wp-block-navigation a:hover { color: #4ade80 !important; }
      html[data-skin="okb1"] .ll-lang-pill a.active {
        background: #ffb000;
        color: #0c100d !important;
      }
      html[data-skin="okb1"] h1,
      html[data-skin="okb1"] h2,
      html[data-skin="okb1"] h3 {
        font-family: var(--ll-font-mono) !important;
        letter-spacing: -0.02em;
        color: #f4f1df;
      }
      html[data-skin="okb1"] .ll-hero-card,
      html[data-skin="okb1"] .ll-terminal-card,
      html[data-skin="okb1"] .ll-focus-item,
      html[data-skin="okb1"] .ll-card {
        background: linear-gradient(180deg, #1b231b 0%, #121712 100%) !important;
        border: 1px solid #374637 !important;
        border-radius: 5px !important;
        box-shadow: inset 0 1px 0 rgba(255, 176, 0, 0.14), 5px 5px 0 #050705 !important;
      }
      html[data-skin="okb1"] .ll-focus-item {
        padding: 1.25rem;
      }
      html[data-skin="okb1"] .ll-focus-item::before {
        display: inline-block;
        font-family: var(--ll-font-mono);
        font-size: 0.7rem;
        font-weight: 700;
        color: #ffb000;
        border: 1px solid rgba(255, 176, 0, 0.45);
        background: rgba(255, 176, 0, 0.08);
        padding: 0.12rem 0.45rem;
        margin-bottom: 0.55rem;
        border-radius: 2px;
      }
      html[data-skin="okb1"] .ll-focus-item:nth-child(1)::before { content: "BAY-01 // AUTOMATION"; }
      html[data-skin="okb1"] .ll-focus-item:nth-child(2)::before { content: "BAY-02 // HARDWARE"; }
      html[data-skin="okb1"] .ll-focus-item:nth-child(3)::before { content: "BAY-03 // SIMULATION"; }
      html[data-skin="okb1"] .ll-avatar-sm {
        border-radius: 4px;
        border-color: #ffb000;
        filter: contrast(1.08) sepia(0.18);
      }
      html[data-skin="okb1"] .ll-status-inline {
        border-radius: 3px;
        background: rgba(74, 222, 128, 0.12);
        border-color: rgba(74, 222, 128, 0.45);
        color: #4ade80;
      }
      html[data-skin="okb1"] .ll-btn-solid,
      html[data-skin="okb1"] .ll-cf-btn,
      html[data-skin="okb1"] .ll-print-btn {
        background: #ffb000 !important;
        color: #0c100d !important;
        border-radius: 4px !important;
        font-family: var(--ll-font-mono);
        text-transform: uppercase;
        font-size: 0.78rem;
        letter-spacing: 0.03em;
        box-shadow: 0 3px 0 #8a5b00;
      }
      html[data-skin="okb1"] .ll-btn-outline,
      html[data-skin="okb1"] .ll-tag,
      html[data-skin="okb1"] .ll-contact-item {
        border-radius: 4px !important;
        font-family: var(--ll-font-mono);
        border-color: #374637 !important;
      }
      html[data-skin="okb1"] .ll-tag {
        background: #0d120e !important;
        color: #4ade80 !important;
      }
      html[data-skin="okb1"] .ll-sec-head {
        border-bottom: 1px dashed #3f523f;
      }
      html[data-skin="okb1"] .ll-sec-head h2::before {
        content: "▸ ";
        color: #ffb000;
      }
      html[data-skin="okb1"] .ll-bento-grid > .ll-card:nth-child(1) .ll-mono-label::before { content: "[MOD-01] "; color: #ffb000; font-weight: 700; }
      html[data-skin="okb1"] .ll-bento-grid > .ll-card:nth-child(2) .ll-mono-label::before { content: "[MOD-02] "; color: #ffb000; font-weight: 700; }
      html[data-skin="okb1"] .ll-bento-grid > .ll-card:nth-child(3) .ll-mono-label::before { content: "[MOD-03] "; color: #ffb000; font-weight: 700; }
      html[data-skin="okb1"] .ll-bento-grid > .ll-card:nth-child(4) .ll-mono-label::before { content: "[MOD-04] "; color: #ffb000; font-weight: 700; }
      html[data-skin="okb1"] .ll-cf-form input,
      html[data-skin="okb1"] .ll-cf-form textarea,
      html[data-skin="okb1"] .ll-twin-input,
      html[data-skin="okb1"] #ll-arch-input {
        background: #0a0e0b !important;
        color: #f4f1df !important;
        border-color: #374637 !important;
        border-radius: 4px !important;
        font-family: var(--ll-font-mono);
      }
      html[data-skin="okb1"] .ll-cf-form input::placeholder,
      html[data-skin="okb1"] .ll-cf-form textarea::placeholder { color: #677b67 !important; }
      html[data-skin="okb1"] .ll-cat-pill,
      html[data-skin="okb1"] .ll-toc {
        border-radius: 4px !important;
        background: #141a15;
        border-color: #374637;
      }
      html[data-skin="okb1"] .ll-cat-pill.active {
        background: #ffb000;
        color: #0c100d !important;
        border-color: #ffb000;
      }
      html[data-skin="okb1"] #ll-wave-canvas {
        background: radial-gradient(circle at 50% 50%, #0d1f12 0%, #060e08 100%) !important;
        border: 1px solid #2e4c34 !important;
      }
      html[data-skin="okb1"] .home .wp-block-query .ll-post-row {
        border-bottom: 1px dashed #323f32;
        border-radius: 3px;
      }
      html[data-skin="okb1"] .ll-term-cta a,
      html[data-skin="okb1"] #ll-wp-val { color: #4ade80 !important; }
      html[data-skin="okb1"] .ll-term-input-row span { color: #ffb000 !important; }
      html[data-skin="okb1"] .ll-footer-wrap {
        background: #090d0a;
        border-top: 2px solid #323f32;
        font-family: var(--ll-font-mono);
      }

      /* =====================================================================
         SKIN 04: CYBERPUNK 2077 / NETRUNNER HUD
         ===================================================================== */
      html[data-skin="cyberpunk"] {
        --ll-bg: #07060c;
        --ll-surface: #0f0d1b;
        --ll-surface-alt: #161128;
        --ll-dark: #f8fafc;
        --ll-text: #d7e3fc;
        --ll-muted: #7dd3fc;
        --ll-border: rgba(0, 240, 255, 0.34);
        --ll-accent: #fcee09;
        --ll-accent-2: #ff0055;
        --ll-accent-soft: rgba(252, 238, 9, 0.14);
        --ll-accent-border: rgba(252, 238, 9, 0.55);
        --ll-wave-cpu: #00f0ff;
        --ll-wave-gpu: #fcee09;
        --ll-wave-vram: #ff0055;
      }
      html[data-skin="cyberpunk"],
      html[data-skin="cyberpunk"] body {
        background-color: #07060c !important;
        background-image:
          radial-gradient(ellipse at 18% 0%, rgba(255, 0, 85, 0.14) 0%, transparent 45%),
          radial-gradient(ellipse at 85% 15%, rgba(0, 240, 255, 0.12) 0%, transparent 48%),
          repeating-linear-gradient(-45deg, rgba(252, 238, 9, 0.025) 0 1px, transparent 1px 22px) !important;
        color: #d7e3fc !important;
      }
      html[data-skin="cyberpunk"] #ll-read-progress {
        background: linear-gradient(90deg, #ff0055, #fcee09, #00f0ff);
      }
      html[data-skin="cyberpunk"] header.wp-block-template-part {
        background: rgba(7, 6, 12, 0.90) !important;
        border-bottom: 2px solid #fcee09 !important;
      }
      html[data-skin="cyberpunk"] .wp-block-site-title a {
        font-family: var(--ll-font-mono) !important;
        color: #fcee09 !important;
        text-shadow: 2px 0 #ff0055, -1px 0 #00f0ff;
      }
      html[data-skin="cyberpunk"] .wp-block-navigation a {
        font-family: var(--ll-font-mono);
        text-transform: uppercase;
        font-size: 0.78rem !important;
        color: #93c5fd !important;
      }
      html[data-skin="cyberpunk"] .wp-block-navigation a:hover { color: #fcee09 !important; }
      html[data-skin="cyberpunk"] .ll-lang-pill a.active {
        background: #fcee09;
        color: #07060c !important;
      }
      html[data-skin="cyberpunk"] .ll-hero-card,
      html[data-skin="cyberpunk"] .ll-terminal-card,
      html[data-skin="cyberpunk"] .ll-focus-item,
      html[data-skin="cyberpunk"] .ll-card {
        background: linear-gradient(160deg, #131024 0%, #0a0814 100%) !important;
        border: 1px solid rgba(0, 240, 255, 0.38) !important;
        border-radius: 2px !important;
        clip-path: polygon(0 0, calc(100% - 16px) 0, 100% 16px, 100% 100%, 16px 100%, 0 calc(100% - 16px));
        box-shadow: inset 0 1px 0 rgba(252, 238, 9, 0.25), 0 0 22px rgba(0, 240, 255, 0.08) !important;
      }
      html[data-skin="cyberpunk"] .ll-focus-item { padding: 1.25rem; }
      html[data-skin="cyberpunk"] .ll-focus-item::before,
      html[data-skin="cyberpunk"] .ll-bento-grid > .ll-card .ll-mono-label::before {
        display: inline-block;
        font-family: var(--ll-font-mono);
        font-size: 0.68rem;
        font-weight: 800;
        color: #07060c;
        background: #fcee09;
        padding: 0.1rem 0.42rem;
        margin-bottom: 0.45rem;
        margin-right: 0.45rem;
        clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 0 100%);
      }
      html[data-skin="cyberpunk"] .ll-focus-item:nth-child(1)::before { content: "ICE // 01"; }
      html[data-skin="cyberpunk"] .ll-focus-item:nth-child(2)::before { content: "DAEMON // 02"; background: #00f0ff; }
      html[data-skin="cyberpunk"] .ll-focus-item:nth-child(3)::before { content: "BREACH // 03"; background: #ff0055; color: #ffffff; }
      html[data-skin="cyberpunk"] .ll-bento-grid > .ll-card:nth-child(1) .ll-mono-label::before { content: "NET-01"; }
      html[data-skin="cyberpunk"] .ll-bento-grid > .ll-card:nth-child(2) .ll-mono-label::before { content: "NET-02"; background: #00f0ff; }
      html[data-skin="cyberpunk"] .ll-bento-grid > .ll-card:nth-child(3) .ll-mono-label::before { content: "NET-03"; background: #ff0055; color: #ffffff; }
      html[data-skin="cyberpunk"] .ll-bento-grid > .ll-card:nth-child(4) .ll-mono-label::before { content: "NET-04"; }
      html[data-skin="cyberpunk"] .ll-avatar-sm {
        border-radius: 4px;
        border-color: #fcee09;
        box-shadow: 3px 3px 0 #ff0055;
      }
      html[data-skin="cyberpunk"] .ll-status-inline {
        background: rgba(255, 0, 85, 0.16);
        border-color: #ff0055;
        color: #ff5c93;
      }
      html[data-skin="cyberpunk"] .ll-btn-solid,
      html[data-skin="cyberpunk"] .ll-cf-btn,
      html[data-skin="cyberpunk"] .ll-print-btn {
        background: #fcee09 !important;
        color: #07060c !important;
        border-radius: 2px !important;
        font-family: var(--ll-font-mono);
        text-transform: uppercase;
        font-weight: 800;
        clip-path: polygon(0 0, 100% 0, 100% calc(100% - 8px), calc(100% - 8px) 100%, 0 100%);
        box-shadow: 0 0 14px rgba(252, 238, 9, 0.35);
      }
      html[data-skin="cyberpunk"] .ll-btn-outline {
        border-color: #00f0ff !important;
        color: #00f0ff !important;
        border-radius: 2px !important;
      }
      html[data-skin="cyberpunk"] .ll-tag {
        background: rgba(0, 240, 255, 0.08) !important;
        border-color: rgba(0, 240, 255, 0.35) !important;
        color: #7dd3fc !important;
      }
      html[data-skin="cyberpunk"] .ll-sec-head { border-bottom: 1px solid #ff0055; }
      html[data-skin="cyberpunk"] .ll-sec-head h2 {
        font-family: var(--ll-font-mono) !important;
        text-transform: uppercase;
        color: #fcee09 !important;
      }
      html[data-skin="cyberpunk"] .home .wp-block-query .ll-post-row { border-bottom-color: rgba(0, 240, 255, 0.22); }
      html[data-skin="cyberpunk"] .ll-cf-form input,
      html[data-skin="cyberpunk"] .ll-cf-form textarea,
      html[data-skin="cyberpunk"] .ll-twin-input,
      html[data-skin="cyberpunk"] #ll-arch-input {
        background: #07060c !important; color: #f8fafc !important; border-color: rgba(0, 240, 255, 0.4) !important;
      }
      html[data-skin="cyberpunk"] .ll-footer-wrap { background: #050409; border-top: 2px solid #ff0055; }

      /* =====================================================================
         SKIN 05: JAPAN WASHI / UKIYO-E WOODBLOCK
         ===================================================================== */
      html[data-skin="japan"] {
        --ll-bg: #f4ede0;
        --ll-surface: #fbf7ed;
        --ll-surface-alt: #ece3d1;
        --ll-dark: #1c1917;
        --ll-text: #292524;
        --ll-muted: #6b635b;
        --ll-border: #d5c7b0;
        --ll-accent: #c8281c;
        --ll-accent-2: #1e3a5f;
        --ll-accent-soft: rgba(200, 40, 28, 0.09);
        --ll-accent-border: rgba(200, 40, 28, 0.38);
        --ll-wave-cpu: #38bdf8;
        --ll-wave-gpu: #ef4444;
        --ll-wave-vram: #f59e0b;
      }
      html[data-skin="japan"],
      html[data-skin="japan"] body {
        background-color: #f4ede0 !important;
        background-image:
          linear-gradient(rgba(30, 58, 95, 0.035) 1px, transparent 1px),
          linear-gradient(90deg, rgba(30, 58, 95, 0.035) 1px, transparent 1px) !important;
        background-size: 44px 44px !important;
        color: #292524 !important;
      }
      html[data-skin="japan"] #ll-read-progress { background: linear-gradient(90deg, #1e3a5f, #c8281c); }
      html[data-skin="japan"] header.wp-block-template-part {
        background: rgba(244, 237, 224, 0.90) !important;
        border-bottom: 1.5px solid #c9b99e !important;
      }
      html[data-skin="japan"] h1,
      html[data-skin="japan"] h2,
      html[data-skin="japan"] h3 {
        font-family: Georgia, "Times New Roman", serif !important;
        letter-spacing: -0.01em;
      }
      html[data-skin="japan"] .wp-block-site-title a {
        font-family: Georgia, serif !important;
        color: #1e3a5f !important;
      }
      html[data-skin="japan"] .ll-lang-pill a.active {
        background: #c8281c;
        color: #fbf7ed !important;
      }
      html[data-skin="japan"] .ll-hero-card,
      html[data-skin="japan"] .ll-card {
        background: #fbf7ed !important;
        border: 1.5px solid #cbbba0 !important;
        border-radius: 6px !important;
        box-shadow: 4px 4px 0 rgba(30, 58, 95, 0.12) !important;
      }
      html[data-skin="japan"] .ll-terminal-card {
        background: #171c22 !important;
        border: 1.5px solid #1e3a5f !important;
        border-radius: 6px !important;
        box-shadow: 4px 4px 0 rgba(200, 40, 28, 0.25) !important;
      }
      html[data-skin="japan"] .ll-focus-item {
        background: #fbf7ed;
        border: 1.5px solid #cbbba0;
        border-top: 4px solid #1e3a5f;
        border-radius: 6px;
        padding: 1.25rem;
      }
      /* Vermilion Hanko seal stamp badges */
      html[data-skin="japan"] .ll-focus-item::before,
      html[data-skin="japan"] .ll-bento-grid > .ll-card .ll-mono-label::before {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #c8281c;
        color: #c8281c;
        background: rgba(200, 40, 28, 0.06);
        font-family: Georgia, serif;
        font-weight: 700;
        font-size: 0.78rem;
        padding: 0.08rem 0.4rem;
        border-radius: 3px;
        margin-bottom: 0.45rem;
        margin-right: 0.45rem;
      }
      html[data-skin="japan"] .ll-focus-item:nth-child(1)::before { content: "印 · 壱"; }
      html[data-skin="japan"] .ll-focus-item:nth-child(2)::before { content: "印 · 弐"; }
      html[data-skin="japan"] .ll-focus-item:nth-child(3)::before { content: "印 · 参"; }
      html[data-skin="japan"] .ll-bento-grid > .ll-card:nth-child(1) .ll-mono-label::before { content: "壱"; }
      html[data-skin="japan"] .ll-bento-grid > .ll-card:nth-child(2) .ll-mono-label::before { content: "弐"; }
      html[data-skin="japan"] .ll-bento-grid > .ll-card:nth-child(3) .ll-mono-label::before { content: "参"; }
      html[data-skin="japan"] .ll-bento-grid > .ll-card:nth-child(4) .ll-mono-label::before { content: "肆"; }
      html[data-skin="japan"] .ll-avatar-sm {
        border-color: #c8281c;
        filter: sepia(0.18) contrast(1.04);
      }
      html[data-skin="japan"] .ll-status-inline {
        background: rgba(30, 58, 95, 0.08);
        border-color: rgba(30, 58, 95, 0.35);
        color: #1e3a5f;
      }
      html[data-skin="japan"] .ll-btn-solid,
      html[data-skin="japan"] .ll-cf-btn,
      html[data-skin="japan"] .ll-print-btn {
        background: #c8281c !important;
        color: #fbf7ed !important;
        border-radius: 4px !important;
      }
      html[data-skin="japan"] .ll-sec-head { border-bottom: 1.5px solid #1e3a5f; }
      html[data-skin="japan"] .ll-tag { background: #eee5d3; border-color: #d0bfa4; color: #1e3a5f; }
      html[data-skin="japan"] .ll-footer-wrap { background: #eae0ce; border-top: 1.5px solid #c9b99e; }

      /* =====================================================================
         SKIN 06: 80s CHINA / HONG KONG KOWLOON NEON
         ===================================================================== */
      html[data-skin="china80"] {
        --ll-bg: #110614;
        --ll-surface: #1d0914;
        --ll-surface-alt: #280c1a;
        --ll-dark: #fff7e6;
        --ll-text: #f3dfd6;
        --ll-muted: #e2b87e;
        --ll-border: rgba(251, 191, 36, 0.32);
        --ll-accent: #ff2e4c;
        --ll-accent-2: #10d98c;
        --ll-accent-soft: rgba(255, 46, 76, 0.16);
        --ll-accent-border: rgba(251, 191, 36, 0.50);
        --ll-wave-cpu: #10d98c;
        --ll-wave-gpu: #fbbf24;
        --ll-wave-vram: #ff2e4c;
      }
      html[data-skin="china80"],
      html[data-skin="china80"] body {
        background-color: #110614 !important;
        background-image:
          radial-gradient(ellipse at 20% 0%, rgba(255, 46, 76, 0.18) 0%, transparent 45%),
          radial-gradient(ellipse at 85% 15%, rgba(16, 217, 140, 0.14) 0%, transparent 48%),
          linear-gradient(180deg, #120615 0%, #1c0813 100%) !important;
        color: #f3dfd6 !important;
      }
      html[data-skin="china80"] #ll-read-progress { background: linear-gradient(90deg, #ff2e4c, #fbbf24, #10d98c); }
      html[data-skin="china80"] header.wp-block-template-part {
        background: rgba(17, 6, 20, 0.90) !important;
        border-bottom: 2px solid rgba(251, 191, 36, 0.45) !important;
      }
      html[data-skin="china80"] .wp-block-site-title a {
        color: #fbbf24 !important;
        text-shadow: 0 0 12px rgba(255, 46, 76, 0.65);
      }
      html[data-skin="china80"] .wp-block-navigation a { color: #f6cfa0 !important; }
      html[data-skin="china80"] .wp-block-navigation a:hover { color: #10d98c !important; }
      html[data-skin="china80"] .ll-lang-pill a.active {
        background: #fbbf24;
        color: #1d0914 !important;
      }
      html[data-skin="china80"] .ll-hero-card,
      html[data-skin="china80"] .ll-terminal-card,
      html[data-skin="china80"] .ll-focus-item,
      html[data-skin="china80"] .ll-card {
        background: linear-gradient(180deg, #250b18 0%, #150711 100%) !important;
        border: 1.5px solid #fbbf24 !important;
        border-radius: 8px !important;
        box-shadow: inset 0 0 0 3px rgba(255, 46, 76, 0.22), 0 0 22px rgba(255, 46, 76, 0.16) !important;
      }
      html[data-skin="china80"] .ll-focus-item { padding: 1.25rem; }
      html[data-skin="china80"] .ll-focus-item::before,
      html[data-skin="china80"] .ll-bento-grid > .ll-card .ll-mono-label::before {
        display: inline-block;
        padding: 0.12rem 0.48rem;
        border-radius: 4px;
        border: 1px solid #10d98c;
        color: #10d98c;
        background: rgba(16, 217, 140, 0.10);
        font-family: var(--ll-font-mono);
        font-size: 0.72rem;
        font-weight: 700;
        text-shadow: 0 0 8px rgba(16, 217, 140, 0.45);
        margin-bottom: 0.45rem;
        margin-right: 0.45rem;
      }
      html[data-skin="china80"] .ll-focus-item:nth-child(1)::before { content: "壹 · 1984"; }
      html[data-skin="china80"] .ll-focus-item:nth-child(2)::before { content: "貳 · 1986"; border-color: #fbbf24; color: #fbbf24; }
      html[data-skin="china80"] .ll-focus-item:nth-child(3)::before { content: "參 · 1988"; border-color: #ff2e4c; color: #ff6b81; }
      html[data-skin="china80"] .ll-bento-grid > .ll-card:nth-child(1) .ll-mono-label::before { content: "壹 · NEON"; }
      html[data-skin="china80"] .ll-bento-grid > .ll-card:nth-child(2) .ll-mono-label::before { content: "貳 · GOLD"; border-color: #fbbf24; color: #fbbf24; }
      html[data-skin="china80"] .ll-bento-grid > .ll-card:nth-child(3) .ll-mono-label::before { content: "參 · LASER"; border-color: #ff2e4c; color: #ff6b81; }
      html[data-skin="china80"] .ll-bento-grid > .ll-card:nth-child(4) .ll-mono-label::before { content: "肆 · ARCADE"; }
      html[data-skin="china80"] .ll-avatar-sm { border-color: #fbbf24; box-shadow: 0 0 12px rgba(255, 46, 76, 0.45); }
      html[data-skin="china80"] .ll-status-inline {
        background: rgba(16, 217, 140, 0.14);
        border-color: #10d98c;
        color: #10d98c;
      }
      html[data-skin="china80"] .ll-btn-solid,
      html[data-skin="china80"] .ll-cf-btn,
      html[data-skin="china80"] .ll-print-btn {
        background: #ff2e4c !important;
        color: #fff7e6 !important;
        border: 1px solid #fbbf24;
        box-shadow: 0 0 14px rgba(255, 46, 76, 0.4);
      }
      html[data-skin="china80"] .ll-sec-head { border-bottom: 1px solid rgba(251, 191, 36, 0.45); }
      html[data-skin="china80"] .ll-sec-head h2 { color: #fbbf24 !important; }
      html[data-skin="china80"] .ll-tag { background: rgba(251, 191, 36, 0.10); border-color: rgba(251, 191, 36, 0.35); color: #fde68a; }
      html[data-skin="china80"] .ll-cf-form input,
      html[data-skin="china80"] .ll-cf-form textarea,
      html[data-skin="china80"] .ll-twin-input,
      html[data-skin="china80"] #ll-arch-input {
        background: #120610 !important; color: #fff7e6 !important; border-color: rgba(251, 191, 36, 0.45) !important;
      }
      html[data-skin="china80"] .ll-footer-wrap { background: #0c040e; border-top: 2px solid rgba(251, 191, 36, 0.4); }

      /* =====================================================================
         SKIN 07: FALLOUT ROBCO PIP-BOY 3000 CRT
         ===================================================================== */
      html[data-skin="fallout"] {
        --ll-bg: #040d05;
        --ll-surface: #071609;
        --ll-surface-alt: #0b210d;
        --ll-dark: #4eff9f;
        --ll-text: #22e377;
        --ll-muted: #14a353;
        --ll-border: rgba(34, 255, 136, 0.42);
        --ll-accent: #22ff88;
        --ll-accent-2: #86efac;
        --ll-accent-soft: rgba(34, 255, 136, 0.15);
        --ll-accent-border: rgba(34, 255, 136, 0.55);
        --ll-wave-cpu: #6ee7b7;
        --ll-wave-gpu: #22ff88;
        --ll-wave-vram: #10b981;
      }
      html[data-skin="fallout"],
      html[data-skin="fallout"] body {
        background-color: #040d05 !important;
        background-image: radial-gradient(circle at 50% 25%, #0c270f 0%, #030a04 82%) !important;
        color: #22e377 !important;
        font-family: var(--ll-font-mono) !important;
      }
      html[data-skin="fallout"] body::after {
        content: "";
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 9998;
        opacity: 0.24;
        background: repeating-linear-gradient(
          0deg,
          rgba(0, 0, 0, 0.35) 0 1px,
          rgba(34, 255, 136, 0.04) 1px 3px
        );
      }
      html[data-skin="fallout"] #ll-read-progress { background: #22ff88; box-shadow: 0 0 8px #22ff88; }
      html[data-skin="fallout"] header.wp-block-template-part {
        background: rgba(4, 13, 5, 0.94) !important;
        border-bottom: 2px solid #22ff88 !important;
      }
      html[data-skin="fallout"] h1,
      html[data-skin="fallout"] h2,
      html[data-skin="fallout"] h3,
      html[data-skin="fallout"] p,
      html[data-skin="fallout"] a {
        font-family: var(--ll-font-mono) !important;
      }
      html[data-skin="fallout"] .wp-block-site-title a {
        color: #4eff9f !important;
        text-shadow: 0 0 10px rgba(34, 255, 136, 0.55);
      }
      html[data-skin="fallout"] .wp-block-navigation a { color: #22e377 !important; text-transform: uppercase; font-size: 0.78rem !important; }
      html[data-skin="fallout"] .ll-lang-pill { border-color: #22ff88; background: #040d05; }
      html[data-skin="fallout"] .ll-lang-pill a { color: #22e377 !important; }
      html[data-skin="fallout"] .ll-lang-pill a.active { background: #22ff88; color: #040d05 !important; }
      html[data-skin="fallout"] .ll-hero-card,
      html[data-skin="fallout"] .ll-terminal-card,
      html[data-skin="fallout"] .ll-focus-item,
      html[data-skin="fallout"] .ll-card {
        background: rgba(7, 22, 9, 0.92) !important;
        border: 2px solid rgba(34, 255, 136, 0.52) !important;
        border-radius: 3px !important;
        box-shadow: inset 0 0 24px rgba(34, 255, 136, 0.07) !important;
      }
      html[data-skin="fallout"] .ll-focus-item { padding: 1.25rem; }
      html[data-skin="fallout"] .ll-focus-item::before,
      html[data-skin="fallout"] .ll-bento-grid > .ll-card .ll-mono-label::before {
        display: inline-block;
        background: #22ff88;
        color: #040d05;
        font-weight: 800;
        font-size: 0.7rem;
        padding: 0.08rem 0.42rem;
        margin-bottom: 0.45rem;
        margin-right: 0.45rem;
      }
      html[data-skin="fallout"] .ll-focus-item:nth-child(1)::before { content: "[V.A.T.S. // 01]"; }
      html[data-skin="fallout"] .ll-focus-item:nth-child(2)::before { content: "[S.P.E.C.I.A.L. // 02]"; }
      html[data-skin="fallout"] .ll-focus-item:nth-child(3)::before { content: "[HOLOTAPE // 03]"; }
      html[data-skin="fallout"] .ll-bento-grid > .ll-card:nth-child(1) .ll-mono-label::before { content: "[PIP-01]"; }
      html[data-skin="fallout"] .ll-bento-grid > .ll-card:nth-child(2) .ll-mono-label::before { content: "[PIP-02]"; }
      html[data-skin="fallout"] .ll-bento-grid > .ll-card:nth-child(3) .ll-mono-label::before { content: "[PIP-03]"; }
      html[data-skin="fallout"] .ll-bento-grid > .ll-card:nth-child(4) .ll-mono-label::before { content: "[PIP-04]"; }
      html[data-skin="fallout"] .ll-avatar-sm {
        border-radius: 3px;
        border-color: #22ff88;
        filter: grayscale(100%) sepia(100%) hue-rotate(84deg) saturate(2.5) contrast(1.18);
      }
      html[data-skin="fallout"] .ll-btn-solid,
      html[data-skin="fallout"] .ll-cf-btn,
      html[data-skin="fallout"] .ll-print-btn {
        background: #22ff88 !important;
        color: #040d05 !important;
        border-radius: 2px !important;
        font-weight: 800;
        text-transform: uppercase;
      }
      html[data-skin="fallout"] .ll-btn-outline,
      html[data-skin="fallout"] .ll-tag,
      html[data-skin="fallout"] .ll-contact-item {
        border-color: rgba(34, 255, 136, 0.45) !important;
        color: #4eff9f !important;
        background: rgba(34, 255, 136, 0.06) !important;
        border-radius: 2px !important;
      }
      html[data-skin="fallout"] .ll-sec-head { border-bottom: 2px solid #22ff88; }
      html[data-skin="fallout"] .ll-sec-head h2::before { content: "ROBCO> "; }
      html[data-skin="fallout"] #ll-wave-canvas {
        background: #020803 !important;
        border: 1.5px solid #22ff88 !important;
      }
      html[data-skin="fallout"] .ll-cf-form input,
      html[data-skin="fallout"] .ll-cf-form textarea,
      html[data-skin="fallout"] .ll-twin-input,
      html[data-skin="fallout"] #ll-arch-input {
        background: #020803 !important; color: #4eff9f !important; border-color: #22ff88 !important;
      }
      html[data-skin="fallout"] .ll-footer-wrap { background: #030904; border-top: 2px solid #22ff88; }

      /* =====================================================================
         SKIN 08: BAUHAUS / SWISS NEO-BRUTALIST POSTER
         ===================================================================== */
      html[data-skin="bauhaus"] {
        --ll-bg: #f3efe4;
        --ll-surface: #ffffff;
        --ll-surface-alt: #ffe699;
        --ll-dark: #09090b;
        --ll-text: #18181b;
        --ll-muted: #404046;
        --ll-border: #09090b;
        --ll-accent: #e63946;
        --ll-accent-2: #1d4ed8;
        --ll-accent-soft: #fde047;
        --ll-accent-border: #09090b;
        --ll-wave-cpu: #ffb703;
        --ll-wave-gpu: #e63946;
        --ll-wave-vram: #38bdf8;
      }
      html[data-skin="bauhaus"],
      html[data-skin="bauhaus"] body {
        background-color: #f3efe4 !important;
        color: #18181b !important;
      }
      html[data-skin="bauhaus"] #ll-read-progress { height: 4px; background: linear-gradient(90deg, #e63946, #ffb703, #1d4ed8); }
      html[data-skin="bauhaus"] header.wp-block-template-part {
        background: #f3efe4 !important;
        border-bottom: 3px solid #09090b !important;
      }
      html[data-skin="bauhaus"] .ll-lang-pill,
      html[data-skin="bauhaus"] .ll-theme-btn,
      html[data-skin="bauhaus"] .ll-skin-btn {
        border: 2px solid #09090b !important;
        border-radius: 2px !important;
        box-shadow: 2px 2px 0 #09090b;
      }
      html[data-skin="bauhaus"] .ll-lang-pill a.active { background: #e63946; color: #ffffff !important; }
      html[data-skin="bauhaus"] .ll-hero-card,
      html[data-skin="bauhaus"] .ll-terminal-card,
      html[data-skin="bauhaus"] .ll-focus-item,
      html[data-skin="bauhaus"] .ll-card {
        border: 2.5px solid #09090b !important;
        border-radius: 3px !important;
        box-shadow: 6px 6px 0 #09090b !important;
      }
      html[data-skin="bauhaus"] .ll-focus-item { padding: 1.25rem; background: #ffffff; }
      html[data-skin="bauhaus"] .ll-focus-item:nth-child(2) { background: #ffb703; }
      html[data-skin="bauhaus"] .ll-focus-item:nth-child(3) { background: #dbeafe; }
      html[data-skin="bauhaus"] .ll-bento-grid > .ll-card:nth-child(1) { background: #ffffff !important; }
      html[data-skin="bauhaus"] .ll-bento-grid > .ll-card:nth-child(2) { background: #ffb703 !important; }
      html[data-skin="bauhaus"] .ll-bento-grid > .ll-card:nth-child(3) { background: #e63946 !important; }
      html[data-skin="bauhaus"] .ll-bento-grid > .ll-card:nth-child(3) h3 a,
      html[data-skin="bauhaus"] .ll-bento-grid > .ll-card:nth-child(3) p,
      html[data-skin="bauhaus"] .ll-bento-grid > .ll-card:nth-child(3) .ll-mono-label { color: #ffffff !important; }
      html[data-skin="bauhaus"] .ll-bento-grid > .ll-card:nth-child(4) { background: #1d4ed8 !important; }
      html[data-skin="bauhaus"] .ll-bento-grid > .ll-card:nth-child(4) h3 a,
      html[data-skin="bauhaus"] .ll-bento-grid > .ll-card:nth-child(4) p,
      html[data-skin="bauhaus"] .ll-bento-grid > .ll-card:nth-child(4) .ll-mono-label { color: #ffffff !important; }
      html[data-skin="bauhaus"] .ll-btn-solid,
      html[data-skin="bauhaus"] .ll-cf-btn,
      html[data-skin="bauhaus"] .ll-print-btn {
        background: #e63946 !important;
        color: #ffffff !important;
        border: 2px solid #09090b;
        border-radius: 2px !important;
        box-shadow: 3px 3px 0 #09090b;
      }
      html[data-skin="bauhaus"] .ll-btn-outline,
      html[data-skin="bauhaus"] .ll-tag {
        border: 1.5px solid #09090b !important;
        border-radius: 2px !important;
        background: #ffffff !important;
        color: #09090b !important;
      }
      html[data-skin="bauhaus"] .ll-sec-head { border-bottom: 3px solid #09090b; }
      html[data-skin="bauhaus"] .ll-sec-head h2 { font-weight: 800 !important; text-transform: uppercase; }
      html[data-skin="bauhaus"] .ll-footer-wrap { background: #e8e2d3; border-top: 3px solid #09090b; }

      /* =====================================================================
         SWARM MORPH TRANSITION STAGE (Figma Rulers, Red Guides, Cursors)
         ===================================================================== */
      #ll-swarm-stage {
        position: fixed;
        inset: 0;
        z-index: 99990;
        pointer-events: none;
        overflow: hidden;
      }
      .ll-sw-ruler-top,
      .ll-sw-ruler-left {
        position: absolute;
        background: rgba(15, 23, 42, 0.88);
        color: rgba(248, 250, 252, 0.65);
        font-family: var(--ll-font-mono);
        font-size: 9px;
        line-height: 1;
        transition: opacity 0.22s ease, transform 0.26s cubic-bezier(0.22, 1, 0.36, 1);
      }
      .ll-sw-ruler-top {
        top: 0; left: 18px; right: 0; height: 18px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.14);
        background-image: repeating-linear-gradient(90deg, rgba(255,255,255,0.22) 0 1px, transparent 1px 16px);
        transform: translateY(-18px);
      }
      .ll-sw-ruler-left {
        top: 18px; left: 0; bottom: 0; width: 18px;
        border-right: 1px solid rgba(255, 255, 255, 0.14);
        background-image: repeating-linear-gradient(0deg, rgba(255,255,255,0.22) 0 1px, transparent 1px 16px);
        transform: translateX(-18px);
      }
      .ll-sw-ruler-top.on { transform: translateY(0); }
      .ll-sw-ruler-left.on { transform: translateX(0); }

      .ll-sw-guide-h,
      .ll-sw-guide-v {
        position: absolute;
        background: #F24822;
        opacity: 0;
        transition: opacity 0.2s ease, transform 0.45s cubic-bezier(0.22, 1, 0.36, 1);
      }
      .ll-sw-guide-h { left: 18px; right: 0; height: 1px; }
      .ll-sw-guide-v { top: 18px; bottom: 0; width: 1px; }

      .ll-sw-veil {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.24s ease;
        will-change: opacity;
      }
      .ll-sw-tile {
        position: absolute;
        border: 1.5px dashed rgba(13, 153, 255, 0.42);
        background: rgba(13, 153, 255, 0.04);
        border-radius: 12px;
        box-sizing: border-box;
        transition: opacity 0.22s ease;
        overflow: hidden;
      }
      .ll-sw-tile::before {
        content: "";
        position: absolute;
        left: 16px;
        top: 16px;
        width: 42%;
        height: 10px;
        border-radius: 4px;
        background: rgba(13, 153, 255, 0.16);
      }
      .ll-sw-tile::after {
        content: "";
        position: absolute;
        left: 16px;
        right: 16px;
        top: 38px;
        height: 8px;
        border-radius: 4px;
        background: rgba(13, 153, 255, 0.09);
      }
      .ll-sw-box {
        position: absolute;
        top: 0;
        left: 0;
        box-sizing: border-box;
        pointer-events: none;
        will-change: transform, opacity;
      }
      .ll-sw-box-rect {
        position: absolute;
        inset: 0;
        border: 2px solid #0D99FF;
        background: rgba(13, 153, 255, 0.08);
        border-radius: 10px;
        transform-origin: 0 0;
        will-change: transform;
      }
      .ll-sw-dim {
        position: absolute;
        top: 0;
        left: 0;
        background: #0D99FF;
        color: #ffffff;
        font-family: var(--ll-font-mono);
        font-size: 10px;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 4px;
        white-space: nowrap;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        will-change: transform;
      }

      .ll-sw-cursor {
        position: absolute;
        top: 0;
        left: 0;
        will-change: transform, opacity;
      }
      .ll-sw-skip {
        position: fixed;
        bottom: 16px;
        right: 16px;
        pointer-events: auto;
        background: rgba(15, 23, 42, 0.85);
        color: #f8fafc;
        border: 1px solid rgba(255, 255, 255, 0.22);
        border-radius: 999px;
        padding: 4px 12px;
        font-family: var(--ll-font-mono);
        font-size: 11px;
        cursor: pointer;
      }
      .ll-sw-tag {
        display: inline-block;
        margin-left: 14px;
        margin-top: -4px;
        padding: 2px 7px;
        border-radius: 999px;
        font-family: var(--ll-font-mono);
        font-size: 10px;
        font-weight: 700;
        color: #ffffff;
        white-space: nowrap;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
      }
      @media (max-width: 640px) {
        .ll-sw-tag { font-size: 9px; padding: 1px 5px; }
      }

      /* Floating Bottom-Left Ambient Oscilloscope Card (hidden on Editorial default) */
      .ll-amb-pill {
        position: fixed;
        left: 16px;
        bottom: 16px;
        z-index: 180;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 0.42rem;
        width: 248px;
        padding: 0.46rem 0.56rem 0.5rem;
        border-radius: 14px;
        background: var(--ll-surface);
        color: var(--ll-dark);
        border: 1px solid var(--ll-border);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.34);
        font-family: var(--ll-font-mono);
        font-size: 0.72rem;
        max-width: calc(100vw - 24px);
        transition: opacity 0.2s ease, transform 0.2s ease, border-color 0.2s ease;
      }
      .ll-amb-pill[hidden] { display: none !important; }
      .ll-amb-pill.playing { border-color: color-mix(in srgb, var(--ll-accent) 45%, var(--ll-border)); }
      .ll-amb-wave {
        display: block;
        width: 100%;
        height: 46px;
        border-radius: 9px;
        background: rgba(0, 0, 0, 0.28);
        border: 1px solid var(--ll-border);
      }
      .ll-amb-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.45rem;
        min-width: 0;
      }
      .ll-amb-track {
        display: inline-flex;
        align-items: center;
        gap: 0.32rem;
        min-width: 0;
        flex: 1;
      }
      .ll-amb-icon {
        color: var(--ll-accent);
        flex-shrink: 0;
        font-size: 0.8rem;
      }
      .ll-amb-label {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-weight: 600;
        font-size: 0.72rem;
      }
      .ll-amb-btn {
        background: var(--ll-surface-alt);
        color: var(--ll-dark);
        border: 1px solid var(--ll-border);
        border-radius: 999px;
        padding: 3px 9px;
        font-family: var(--ll-font-mono);
        font-size: 0.68rem;
        font-weight: 600;
        cursor: pointer;
        flex-shrink: 0;
        white-space: nowrap;
        transition: border-color 0.16s ease, color 0.16s ease, opacity 0.16s ease;
      }
      .ll-amb-btn:hover { border-color: var(--ll-accent); }
      .ll-amb-btn.is-off { opacity: 0.78; }
      @media (max-width: 640px) {
        .ll-amb-pill {
          left: 10px;
          bottom: 10px;
          width: min(214px, calc(100vw - 24px));
          padding: 0.36rem 0.46rem 0.42rem;
          gap: 0.34rem;
        }
        .ll-amb-wave { height: 36px; }
        .ll-amb-label { font-size: 0.68rem; }
        .ll-amb-btn { padding: 2px 7px; font-size: 0.64rem; }
      }
      .ll-skin-icon-btn.on {
        border-color: var(--ll-accent);
        color: var(--ll-accent);
      }
    </style>
    <?php
}, 20);

/**
 * Output Client-Side Skin Controller + Swarm Morph Engine + Web Audio Synth in footer.
 */
add_action('wp_footer', function () {
    $skins = ll_get_skins_registry();
    $lang = function_exists('ll_detect_lang') ? ll_detect_lang() : 'uk';
    ?>
    <div id="ll-amb-pill" class="ll-amb-pill" hidden>
      <canvas id="ll-amb-wave" class="ll-amb-wave" width="228" height="48" aria-hidden="true"></canvas>
      <div class="ll-amb-meta">
        <span class="ll-amb-track"><span class="ll-amb-icon" aria-hidden="true">♫</span><span class="ll-amb-label" id="ll-amb-label">Ambient</span></span>
        <button type="button" id="ll-amb-pill-btn" class="ll-amb-btn" aria-label="Toggle Ambient">🔇 Вимк</button>
      </div>
    </div>
    <script>
      (function() {
        var SKINS = <?php echo wp_json_encode($skins); ?>;
        var LANG = <?php echo wp_json_encode($lang); ?>;
        var CURSOR_COLORS = ['#F24E1E', '#0D99FF', '#0ACF83', '#A259FF', '#FF8A00', '#33A2B8', '#E8467C', '#14AE5C'];
        var AGENT_NAMES = ['Grid-Bot', '3D-Mesh', 'Shader', 'RTX-3090', 'Layout', 'Tokens', 'Motion', 'Telemetry', 'Audio-FX', 'OKB-1'];

        function getSavedSkin() {
          try {
            var s = localStorage.getItem('ll_skin') || 'editorial';
            return SKINS[s] ? s : 'editorial';
          } catch (e) { return 'editorial'; }
        }
        function isSoundOn() {
          try { return localStorage.getItem('ll_swarm_sound') !== '0'; } catch (e) { return true; }
        }
        function setSoundPref(on) {
          try { localStorage.setItem('ll_swarm_sound', on ? '1' : '0'); } catch (e) {}
          var mb = document.getElementById('ll-swarm-mute');
          if (mb) mb.textContent = on ? '🔊' : '🔇';
        }
        function isAmbOn() {
          try { return localStorage.getItem('ll_amb_on') !== '0'; } catch (e) { return true; }
        }
        function setAmbPref(on) {
          try { localStorage.setItem('ll_amb_on', on ? '1' : '0'); } catch (e) {}
          syncAmbUI(getSavedSkin());
        }

        /* ---- Pleasant Synthesized Web Audio (E Major Pentatonic Marimba + Airy Swell) ---- */
        var AudioEngine = {
          ctx: null,
          noiseBuf: null,
          ensure: function(force) {
            if (!force && !isSoundOn()) return null;
            var AC = window.AudioContext || window.webkitAudioContext;
            if (!AC) return null;
            if (!this.ctx) this.ctx = new AC();
            if (this.ctx.state === 'suspended') this.ctx.resume().catch(function() {});
            if (!this.noiseBuf) {
              var sr = this.ctx.sampleRate;
              var len = Math.floor(sr * 0.45);
              var buf = this.ctx.createBuffer(1, len, sr);
              var ch = buf.getChannelData(0);
              for (var i = 0; i < len; i++) ch[i] = Math.random() * 2 - 1;
              this.noiseBuf = buf;
            }
            return this.ctx;
          },
          playSwell: function() {
            var c = this.ensure(); if (!c) return;
            var t = c.currentTime;
            var src = c.createBufferSource(); src.buffer = this.noiseBuf;
            var bp = c.createBiquadFilter(); bp.type = 'bandpass'; bp.Q.value = 1.6;
            bp.frequency.setValueAtTime(320, t);
            bp.frequency.exponentialRampToValueAtTime(1450, t + 0.34);
            var g = c.createGain();
            g.gain.setValueAtTime(0.0001, t);
            g.gain.linearRampToValueAtTime(0.042, t + 0.14);
            g.gain.exponentialRampToValueAtTime(0.0001, t + 0.38);
            src.connect(bp); bp.connect(g); g.connect(c.destination);
            src.start(t); src.stop(t + 0.4);
          },
          playTick: function() {
            var c = this.ensure(); if (!c) return;
            var t = c.currentTime;
            var src = c.createBufferSource(); src.buffer = this.noiseBuf;
            var bp = c.createBiquadFilter(); bp.type = 'bandpass'; bp.frequency.value = 1950; bp.Q.value = 3.2;
            var g = c.createGain();
            g.gain.setValueAtTime(0.032, t);
            g.gain.exponentialRampToValueAtTime(0.0001, t + 0.022);
            src.connect(bp); bp.connect(g); g.connect(c.destination);
            src.start(t); src.stop(t + 0.025);
          },
          playRemoveNote: function(xNorm, idx, total) {
            var c = this.ensure(); if (!c) return;
            var desc = [493.88, 415.30, 369.99, 329.63, 277.18, 246.94, 207.65, 164.81]; // B4 downward
            var noteIdx = Math.min(desc.length - 1, Math.round((idx / Math.max(1, total - 1)) * (desc.length - 1)));
            var freq = desc[noteIdx];
            var t = c.currentTime;
            var lp = c.createBiquadFilter(); lp.type = 'lowpass'; lp.frequency.value = 1500;
            var pan = c.createStereoPanner ? c.createStereoPanner() : null;
            if (pan) pan.pan.setValueAtTime((xNorm - 0.5) * 1.1, t);
            var g = c.createGain();
            g.gain.setValueAtTime(0.0001, t);
            g.gain.linearRampToValueAtTime(0.036, t + 0.008);
            g.gain.exponentialRampToValueAtTime(0.0001, t + 0.17);
            var o = c.createOscillator(); o.type = 'triangle';
            o.frequency.setValueAtTime(freq, t);
            o.frequency.exponentialRampToValueAtTime(freq * 0.86, t + 0.16);
            o.connect(g); g.connect(lp);
            if (pan) { lp.connect(pan); pan.connect(c.destination); } else { lp.connect(c.destination); }
            o.start(t); o.stop(t + 0.19);
          },
          playNote: function(xNorm, areaNorm) {
            var c = this.ensure(); if (!c) return;
            var scale = [329.63, 369.99, 415.30, 493.88, 554.37, 659.25, 739.99, 830.61, 987.77]; // E4..B5
            var baseIdx = Math.round((1 - Math.min(1, Math.max(0, areaNorm))) * 4.5 + xNorm * 3.5);
            var freq = scale[Math.max(0, Math.min(scale.length - 1, baseIdx))];
            var t = c.currentTime;

            var lp = c.createBiquadFilter(); lp.type = 'lowpass'; lp.frequency.value = 2600;
            var pan = c.createStereoPanner ? c.createStereoPanner() : null;
            if (pan) pan.pan.setValueAtTime((xNorm - 0.5) * 1.3, t);

            var g = c.createGain();
            g.gain.setValueAtTime(0.0001, t);
            g.gain.linearRampToValueAtTime(0.048, t + 0.009);
            g.gain.exponentialRampToValueAtTime(0.0001, t + 0.34);

            var o1 = c.createOscillator(); o1.type = 'sine'; o1.frequency.setValueAtTime(freq, t);
            var o2 = c.createOscillator(); o2.type = 'triangle'; o2.frequency.setValueAtTime(freq * 2, t);
            var g2 = c.createGain(); g2.gain.value = 0.20;

            o1.connect(g); o2.connect(g2); g2.connect(g); g.connect(lp);
            if (pan) { lp.connect(pan); pan.connect(c.destination); } else { lp.connect(c.destination); }
            o1.start(t); o2.start(t); o1.stop(t + 0.36); o2.stop(t + 0.36);
          },
          playChord: function() {
            var c = this.ensure(); if (!c) return;
            var t = c.currentTime;
            [329.63, 415.30, 493.88, 659.25].forEach(function(freq, i) {
              var o = c.createOscillator(); o.type = 'sine';
              o.frequency.setValueAtTime(freq, t + i * 0.025);
              var g = c.createGain();
              g.gain.setValueAtTime(0.0001, t + i * 0.025);
              g.gain.linearRampToValueAtTime(0.024, t + i * 0.025 + 0.03);
              g.gain.exponentialRampToValueAtTime(0.0001, t + 0.62);
              o.connect(g); g.connect(c.destination);
              o.start(t + i * 0.025); o.stop(t + 0.65);
            });
          }
        };

        /* ---- 7 Unique Generative Procedural Ambient Engines (100% Web Audio + Stereo Reverb) ---- */
        var AmbientEngine = {
          master: null,
          analyser: null,
          dry: null,
          wet: null,
          longNoise: null,
          gen: 0,
          activeSkin: '',
          timers: [],
          stops: [],
          initBus: function() {
            var c = AudioEngine.ensure(true);
            if (!c) return null;
            if (!this.master) {
              var comp = c.createDynamicsCompressor ? c.createDynamicsCompressor() : null;
              var lp = c.createBiquadFilter(); lp.type = 'lowpass'; lp.frequency.value = 6500;
              var m = c.createGain(); m.gain.value = 0.0001;
              var an = c.createAnalyser(); an.fftSize = 128; an.smoothingTimeConstant = 0.72;
              var dry = c.createGain(); dry.gain.value = 0.78;
              var wet = c.createGain(); wet.gain.value = 0.46;

              // Algorithmic 2.1s lush velvet stereo reverb
              var sr = c.sampleRate, irLen = Math.floor(sr * 2.1);
              var ir = c.createBuffer(2, irLen, sr);
              for (var ch = 0; ch < 2; ch++) {
                var d = ir.getChannelData(ch);
                for (var i = 0; i < irLen; i++) {
                  d[i] = (Math.random() * 2 - 1) * Math.pow(1 - i / irLen, 2.4);
                }
              }
              var conv = c.createConvolver(); conv.buffer = ir;
              dry.connect(lp);
              wet.connect(conv); conv.connect(lp);
              if (comp) { lp.connect(comp); comp.connect(m); } else { lp.connect(m); }
              m.connect(an);
              an.connect(c.destination);

              // Shared 3s stereo pink-ish noise buffer (for rain, radio, wind)
              var nLen = Math.floor(sr * 3.0);
              var nBuf = c.createBuffer(2, nLen, sr);
              for (var nc = 0; nc < 2; nc++) {
                var nd = nBuf.getChannelData(nc), b0 = 0, b1 = 0, b2 = 0;
                for (var k = 0; k < nLen; k++) {
                  var w = Math.random() * 2 - 1;
                  b0 = 0.99765 * b0 + w * 0.0990460;
                  b1 = 0.96300 * b1 + w * 0.2965164;
                  b2 = 0.57000 * b2 + w * 1.0526913;
                  nd[k] = (b0 + b1 + b2 + w * 0.1848) * 0.14;
                }
              }
              this.master = m;
              this.analyser = an;
              this.dry = dry;
              this.wet = wet;
              this.longNoise = nBuf;
            }
            return c;
          },
          warm: function() {
            if (!isAmbOn()) return;
            this.initBus();
          },
          stopAll: function() {
            this.gen++;
            this.timers.forEach(function(id) { clearTimeout(id); clearInterval(id); });
            this.timers = [];
            this.stops.forEach(function(fn) { try { fn(); } catch (e) {} });
            this.stops = [];
            this.activeSkin = '';
            if (this.master && AudioEngine.ctx) {
              var c = AudioEngine.ctx, t = c.currentTime;
              try {
                this.master.gain.cancelScheduledValues(t);
                this.master.gain.setTargetAtTime(0.0001, t, 0.25);
              } catch (e) {}
            }
          },
          connectOut: function(node, wetAmt) {
            node.connect(this.dry);
            if (wetAmt && this.wet) {
              var wg = AudioEngine.ctx.createGain();
              wg.gain.value = wetAmt;
              node.connect(wg); wg.connect(this.wet);
            }
          },
          panConnect: function(node, panVal, wetAmt) {
            var c = AudioEngine.ctx;
            if (c.createStereoPanner) {
              var p = c.createStereoPanner();
              p.pan.value = Math.max(-0.85, Math.min(0.85, panVal || 0));
              node.connect(p);
              this.connectOut(p, wetAmt);
            } else {
              this.connectOut(node, wetAmt);
            }
          },
          addDrone: function(freqs, type, lfoHz, cutMin, cutMax, gainVal) {
            var c = AudioEngine.ctx, t = c.currentTime;
            var filt = c.createBiquadFilter(); filt.type = 'lowpass'; filt.frequency.value = cutMin; filt.Q.value = 1.8;
            var g = c.createGain();
            g.gain.setValueAtTime(0.0001, t);
            g.gain.linearRampToValueAtTime(gainVal, t + 1.8);
            filt.connect(g);
            this.connectOut(g, 0.55);

            var lfo = c.createOscillator(); lfo.frequency.value = lfoHz;
            var lfoG = c.createGain(); lfoG.gain.value = (cutMax - cutMin) * 0.5;
            filt.frequency.value = (cutMax + cutMin) * 0.5;
            lfo.connect(lfoG); lfoG.connect(filt.frequency);
            lfo.start(t);

            var oscs = [lfo];
            freqs.forEach(function(fr, idx) {
              var o = c.createOscillator();
              o.type = type;
              o.frequency.value = fr;
              o.detune.value = (idx % 2 === 0 ? -5 : 6);
              var og = c.createGain(); og.gain.value = 1 / freqs.length;
              o.connect(og); og.connect(filt);
              o.start(t);
              oscs.push(o);
            });

            this.stops.push(function() {
              var nt = c.currentTime;
              try {
                g.gain.cancelScheduledValues(nt);
                g.gain.setTargetAtTime(0.0001, nt, 0.18);
              } catch (e) {}
              setTimeout(function() {
                oscs.forEach(function(x) { try { x.stop(); x.disconnect(); } catch (e) {} });
                try { g.disconnect(); filt.disconnect(); } catch (e) {}
              }, 750);
            });
          },
          addNoiseBed: function(bpFreq, bpQ, gainVal, lfoHz, sweepAmt) {
            var c = AudioEngine.ctx, t = c.currentTime;
            var src = c.createBufferSource(); src.buffer = this.longNoise; src.loop = true;
            var bp = c.createBiquadFilter(); bp.type = 'bandpass'; bp.frequency.value = bpFreq; bp.Q.value = bpQ;
            var g = c.createGain();
            g.gain.setValueAtTime(0.0001, t);
            g.gain.linearRampToValueAtTime(gainVal, t + 1.4);
            src.connect(bp); bp.connect(g);
            this.connectOut(g, 0.35);
            src.start(t);
            var lfo = null;
            if (lfoHz && sweepAmt) {
              lfo = c.createOscillator(); lfo.frequency.value = lfoHz;
              var lg = c.createGain(); lg.gain.value = sweepAmt;
              lfo.connect(lg); lg.connect(bp.frequency); lfo.start(t);
            }
            this.stops.push(function() {
              var nt = c.currentTime;
              try { g.gain.setTargetAtTime(0.0001, nt, 0.16); } catch (e) {}
              setTimeout(function() {
                try { src.stop(); src.disconnect(); } catch (e) {}
                if (lfo) try { lfo.stop(); lfo.disconnect(); } catch (e) {}
                try { g.disconnect(); bp.disconnect(); } catch (e) {}
              }, 700);
            });
          },
          pluckTone: function(freq, type, dur, vol, cutStart, cutEnd, pan, wet, pitchSlide) {
            var c = AudioEngine.ctx, t = c.currentTime;
            var o = c.createOscillator(); o.type = type || 'triangle';
            o.frequency.setValueAtTime(freq, t);
            if (pitchSlide) o.frequency.exponentialRampToValueAtTime(freq * pitchSlide, t + dur * 0.85);
            var f = c.createBiquadFilter(); f.type = 'lowpass';
            f.frequency.setValueAtTime(cutStart || 2800, t);
            f.frequency.exponentialRampToValueAtTime(Math.max(120, cutEnd || 360), t + Math.min(dur, 0.45));
            var g = c.createGain();
            g.gain.setValueAtTime(0.0001, t);
            g.gain.linearRampToValueAtTime(vol, t + 0.015);
            g.gain.exponentialRampToValueAtTime(0.0001, t + dur);
            o.connect(f); f.connect(g);
            this.panConnect(g, pan || 0, wet != null ? wet : 0.75);
            o.start(t); o.stop(t + dur + 0.05);
          },
          scheduleLoop: function(myGen, minMs, maxMs, fn) {
            var self = this;
            function step() {
              if (self.gen !== myGen || !isAmbOn() || document.hidden) return;
              try { fn(); } catch (e) {}
              var wait = minMs + Math.random() * (maxMs - minMs);
              var tid = setTimeout(step, wait);
              self.timers.push(tid);
            }
            var initTid = setTimeout(step, 350 + Math.random() * 450);
            this.timers.push(initTid);
          },
          startSkin: function(skinId) {
            if (skinId === 'editorial' || !isAmbOn() || document.hidden) {
              this.stopAll();
              syncAmbUI(skinId);
              return;
            }
            if (this.activeSkin === skinId && this.master && AudioEngine.ctx && AudioEngine.ctx.state === 'running') {
              syncAmbUI(skinId);
              return;
            }
            this.stopAll();
            var c = this.initBus();
            if (!c) { syncAmbUI(skinId); return; }
            if (c.state === 'suspended') { syncAmbUI(skinId); return; }

            var myGen = ++this.gen;
            this.activeSkin = skinId;
            var t = c.currentTime;
            this.master.gain.cancelScheduledValues(t);
            this.master.gain.setTargetAtTime(0.32, t, 0.55);

            var self = this;
            if (skinId === 'ribbon') {
              // 02 3D Ribbon: Airy D Lydian glass pad + dreamy kalimba drops
              var lyd = [293.66, 329.63, 369.99, 415.30, 440.00, 493.88, 554.37, 587.33];
              this.addDrone([73.42, 110.00, 185.00], 'sine', 0.09, 220, 480, 0.22);
              this.scheduleLoop(myGen, 1100, 2300, function() {
                var fr = lyd[Math.floor(Math.random() * lyd.length)];
                self.pluckTone(fr, 'sine', 1.4, 0.085, 2200, 500, Math.random() * 1.2 - 0.6, 0.85);
              });
            } else if (skinId === 'okb1') {
              // 03 OKB-1 Retro: Deep analog space drone + Sputnik telemetry pings
              var cm = [130.81, 196.00, 233.08, 293.66, 392.00];
              this.addDrone([65.41, 98.00, 130.81], 'sawtooth', 0.06, 130, 310, 0.14);
              this.addNoiseBed(650, 1.4, 0.025, 0.12, 220);
              this.scheduleLoop(myGen, 2400, 3800, function() {
                var f = Math.random() < 0.5 ? 880 : cm[Math.floor(Math.random() * cm.length)];
                self.pluckTone(f, 'sine', 0.55, 0.055, 1900, 650, (Math.random() - 0.5) * 0.8, 0.9);
              });
            } else if (skinId === 'cyberpunk') {
              // 04 Cyberpunk: Midnight neon rain + Vangelis sweeping A1 sawtooth pad + Am9 plucks
              var am9 = [220.00, 261.63, 329.63, 392.00, 493.88, 659.25];
              this.addNoiseBed(560, 0.75, 0.14, 0.15, 210);
              this.addDrone([55.00, 82.41, 110.00], 'sawtooth', 0.11, 160, 880, 0.18);
              this.scheduleLoop(myGen, 620, 1350, function() {
                var fr = am9[Math.floor(Math.random() * am9.length)];
                self.pluckTone(fr, 'triangle', 1.1, 0.065, 3200, 340, (Math.random() - 0.5) * 1.4, 0.95);
              });
            } else if (skinId === 'japan') {
              // 05 Japan Washi: Kyoto Hirajōshi Koto plucks + temple singing bowl + flute breath
              var hira = [293.66, 311.13, 392.00, 440.00, 466.16, 587.33, 622.25, 783.99];
              this.addDrone([146.83, 220.00], 'sine', 0.07, 260, 420, 0.15);
              this.scheduleLoop(myGen, 1250, 2900, function() {
                var idx = Math.floor(Math.random() * hira.length);
                var fr = hira[idx];
                self.pluckTone(fr, 'triangle', 1.35, 0.095, 3600, 380, (Math.random() - 0.5) * 1.1, 0.9, 0.992);
                if (Math.random() < 0.32) {
                  var tid = setTimeout(function() {
                    if (self.gen !== myGen || !isAmbOn()) return;
                    self.pluckTone(hira[(idx + 2) % hira.length], 'sine', 1.1, 0.055, 2200, 350, 0.35, 0.95);
                  }, 210);
                  self.timers.push(tid);
                }
              });
            } else if (skinId === 'china80') {
              // 06 80s China Neon: Kowloon warm VHS chorus chord + Guqin Gong pentatonic sparkles
              var gong = [369.99, 415.30, 466.16, 554.37, 622.25, 739.99];
              this.addDrone([92.50, 138.59, 233.08], 'triangle', 0.22, 240, 620, 0.20);
              this.addNoiseBed(420, 0.8, 0.032, 0.18, 90);
              this.scheduleLoop(myGen, 950, 2050, function() {
                var fr = gong[Math.floor(Math.random() * gong.length)];
                self.pluckTone(fr, 'triangle', 1.25, 0.078, 2900, 440, (Math.random() - 0.5) * 1.2, 0.95, 1.006);
              });
            } else if (skinId === 'fallout') {
              // 07 Fallout Pip-Boy: Vault-Tec tube hum + AM static + Geiger micro-ticks + haunted Fmaj7
              var fmaj = [174.61, 220.00, 261.63, 329.63, 349.23, 440.00];
              this.addDrone([60.00, 120.00], 'sine', 0.05, 140, 210, 0.14);
              this.addNoiseBed(880, 1.8, 0.048, 0.25, 180);
              this.scheduleLoop(myGen, 450, 1550, function() {
                if (Math.random() < 0.62) {
                  // Soft Geiger micro-tick
                  var src = c.createBufferSource(); src.buffer = AudioEngine.noiseBuf || self.longNoise;
                  var bp = c.createBiquadFilter(); bp.type = 'bandpass'; bp.frequency.value = 2300; bp.Q.value = 4.5;
                  var gg = c.createGain();
                  var nt = c.currentTime;
                  gg.gain.setValueAtTime(0.055, nt);
                  gg.gain.exponentialRampToValueAtTime(0.0001, nt + 0.012);
                  src.connect(bp); bp.connect(gg); self.panConnect(gg, (Math.random() - 0.5) * 0.8, 0.25);
                  src.start(nt); src.stop(nt + 0.02);
                } else {
                  var fr = fmaj[Math.floor(Math.random() * fmaj.length)];
                  self.pluckTone(fr, 'sine', 1.6, 0.072, 1400, 420, (Math.random() - 0.5) * 0.6, 0.85, 0.985);
                }
              });
            } else if (skinId === 'bauhaus') {
              // 08 Bauhaus Poster: Geometric Dessau C-Lydian wooden pulse polyrhythm
              var clyd = [261.63, 329.63, 392.00, 493.88, 587.33, 739.99];
              var stepIdx = 0;
              this.addDrone([130.81, 196.00], 'triangle', 0.14, 180, 340, 0.11);
              this.scheduleLoop(myGen, 380, 460, function() {
                var fr = clyd[stepIdx % clyd.length];
                stepIdx += (Math.random() < 0.7 ? 1 : 2);
                self.pluckTone(fr, 'triangle', 0.38, 0.072, 2600, 520, (stepIdx % 2 === 0 ? -0.45 : 0.45), 0.35);
              });
            }

            syncAmbUI(skinId);
          }
        };

        /* ---- 2-Act Swarm Morph: Act 1 Disassemble Old -> Act 2 Rebuild New ---- */
        var activeStage = null;
        var activeRaf = 0;
        var activeAnims = [];
        var pendingSkin = null;

        function cancelAnims() {
          activeAnims.forEach(function(an) { try { an.cancel(); } catch (e) {} });
          activeAnims = [];
        }

        function clearStage(finishPending) {
          if (activeRaf) { cancelAnimationFrame(activeRaf); activeRaf = 0; }
          cancelAnims();
          if (finishPending && pendingSkin) {
            var ps = pendingSkin;
            pendingSkin = null;
            applySkinAttr(ps);
          } else {
            pendingSkin = null;
          }
          document.querySelectorAll('[data-sw-masked="1"]').forEach(function(el) {
            el.removeAttribute('data-sw-masked');
          });
          document.querySelectorAll('.ll-sw-pop').forEach(function(el) {
            el.classList.remove('ll-sw-pop');
          });
          if (activeStage && activeStage.parentNode) { activeStage.parentNode.removeChild(activeStage); }
          activeStage = null;
          document.documentElement.classList.remove('ll-skin-anim');
        }

        function collectVisibleTargets() {
          var isMob = window.innerWidth < 768;
          var cap = isMob ? 5 : 8;
          var sels = '.ll-hero-card, .ll-terminal-card, .ll-focus-item, .ll-bento-grid > .ll-card, main .wp-block-group.ll-card, .ll-post-row, .ll-stat-box, .ll-pipe-node';
          var nodes = Array.prototype.slice.call(document.querySelectorAll(sels));
          var out = [];
          for (var i = 0; i < nodes.length; i++) {
            var r = nodes[i].getBoundingClientRect();
            if (r.width > 40 && r.height > 24 && r.bottom > 20 && r.top < window.innerHeight - 10) {
              out.push({ el: nodes[i], r: r });
              if (out.length >= cap) break;
            }
          }
          if (!out.length) {
            out.push({ el: document.body, r: { left: 24, top: 80, width: window.innerWidth - 48, height: 260, right: window.innerWidth - 24, bottom: 340 } });
          }
          return out;
        }

        function veilColorFor(skinId) {
          if (skinId === 'editorial') {
            return document.documentElement.getAttribute('data-theme') === 'dark' ? '#09090b' : '#fafaf9';
          }
          return (SKINS[skinId] && SKINS[skinId].veil) ? SKINS[skinId].veil : '#09090b';
        }

        function makeCursorEl(idx, label, color) {
          var d = document.createElement('div');
          d.className = 'll-sw-cursor';
          d.innerHTML = '<svg width="18" height="20" viewBox="0 0 18 20" fill="none">'
            + '<path d="M2 1.5L15.5 9.5L8.6 11.4L5.6 18L2 1.5Z" fill="' + color + '" stroke="#ffffff" stroke-width="1.6" stroke-linejoin="round"/></svg>'
            + '<div class="ll-sw-tag" style="background:' + color + '">' + label + '</div>';
          return d;
        }

        function runSwarmMorph(targetSkin, originRect) {
          clearStage(false);
          AmbientEngine.stopAll();
          pendingSkin = targetSkin;
          document.documentElement.classList.add('ll-skin-anim');

          var stage = document.createElement('div');
          stage.id = 'll-swarm-stage';
          stage.setAttribute('aria-hidden', 'true');
          document.body.appendChild(stage);
          activeStage = stage;

          var veil = document.createElement('div');
          veil.className = 'll-sw-veil';
          veil.style.background = veilColorFor(targetSkin);
          stage.appendChild(veil);

          var rTop = document.createElement('div'); rTop.className = 'll-sw-ruler-top';
          var rLeft = document.createElement('div'); rLeft.className = 'll-sw-ruler-left';
          var gH = document.createElement('div'); gH.className = 'll-sw-guide-h';
          var gV = document.createElement('div'); gV.className = 'll-sw-guide-v';
          stage.appendChild(rTop); stage.appendChild(rLeft);
          stage.appendChild(gH); stage.appendChild(gV);

          var skipBtn = document.createElement('button');
          skipBtn.type = 'button';
          skipBtn.className = 'll-sw-skip';
          skipBtn.textContent = (LANG === 'en') ? 'Skip ✕' : (LANG === 'ru' ? 'Пропустить ✕' : 'Пропустити ✕');
          skipBtn.addEventListener('click', function() { clearStage(true); });
          stage.appendChild(skipBtn);

          var isMob = window.innerWidth < 768;
          var cap = isMob ? 5 : 8;
          var ox = originRect ? (originRect.left + originRect.width * 0.5) : (window.innerWidth - 90);
          var oy = originRect ? (originRect.top + originRect.height * 0.5) : 30;

          // Persistent cursor pool shared seamlessly across Act 1 (disassemble) -> Act 2 (rebuild)
          var cursors = [];
          for (var cIdx = 0; cIdx < cap; cIdx++) {
            var cCol = CURSOR_COLORS[cIdx % CURSOR_COLORS.length];
            var cEl = makeCursorEl(cIdx, AGENT_NAMES[cIdx % AGENT_NAMES.length], cCol);
            cEl.style.transform = 'translate3d(' + Math.round(ox) + 'px,' + Math.round(oy) + 'px,0)';
            stage.appendChild(cEl);
            cursors.push({ el: cEl, col: cCol, x: ox, y: oy });
          }

          // Snapshot Act 1 (current/old) visible cards reversed (bottom-up dismantle)
          var oldTargetsRaw = collectVisibleTargets();
          var oldTasks = oldTargetsRaw.slice().reverse().map(function(t, i) {
            var cur = cursors[i % cursors.length];
            var box = document.createElement('div');
            box.className = 'll-sw-box';
            box.style.left = Math.round(t.r.left) + 'px';
            box.style.top = Math.round(t.r.top) + 'px';
            box.style.width = Math.round(t.r.width) + 'px';
            box.style.height = Math.round(t.r.height) + 'px';
            box.style.opacity = '0';
            var rectEl = document.createElement('div');
            rectEl.className = 'll-sw-box-rect';
            rectEl.style.borderColor = '#F24822';
            rectEl.style.background = 'rgba(242, 72, 34, 0.08)';
            box.appendChild(rectEl);
            stage.appendChild(box);

            return {
              t: t,
              r: t.r,
              box: box,
              cur: cur,
              startAt: 30 + i * 85,
              started: false,
              pulled: false,
              pullDx: (t.r.left + t.r.width * 0.5 < window.innerWidth * 0.5 ? -1 : 1) * 56,
              pullDy: 34,
              flyStart: null
            };
          });

          var DIS_FLY = 210;
          var DIS_PULL = 260;
          var lastOldFinish = oldTasks.length ? (oldTasks[oldTasks.length - 1].startAt + DIS_FLY + DIS_PULL) : 450;
          var VEIL_RISE_AT = Math.max(420, lastOldFinish - 170);
          var PIVOT_AT = VEIL_RISE_AT + 240;

          // Step 1: Slide in rulers & snap initial guides + play swell
          requestAnimationFrame(function() {
            if (activeStage !== stage) return;
            rTop.classList.add('on');
            rLeft.classList.add('on');
            var firstAnchor = oldTargetsRaw[0].r;
            gH.style.top = Math.max(24, Math.round(firstAnchor.top)) + 'px';
            gV.style.left = Math.max(24, Math.round(firstAnchor.left)) + 'px';
            gH.style.opacity = '0.78';
            gV.style.opacity = '0.78';
            AudioEngine.playSwell();
          });

          var buildTasks = [];
          var veilRaised = false;
          var swapped = false;
          var chordPlayed = false;
          var t0 = performance.now();
          var STEP_MS = 170;
          var FLY_MS = 330;
          var DRAG_MS = 450;
          var totalMs = PIVOT_AT + 2400;

          function easeOutCubic(x) { return 1 - Math.pow(1 - x, 3); }
          function easeInOut(x) { return x < 0.5 ? 4 * x * x * x : 1 - Math.pow(-2 * x + 2, 3) / 2; }

          function pivotToNewDesign(pivotTime) {
            // Cancel old card dismantle animations before skin switch
            cancelAnims();
            oldTasks.forEach(function(ot) {
              if (ot.box && ot.box.parentNode) ot.box.parentNode.removeChild(ot.box);
            });

            pendingSkin = null;
            applySkinAttr(targetSkin);

            var newTargets = collectVisibleTargets();
            var anchor = newTargets[0].r;
            gH.style.top = Math.max(24, Math.round(anchor.top)) + 'px';
            gV.style.left = Math.max(24, Math.round(anchor.left)) + 'px';
            gH.style.opacity = '0.84';
            gV.style.opacity = '0.84';
            AudioEngine.playTick();

            buildTasks = newTargets.map(function(t, i) {
              var cur = cursors[i % cursors.length];
              t.el.setAttribute('data-sw-masked', '1');

              var tile = document.createElement('div');
              tile.className = 'll-sw-tile';
              tile.style.left = Math.round(t.r.left) + 'px';
              tile.style.top = Math.round(t.r.top) + 'px';
              tile.style.width = Math.round(t.r.width) + 'px';
              tile.style.height = Math.round(t.r.height) + 'px';
              stage.appendChild(tile);

              var box = document.createElement('div');
              box.className = 'll-sw-box';
              box.style.left = Math.round(t.r.left) + 'px';
              box.style.top = Math.round(t.r.top) + 'px';
              box.style.width = Math.round(t.r.width) + 'px';
              box.style.height = Math.round(t.r.height) + 'px';
              box.style.opacity = '0';

              var rectEl = document.createElement('div');
              rectEl.className = 'll-sw-box-rect';
              rectEl.style.borderColor = cur.col;
              rectEl.style.transform = 'scale(0.02, 0.02)';

              var dim = document.createElement('div');
              dim.className = 'll-sw-dim';
              dim.style.background = cur.col;
              dim.textContent = Math.round(t.r.width) + ' × ' + Math.round(t.r.height);

              box.appendChild(rectEl);
              box.appendChild(dim);
              stage.appendChild(box);

              return {
                el: t.el,
                r: t.r,
                tile: tile,
                box: box,
                rectEl: rectEl,
                dim: dim,
                cur: cur,
                startAt: pivotTime + 100 + i * STEP_MS,
                flyStart: null,
                revealed: false,
                lastDimP: -1,
                exitVx: (t.r.left < window.innerWidth * 0.5 ? -1 : 1) * (240 + (i % 3) * 85),
                exitVy: -150 - (i % 4) * 45
              };
            });

            totalMs = pivotTime + 100 + Math.max(0, buildTasks.length - 1) * STEP_MS + FLY_MS + DRAG_MS + 620;
            // Fade veil out smoothly so empty new artboard & wireframe blueprints appear
            requestAnimationFrame(function() {
              if (activeStage === stage) veil.style.opacity = '0';
            });
          }

          function frame(now) {
            if (activeStage !== stage) return;
            var elapsed = now - t0;

            if (!veilRaised && elapsed >= VEIL_RISE_AT) {
              veilRaised = true;
              veil.style.opacity = '0.95';
            }

            if (!swapped && elapsed >= PIVOT_AT) {
              swapped = true;
              pivotToNewDesign(elapsed);
            }

            if (!swapped) {
              // ---- ACT 1: DISASSEMBLE CURRENT SITE ----
              oldTasks.forEach(function(ot, idx) {
                var lt = elapsed - ot.startAt;
                var cur = ot.cur;
                if (lt < 0) {
                  var wp = elapsed / Math.max(1, ot.startAt);
                  cur.x = ox + Math.sin(wp * 3 + idx) * 14;
                  cur.y = oy + 12 + wp * 20;
                } else if (lt < DIS_FLY) {
                  if (!ot.flyStart) ot.flyStart = { x: cur.x, y: cur.y };
                  var p1 = easeOutCubic(lt / DIS_FLY);
                  var tx = ot.r.left + ot.r.width * 0.22;
                  var ty = ot.r.top + Math.min(28, ot.r.height * 0.25);
                  cur.x = ot.flyStart.x + (tx - ot.flyStart.x) * p1;
                  cur.y = ot.flyStart.y + (ty - ot.flyStart.y) * p1 + Math.sin(p1 * Math.PI) * -22;
                  ot.box.style.opacity = String(Math.min(1, p1 * 1.4));
                } else if (lt < DIS_FLY + DIS_PULL) {
                  if (!ot.pulled) {
                    ot.pulled = true;
                    var xn = (ot.r.left + ot.r.width * 0.5) / Math.max(1, window.innerWidth);
                    AudioEngine.playRemoveNote(xn, idx, oldTasks.length);
                    try {
                      var anim = ot.t.el.animate([
                        { transform: 'translate3d(0,0,0) scale(1)', opacity: 1 },
                        { transform: 'translate3d(' + ot.pullDx + 'px,' + ot.pullDy + 'px,0) scale(0.84)', opacity: 0 }
                      ], { duration: DIS_PULL, fill: 'forwards', easing: 'cubic-bezier(0.4, 0, 0.85, 1)' });
                      activeAnims.push(anim);
                    } catch (e) {}
                  }
                  var p2 = easeInOut((lt - DIS_FLY) / DIS_PULL);
                  var bx = ot.r.left + ot.r.width * 0.22;
                  var by = ot.r.top + Math.min(28, ot.r.height * 0.25);
                  cur.x = bx + ot.pullDx * p2;
                  cur.y = by + ot.pullDy * p2;
                  ot.box.style.opacity = String(Math.max(0, 1 - p2 * 1.5));
                } else {
                  ot.box.style.opacity = '0';
                }
                cur.el.style.transform = 'translate3d(' + Math.round(cur.x) + 'px,' + Math.round(cur.y) + 'px,0)';
                cur.el.style.opacity = '1';
              });
            } else {
              // ---- ACT 2: REASSEMBLE NEW DESIGN ----
              buildTasks.forEach(function(a, idx) {
                var lt = elapsed - a.startAt;
                var cur = a.cur;
                var op = 1;

                if (lt < 0) {
                  // Smooth standby orbit near cursor's Act 1 ending spot before building new card
                  cur.x += Math.sin(elapsed * 0.008 + idx) * 0.6;
                  cur.y += Math.cos(elapsed * 0.008 + idx) * 0.4;
                } else if (lt < FLY_MS) {
                  if (!a.flyStart) a.flyStart = { x: cur.x, y: cur.y };
                  var p = easeOutCubic(lt / FLY_MS);
                  var tx = a.r.left + a.r.width * 0.02;
                  var ty = a.r.top + a.r.height * 0.02;
                  cur.x = a.flyStart.x + (tx - a.flyStart.x) * p;
                  cur.y = a.flyStart.y + (ty - a.flyStart.y) * p + Math.sin(p * Math.PI) * -28;
                } else if (lt < FLY_MS + DRAG_MS) {
                  var p2 = easeInOut((lt - FLY_MS) / DRAG_MS);
                  var s = 0.02 + 0.98 * p2;
                  var cw = Math.round(a.r.width * s);
                  var ch = Math.round(a.r.height * s);
                  cur.x = a.r.left + cw;
                  cur.y = a.r.top + ch;
                  a.box.style.opacity = '1';
                  a.rectEl.style.transform = 'scale(' + s.toFixed(3) + ',' + s.toFixed(3) + ')';
                  a.dim.style.transform = 'translate3d(' + Math.max(4, cw - 68) + 'px,' + (ch + 4) + 'px,0)';
                  if (Math.abs(p2 - a.lastDimP) >= 0.08 || p2 > 0.98) {
                    a.lastDimP = p2;
                    a.dim.textContent = cw + ' × ' + ch;
                  }
                } else if (lt < FLY_MS + DRAG_MS + 220) {
                  if (!a.revealed) {
                    a.revealed = true;
                    a.tile.style.opacity = '0';
                    a.el.removeAttribute('data-sw-masked');
                    a.el.classList.add('ll-sw-pop');
                    var xNorm = (a.r.left + a.r.width * 0.5) / Math.max(1, window.innerWidth);
                    var areaNorm = (a.r.width * a.r.height) / (window.innerWidth * window.innerHeight * 0.45);
                    AudioEngine.playNote(xNorm, areaNorm);
                  }
                  cur.x = a.r.right;
                  cur.y = a.r.bottom;
                  a.box.style.opacity = String(Math.max(0, 1 - (lt - FLY_MS - DRAG_MS) / 200));
                } else {
                  var p4 = Math.min(1, (lt - (FLY_MS + DRAG_MS + 220)) / 420);
                  var ep4 = easeOutCubic(p4);
                  cur.x = a.r.right + a.exitVx * ep4;
                  cur.y = a.r.bottom + a.exitVy * ep4;
                  op = Math.max(0, 1 - p4);
                  a.box.style.opacity = '0';
                }

                cur.el.style.transform = 'translate3d(' + Math.round(cur.x) + 'px,' + Math.round(cur.y) + 'px,0)';
                cur.el.style.opacity = op.toFixed(2);
              });

              if (!chordPlayed && elapsed >= totalMs - 520) {
                chordPlayed = true;
                AudioEngine.playChord();
                rTop.classList.remove('on');
                rLeft.classList.remove('on');
                gH.style.opacity = '0';
                gV.style.opacity = '0';
              }
            }

            if (elapsed < totalMs) {
              activeRaf = requestAnimationFrame(frame);
            } else {
              clearStage(true);
            }
          }

          activeRaf = requestAnimationFrame(frame);
          setTimeout(function() {
            if (activeStage === stage) clearStage(true);
          }, 5600);
        }

        var ambWaveRaf = 0;
        var ambWaveBuf = null;
        var ambScopeAccent = '#2dd4bf';
        var AMB_BTN_TEXT = {
          uk: { stop: '🔇 Вимк', start: '🔊 Увімк', resume: '▶ Грати', offTip: 'Вимкнути фонову мелодію', onTip: 'Увімкнути фонову мелодію' },
          ru: { stop: '🔇 Выкл', start: '🔊 Вкл', resume: '▶ Играть', offTip: 'Отключить фоновую мелодию', onTip: 'Включить фоновую мелодию' },
          en: { stop: '🔇 Mute', start: '🔊 On', resume: '▶ Play', offTip: 'Mute background ambient', onTip: 'Enable background ambient' }
        };
        function readAccentColor() {
          return (getComputedStyle(document.documentElement).getPropertyValue('--ll-accent') || '#2dd4bf').trim();
        }
        function drawAmbGrid(cx, w, h) {
          cx.save();
          cx.strokeStyle = 'rgba(255, 255, 255, 0.08)';
          cx.lineWidth = 1;
          cx.beginPath();
          [0.25, 0.5, 0.75].forEach(function(r) {
            var y = Math.round(h * r) + 0.5;
            cx.moveTo(4, y);
            cx.lineTo(w - 4, y);
          });
          for (var gx = 1; gx < 6; gx++) {
            var x = Math.round((w / 6) * gx) + 0.5;
            cx.moveTo(x, 4);
            cx.lineTo(x, h - 4);
          }
          cx.stroke();
          cx.restore();
        }
        function renderAmbFlatline() {
          var cv = document.getElementById('ll-amb-wave');
          if (!cv) return;
          var cx = cv.getContext('2d');
          var w = cv.width, h = cv.height;
          ambScopeAccent = readAccentColor();
          cx.clearRect(0, 0, w, h);
          drawAmbGrid(cx, w, h);
          cx.save();
          cx.strokeStyle = ambScopeAccent;
          cx.globalAlpha = 0.48;
          cx.lineWidth = 1.4;
          cx.beginPath();
          cx.moveTo(4, h * 0.5);
          cx.lineTo(w - 4, h * 0.5);
          cx.stroke();
          cx.restore();
        }
        function startAmbScope() {
          ambScopeAccent = readAccentColor();
          if (ambWaveRaf) return;
          var cv = document.getElementById('ll-amb-wave');
          if (!cv || !AmbientEngine.analyser) { renderAmbFlatline(); return; }
          var cx = cv.getContext('2d');
          var len = AmbientEngine.analyser.frequencyBinCount;
          if (!ambWaveBuf || ambWaveBuf.length !== len) ambWaveBuf = new Uint8Array(len);
          function loop() {
            var pill = document.getElementById('ll-amb-pill');
            if (!pill || pill.hidden || !pill.classList.contains('playing') || !AmbientEngine.analyser || document.hidden) {
              ambWaveRaf = 0;
              renderAmbFlatline();
              return;
            }
            ambWaveRaf = requestAnimationFrame(loop);
            AmbientEngine.analyser.getByteTimeDomainData(ambWaveBuf);
            var w = cv.width, h = cv.height, mid = h * 0.5, amp = h * 0.42;
            cx.clearRect(0, 0, w, h);
            drawAmbGrid(cx, w, h);
            cx.save();
            cx.strokeStyle = ambScopeAccent;
            cx.shadowColor = ambScopeAccent;
            cx.shadowBlur = 6;
            cx.lineWidth = 1.8;
            cx.beginPath();
            var step = w / (ambWaveBuf.length - 1);
            for (var i = 0; i < ambWaveBuf.length; i++) {
              var norm = ((ambWaveBuf[i] - 128) / 128) * 6.2;
              norm = Math.max(-0.90, Math.min(0.90, norm));
              var x = i * step;
              var y = mid + norm * amp;
              if (i === 0) cx.moveTo(x, y);
              else {
                var px = (i - 1) * step;
                var pn = Math.max(-0.90, Math.min(0.90, ((ambWaveBuf[i - 1] - 128) / 128) * 6.2));
                var py = mid + pn * amp;
                cx.quadraticCurveTo(px, py, (px + x) * 0.5, (py + y) * 0.5);
              }
            }
            cx.stroke();
            cx.lineTo(w, mid);
            cx.lineTo(0, mid);
            cx.closePath();
            cx.shadowBlur = 0;
            cx.globalAlpha = 0.14;
            cx.fillStyle = ambScopeAccent;
            cx.fill();
            cx.restore();
          }
          ambWaveRaf = requestAnimationFrame(loop);
        }

        function syncAmbUI(skinId) {
          var s = SKINS[skinId] || SKINS.editorial;
          var ambName = s.ambient || '';
          var on = isAmbOn();
          ambScopeAccent = readAccentColor();
          var mb = document.getElementById('ll-amb-mute');
          if (mb) {
            mb.textContent = on ? '♫' : '🔇';
            mb.classList.toggle('on', on && skinId !== 'editorial');
          }
          var pill = document.getElementById('ll-amb-pill');
          var lbl = document.getElementById('ll-amb-label');
          var pbtn = document.getElementById('ll-amb-pill-btn');
          var running = on && AmbientEngine.activeSkin === skinId && AudioEngine.ctx && AudioEngine.ctx.state === 'running';
          var dict = AMB_BTN_TEXT[LANG] || AMB_BTN_TEXT.uk;
          if (pill) {
            pill.hidden = (skinId === 'editorial' || !ambName);
            pill.classList.toggle('playing', !!running);
          }
          if (lbl && ambName) lbl.textContent = ambName;
          if (pbtn) {
            pbtn.textContent = !on ? dict.start : (running ? dict.stop : dict.resume);
            pbtn.classList.toggle('is-off', !on);
            pbtn.setAttribute('aria-pressed', running ? 'true' : 'false');
            pbtn.setAttribute('title', running ? dict.offTip : dict.onTip);
          }
          if (running) startAmbScope(); else renderAmbFlatline();
        }

        function applySkinAttr(skinId) {
          if (!SKINS[skinId]) skinId = 'editorial';
          document.documentElement.setAttribute('data-skin', skinId);
          try { localStorage.setItem('ll_skin', skinId); } catch (e) {}
          syncUI(skinId);
          AmbientEngine.startSkin(skinId);
        }

        function syncUI(skinId) {
          var s = SKINS[skinId] || SKINS.editorial;
          var btn = document.getElementById('ll-skin-toggle');
          var lbl = document.getElementById('ll-skin-active-label');
          if (btn) btn.classList.toggle('is-default', skinId === 'editorial');
          if (lbl) lbl.textContent = (s.short && s.short[LANG]) ? s.short[LANG] : s.names.en;

          document.querySelectorAll('.ll-skin-opt').forEach(function(opt) {
            var active = opt.getAttribute('data-skin-id') === skinId;
            opt.classList.toggle('active', active);
            opt.setAttribute('aria-checked', active ? 'true' : 'false');
          });
        }

        function dismissNudge() {
          var n = document.getElementById('ll-skin-nudge');
          if (n) n.hidden = true;
          try { localStorage.setItem('ll_skin_nudge_dismissed', '1'); } catch (e) {}
        }

        function closeMenu() {
          var m = document.getElementById('ll-skin-menu');
          var b = document.getElementById('ll-skin-toggle');
          if (m) { m.classList.remove('open'); m.setAttribute('aria-hidden', 'true'); }
          if (b) b.setAttribute('aria-expanded', 'false');
        }

        function setSkin(skinId, opts) {
          opts = opts || {};
          if (!SKINS[skinId]) skinId = 'editorial';
          AmbientEngine.warm();
          dismissNudge();
          closeMenu();
          var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
          if (opts.instant || reduce) {
            applySkinAttr(skinId);
            return;
          }
          runSwarmMorph(skinId, opts.originRect || null);
        }

        function toggleAmbient() {
          var next = !isAmbOn();
          setAmbPref(next);
          if (next) {
            AmbientEngine.warm();
            AmbientEngine.startSkin(getSavedSkin());
          } else {
            AmbientEngine.stopAll();
            syncAmbUI(getSavedSkin());
          }
          return next;
        }

        /* ---- Public Extensible API (consumed by ⌘K, Hero Terminal & Canvas) ---- */
        window.LLSkin = {
          getRegistry: function() { return SKINS; },
          getSkin: getSavedSkin,
          setSkin: setSkin,
          isAmbientOn: isAmbOn,
          toggleAmbient: toggleAmbient,
          replay: function() {
            var cur = getSavedSkin();
            var b = document.getElementById('ll-skin-toggle');
            setSkin(cur, { originRect: b ? b.getBoundingClientRect() : null });
          },
          getWavePalette: function() {
            var s = SKINS[getSavedSkin()] || SKINS.editorial;
            return s.wave || SKINS.editorial.wave;
          }
        };

        /* ---- Bind Switcher Events ---- */
        var curSkin = getSavedSkin();
        syncUI(curSkin);
        syncAmbUI(curSkin);
        setSoundPref(isSoundOn());

        // Auto-unlock saved ambient music cleanly on first user interaction after page reload
        function unlockSavedAmbient(e) {
          if (e && e.target && e.target.closest && e.target.closest('#ll-amb-pill-btn, #ll-amb-mute, #ll-skin-toggle')) return;
          var sk = getSavedSkin();
          if (sk !== 'editorial' && isAmbOn()) {
            AmbientEngine.warm();
            AmbientEngine.startSkin(sk);
          }
          document.removeEventListener('pointerdown', unlockSavedAmbient);
          document.removeEventListener('keydown', unlockSavedAmbient);
        }
        if (curSkin !== 'editorial' && isAmbOn()) {
          document.addEventListener('pointerdown', unlockSavedAmbient, { passive: true });
          document.addEventListener('keydown', unlockSavedAmbient, { passive: true });
        }

        // Duck & pause gently when switching away to another browser tab
        document.addEventListener('visibilitychange', function() {
          if (document.hidden) {
            AmbientEngine.stopAll();
            syncAmbUI(getSavedSkin());
          } else {
            var sk = getSavedSkin();
            if (sk !== 'editorial' && isAmbOn() && AudioEngine.ctx) {
              AmbientEngine.startSkin(sk);
            }
          }
        });

        // Show first-visit nudge only if still on default Editorial skin and never dismissed
        try {
          var nudge = document.getElementById('ll-skin-nudge');
          if (nudge && curSkin === 'editorial' && localStorage.getItem('ll_skin_nudge_dismissed') !== '1') {
            setTimeout(function() {
              if (getSavedSkin() === 'editorial') nudge.hidden = false;
            }, 450);
          }
        } catch (e) {}

        document.addEventListener('click', function(e) {
          var t = e.target;
          if (!t || !t.closest) return;

          var toggle = t.closest('#ll-skin-toggle');
          if (toggle) {
            e.stopPropagation();
            dismissNudge();
            var m = document.getElementById('ll-skin-menu');
            if (m) {
              var open = m.classList.toggle('open');
              m.setAttribute('aria-hidden', open ? 'false' : 'true');
              toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            }
            return;
          }

          var opt = t.closest('.ll-skin-opt');
          if (opt) {
            e.stopPropagation();
            setSkin(opt.getAttribute('data-skin-id'), { originRect: opt.getBoundingClientRect() });
            return;
          }

          var np = t.closest('.ll-nudge-pill');
          if (np) {
            e.stopPropagation();
            if (np.id === 'll-nudge-open-all') {
              dismissNudge();
              var m2 = document.getElementById('ll-skin-menu');
              var b2 = document.getElementById('ll-skin-toggle');
              if (m2) { m2.classList.add('open'); m2.setAttribute('aria-hidden', 'false'); }
              if (b2) b2.setAttribute('aria-expanded', 'true');
              return;
            }
            setSkin(np.getAttribute('data-nudge-skin'), { originRect: np.getBoundingClientRect() });
            return;
          }

          if (t.closest('#ll-nudge-close')) {
            e.stopPropagation();
            dismissNudge();
            return;
          }

          if (t.closest('#ll-amb-mute') || t.closest('#ll-amb-pill-btn')) {
            e.stopPropagation();
            var curS = getSavedSkin();
            // If ambient is ON in config but waiting for click after page reload, clicking ▶ starts it immediately!
            if (isAmbOn() && AmbientEngine.activeSkin !== curS && curS !== 'editorial') {
              AmbientEngine.warm();
              AmbientEngine.startSkin(curS);
            } else {
              toggleAmbient();
            }
            return;
          }

          if (t.closest('#ll-swarm-mute')) {
            e.stopPropagation();
            var nextSound = !isSoundOn();
            setSoundPref(nextSound);
            if (nextSound) AudioEngine.playTick();
            return;
          }

          if (t.closest('#ll-swarm-replay')) {
            e.stopPropagation();
            window.LLSkin.replay();
            return;
          }

          // If user clicks Dark/Light Moon button while viewing another cover, morph back into Editorial nicely
          var tbtn = t.closest('#ll-theme-toggle');
          if (tbtn && getSavedSkin() !== 'editorial') {
            setSkin('editorial', { originRect: tbtn.getBoundingClientRect() });
          }

          if (!t.closest('#ll-skin-wrap')) {
            closeMenu();
          }
        });

        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape') {
            closeMenu();
            clearStage(true);
          }
        });

        /* ---- Persistent PJAX Router (keeps AmbientEngine & AudioContext unbroken across pages) ---- */
        var pjaxAbort = null;
        var pjaxCurKey = window.location.pathname + window.location.search;
        try {
          history.replaceState({ llPjax: true, url: window.location.href }, '', window.location.href);
        } catch (e) {}

        function closeMobileNavModal() {
          var mClose = document.querySelector('.wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__responsive-container-close');
          if (mClose) mClose.click();
        }

        function syncHeadStyles(newDoc) {
          if (!newDoc || !newDoc.head) return;
          ['core-block-supports-inline-css', 'wp-block-template-skip-link-inline-css', 'global-styles-inline-css'].forEach(function(id) {
            var nextSt = newDoc.getElementById(id);
            if (!nextSt) return;
            var curSt = document.getElementById(id);
            if (curSt) {
              curSt.textContent = nextSt.textContent;
            } else {
              document.head.appendChild(document.importNode(nextSt, true));
            }
          });
          newDoc.head.querySelectorAll('style[id]').forEach(function(st) {
            if (st.id && !document.getElementById(st.id)) {
              document.head.appendChild(document.importNode(st, true));
            }
          });
          newDoc.head.querySelectorAll('link[rel="stylesheet"][href]').forEach(function(lk) {
            var id = lk.getAttribute('id');
            var href = lk.getAttribute('href');
            if (id && document.getElementById(id)) return;
            var exists = false;
            document.head.querySelectorAll('link[rel="stylesheet"][href]').forEach(function(curLk) {
              if (curLk.getAttribute('href') === href) exists = true;
            });
            if (!exists) document.head.appendChild(document.importNode(lk, true));
          });
        }

        function syncChrome(newDoc) {
          closeMobileNavModal();
          closeMenu();
          var curUls = document.querySelectorAll('header .wp-block-navigation__container');
          var nextUls = newDoc.querySelectorAll('header .wp-block-navigation__container');
          for (var i = 0; i < curUls.length && i < nextUls.length; i++) {
            curUls[i].innerHTML = nextUls[i].innerHTML;
          }
          var curLangs = document.querySelectorAll('header .ll-lang-pill');
          var nextLangs = newDoc.querySelectorAll('header .ll-lang-pill');
          for (var j = 0; j < curLangs.length && j < nextLangs.length; j++) {
            var nh = nextLangs[j].getAttribute('href');
            if (nh) curLangs[j].setAttribute('href', nh);
          }
        }

        function executeInlineMainScripts(liveMain) {
          liveMain.querySelectorAll('script').forEach(function(oldSc) {
            var tp = (oldSc.getAttribute('type') || '').toLowerCase();
            if (tp && tp !== 'text/javascript' && tp !== 'application/javascript' && tp !== 'module') return;
            var ns = document.createElement('script');
            Array.prototype.forEach.call(oldSc.attributes, function(attr) { ns.setAttribute(attr.name, attr.value); });
            ns.textContent = oldSc.textContent;
            oldSc.parentNode.replaceChild(ns, oldSc);
          });
        }

        function runPjaxScripts(newDoc) {
          document.querySelectorAll('script[data-ll-pjax-active="1"]').forEach(function(old) {
            if (old.parentNode) old.parentNode.removeChild(old);
          });
          if (!newDoc || !newDoc.body) return;
          newDoc.body.querySelectorAll('script[data-ll-pjax]').forEach(function(sc) {
            var ns = document.createElement('script');
            ns.setAttribute('data-ll-pjax-active', '1');
            ns.textContent = sc.textContent;
            document.body.appendChild(ns);
          });
        }

        function llPjaxNavigate(urlStr, push) {
          var dest;
          try {
            dest = new URL(urlStr, window.location.href);
          } catch (e) {
            window.location.href = urlStr;
            return;
          }
          if (dest.origin !== window.location.origin) {
            window.location.href = dest.href;
            return;
          }

          if (pjaxAbort) {
            try { pjaxAbort.abort(); } catch (e) {}
          }
          pjaxAbort = (typeof AbortController === 'function') ? new AbortController() : null;

          var curMain = document.querySelector('main');
          if (curMain) {
            curMain.style.transition = 'opacity 0.14s ease';
            curMain.style.opacity = '0.68';
          }

          fetch(dest.href, {
            credentials: 'same-origin',
            headers: { 'X-LL-PJAX': '1' },
            signal: pjaxAbort ? pjaxAbort.signal : undefined
          })
            .then(function(resp) {
              var ct = resp.headers.get('content-type') || '';
              var finUrl = resp.url ? new URL(resp.url, window.location.href) : dest;
              if (finUrl.origin !== window.location.origin || /^\/wp-(login|admin)/.test(finUrl.pathname) || resp.status >= 500 || ct.indexOf('text/html') === -1) {
                window.location.href = resp.url || dest.href;
                return null;
              }
              return resp.text().then(function(html) {
                return { html: html, finalUrl: finUrl };
              });
            })
            .then(function(res) {
              if (!res) return;
              var newDoc = new DOMParser().parseFromString(res.html, 'text/html');
              var nextMain = newDoc.querySelector('main');
              var nowMain = document.querySelector('main');
              if (!nextMain || !nowMain) {
                window.location.href = res.finalUrl.href;
                return;
              }

              if (typeof window._llWowCleanup === 'function') window._llWowCleanup();
              syncHeadStyles(newDoc);
              document.title = newDoc.title;
              document.body.className = newDoc.body.className;
              syncChrome(newDoc);

              nowMain.replaceWith(document.importNode(nextMain, true));
              var liveMain = document.querySelector('main');
              if (liveMain) executeInlineMainScripts(liveMain);

              var targetUrl = res.finalUrl.href + (dest.hash || '');
              if (push !== false) {
                try { history.pushState({ llPjax: true, url: targetUrl }, '', targetUrl); } catch (e) {}
              }
              pjaxCurKey = res.finalUrl.pathname + res.finalUrl.search;

              if (typeof window.llInitStylesPage === 'function') window.llInitStylesPage();
              if (typeof window.llInitWowPage === 'function') window.llInitWowPage();
              runPjaxScripts(newDoc);
              syncAmbUI(getSavedSkin());

              var hashTarget = dest.hash ? document.getElementById(decodeURIComponent(dest.hash.slice(1))) : null;
              if (hashTarget) {
                hashTarget.scrollIntoView({ behavior: 'auto' });
              } else if (push !== false) {
                window.scrollTo({ top: 0, behavior: 'auto' });
              }
              window.dispatchEvent(new Event('scroll'));
            })
            .catch(function(err) {
              if (err && err.name === 'AbortError') return;
              window.location.href = dest.href;
            });
        }

        function shouldInterceptLink(a) {
          if (!a || !a.href) return false;
          if (a.hasAttribute('download') || (a.target && a.target !== '_self')) return false;
          if (a.closest('#wpadminbar, .ll-lang-pill')) return false;
          var dest;
          try { dest = new URL(a.href, window.location.href); } catch (e) { return false; }
          if (dest.protocol !== 'http:' && dest.protocol !== 'https:') return false;
          if (dest.origin !== window.location.origin) return false;
          if (dest.searchParams.has('lang')) return false;
          if (dest.pathname === window.location.pathname && dest.search === window.location.search) {
            closeMobileNavModal();
            return false;
          }
          if (/^\/(wp-admin|wp-login|wp-json|wp-content|feed|games)\b/.test(dest.pathname)) return false;
          if (/\.(pdf|zip|png|jpe?g|webp|svg|wasm|pck|js|css|json|xml)$/i.test(dest.pathname)) return false;
          return dest.href;
        }

        document.addEventListener('click', function(e) {
          if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
          var a = e.target && e.target.closest ? e.target.closest('a[href]') : null;
          var href = shouldInterceptLink(a);
          if (!href) return;
          e.preventDefault();
          llPjaxNavigate(href, true);
        });

        window.addEventListener('popstate', function() {
          var nextKey = window.location.pathname + window.location.search;
          if (nextKey === pjaxCurKey) return;
          llPjaxNavigate(window.location.href, false);
        });

        window.LLPjax = {
          go: function(url) {
            var abs;
            try { abs = new URL(url, window.location.href); } catch (e) { window.location.href = url; return; }
            if (abs.origin !== window.location.origin || abs.searchParams.has('lang') || /^\/(wp-admin|wp-login|games)\b/.test(abs.pathname)) {
              window.location.href = abs.href;
              return;
            }
            llPjaxNavigate(abs.href, true);
          }
        };
      })();
    </script>
    <?php
}, 90);
