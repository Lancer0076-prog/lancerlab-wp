<?php
/**
 * Plugin Name: LancerLab Multilingual (UA / RU / EN) & GeoIP
 * Description: Full i18n for titles, nav, footer, pages, blog categories, and postmeta-backed UK/EN blog posts with Ukraine IP auto-detection.
 */

function ll_get_client_ip() {
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) return $_SERVER['HTTP_CF_CONNECTING_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $parts = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($parts[0]);
    }
    return $_SERVER['REMOTE_ADDR'] ?? '';
}

function ll_detect_lang() {
    static $lang = null;
    if ($lang !== null) return $lang;

    $allowed = ['uk', 'ru', 'en'];
    if (isset($_GET['lang']) && in_array($_GET['lang'], $allowed, true)) {
        $lang = $_GET['lang'];
        if (!headers_sent()) {
            setcookie('ll_lang', $lang, time() + 86400 * 30, '/');
        }
        return $lang;
    }
    if (!empty($_COOKIE['ll_lang']) && in_array($_COOKIE['ll_lang'], $allowed, true)) {
        $lang = $_COOKIE['ll_lang'];
        return $lang;
    }

    $country = strtoupper($_SERVER['HTTP_CF_IPCOUNTRY'] ?? '');
    if ($country === 'UA') {
        $lang = 'uk';
        return $lang;
    }

    $ip = ll_get_client_ip();
    if ($ip && !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
        $lang = 'uk';
        return $lang;
    }
    if ($ip && filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
        $cache_key = 'll_geo_' . md5($ip);
        $cached = get_transient($cache_key);
        if ($cached === false) {
            $resp = wp_remote_get('http://ip-api.com/json/' . rawurlencode($ip) . '?fields=countryCode', ['timeout' => 0.8]);
            if (!is_wp_error($resp) && wp_remote_retrieve_response_code($resp) === 200) {
                $data = json_decode(wp_remote_retrieve_body($resp), true);
                $cached = strtoupper($data['countryCode'] ?? 'OTHER');
                set_transient($cache_key, $cached, DAY_IN_SECONDS);
            } else {
                $cached = 'UNKNOWN';
                set_transient($cache_key, $cached, HOUR_IN_SECONDS);
            }
        }
        if ($cached === 'UA') {
            $lang = 'uk';
            return $lang;
        }
    }

    $accept = strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '');
    if (strpos($accept, 'uk') !== false || strpos($accept, 'ua') !== false) {
        $lang = 'uk';
    } elseif (strpos($accept, 'ru') !== false) {
        $lang = 'ru';
    } else {
        $lang = 'en';
    }
    return $lang;
}

add_action('init', function () {
    ll_detect_lang();
});

// Translate site tagline
add_filter('option_blogdescription', function ($desc) {
    $lang = ll_detect_lang();
    if ($lang === 'uk') return 'Ілля Дубовик — AI-автоматизація, локальні сервери, IoT та інженерні експерименти';
    if ($lang === 'en') return 'Illya Dubovyk — AI Automation, Local GPU Servers, IoT & Engineering Lab';
    return $desc;
});

// Translate <title> tag
add_filter('document_title_parts', function ($parts) {
    $lang = ll_detect_lang();
    if ($lang === 'ru') return $parts;

    if (is_front_page()) {
        $parts['tagline'] = $lang === 'uk'
            ? 'Ілля Дубовик — AI-автоматизація, локальні сервери, IoT та експерименти'
            : 'Illya Dubovyk — AI Automation, Local Servers, IoT & Lab';
    } elseif (is_home()) {
        $parts['title'] = $lang === 'uk' ? 'Лабораторія' : 'Lab';
    } elseif (is_page()) {
        $id = get_the_ID();
        $map = [
            13 => ['uk' => 'Проєкти', 'en' => 'Projects'],
            14 => ['uk' => 'Резюме', 'en' => 'Resume'],
            55 => ['uk' => 'AI Двійник', 'en' => 'AI Digital Twin'],
            12 => ['uk' => 'Лабораторія', 'en' => 'Lab'],
        ];
        if (isset($map[$id][$lang])) $parts['title'] = $map[$id][$lang];
    } elseif (is_single()) {
        $tr = get_post_meta(get_the_ID(), '_ll_title_' . $lang, true);
        if ($tr) $parts['title'] = $tr;
    }
    return $parts;
});

// Translate H1 / post titles
add_filter('the_title', function ($title, $post_id = 0) {
    if (is_admin() || !$post_id) return $title;
    $lang = ll_detect_lang();
    if ($lang === 'ru') return $title;

    $page_map = [
        11 => ['uk' => 'Головна', 'en' => 'Home'],
        12 => ['uk' => 'Лабораторія', 'en' => 'Lab'],
        13 => ['uk' => 'Проєкти', 'en' => 'Projects'],
        14 => ['uk' => 'Резюме', 'en' => 'Resume'],
    ];
    if (isset($page_map[$post_id][$lang])) {
        return $page_map[$post_id][$lang];
    }
    $tr = get_post_meta($post_id, '_ll_title_' . $lang, true);
    return $tr ? $tr : $title;
}, 10, 2);

// Translate excerpts for uk/en posts
add_filter('get_the_excerpt', function ($excerpt, $post = null) {
    if (is_admin() || !$post) return $excerpt;
    $lang = ll_detect_lang();
    if ($lang === 'ru') return $excerpt;
    $tr = get_post_meta($post->ID, '_ll_content_' . $lang, true);
    if ($tr) {
        return wp_trim_words(wp_strip_all_tags($tr), 32, '...');
    }
    return $excerpt;
}, 10, 2);

// Translate page & post content
add_filter('the_content', function ($content) {
    if (!in_the_loop() || !is_main_query()) return $content;
    $lang = ll_detect_lang();

    if (is_page()) {
        if ($lang !== 'ru') {
            $id = get_the_ID();
            $file = WP_CONTENT_DIR . "/mu-plugins/ll_i18n_{$id}_{$lang}.html";
            if (file_exists($file)) {
                return do_blocks(file_get_contents($file));
            }
        }
        return $content;
    }

    if (is_single()) {
        if ($lang !== 'ru') {
            $tr = get_post_meta(get_the_ID(), '_ll_content_' . $lang, true);
            if ($tr) $content = $tr;
        }
        $words = count(preg_split('/\s+/u', wp_strip_all_tags($content), -1, PREG_SPLIT_NO_EMPTY));
        $mins = max(1, (int)ceil($words / 180));
        $label = $lang === 'uk' ? "⏱️ ~{$mins} хв читання" : ($lang === 'en' ? "⏱️ ~{$mins} min read" : "⏱️ ~{$mins} мин чтения");
        $nav_html = '';
        $prev = get_previous_post();
        $next = get_next_post();
        if ($prev || $next) {
            $lbl_more = $lang === 'uk' ? 'Читати далі в Лабораторії' : ($lang === 'en' ? 'More from the Lab' : 'Читать далее в Лаборатории');
            $nav_html .= '<div class="ll-post-nav"><div class="ll-post-nav-title">' . esc_html($lbl_more) . '</div><div class="ll-post-nav-links">';
            if ($prev) $nav_html .= '<a class="ll-card" href="' . esc_url(get_permalink($prev)) . '">← ' . esc_html(get_the_title($prev)) . '</a>';
            if ($next) $nav_html .= '<a class="ll-card" href="' . esc_url(get_permalink($next)) . '">' . esc_html(get_the_title($next)) . ' →</a>';
            $nav_html .= '</div></div>';
        }
        return '<div class="ll-read-time">' . esc_html($label) . '</div><div id="ll-toc-slot"></div>' . $content . $nav_html;
    }

    return $content;
}, 5);

// Add language switcher + dark mode toggle to navigation block
add_filter('render_block', function ($block_content, $block) {
    if (($block['blockName'] ?? '') === 'core/navigation') {
        $lang = ll_detect_lang();
        $labels = [
            'uk' => ['Главная' => 'Головна', 'Лаборатория' => 'Лабораторія', 'Проекты' => 'Проєкти', 'Игра' => 'Гра', 'Двойник' => 'Двійник', 'Резюме' => 'Резюме'],
            'ru' => ['Главная' => 'Главная', 'Лаборатория' => 'Лаборатория', 'Проекты' => 'Проекты', 'Игра' => 'Игра', 'Двойник' => 'Двойник', 'Резюме' => 'Резюме'],
            'en' => ['Главная' => 'Home', 'Лаборатория' => 'Lab', 'Проекты' => 'Projects', 'Игра' => 'Play', 'Двойник' => 'AI Twin', 'Резюме' => 'Resume'],
        ];
        if ($lang !== 'ru') {
            foreach ($labels[$lang] as $ru => $tr) {
                $block_content = str_replace('>' . $ru . '<', '>' . $tr . '<', $block_content);
            }
        }
        $uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
        $skin_ui = function_exists('ll_render_skin_switcher_html') ? ll_render_skin_switcher_html($lang) : '';
        $switcher = '<div class="ll-toolbar">'
            . '<div class="ll-lang-pill" aria-label="Language">'
            . '<a href="' . esc_url($uri . '?lang=uk') . '" class="' . ($lang === 'uk' ? 'active' : '') . '">UA</a>'
            . '<a href="' . esc_url($uri . '?lang=ru') . '" class="' . ($lang === 'ru' ? 'active' : '') . '">RU</a>'
            . '<a href="' . esc_url($uri . '?lang=en') . '" class="' . ($lang === 'en' ? 'active' : '') . '">EN</a>'
            . '</div>'
            . $skin_ui
            . '<button id="ll-theme-toggle" class="ll-theme-btn" type="button" title="Toggle theme">🌙</button>'
            . '</div>';
        return '<div class="ll-nav-wrap">' . $block_content . $switcher . '</div>';
    }

    // Blog / Archive heading & category filter pills
    $bname = $block['blockName'] ?? '';
    $is_blog_h = ($bname === 'core/heading' && is_home() && trim(wp_strip_all_tags($block_content)) === 'Блог');
    if (($bname === 'core/query-title' && (is_home() || is_category())) || $is_blog_h) {
        $lang = ll_detect_lang();
        $cats = [
            ['slug' => '', 'uk' => 'Усі записи', 'ru' => 'Все записи', 'en' => 'All posts', 'url' => '/blog/'],
            ['slug' => 'hardware-bios', 'uk' => 'Залізо та BIOS', 'ru' => 'Железо и BIOS', 'en' => 'Hardware & BIOS', 'url' => '/category/hardware-bios/'],
            ['slug' => 'ai-automation', 'uk' => 'AI та автоматизація', 'ru' => 'AI и автоматизация', 'en' => 'AI & Automation', 'url' => '/category/ai-automation/'],
            ['slug' => 'gamedev', 'uk' => 'Gamedev', 'ru' => 'Gamedev', 'en' => 'Gamedev', 'url' => '/category/gamedev/'],
            ['slug' => 'infra', 'uk' => 'Сервери та мережі', 'ru' => 'Серверы и сети', 'en' => 'Infra & Networks', 'url' => '/category/infra/'],
        ];
        $cur = is_category() ? get_queried_object()->slug : '';
        $heading = $lang === 'uk' ? 'Лабораторія' : ($lang === 'en' ? 'Engineering Lab' : 'Лаборатория');
        $pills = '<div class="ll-cat-bar">';
        foreach ($cats as $c) {
            $active = ($cur === $c['slug']) ? ' active' : '';
            $pills .= '<a class="ll-cat-pill' . $active . '" href="' . esc_url($c['url']) . '">' . esc_html($c[$lang]) . '</a>';
        }
        $pills .= '</div>';
        return '<h1 class="wp-block-query-title">' . esc_html($heading) . '</h1>' . $pills;
    }

    if (($block['blockName'] ?? '') === 'core/template-part' && ($block['attrs']['slug'] ?? '') === 'footer') {
        $lang = ll_detect_lang();
        if ($lang === 'uk') {
            $block_content = str_replace(
                ['Илья Дубовик • AI, инфраструктура, IoT и эксперименты', '>Главная<', '>Лаборатория<', '>Проекты<'],
                ['Ілля Дубовик • AI, інфраструктура, IoT та експерименти', '>Головна<', '>Лабораторія<', '>Проєкти<'],
                $block_content
            );
        } elseif ($lang === 'en') {
            $block_content = str_replace(
                ['Илья Дубовик • AI, инфраструктура, IoT и эксперименты', '>Главная<', '>Лаборатория<', '>Проекты<', '>Резюме<'],
                ['Illya Dubovyk • AI, Infrastructure, IoT & Lab', '>Home<', '>Lab<', '>Projects<', '>Resume<'],
                $block_content
            );
        }
    }
    return $block_content;
}, 10, 2);

// Favicon + Open Graph + og:image
add_action('wp_head', function () {
    $title = wp_get_document_title();
    $desc = get_bloginfo('description');
    $avatar_url = content_url('uploads/lancerlab/avatar.jpg');
    $svg = rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><rect width="64" height="64" rx="14" fill="#111827"/><text x="50%" y="54%" dominant-baseline="middle" text-anchor="middle" fill="#2dd4bf" font-family="monospace" font-weight="bold" font-size="28">LL</text></svg>');
    echo '<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,' . $svg . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
    echo '<meta property="og:type" content="' . (is_single() ? 'article' : 'website') . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($avatar_url) . '">' . "\n";
});
