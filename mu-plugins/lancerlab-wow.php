<?php
/**
 * Plugin Name: LancerLab WOW Interactive Layer (Voice Waveform + Hero Terminal + Ctrl+K Command Palette)
 */

// 1. Shortcode for Hero Terminal + Voice Greeting + Live Waveform inside the right Bento card
add_shortcode('lancerlab_hero_wow', function () {
    $lang = function_exists('ll_detect_lang') ? ll_detect_lang() : 'uk';
    $t = [
        'uk' => [
            'title'   => '// LAB_CORE • RTX 3090',
            'listen'  => '▶ Послухати AI-голос',
            'stop'    => '⏹ Стоп',
            'ph'      => 'Введіть команду (help, status, ask ...)',
            'boot'    => "Ініціалізація LancerLab OS... OK\nВведіть 'help' або натисніть команду нижче:",
            'audio'   => '/wp-content/uploads/lancerlab/intro_uk.wav',
        ],
        'ru' => [
            'title'   => '// LAB_CORE • RTX 3090',
            'listen'  => '▶ Послушать AI-голос',
            'stop'    => '⏹ Стоп',
            'ph'      => 'Введите команду (help, status, ask ...)',
            'boot'    => "Инициализация LancerLab OS... OK\nВведите 'help' или нажмите команду ниже:",
            'audio'   => '/wp-content/uploads/lancerlab/intro_ru.wav',
        ],
        'en' => [
            'title'   => '// LAB_CORE • RTX 3090',
            'listen'  => '▶ Hear AI Voice Intro',
            'stop'    => '⏹ Stop',
            'ph'      => 'Type command (help, status, ask ...)',
            'audio'   => '/wp-content/uploads/lancerlab/intro_uk.wav',
        ],
    ][$lang];

    ob_start();
    ?>
    <div class="ll-terminal-card ll-wow-term">
      <div>
        <div class="ll-term-head">
          <span><?php echo esc_html($t['title']); ?></span>
          <span class="ll-status-inline" style="font-size:0.68rem;padding:0.15rem 0.55rem;"><span class="ll-dot"></span> LIVE</span>
        </div>

        <div style="margin-bottom:0.75rem;">
          <canvas id="ll-wave-canvas" width="420" height="72" style="width:100%;height:72px;display:block;border-radius:8px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);"></canvas>
          <div id="ll-wave-legend" style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:0.5rem;margin-top:0.35rem;font-size:0.68rem;color:#a1a1aa;">
            <span><span style="color:var(--ll-wave-cpu, #2dd4bf);">●</span> CPU <b id="ll-leg-cpu">--%</b></span>
            <span><span style="color:var(--ll-wave-gpu, #a78bfa);">●</span> RTX 3090 <b id="ll-leg-gpu">--%</b></span>
            <span><span style="color:var(--ll-wave-vram, #fbbf24);">●</span> VRAM <b id="ll-leg-vram">--%</b></span>
          </div>
        </div>

        <div id="ll-term-screen" class="ll-term-screen"><?php echo esc_html($t['boot']); ?></div>

        <div class="ll-term-chips">
          <button type="button" class="ll-term-chip" data-cmd="status">status</button>
          <button type="button" class="ll-term-chip" data-cmd="whoami">whoami</button>
          <button type="button" class="ll-term-chip" data-cmd="ask чем ты занимаешься?">ask</button>
          <button type="button" class="ll-term-chip" data-cmd="play">play</button>
          <button type="button" class="ll-term-chip" data-cmd="help">help</button>
        </div>

        <form id="ll-term-form" class="ll-term-input-row">
          <span style="color:#2dd4bf;font-weight:700;">$</span>
          <input id="ll-term-in" type="text" autocomplete="off" placeholder="<?php echo esc_attr($t['ph']); ?>">
        </form>
      </div>

      <div class="ll-term-cta">
        <span id="ll-cp-val" style="color:#a1a1aa;font-size:0.72rem;">Control: polling...</span>
        <span id="ll-wp-val" style="color:#2dd4bf;font-size:0.72rem;">GPU: polling...</span>
      </div>
    </div>
    <?php
    $GLOBALS['ll_wow_js'] = $lang;
    return ob_get_clean();
});

// 2. Inject Ctrl+K button into nav toolbar + Modal & Scripts in wp_footer
add_action('wp_footer', function () {
    $lang = function_exists('ll_detect_lang') ? ll_detect_lang() : 'uk';

    // Preload post titles/URLs for instant Ctrl+K search
    $posts = get_posts(['post_type' => 'post', 'post_status' => 'publish', 'numberposts' => 20]);
    $items = [
        ['t' => $lang === 'uk' ? 'Головна' : ($lang === 'en' ? 'Home' : 'Главная'), 'u' => '/', 'g' => 'Page'],
        ['t' => $lang === 'uk' ? 'Лабораторія (Блог)' : ($lang === 'en' ? 'Engineering Lab (Blog)' : 'Лаборатория (Блог)'), 'u' => '/blog/', 'g' => 'Page'],
        ['t' => $lang === 'uk' ? 'Проєкти та AI-архітектор' : ($lang === 'en' ? 'Projects & AI Architect' : 'Проекты и AI-архитектор'), 'u' => '/projects/', 'g' => 'Page'],
        ['t' => $lang === 'uk' ? 'Грати: Перший космічний (Godot 4)' : ($lang === 'en' ? 'Play: First Space Race (Godot 4)' : 'Играть: Первый космический (Godot 4)'), 'u' => '/play/', 'g' => 'Interactive'],
        ['t' => $lang === 'uk' ? 'AI Двійник (Чат + Голос F5-TTS)' : ($lang === 'en' ? 'AI Digital Twin (Chat + F5-TTS)' : 'AI Двойник (Чат + Голос F5-TTS)'), 'u' => '/twin/', 'g' => 'Interactive'],
        ['t' => $lang === 'uk' ? 'Резюме та PDF' : ($lang === 'en' ? 'Resume & PDF' : 'Резюме и PDF'), 'u' => '/resume/', 'g' => 'Page'],
    ];
    foreach ($posts as $p) {
        $items[] = ['t' => get_the_title($p->ID), 'u' => get_permalink($p->ID), 'g' => 'Article'];
    }
    ?>
    <style>
      .ll-voice-pill {
        background: rgba(45, 212, 191, 0.16);
        color: #2dd4bf;
        border: 1px solid rgba(45, 212, 191, 0.4);
        border-radius: 999px;
        padding: 0.25rem 0.7rem;
        font-family: var(--ll-font-mono);
        font-size: 0.72rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.15s;
      }
      .ll-voice-pill:hover, .ll-voice-pill.playing {
        background: #2dd4bf;
        color: #09090b;
      }
      .ll-term-screen {
        font-size: 0.76rem;
        line-height: 1.48;
        color: #d4d4d8;
        min-height: 105px;
        max-height: 135px;
        overflow-y: auto;
        white-space: pre-wrap;
        margin-bottom: 0.65rem;
      }
      .ll-term-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem;
        margin-bottom: 0.55rem;
      }
      .ll-term-chip {
        background: rgba(255,255,255,0.06);
        color: #a1a1aa;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 6px;
        padding: 0.15rem 0.45rem;
        font-family: var(--ll-font-mono);
        font-size: 0.68rem;
        cursor: pointer;
      }
      .ll-term-chip:hover { color: #2dd4bf; border-color: #2dd4bf; }
      .ll-term-input-row {
        display: flex;
        align-items: center;
        gap: 0.45rem;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 8px;
        padding: 0.38rem 0.65rem;
      }
      .ll-term-input-row input {
        flex: 1;
        background: transparent;
        border: 0;
        color: #fafafa;
        font-family: var(--ll-font-mono);
        font-size: 0.78rem;
        outline: none;
        min-width: 0;
      }
      /* Command Palette Ctrl+K */
      #ll-cmdk-backdrop {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(9, 9, 11, 0.6);
        backdrop-filter: blur(4px);
        z-index: 10000;
        align-items: flex-start;
        justify-content: center;
        padding-top: 12vh;
      }
      #ll-cmdk-backdrop.open { display: flex; }
      .ll-cmdk-box {
        width: min(560px, 92vw);
        background: var(--ll-surface);
        border: 1px solid var(--ll-border);
        border-radius: 16px;
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.35);
        overflow: hidden;
      }
      #ll-cmdk-input {
        width: 100%;
        box-sizing: border-box;
        padding: 0.95rem 1.15rem;
        border: 0;
        border-bottom: 1px solid var(--ll-border);
        background: transparent;
        color: var(--ll-dark);
        font-family: var(--ll-font-sans);
        font-size: 0.98rem;
        outline: none;
      }
      #ll-cmdk-list {
        max-height: 340px;
        overflow-y: auto;
        padding: 0.4rem;
      }
      .ll-cmdk-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 0.75rem;
        padding: 0.6rem 0.85rem;
        border-radius: 9px;
        text-decoration: none !important;
        color: var(--ll-dark) !important;
        font-size: 0.9rem;
        cursor: pointer;
      }
      .ll-cmdk-item:hover { background: var(--ll-surface-alt); }
      .ll-cmdk-tag {
        font-family: var(--ll-font-mono);
        font-size: 0.68rem;
        color: var(--ll-muted);
        flex-shrink: 0;
      }
      .ll-cmdk-trigger {
        border: 1px solid var(--ll-border);
        background: var(--ll-surface);
        color: var(--ll-muted);
        border-radius: 8px;
        padding: 0.22rem 0.5rem;
        font-family: var(--ll-font-mono);
        font-size: 0.7rem;
        cursor: pointer;
      }
      .ll-cmdk-trigger:hover { color: var(--ll-dark); border-color: var(--ll-dark); }

    </style>

    <div id="ll-cmdk-backdrop" role="dialog" aria-modal="true" aria-label="Command Palette">
      <div class="ll-cmdk-box">
        <input id="ll-cmdk-input" type="text" placeholder="Search pages, articles, or type 'theme' / 'play' / 'twin'...">
        <div id="ll-cmdk-list"></div>
      </div>
    </div>

    <script>
    (function() {
      // 1. Add Ctrl+K button to header toolbar
      var tb = document.querySelector('.ll-toolbar');
      if (tb && !document.getElementById('ll-cmdk-open')) {
        var b = document.createElement('button');
        b.id = 'll-cmdk-open';
        b.type = 'button';
        b.className = 'll-cmdk-trigger';
        b.textContent = '⌘K';
        b.title = 'Command Palette (Ctrl+K)';
        tb.insertBefore(b, tb.firstChild);
      }

      // 2. Ctrl+K Command Palette Logic
      var items = <?php echo wp_json_encode($items); ?>;
      var modal = document.getElementById('ll-cmdk-backdrop');
      var cinp = document.getElementById('ll-cmdk-input');
      var clist = document.getElementById('ll-cmdk-list');

      function renderCmdk(q) {
        var ql = (q || '').toLowerCase();
        var filtered = items.filter(function(it) {
          return !ql || it.t.toLowerCase().indexOf(ql) !== -1 || it.g.toLowerCase().indexOf(ql) !== -1;
        });
        clist.innerHTML = '';
        filtered.slice(0, 12).forEach(function(it) {
          var a = document.createElement('a');
          a.className = 'll-cmdk-item';
          a.href = it.u;
          a.innerHTML = '<span>' + it.t.replace(/</g, '&lt;') + '</span><span class="ll-cmdk-tag">' + it.g + '</span>';
          a.addEventListener('click', function(ev) {
            modal.classList.remove('open');
            if (window.LLPjax && window.LLPjax.go) {
              ev.preventDefault();
              window.LLPjax.go(it.u, true);
            }
          });
          clist.appendChild(a);
        });
        // Add dynamic skin cover actions from registry
        if (window.LLSkin && window.LLSkin.getRegistry) {
          var regs = window.LLSkin.getRegistry();
          var langCode = <?php echo wp_json_encode($lang); ?>;
          Object.keys(regs).forEach(function(skId) {
            var sk = regs[skId];
            var nm = (sk.names && (sk.names[langCode] || sk.names.en)) || skId;
            var ds = (sk.desc && (sk.desc[langCode] || sk.desc.en)) || '';
            var hay = ('skin cover обложка обкладинка стиль ' + skId + ' ' + nm + ' ' + ds).toLowerCase();
            if (!ql || hay.indexOf(ql) !== -1) {
              var sact = document.createElement('div');
              sact.className = 'll-cmdk-item';
              sact.innerHTML = '<span>🎨 ' + nm.replace(/</g, '&lt;') + ' — <small style="opacity:0.7;">' + ds.replace(/</g, '&lt;') + '</small></span><span class="ll-cmdk-tag">Skin</span>';
              sact.addEventListener('click', function() {
                modal.classList.remove('open');
                window.LLSkin.setSkin(skId);
              });
              clist.appendChild(sact);
            }
          });
        }
        // Add quick actions
        if (window.LLSkin && window.LLSkin.toggleAmbient) {
          var ambAct = document.createElement('div');
          ambAct.className = 'll-cmdk-item';
          ambAct.innerHTML = '<span>♫ Toggle Ambient Background Music</span><span class="ll-cmdk-tag">Audio</span>';
          ambAct.addEventListener('click', function() {
            window.LLSkin.toggleAmbient();
            modal.classList.remove('open');
          });
          clist.appendChild(ambAct);
        }
        var act = document.createElement('div');
        act.className = 'll-cmdk-item';
        act.innerHTML = '<span>🌓 Toggle Dark / Light Theme</span><span class="ll-cmdk-tag">Action</span>';
        act.addEventListener('click', function() {
          var t = document.getElementById('ll-theme-toggle');
          if (t) t.click();
          modal.classList.remove('open');
        });
        clist.appendChild(act);
      }

      function openCmdk() {
        modal.classList.add('open');
        cinp.value = '';
        renderCmdk('');
        setTimeout(function() { cinp.focus(); }, 30);
      }

      document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
          e.preventDefault();
          if (modal.classList.contains('open')) modal.classList.remove('open'); else openCmdk();
        } else if (e.key === 'Escape') {
          modal.classList.remove('open');
        }
      });
      document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'll-cmdk-open') openCmdk();
        if (e.target === modal) modal.classList.remove('open');
      });
      if (cinp) cinp.addEventListener('input', function() { renderCmdk(cinp.value); });

      // 3. Hero Ambient Oscilloscope + Interactive Terminal (PJAX-reinitializable)
      window._llWowCleanup = function() {
        if (window._llWowTimer) { clearInterval(window._llWowTimer); window._llWowTimer = 0; }
        if (window._llWowRaf) { cancelAnimationFrame(window._llWowRaf); window._llWowRaf = 0; }
      };

      window.llInitWowPage = function() {
        window._llWowCleanup();
        var canvas = document.getElementById('ll-wave-canvas');
        var screen = document.getElementById('ll-term-screen');
        var tform = document.getElementById('ll-term-form');
        var tin = document.getElementById('ll-term-in');

        if (canvas) {
          var ctx = canvas.getContext('2d');
          var maxPts = 110;
          var histCpu = new Array(maxPts).fill(4);
          var histGpu = new Array(maxPts).fill(2);
          var histVram = new Array(maxPts).fill(80);
          var targetCpu = 4, targetGpu = 2, targetVram = 80;
          var smoothCpu = 4, smoothGpu = 2, smoothVram = 80;
          var legCpu = document.getElementById('ll-leg-cpu');
          var legGpu = document.getElementById('ll-leg-gpu');
          var legVram = document.getElementById('ll-leg-vram');
          var cpFoot = document.getElementById('ll-cp-val');
          var wpFoot = document.getElementById('ll-wp-val');

          function pollTelemetry() {
            fetch('/wp-json/lancerlab/v1/lab/telemetry')
              .then(function(r) { return r.json(); })
              .then(function(d) {
                if (d.control_plane) {
                  targetCpu = Number(d.control_plane.cpu_pct || 4);
                  if (legCpu) legCpu.textContent = targetCpu + '%';
                  if (cpFoot) cpFoot.textContent = 'Control: up ' + d.control_plane.uptime + ' (n8n OK)';
                }
                if (d.worker_plane) {
                  targetGpu = Number(d.worker_plane.gpu_pct || 0);
                  targetVram = Number(d.worker_plane.vram_pct || 0);
                  if (legGpu) legGpu.textContent = d.worker_plane.online ? (targetGpu + '% • ' + d.worker_plane.temp) : 'OFF';
                  if (legVram) legVram.textContent = d.worker_plane.online ? (targetVram + '%') : 'OFF';
                  if (wpFoot) wpFoot.textContent = d.worker_plane.online ? ('RTX 3090: ' + d.worker_plane.temp + ' • ' + d.worker_plane.vram_used) : 'RTX 3090: Standby';
                }
              }).catch(function() {});
          }
          pollTelemetry();
          window._llWowTimer = setInterval(pollTelemetry, 3500);

          var tTick = 0, lastPush = 0;
          function drawSmoothChannel(arr, color, glowColor) {
            var w = canvas.width, h = canvas.height, pad = 7;
            ctx.save();
            ctx.beginPath();
            ctx.lineWidth = 1.9;
            ctx.strokeStyle = color;
            ctx.shadowColor = glowColor;
            ctx.shadowBlur = 6;
            for (var i = 0; i < arr.length; i++) {
              var x = (i / (arr.length - 1)) * w;
              var val = Math.min(98, Math.max(2, arr[i]));
              var y = h - pad - (val / 100) * (h - pad * 2);
              if (i === 0) {
                ctx.moveTo(x, y);
              } else {
                var prevX = ((i - 1) / (arr.length - 1)) * w;
                var prevVal = Math.min(98, Math.max(2, arr[i - 1]));
                var prevY = h - pad - (prevVal / 100) * (h - pad * 2);
                var midX = (prevX + x) * 0.5;
                var midY = (prevY + y) * 0.5;
                ctx.quadraticCurveTo(prevX, prevY, midX, midY);
              }
            }
            ctx.stroke();
            ctx.restore();
          }

          (function animateCharts(now) {
            if (!document.body.contains(canvas)) { window._llWowCleanup(); return; }
            window._llWowRaf = requestAnimationFrame(animateCharts);
            tTick += 0.09;

            smoothCpu += (targetCpu - smoothCpu) * 0.045;
            smoothGpu += (targetGpu - smoothGpu) * 0.06;
            smoothVram += (targetVram - smoothVram) * 0.04;

            if (!lastPush || now - lastPush > 42) {
              lastPush = now;
              var oscCpu = Math.sin(tTick * 1.4) * 2.2 + Math.cos(tTick * 2.9) * 1.1;
              var gpuAmp = 1.8 + (smoothGpu * 0.05);
              var oscGpu = Math.sin(tTick * 1.9 + 1.2) * gpuAmp + Math.cos(tTick * 3.7) * (gpuAmp * 0.45);
              var oscVram = Math.sin(tTick * 0.7 + 2.4) * 0.9 + Math.cos(tTick * 1.5) * 0.4;

              histCpu.push(smoothCpu + oscCpu); if (histCpu.length > maxPts) histCpu.shift();
              histGpu.push(smoothGpu + oscGpu); if (histGpu.length > maxPts) histGpu.shift();
              histVram.push(smoothVram + oscVram); if (histVram.length > maxPts) histVram.shift();
            }

            var pal = (window.LLSkin && window.LLSkin.getWavePalette) ? window.LLSkin.getWavePalette() : {
              cpu: 'rgba(45, 212, 191, 0.95)', cpuGlow: 'rgba(45, 212, 191, 0.55)',
              gpu: 'rgba(167, 139, 250, 0.95)', gpuGlow: 'rgba(167, 139, 250, 0.55)',
              vram: 'rgba(251, 191, 36, 0.85)', vramGlow: 'rgba(251, 191, 36, 0.4)',
              grid: 'rgba(255,255,255,0.05)'
            };
            var w = canvas.width, h = canvas.height;
            ctx.clearRect(0, 0, w, h);
            ctx.strokeStyle = pal.grid || 'rgba(255,255,255,0.05)';
            ctx.lineWidth = 1;
            [0.25, 0.5, 0.75].forEach(function(g) {
              ctx.beginPath(); ctx.moveTo(0, h * g); ctx.lineTo(w, h * g); ctx.stroke();
            });

            drawSmoothChannel(histVram, pal.vram, pal.vramGlow);
            drawSmoothChannel(histCpu, pal.cpu, pal.cpuGlow);
            drawSmoothChannel(histGpu, pal.gpu, pal.gpuGlow);
          })();
        }

        function printTerm(txt) {
          if (!screen) return;
          screen.textContent = txt;
          screen.scrollTop = screen.scrollHeight;
        }

        function runCmd(raw) {
          var cmd = (raw || '').trim();
          var low = cmd.toLowerCase();
          if (!cmd) return;
          if (low === 'help') {
            var skList = (window.LLSkin && window.LLSkin.getRegistry) ? Object.keys(window.LLSkin.getRegistry()).join(' | ') : 'editorial | ribbon | okb1';
            printTerm("Commands:\n  status      - live Ubuntu + RTX 3090 telemetry\n  skin [id]   - switch cover (" + skList + ")\n  morph       - replay Figma Swarm transition\n  ambient     - toggle generative background music\n  whoami      - engineer profile & stack\n  ask <q>     - ask local Mistral 24B twin\n  play / twin - launch Godot 4 game or AI Twin");
          } else if (low === 'ambient' || low === 'music') {
            if (window.LLSkin && window.LLSkin.toggleAmbient) {
              var nowOn = window.LLSkin.toggleAmbient();
              printTerm("Ambient music: " + (nowOn ? "ON" : "MUTED"));
            }
          } else if (low === 'morph') {
            if (window.LLSkin) {
              printTerm("Dispatching Figma cursor swarm...");
              window.LLSkin.replay();
            }
          } else if (low === 'skin' || low.indexOf('skin ') === 0) {
            var sid = cmd.slice(4).trim().toLowerCase();
            if (window.LLSkin && window.LLSkin.getRegistry) {
              var regs = window.LLSkin.getRegistry();
              if (sid && regs[sid]) {
                printTerm("Morphing skin -> " + sid + " ...");
                window.LLSkin.setSkin(sid, { originRect: tform ? tform.getBoundingClientRect() : null });
              } else {
                var keys = Object.keys(regs);
                var cur = window.LLSkin.getSkin();
                var nextId = keys[(keys.indexOf(cur) + 1) % keys.length];
                printTerm("Skins: " + keys.join(', ') + "\nCycling -> " + nextId);
                window.LLSkin.setSkin(nextId, { originRect: tform ? tform.getBoundingClientRect() : null });
              }
            }
          } else if (low === 'whoami') {
            printTerm("Illya Dubovyk (@Lancer0076) | Kyiv\nAI Automation, Local LLMs (RTX 3090), n8n, ESP32-S3, Godot 4");
          } else if (low === 'play') {
            if (window.LLPjax && window.LLPjax.go) window.LLPjax.go('/play/', true);
            else window.location.href = '/play/';
          } else if (low === 'twin') {
            if (window.LLPjax && window.LLPjax.go) window.LLPjax.go('/twin/', true);
            else window.location.href = '/twin/';
          } else if (low === 'status') {
            printTerm("Polling Control Plane + RTX 3090...");
            fetch('/wp-json/lancerlab/v1/lab/telemetry')
              .then(function(r) { return r.json(); })
              .then(function(d) {
                var s = "Control: Online (up " + d.control_plane.uptime + ", n8n " + (d.control_plane.n8n ? "OK" : "ERR") + ")\n";
                s += d.worker_plane.online
                  ? "RTX 3090: " + d.worker_plane.temp + ", VRAM " + d.worker_plane.vram_used + " / " + d.worker_plane.vram_tot
                  : "RTX 3090: Standby / Offline";
                printTerm(s);
              });
          } else if (low.indexOf('ask ') === 0 || low === 'ask') {
            var q = cmd.slice(4).trim() || 'чем ты занимаешься?';
            printTerm("RTX 3090 Mistral 24B thinking...");
            fetch('/wp-json/lancerlab/v1/twin/chat', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({ messages: [{ role: 'user', content: q }], lang: <?php echo wp_json_encode($lang); ?> })
            })
            .then(function(r) { return r.json(); })
            .then(function(d) { printTerm(d.ok ? d.reply : (d.error || 'RTX 3090 offline')); });
          } else {
            printTerm("Unknown command: " + cmd + " (try 'help' or 'ask ...')");
          }
        }

        document.querySelectorAll('.ll-term-chip').forEach(function(ch) {
          if (ch.dataset.llTermBound) return;
          ch.dataset.llTermBound = '1';
          ch.addEventListener('click', function() { runCmd(ch.getAttribute('data-cmd')); });
        });
        if (tform && tin && !tform.dataset.llTermBound) {
          tform.dataset.llTermBound = '1';
          tform.addEventListener('submit', function(e) {
            e.preventDefault();
            var v = tin.value;
            tin.value = '';
            runCmd(v);
          });
        }
      };

      window.llInitWowPage();
    })();
    </script>
    <?php
}, 95);
