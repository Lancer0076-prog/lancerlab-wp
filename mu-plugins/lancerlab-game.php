<?php
/**
 * Plugin Name: LancerLab Space Race Embed
 * Description: Renders localized [lancerlab_space_race] Godot 4 WebAssembly embed without kses stripping iframe.
 */
add_shortcode('lancerlab_space_race', function () {
    $lang = function_exists('ll_detect_lang') ? ll_detect_lang() : 'uk';
    $txt = [
        'uk' => [
            'desc' => 'Прототип наративної incremental-гри <strong>«Перший космічний»</strong> (Godot 4.3, WebAssembly). Керуйте підсистемами ОКБ та виводьте ракети на орбіту прямо у браузері.',
            'fs'   => '🖥️ На весь екран',
            'tab'  => '↗️ Відкрити в новій вкладці',
        ],
        'ru' => [
            'desc' => 'Прототип нарративной incremental-игры <strong>«Первый космический»</strong> (Godot 4.3, WebAssembly). Управляйте подсистемами ОКБ и выводите ракеты на орбиту прямо в браузере.',
            'fs'   => '🖥️ На весь экран',
            'tab'  => '↗️ Открыть в новой вкладке',
        ],
        'en' => [
            'desc' => 'Browser prototype of the narrative incremental game <strong>First Space Race: Chief Designer</strong> (Godot 4.3, WebAssembly). Manage OKB subsystems and launch rockets into orbit.',
            'fs'   => '🖥️ Fullscreen',
            'tab'  => '↗️ Open in new tab',
        ],
    ][$lang] ?? [];

    ob_start();
    ?>
    <div class="alignwide">
      <p><?php echo $txt['desc']; ?></p>
      <div style="display:flex;flex-wrap:wrap;gap:0.75rem;margin-bottom:1rem;">
        <button type="button" class="ll-print-btn" style="margin-bottom:0;" onclick="var f=document.getElementById('ll-game-frame');if(f.requestFullscreen){f.requestFullscreen();}"><?php echo esc_html($txt['fs']); ?></button>
        <a class="ll-pdf-link" style="margin-left:0;" href="/games/space-race/index.html" target="_blank" rel="noopener"><?php echo esc_html($txt['tab']); ?></a>
      </div>
      <div class="ll-card" style="padding:0.5rem;background:#0b0f19;">
        <iframe id="ll-game-frame" src="/games/space-race/index.html" title="First Space Race: Chief Designer" style="width:100%;aspect-ratio:16/9;min-height:540px;border:0;border-radius:12px;display:block;background:#0b0f19;" allow="fullscreen; autoplay" allowfullscreen></iframe>
      </div>
    </div>
    <?php
    return ob_get_clean();
});
