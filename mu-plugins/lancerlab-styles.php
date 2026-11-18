<?php
/**
 * Plugin Name: LancerLab Design System (Editorial + Bento UI)
 * Description: High-craft minimalist engineering portfolio UI inspired by leerob.io, paco.me, and Linear/Vercel Bento grids.
 */
add_action('wp_head', function () {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style id="lancerlab-css">
      :root {
        --ll-bg: #fafaf9;
        --ll-surface: #ffffff;
        --ll-surface-alt: #f4f4f5;
        --ll-dark: #09090b;
        --ll-text: #27272a;
        --ll-muted: #71717a;
        --ll-border: #e4e4e7;
        --ll-accent: #0f766e;
        --ll-accent-2: #d97706;
        --ll-accent-soft: #f0fdfa;
        --ll-accent-border: #99f6e4;
        --ll-font-sans: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        --ll-font-mono: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, monospace;
      }
      html[data-theme="dark"] {
        --ll-bg: #09090b;
        --ll-surface: #111114;
        --ll-surface-alt: #18181b;
        --ll-dark: #fafafa;
        --ll-text: #d4d4d8;
        --ll-muted: #a1a1aa;
        --ll-border: rgba(255, 255, 255, 0.1);
        --ll-accent: #2dd4bf;
        --ll-accent-2: #fbbf24;
        --ll-accent-soft: rgba(45, 212, 191, 0.1);
        --ll-accent-border: rgba(45, 212, 191, 0.28);
      }
      html, body {
        background-color: var(--ll-bg) !important;
        color: var(--ll-text) !important;
        font-family: var(--ll-font-sans) !important;
        -webkit-font-smoothing: antialiased;
        line-height: 1.6;
      }
      h1, h2, h3, h4 {
        font-family: var(--ll-font-sans) !important;
        color: var(--ll-dark);
        letter-spacing: -0.025em;
      }
      /* Hide redundant WordPress default page H1 on custom-styled pages where we control layout, or style cleanly */
      .wp-site-blocks {
        padding-top: 0 !important;
      }
      .wp-site-blocks .entry-content > .alignwide,
      .wp-site-blocks .wp-block-group.alignwide,
      .wp-block-post-title {
        max-width: 1040px !important;
        margin-left: auto !important;
        margin-right: auto !important;
      }
      .page:not(.home) .wp-block-post-title {
        font-size: clamp(1.75rem, 3vw, 2.25rem) !important;
        margin-top: 2rem !important;
        margin-bottom: 1rem !important;
        padding-left: 0;
        padding-right: 0;
      }
      /* Reading progress bar */
      #ll-read-progress {
        position: fixed;
        top: 0;
        left: 0;
        height: 2px;
        width: 0%;
        background: linear-gradient(90deg, var(--ll-accent), var(--ll-accent-2));
        z-index: 9999;
      }
      /* Crisp single-row sticky header */
      header.wp-block-template-part {
        background: rgba(250, 250, 249, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid var(--ll-border);
        position: sticky;
        top: 0;
        z-index: 50;
      }
      html[data-theme="dark"] header.wp-block-template-part {
        background: rgba(9, 9, 11, 0.85);
      }
      header.wp-block-template-part > .wp-block-group {
        padding: 0.7rem 1.25rem !important;
      }
      header.wp-block-template-part .wp-block-group.alignwide {
        max-width: 1040px !important;
        gap: 1rem !important;
      }
      .wp-block-site-title {
        flex-shrink: 0;
        margin: 0 !important;
      }
      .wp-block-site-title a {
        color: var(--ll-dark) !important;
        font-weight: 700 !important;
        font-size: 1.1rem !important;
        text-decoration: none !important;
        letter-spacing: -0.03em;
      }
      .ll-nav-wrap {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: nowrap;
        gap: 0.85rem;
        min-width: 0;
      }
      .wp-block-navigation ul {
        gap: 1rem !important;
        flex-wrap: nowrap !important;
      }
      .wp-block-navigation a {
        color: var(--ll-muted) !important;
        font-size: 0.88rem !important;
        font-weight: 500 !important;
        white-space: nowrap !important;
        transition: color 0.15s ease;
      }
      .wp-block-navigation a:hover {
        color: var(--ll-dark) !important;
      }
      .ll-toolbar {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        flex-shrink: 0;
      }
      .ll-lang-pill {
        display: inline-flex;
        border: 1px solid var(--ll-border);
        border-radius: 8px;
        overflow: hidden;
        background: var(--ll-surface);
      }
      .ll-lang-pill a {
        padding: 0.22rem 0.5rem;
        font-family: var(--ll-font-mono);
        font-size: 0.72rem;
        font-weight: 600;
        text-decoration: none !important;
        color: var(--ll-muted) !important;
      }
      .ll-lang-pill a.active {
        background: var(--ll-dark);
        color: var(--ll-bg) !important;
      }
      .ll-theme-btn {
        border: 1px solid var(--ll-border);
        background: var(--ll-surface);
        color: var(--ll-dark);
        border-radius: 8px;
        padding: 0.22rem 0.5rem;
        font-size: 0.82rem;
        cursor: pointer;
        line-height: 1.3;
      }
      /* Bento Hero Grid */
      .ll-bento-hero {
        display: grid;
        grid-template-columns: 1.45fr 1fr;
        gap: 1rem;
        margin-top: 2rem;
        margin-bottom: 3rem;
      }
      @media (max-width: 860px) {
        .ll-bento-hero { grid-template-columns: 1fr; }
      }
      .ll-hero-card {
        background: var(--ll-surface);
        border: 1px solid var(--ll-border);
        border-radius: 18px;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }
      .ll-author-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.25rem;
      }
      .ll-avatar-sm {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--ll-border);
        flex-shrink: 0;
      }
      .ll-mono-label {
        font-family: var(--ll-font-mono);
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--ll-muted);
      }
      .ll-hero-card h1 {
        font-size: clamp(1.85rem, 3.2vw, 2.5rem) !important;
        line-height: 1.12;
        margin: 0 0 0.25rem 0;
        color: var(--ll-dark) !important;
      }
      .ll-hero-lead {
        font-size: 1.02rem;
        line-height: 1.65;
        color: var(--ll-text);
        margin: 0 0 1.5rem 0;
      }
      .ll-status-inline {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-family: var(--ll-font-mono);
        font-size: 0.72rem;
        color: var(--ll-accent);
        background: var(--ll-accent-soft);
        border: 1px solid var(--ll-accent-border);
        padding: 0.25rem 0.65rem;
        border-radius: 999px;
      }
      .ll-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #10b981;
        box-shadow: 0 0 6px #10b981;
        display: inline-block;
        animation: llPulse 2s infinite;
      }
      @keyframes llPulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.45; }
      }
      .ll-btn-row {
        display: flex;
        flex-wrap: wrap;
        gap: 0.65rem;
      }
      .ll-btn-solid {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: var(--ll-dark);
        color: var(--ll-bg) !important;
        padding: 0.62rem 1.15rem;
        border-radius: 10px;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none !important;
        transition: opacity 0.15s;
      }
      .ll-btn-solid:hover { opacity: 0.88; }
      .ll-btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: transparent;
        color: var(--ll-dark) !important;
        border: 1px solid var(--ll-border);
        padding: 0.62rem 1.15rem;
        border-radius: 10px;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none !important;
        transition: border-color 0.15s;
      }
      .ll-btn-outline:hover { border-color: var(--ll-dark); }
      /* Right Bento Terminal Card */
      .ll-terminal-card {
        background: #0c0c0f;
        color: #e4e4e7;
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 18px;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        font-family: var(--ll-font-mono);
      }
      .ll-term-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.72rem;
        color: #a1a1aa;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        margin-bottom: 1rem;
      }
      .ll-term-rows {
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
        font-size: 0.8rem;
      }
      .ll-term-row {
        display: flex;
        flex-direction: column;
        gap: 0.15rem;
      }
      .ll-term-k {
        font-size: 0.68rem;
        color: #71717a;
        text-transform: uppercase;
      }
      .ll-term-v {
        color: #fafafa;
        font-weight: 500;
      }
      .ll-term-cta {
        margin-top: 1.25rem;
        padding-top: 0.85rem;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.78rem;
      }
      .ll-term-cta a {
        color: #2dd4bf !important;
        text-decoration: none !important;
        font-weight: 600;
      }
      /* Section Headings (micro-label + clean title, no heavy underlines) */
      .ll-sec-head {
        margin-top: 3.25rem;
        margin-bottom: 1.25rem;
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        gap: 1rem;
        border-bottom: 1px solid var(--ll-border);
        padding-bottom: 0.6rem;
      }
      .ll-sec-head h2 {
        margin: 0 !important;
        font-size: 1.25rem !important;
        font-weight: 600 !important;
      }
      .ll-sec-head a {
        font-family: var(--ll-font-mono);
        font-size: 0.78rem;
        color: var(--ll-muted) !important;
        text-decoration: none !important;
      }
      .ll-sec-head a:hover { color: var(--ll-accent) !important; }
      /* Focus row (borderless clean columns!) */
      .ll-focus-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2.5rem;
      }
      @media (max-width: 781px) {
        .ll-focus-grid { grid-template-columns: 1fr; gap: 1.25rem; }
      }
      .ll-focus-item h3 {
        font-size: 1.02rem;
        margin: 0 0 0.45rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
      }
      .ll-focus-item p {
        font-size: 0.92rem;
        color: var(--ll-muted);
        margin: 0 0 0.75rem 0;
        line-height: 1.58;
      }
      /* Bento 2x2 Projects Grid */
      .ll-bento-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
      }
      @media (max-width: 781px) {
        .ll-bento-grid { grid-template-columns: 1fr; }
      }
      .ll-card {
        border: 1px solid var(--ll-border);
        border-radius: 14px;
        padding: 1.45rem;
        background: var(--ll-surface);
        transition: border-color 0.15s ease, transform 0.15s ease;
        box-sizing: border-box;
      }
      .ll-card:hover {
        border-color: var(--ll-accent);
        transform: translateY(-1px);
      }
      .ll-card h3 {
        margin: 0.35rem 0 0.5rem 0;
        font-size: 1.08rem;
        color: var(--ll-dark);
      }
      .ll-card h3 a {
        color: var(--ll-dark);
        text-decoration: none;
      }
      .ll-card h3 a:hover { color: var(--ll-accent); }
      .ll-card p {
        font-size: 0.92rem;
        color: var(--ll-muted);
        margin: 0;
        line-height: 1.58;
      }
      .ll-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem;
        margin-top: 0.85rem;
      }
      .ll-tag {
        display: inline-block;
        font-family: var(--ll-font-mono);
        font-size: 0.7rem;
        padding: 0.16rem 0.5rem;
        border-radius: 5px;
        background: var(--ll-surface-alt);
        color: var(--ll-muted);
        border: 1px solid var(--ll-border);
      }
      /* Lee Robinson style Editorial Post List on Home */
      .home .wp-block-query .wp-block-post-template {
        display: flex !important;
        flex-direction: column !important;
        gap: 0 !important;
      }
      .home .wp-block-query .ll-post-row {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        gap: 1rem;
        padding: 0.85rem 0.5rem;
        border-bottom: 1px solid var(--ll-border);
        border-radius: 8px;
        transition: background 0.12s ease;
      }
      .home .wp-block-query .ll-post-row:hover {
        background: var(--ll-surface-alt);
      }
      .home .wp-block-query .ll-post-row .wp-block-post-title {
        font-size: 0.98rem !important;
        font-weight: 500 !important;
        margin: 0 !important;
      }
      .home .wp-block-query .ll-post-row .wp-block-post-title a {
        color: var(--ll-dark) !important;
        text-decoration: none !important;
      }
      .home .wp-block-query .ll-post-row .wp-block-post-title a:hover {
        color: var(--ll-accent) !important;
      }
      .home .wp-block-query .ll-post-row .wp-block-post-date {
        font-family: var(--ll-font-mono);
        font-size: 0.78rem;
        color: var(--ll-muted);
        white-space: nowrap;
        flex-shrink: 0;
      }
      @media (max-width: 640px) {
        .home .wp-block-query .ll-post-row { flex-direction: column; gap: 0.2rem; }
      }
      /* Contact Grid & Form */
      .ll-contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
        gap: 0.75rem;
      }
      .ll-contact-item {
        display: block;
        padding: 0.85rem 1rem;
        border-radius: 10px;
        background: var(--ll-bg);
        border: 1px solid var(--ll-border);
        text-decoration: none !important;
        color: var(--ll-dark) !important;
        font-size: 0.9rem;
      }
      .ll-contact-item:hover { border-color: var(--ll-accent); }
      .ll-contact-label {
        display: block;
        font-family: var(--ll-font-mono);
        font-size: 0.68rem;
        text-transform: uppercase;
        color: var(--ll-muted);
        margin-bottom: 0.15rem;
      }
      .ll-cf-wrap { margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid var(--ll-border); }
      .ll-cf-form { display: flex; flex-direction: column; gap: 0.65rem; }
      .ll-cf-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.65rem; }
      @media (max-width: 640px) { .ll-cf-row { grid-template-columns: 1fr; } }
      .ll-cf-form input, .ll-cf-form textarea {
        width: 100%; box-sizing: border-box; padding: 0.65rem 0.85rem;
        border-radius: 8px; border: 1px solid var(--ll-border);
        background: var(--ll-bg); color: var(--ll-dark); font-family: inherit; font-size: 0.9rem;
      }
      .ll-cf-form input:focus, .ll-cf-form textarea:focus {
        outline: none; border-color: var(--ll-accent); background: var(--ll-surface);
      }
      .ll-cf-actions { display: flex; align-items: center; flex-wrap: wrap; gap: 0.75rem; }
      .ll-cf-btn {
        background: var(--ll-dark); color: var(--ll-bg); border: none; border-radius: 8px;
        padding: 0.62rem 1.2rem; font-weight: 600; font-size: 0.88rem; cursor: pointer;
      }
      .ll-cf-btn:disabled { opacity: 0.6; cursor: not-allowed; }
      .ll-cf-status { font-size: 0.88rem; color: var(--ll-dark); font-weight: 500; }
      /* Resume timeline, print & PDF */
      .ll-timeline { border-left: 1px solid var(--ll-border); padding-left: 1.5rem; margin-left: 0.5rem; }
      .ll-timeline-item { position: relative; margin-bottom: 1.25rem; }
      .ll-timeline-item::before {
        content: ""; position: absolute; left: -1.82rem; top: 0.45rem;
        width: 9px; height: 9px; border-radius: 50%; background: var(--ll-accent);
      }
      .ll-print-btn {
        display: inline-flex; align-items: center; gap: 0.4rem;
        background: var(--ll-dark); color: var(--ll-bg); border: none; border-radius: 8px;
        padding: 0.55rem 1rem; font-weight: 600; font-size: 0.88rem; cursor: pointer; margin-bottom: 1.25rem;
      }
      .ll-pdf-link {
        display: inline-flex; align-items: center; gap: 0.4rem;
        background: var(--ll-surface); color: var(--ll-dark) !important;
        border: 1px solid var(--ll-border); border-radius: 8px;
        padding: 0.52rem 1rem; font-weight: 600; font-size: 0.88rem; text-decoration: none !important; margin-left: 0.5rem;
      }
      /* Blog Archive, Category pills & Article reading polish */
      .ll-cat-bar { display: flex; flex-wrap: wrap; gap: 0.45rem; margin: 1rem 0 2rem; }
      .ll-cat-pill {
        display: inline-block; padding: 0.32rem 0.78rem; border-radius: 8px; font-size: 0.82rem; font-weight: 500;
        text-decoration: none !important; background: var(--ll-surface); color: var(--ll-muted) !important;
        border: 1px solid var(--ll-border); transition: all 0.15s ease;
      }
      .ll-cat-pill:hover, .ll-cat-pill.active { background: var(--ll-dark); color: var(--ll-bg) !important; border-color: var(--ll-dark); }
      .single-post .entry-content { max-width: 72ch !important; margin-left: auto !important; margin-right: auto !important; }
      .single-post .entry-content pre, .single-post .entry-content code { font-family: var(--ll-font-mono); }
      .single-post .entry-content pre {
        background: #0c0c0f; color: #e4e4e7; padding: 1.1rem 1.2rem;
        border-radius: 10px; overflow-x: auto; font-size: 0.86rem; border: 1px solid rgba(255,255,255,0.1);
      }
      .single-post .entry-content blockquote {
        border-left: 3px solid var(--ll-accent); background: var(--ll-surface-alt);
        padding: 0.9rem 1.2rem; border-radius: 0 10px 10px 0; margin: 1.5rem 0;
      }
      .ll-read-time { font-family: var(--ll-font-mono); font-size: 0.78rem; color: var(--ll-muted); margin-bottom: 1rem; }
      .ll-toc {
        background: var(--ll-surface); border: 1px solid var(--ll-border); border-left: 3px solid var(--ll-accent);
        border-radius: 10px; padding: 0.9rem 1.2rem; margin-bottom: 1.75rem;
      }
      .ll-toc-title { font-family: var(--ll-font-mono); font-weight: 600; font-size: 0.78rem; text-transform: uppercase; color: var(--ll-dark); margin-bottom: 0.4rem; }
      .ll-toc ul { margin: 0; padding-left: 1.15rem; }
      .ll-toc a { color: var(--ll-accent); text-decoration: none; font-size: 0.92rem; }
      .ll-pre-wrap { position: relative; }
      .ll-copy-btn {
        position: absolute; top: 0.5rem; right: 0.5rem;
        background: rgba(255,255,255,0.1); color: #e4e4e7; border: 1px solid rgba(255,255,255,0.18);
        border-radius: 6px; padding: 0.18rem 0.5rem; font-family: var(--ll-font-mono); font-size: 0.7rem; cursor: pointer;
      }
      .ll-post-nav { margin-top: 3rem; padding-top: 1.5rem; border-top: 1px solid var(--ll-border); }
      .ll-post-nav-title { font-family: var(--ll-font-mono); font-size: 0.75rem; text-transform: uppercase; color: var(--ll-muted); margin-bottom: 0.85rem; }
      .ll-post-nav-links { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.85rem; }
      .ll-post-nav-links a { text-decoration: none; color: var(--ll-dark); font-weight: 600; font-size: 0.92rem; display: block; }
      /* Footer */
      .ll-footer-wrap {
        border-top: 1px solid var(--ll-border);
        background: var(--ll-bg);
        padding: 2rem 1.25rem;
        margin-top: 4rem;
      }
      .ll-footer-inner {
        max-width: 1040px; margin: 0 auto; display: flex; flex-wrap: wrap;
        justify-content: space-between; align-items: center; gap: 1rem; font-size: 0.85rem; color: var(--ll-muted);
      }
      .ll-footer-links { display: flex; flex-wrap: wrap; gap: 1.15rem; }
      .ll-footer-links a { color: var(--ll-muted); text-decoration: none; }
      .ll-footer-links a:hover { color: var(--ll-dark); }
      #ll-toast {
        position: fixed; bottom: 1.5rem; right: 1.5rem; background: var(--ll-dark); color: var(--ll-bg);
        padding: 0.6rem 1rem; border-radius: 8px; font-size: 0.85rem; opacity: 0; pointer-events: none; transition: opacity 0.2s; z-index: 9999;
      }
      #ll-toast.show { opacity: 1; }
      @media (max-width: 781px) {
        html, body { overflow-x: hidden !important; }
        .wp-block-columns { flex-direction: column !important; flex-wrap: wrap !important; gap: 1rem !important; width: 100% !important; max-width: 100% !important; }
        .wp-block-columns > .wp-block-column { flex-basis: 100% !important; width: 100% !important; max-width: 100% !important; min-width: 0 !important; }
        .ll-hero-card, .ll-terminal-card { padding: 1.35rem; }
        .ll-nav-wrap { gap: 0.45rem; }
      }
      @media print {
        header.wp-block-template-part, .ll-footer-wrap, .ll-print-btn, .ll-pdf-link, #ll-read-progress { display: none !important; }
        body { background: #ffffff !important; color: #000000 !important; }
        .ll-card { border: 1px solid #cccccc !important; break-inside: avoid; }
      }
    </style>
    <script>
      (function() {
        var saved = localStorage.getItem('ll_theme');
        if (saved === 'dark') document.documentElement.setAttribute('data-theme', 'dark');
      })();
    </script>
    <?php
});

add_action('wp_footer', function () {
    ?>
    <div id="ll-read-progress"></div>
    <div id="ll-toast"></div>
    <script>
      (function() {
        var bar = document.getElementById('ll-read-progress');
        window.addEventListener('scroll', function() {
          var h = document.documentElement;
          var pct = (h.scrollTop / (h.scrollHeight - h.clientHeight || 1)) * 100;
          if (bar) bar.style.width = Math.min(100, Math.max(0, pct)) + '%';
        });

        document.addEventListener('click', function(e) {
          var tbtn = e.target && e.target.closest ? e.target.closest('#ll-theme-toggle') : null;
          if (tbtn) {
            var isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            if (isDark) {
              document.documentElement.removeAttribute('data-theme');
              localStorage.setItem('ll_theme', 'light');
              tbtn.textContent = '🌙';
            } else {
              document.documentElement.setAttribute('data-theme', 'dark');
              localStorage.setItem('ll_theme', 'dark');
              tbtn.textContent = '☀️';
            }
          }
        });
        var btn = document.getElementById('ll-theme-toggle');
        if (btn && document.documentElement.getAttribute('data-theme') === 'dark') {
          btn.textContent = '☀️';
        }

        // Auto TOC, Code Copy buttons & Mailto toast (re-runnable after PJAX navigation)
        window.llInitStylesPage = function() {
          var tocSlot = document.getElementById('ll-toc-slot');
          if (tocSlot && !tocSlot.dataset.llReady) {
            tocSlot.dataset.llReady = '1';
            var headings = document.querySelectorAll('.single-post .entry-content h2');
            if (headings.length >= 2) {
              var html = '<div class="ll-toc"><div class="ll-toc-title">Contents</div><ul>';
              headings.forEach(function(h, idx) {
                var id = h.id || ('sec-' + idx);
                h.id = id;
                html += '<li><a href="#' + id + '">' + h.textContent + '</a></li>';
              });
              html += '</ul></div>';
              tocSlot.innerHTML = html;
            }
          }

          document.querySelectorAll('.single-post .entry-content pre').forEach(function(pre) {
            if (pre.parentNode && pre.parentNode.classList && pre.parentNode.classList.contains('ll-pre-wrap')) return;
            var wrap = document.createElement('div');
            wrap.className = 'll-pre-wrap';
            pre.parentNode.insertBefore(wrap, pre);
            wrap.appendChild(pre);
            var cbtn = document.createElement('button');
            cbtn.className = 'll-copy-btn';
            cbtn.type = 'button';
            cbtn.textContent = 'Copy';
            cbtn.addEventListener('click', function() {
              navigator.clipboard.writeText(pre.innerText).then(function() {
                cbtn.textContent = 'Copied!';
                setTimeout(function() { cbtn.textContent = 'Copy'; }, 1500);
              });
            });
            wrap.appendChild(cbtn);
          });

          document.querySelectorAll('a[href^="mailto:lancer454@gmail.com"]').forEach(function(a) {
            if (a.dataset.llMailBound) return;
            a.dataset.llMailBound = '1';
            a.addEventListener('click', function(ev) {
              if (navigator.clipboard) {
                ev.preventDefault();
                navigator.clipboard.writeText('lancer454@gmail.com').then(function() {
                  var t = document.getElementById('ll-toast');
                  if (t) {
                    t.textContent = 'Copied: lancer454@gmail.com';
                    t.classList.add('show');
                    setTimeout(function() { t.classList.remove('show'); }, 2200);
                  }
                });
              }
            });
          });
        };
        window.llInitStylesPage();
      })();
    </script>
    <?php
});
