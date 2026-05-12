<!DOCTYPE html>
<html lang="zh-TW" html_lang="{{ App::getLocale() }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ ['en'=>'2026 Delta New Product Launch Event','tw'=>'2026 台達標準電源新品發表會','cn'=>'2026 台达标准电源新品发布会','jp'=>'2026 デルタ標準電源新製品発表イベント'][App::getLocale()] ?? '2026 Delta New Product Launch Event' }}</title>
<link rel="stylesheet" href="{{ asset('frontend-asset/css/all.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend-asset/css/fontello3.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" />
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<style>
/* =============================================
   FONTS
   ============================================= */
@font-face {
  font-family: 'DeltaEN';
  src: url('https://filecenter.deltaww.com/about/images/about-202604151021492063.ttf') format('truetype');
  font-weight: normal; font-style: normal; font-display: swap;
}
@font-face {
  font-family: 'DeltaTW';
  src: url('https://filecenter.deltaww.com/about/images/about-202604151019494841.otf') format('opentype');
  font-weight: normal; font-style: normal; font-display: swap;
}
main, main * { font-family: 'DeltaEN', Arial, sans-serif; }
html[lang="en"] main, html[lang="en"] main * { font-family: 'DeltaEN', Arial, sans-serif !important; }
html[lang="en"] main h1, html[lang="en"] main h2, html[lang="en"] main h3,
html[lang="en"] main .text-neon-solid, html[lang="en"] main .text-neon-outline { letter-spacing: 0.03em; }
html[html_lang="tw"] main, html[html_lang="tw"] main * { font-family: 'DeltaTW','DeltaEN',Arial,sans-serif !important; letter-spacing: 0em !important; }
html[html_lang="cn"] main, html[html_lang="cn"] main * { font-family: 'Microsoft YaHei','PingFang SC','Heiti SC',sans-serif !important; letter-spacing: 0em !important; }
html[lang="ja"] main, html[lang="ja"] main * { font-family: 'DeltaEN', Arial, sans-serif !important; letter-spacing: 0em !important; }

/* =============================================
   RESET & BASE
   ============================================= */
*, *::before, *::after { box-sizing: border-box; }
html { scroll-behavior: auto; overflow-x: clip; max-width: 100vw; }
body { margin: 0; padding: 0; overflow-x: clip; }
main { background-color: #000510; color: #fff; width: 100%; overflow-x: clip; }
main img, main video, main iframe { max-width: 100%; }
main h1, main h2, main h3, main h4, main .font-heading { font-family: inherit; color: #fff; }
main p, main .uk-text-meta { color: #fff; }
.barlow span { font-weight: 900 !important; letter-spacing: 0em !important; display: block; }

/* =============================================
   LAYOUT
   ============================================= */
section { min-height: 100vh; width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; box-sizing: border-box; padding: 80px 0; }
.container-wide { max-width: 1600px; margin: 0 auto; width: 92%; }
/* Push content below fixed header */
@media (max-width: 1199px) { main { padding-top: 75px; } }
@media (min-width: 1200px) { main { padding-top: 106px; } }
/* Anchor scroll offset for fixed header */
main section[id] { scroll-margin-top: 110px; }
@media (max-width: 1199px) { main section[id] { scroll-margin-top: 70px; } }
#scrollUp { display: none !important; }
#distributor { display: none !important; }
/* UIKit global reset leaks into header — restore baseline */
#nav-position svg, .invisible-nav-minimize svg,
.nav-mobile svg, #Sidenav svg { vertical-align: baseline; }
/* freeze header .power-supplies-link padding to server-rendered locale so JS lang switch won't affect it */
html .power-supplies-link { padding-top: {{ ['tw'=>'31px','cn'=>'31px','jp'=>'32px','de'=>'30px'][App::getLocale()] ?? '16px' }} !important; }
.fixed-bg-layer { position: fixed; top: 0; left: 0; width: 100%; height: 100vh; background-color: #000510; background-image: linear-gradient(rgba(0,242,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(0,242,255,0.03) 1px,transparent 1px); background-size: 40px 40px; z-index: -99; pointer-events: none; }

/* =============================================
   TYPOGRAPHY - SECTION HEADINGS
   ============================================= */
#features h2, #din-pro h2, #din-eco h2, #series-comparison h2,
#solutions h2, #contact h2, #overview h2, #certifications h2 {
  font-size: clamp(1.4rem, 3.2vw, 4rem) !important;
  font-weight: 800; letter-spacing: 0px; margin-bottom: 20px; line-height: 1.1;
}
#contact h2, #overview h2 { font-size: clamp(2rem, 4.5vw, 6rem) !important; font-weight: 900; }
#contact h2 [data-i18n="contact.titleMid"] { text-shadow: 0 0 20px rgba(0,220,255,0.9), 0 0 40px rgba(0,180,255,0.7), 0 0 80px rgba(0,140,255,0.5); font-size: clamp(2rem, 4.5vw, 6rem) !important; }
section p { font-size: clamp(0.85rem, 1.3vw, 1.4rem) !important; line-height: 1.8 !important; opacity: 0.9; font-weight: 300; max-width: 800px; margin-left: auto; margin-right: auto; margin-bottom: 40px; }
#overview h2, #overview h2 span { color: #fff !important; }

/* =============================================
   NEON TEXT
   ============================================= */
.text-neon-outline { font-size: clamp(2rem,5.5vw,7rem) !important; line-height: 1; font-weight: 900; letter-spacing: 2px; color: transparent; -webkit-text-stroke: 1.5px #05a3f7; }
.text-neon-solid { font-size: clamp(1.2rem,3vw,4.5rem) !important; line-height: 1; font-weight: 900; letter-spacing: 4px; color: #fff; margin-top: 10px; }
#contact h2.font-heading .text-neon-solid { font-size: inherit !important; letter-spacing: inherit; line-height: inherit; margin-top: 0; display:inline !important; }
.text-cyan { color: #05a3f7 !important; text-shadow: none; }
.text-green { color: #00F1CD !important; text-shadow: none; }

/* =============================================
   BACKGROUNDS - SECTIONS
   ============================================= */
#intro.video-bg-section { position: relative; z-index: 10 !important; }
#features { background-color: #0B0A19; padding-bottom: 100px; position: relative; z-index: 10; }
#overview, #certifications, #series-comparison, #solutions, #contact { position: relative; z-index: 10 !important; background-color: #021224; }
#series-comparison { background: #021224; }
#solutions { background: #021224; padding-bottom: 60px !important; }
#contact { background-image: url('https://filecenter.deltaww.com/about/images/about-202603311607198995.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 100vh; height: auto; padding-top: 80px; padding-bottom: 80px; }
#din-sections-wrapper { position: relative; z-index: 2; }
#din-sections-wrapper section { overflow: visible !important; }
#din-pro { background: transparent !important; position: relative; z-index: 2; min-height: 100vh !important; padding-top: 80px !important; padding-bottom: 120px !important; }
#din-eco { background: transparent !important; position: relative; z-index: 2; min-height: 100vh !important; padding-top: 80px !important; padding-bottom: 80px !important; }
#din-bg-video { position: fixed; top: 0; left: 0; width: 100%; height: 100vh; z-index: 1; pointer-events: none; clip-path: inset(100% 0 0 0); }
#din-bg-video video { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }

/* =============================================
   NAVBAR
   ============================================= */
.uk-navbar-container { background: transparent !important; padding: 20px 0; transition: all 0.3s; z-index: 999; }
.uk-navbar-sticky.uk-active { background: rgba(5,5,5,0.95) !important; backdrop-filter: blur(10px); padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.05); }
.glass-pill { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 100px; padding: 0 30px; height: 46px; display: flex; align-items: center; }
.custom-navbar { display: flex; align-items: center; justify-content: space-between; width: 100%; padding: 20px 0; }
.custom-navbar-left, .custom-navbar-right { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
.custom-navbar-center { flex: 1; display: flex; justify-content: center; }
.custom-nav { list-style: none; margin: 0; padding: 0; display: flex; align-items: center; height: 46px; }
.custom-nav li { display: flex; align-items: center; }
.custom-nav li a { display: flex; align-items: center; height: 46px; padding: 0 14px; font-size: 0.8rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: rgba(255,255,255,0.85); text-decoration: none; transition: color 0.3s; white-space: nowrap; }
.custom-nav li a:hover { color: #fff; }
.custom-nav li a.nav-dinpro { color: #05a3f7; }
.custom-nav li a.nav-dineco { color: #00F1CD; }
.recording-dot { display: inline-block; width: 6px; height: 6px; background: #ff3b30; border-radius: 50%; margin-right: 6px; animation: pulse 2s infinite; }
@keyframes pulse { 0%,100%{opacity:0.5;} 50%{opacity:1;} }

/* =============================================
   LANG SWITCHER
   ============================================= */
#langSwitcher { top: 80px !important; }
@media (min-width: 1200px) { #langSwitcher { top: 121px !important; } }
.lang-switcher { position: relative; }
.lang-switcher-btn { display: flex; align-items: center; gap: 6px; padding: 6px 14px 6px 12px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 100px; color: #fff !important; font-size: 0.78rem; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; cursor: pointer; transition: all 0.25s; white-space: nowrap; user-select: none; }
.lang-switcher-btn * { color: #fff !important; }
.lang-switcher-btn:hover { background: rgba(255,255,255,0.15); border-color: rgba(255,255,255,0.3); }
.lang-caret { transition: transform 0.25s; }
.lang-switcher.open .lang-caret { transform: rotate(180deg); }
.lang-dropdown { position: absolute; top: calc(100% + 8px); right: 0; background: rgba(8,12,22,0.97); border: 1px solid rgba(0,242,255,0.2); border-radius: 14px; padding: 8px; min-width: 160px; box-shadow: 0 10px 40px rgba(0,0,0,0.6); backdrop-filter: blur(20px); opacity: 0; pointer-events: none; transform: translateY(-6px) scale(0.97); transition: all 0.2s cubic-bezier(0.2,0.8,0.2,1); z-index: 10000; }
.lang-switcher.open .lang-dropdown { opacity: 1; pointer-events: all; transform: translateY(0) scale(1); }
.lang-option { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 8px; cursor: pointer; color: #fff !important; font-size: 0.82rem; font-weight: 500; transition: background 0.2s; }
.lang-option:hover { background: rgba(0,242,255,0.08); }
.lang-option.active { background: rgba(0,242,255,0.12); }
.lang-name { flex: 1; color: #fff !important; }
.lang-check { width: 14px; height: 14px; color: #05a3f7; opacity: 0; flex-shrink: 0; }
.lang-option.active .lang-check { opacity: 1; }

/* =============================================
   BUTTONS
   ============================================= */
.btn-cyber { background: linear-gradient(90deg,#05a3f7,#05a3f7); color: #fff !important; font-weight: bold; text-transform: uppercase; border: none; border-radius: 50px; padding: 10px 30px; transition: all 0.3s; text-decoration: none; display: inline-block; font-size: 0.9rem; cursor: pointer; }
.btn-cyber:hover { color: #fff; transform: scale(1.05); }
.btn-notify { background: linear-gradient(135deg,#05a3f7,#05a3f7); color: #fff !important; font-weight: bold; text-transform: uppercase; border: none; border-radius: 50px; padding: 16px 40px; font-size: 1.1rem; letter-spacing: 1px; transition: all 0.4s ease; cursor: pointer; display: inline-flex; align-items: center; }
.btn-notify:hover { transform: translateY(-3px) scale(1.05); }
.btn-notify span { color: #fff !important; }
.filter-pill { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.2); color: #fff; padding: 6px 20px; border-radius: 50px; cursor: pointer; transition: all 0.3s; font-family: Arial,sans-serif !important; }
.filter-pill.active, .filter-pill:hover { background: #05a3f7; color: #000; border-color: #05a3f7; }
.scroll-top-btn { position: fixed; bottom: 30px; right: 30px; z-index: 99999; width: 50px; height: 50px; border-radius: 50%; background: #05a3f7; color: #fff; display: flex; justify-content: center; align-items: center; border: 2px solid rgba(255,255,255,0.2); transition: all 0.3s; }
.scroll-top-btn:hover { background: #05a3f7; color: #000; }
#promo-mini-btn { position: fixed; bottom: 90px; right: 30px; z-index: 99998; width: 50px; height: 50px; border-radius: 50%; background: #05a3f7; color: #fff; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255,255,255,0.2); cursor: pointer; box-shadow: 0 4px 16px rgba(0,0,0,0.4); transition: transform 0.2s, background 0.2s; padding: 0; }
#promo-mini-btn:hover { transform: scale(1.1); background: #0384cc; }
#promo-mini-btn img { display: none; }
/* Floating DIN product buttons — hide on mobile (uses bottom-nav) */
#floating-product-btns { display: flex; }
@media (max-width: 900px) { #floating-product-btns { display: none !important; } }

/* =============================================
   WATTAGE FILTER
   ============================================= */
.wattage-filter { display: inline-flex; align-items: center; justify-content: center; gap: 2px; margin-bottom: 40px; background: rgba(10,20,40,0.55); border: 1px solid rgba(255,255,255,0.12); border-radius: 50px; padding: 5px; backdrop-filter: blur(10px); }
.watt-btn { background: transparent; border: none; color: rgba(255,255,255,0.75); padding: 8px 22px; border-radius: 50px; cursor: pointer; font-size: 0.95rem; font-weight: 600; letter-spacing: 0.3px; transition: color 0.25s,background 0.25s,box-shadow 0.25s; white-space: nowrap; }
.watt-btn:hover:not(.active) { color: #fff; background: rgba(255,255,255,0.07); }
.pro-theme .watt-btn.active { background: #05a3f7; color: #fff; font-weight: 700; }
.eco-theme .watt-btn.active { background: #00F1CD; color: #000; font-weight: 700; }

/* =============================================
   CARDS - COMMON
   ============================================= */
.cyber-card { background: linear-gradient(180deg,rgba(0,20,40,0.4),rgba(0,10,20,0.6)); border: 1px solid rgba(0,242,255,0.3); border-radius: 12px; padding: 30px; transition: all 0.3s; }
.cyber-card:hover { border-color: rgba(0,242,255,0.6); }
.video-frame { border: 1px solid rgba(0,242,255,0.5); background: rgba(0,20,40,0.5); border-radius: 8px; overflow: hidden; position: relative; width: 100%; aspect-ratio: 16/9; }
.input-neon { background: rgba(0,20,40,0.6) !important; border: 1px solid rgba(0,242,255,0.3) !important; color: #fff !important; border-radius: 4px; transition: all 0.3s; }
.input-neon:focus { border-color: #05a3f7 !important; }

/* =============================================
   BENTO GRID
   ============================================= */
.bento-grid-horiz { display: grid; gap: 15px; width: 100%; height: auto !important; }

/* Desktop: 4-col layout */
@media (min-width: 1200px) {
  .bento-grid-horiz { grid-template-columns: repeat(4,1fr); grid-template-rows: 1fr 1fr; align-items: stretch; }
  .pro-layout .pos-1 { grid-column: 1/3; grid-row: 1/2; }
  .pro-layout .pos-2 { grid-column: 3/4; grid-row: 1/2; }
  .pro-layout .pos-3 { grid-column: 4/5; grid-row: 1/2; }
  .pro-layout .pos-4 { grid-column: 1/2; grid-row: 2/3; }
  .pro-layout .pos-5 { grid-column: 2/3; grid-row: 2/3; }
  .pro-layout .pos-6 { grid-column: 3/5; grid-row: 2/3; }
  .eco-layout .pos-1 { grid-column: 3/5; grid-row: 1/2; }
  .eco-layout .pos-2 { grid-column: 1/2; grid-row: 1/2; }
  .eco-layout .pos-3 { grid-column: 2/3; grid-row: 1/2; }
  .eco-layout .pos-4 { grid-column: 1/3; grid-row: 2/3; }
  .eco-layout .pos-5 { grid-column: 3/4; grid-row: 2/3; }
  .eco-layout .pos-6 { grid-column: 4/5; grid-row: 2/3; }
}

/* =============================================
   FEATURE CARDS
   ============================================= */
#din-pro .feature-card,
#din-eco .feature-card {
  position: relative; display: flex !important; flex-direction: column !important;
  align-items: center !important; justify-content: center !important; text-align: center !important;
  padding: clamp(10px,1.5vw,20px) !important; overflow: hidden !important;
  height: 100% !important; box-sizing: border-box !important; container-type: inline-size;
  will-change: transform; backface-visibility: hidden;
}
#din-pro .feature-card.pro-theme { border: 1px solid rgba(80,160,255,0.35) !important; }
#din-eco .feature-card.eco-theme { border: 1px solid rgba(0,210,190,0.35) !important; }
#din-pro .feature-card.pro-theme:hover { background: linear-gradient(180deg,rgba(0,0,0,0.55),rgba(0,80,200,0.65)) !important; border-color: rgba(5,163,247,0.70) !important; }
#din-eco .feature-card.eco-theme:hover { background: linear-gradient(180deg,rgba(0,0,0,0.55),rgba(0,150,160,0.65)) !important; border-color: rgba(0,241,205,0.70) !important; }
#din-pro .feature-card:hover, #din-eco .feature-card:hover { transform: translateY(-5px) translateZ(0) !important; }

/* Shared class for repeated inline backgrounds */
.pro-card-bg { background: linear-gradient(180deg,rgba(0,0,0,0.55) 0%,rgba(0,20,60,0.75) 60%,rgba(0,60,160,0.85) 85%,rgba(200,220,255,0.35) 100%) !important; }

.eco-card-bg { background: linear-gradient(180deg,rgba(0,0,0,0.55) 0%,rgba(0,40,50,0.75) 60%,rgba(0,120,140,0.85) 85%,rgba(200,220,255,0.35) 100%) !important; }

/* Wide cards row direction */
#din-pro .feature-card.pos-1, #din-eco .feature-card.pos-1,
#din-pro .feature-card.pos-6, #din-eco .feature-card.pos-4 {
  flex-direction: row !important; gap: clamp(8px,1.5vw,24px) !important;
}

/* Small cards */
#din-pro .bento-grid-horiz .feature-card.pos-2,
#din-pro .bento-grid-horiz .feature-card.pos-3,
#din-pro .bento-grid-horiz .feature-card.pos-4,
#din-pro .bento-grid-horiz .feature-card.pos-5,
#din-eco .bento-grid-horiz .feature-card.pos-2,
#din-eco .bento-grid-horiz .feature-card.pos-3,
#din-eco .bento-grid-horiz .feature-card.pos-5,
#din-eco .bento-grid-horiz .feature-card.pos-6 {
  display: flex !important; flex-direction: column !important;
  align-items: center !important; justify-content: flex-end !important;
  text-align: center !important;
  padding: clamp(12px,2vw,28px) clamp(10px,1.5vw,20px) !important;
  gap: clamp(6px,0.8vw,10px) !important; overflow: hidden !important;
}
/* Icon zone */
#din-pro .bento-grid-horiz .feature-card.pos-2 .icon-wrap,
#din-pro .bento-grid-horiz .feature-card.pos-3 .icon-wrap,
#din-pro .bento-grid-horiz .feature-card.pos-4 .icon-wrap,
#din-pro .bento-grid-horiz .feature-card.pos-5 .icon-wrap,
#din-eco .bento-grid-horiz .feature-card.pos-2 .icon-wrap,
#din-eco .bento-grid-horiz .feature-card.pos-3 .icon-wrap,
#din-eco .bento-grid-horiz .feature-card.pos-5 .icon-wrap,
#din-eco .bento-grid-horiz .feature-card.pos-6 .icon-wrap {
  flex: 1 1 auto; width: 100%; display: flex; align-items: center; justify-content: center;
}
/* Desc fixed min-height */
#din-pro .bento-grid-horiz .feature-card.pos-2 p,
#din-pro .bento-grid-horiz .feature-card.pos-3 p,
#din-pro .bento-grid-horiz .feature-card.pos-4 p,
#din-pro .bento-grid-horiz .feature-card.pos-5 p,
#din-eco .bento-grid-horiz .feature-card.pos-2 p,
#din-eco .bento-grid-horiz .feature-card.pos-3 p,
#din-eco .bento-grid-horiz .feature-card.pos-5 p,
#din-eco .bento-grid-horiz .feature-card.pos-6 p {
  min-height: 2.6em !important;
}

/* ── ALL TITLES unified ── */
.feature-card .card-header,
.pos1-subtitle,
.temp-label {
  font-size: clamp(0.88rem,1.3vw,1.25rem) !important;
  font-weight: 700 !important; line-height: 1.2 !important; margin: 0 !important;
  padding: 0 !important; background-color: transparent !important; border-bottom: none !important;
}
.feature-card p, .temp-range, .pos1-label {
  font-size: clamp(0.72rem,0.85vw,0.95rem) !important; line-height: 1.3 !important;
  color: rgba(255,255,255,0.80) !important;
  display: -webkit-box !important; -webkit-line-clamp: 3 !important;
  -webkit-box-orient: vertical !important; overflow: hidden !important; margin: 0 !important;
}
.feature-card img { max-width: 50cqw !important; max-height: 50cqw !important; width: auto !important; height: auto !important; object-fit: contain !important; }

/* Small card images */
#din-pro .feature-card.pos-2 img, #din-pro .feature-card.pos-3 img,
#din-pro .feature-card.pos-4 img, #din-pro .feature-card.pos-5 img,
#din-eco .feature-card.pos-2 img, #din-eco .feature-card.pos-3 img,
#din-eco .feature-card.pos-5 img, #din-eco .feature-card.pos-6 img {
  width: clamp(48px,7.5vw,110px) !important; height: clamp(48px,7.5vw,110px) !important;
  object-fit: contain !important; display: block !important; flex-shrink: 0 !important;
}

/* =============================================
   POS-1 CARD
   ============================================= */
.pos1-icon { width: clamp(44px,5.5vw,110px); height: clamp(44px,5.5vw,110px); object-fit: contain; display: block; flex-shrink: 0; max-width: 100%; }
.pos1-big-num { font-size: clamp(1.4rem,4.5vw,4.2rem); font-weight: 800; line-height: 1.1; margin: 0; padding-top: clamp(2px,0.3vw,5px); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.pos1-subtitle { font-size: clamp(0.9rem,1.4vw,1.5rem); font-weight: 700; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.pos1-label { font-size: clamp(0.72rem,0.85vw,0.95rem); color: #fff; margin: 0; letter-spacing: 0.8px; font-weight: 400; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.pos1-note { font-size: clamp(0.6rem,0.65vw,0.72rem); color: rgba(255,255,255,0.55); margin-top: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
/* Extra gap between label and big num in icon-wrap */
#din-pro .feature-card.pos-1 .icon-wrap .pos1-label,
#din-eco .feature-card.pos-1 .icon-wrap .pos1-label {
  margin-bottom: clamp(6px,0.8vw,12px) !important;
}


/* ECO "3 Phase" */
#din-eco .feature-card.pos-1 .pos1-big-num { font-size: clamp(1rem,2.6vw,2.6rem) !important; white-space: nowrap !important; }
@media (max-width: 1280px) { #din-eco .feature-card.pos-1 .pos1-big-num { font-size: clamp(0.9rem,2.2vw,2.2rem) !important; } }
@media (max-width: 1100px) { #din-eco .feature-card.pos-1 .pos1-big-num { font-size: clamp(0.8rem,2vw,2rem) !important; } }
/* PRO "150%" */
#din-pro .feature-card.pos-1 .pos1-big-num { font-size: clamp(1rem,2.6vw,2.6rem) !important; }
/* Peak Power title unified */
#din-pro .feature-card.pos-1 .pos1-subtitle,
#din-eco .feature-card.pos-1 .pos1-subtitle {
  font-size: clamp(0.88rem,1.3vw,1.25rem) !important; font-weight: 700 !important; margin: 0 !important;
}
/* pos-1 text column flex */
#din-pro .feature-card.pos-1 > div:last-child,
#din-eco .feature-card.pos-1 > div:last-child {
  justify-content: flex-end !important; align-items: flex-start !important;
  align-self: stretch !important; gap: clamp(6px,0.8vw,10px) !important;
}
/* pos-1 icon-wrap takes remaining space */
#din-pro .feature-card.pos-1 > div:last-child .icon-wrap,
#din-eco .feature-card.pos-1 > div:last-child .icon-wrap {
  flex: 1 1 auto; display: flex; flex-direction: column; align-items: flex-start; justify-content: center;
}
/* pos-1 desc fixed min-height */
#din-pro .feature-card.pos-1 > div:last-child .pos1-label:last-child {
  min-height: 2.6em !important;
}

/* =============================================
   TEMPERATURE CARD
   ============================================= */
#din-pro .feature-card.pos-6,
#din-eco .feature-card.pos-4 {
  display: flex !important; flex-direction: row !important; align-items: center !important;
  justify-content: center !important; overflow: hidden !important; min-height: 0 !important;
  height: 100% !important; flex-wrap: nowrap !important;
}
.temp-icon-wrap { flex-shrink: 0; display: flex; align-items: center; justify-content: center; min-width: 0; }
.temp-icon { width: clamp(36px,5vw,100px); height: clamp(36px,5vw,100px); object-fit: contain; flex-shrink: 1; display: block; }
.temp-text-wrap { min-width: 0; min-height: 0; flex-shrink: 1; overflow: hidden; display: flex; flex-direction: column; justify-content: center; gap: clamp(2px,0.4vw,6px); align-items: flex-start !important; text-align: left !important; }
.temp-label { font-size: clamp(0.88rem,1.3vw,1.25rem) !important; color: #fff; font-weight: 700 !important; letter-spacing: 0.5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.temp-big-num { font-size: clamp(1rem,2.6vw,2.6rem) !important; font-weight: 800 !important; line-height: 1.1; white-space: nowrap; overflow: hidden; }
.temp-to { font-size: clamp(0.7rem,1.2vw,1.2rem); font-weight: 400; color: #ffffff !important; }
.temp-range { font-size: clamp(0.72rem,6cqw,0.92rem); color: rgba(255,255,255,0.80); letter-spacing: 0.3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
/* PRO pos-6 temp number grid */
#din-pro .feature-card.pos-6 .temp-big-num {
  display: inline-grid !important; grid-template-columns: 0.6em auto !important;
  align-items: baseline !important; color: #05a3f7 !important;
}
#din-pro .feature-card.pos-6 .temp-big-num .temp-sign { color: #05a3f7 !important; display: block !important; text-align: center !important; }
#din-pro .feature-card.pos-6 .temp-big-num .temp-digits { color: #05a3f7 !important; display: block !important; }
#din-pro .feature-card.pos-6 .temp-big-num .temp-to { color: #fff !important; font-size: 0.45em !important; margin-left: 0.3em !important; }
/* ECO pos-4 temp number grid */
#din-eco .feature-card.pos-4 .temp-big-num {
  display: inline-grid !important; grid-template-columns: 0.6em auto !important;
  align-items: baseline !important; color: #00F1CD !important;
}
#din-eco .feature-card.pos-4 .temp-big-num .temp-sign { color: #00F1CD !important; display: block !important; text-align: center !important; }
#din-eco .feature-card.pos-4 .temp-big-num .temp-digits { color: #00F1CD !important; display: block !important; }
#din-eco .feature-card.pos-4 .temp-big-num .temp-to { color: #fff !important; font-size: 0.45em !important; margin-left: 0.3em !important; }

/* =============================================
   SOLUTION CARDS
   ============================================= */
#product-grid { display: grid !important; grid-template-columns: repeat(3,1fr) !important; gap: 20px !important; width: 100% !important; align-items: start !important; }
#product-grid > div.sol-hidden { display: none !important; }
.product-grid-container { min-height: 500px; margin-bottom: 60px; container-type: inline-size; }
/* Lock grid container height to prevent content below from shifting when cards are filtered */
#product-grid { grid-auto-rows: 1fr; }
.solution-card { will-change: transform; backface-visibility: hidden; }
.solution-card:hover { transform: translateY(-5px) !important; }
.solution-card-new { position: relative; border-radius: 16px; overflow: hidden; cursor: pointer; aspect-ratio: 4/3; display: block; width: 100%; }
.solution-card-new img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.4s ease; }
.solution-card-new:hover img { transform: scale(1.05); }
.solution-card-new .sol-title-bar { position: absolute; top: 0; left: 0; right: 0; background: #05a3f7; padding: 12px 18px; font-size: 1.15rem; font-weight: 700; color: #fff; text-align: center; letter-spacing: 0.02em; z-index: 2; }
.solution-card-new:hover .sol-title-bar { background: #0084cc; }
.solution-card-new.eco .sol-title-bar { background: #05a3f7; }
.solution-card-new.eco:hover .sol-title-bar { background: #0084cc; }
.product-grid-container { min-height: 500px; margin-bottom: 60px; }

/* =============================================
   EXCELLENCE CARDS
   ============================================= */
.excellence-card { background: linear-gradient(180deg,rgba(20,30,50,0.6),rgba(10,15,30,0.9)); border: 1px solid rgba(0,242,255,0.15); border-radius: 24px; padding: 30px 30px 0; min-height: 360px; display: flex; flex-direction: column; justify-content: flex-start; text-align: center; position: relative; overflow: hidden; transition: all 0.4s cubic-bezier(0.25,0.8,0.25,1); }
.excellence-card:hover { transform: translateY(-8px) scale(1.02); border-color: rgba(0,242,255,0.4); }
.excellence-title { font-size: clamp(1rem,1.8vw,1.8rem); font-weight: 700; color: #05a3f7; margin-bottom: 15px; line-height: 1.3; }
.excellence-desc { font-size: clamp(0.75rem,1vw,1rem); color: rgba(255,255,255,0.85); line-height: 1.6; margin-bottom: 10px; flex-shrink: 0; }
.excellence-visual { margin-top: auto; width: 100%; height: 180px; display: flex; align-items: center; justify-content: center; padding: 10px 0; overflow: visible; }
.excellence-visual img { width: auto; max-width: 75%; height: auto; max-height: 150px; object-fit: contain; transition: all 0.4s cubic-bezier(0.25,0.8,0.25,1); }
.excellence-card:hover .excellence-visual img { transform: scale(1.08) translateY(-5px); }

/* =============================================
   CERTIFICATIONS
   ============================================= */
#certifications { min-height: 100vh; background: #021224; display: flex; align-items: center; justify-content: center; padding: 80px 20px; position: relative; z-index: 10; }
.cert-wrapper { max-width: 1600px; width: 92%; margin: 0 auto; position: relative; z-index: 2; }
.cert-header { text-align: center; margin-bottom: 16px; }
.cert-header h2 { font-weight: 800; margin-bottom: 20px; line-height: 1.1; color: #fff; }
.cert-header p { font-size: clamp(0.85rem,1.3vw,1.4rem) !important; line-height: 1.8 !important; opacity: 0.9; max-width: 800px; margin: 0 auto 30px; color: rgba(255,255,255,0.9); }
.cert-cards-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 18px; width: 100%; max-width: 1400px; margin: 0 auto; }
@media (min-width: 901px) and (max-width: 1500px) { .cert-cards-grid { grid-template-columns: repeat(2,1fr) !important; } }
.cert-card-new { background: #000d1a; border: 3px solid rgba(0,210,255,0.75); border-radius: 16px; padding: clamp(12px,2vw,28px) clamp(12px,2.2vw,32px); display: flex; flex-direction: row; align-items: center; justify-content: flex-start; gap: clamp(10px,1.5vw,24px); transition: all 0.3s ease; min-height: clamp(80px,10vw,130px); position: relative; overflow: hidden; }
.cert-card-inner-block { display: flex; flex-direction: row; align-items: center; justify-content: flex-start; gap: clamp(10px,1.5vw,24px); width: 100%; }
.cert-card-new:hover { border-color: rgba(0,235,255,1); transform: translateY(-3px); background: #001525; }
.cert-card-logo { width: clamp(36px,6vw,96px); height: clamp(36px,6vw,96px); flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
.cert-card-logo img { width: 100%; height: 100%; object-fit: contain; }
.cert-card-info { display: flex; flex-direction: column; justify-content: center; flex: 1; min-width: 0; overflow: hidden; }
.cert-card-label { display: none; }
.cert-card-code { font-size: clamp(0.65rem,1.3vw,1.4rem); font-weight: 800; color: #05a3f7; line-height: 1.15; margin-bottom: 4px; }
.cert-card-desc { font-size: clamp(0.6rem,1vw,0.92rem); color: rgba(255,255,255,0.75); line-height: 1.3; }
.accordion-panel { cursor: default !important; background: transparent !important; border: none !important; box-shadow: none !important; }

/* =============================================
   COMPARISON TABLE
   ============================================= */
.compare-wrap { display: flex; gap: 8px; width: 100%; overflow-x: auto; border-radius: 20px; }
.compare-feature-col { flex: 0 0 150px; min-width: 150px; display: flex; flex-direction: column; background: #10141e; border-radius: 16px 0 0 16px; overflow: hidden; }
.compare-feature-col .cf-header { flex: 0 0 auto; height: 130px; min-height: 130px; display: flex; align-items: center; justify-content: center; padding: 16px; font-size: 1.2rem; font-weight: 700; color: #fff; border-bottom: 1px solid rgba(255,255,255,0.07); }
.compare-feature-col .cf-row { display: flex; align-items: center; justify-content: center; padding: 0 10px; height: 68px; min-height: 68px; max-height: 68px; font-size: 1.2rem; font-weight: 700; color: #fff; border-bottom: 1px solid rgba(255,255,255,0.08); text-align: center; line-height: 1.3; flex-shrink: 0; }
.compare-feature-col .cf-row-btn { height: 72px; min-height: 72px; max-height: 72px; }
.compare-feature-col .cf-row:last-child, .compare-feature-col .cf-row-powerboost { height: 88px; min-height: 88px; max-height: 88px; }
.compare-group { flex: 1 1 0; display: flex; flex-direction: column; border-radius: 16px; overflow: hidden; min-width: 0; }
.compare-group-pro { border: 2px solid #05a3f7; }
.compare-group-header { display: flex; align-items: stretch; flex: 0 0 auto; }
.compare-col-header { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; padding: 16px 12px; min-height: 130px; }
.compare-col-header-inner { display: flex; align-items: center; justify-content: center; gap: 10px; }
.compare-col-name { font-size: 1.3rem; font-weight: 800; line-height: 1.25; text-align: center; }
.compare-col-img { width: 130px; height: 90px; object-fit: contain; filter: drop-shadow(0 3px 6px rgba(0,0,0,0.5)); }
.compare-group-pro .compare-col-header { background: #05a3f7; color: #fff; }
.compare-group-body { display: flex; flex: 1; }
.compare-data-col { flex: 1; display: flex; flex-direction: column; min-width: 0; }
.compare-data-col + .compare-data-col { border-left: 1px solid rgba(255,255,255,0.07); }
.compare-data-cell { display: flex; flex-direction: row; align-items: center; justify-content: center; padding: 10px 14px; height: 68px; min-height: 68px; max-height: 68px; font-size: 1.2rem; color: #fff !important; text-align: center; line-height: 1.4; gap: 6px; box-sizing: border-box; flex-shrink: 0; position: relative; overflow: hidden; opacity: 1 !important; }
.compare-data-cell span, .compare-data-cell div { color: #fff !important; opacity: 1 !important; }
.compare-data-cell::after { content:''; position:absolute; bottom:0; left:8%; right:8%; height:1px; background:linear-gradient(90deg,transparent,rgba(255,255,255,0.12) 30%,rgba(255,255,255,0.2) 50%,rgba(255,255,255,0.12) 70%,transparent); }
.compare-data-cell-btn::after { display: none; }
.compare-data-cell-btn { height: 72px !important; min-height: 72px !important; max-height: 72px !important; display: flex !important; align-items: center !important; justify-content: center !important; }
.cell-powerboost { height: 88px !important; min-height: 88px !important; max-height: 88px !important; }
.cmp-check { display: inline-flex; align-items: center; justify-content: center; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); width: 24px; height: 24px; border-radius: 50%; flex-shrink: 0; }
.cmp-check-pro { background: #05a3f7; }
.cmp-check-gt { background: #4a6a85; }
.cmp-check svg { width: 12px; height: 12px; fill: none; stroke: #fff; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }
.compare-note { font-size: 0.68rem; color: rgba(255,255,255,1); display: block; margin-top: 3px; line-height: 1.3; }
.compare-learn-more { display: inline-block; padding: 8px 22px; border-radius: 50px; font-size: 0.82rem; font-weight: 700; letter-spacing: 1px; text-decoration: none; transition: opacity 0.2s; }
.compare-learn-more:hover { opacity: 0.8; }
.compare-learn-more-pro { background: #05a3f7; color: #fff !important; }

/* =============================================
   NOTIFY MODAL
   ============================================= */
.uk-modal { z-index: 10000 !important; background: rgba(0,5,16,0.92) !important; backdrop-filter: blur(10px); display: none; }
.uk-modal.uk-open { display: block !important; }
.notify-modal-content { background: linear-gradient(180deg,#0a1628,#050a14) !important; border: 2px solid rgba(0,242,255,0.3) !important; border-radius: 20px !important; padding: clamp(24px,5vw,50px) clamp(20px,5vw,40px) !important; max-width: min(500px, calc(100vw - 32px)) !important; width: 100% !important; box-sizing: border-box !important; }
.notify-icon { width: 80px; height: 80px; background: linear-gradient(135deg,rgba(0,242,255,0.2),rgba(0,132,255,0.2)); border: 2px solid #05a3f7; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px; color: #05a3f7; }
.notify-title { font-size: 2rem; font-weight: 800; color: #fff; margin-bottom: 15px; }
.notify-desc { font-size: 1rem; color: rgba(255,255,255,0.7); margin-bottom: 30px; line-height: 1.6; }
.notify-checkbox { display: flex; align-items: flex-start; gap: 10px; color: rgba(255,255,255,0.8); font-size: 0.9rem; cursor: pointer; }
.notify-checkbox input[type="checkbox"] { margin-top: 3px; width: 18px; height: 18px; accent-color: #05a3f7; }
.notify-features { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 25px; }
.notify-features p { color: rgba(255,255,255,0.7); margin-top: 8px; }

/* =============================================
   ANIMATIONS
   ============================================= */
.reveal-up { opacity: 1; transform: translateY(0); transition: all 1s cubic-bezier(0.16,1,0.3,1); }
.reveal-up.active { opacity: 1; transform: translateY(0); }
.delay-100 { transition-delay: 0.1s; }
.delay-200 { transition-delay: 0.2s; }
.delay-300 { transition-delay: 0.3s; }
.scroll-down-container { position: absolute; bottom: 50px; left: 50%; transform: translateX(-50%); display: flex; flex-direction: column; align-items: center; text-decoration: none; color: rgba(255,255,255,0.6) !important; transition: all 0.3s ease; cursor: pointer; z-index: 50; }
.scroll-down-container:hover { color: #fff !important; transform: translateX(-50%) translateY(5px); }
.scroll-down-text { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 5px; font-weight: bold; }
.scroll-arrow { animation: bounce-arrow 2s infinite; }
@keyframes bounce-arrow { 0%,20%,50%,80%,100%{transform:translateY(0);}40%{transform:translateY(-10px);}60%{transform:translateY(-5px);} }
.site-footer { background: #000510; border-top: 1px solid rgba(0,242,255,0.2); padding: 5px 0; width: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column; }

/* =============================================
   SIDE NAV
   ============================================= */
.side-nav { position: fixed; left: 16px; top: 50%; transform: translateY(-50%); z-index: 9990; display: flex; flex-direction: column; align-items: center; gap: 6px; background: rgba(10,20,40,0.85) !important; border: 1px solid rgba(255,255,255,0.18); border-radius: 20px; padding: 12px 8px; backdrop-filter: blur(14px); box-shadow: 0 8px 32px rgba(0,0,0,0.6); width: 32px; overflow: visible; transition: width 0.28s cubic-bezier(0.4,0,0.2,1),padding 0.28s cubic-bezier(0.4,0,0.2,1),opacity 0.28s ease; opacity: 0.2; }
.side-nav:hover { width: 130px; padding: 12px 10px; align-items: flex-start; opacity: 1; }
.side-nav a { display: flex !important; align-items: center !important; gap: 8px !important; padding: 7px 6px !important; color: #fff !important; font-size: 0.67rem !important; font-weight: 700 !important; letter-spacing: 1.1px !important; text-transform: uppercase !important; text-decoration: none !important; border-radius: 10px !important; white-space: nowrap !important; width: 100% !important; box-sizing: border-box !important; transition: background 0.18s !important; position: relative !important; }
.side-nav a:hover, .side-nav a.active { background: rgba(255,255,255,0.12) !important; }
.side-nav a.nav-dinpro { color: #05a3f7 !important; }
.side-nav a.nav-dinpro:hover, .side-nav a.nav-dinpro.active { background: rgba(5,163,247,0.15) !important; }
.side-nav a.nav-dineco { color: #00F1CD !important; }
.side-nav a.nav-dineco:hover, .side-nav a.nav-dineco.active { background: rgba(0,241,205,0.15) !important; }
.nav-dot { flex-shrink: 0 !important; display: inline-block !important; width: 7px !important; height: 7px !important; border-radius: 50% !important; background: rgba(255,255,255,0.6) !important; transition: transform 0.2s,box-shadow 0.2s !important; }
.side-nav a.nav-dinpro .nav-dot { background: #05a3f7 !important; }
.side-nav a.nav-dineco .nav-dot { background: #00F1CD !important; }
.side-nav a.active .nav-dot, .side-nav a:hover .nav-dot { transform: scale(1.35) !important; }
.side-nav-live-dot { display: inline-block !important; width: 7px !important; height: 7px !important; background: #ff3b30 !important; border-radius: 50% !important; flex-shrink: 0 !important; animation: pulse-dot 2s infinite !important; }
@keyframes pulse-dot { 0%,100%{opacity:0.5;}50%{opacity:1;} }
.nav-label { overflow: hidden !important; max-width: 0 !important; display: inline-block !important; transition: max-width 0.28s cubic-bezier(0.4,0,0.2,1) !important; color: inherit !important; }
.side-nav:hover .nav-label { max-width: 110px !important; }
.side-nav-divider { width: 14px; height: 1px; background: rgba(255,255,255,0.2); margin: 2px 0; transition: width 0.28s; align-self: center; }
.side-nav:hover .side-nav-divider { width: 100%; }
@media (max-width: 900px) { .side-nav { display: none !important; } }

/* =============================================
   MOBILE BOTTOM NAV
   ============================================= */
.mobile-bottom-nav { display: none; position: fixed; bottom: 0; left: 0; right: 0; z-index: 9990; background: rgba(8,14,28,0.92); border-top: 1px solid rgba(255,255,255,0.12); backdrop-filter: blur(16px); padding: 0 0 env(safe-area-inset-bottom,0px) 0; box-shadow: 0 -4px 24px rgba(0,0,0,0.5); }
@media (max-width: 900px) { .mobile-bottom-nav { display: flex; } body { padding-bottom: calc(56px + env(safe-area-inset-bottom,0px)); } .scroll-top-btn { width: 34px; height: 34px; bottom: calc(56px + env(safe-area-inset-bottom,0px) + 10px); right: 10px; } #floating-product-btns { display: none !important; } #promo-mini-btn { width: 34px; height: 34px; bottom: calc(56px + env(safe-area-inset-bottom,0px) + 54px); right: 10px; border-radius: 50%; } }
.mobile-bottom-nav ul { list-style: none; margin: 0; padding: 0; display: flex; width: 100%; align-items: stretch; }
.mobile-bottom-nav ul li { flex: 1 1 0; min-width: 0; display: flex; position: relative; }
.mobile-bottom-nav ul li a { display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 2px; padding: 6px 0; width: 100%; text-decoration: none; color: rgba(255,255,255,0.5); font-size: 0.46rem; font-weight: 700; letter-spacing: 0.3px; text-transform: uppercase; transition: color 0.2s; text-align: center; overflow: hidden; }
.mobile-bottom-nav ul li a svg { width: 16px; height: 16px; flex-shrink: 0; }
.mobile-bottom-nav ul li a:hover, .mobile-bottom-nav ul li a.active { color: rgba(255,255,255,0.95); }
.mobile-bottom-nav ul li a.nav-dinpro { color: rgba(5,163,247,0.55); }
.mobile-bottom-nav ul li a.nav-dinpro.active { color: #05a3f7; }
.mobile-bottom-nav ul li a.nav-dineco { color: rgba(0,241,205,0.55); }
.mobile-bottom-nav ul li a.nav-dineco.active { color: #00F1CD; }
.mobile-bottom-nav ul li a.active::after { content:''; display:block; position:absolute; top:0; width:24px; height:2px; border-radius:0 0 2px 2px; background:currentColor; }

/* =============================================
   CONTACT FORM
   ============================================= */
.cf-error { color: #ff4444; font-size: 0.8rem; margin-top: 4px; display: none; }
.cf-error.visible { display: block; }
.input-neon.cf-invalid { border-color: #ff4444 !important; }
.contact-textarea { resize: vertical; }
/* Contact left column: always left-align text */
#contact p, #contact h2 { text-align: left !important; margin-left: 0 !important; margin-right: 0 !important; }

/* =============================================
   RESPONSIVE BREAKPOINTS
   ============================================= */
@media (max-width: 1440px) {
  section { padding: 60px 0 !important; min-height: 0 !important; }
  #overview { min-height: 100vh !important; }
  #din-pro, #din-eco { padding-bottom: 80px !important; }
  .bento-grid-horiz { grid-template-columns: repeat(4,1fr) !important; gap: 12px !important; }
}
@media (max-width: 1280px) {
  .container-wide { width: 96% !important; }
  section { padding: 50px 0 !important; min-height: 0 !important; }
  #overview { min-height: 100vh !important; }
  .bento-grid-horiz { grid-template-columns: repeat(4,1fr) !important; gap: 10px !important; }
  .excellence-title { font-size: 1.4rem !important; }
  .excellence-card { min-height: 270px !important; padding: 20px 18px 0 !important; }
}
@media (max-width: 1100px) {
  section { padding: 40px 0 !important; min-height: 0 !important; }
  .bento-grid-horiz { grid-template-columns: repeat(4,1fr) !important; gap: 8px !important; }
  #din-pro .bento-grid-horiz .feature-card,
  #din-eco .bento-grid-horiz .feature-card { padding: 14px 12px !important; height: auto !important; }
  .excellence-card { min-height: auto !important; padding: 16px 14px 0 !important; }
}
@media (min-width: 901px) and (max-width: 1100px) {
  #din-pro .feature-card.pos-1, #din-eco .feature-card.pos-1 { flex-direction: row !important; gap: 16px !important; padding: 20px !important; }
  #din-pro .feature-card.pos-6, #din-eco .feature-card.pos-4 { flex-direction: row !important; gap: 16px !important; padding: 20px 16px !important; }
}
@media (min-width: 769px) and (max-width: 900px) {
  .bento-grid-horiz { grid-template-columns: 1fr 1fr !important; height: auto !important; }
  #din-pro .bento-grid-horiz > .pos-1, #din-eco .bento-grid-horiz > .pos-1,
  #din-pro .bento-grid-horiz > .pos-6, #din-eco .bento-grid-horiz > .pos-4 { grid-column: 1 / -1 !important; }
  #din-pro .feature-card.pos-1, #din-eco .feature-card.pos-1 { flex-direction: column !important; align-items: center !important; text-align: center !important; padding: 20px 16px !important; gap: 14px !important; }
  #din-pro .feature-card.pos-6, #din-eco .feature-card.pos-4 { flex-direction: row !important; align-items: center !important; justify-content: center !important; gap: 20px !important; }
}
@media (max-width: 960px) { #product-grid { grid-template-columns: repeat(2,1fr) !important; } }
@media (max-width: 900px) {
  .cert-cards-grid { grid-template-columns: 1fr; gap: 12px; }
  .cert-card-new { padding: 12px 14px; gap: 10px; min-height: 80px; }
  .cert-card-logo { width: 52px; height: 52px; }
  .cert-card-logo img { width: 46px; height: 46px; }
  .cert-card-code { font-size: clamp(0.7rem,3.5vw,1rem); white-space: nowrap; }
  .cert-card-label { font-size: 0.62rem; }
  .cert-card-desc { font-size: 0.68rem; }
  .compare-feature-col { flex: 0 0 110px; min-width: 110px; }
  .compare-col-name { font-size: 0.95rem; }
  .compare-col-img { width: 96px; height: 68px; }
  .compare-data-cell { font-size: 0.78rem; padding: 8px 10px; min-height: 58px; height: auto; }
}
@media (max-width: 1280px) {
  .scroll-down-container { display: none !important; }
}
@media (min-width: 769px) and (max-width: 1280px) {
  #intro { min-height: 520px !important; }
  #intro div[data-i18n="hero.title"] { font-size: clamp(1rem,3.8vw,3.5rem) !important; white-space: nowrap !important; }
  #intro div[data-i18n="overview.videoExpiry"] { font-size: clamp(0.6rem,1.4vw,1.1rem) !important; }
  /* Contact section: let it grow to fit content on tablets */
  #contact { height: auto !important; min-height: 0 !important; padding-top: 60px !important; padding-bottom: 80px !important; }
  .site-footer { padding-bottom: 32px !important; }
}

/* =============================================
   DIN PRO/ECO: FIT IN ONE SCREEN (medium viewport height)
   Targets windows where height is less than content natural height
   Does NOT affect large screens (tall viewports)
   ============================================= */
@media (min-width: 769px) and (max-height: 860px) {
  #din-pro, #din-eco {
    padding-top: 40px !important;
    padding-bottom: 40px !important;
  }
  #din-pro .uk-margin-large-bottom,
  #din-eco .uk-margin-large-bottom {
    margin-bottom: 16px !important;
  }
  #din-pro h2, #din-eco h2 {
    margin-bottom: 6px !important;
  }
  #din-pro p[data-i18n], #din-eco p[data-i18n] {
    margin-bottom: 10px !important;
  }
  /* Product image: shrink to fit */
  #din-pro .product-img-wrap,
  #din-eco .product-img-wrap {
    height: 220px !important;
    max-height: 220px !important;
  }
  /* Wattage filter: tighter */
  .wattage-filter { margin-bottom: 12px !important; }
  /* Bento grid: reduce gap and card padding */
  #din-pro .bento-grid-horiz,
  #din-eco .bento-grid-horiz {
    gap: 10px !important;
  }
  #din-pro .feature-card,
  #din-eco .feature-card {
    padding: 10px !important;
  }
  .pos1-big-num { font-size: clamp(1.2rem, 3vw, 2.8rem) !important; }
  .pos1-subtitle { font-size: clamp(0.8rem, 1.2vw, 1.1rem) !important; }
  .pos1-label, .pos1-note { font-size: clamp(0.65rem, 0.75vw, 0.82rem) !important; }
  .pos1-icon { width: clamp(36px, 4vw, 80px) !important; height: clamp(36px, 4vw, 80px) !important; }
  .temp-big-num { font-size: clamp(1rem, 2.2vw, 2rem) !important; }
  .temp-icon { width: clamp(30px, 3.5vw, 60px) !important; height: clamp(30px, 3.5vw, 60px) !important; }
  .feature-card img { max-width: 38cqw !important; max-height: 38cqw !important; }
  #din-pro .feature-card.pos-2 img, #din-pro .feature-card.pos-3 img,
  #din-pro .feature-card.pos-4 img, #din-pro .feature-card.pos-5 img,
  #din-eco .feature-card.pos-2 img, #din-eco .feature-card.pos-3 img,
  #din-eco .feature-card.pos-5 img, #din-eco .feature-card.pos-6 img {
    width: clamp(28px, 4vw, 64px) !important;
    height: clamp(28px, 4vw, 64px) !important;
    margin-bottom: 4px !important;
  }
  .feature-card .card-header { font-size: clamp(0.8rem, 1.2vw, 1.1rem) !important; margin-bottom: 2px !important; }
  .feature-card p { font-size: clamp(0.7rem, 0.9vw, 0.88rem) !important; }
  /* Learn More button: tighter */
  #din-pro .btn-cyber, #din-eco .btn-cyber {
    padding: 8px 20px !important;
    font-size: 0.82rem !important;
    margin-top: 8px !important;
  }

  /* ── CERTIFICATIONS: compress into one screen ── */
  #certifications {
    padding: 40px 20px !important;
    min-height: 100vh !important;
    justify-content: center !important;
  }
  .cert-header { margin-bottom: 10px !important; }
  .cert-header h2 { margin-bottom: 8px !important; }
  .cert-header p { margin-bottom: 12px !important; line-height: 1.4 !important; }
  /* 3 columns so 9 cards = 3 rows, all visible */
  .cert-cards-grid {
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 10px !important;
  }
  .cert-card-new {
    min-height: 0 !important;
    padding: 12px 16px !important;
    gap: 12px !important;
  }
  .cert-card-logo {
    width: clamp(28px, 3.5vw, 56px) !important;
    height: clamp(28px, 3.5vw, 56px) !important;
  }
  .cert-card-code { font-size: clamp(0.7rem, 1.1vw, 1.1rem) !important; margin-bottom: 2px !important; }
  .cert-card-desc { font-size: clamp(0.6rem, 0.85vw, 0.82rem) !important; }
}
@media (max-width: 768px) {
  section, #din-pro, #din-eco, #features, #certifications, #series-comparison, #solutions, #contact, #overview { height: auto !important; min-height: 0 !important; max-height: none !important; overflow: visible !important; }
  #contact { padding-top: 48px !important; padding-bottom: 80px !important; }
  .site-footer { padding-bottom: calc(56px + env(safe-area-inset-bottom, 0px) + 16px) !important; }
  #overview { min-height: 0 !important; padding-top: 36px !important; padding-bottom: 36px !important; }
  #overview.video-bg-section { padding-top: 36px !important; padding-bottom: 36px !important; }
  #solutions { padding-top: 40px !important; padding-bottom: 20px !important; }
  #solutions .uk-margin-large-bottom { margin-bottom: 16px !important; }
  #solutions .product-grid-container { margin-bottom: 0 !important; padding-bottom: 0 !important; min-height: 520px !important; }
  #solutions #product-grid { margin-bottom: 0 !important; padding-bottom: 0 !important; }
  #solutions .container-wide { padding-bottom: 0 !important; }
  #certifications { padding: 40px 16px !important; min-height: 0 !important; }
  #intro { height: auto !important; min-height: 520px !important; max-height: none !important; padding: 0 !important; }
  /* Hero inner: keep center alignment but add bottom padding so content doesn't hit countdown */
  #intro > div[style*="justify-content:center"] { padding: 40px 16px 140px !important; box-sizing: border-box !important; }
  /* Countdown stays absolute at bottom, just reduce bottom offset on mobile */
  #hero-countdown { bottom: clamp(10px,2.5vh,32px) !important; gap: 6px !important; }
  /* INFINITY READY */
  #intro h2.text-neon-solid[data-i18n="hero.subtitle"] { font-size: clamp(0.7rem,3.5vw,1.1rem) !important; margin-bottom: 4px !important; }
  /* NEW PRODUCT LAUNCH EVENT 2026 */
  #intro div[data-i18n="overview.event.line2"] { font-size: clamp(0.6rem,2.8vw,0.85rem) !important; letter-spacing: 2px !important; margin-bottom: 12px !important; }
  /* Launch date tag */
  #intro div[data-i18n="overview.videoExpiry"] { font-size: clamp(0.5rem,2.5vw,0.85rem) !important; letter-spacing: 1px !important; }
  .bento-grid-horiz, .bento-grid-horiz[style] { display: grid !important; grid-template-columns: 1fr 1fr !important; grid-template-rows: auto !important; height: auto !important; gap: 10px !important; }
  #din-pro .bento-grid-horiz > .pos-1, #din-eco .bento-grid-horiz > .pos-1 { grid-column: 1 / -1 !important; }
  #din-pro .bento-grid-horiz > .pos-6, #din-eco .bento-grid-horiz > .pos-4 { grid-column: 1 / -1 !important; }
  #din-pro .feature-card.pos-1, #din-eco .feature-card.pos-1 { flex-direction: column !important; align-items: center !important; text-align: center !important; padding: 16px 12px !important; gap: 10px !important; }
  #din-pro .feature-card.pos-1 > div:last-child,
  #din-eco .feature-card.pos-1 > div:last-child { align-items: center !important; text-align: center !important; width: 100% !important; justify-content: center !important; gap: 0 !important; }
  #din-pro .feature-card.pos-1 .pos1-subtitle,
  #din-eco .feature-card.pos-1 .pos1-subtitle { margin: 0 !important; }
  /* Temp card: keep left-aligned on mobile */
  #din-pro .feature-card.pos-6 .temp-text-wrap,
  #din-eco .feature-card.pos-4 .temp-text-wrap { align-items: flex-start !important; text-align: left !important; }
  #din-pro .feature-card.pos-6, #din-eco .feature-card.pos-4 { flex-direction: row !important; align-items: center !important; justify-content: center !important; gap: 10px !important; padding: 14px 10px !important; }
  #din-pro .bento-grid-horiz .feature-card, #din-eco .bento-grid-horiz .feature-card { padding: clamp(8px,2.5vw,16px) !important; align-items: center !important; text-align: center !important; }
  .pos1-big-num { font-size: 2rem !important; }
  .pos1-subtitle { font-size: 1rem !important; }
  .pos1-label { font-size: 0.68rem !important; }
  .pos1-note { font-size: 0.58rem !important; }
  .pos1-icon { width: 38px !important; height: 38px !important; }
  .temp-big-num { font-size: 1.5rem !important; }
  .temp-label { font-size: 0.65rem !important; margin-bottom: 4px !important; }
  .temp-range { font-size: 0.6rem !important; }
  .temp-icon { width: 32px !important; height: 32px !important; }
  /* ECO 3 Phase on mobile */
  #din-eco .feature-card.pos-1 .pos1-big-num { font-size: 2rem !important; }
  /* PRO 150% on mobile */
  #din-pro .feature-card.pos-1 .pos1-big-num { font-size: 1.5rem !important; }
  #din-pro h2, #din-eco h2, #features h2, #series-comparison h2, #solutions h2, #contact h2, #overview h2, #certifications h2 { font-size: clamp(1.4rem,5.5vw,2rem) !important; }
  section p { font-size: 0.85rem !important; margin-bottom: 10px !important; }
  .container-wide { width: 94% !important; padding-left: 16px !important; padding-right: 16px !important; }
  /* Product image wrapper — collapse fixed 400px height on mobile */
  .product-img-wrap { height: auto !important; min-height: 0 !important; max-height: 60vw !important; }
  .static-product-img { height: auto !important; max-height: 58vw !important; width: auto !important; max-width: 90% !important; }
  /* Wattage filter — respect screen edges like certifications table */
  .wattage-filter { width: calc(100% - 32px) !important; margin-left: auto !important; margin-right: auto !important; box-sizing: border-box !important; flex-wrap: wrap !important; justify-content: center !important; }
  .watt-btn { padding: 6px 10px !important; font-size: 0.8rem !important; }
  .scroll-down-container { display: none !important; }
  h1.text-neon-solid.hero-title { font-size: clamp(1.4rem,10vw,2.2rem) !important; line-height: 1.1 !important; }
  #intro div[data-i18n="hero.title"] { white-space: normal !important; font-size: clamp(1rem,5.5vw,2.2rem) !important; }
  .excellence-card { padding: 14px 12px 0 !important; }
  .excellence-title { font-size: 1rem !important; min-height: 2.6em !important; display: flex !important; align-items: flex-start !important; justify-content: center !important; margin-bottom: 0 !important; }
  .excellence-desc { font-size: 0.8rem !important; min-height: 7.5em !important; }
  .excellence-visual { height: 90px !important; min-height: 90px !important; max-height: 90px !important; }
  #product-grid { grid-template-columns: repeat(2,1fr) !important; gap: 8px !important; }
  .solution-card-new .sol-title-bar { font-size: 0.82rem !important; padding: 8px 10px !important; }
  .cert-cards-grid { grid-template-columns: 1fr !important; gap: 10px !important; }
  .cert-card-code { white-space: normal !important; overflow: visible !important; text-overflow: unset !important; }
  .cert-card-desc { white-space: normal !important; overflow: visible !important; text-overflow: unset !important; }
  .compare-feature-col { flex: 0 0 90px; min-width: 90px; }
  .compare-col-header { min-height: 100px !important; padding: 10px 6px !important; }
  .compare-feature-col .cf-header { height: 100px !important; min-height: 100px !important; font-size: 0.85rem !important; padding: 8px !important; }
  .compare-col-header-inner { flex-direction: column !important; gap: 4px !important; }
  .compare-col-name { font-size: 0.85rem !important; line-height: 1.2 !important; }
  .compare-col-img { width: 52px !important; height: 38px !important; }
  .compare-data-cell { font-size: 0.68rem; padding: 6px 28px 6px 6px; height: 56px !important; min-height: 56px !important; max-height: 56px !important; overflow: hidden; text-align: center !important; justify-content: center !important; }
  .compare-data-cell > span:not(.cmp-check), .compare-data-cell > div:not(.cmp-check) { text-align: center !important; width: 100% !important; }
  .cmp-check { width: 16px !important; height: 16px !important; min-width: 16px !important; min-height: 16px !important; }
  .cell-powerboost { height: 80px !important; min-height: 80px !important; max-height: 80px !important; }
  .compare-feature-col .cf-row { height: 56px !important; min-height: 56px !important; max-height: 56px !important; font-size: 0.85rem !important; }
  .compare-feature-col .cf-row-powerboost { height: 80px !important; min-height: 80px !important; max-height: 80px !important; }
  .compare-feature-col .cf-row-btn { height: 60px !important; min-height: 60px !important; max-height: 60px !important; }
  .compare-data-cell-btn { height: 60px !important; min-height: 60px !important; max-height: 60px !important; padding: 8px 4px !important; }
  .compare-data-cell.has-check { flex-direction: row; justify-content: center; align-items: center; padding: 6px 28px 6px 6px; }
  .cmp-check { position: absolute; right: 4px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; }
  .compare-note { font-size: 0.58rem; }
  .compare-learn-more { padding: 6px 14px !important; font-size: 0.72rem !important; }
  .notify-modal-content { padding: 24px 20px !important; max-width: calc(100vw - 32px) !important; }
  .notify-title { font-size: 1.3rem !important; }
  .custom-nav li a { padding: 0 5px !important; font-size: 0.6rem !important; letter-spacing: 0 !important; }
  #promo-dialog { width: calc(100% - 24px) !important; height: auto !important; }
  #cert-modal .uk-modal-dialog { padding: 20px 16px !important; }
  #cert-modal h2 { font-size: 1rem !important; }
  #cert-modal [style*="grid-template-columns: repeat(3"] { grid-template-columns: repeat(2,1fr) !important; gap: 8px !important; }
}

/* Custom scrollbar for cert-modal inner dialog */
/* Contact form labels: force white text */
#contact .uk-form-label,
#contact label.uk-form-label,
#contact label.uk-form-label span,
#contact label.uk-form-label [data-i18n] { color: #fff !important; }
#cert-modal > div::-webkit-scrollbar { width: 5px; }
#cert-modal > div::-webkit-scrollbar-track { background: rgba(255,255,255,0.04); border-radius: 10px; }
#cert-modal > div::-webkit-scrollbar-thumb { background: rgba(5,163,247,0.35); border-radius: 10px; }
#cert-modal > div::-webkit-scrollbar-thumb:hover { background: rgba(5,163,247,0.6); }
#cert-modal > div { scrollbar-width: thin; scrollbar-color: rgba(5,163,247,0.35) rgba(255,255,255,0.04); }

/* On smaller screens, allow cert-modal dialog to scroll */
@media (max-height: 750px), (max-width: 768px) {
  #cert-modal { align-items: flex-start !important; overflow-y: auto !important; padding: 20px 0 !important; }
  #cert-modal > div { max-height: none !important; overflow: visible !important; margin: auto !important; padding: 24px 20px !important; }
  .cert-iec-grid { grid-template-columns: repeat(2,1fr) !important; }
  .cert-emc-grid { grid-template-columns: 1fr !important; }
  #certifications .cert-card-code { font-size: clamp(0.85rem,4vw,1.2rem) !important; white-space: normal !important; overflow: visible !important; text-overflow: unset !important; }
  #certifications .cert-card-desc { font-size: clamp(0.75rem,3.5vw,0.95rem) !important; white-space: normal !important; overflow: visible !important; text-overflow: unset !important; }
  #certifications .cert-card-new { padding: 16px 18px !important; gap: 16px !important; overflow: hidden !important; }
  #certifications .cert-card-logo { width: clamp(48px,10vw,64px) !important; height: clamp(48px,10vw,64px) !important; flex-shrink: 0 !important; }
  #certifications .cert-card-logo img { width: 100% !important; height: 100% !important; }
}
@media (max-width: 480px) {
  #din-pro h2, #din-eco h2, #features h2, #series-comparison h2, #solutions h2, #contact h2, #overview h2 { font-size: clamp(1.2rem,5vw,1.6rem) !important; }
  .custom-nav li a { font-size: 0.52rem !important; padding: 0 4px !important; }
}

/* =============================================
   YOUTUBE & PROMO MODALS
   ============================================= */
#yt-modal { visibility: hidden; opacity: 0; pointer-events: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.88); z-index: 999999; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(6px); transition: opacity 0.25s ease,visibility 0.25s ease; }
#yt-modal.is-open { visibility: visible; opacity: 1; pointer-events: auto; }
#yt-dialog { position: relative; width: 80vw; height: calc(80vw * 9 / 16); max-height: 80vh; max-width: calc(80vh * 16 / 9); background: #000; border-radius: 16px; overflow: hidden; border: 1px solid rgba(5,163,247,0.25); transform: translateY(30px) scale(0.97); transition: transform 0.3s cubic-bezier(0.25,0.8,0.25,1); }
#yt-modal.is-open #yt-dialog { transform: translateY(0) scale(1); }
#yt-dialog iframe { position: absolute; inset: 0; width: 100%; height: 100%; border: none; display: block; }
#yt-close { position: absolute; top: -44px; right: 0; background: transparent; border: none; color: rgba(255,255,255,0.9); font-size: 2.4rem; width: 40px; height: 40px; cursor: pointer; display: flex; align-items: center; justify-content: center; line-height: 1; transition: color 0.2s,transform 0.2s; padding: 0; }
#yt-close:hover { color: #05a3f7; transform: scale(1.15); }
#promo-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.75); z-index: 99999; align-items: center; justify-content: center; backdrop-filter: blur(4px); animation: promoFadeIn 0.3s ease; }
#promo-overlay.is-open { display: flex; }
@keyframes promoFadeIn { from{opacity:0;}to{opacity:1;} }
#promo-dialog { position: relative; background: #000; border: 1px solid rgba(5,163,247,0.3); border-radius: 16px; width: min(85vw,calc(100% - 40px)); overflow: hidden; animation: promoSlideUp 0.35s cubic-bezier(0.25,0.8,0.25,1); line-height: 0; }
@keyframes promoSlideUp { from{transform:translateY(30px);opacity:0;}to{transform:translateY(0);opacity:1;} }
#promo-close { position: absolute; top: 10px; right: 14px; background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.2); color: #fff; font-size: 1.1rem; width: 28px; height: 28px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 1; transition: background 0.2s; }
#promo-close:hover { background: rgba(5,163,247,0.5); }
#promo-img-wrap { width: 100%; display: block; line-height: 0; }
#promo-img-wrap img { width: 100%; height: auto; max-height: 88vh; object-fit: cover; display: block; }

/* =============================================
   OFFICES MODAL
   ============================================= */
#offices-modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85); z-index: 99999; align-items: center; justify-content: center; }
#offices-modal.is-open { display: flex !important; }
#offices-dialog { background: #0d1524; border: 1px solid rgba(5,163,247,0.25); border-radius: 12px; padding: 16px 18px; max-width: 500px; width: calc(100% - 40px); max-height: 70vh; overflow-y: auto; position: relative; font-size: 13px; line-height: 1.5; }
#offices-dialog h2 { font-size: 15px !important; color: #05a3f7; text-align: center; margin: 0 0 12px; font-weight: 700; }
#offices-dialog h3 { font-size: 13px !important; color: #05a3f7; font-weight: 700; margin: 0 0 7px; border-bottom: 1px solid rgba(5,163,247,0.3); padding-bottom: 3px; }
#offices-dialog .o-name { color: #fff; font-weight: 600; margin: 0 0 1px; }
#offices-dialog .o-addr { color: #aaa; margin: 0 0 1px; }
#offices-dialog .o-hq { color: #fff; font-size: 10px; }
#offices-dialog .o-entry { margin-bottom: 8px; }
</style>
<script>window._serverLang = '{{ $htmlLang }}'; window._csrfToken = '{{ csrf_token() }}'; window._locale = '{{ App::getLocale() }}';</script>
</head>



<body>
<script>
function subscribe(){document.getElementById("inp3").focus();$('#cxacceptPrivacy_data').val(0);$("#cxacceptPrivacy_data").prop("checked",false);}
function toggle_visibility(id){var e=document.getElementById(id);if(e.style.visibility=='visible'){$('#in-sidenav').css('visibility','visible');e.style.visibility='hidden';}else{e.style.visibility='visible';$('#in-sidenav').css('visibility','hidden');}}
function toggle_only(e,id){e.preventDefault();e.stopPropagation();toggle_visibility(id);}
function openNav(){var e=document.getElementById('in-sidenav');if(e.style.visibility=='hidden'){$('#in-sidenav').css('visibility','visible');$('#search-box-mobile').hide();document.getElementById("Sidenav").classList.add("show");document.getElementById('bg-backslidenav').style.display="block";$('.menu-buger').addClass('active');}else{$('#in-sidenav').css('visibility','hidden');document.getElementById("Sidenav").classList.remove("show");document.getElementById('bg-backslidenav').style.display="none";$('.menu-buger').removeClass('active');}}
function closeNav(){$('#in-sidenav').css('visibility','hidden');$('.menu-buger').removeClass('active');document.getElementById("Sidenav").classList.remove("show");document.getElementById('bg-backslidenav').style.display="none";}
function showListCoparison(){document.getElementById("nav-comparison-mobile").style.height="fit-content";document.getElementById("editList").style.display="none";}
function hideListCoparison(){document.getElementById("nav-comparison-mobile").style.height="80px";document.getElementById("editList").style.display="block";}
function changeLangLocationmobile(){var link=$('#select-mobile-lang').val();window.location=link;}
function clickLangLocationmobile(link){window.location=link;}
function setlocaltion(lang,link){$.ajax({url:"{{ route('setlocaltion') }}",data:{'lang':lang},type:'POST',headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')||window._csrfToken},success:function(res){window.location=link;}});}
function bigImg(image,id){if(image!=''){$('.imageNav'+id).attr('src','{{ config('app.url') }}/medias/categories/'+image);}else{$('.imageNav'+id).attr('src','{{ asset('frontend-asset/image/blank.png') }}');}}
function mainCate(id){if(id=='sub1'){$('.imageNav2').attr('src',"{{ asset('frontend-asset/image/Industrial_Power_Supplies.png') }}");}else if(id=='sub2'){$('.imageNav1').attr('src',"{{ asset('frontend-asset/image/Medical-Power-Supplies.png') }}");}else if(id=='sub4'){$('.imageNav4').attr('src',"{{ asset('frontend-asset/image/battery_charging_new.webp') }}");}$('.sub-menu').removeClass('active');$('#'+id).addClass('active');}
function deleteComparison(id){$.ajax({url:"{{ route('RemovedataInSection') }}",data:{'data':id},type:'POST',headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')||window._csrfToken},success:function(res){$('#numberselect').text(res['data'].length);$('#numberselect-mobile').text(res['data'].length);}});}
$(document).ready(function(){
  $('.btn-sidenav').css('visibility','hidden');
  $(".megamenu").on("click",function(e){e.stopPropagation();});
  $('#nav-two').addClass('scrolled');
  $('#nav-two li a').on("click",function(){$('#nav-two').removeClass('bg-nav');$('#nav-two').addClass('scrolled');});
  $('#search-box').hide();$('#search-box-mobile').hide();
  $("#dropdown08").click(function(){$("#search-box").toggle();$('#nav-two').addClass('scrolled');document.getElementById("searchinput").focus();});
  $("#btn-search-mobile").click(function(){$("#search-box-mobile").toggle();closeNav();document.getElementById("fgrgr-mobile").focus();});
  $("#btn-close-search").click(function(){document.getElementById('searchinput-mobile').value='';$("#search-box-mobile").toggle();closeNav();});
  $("#nav-comparison").hide();$("#nav-comparison-mobile").hide();
  $("#formseachall").submit(function(event){var key=$('#searchinput').val();var newkey=key.replace(/[/]/g,'@');event.preventDefault();window.location='{{ route('searchAll') }}/'+newkey;});
  $("#formseachall_mobile").submit(function(event){var key=$('#searchinput-mobile').val();var newkey=key.replace(/[/]/g,'@');event.preventDefault();window.location='{{ route('searchAll') }}/'+newkey;});
});
</script>
@include('layouts.header-front')
<style type="text/css">#overview-main-title { font-size: clamp(1.9rem,3.5vw,5rem) !important; }
/* 85~305V in pos-3: fit within small card */
#din-pro .feature-card.pos-3 .pos1-big-num { font-size: clamp(1rem,2.6vw,2.6rem) !important; white-space: nowrap !important; overflow: visible !important; text-overflow: unset !important; }
#din-pro .bento-grid-horiz .feature-card.pos-3 .icon-wrap { overflow: visible !important; width: 100% !important; }
@media (max-width: 900px) { #din-pro .feature-card.pos-3 .pos1-big-num { font-size: clamp(1rem,4vw,2rem) !important; } }
@media (max-width: 768px) { #din-pro .feature-card.pos-3 .pos1-big-num { font-size: clamp(1rem,5vw,1.8rem) !important; } }
/* Cert cards: logo scales with viewport, text never overflows */
.cert-card-logo { width: clamp(40px,6vw,96px) !important; height: clamp(40px,6vw,96px) !important; flex-shrink: 0 !important; }
.cert-card-logo img { width: 100% !important; height: 100% !important; object-fit: contain !important; }
@keyframes livePulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.4;transform:scale(0.7)} }
html[lang="zh-TW"] #intro [data-i18n="hero.title"],
html[lang="zh-CN"] #intro [data-i18n="hero.title"] { white-space: normal !important; }
/* Hero title size override */
#intro h1.hero-title, #intro h1.text-neon-solid { font-size: clamp(0.75rem,1.2vw,1.6rem) !important; }
/* Hero nav buttons: white text */
#intro a[href="#din-pro"] * , #intro a[href="#din-eco"] *, #intro a[href="#overview"] * { color: #fff !important; }
#intro a[href="#din-pro"], #intro a[href="#din-eco"], #intro a[href="#overview"] { color: #fff !important; }

/* mini video container removed */
#contact .disclaimer-note {
  font-size: 0.85rem !important;
  color: rgba(255,255,255,0.6) !important;
  font-weight: 300 !important;
  line-height: 1.5 !important;
  margin-top: 10px !important;
  display: block !important;
}
/* Pull 150% closer to "Maximum achievable" */
#din-pro .feature-card.pos-1 .pos1-big-num {
  padding-top: 0 !important;
  margin-top: -0.25em !important;
}
/* Fix eco pos-2 (95% High Efficiency): center content vertically */
#din-eco .bento-grid-horiz .feature-card.pos-2 {
  justify-content: center !important;
}
/* Fix eco pos-1 (3 Phase): text block vertically centered */
#din-eco .feature-card.pos-1 > div:last-child {
  justify-content: center !important;
}
#din-eco .feature-card.pos-1 > div:last-child .icon-wrap {
  justify-content: flex-start !important;
  flex: 0 0 auto !important;
}
@media (max-width: 768px) {
  #din-eco .feature-card.pos-1 > div:last-child .icon-wrap {
    gap: 2px !important;
  }
  #din-eco .feature-card.pos-1 span[data-i18n="eco.acSupport"],
  #din-eco .feature-card.pos-1 span[data-i18n="eco.acSupportNote"] {
    font-size: 0.65rem !important;
    line-height: 1.2 !important;
  }
  /* Fix Wide Temperature label same size as card-header (Slim & Compact) */
  .temp-label {
    font-size: clamp(0.8rem, 1.2vw, 1.1rem) !important;
  }
  /* Reduce pos-1 card gap on mobile to reduce crowding */
  #din-eco .feature-card.pos-1 {
    gap: 4px !important;
  }
  /* Reduce pos1-label margin in eco pos-1 on mobile */
  #din-eco .feature-card.pos-1 .icon-wrap .pos1-label {
    margin-bottom: 0 !important;
  }
}
/* Remove extra gap between 340~600V and (3EN...) */
#din-eco .feature-card.pos-1 .icon-wrap .pos1-label[data-i18n="eco.acSupport"] {
  margin-bottom: 0 !important;
}
#din-pro .feature-card.pos-6 .temp-big-num {
  display: inline-grid !important;
  grid-template-columns: 0.6em auto !important;
  align-items: baseline !important;
  white-space: normal !important;
  overflow: visible !important;
  row-gap: 0 !important;
  column-gap: 0.05em !important;
  color: #05a3f7 !important;
}
#din-pro .feature-card.pos-6 .temp-big-num .temp-sign {
  color: #05a3f7 !important;
  line-height: 1.15 !important;
  display: block !important;
  text-align: center !important;
}
#din-pro .feature-card.pos-6 .temp-big-num .temp-digits {
  color: #05a3f7 !important;
  line-height: 1.15 !important;
  display: block !important;
}
#din-pro .feature-card.pos-6 .temp-big-num .temp-to {
  color: #fff !important;
  font-size: 0.45em !important;
  font-weight: 400 !important;
  vertical-align: middle !important;
  margin-left: 0.3em !important;
}
/* DIN Eco temperature card */
#din-eco .feature-card.pos-4 .temp-big-num {
  display: inline-grid !important;
  grid-template-columns: 0.6em auto !important;
  align-items: baseline !important;
  white-space: normal !important;
  overflow: visible !important;
  row-gap: 0 !important;
  column-gap: 0.05em !important;
  color: #00F1CD !important;
}
#din-eco .feature-card.pos-4 .temp-big-num .temp-sign {
  color: #00F1CD !important;
  line-height: 1.15 !important;
  display: block !important;
  text-align: center !important;
}
#din-eco .feature-card.pos-4 .temp-big-num .temp-digits {
  color: #00F1CD !important;
  line-height: 1.15 !important;
  display: block !important;
}
#din-eco .feature-card.pos-4 .temp-big-num .temp-to {
  color: #fff !important;
  font-size: 0.45em !important;
  font-weight: 400 !important;
  vertical-align: middle !important;
  margin-left: 0.3em !important;
}
/* Pull 150% closer to "Maximum achievable" */
#din-pro .feature-card.pos-1 .pos1-big-num {
  padding-top: 0 !important;
  margin-top: -0.25em !important;
}
/* Temperature: grid with fixed sign column width so - and + align perfectly */
#din-pro .feature-card.pos-6 .temp-big-num {
  display: inline-grid !important;
  grid-template-columns: 0.6em auto !important;
  align-items: baseline !important;
  white-space: normal !important;
  overflow: visible !important;
  row-gap: 0 !important;
  column-gap: 0.05em !important;
  color: #05a3f7 !important;
}
#din-pro .feature-card.pos-6 .temp-big-num .temp-sign {
  color: #05a3f7 !important;
  line-height: 1.15 !important;
  display: block !important;
  text-align: center !important;
}
#din-pro .feature-card.pos-6 .temp-big-num .temp-digits {
  color: #05a3f7 !important;
  line-height: 1.15 !important;
  display: block !important;
}
#din-pro .feature-card.pos-6 .temp-big-num .temp-to {
  color: #fff !important;
  font-size: 0.45em !important;
  font-weight: 400 !important;
  vertical-align: middle !important;
  margin-left: 0.3em !important;
}
/* DIN Eco temperature card: same grid layout, teal color */
#din-eco .feature-card.pos-4 .temp-big-num {
  display: inline-grid !important;
  grid-template-columns: 0.6em auto !important;
  align-items: baseline !important;
  white-space: normal !important;
  overflow: visible !important;
  row-gap: 0 !important;
  column-gap: 0.05em !important;
  color: #00F1CD !important;
}
#din-eco .feature-card.pos-4 .temp-big-num .temp-sign {
  color: #00F1CD !important;
  line-height: 1.15 !important;
  display: block !important;
  text-align: center !important;
}
#din-eco .feature-card.pos-4 .temp-big-num .temp-digits {
  color: #00F1CD !important;
  line-height: 1.15 !important;
  display: block !important;
}
#din-eco .feature-card.pos-4 .temp-big-num .temp-to {
  color: #fff !important;
  font-size: 0.45em !important;
  font-weight: 400 !important;
  vertical-align: middle !important;
  margin-left: 0.3em !important;
}
</style>
<div>
<div class="fixed-bg-layer">&nbsp;</div>

<main><!-- ===== HERO ===== -->
<section class="video-bg-section" id="intro" style="height:100vh;position:relative;overflow:hidden;">
<video autoplay="" loop="" muted="" playsinline="" style="position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;z-index:0;"><source src="https://filecenter.deltaww.com/about/images/about-202604231109143044.mp4" type="video/mp4" /></video>

<div style="position:absolute;inset:0;background:rgba(0,5,16,0.68);z-index:1;pointer-events:none;">&nbsp;</div>

<div style="z-index:2;position:relative;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;width:100%;height:100%;padding:0 20px clamp(60px,10vh,100px);box-sizing:border-box;"><!-- Row 1: INFINITY READY with glow -->
<h2 class="text-neon-solid reveal-up delay-100" data-i18n="hero.subtitle" style="margin:0 0 clamp(8px,1.5vh,16px) 0;font-size:clamp(0.9rem,2vw,2.2rem) !important;line-height:1.5;text-shadow:0 0 30px rgba(5,163,247,0.9),0 0 60px rgba(5,163,247,0.5),0 0 100px rgba(5,163,247,0.3);">INFINITY READY</h2>
<!-- Row 2: DELTA STANDARD POWER SUPPLY -->

<div class="reveal-up" data-i18n="hero.title" style="color:#fff;font-weight:900;letter-spacing:clamp(0px,0.3vw,2px);margin:0 0 clamp(6px,1.2vh,16px) 0;font-size:clamp(1.2rem,4vw,4.5rem);text-transform:uppercase;line-height:1.25;white-space:nowrap;">DELTA STANDARD POWER SUPPLY</div>
<!-- Row 3: New Product Launch Event 2026 -->

<div class="reveal-up delay-150" data-i18n="overview.event.line2" style="font-size:clamp(1.2rem,3.5vw,4rem);font-weight:700;letter-spacing:clamp(1px,0.3vw,4px);text-transform:uppercase;color:rgba(0,210,255,0.9);margin:0 0 clamp(14px,2.5vh,30px) 0;line-height:1.25;">New Product Launch Event 2026</div>
<!-- Row 4: Online Launch Event at + date/time -->

<div class="reveal-up delay-200" style="margin:0 0 clamp(16px,2.5vh,28px) 0;font-size:clamp(1.6rem,1.7vw,1.4rem);color:rgba(255,255,255,0.85);letter-spacing:0.5px;white-space:nowrap;"><span data-i18n="hero.onlineEventAt" style="color:rgba(255,255,255,0.85);">Online Launch Event at</span> <span data-i18n="overview.videoExpiry" style="color:#00f2ff;font-weight:700;letter-spacing:1px;white-space:nowrap;">2026.05.20 (Wed.) | 03:30 PM (UTC +8)</span></div>
<!-- Row 5: Register Now + Countdown side by side -->

<div class="reveal-up delay-250" style="display:flex;flex-direction:row;align-items:center;gap:clamp(10px,2vw,20px);flex-wrap:wrap;justify-content:center;margin-bottom:clamp(20px,3vh,40px);"><!-- Register Now button --><button class="btn-notify" onclick="UIkit.modal('#notify-modal').show()" style="min-width:160px;justify-content:center;padding:clamp(8px,1.4vw,12px) clamp(18px,2.5vw,30px);font-size:clamp(0.75rem,1.4vw,1rem);border-radius:8px;" type="button"><span data-i18n="hero.register" style="color:#fff!important;">Register Now</span></button><!-- Countdown -->

<div style="display:flex;gap:6px;align-items:center;">
<div class="cd-block"><span class="cd-num" id="cd-days-hero">00</span><span class="cd-label">DAYS</span></div>
<span class="cd-sep">:</span>

<div class="cd-block"><span class="cd-num" id="cd-hours-hero">00</span><span class="cd-label">HRS</span></div>
<span class="cd-sep">:</span>

<div class="cd-block"><span class="cd-num" id="cd-mins-hero">00</span><span class="cd-label">MIN</span></div>
<span class="cd-sep">:</span>

<div class="cd-block"><span class="cd-num" id="cd-secs-hero">00</span><span class="cd-label">SEC</span></div>
</div>
</div>
<!-- Row 6: Delta's Upcoming New Products + DIN Pro / DIN Eco buttons -->

<div class="reveal-up delay-300" style="display:flex;flex-direction:column;align-items:center;gap:8px;">
<div data-i18n="hero.upcomingLabel" style="font-size:clamp(1.4rem,1.2vw,0.95rem);color:rgba(255,255,255,0.7);">Delta&#39;s Upcoming New Products at a Glance</div>

<div style="display:flex;flex-direction:column;align-items:center;gap:8px;justify-content:center;"><span data-i18n="hero.dinRailLabel" style="color:#00f2ff;font-weight:700;font-size:clamp(1.4rem,1.5vw,1.1rem);">DIN Rail Power Supplies</span>

<div style="display:flex;flex-direction:row;align-items:center;gap:12px;flex-wrap:nowrap;justify-content:center;"><a href="#din-pro" onmouseout="this.style.background='rgba(5,163,247,0.1)';this.style.borderColor='rgba(5,163,247,0.55)'" onmouseover="this.style.background='rgba(5,163,247,0.22)';this.style.borderColor='#05a3f7'" style="display:inline-flex;align-items:center;justify-content:center;gap:4px;padding:7px 16px;border-radius:50px;border:2px solid rgba(5,163,247,0.55);background:rgba(5,163,247,0.1);color:#fff !important;font-weight:700;font-size:1rem;letter-spacing:1px;text-decoration:none;transition:all 0.2s;backdrop-filter:blur(8px);white-space:nowrap;"><span data-i18n="nav.dinpro" style="color:#fff !important;">DIN Pro</span> <svg fill="none" height="11" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24" width="11"><polyline points="9 18 15 12 9 6"></polyline></svg></a> <a href="#din-eco" onmouseout="this.style.background='rgba(0,241,205,0.08)';this.style.borderColor='rgba(0,241,205,0.55)'" onmouseover="this.style.background='rgba(0,241,205,0.2)';this.style.borderColor='#00f1cd'" style="display:inline-flex;align-items:center;justify-content:center;gap:4px;padding:7px 16px;border-radius:50px;border:2px solid rgba(0,241,205,0.55);background:rgba(0,241,205,0.08);color:#fff !important;font-weight:700;font-size:1rem;letter-spacing:1px;text-decoration:none;transition:all 0.2s;backdrop-filter:blur(8px);white-space:nowrap;"><span data-i18n="nav.dineco" style="color:#fff !important;">DIN Eco</span> <svg fill="none" height="11" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24" width="11"><polyline points="9 18 15 12 9 6"></polyline></svg></a></div>
</div>
</div>
</div>
<script>
(function syncHeroCountdown() {
  function tick() {
    var _l = document.documentElement.lang;
    var target = (_l === 'zh-TW' || _l === 'zh-CN')
      ? new Date('2026-05-20T09:30:00+08:00')
      : new Date('2026-05-20T15:30:00+08:00');
    var now = new Date();
    var diff = Math.max(0, target - now);
    var days = Math.floor(diff / 86400000);
    var hrs  = Math.floor((diff % 86400000) / 3600000);
    var mins = Math.floor((diff % 3600000) / 60000);
    var secs = Math.floor((diff % 60000) / 1000);
    function pad(n){ return String(n).padStart(2,'0'); }
    var dh = document.getElementById('cd-days-hero');
    var hh = document.getElementById('cd-hours-hero');
    var mh = document.getElementById('cd-mins-hero');
    var sh = document.getElementById('cd-secs-hero');
    if(dh) dh.textContent = pad(days);
    if(hh) hh.textContent = pad(hrs);
    if(mh) mh.textContent = pad(mins);
    if(sh) sh.textContent = pad(secs);
  }
  tick();
  setInterval(tick, 1000);
})();
</script><!-- mini video player removed --><script>
(function initMiniPlayer() {
  // disabled
  return;
  var section, inlineFrame, miniContainer, miniIframe;
  var isMini = false;
  var closedByUser = false;
  var videoHasPlayed = false; // tracks if user has ever played / video autoplay started
  var ytPlayer = null;        // YouTube IFrame API player instance
  // No loop, no playlist — plays once then pauses
  var _ytId = (['tw','cn'].indexOf(window._locale) !== -1) ? 'bBNC4lOdEUo' : 'RTiVd5EOXXI';
  var YT_SRC = 'https://www.youtube.com/embed/' + _ytId + '?autoplay=1&mute=1&rel=0&modestbranding=1&enablejsapi=1';

  /* ---- build the floating mini container ---- */
  function buildMiniContainer() {
    miniContainer = document.createElement('div');
    miniContainer.id = 'mini-video-container';
    miniContainer.style.cssText = [
      'position:fixed',
      'bottom:24px',
      'left:24px',
      'width:280px',
      'height:158px',
      'z-index:9995',
      'border-radius:12px',
      'overflow:visible',
      'display:none',
      'transition:opacity 0.35s ease,transform 0.35s ease',
      'opacity:0',
      'transform:translateY(20px)'
    ].join(';');

    var iframeWrap = document.createElement('div');
    iframeWrap.style.cssText = 'position:absolute;inset:0;border-radius:12px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,0.7),0 0 0 2px rgba(5,163,247,0.5);';

    miniIframe = document.createElement('iframe');
    miniIframe.id = 'mini-yt-iframe';
    miniIframe.allow = 'autoplay; encrypted-media';
    miniIframe.allowFullscreen = true;
    miniIframe.style.cssText = 'position:absolute;top:0;left:0;width:100%;height:100%;border:none;display:block;';
    miniIframe.src = 'about:blank';
    iframeWrap.appendChild(miniIframe);

    var closeBtn = document.createElement('button');
    closeBtn.innerHTML = '&times;';
    closeBtn.title = 'Close';
    closeBtn.style.cssText = [
      'position:absolute','top:-10px','right:-10px','width:26px','height:26px',
      'border-radius:50%','background:#05a3f7','border:2px solid #fff','color:#fff',
      'font-size:14px','line-height:1','cursor:pointer','display:flex',
      'align-items:center','justify-content:center','z-index:10',
      'box-shadow:0 2px 8px rgba(0,0,0,0.5)','transition:background 0.2s','padding:0'
    ].join(';');
    closeBtn.addEventListener('mouseenter', function(){ this.style.background='#e53935'; });
    closeBtn.addEventListener('mouseleave', function(){ this.style.background='#05a3f7'; });
    closeBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      closedByUser = true;
      forceHide();
    });

    miniContainer.appendChild(iframeWrap);
    miniContainer.appendChild(closeBtn);
    document.body.appendChild(miniContainer);
  }

  /* ---- check if YT video is currently playing ---- */
  function isVideoPlaying() {
    try {
      // YT.PlayerState.PLAYING === 1
      return ytPlayer && typeof ytPlayer.getPlayerState === 'function' && ytPlayer.getPlayerState() === 1;
    } catch(e) { return false; }
  }

  /* ---- show mini player ---- */
  function activate() {
    if (isMini || closedByUser) return;
    isMini = true;
    if (inlineFrame) inlineFrame.style.visibility = 'hidden';
    miniIframe.src = YT_SRC;
    miniContainer.style.display = 'block';
    requestAnimationFrame(function() {
      requestAnimationFrame(function() {
        miniContainer.style.opacity = '1';
        miniContainer.style.transform = 'translateY(0)';
      });
    });
  }

  /* ---- hide mini player ---- */
  function deactivate() {
    if (!isMini) return;
    isMini = false;
    if (miniContainer) {
      miniContainer.style.opacity = '0';
      miniContainer.style.transform = 'translateY(20px)';
      setTimeout(function() {
        miniContainer.style.display = 'none';
        if (miniIframe) miniIframe.src = 'about:blank';
      }, 350);
    }
    if (inlineFrame) inlineFrame.style.visibility = '';
  }

  function forceHide() {
    if (!miniContainer) return;
    miniContainer.style.opacity = '0';
    miniContainer.style.transform = 'translateY(20px)';
    setTimeout(function() {
      miniContainer.style.display = 'none';
      if (miniIframe) miniIframe.src = 'about:blank';
      if (inlineFrame) inlineFrame.style.visibility = '';
    }, 350);
    isMini = false;
  }

  /* ---- scroll handler ---- */
  function onScroll() {
    if (!section) return;
    var rect = section.getBoundingClientRect();
    var inView = rect.bottom > 0 && rect.top < window.innerHeight;

    if (!inView) {
      // Only pop up mini if video has started playing
      if (videoHasPlayed && !closedByUser) {
        activate();
      }
    } else {
      // Section back in view — restore inline, hide mini
      if (isMini) deactivate();
      else if (inlineFrame) inlineFrame.style.visibility = '';
      closedByUser = false;
    }
  }

  /* ---- init YouTube IFrame API to detect play events ---- */
  function initYTApi() {
    if (!inlineFrame) return;
    // Load YT API if not already loaded
    if (!window.YT || !window.YT.Player) {
      var tag = document.createElement('script');
      tag.src = 'https://www.youtube.com/iframe_api';
      document.head.appendChild(tag);
    }

    function setupPlayer() {
      try {
        ytPlayer = new window.YT.Player('overview-yt-iframe', {
          events: {
            onStateChange: function(e) {
              // 1 = PLAYING
              if (e.data === 1) {
                videoHasPlayed = true;
              }
            }
          }
        });
      } catch(err) {}
    }

    if (window.YT && window.YT.Player) {
      setupPlayer();
    } else {
      var prev = window.onYouTubeIframeAPIReady;
      window.onYouTubeIframeAPIReady = function() {
        if (prev) prev();
        setupPlayer();
      };
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    section     = document.getElementById('overview');
    inlineFrame = document.getElementById('overview-yt-iframe');
    if (!section) return;
    buildMiniContainer();
    initYTApi();
    window.addEventListener('scroll', onScroll, { passive: true });
    // Don't call onScroll() on init — mini should never show on page load
  });
})();
</script></section>
<!-- ===== SIDE NAV ===== -->

<nav class="side-nav" id="sideNav"><a data-section="intro" href="#intro"><span class="nav-dot"></span><span class="nav-label" data-i18n="nav.home">HOME</span></a> <a data-section="overview" href="#overview"><span class="side-nav-live-dot"></span><span class="nav-label" data-i18n="nav.live">LIVE</span></a>

<div class="side-nav-divider">&nbsp;</div>
<a class="nav-dinpro" data-section="din-pro" href="#din-pro"><span class="nav-dot"></span><span class="nav-label" data-i18n="nav.dinpro">DIN PRO</span></a> <a class="nav-dineco" data-section="din-eco" href="#din-eco"><span class="nav-dot"></span><span class="nav-label" data-i18n="nav.dineco">DIN ECO</span></a>

<div class="side-nav-divider">&nbsp;</div>
<a data-section="certifications" href="#certifications"><span class="nav-dot"></span><span class="nav-label" data-i18n="nav.certification">CERT</span></a> <a data-section="series-comparison" href="#series-comparison"><span class="nav-dot"></span><span class="nav-label" data-i18n="nav.compare">COMPARE</span></a> <a data-section="solutions" href="#solutions"><span class="nav-dot"></span><span class="nav-label" data-i18n="nav.solutions">SOLUTIONS</span></a> <a data-section="contact" href="#contact"><span class="nav-dot"></span><span class="nav-label" data-i18n="nav.contact">CONTACT</span></a></nav>
<!-- ===== MOBILE BOTTOM NAV ===== -->

<nav class="mobile-bottom-nav" id="mobileBottomNav">
<ul>
	<li><a data-section="intro" href="#intro"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg><span data-i18n="nav.home">HOME</span></a></li>
	<li><a data-section="overview" href="#overview"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24"><circle cx="12" cy="12" r="2"></circle><path d="M12 2v3m0 14v3M2 12h3m14 0h3"></path><circle cx="12" cy="12" r="7" stroke-dasharray="2 2"></circle></svg><span data-i18n="nav.live">LIVE</span></a></li>
	<li><a class="nav-dinpro" data-section="din-pro" href="#din-pro"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24"><rect height="14" rx="2" width="20" x="2" y="7"></rect><path d="M16 3l-4 4-4-4"></path><circle cx="12" cy="14" r="2"></circle></svg><span data-i18n="nav.dinpro">DIN PRO</span></a></li>
	<li><a class="nav-dineco" data-section="din-eco" href="#din-eco"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24"><path d="M12 2a10 10 0 0 1 0 20A10 10 0 0 1 12 2z"></path><path d="M12 6v6l4 2"></path></svg><span data-i18n="nav.dineco">DIN ECO</span></a></li>
	<li><a data-section="certifications" href="#certifications"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24"><circle cx="12" cy="8" r="6"></circle><path d="M9 14l-2 7 5-3 5 3-2-7"></path></svg><span data-i18n="nav.certification">CERT</span></a></li>
	<li><a data-section="series-comparison" href="#series-comparison"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24"><line x1="18" x2="18" y1="20" y2="10"></line><line x1="12" x2="12" y1="20" y2="4"></line><line x1="6" x2="6" y1="20" y2="14"></line></svg><span data-i18n="nav.compare">COMPARE</span></a></li>
	<li><a data-section="solutions" href="#solutions"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24"><rect height="7" width="7" x="3" y="3"></rect><rect height="7" width="7" x="14" y="3"></rect><rect height="7" width="7" x="14" y="14"></rect><rect height="7" width="7" x="3" y="14"></rect></svg><span data-i18n="nav.solutions">SOLUTIONS</span></a></li>
	<li><a data-section="contact" href="#contact"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg><span data-i18n="nav.contact">CONTACT</span></a></li>
</ul>
</nav>
<!-- ===== OVERVIEW ===== -->

<section id="overview" style="background:url('https://filecenter.deltaww.com/about/images/about-202603311615129063.jpg') center/cover no-repeat;position:relative;z-index:1;">
<div class="container-wide">
<div class="uk-grid uk-grid-large uk-flex-middle" uk-grid="">
<div class="uk-width-2-5@l reveal-up" style="display:flex;flex-direction:column;justify-content:space-between;gap:42px;">
<h2 class="font-heading barlow" id="overview-main-title" style="color:#fff;line-height:1;margin:0;padding:0;font-size:clamp(1.9rem,3.5vw,5rem) !important;text-transform:uppercase;"><span data-i18n="overview.title1" style="color:#fff;display:block;margin:0 0 4px;padding:0;">POWERING</span> <span data-i18n="overview.title2" style="color:#fff;display:block;margin:0;padding:0;">EXCELLENCE</span></h2>

<p data-i18n="overview.desc" style="margin:0;">Next-generation power solutions engineered for mission-critical stability</p>
</div>

<div class="uk-width-3-5@l reveal-up delay-100">
<div class="video-frame" id="overview-video-frame" style="cursor:default;"><iframe allow="autoplay; encrypted-media" allowfullscreen="" id="overview-yt-iframe" src="https://www.youtube.com/embed/{{ in_array(App::getLocale(), ['tw','cn']) ? 'bBNC4lOdEUo' : 'RTiVd5EOXXI' }}?autoplay=0&amp;mute=1&amp;rel=0&amp;modestbranding=1&amp;enablejsapi=1" style="position:absolute;top:0;left:0;width:100%;height:100%;border:none;display:block;"></iframe>

<div style="position:absolute;bottom:0;left:0;width:100%;height:2px;background:#05a3f7;pointer-events:none;">&nbsp;</div>
</div>
<script>
(function() {
  var ytPlayer = null;
  var playerReady = false;
  var isInView = false;

  function loadYTApi() {
    if (window.YT && window.YT.Player) { setupPlayer(); return; }
    if (!document.getElementById('yt-api-script')) {
      var tag = document.createElement('script');
      tag.id = 'yt-api-script';
      tag.src = 'https://www.youtube.com/iframe_api';
      document.head.appendChild(tag);
    }
    var prev = window.onYouTubeIframeAPIReady;
    window.onYouTubeIframeAPIReady = function() {
      if (prev) prev();
      setupPlayer();
    };
  }

  function setupPlayer() {
    if (ytPlayer) return;
    try {
      ytPlayer = new window.YT.Player('overview-yt-iframe', {
        events: {
          onReady: function() {
            playerReady = true;
            // Play immediately if already in view when player becomes ready
            if (isInView) ytPlayer.playVideo();
          }
        }
      });
    } catch(e) {}
  }

  function checkVisibility() {
    var section = document.getElementById('overview');
    if (!section) return;
    var rect = section.getBoundingClientRect();
    var threshold = window.innerHeight * 0.2;
    var nowInView = rect.top < (window.innerHeight - threshold) && rect.bottom > threshold;

    if (nowInView && !isInView) {
      isInView = true;
      if (playerReady && ytPlayer) ytPlayer.playVideo();
    } else if (!nowInView && isInView) {
      isInView = false;
      if (playerReady && ytPlayer) ytPlayer.pauseVideo();
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    loadYTApi();
    window.addEventListener('scroll', checkVisibility, { passive: true });
    checkVisibility();
  });
})();
</script></div>
</div>
</div>
</section>
<!-- ===== DIN VIDEO BG ===== -->

<div aria-hidden="true" id="din-bg-video">
<video autoplay="" loop="" muted="" playsinline=""><source src="https://filecenter.deltaww.com/about/images/about-202604091823494538.mp4" type="video/mp4" /></video>
</div>

<div id="din-sections-wrapper"><!-- ===== DIN PRO ===== -->
<section id="din-pro">
<div class="container-wide">
<div class="uk-text-center uk-margin-large-bottom reveal-up">
<h2 class="font-heading text-cyan" data-i18n="dinpro.title">DIN Pro 1-Phase Series</h2>

<p data-i18n="dinpro.desc">The flagship solution for extreme environments.</p>
</div>

<div class="uk-grid uk-grid-large uk-flex-middle" uk-grid="">
<div class="uk-width-1-3@l reveal-up">
<div class="uk-flex uk-flex-column uk-flex-middle uk-text-center">
<div class="wattage-filter pro-theme uk-margin-medium-bottom"><button class="watt-btn active" onclick="switchProductImage('pro','all',this,event)" type="button">All</button><button class="watt-btn" onclick="switchProductImage('pro','120w',this,event)" type="button">120W</button><button class="watt-btn" onclick="switchProductImage('pro','240w',this,event)" type="button">240W</button><button class="watt-btn" onclick="switchProductImage('pro','480w',this,event)" type="button">480W</button><button class="watt-btn" onclick="switchProductImage('pro','960w',this,event)" type="button">960W</button></div>

<div class="product-img-wrap" style="width:100%;max-width:520px;margin:0 auto;height:400px;display:flex;align-items:center;justify-content:center;"><img alt="DIN Pro" class="static-product-img" id="pro-img" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202604231000027622.png" style="width:100%;height:100%;object-fit:contain;display:block;" /></div>

<div class="uk-margin-medium-top"><a class="btn-cyber" data-i18n="dinpro.learnMore" data-url-template="https://psu.deltaww.com/{locale}/product/2/din-rail-power-supply/1/din-pro/123" href="{{ App::getLocale() === 'cn' ? 'https://deltapsu.cn/cn' : 'https://psu.deltaww.com/'.App::getLocale() }}/product/2/din-rail-power-supply/1/din-pro/123" style="min-width:220px;display:inline-block;" target="_blank">LEARN MORE</a></div>
</div>
</div>

<div class="uk-width-2-3@l">
<div class="bento-grid-horiz pro-layout"><!-- pos-1: 150% Peak Power -->
<div class="feature-card pro-theme pos-1 pro-card-bg reveal-up delay-100" style="border:1px solid rgba(0,242,255,0.25);border-radius:20px;position:relative;overflow:hidden;box-sizing:border-box;">
<div style="flex-shrink:1;display:flex;align-items:center;justify-content:center;"><img alt="Peak Power" class="pos1-icon" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271512230807.png" /></div>

<div style="position:relative;z-index:1;min-width:0;display:flex;flex-direction:column;justify-content:flex-end;align-items:flex-start;gap:0;align-self:stretch;">
<div class="icon-wrap" style="flex:1 1 auto;display:flex;flex-direction:column;align-items:flex-start;justify-content:flex-end;flex-shrink:0;gap:clamp(4px,0.5vw,8px);padding-bottom:0;">
<div class="pos1-label" data-i18n="pro.peakLabel">Maximum achievable</div>

<div class="pos1-big-num" style="color:#05a3f7;margin:0;">150%</div>

<div class="pos1-subtitle" data-i18n="pro.peakTitle" style="color:#fff;margin:0;">Peak Power</div>

<div class="pos1-label" data-i18n="pro.peakDesc" style="min-height:2.6em;margin:0;">Starting capability</div>
</div>
</div>
</div>
<!-- pos-2: EMS Immunity -->

<div class="feature-card pro-theme pos-2 pro-card-bg reveal-up delay-200" style="border:1px solid rgba(0,242,255,0.25);border-radius:20px;position:relative;overflow:hidden;">
<div class="icon-wrap"><img alt="EMS Immunity" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271512423557.png" /></div>
<div class="card-header" data-i18n="pro.universalInput" style="color:#fff;font-weight:700;">EMS Immunity</div>

<p data-i18n="pro.universalInputDesc" style="color:#fff;">Certified IEC 61000-4-6, 20Vrms</p>
</div>
<!-- pos-3: Semi F47 -->

<div class="feature-card pro-theme pos-3 pro-card-bg reveal-up delay-300" style="border:1px solid rgba(0,242,255,0.25);border-radius:20px;position:relative;overflow:hidden;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:20px;">
<div class="icon-wrap">
<div class="pos1-big-num" data-i18n="pro.semiF47Value" style="color:#05a3f7;margin-bottom:0;">85~305V</div>
</div>

<div class="card-header" data-i18n="pro.semiF47" style="color:#fff;font-weight:700;margin:0 0 8px 0;">Wide AC Input</div>

<p data-i18n="pro.semiF47Desc" style="color:#fff;margin:0;">(305V for 60s)</p>
</div>
<!-- pos-4: Current Sharing -->

<div class="feature-card pro-theme pos-4 pro-card-bg reveal-up delay-100" style="border:1px solid rgba(0,242,255,0.25);border-radius:20px;position:relative;overflow:hidden;">
<div class="icon-wrap"><img alt="Current Sharing" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271515414462.png" /></div>
<div class="card-header" data-i18n="pro.currentSharing" style="color:#fff;font-weight:700;">Current Sharing</div>

<p data-i18n="pro.currentSharingDesc" style="color:#fff;">Parallel operation support (960W)</p>
</div>
<!-- pos-5: PCBA Coating -->

<div class="feature-card pro-theme pos-5 pro-card-bg reveal-up delay-200" style="border:1px solid rgba(0,242,255,0.25);border-radius:20px;position:relative;overflow:hidden;">
<div class="icon-wrap"><img alt="PCBA Coating" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271515562129.png" /></div>
<div class="card-header" data-i18n="pro.pcbaCoating" style="color:#fff;font-weight:700;">PCBA Coating</div>

<p data-i18n="pro.pcbaCoatingDesc" style="color:#fff;">Industrial-grade protection</p>
</div>
<!-- pos-6: Temperature -->

<div class="feature-card pro-theme pos-6 pro-card-bg reveal-up delay-300" style="border:1px solid rgba(0,242,255,0.25);border-radius:20px;position:relative;overflow:hidden;box-sizing:border-box;">
<div class="temp-icon-wrap"><img alt="Extreme Temperature" class="temp-icon" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271516113446.png" /></div>

<div class="temp-text-wrap">
<div class="temp-label" data-i18n="pro.extremeTemp">Extreme Temperature</div>

<div class="temp-big-num"><span class="temp-sign">-</span><span class="temp-digits">40&deg;C <span class="temp-to">to</span></span><span class="temp-sign">+</span><span class="temp-digits">80&deg;C</span></div>

<div class="temp-range" data-i18n="common.opRange">Operating range</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- ===== DIVIDER ===== -->

<div style="position:relative;z-index:2;width:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:32px 0;">
<div style="width:92%;max-width:1600px;display:flex;align-items:center;gap:20px;">
<div style="flex:1;height:1px;background:linear-gradient(to right,transparent,rgba(5,163,247,0.6),rgba(0,242,255,0.8),rgba(0,241,205,0.8),transparent);">&nbsp;</div>

<div style="display:flex;align-items:center;gap:8px;flex-shrink:0;"><span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:#05a3f7;"></span><span style="display:inline-block;width:32px;height:1px;background:linear-gradient(to right,#05a3f7,#00f1cd);"></span><span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:linear-gradient(135deg,#05a3f7,#00f1cd);"></span><span style="display:inline-block;width:32px;height:1px;background:linear-gradient(to right,#00f1cd,#05a3f7);"></span><span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:#00f1cd;"></span></div>

<div style="flex:1;height:1px;background:linear-gradient(to left,transparent,rgba(0,241,205,0.6),rgba(0,242,255,0.8),rgba(5,163,247,0.8),transparent);">&nbsp;</div>
</div>
</div>
<!-- ===== DIN ECO ===== -->

<section id="din-eco">
<div class="container-wide" style="position:relative;z-index:1;">
<div class="uk-text-center uk-margin-large-bottom reveal-up">
<h2 class="font-heading text-green" data-i18n="dineco.title">DIN Eco 3-Phase Series</h2>

<p data-i18n="dineco.desc">Performance at the Core, Built to Last</p>
</div>

<div class="uk-grid uk-grid-large uk-flex-middle" uk-grid="">
<div class="uk-width-1-3@l reveal-up">
<div class="uk-flex uk-flex-column uk-flex-middle uk-text-center">
<div class="wattage-filter eco-theme uk-margin-medium-bottom"><button class="watt-btn active" onclick="switchProductImage('eco','all',this,event)" type="button">All</button><button class="watt-btn" onclick="switchProductImage('eco','120w',this,event)" type="button">120W</button><button class="watt-btn" onclick="switchProductImage('eco','240w',this,event)" type="button">240W</button><button class="watt-btn" onclick="switchProductImage('eco','480w',this,event)" type="button">480W</button><button class="watt-btn" onclick="switchProductImage('eco','960w',this,event)" type="button">960W</button></div>

<div class="product-img-wrap" style="width:100%;max-width:520px;margin:0 auto;height:400px;display:flex;align-items:center;justify-content:center;"><img alt="DIN Eco" class="static-product-img" id="eco-img" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202604230959225538.png" style="width:100%;height:100%;object-fit:contain;display:block;" /></div>

<div class="uk-margin-medium-top"><a class="btn-cyber" data-i18n="dineco.learnMore" data-url-template="https://psu.deltaww.com/{locale}/product/2/din-rail-power-supply/1/din-eco/121" href="{{ App::getLocale() === 'cn' ? 'https://deltapsu.cn/cn' : 'https://psu.deltaww.com/'.App::getLocale() }}/product/2/din-rail-power-supply/1/din-eco/121" style="min-width:220px;background:linear-gradient(90deg,#00F1CD,#00F1CD);border-radius:50px;display:inline-block;" target="_blank">LEARN MORE</a></div>
</div>
</div>

<div class="uk-width-2-3@l">
<div class="bento-grid-horiz eco-layout"><!-- pos-1: 3 Phase Wide AC Input -->
<div class="feature-card eco-theme pos-1 eco-card-bg reveal-up delay-100" style="border:1px solid rgba(0,241,205,0.25);border-radius:20px;position:relative;overflow:hidden;box-sizing:border-box;">
<div style="flex-shrink:1;display:flex;align-items:center;justify-content:center;"><img alt="3 Phase" class="pos1-icon" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271517399744.png" /></div>

<div style="position:relative;z-index:1;min-width:0;overflow:hidden;display:flex;flex-direction:column;gap:0;">
<div class="pos1-label" data-i18n="eco.inputRange" style="margin-bottom:0.1em;">Input range</div>

<div class="pos1-big-num" data-i18n="eco.phase" style="color:#00F1CD;margin-top:-0.1em;">3 Phase</div>

<div class="pos1-subtitle" data-i18n="eco.wideInput" style="color:#fff;">Wide Input</div>

<span data-i18n="eco.acSupport" style="display:block;font-size:clamp(0.72rem,0.85vw,0.95rem);color:rgba(255,255,255,0.80);line-height:1.3;font-weight:400;">340~600V AC support</span>
<span data-i18n="eco.acSupportNote" style="display:block;font-size:clamp(0.72rem,0.85vw,0.95rem);color:rgba(255,255,255,0.80);line-height:1.3;font-weight:400;margin-top:-0.3em;">(3EN series supports up to 575V)</span>
</div>
</div>
<!-- pos-2: High Efficiency -->

<div class="feature-card eco-theme pos-2 eco-card-bg reveal-up delay-200" style="border:1px solid rgba(0,241,205,0.25);border-radius:20px;position:relative;overflow:hidden;">
<div style="position:relative;z-index:1;display:flex;flex-direction:column;align-items:center;justify-content:center;">
<div class="pos1-label" data-i18n="eco.effLabel" style="color:#fff;margin-bottom:0.4em;">Up to</div>

<div data-i18n="eco.effValue" style="font-size:clamp(1.4rem,3.5vw,3.5rem);font-weight:800;line-height:1;color:#00c9b0;margin-top:0.3em;margin-bottom:0.3em;">95%</div>

<div data-i18n="eco.effTitle" style="font-size:clamp(0.88rem,1.3vw,1.25rem);font-weight:700;color:#fff;margin-top:0;">High Efficiency</div>
</div>
</div>
<!-- pos-3: Slim & Compact -->

<div class="feature-card eco-theme pos-3 eco-card-bg reveal-up delay-300" style="border:1px solid rgba(0,241,205,0.25);border-radius:20px;position:relative;overflow:hidden;">
<div class="icon-wrap"><img alt="Slim Design" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603301414447676.png" /></div>
<div class="card-header" data-i18n="eco.slim" style="color:#fff;font-weight:700;">Slim &amp; Compact</div>

<p data-i18n="eco.slimDesc" style="color:#fff;">Space-saving for distribution panel</p>
</div>
<!-- pos-4: Temperature -->

<div class="feature-card eco-theme pos-4 eco-card-bg reveal-up delay-100" style="border:1px solid rgba(0,241,205,0.25);border-radius:20px;position:relative;overflow:hidden;box-sizing:border-box;">
<div class="temp-icon-wrap"><img alt="Wide Temperature" class="temp-icon" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271517572741.png" /></div>

<div class="temp-text-wrap">
<div class="temp-label" data-i18n="eco.wideTemp">Extreme Temperature</div>

<div class="temp-big-num"><span class="temp-sign">-</span><span class="temp-digits">40&deg;C <span class="temp-to">to</span></span><span class="temp-sign">+</span><span class="temp-digits">70&deg;C</span></div>

<div class="temp-range" data-i18n="common.opRange">Operating range</div>
</div>
</div>
<!-- pos-5: Global Certified -->

<div class="feature-card eco-theme pos-5 eco-card-bg reveal-up delay-200" style="border:1px solid rgba(0,241,205,0.25);border-radius:20px;position:relative;overflow:hidden;">
<div class="icon-wrap"><img alt="Global Certified" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271518124579.png" /></div>
<div class="card-header" data-i18n="eco.certified" style="color:#fff;font-weight:700;">Global Certified</div>

<p data-i18n="eco.certifiedDesc" style="color:#fff;">IEC/EN/UL 62368-1/61010-1</p>
</div>
<!-- pos-6: Surge Protection -->

<div class="feature-card eco-theme pos-6 eco-card-bg reveal-up delay-300" style="border:1px solid rgba(0,241,205,0.25);border-radius:20px;position:relative;overflow:hidden;">
<div class="icon-wrap"><img alt="Surge Protection" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271518259233.png" /></div>
<div class="card-header" data-i18n="eco.surge" style="color:#fff;font-weight:700;">Surge Protection</div>

<p data-i18n="eco.surgeDesc" style="color:#fff;">4KV / 2KV surge immunity</p>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
<!-- /#din-sections-wrapper --><!-- ===== CERTIFICATIONS ===== -->

<section id="certifications">
<div class="cert-wrapper">
<div class="cert-header">
<h2 class="font-heading" data-i18n="cert.title">National Electrical Safety</h2>

<p data-i18n="cert.desc">Global compliance with the highest safety certifications.</p>
</div>

<div class="cert-cards-grid">
<div class="cert-card-new">
<div class="cert-card-inner-block">
<div class="cert-card-logo"><img alt="cUL" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202604221427570497.png" /></div>

<div class="cert-card-info">
<div class="cert-card-code">cUL 61010-1</div>

<div class="cert-card-desc" data-i18n="cert.usListed">UL Listed</div>
</div>
</div>
</div>

<div class="cert-card-new">
<div class="cert-card-inner-block">
<div class="cert-card-logo"><img alt="cUL" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271519419350.png" /></div>

<div class="cert-card-info">
<div class="cert-card-code">cUL 62368-1</div>

<div class="cert-card-desc" data-i18n="cert.ulRecognized">UL Recognized</div>
</div>
</div>
</div>

<div class="cert-card-new">
<div class="cert-card-inner-block">
<div class="cert-card-logo"><img alt="TUV" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271520056082.png" /></div>

<div class="cert-card-info">
<div class="cert-card-code">IEC / EN 62368-1</div>

<div class="cert-card-desc" data-i18n="cert.tuv">TUV Certified</div>
</div>
</div>
</div>

<div class="cert-card-new">
<div class="cert-card-inner-block">
<div class="cert-card-logo"><img alt="CE" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271520196315.png" /></div>

<div class="cert-card-info">
<div class="cert-card-code">CE 62368-1</div>

<div class="cert-card-desc" data-i18n="cert.ce">European Conformity</div>
</div>
</div>
</div>

<div class="cert-card-new">
<div class="cert-card-inner-block">
<div class="cert-card-logo"><img alt="CCC" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271519266295.png" /></div>

<div class="cert-card-info">
<div class="cert-card-code">CCC GB 4943.1</div>

<div class="cert-card-desc" data-i18n="cert.ccc">China Compulsory</div>
</div>
</div>
</div>

<div class="cert-card-new">
<div class="cert-card-inner-block">
<div class="cert-card-logo"><img alt="BSMI" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271520358119.png" /></div>

<div class="cert-card-info">
<div class="cert-card-code">BSMI CNS 15598-1</div>

<div class="cert-card-desc" data-i18n="cert.taiwan">Taiwan Standard</div>
</div>
</div>
</div>

<div class="cert-card-new">
<div class="cert-card-inner-block">
<div class="cert-card-logo"><img alt="UKCA" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271520487607.png" /></div>

<div class="cert-card-info">
<div class="cert-card-code">UKCA BS EN 62368-1</div>

<div class="cert-card-desc" data-i18n="cert.ukca">UK Certification</div>
</div>
</div>
</div>

<div class="cert-card-new">
<div class="cert-card-inner-block">
<div class="cert-card-logo"><img alt="KC" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202604221737496742.png" /></div>

<div class="cert-card-info">
<div class="cert-card-code">KC C 9832 / 9835</div>

<div class="cert-card-desc" data-i18n="cert.kc">Korea Certification</div>
</div>
</div>
</div>

<div class="cert-card-new">
<div class="cert-card-inner-block">
<div class="cert-card-logo"><img alt="BIS" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603271521328590.png" /></div>

<div class="cert-card-info">
<div class="cert-card-code">BIS 13252-1</div>

<div class="cert-card-desc" data-i18n="cert.bis">Indian Standard</div>
</div>
</div>
</div>
</div>

<div style="text-align:center;margin-top:50px;"><button class="btn-cyber" data-i18n="cert.learnMore" onclick="var m=document.getElementById('cert-modal');m.style.display='flex';document.body.style.overflow='hidden';" type="button">LEARN MORE CERTIFICATIONS</button></div>
</div>
</section>
<!-- ===== CERT MODAL ===== -->
<style type="text/css">#cert-modal-dialog {
  background: linear-gradient(135deg,#0a0a0a,#1a1a2e);
  border: 1px solid rgba(0,242,255,0.3);
  border-radius: 16px;
  max-width: 1000px;
  width: 92%;
  max-height: min(92vh, 92dvh);
  padding: clamp(10px,2vh,28px) clamp(12px,2.5vw,36px);
  margin: auto;
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  box-sizing: border-box;
}
#cert-modal-scroll {
  overflow-y: auto;
  flex: 1;
  min-height: 0;
  display: flex;
  flex-direction: row;
  gap: clamp(10px,2vw,24px);
  align-items: flex-start;
}
#cert-modal-scroll > .cert-section:first-child { flex: 1 1 56%; min-width: 0; margin-bottom: 0; }
#cert-modal-scroll > .cert-section:last-child  { flex: 1 1 40%; min-width: 0; margin-bottom: 0; }
.cert-modal-title { color: #05a3f7; text-align: center; margin-bottom: clamp(6px,1.2vh,18px); font-size: clamp(0.95rem,2vw,1.5rem); flex-shrink: 0; }
.cert-section { margin-bottom: 0; }
.cert-section-title { color: #05a3f7; font-size: clamp(0.78rem,1.3vw,1rem); margin-bottom: 4px; font-weight: 700; letter-spacing: 0.5px; }
.cert-section-sub { color: #aaa; margin-bottom: 6px; font-size: clamp(0.65rem,1vw,0.78rem); }
.cert-iec-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: clamp(4px,0.8vw,8px); }
.cert-card { padding: clamp(5px,1vh,10px) clamp(7px,1.2vw,13px); background: rgba(0,242,255,0.05); border: 1px solid rgba(0,242,255,0.2); border-radius: 8px; }
.cert-card-title { color: #05a3f7; font-weight: 600; margin-bottom: 2px; font-size: clamp(0.68rem,1.1vw,0.82rem); }
.cert-card-sub { color: #aaa; font-size: clamp(0.62rem,0.95vw,0.74rem); }
.cert-emc-grid { display: grid; grid-template-columns: 1fr 1fr; gap: clamp(5px,1vw,10px); }
.cert-emc-card { padding: clamp(7px,1.2vh,13px) clamp(9px,1.5vw,16px); background: rgba(0,242,255,0.05); border: 1px solid rgba(0,242,255,0.2); border-radius: 8px; }
.cert-emc-card-title { color: #05a3f7; font-weight: 600; font-size: clamp(0.7rem,1.2vw,0.88rem); margin-bottom: clamp(4px,0.7vh,8px); }
.cert-emc-card-list { color: #aaa; line-height: 1.65; font-size: clamp(0.62rem,1vw,0.78rem); }
@media (max-width: 600px) {
  #cert-modal-scroll { flex-direction: column; overflow-y: auto; }
  .cert-emc-grid { grid-template-columns: 1fr; }
  .cert-emc-card-list { line-height: 1.5; }
}
</style>
<div id="cert-modal" onclick="if(event.target===this){document.getElementById('cert-modal').style.display='none';document.body.style.overflow='';}" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.75);z-index:9999;overflow:hidden;align-items:center;justify-content:center;">
<div id="cert-modal-dialog" onclick="event.stopPropagation()"><button onclick="event.preventDefault();document.getElementById('cert-modal').style.display='none';document.body.style.overflow='';" style="position:absolute;top:14px;right:18px;background:transparent;border:none;color:#05a3f7;font-size:1.6rem;cursor:pointer;z-index:10;line-height:1;" type="button">&times;</button>
<h2 class="cert-modal-title" data-i18n="cert.modalTitle" style="font-weight: bold;">Additional Certifications</h2>

<div id="cert-modal-scroll">
<div class="cert-section">
<h3 class="cert-section-title" data-i18n="cert.iecTitle">IEC Electrical Safety</h3>

<p class="cert-section-sub" data-i18n="cert.iecSubtitle">International Standards</p>

<div class="cert-iec-grid">
<div class="cert-card">
<div class="cert-card-title">IEC/EN 61010-1/2-201</div>

<div class="cert-card-sub">CB</div>
</div>

<div class="cert-card">
<div class="cert-card-title">IEC/EN/BS EN 62368-1</div>

<div class="cert-card-sub">CB Scheme report (AS/NZS 62368-1)</div>
</div>

<div class="cert-card">
<div class="cert-card-title">UL 61010-1</div>

<div class="cert-card-sub">LISTED</div>
</div>

<div class="cert-card">
<div class="cert-card-title">CUL 62368-1</div>

<div class="cert-card-sub">Recognized</div>
</div>

<div class="cert-card">
<div class="cert-card-title">IEC/EN 62368-1</div>

<div class="cert-card-sub">T&Uuml;V Certified</div>
</div>

<div class="cert-card">
<div class="cert-card-title">CNS 15598-1</div>

<div class="cert-card-sub">Taiwan Standard</div>
</div>

<div class="cert-card" style="grid-column:span 2;">
<div class="cert-card-title">IEC/EN 61558-1/-2-16</div>

<div class="cert-card-sub">CB Scheme report &nbsp;<span style="color:rgba(255,255,255,0.4);font-size:0.7rem;">* DIN Pro only</span></div>
</div>
</div>
</div>

<div class="cert-section" style="margin-bottom:0;">
<h3 class="cert-section-title" data-i18n="cert.emcTitle">EMC Certifications</h3>

<p class="cert-section-sub" data-i18n="cert.emcSubtitle">Electromagnetic Compatibility</p>

<div class="cert-emc-grid">
<div class="cert-emc-card">
<div class="cert-emc-card-title">Emissions</div>

<div class="cert-emc-card-list">EN/BS EN 55032 Class B<br />
KS C 9832<br />
CNS15936<br />
EN/BS EN 61000-6-4<br />
BS EN 61204-3<br />
IEC 61000-3-2<br />
IEC 61000-3-3</div>
</div>

<div class="cert-emc-card">
<div class="cert-emc-card-title">Immunity</div>

<div class="cert-emc-card-list">EN/BS EN55035<br />
KS C 9835<br />
EN/BS EN 61000-6-2<br />
BS EN 61204-3<br />
IEC61000-4-2/3/4/5/6/8/11</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- ===== SERIES COMPARISON ===== -->

<section id="series-comparison">
<div class="container-wide">
<div class="uk-text-center uk-margin-large-bottom reveal-up">
<h2 class="font-heading" data-i18n="compare.title">Series Comparison</h2>

<p data-i18n="compare.desc">Find the Perfect Match for Your Needs</p>
</div>

<div class="compare-wrap reveal-up delay-100">
<div class="compare-feature-col">
<div class="cf-header" data-i18n="compare.feature">Feature</div>

<div class="cf-row" data-i18n="compare.keyMission">Key Mission</div>

<div class="cf-row" data-i18n="compare.phase">Phase</div>

<div class="cf-row cf-row-powerboost" data-i18n="compare.acInput">AC Input</div>

<div class="cf-row cf-row-powerboost" data-i18n="compare.powerBoost">Power Boost</div>

<div class="cf-row" data-i18n="compare.operatingTemp">Operating Temp.</div>

<div class="cf-row" data-i18n="compare.remoteControl">Remote Control</div>

<div class="cf-row" data-i18n="compare.warranty">Warranty</div>

<div class="cf-row" data-i18n="compare.wattage">Wattage</div>

<div class="cf-row cf-row-btn">&nbsp;</div>
</div>

<div class="compare-group" style="flex:2;border:none;border-radius:16px;overflow:hidden;">
<div class="compare-group-header">
<div class="compare-col-header" style="flex:1;background:#05a3f7;color:#fff;border:2px solid #05a3f7;border-bottom:none;border-radius:14px 0 0 0;">
<div class="compare-col-header-inner">
<div class="compare-col-name" data-i18n="compare.dinProCol" style="color:#fff;">DIN Pro<br />
1-Phase Series</div>
<img alt="DIN Pro" class="compare-col-img" src="https://filecenter.deltaww.com/about/images/about-202602031043494802.png" /></div>
</div>

<div class="compare-col-header" style="flex:1;background:#4a6a85;color:#fff;border:2px solid #4a6a85;border-bottom:none;border-radius:0 14px 0 0;">
<div class="compare-col-header-inner">
<div class="compare-col-name" data-i18n="compare.forceGtCol" style="color:#fff;">Force-GT<br />
1-Phase Series</div>
<img alt="FORCE-GT" class="compare-col-img" src="https://filecenter.deltaww.com/about/images/about-202604131637389523.png" /></div>
</div>
</div>

<div class="compare-group-body">
<div class="compare-data-col" style="background:#0d1523;border:2px solid #05a3f7;border-top:none;border-radius:0 0 0 14px;">
<div class="compare-data-cell"><span data-i18n="compare.peakPowerApp">Peak Power Applications</span></div>

<div class="compare-data-cell"><span data-i18n="compare.singlePhase">1-Phase</span></div>

<div class="compare-data-cell has-check cell-powerboost">
<div><span>85~305V</span><br />
<span class="compare-note" data-i18n="compare.dinProAcNote">( 305V for 60s )</span></div>
<span class="cmp-check cmp-check-pro"><svg viewbox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg></span></div>

<div class="compare-data-cell has-check cell-powerboost">
<div><span data-i18n="compare.powerBoostValue">150% for 5s</span><br />
<span class="compare-note" data-i18n="compare.msNote">( 500% for 5ms / 200% for 50ms )</span></div>
<span class="cmp-check cmp-check-pro"><svg viewbox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg></span></div>

<div class="compare-data-cell has-check"><span data-i18n="compare.proTemp">-40&deg;C to +80&deg;C</span><span class="cmp-check cmp-check-pro"><svg viewbox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg></span></div>

<div class="compare-data-cell has-check"><span data-i18n="compare.yes">Yes</span><span class="cmp-check cmp-check-pro"><svg viewbox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg></span></div>

<div class="compare-data-cell has-check"><span data-i18n="compare.years5">5 Years</span><span class="cmp-check cmp-check-pro"><svg viewbox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg></span></div>

<div class="compare-data-cell has-check"><span>120W / 240W / 480W / 960W</span><span class="cmp-check cmp-check-pro"><svg viewbox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg></span></div>

<div class="compare-data-cell compare-data-cell-btn"><a class="compare-learn-more compare-learn-more-pro" data-i18n="dinpro.learnMore" data-url-template="https://psu.deltaww.com/{locale}/product/2/din-rail-power-supply/1/din-pro/123" href="{{ App::getLocale() === 'cn' ? 'https://deltapsu.cn/cn' : 'https://psu.deltaww.com/'.App::getLocale() }}/product/2/din-rail-power-supply/1/din-pro/123" target="_blank">LEARN MORE</a></div>
</div>

<div class="compare-data-col" style="background:#0d1a24;border:2px solid #4a6a85;border-top:none;border-left:none;border-radius:0 0 14px 0;">
<div class="compare-data-cell"><span data-i18n="compare.constantCurrentApp">Constant Current Applications</span></div>

<div class="compare-data-cell"><span data-i18n="compare.singlePhase">1-Phase</span></div>

<div class="compare-data-cell cell-powerboost"><span>90~264V</span></div>

<div class="compare-data-cell cell-powerboost"><span data-i18n="compare.na">N/A</span></div>

<div class="compare-data-cell"><span data-i18n="compare.forceGtTemp">-40&deg;C to +70&deg;C</span></div>

<div class="compare-data-cell"><span data-i18n="compare.na">N/A</span></div>

<div class="compare-data-cell"><span data-i18n="compare.years3">3 Years</span></div>

<div class="compare-data-cell"><span>120W / 240W / 480W</span></div>

<div class="compare-data-cell compare-data-cell-btn"><a class="compare-learn-more compare-learn-more-pro" data-i18n="compare.learnMore" data-url-template="https://psu.deltaww.com/{locale}/product/2/din-rail-power-supply/1/force-gt/109" href="{{ App::getLocale() === 'cn' ? 'https://deltapsu.cn/cn' : 'https://psu.deltaww.com/'.App::getLocale() }}/product/2/din-rail-power-supply/1/force-gt/109" onclick="try{localStorage.setItem('productFilters',JSON.stringify({arr_inputtxt:[{type:'31',value_text:'90-264 Vac'}]}))}catch(e){}" target="_blank">LEARN MORE</a></div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- ===== SOLUTIONS ===== -->

<section class="solutions-section" id="solutions" style="padding-top:60px;padding-bottom:20px;">
<div class="container-wide">
<div class="uk-text-center uk-margin-large-bottom reveal-up">
<h2 class="font-heading text-cyan" data-i18n="solutions.title">Featured Solutions</h2>

<p data-i18n="solutions.desc">Standard power modules ready for volume shipment.</p>

<div class="uk-flex uk-flex-center uk-margin-top" style="gap:10px;flex-wrap:wrap;"><button class="filter-pill active" data-i18n="solutions.all" onclick="filterProducts('all',this,event)" type="button">All products</button><button class="filter-pill" onclick="filterProducts('din-pro',this,event)" type="button">DIN Pro</button><button class="filter-pill" onclick="filterProducts('din-eco',this,event)" type="button">DIN Eco</button></div>
</div>

<div class="product-grid-container">
<div id="product-grid">
<div data-category="din-pro">
<div class="solution-card-new" onclick="showSalesKitModal('sol.cobotArm')">
<div class="sol-title-bar" data-i18n="sol.cobotArm">Cobot</div>
<img alt="Cobot" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603301009033361.jpg" /></div>
</div>

<div data-category="din-pro">
<div class="solution-card-new" onclick="showSalesKitModal('sol.semiconductor')">
<div class="sol-title-bar" data-i18n="sol.semiconductor">Semiconductor</div>
<img alt="Semiconductor" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603301010196755.jpg" /></div>
</div>

<div data-category="din-pro din-eco">
<div class="solution-card-new" onclick="showSalesKitModal('sol.dataCenter')">
<div class="sol-title-bar" data-i18n="sol.dataCenter">Data Center</div>
<img alt="Data Center" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603301009201859.jpg" /></div>
</div>

<div data-category="din-pro din-eco">
<div class="solution-card-new" onclick="showSalesKitModal('sol.evCharger')">
<div class="sol-title-bar" data-i18n="sol.evCharger">EV Charger</div>
<img alt="EV Charger" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603301009342843.jpg" /></div>
</div>

<div data-category="din-eco">
<div class="solution-card-new eco" onclick="showSalesKitModal('sol.greenEnergy')">
<div class="sol-title-bar" data-i18n="sol.greenEnergy">Green Energy</div>
<img alt="Green Energy" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202604301150474205.jpg" /></div>
</div>

<div data-category="din-eco">
<div class="solution-card-new eco" onclick="showSalesKitModal('sol.processAuto')">
<div class="sol-title-bar" data-i18n="sol.processAuto">Process Automation</div>
<img alt="Process Automation" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202603311704373374.jpg" /></div>
</div>
</div>
</div>
</div>
</section>
<!-- ===== CONTACT ===== -->

<section class="contact-bg" id="contact">
<div class="container-wide" style="position:relative;z-index:2;">
<div class="uk-grid uk-grid-large uk-flex-middle" uk-grid="">
<div class="uk-width-1-2@l reveal-up">
<h2 class="font-heading barlow" style="font-size:clamp(2.2rem,4vw,3.8rem)!important;line-height:1.2;margin-bottom:0.3em;"><span data-i18n="contact.titleStart" style="color:#fff;font-size:inherit!important;display:block;">REQUEST YOUR</span><span style="display:block;font-size:inherit!important;color:#fff;white-space:nowrap;"><span data-i18n="contact.titleMid" style="font-size:inherit!important;font-weight:inherit;text-shadow:0 0 20px rgba(0,220,255,0.9),0 0 40px rgba(0,180,255,0.7),0 0 80px rgba(0,140,255,0.5);color:#fff;">FREE SAMPLE</span><span data-i18n="contact.titleEnd" style="font-size:inherit!important;color:#fff;"> NOW!</span></span></h2>
<div style="width:100%;"><img src="{{ asset('frontend-asset/image/din-pro-and-din-eco.png') }}" alt="din-pro-and-din-eco" style="width:100%;" /></div>

<p class="uk-text-large uk-margin-medium-top" data-i18n="contact.desc">Simply send us your inquiry, and our sales team will get in touch with you promptly.<br />
<span class="disclaimer-note">* Limited quantities available.<br />
* Delta reserves the right to modify or interpret this offer.</span></p>

<p class="disclaimer-note" data-i18n="contact.disclaimer" style="display:none;">&nbsp;</p>

<div style="margin-top:16px;"><button onclick="document.getElementById('offices-modal').classList.add('is-open')" style="background:transparent;border:1px solid rgba(5,163,247,0.5);color:#05a3f7;border-radius:8px;padding:8px 20px;font-size:0.9rem;cursor:pointer;display:inline-flex;align-items:center;gap:8px;transition:all 0.3s;" type="button"><span uk-icon="icon:world;ratio:1"></span><span data-i18n="contact.globalOffices" style="color:#fff;">Contact Us</span></button></div>
</div>

<div class="uk-width-1-2@l reveal-up delay-100">
<div class="cyber-card">
<h3 class="text-cyan uk-margin-bottom" data-i18n="contact.formTitle">Request Consultation</h3>
<!-- ===== PATCH 3: Required labels with red asterisk ===== -->

<form class="uk-grid-small" id="contact-form" novalidate="" uk-grid="">
<div class="uk-width-1-2@s"><label class="uk-form-label" style="color:#fff;"><span data-i18n="contact.company">COMPANY</span><span style="color:#ff4444;margin-left:3px;">*</span> </label> <input class="uk-input input-neon" id="cf-company" type="text" /> <span class="cf-error" id="cf-company-err"></span></div>

<div class="uk-width-1-2@s"><label class="uk-form-label" style="color:#fff;"><span data-i18n="contact.name">NAME</span><span style="color:#ff4444;margin-left:3px;">*</span> </label> <input class="uk-input input-neon" id="cf-name" type="text" /> <span class="cf-error" id="cf-name-err"></span></div>

<div class="uk-width-1-2@s"><label class="uk-form-label" style="color:#fff;"><span data-i18n="contact.email">EMAIL</span><span style="color:#ff4444;margin-left:3px;">*</span> </label> <input class="uk-input input-neon" id="cf-email" type="email" /> <span class="cf-error" id="cf-email-err"></span></div>

<div class="uk-width-1-2@s"><label class="uk-form-label" style="color:#fff;"><span data-i18n="contact.country">COUNTRY</span><span style="color:#ff4444;margin-left:3px;">*</span> </label> <select class="uk-select input-neon" id="cf-country" style="background:rgba(0,20,40,0.6);border:1px solid rgba(0,242,255,0.3);color:#fff;border-radius:4px;"><option value="" data-i18n="contact.countryPlaceholder" style="background:#071830;color:#fff;">Select Country</option>@foreach ($mail_chimp_country as $c)<option value="{{ $c->name }}" style="background:#071830;color:#fff;">{{ $c->name }}</option>@endforeach</select> <span class="cf-error" id="cf-country-err"></span></div>

<div class="uk-width-1-2@s"><label class="uk-form-label" data-i18n="contact.phone" style="color:#fff;">PHONE</label> <input class="uk-input input-neon" id="cf-phone" type="tel" /></div>

<div class="uk-width-1-2@s"><label class="uk-form-label" data-i18n="contact.product" style="color:#fff;">PRODUCT</label> <select class="uk-select input-neon" id="cf-product" style="background:rgba(0,20,40,0.6);border:1px solid rgba(0,242,255,0.3);color:#fff;border-radius:4px;"><option data-i18n="contact.productPlaceholder" style="background:#071830;color:#fff;" value="">-- Select --</option><option style="background:#071830;color:#fff;" value="din-pro">DIN Pro</option><option style="background:#071830;color:#fff;" value="din-eco">DIN Eco</option> </select></div>

<div class="uk-width-1-1"><label class="uk-form-label" data-i18n="contact.projectStatusLabel" style="color:#fff;">Do you have an active or upcoming project that requires a power supply solution?</label><select class="uk-select input-neon" id="cf-project-status" style="background:#0a1628;color:#fff;border-color:rgba(0,242,255,0.3);"><option value="" data-i18n-option="contact.projectStatusPlaceholder" style="background:#071830;color:#fff;">-- Select --</option><option value="a" data-i18n-option="contact.projectStatusOpt1" style="background:#071830;color:#fff;">Yes, currently in development</option><option value="b" data-i18n-option="contact.projectStatusOpt2" style="background:#071830;color:#fff;">Yes, planning within the next 6 months</option><option value="c" data-i18n-option="contact.projectStatusOpt3" style="background:#071830;color:#fff;">Researching for future projects</option><option value="d" data-i18n-option="contact.projectStatusOpt4" style="background:#071830;color:#fff;">No specific project at the moment</option></select></div>
<div class="uk-width-1-1"><label class="uk-form-label" data-i18n="contact.message" style="color:#fff;">MESSAGE</label><textarea class="uk-textarea input-neon contact-textarea" id="contact-message" rows="4"></textarea></div>

<div class="uk-width-1-1" style="margin-top:12px;display:flex;align-items:flex-start;gap:10px;"><input id="cf-privacy" style="margin-top:3px;flex-shrink:0;accent-color:#05a3f7;width:16px;height:16px;cursor:pointer;" type="checkbox" /><label data-i18n="contact.privacyAgree" for="cf-privacy" style="color:#aaa;font-size:0.85rem;cursor:pointer;line-height:1.4;">I have read and agree to the <a href="https://psu.deltaww.com/en/etc/privacy-policy" target="_blank" style="color:#05a3f7;">Privacy Policy</a>.</label></div>
<span id="cf-privacy-err" style="color:#ff4444;font-size:0.8rem;margin-top:-4px;margin-bottom:0;display:none;"></span>

<div class="uk-width-1-1 uk-margin-medium-top"><button class="btn-cyber uk-width-1-1" data-i18n="contact.send" id="cf-submit-btn" onclick="submitContactForm()" type="button">Send Request</button></div>
</form>
</div>
</div>
</div>
</div>
</section>
</main>
<!-- ===== PATCH 1: Language Switcher (fixed position, top-right) ===== -->

<div class="lang-switcher" id="langSwitcher" style="position:fixed;top:18px;right:24px;z-index:99999;"><button class="lang-switcher-btn" onclick="toggleLangDropdown(event)" type="button"><svg fill="none" height="14" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="flex-shrink:0;" viewbox="0 0 24 24" width="14"> <circle cx="12" cy="12" r="10"></circle> <line x1="2" x2="22" y1="12" y2="12"></line> <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path> </svg> <span id="langCurrentName">EN</span> <svg class="lang-caret" fill="none" height="10" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24" width="10"> <polyline points="6 9 12 15 18 9"></polyline> </svg></button>

<div class="lang-dropdown">
<div class="lang-option active" data-lang="en" data-lang-url="{{ $langUrls['en'] }}" onclick="switchLang('en',this)"><span class="lang-name">English</span> <svg class="lang-check" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg></div>

<div class="lang-option" data-lang="zh-TW" data-lang-url="{{ $langUrls['zh-TW'] }}" onclick="switchLang('zh-TW',this)"><span class="lang-name">繁體中文</span> <svg class="lang-check" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg></div>

<div class="lang-option" data-lang="zh-CN" data-lang-url="{{ $langUrls['zh-CN'] }}" onclick="switchLang('zh-CN',this)"><span class="lang-name">简体中文</span> <svg class="lang-check" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg></div>

<div class="lang-option" data-lang="ja" data-lang-url="{{ $langUrls['ja'] }}" onclick="switchLang('ja',this)"><span class="lang-name">日本語</span> <svg class="lang-check" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
</div>
</div>
<!-- ===== NOTIFY MODAL ===== -->

<div class="uk-modal" id="notify-modal" onclick="if(event.target===this||event.target.classList.contains('uk-modal'))UIkit.modal(this).hide()" uk-modal="bg-close:true;esc-close:true">
<div class="uk-modal-dialog uk-modal-body notify-modal-content"><button class="uk-modal-close-default" onclick="UIkit.modal(document.getElementById('notify-modal')).hide()" type="button" uk-close=""></button>

<div class="uk-text-center">
<div class="notify-icon"><span uk-icon="icon:bell;ratio:3"></span></div>

<h2 class="notify-title" data-i18n="notify.title">Stay Updated</h2>

<p class="notify-desc" data-i18n="notify.desc">Be the first to know about our latest power solutions and product launches.</p>
</div>

<form class="notify-form" id="notify-form" novalidate="">
<div class="uk-margin"><input aria-label="Email Address" class="uk-input input-neon" data-i18n-placeholder="notify.emailPlaceholder" id="nf-email" placeholder="Your Email Address" type="email" /> <span class="cf-error" id="nf-email-err"></span></div>
<div class="uk-margin"><input aria-label="Name" class="uk-input input-neon" data-i18n-placeholder="notify.namePlaceholder" id="nf-name" placeholder="Your Name" type="text" /> <span class="cf-error" id="nf-name-err"></span></div>
<div class="uk-margin">
<select class="uk-select input-neon" id="nf-country" style="background:rgba(0,20,40,0.6);border:1px solid rgba(0,242,255,0.3);color:#fff;border-radius:4px;">
  <option value="" data-i18n="notify.countryPlaceholder" style="background:#071830;color:#fff;">Select Country</option>
  @foreach ($mail_chimp_country as $c)
  <option value="{{ $c->name }}" style="background:#071830;color:#fff;">{{ $c->name }}</option>
  @endforeach
</select>
<span class="cf-error" id="nf-country-err"></span>
</div>

<div class="uk-margin"><label class="notify-checkbox"><input id="nf-agree" type="checkbox" /> <span data-i18n="notify.agree">I agree to receive updates and marketing communications</span></label> <span class="cf-error" id="nf-agree-err"></span></div>
<div class="uk-margin"><label class="notify-checkbox"><input id="py-agree" type="checkbox" /> <span data-i18n="notify.privacyAgree">I have read and agree to the <a href="https://psu.deltaww.com/en/etc/privacy-policy" target="_blank" style="color:#05a3f7;">Privacy Policy</a>.</span></label> <span class="cf-error" id="py-agree-err"></span></div>
<button class="btn-cyber uk-width-1-1" data-i18n="notify.subscribe" id="notify-submit-btn" type="button">SUBSCRIBE NOW</button></form>
<script>
document.getElementById('notify-submit-btn').addEventListener('click', function() {
  var lang = document.documentElement.lang || 'en';
  var msgRequired = lang === 'zh-TW' ? '此欄位為必填' : lang === 'zh-CN' ? '此字段为必填项' : lang === 'ja' ? 'この項目は必須です' : 'This field is required';
  var msgEmail = lang === 'zh-TW' ? '請輸入有效的電子郵件' : lang === 'zh-CN' ? '请输入有效的电子邮件' : lang === 'ja' ? '有効なメールアドレスを入力してください' : 'Please enter a valid email address';
  var msgAgree = lang === 'zh-TW' ? '請勾選同意' : lang === 'zh-CN' ? '请勾选同意' : lang === 'ja' ? '同意してください' : 'Please agree to continue';
  var valid = true;
  var emailEl = document.getElementById('nf-email');
  var emailErr = document.getElementById('nf-email-err');
  var nameEl = document.getElementById('nf-name');
  var nameErr = document.getElementById('nf-name-err');
  var countryEl = document.getElementById('nf-country');
  var countryErr = document.getElementById('nf-country-err');
  var agreeEl = document.getElementById('nf-agree');
  var agreeErr = document.getElementById('nf-agree-err');
  var pyAgreeEl = document.getElementById('py-agree');
  var pyAgreeErr = document.getElementById('py-agree-err');
  [emailEl, nameEl, countryEl].forEach(function(el){ el.classList.remove('cf-invalid'); });
  [emailErr, nameErr, countryErr, agreeErr, pyAgreeErr].forEach(function(el){ el.textContent=''; el.classList.remove('visible'); });
  var emailVal = emailEl.value.trim();
  var nameVal = nameEl.value.trim();
  var countryVal = countryEl.value;
  if (!emailVal) { emailEl.classList.add('cf-invalid'); emailErr.textContent = msgRequired; emailErr.classList.add('visible'); if(valid) emailEl.focus(); valid = false; }
  else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal)) { emailEl.classList.add('cf-invalid'); emailErr.textContent = msgEmail; emailErr.classList.add('visible'); if(valid) emailEl.focus(); valid = false; }
  if (!nameVal) { nameEl.classList.add('cf-invalid'); nameErr.textContent = msgRequired; nameErr.classList.add('visible'); if(valid) nameEl.focus(); valid = false; }
  if (!countryVal) { countryEl.classList.add('cf-invalid'); countryErr.textContent = msgRequired; countryErr.classList.add('visible'); valid = false; }
  if (!agreeEl.checked) { agreeErr.textContent = msgAgree; agreeErr.classList.add('visible'); valid = false; }
  if (!pyAgreeEl.checked) { pyAgreeErr.textContent = msgAgree; pyAgreeErr.classList.add('visible'); valid = false; }
  if (valid) {
    fetch('{{ route('landingSubscribe') }}', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': window._csrfToken },
      body: JSON.stringify({ email: emailVal, name: nameVal, country: countryVal })
    })
    .then(function(r){ return r.json(); })
    .then(function(){ alert('Thank you for subscribing!'); UIkit.modal('#notify-modal').hide(); })
    .catch(function(){ alert('Thank you for subscribing!'); UIkit.modal('#notify-modal').hide(); });
  }
});
</script>

<div class="notify-features uk-margin-medium-top">
<div class="uk-grid uk-grid-small uk-child-width-1-3" uk-grid="">
<div class="uk-text-center"><span uk-icon="icon:mail;ratio:1.5" class="text-cyan"></span>
<p class="uk-text-small uk-margin-remove-top" data-i18n="notify.productUpdates">Product Updates</p>
</div>

<div class="uk-text-center"><span uk-icon="icon:calendar;ratio:1.5" class="text-cyan"></span>
<p class="uk-text-small uk-margin-remove-top" data-i18n="notify.eventInvites">Event Invites</p>
</div>

<div class="uk-text-center"><span uk-icon="icon:tag;ratio:1.5" class="text-cyan"></span>
<p class="uk-text-small uk-margin-remove-top" data-i18n="notify.exclusiveOffers">Exclusive Offers</p>
</div>
</div>
</div>
</div>
</div>
<!-- ===== SALES KIT MODAL ===== -->

<div id="saleskit-modal-overlay" onclick="closeSalesKitModal(event)" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;z-index:9998;background:rgba(0,0,0,0.7);backdrop-filter:blur(5px);">&nbsp;</div>

<div id="saleskit-modal-dialog" style="display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);z-index:9999;background:linear-gradient(135deg,#0a0a0a,#1a1a2e);border:1px solid rgba(0,242,255,0.3);border-radius:16px;padding:40px;width:90%;max-width:600px;"><button onclick="closeSalesKitModal(event)" style="position:absolute;top:15px;right:15px;background:transparent;border:none;color:#05a3f7;font-size:24px;cursor:pointer;width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:all 0.3s;" type="button"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="width:20px;height:20px;" viewbox="0 0 24 24"><line x1="18" x2="6" y1="6" y2="18"></line><line x1="6" x2="18" y1="6" y2="18"></line></svg></button>

<div style="text-align:center;">
<div style="margin-bottom:20px;"><span uk-icon="icon:file-text;ratio:3" style="color:#05a3f7;"></span></div>

<h2 data-i18n="saleskit.title" style="color:#05a3f7;font-size:1.8rem;margin-bottom:10px;">Request Sales Kit</h2>

<p id="modal-application-name" style="color:#ccc;font-size:1.1rem;margin-bottom:30px;">&nbsp;</p>

<form id="saleskit-form" novalidate="" style="text-align:left;max-width:500px;margin:0 auto;">
<div style="margin-bottom:20px;"><label data-i18n="saleskit.name" style="display:block;color:#aaa;margin-bottom:8px;font-size:0.9rem;">Name *</label><input data-i18n-placeholder="saleskit.namePlaceholder" id="saleskit-name" placeholder="Your name" required="" style="width:100%;padding:12px;background:rgba(255,255,255,0.05);border:1px solid rgba(0,242,255,0.3);border-radius:8px;color:#fff;font-size:1rem;" type="text" /><span id="saleskit-name-err" style="color:#ff4444;font-size:0.8rem;margin-top:4px;display:none;"></span></div>

<div style="margin-bottom:20px;"><label data-i18n="saleskit.email" style="display:block;color:#aaa;margin-bottom:8px;font-size:0.9rem;">Email *</label><input id="saleskit-email" placeholder="your.email@company.com" required="" style="width:100%;padding:12px;background:rgba(255,255,255,0.05);border:1px solid rgba(0,242,255,0.3);border-radius:8px;color:#fff;font-size:1rem;" type="email" /><span id="saleskit-email-err" style="color:#ff4444;font-size:0.8rem;margin-top:4px;display:none;"></span></div>

<div style="margin-bottom:20px;"><label data-i18n="saleskit.company" style="display:block;color:#aaa;margin-bottom:8px;font-size:0.9rem;">Company *</label><input data-i18n-placeholder="saleskit.companyPlaceholder" id="saleskit-company" placeholder="Your company name" required="" style="width:100%;padding:12px;background:rgba(255,255,255,0.05);border:1px solid rgba(0,242,255,0.3);border-radius:8px;color:#fff;font-size:1rem;" type="text" /><span id="saleskit-company-err" style="color:#ff4444;font-size:0.8rem;margin-top:4px;display:none;"></span></div>

<div style="margin-bottom:30px;"><label data-i18n="saleskit.phone" style="display:block;color:#aaa;margin-bottom:8px;font-size:0.9rem;">Phone</label><input data-i18n-placeholder="saleskit.phonePlaceholder" id="saleskit-phone" placeholder="Optional" style="width:100%;padding:12px;background:rgba(255,255,255,0.05);border:1px solid rgba(0,242,255,0.3);border-radius:8px;color:#fff;font-size:1rem;" type="tel" /></div>
<div style="margin-bottom:20px;display:flex;align-items:flex-start;gap:10px;"><input id="saleskit-privacy" style="margin-top:3px;flex-shrink:0;accent-color:#05a3f7;width:16px;height:16px;cursor:pointer;" type="checkbox" /><label data-i18n="saleskit.privacyAgree" for="saleskit-privacy" id="saleskit-privacy-label" style="color:#aaa;font-size:0.85rem;cursor:pointer;line-height:1.4;">I have read and agree to the <a href="https://psu.deltaww.com/en/etc/privacy-policy" target="_blank" style="color:#05a3f7;">Privacy Policy</a>.</label></div>
<span id="saleskit-privacy-err" style="color:#ff4444;font-size:0.8rem;margin-top:-12px;margin-bottom:12px;display:none;"></span>
<button class="btn-cyber" data-i18n="saleskit.download" id="download-btn" style="width:100%;min-height:50px;" type="submit">DOWNLOAD SALES KIT</button></form>
</div>
</div>
<!-- ===== FOOTER ===== -->

<footer class="site-footer uk-text-center">
<div style="margin:0 0 16px 0;padding-top:24px;display:flex;justify-content:center;"><img alt="Delta Industrial" loading="lazy" src="https://filecenter.deltaww.com/about/images/about-202604271156079769.png" style="height:40px;display:block;" /></div>

<div style="display:flex;justify-content:center;align-items:center;gap:30px;margin:10px 0 18px 0;"><a href="https://psu.deltaww.com/en" id="footer-globe-link" style="color:#fff;" target="_blank"><span uk-icon="icon:world;ratio:1.8"></span></a> <a href="https://www.youtube.com/@DeltaPSU" style="color:#fff;" target="_blank"><span uk-icon="icon:youtube;ratio:1.8"></span></a> <a href="https://www.linkedin.com/showcase/deltapsu/" style="color:#fff;" target="_blank"><span uk-icon="icon:linkedin;ratio:1.8"></span></a> <a href="https://www.facebook.com/DeltaPSU" style="color:#fff;" target="_blank"><span uk-icon="icon:facebook;ratio:1.8"></span></a> <a href="#" onclick="document.getElementById('wechat-modal').style.display='flex';return false;" style="color:#fff;cursor:pointer;"><svg fill="currentColor" height="32" viewbox="0 0 24 24" width="32" xmlns="http://www.w3.org/2000/svg"><path d="M8.691 2.188C3.891 2.188 0 5.476 0 9.53c0 2.212 1.17 4.203 3.002 5.55a.59.59 0 0 1 .213.665l-.39 1.48c-.019.07-.048.141-.048.213 0 .163.13.295.29.295a.326.326 0 0 0 .167-.054l1.903-1.114a.864.864 0 0 1 .717-.098 10.16 10.16 0 0 0 2.837.403c.276 0 .543-.027.811-.05-.857-2.578.157-4.972 1.932-6.446 1.703-1.415 3.882-1.98 5.853-1.838-.576-3.583-4.196-6.348-8.596-6.348zM5.785 5.991c.642 0 1.162.529 1.162 1.18a1.17 1.17 0 0 1-1.162 1.178A1.17 1.17 0 0 1 4.623 7.17c0-.651.52-1.18 1.162-1.18zm5.813 0c.642 0 1.162.529 1.162 1.18a1.17 1.17 0 0 1-1.162 1.178 1.17 1.17 0 0 1-1.162-1.178c0-.651.52-1.18 1.162-1.18zm5.34 2.867c-1.797-.052-3.746.512-5.28 1.786-1.72 1.428-2.687 3.72-1.78 6.22.942 2.453 3.497 4.02 6.345 4.02a9.18 9.18 0 0 0 2.956-.479.8.8 0 0 1 .672.067l1.42.83a.316.316 0 0 0 .32-.308.31.31 0 0 0-.052-.168l-.36-1.21a.61.61 0 0 1 .208-.677C23.01 17.495 24 15.768 24 13.892c0-3.324-3.013-5.981-7.063-6.034zm-2.72 3.274c.55 0 .997.45.997 1.002a1 1 0 0 1-.997 1.002 1 1 0 0 1-.997-1.002c0-.552.448-1.002.997-1.002zm5.44 0c.55 0 .997.45.997 1.002a1 1 0 0 1-.997 1.002 1 1 0 0 1-.997-1.002c0-.552.448-1.002.997-1.002z"></path></svg></a></div>

<p style="font-size:0.8rem;color:#555;margin:0 0 30px 0;">&copy; 2026 Delta Electronics. Power &amp; System BG.</p>
</footer>
<!-- ===== WECHAT MODAL ===== -->

<div id="wechat-modal" onclick="if(event.target===this)this.style.display='none'" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.75);z-index:9999;justify-content:center;align-items:center;">
<div style="background:#1a2235;border:1px solid rgba(0,242,255,0.2);border-radius:16px;padding:32px;text-align:center;max-width:320px;position:relative;"><button onclick="document.getElementById('wechat-modal').style.display='none'" style="position:absolute;top:12px;right:16px;background:none;border:none;color:#aaa;font-size:1.4rem;cursor:pointer;line-height:1;" type="button">&times;</button><svg fill="#07C160" height="40" style="margin-bottom:12px;" viewbox="0 0 24 24" width="40" xmlns="http://www.w3.org/2000/svg"><path d="M8.691 2.188C3.891 2.188 0 5.476 0 9.53c0 2.212 1.17 4.203 3.002 5.55a.59.59 0 0 1 .213.665l-.39 1.48c-.019.07-.048.141-.048.213 0 .163.13.295.29.295a.326.326 0 0 0 .167-.054l1.903-1.114a.864.864 0 0 1 .717-.098 10.16 10.16 0 0 0 2.837.403c.276 0 .543-.027.811-.05-.857-2.578.157-4.972 1.932-6.446 1.703-1.415 3.882-1.98 5.853-1.838-.576-3.583-4.196-6.348-8.596-6.348zM5.785 5.991c.642 0 1.162.529 1.162 1.18a1.17 1.17 0 0 1-1.162 1.178A1.17 1.17 0 0 1 4.623 7.17c0-.651.52-1.18 1.162-1.18zm5.813 0c.642 0 1.162.529 1.162 1.18a1.17 1.17 0 0 1-1.162 1.178 1.17 1.17 0 0 1-1.162-1.178c0-.651.52-1.18 1.162-1.18zm5.34 2.867c-1.797-.052-3.746.512-5.28 1.786-1.72 1.428-2.687 3.72-1.78 6.22.942 2.453 3.497 4.02 6.345 4.02a9.18 9.18 0 0 0 2.956-.479.8.8 0 0 1 .672.067l1.42.83a.316.316 0 0 0 .32-.308.31.31 0 0 0-.052-.168l-.36-1.21a.61.61 0 0 1 .208-.677C23.01 17.495 24 15.768 24 13.892c0-3.324-3.013-5.981-7.063-6.034zm-2.72 3.274c.55 0 .997.45.997 1.002a1 1 0 0 1-.997 1.002 1 1 0 0 1-.997-1.002c0-.552.448-1.002.997-1.002zm5.44 0c.55 0 .997.45.997 1.002a1 1 0 0 1-.997 1.002 1 1 0 0 1-.997-1.002c0-.552.448-1.002.997-1.002z"></path></svg>

<p data-i18n="wechat.scan" style="color:#fff;font-size:1rem;font-weight:600;margin:0 0 16px;">Scan to add WeChat</p>

<div style="background:#fff;padding:12px;border-radius:8px;display:inline-block;"><img alt="WeChat QR Code" id="wechat-qr-img" src="https://filecenter.deltaww.com/about/images/about-202604240920361715.png" style="width:200px;height:200px;display:block;" /></div>

<p data-i18n="wechat.instruction" style="color:#aaa;font-size:0.8rem;margin:12px 0 0;">Open WeChat &rarr; Scan QR Code</p>
</div>
</div>
<!-- ===== YOUTUBE MODAL ===== -->

<div id="yt-modal">
<div id="yt-dialog"><button id="yt-close" onclick="closeYoutubeModal()" type="button">&times;</button><iframe allow="autoplay;encrypted-media" allowfullscreen="" id="yt-iframe" src="about:blank"></iframe></div>
</div>
<!-- ===== PROMO MODAL ===== -->

{{-- <div id="promo-overlay" onclick="closePromoModal()">
<div id="promo-dialog" onclick="event.stopPropagation()"><button id="promo-close" onclick="closePromoModal()" type="button">&times;</button>

<div id="promo-img-wrap"><img alt="Promotion" fetchpriority="high" id="promo-img" loading="eager" src="https://filecenter.deltaww.com/about/images/about-202604291009473100.jpg" /></div>
</div>
</div> --}}
<!-- ===== GLOBAL OFFICES MODAL ===== -->

<div id="offices-modal" onclick="document.getElementById('offices-modal').classList.remove('is-open')">
<div id="offices-dialog" onclick="event.stopPropagation()"><button onclick="document.getElementById('offices-modal').classList.remove('is-open')" style="position:absolute;top:8px;right:12px;background:none;border:none;color:#aaa;font-size:1.2rem;cursor:pointer;line-height:1;z-index:1;" type="button">&times;</button>

<h2 data-i18n="offices.title">Global Operations &amp; Service Locations</h2>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
<div>
<h3 data-i18n="offices.asia">Asia</h3>

<div class="o-entry">
<p class="o-name">Delta Electronics, Inc.</p>

<p class="o-addr">3 Tungyuan Road, Chungli Industrial Zone, Taoyuan County 32063, Taiwan, R.O.C.</p>

<p class="o-addr">TEL: +886 3 452 6107</p>
</div>

<div class="o-entry">
<p class="o-name">Delta Electronics (Shanghai) Co., Ltd <span class="o-hq">China HQ</span></p>

<p class="o-addr">No. 182 Minyu Road, Pudong, Shanghai, P.R.C. 201209</p>

<p class="o-addr">TEL: +86 21 6872 3988</p>
</div>

<div class="o-entry">
<p class="o-name">Delta Electronics (Thailand) PCL.</p>

<p class="o-addr">909 Soi 9, Moo 4, Bangpoo Industrial Estate, Samutprakarn 10280, Thailand</p>

<p class="o-addr">TEL: +66 2 709 2800</p>
</div>

<div class="o-entry">
<p class="o-name">Delta Electronics India Pvt. Ltd.</p>

<p class="o-addr">Plot No. 43, Sector-35, HSIIDC, Gurgaon, Haryana 122001</p>

<p class="o-addr">TEL: +91 124 4874 900</p>
</div>

<div class="o-entry">
<p class="o-name">Delta Electronics (Japan), Inc.</p>

<p class="o-addr">4-11-25 Shibaura, Minato-ku, Tokyo 108-0023, Japan</p>

<p class="o-addr">TEL: +81 3 6811 5800</p>
</div>

<div class="o-entry">
<p class="o-name">Delta Electronics (Korea), Inc.</p>

<p class="o-addr">1504, Byucksan Digital Valley 6-Cha, Seoul, Korea</p>

<p class="o-addr">TEL: +82 2 515 5303</p>
</div>

<div class="o-entry">
<p class="o-name">Delta Electronics (Australia) Pty Ltd</p>

<p class="o-addr">20-21, 45 Normanby Rd. Notting Hill, VIC 3168, Australia</p>

<p class="o-addr">TEL: +61 9543 3720</p>
</div>

<div class="o-entry">
<p class="o-name">Delta Energy Systems (Singapore) Pte Ltd</p>

<p class="o-addr">4 Kaki Bukit Avenue 1, #05-04, Singapore 417939</p>

<p class="o-addr">TEL: +65 6747 5155</p>
</div>
</div>

<div>
<h3 data-i18n="offices.northAmerica">North America</h3>

<div class="o-entry">
<p class="o-name">Delta Electronics (Americas) Ltd. <span class="o-hq">North American HQ</span></p>

<p class="o-addr">46101 Fremont Blvd. Fremont, CA 94538, U.S.A.</p>

<p class="o-addr">TEL: +1 510 668 5100</p>
</div>

<h3 data-i18n="offices.centralSouthAmerica" style="margin-top:10px;">Central &amp; South America</h3>

<div class="o-entry">
<p class="o-name">Delta Electronics International Mexico S.A. de C.V.</p>

<p class="o-addr">Centrum Park, Av. Gustavo Baz Prada 309, Tlalnepantla, M&eacute;xico</p>

<p class="o-addr">TEL: +52 55 3603 9200</p>
</div>

<div class="o-entry">
<p class="o-name">Delta Electronics (Brasil) Ltda</p>

<p class="o-addr">Estrada Velha Rio S&atilde;o Paulo, 5300, S&atilde;o Jos&eacute; dos Campos-SP, Brasil</p>

<p class="o-addr">TEL: +55 12 3932 2300</p>
</div>

<h3 data-i18n="offices.europe" style="margin-top:10px;">Europe</h3>

<div class="o-entry">
<p class="o-name">Delta Electronics (Netherlands) B.V. <span class="o-hq">EMEA HQ</span></p>

<p class="o-addr">Zandsteen 15, 2132 MZ Hoofddorp, The Netherlands</p>

<p class="o-addr">TEL: +31 20 800 3900</p>
</div>

<div class="o-entry">
<p class="o-addr">Automotive Campus 260, 5708 JZ Helmond, The Netherlands</p>

<p class="o-addr">TEL: +31 40 800 3900</p>
</div>

<div class="o-entry">
<p class="o-name">Delta Greentech Elektronik (Turkey)</p>

<p class="o-addr">Şerifali Mah. Hendem Cad. Kule Sok. No:16-A, &Uuml;mraniye, İstanbul, Turkey</p>

<p class="o-addr">TEL: +90 216 499 99 10</p>
</div>
</div>
</div>
</div>
</div>
<a class="scroll-top-btn" href="#intro"><svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="24"><path d="M18 15l-6-6-6 6"></path></svg></a><a href="#contact" id="promo-mini-btn" title="Get Info"><svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="24"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect height="5" width="20" x="2" y="7"></rect><line x1="12" x2="12" y1="22" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg></a></div>




<style>
.cd-block { display:flex;flex-direction:column;align-items:center;background:rgba(0,5,16,0.65);border:1px solid rgba(5,163,247,0.5);border-radius:6px;padding:5px 10px;min-width:48px;backdrop-filter:blur(4px); }
.cd-num { font-size:1.4rem;font-weight:700;color:#fff;line-height:1;font-variant-numeric:tabular-nums; }
.cd-label { font-size:0.55rem;color:rgba(5,163,247,0.9);letter-spacing:1.5px;margin-top:2px; }
.cd-sep { font-size:1.4rem;font-weight:700;color:#05a3f7;line-height:1;align-self:flex-start;padding-top:5px; }
@keyframes cd-pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }
.cd-sep { animation:cd-pulse 1s ease-in-out infinite; }
@media (max-width: 768px) {
  .cd-block { padding: 3px 6px; min-width: clamp(32px,9vw,44px); border-radius: 5px; }
  .cd-num { font-size: clamp(0.8rem,4.5vw,1.2rem); }
  .cd-label { font-size: clamp(0.38rem,1.8vw,0.5rem); letter-spacing: 1px; }
  .cd-sep { font-size: clamp(0.8rem,4.5vw,1.2rem); padding-top: 3px; }
}
</style>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>
<script>
(function(){
  function tick(){
    var _l = document.documentElement.lang;
    var target = (_l === 'zh-TW' || _l === 'zh-CN')
      ? new Date('2026-05-20T09:30:00+08:00').getTime()
      : new Date('2026-05-20T15:30:00+08:00').getTime();
    var now = Date.now(), diff = target - now;
    var el = document.getElementById('video-countdown');
    if(!el) return;
    if(diff <= 0){ el.style.display='none'; return; }
    var d = Math.floor(diff/86400000);
    var h = Math.floor((diff%86400000)/3600000);
    var m = Math.floor((diff%3600000)/60000);
    var s = Math.floor((diff%60000)/1000);
    function pad(n){return n<10?'0'+n:n;}
    document.getElementById('cd-days').textContent = pad(d);
    document.getElementById('cd-hours').textContent = pad(h);
    document.getElementById('cd-mins').textContent = pad(m);
    document.getElementById('cd-secs').textContent = pad(s);
  }
  document.addEventListener('DOMContentLoaded', function(){ tick(); setInterval(tick,1000); });
})();
</script>
<script>
(function() {
  'use strict';

  /* =============================================
     PRODUCT IMAGE SWITCHER
     ============================================= */
  var productImages = {
    pro: { all:'https://filecenter.deltaww.com/about/images/about-202604231000027622.png','120w':'https://filecenter.deltaww.com/about/images/about-202602031044150033.png','240w':'https://filecenter.deltaww.com/about/images/about-202602031044327605.png','480w':'https://filecenter.deltaww.com/about/images/about-202602031044472805.png','960w':'https://filecenter.deltaww.com/about/images/about-202602031045015192.png' },
    eco: { all:'https://filecenter.deltaww.com/about/images/about-202604230959225538.png','120w':'https://filecenter.deltaww.com/about/images/about-202602031059068557.png','240w':'https://filecenter.deltaww.com/about/images/about-202602031059213097.png','480w':'https://filecenter.deltaww.com/about/images/about-202602031059389050.png','960w':'https://filecenter.deltaww.com/about/images/about-202602031059531197.png' }
  };
  // Preload all product images so switching is instant (no network lag)
  (function preloadProductImages() {
    Object.keys(productImages).forEach(function(series) {
      Object.keys(productImages[series]).forEach(function(key) {
        var img = new Image();
        img.src = productImages[series][key];
      });
    });
  })();

  window.switchProductImage = function(series, wattage, btn, e) {
    if (e) e.preventDefault();
    var img = document.getElementById(series + '-img');
    if (!img) return;
    btn.parentElement.querySelectorAll('.watt-btn').forEach(function(b) { b.classList.remove('active'); });
    btn.classList.add('active');
    img.src = (productImages[series] && productImages[series][wattage]) || img.src;
  };

  /* =============================================
     SOLUTION FILTER
     ============================================= */
  window.filterProducts = function(category, btn, e) {
    if (e) { e.preventDefault(); e.stopPropagation(); }
    document.querySelectorAll('.filter-pill').forEach(function(b) { b.classList.remove('active'); });
    btn.classList.add('active');
    document.querySelectorAll('#product-grid > div').forEach(function(item) {
      var cats = (item.getAttribute('data-category') || '').trim().split(/\s+/);
      item.classList.toggle('sol-hidden', category !== 'all' && cats.indexOf(category) === -1);
    });
  };

  /* =============================================
     SMOOTH SCROLL
     ============================================= */
  function smoothScrollTo(element) {
    if (!element) return;
    var start = window.pageYOffset;
    var dist = element.getBoundingClientRect().top;
    var duration = 1000, startTime = null;
    function ease(t,b,c,d) { t/=d/2; if(t<1) return c/2*t*t+b; t--; return -c/2*(t*(t-2)-1)+b; }
    function step(now) { if (!startTime) startTime = now; var elapsed = now - startTime; window.scrollTo(0, ease(elapsed,start,dist,duration)); if (elapsed < duration) requestAnimationFrame(step); }
    requestAnimationFrame(step);
  }

  /* =============================================
     SIDE NAV ACTIVE STATE
     ============================================= */
  var sectionIds = ['intro','overview','din-pro','din-eco','certifications','series-comparison','solutions','contact'];
  function updateSideNav() {
    var trigger = window.innerHeight * 0.4, current = sectionIds[0];
    sectionIds.forEach(function(id) { var el = document.getElementById(id); if (el && el.getBoundingClientRect().top <= trigger) current = id; });
    document.querySelectorAll('.side-nav a[data-section], .mobile-bottom-nav a[data-section]').forEach(function(a) {
      a.classList.toggle('active', a.getAttribute('data-section') === current);
    });
  }
  window.addEventListener('load', updateSideNav);
  window.addEventListener('scroll', updateSideNav, { passive: true });
  window.addEventListener('resize', updateSideNav, { passive: true });
  setTimeout(updateSideNav, 300);

  /* =============================================
     SCROLL DOWN BUTTONS (intro only)
     ============================================= */
  function initNextButtons() {
    // Scroll down button removed per design update
  }

  /* =============================================
     REVEAL ANIMATIONS
     ============================================= */
  function initRevealAnimations() {
    if (typeof IntersectionObserver === 'undefined') return;
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) { if (entry.isIntersecting) entry.target.classList.add('active'); });
    }, { threshold: 0.15 });
    document.querySelectorAll('.reveal-up').forEach(function(el) { observer.observe(el); });
  }

  function forceAllVisible() {
    document.querySelectorAll('.reveal-up:not(.hidden)').forEach(function(el) { el.classList.add('active'); });
  }

  /* =============================================
     DIN VIDEO CLIP-PATH
     ============================================= */
  function initDinVideo() {
    var video = document.getElementById('din-bg-video');
    var wrapper = document.getElementById('din-sections-wrapper');
    if (!video || !wrapper) return;
    function update() {
      var r = wrapper.getBoundingClientRect(), vh = window.innerHeight;
      var top = Math.max(0, r.top), bottom = Math.min(vh, r.bottom);
      video.style.clipPath = (bottom <= top) ? 'inset(100% 0 0 0)' : 'inset(' + top + 'px 0px ' + (vh - bottom) + 'px 0px)';
      requestAnimationFrame(update);
    }
    requestAnimationFrame(update);
  }

  /* =============================================
     CONTACT FORM
     ============================================= */
  window.submitContactForm = function() {
    var t = window._currentTranslations || {};
    var lang = document.documentElement.getAttribute('lang') || 'en';
    var msgRequired = lang === 'zh-TW' ? '此欄位為必填' : lang === 'zh-CN' ? '此栏位为必填项' : lang === 'ja' ? 'この項目は必須です' : 'This field is required';
    var msgEmail = lang === 'zh-TW' ? '請輸入有效的電子郵件' : lang === 'zh-CN' ? '请输入有效的电子邮件' : lang === 'ja' ? '有効なメールアドレスを入力してください' : 'Please enter a valid email address';
    var msgSent = lang === 'zh-TW' ? '已成功送出！' : lang === 'zh-CN' ? '提交成功！' : lang === 'ja' ? '送信しました！' : 'Your request has been sent!';
    var msgPrivacy = t['contact.privacyRequired'] || 'Please agree to the Privacy Policy.';
    var fields = [
      { id:'cf-company', errId:'cf-company-err' },
      { id:'cf-name',    errId:'cf-name-err' },
      { id:'cf-email',   errId:'cf-email-err', isEmail: true },
      { id:'cf-country', errId:'cf-country-err' }
    ];
    fields.forEach(function(f) {
      document.getElementById(f.id).classList.remove('cf-invalid');
      var err = document.getElementById(f.errId);
      err.textContent = ''; err.classList.remove('visible');
    });
    var valid = true;
    fields.forEach(function(f) {
      var el = document.getElementById(f.id), err = document.getElementById(f.errId), val = el.value.trim();
      if (!val) { el.classList.add('cf-invalid'); err.textContent = msgRequired; err.classList.add('visible'); valid = false; }
      else if (f.isEmail && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) { el.classList.add('cf-invalid'); err.textContent = msgEmail; err.classList.add('visible'); valid = false; }
    });
    var cfPrivacyErr = document.getElementById('cf-privacy-err');
    if (cfPrivacyErr) { cfPrivacyErr.textContent = ''; cfPrivacyErr.style.display = 'none'; }
    if (!valid) return;
    var cfPrivacyChecked = document.getElementById('cf-privacy') && document.getElementById('cf-privacy').checked;
    if (!cfPrivacyChecked) { if (cfPrivacyErr) { cfPrivacyErr.textContent = msgPrivacy; cfPrivacyErr.style.display = 'block'; } return; }
    // Use the specific button id to avoid ambiguity
    var btn = document.getElementById('cf-submit-btn');
    if (btn) { btn.disabled = true; }

    var formData = new FormData();
    formData.append('_token', window._csrfToken || '');
    ['cf-company','cf-name','cf-email','cf-country','cf-phone','cf-product','contact-message'].forEach(function(id) {
      var el = document.getElementById(id);
      if (el) formData.append(id, el.value);
    });
    var psSel = document.getElementById('cf-project-status');
    formData.append('cf-project-status', (psSel && psSel.selectedIndex > 0) ? psSel.options[psSel.selectedIndex].textContent.trim() : '');

    fetch('{{ route("landingContact") }}', { method: 'POST', body: formData })
      .then(function(res) { return res.json(); })
      .then(function(data) {
        if (data.status !== 'success') { if (btn) btn.disabled = false; return; }

        var msgThankYou = lang === 'zh-TW' ? '感謝您的填寫，我們的業務團隊將盡快與您聯繫。'
          : lang === 'zh-CN' ? '感谢您的提交，我们的销售团队将尽快与您联系。'
          : lang === 'ja'    ? 'ご送信ありがとうございます。営業担当者より折り返しご連絡いたします。'
          : 'Thank you for your submission, our sales team will contact you soon.';

        // Show thank-you: hide form, append message in cyber-card
        var cyberCard = document.querySelector('#contact > .container-wide .cyber-card');
        if (cyberCard) {
          var form2 = document.getElementById('contact-form');
          if (form2) form2.style.display = 'none';
          var old = document.getElementById('cf-thankyou-msg');
          if (old) old.remove();
          var thankDiv = document.createElement('div');
          thankDiv.id = 'cf-thankyou-msg';
          thankDiv.style.cssText = 'text-align:left;padding:50px 20px;';
          thankDiv.innerHTML =
            '<p style="color:#00e676!important;font-size:0.95rem!important;font-weight:500;line-height:1.7;margin:0!important;opacity:1!important;max-width:none!important;">' + msgThankYou + '</p>';
          cyberCard.appendChild(thankDiv);
        }

        // Floating toast
        var toastId = 'cf-success-toast';
        var oldToast = document.getElementById(toastId);
        if (oldToast) oldToast.remove();
        var msgToast = lang === 'zh-TW' ? '已成功送出！' : lang === 'zh-CN' ? '提交成功！' : lang === 'ja' ? '送信しました！' : 'Submitted successfully!';
        var toast = document.createElement('div');
        toast.id = toastId;
        toast.textContent = msgToast;
        toast.style.cssText = 'position:fixed;top:24px;left:50%;transform:translateX(-50%) translateY(-20px);background:linear-gradient(90deg,#00c853,#00897b);color:#fff;font-weight:700;font-size:1.05rem;padding:16px 36px;border-radius:50px;z-index:999999;box-shadow:0 8px 32px rgba(0,200,100,0.4);opacity:0;transition:opacity 0.35s ease,transform 0.35s ease;pointer-events:none;white-space:nowrap;';
        document.body.appendChild(toast);
        requestAnimationFrame(function(){ requestAnimationFrame(function(){
          toast.style.opacity = '1';
          toast.style.transform = 'translateX(-50%) translateY(0)';
        }); });
        setTimeout(function() {
          toast.style.opacity = '0';
          toast.style.transform = 'translateX(-50%) translateY(-20px)';
          setTimeout(function() { toast.remove(); }, 400);
        }, 4000);
      })
      .catch(function() { if (btn) btn.disabled = false; });
  };

  // Clear thank-you message when user starts re-editing the form
  (function() {
    function clearThankYou() {
      var ty = document.getElementById('cf-thankyou-msg');
      if (!ty) return;
      ty.remove();
      var form2 = document.getElementById('contact-form');
      if (form2) form2.style.display = '';
      var btn = document.getElementById('cf-submit-btn');
      if (btn) btn.disabled = false;
    }
    var watchIds = ['cf-company','cf-name','cf-email','cf-country','cf-phone','cf-product','contact-message'];
    document.addEventListener('DOMContentLoaded', function() {
      watchIds.forEach(function(id) {
        var el = document.getElementById(id);
        if (el) el.addEventListener('input', clearThankYou);
      });
    });
  })();

  /* =============================================
     SALES KIT MODAL
     ============================================= */
  window.showSalesKitModal = function(appKey) {
    var t = window._currentTranslations || {};
    document.getElementById('modal-application-name').textContent = t[appKey] || appKey;
    document.getElementById('saleskit-modal-overlay').style.display = 'block';
    document.getElementById('saleskit-modal-dialog').style.display = 'block';
    document.getElementById('saleskit-form').reset();
    ['saleskit-name','saleskit-email','saleskit-company'].forEach(function(id) {
      var el = document.getElementById(id); if (el) el.style.borderColor = '';
      var err = document.getElementById(id+'-err'); if (err) { err.textContent = ''; err.style.display = 'none'; }
    });
    window.currentApplication = appKey;
  };
  window.closeSalesKitModal = function(event) {
    if (event) { event.preventDefault(); event.stopPropagation(); }
    document.getElementById('saleskit-modal-overlay').style.display = 'none';
    document.getElementById('saleskit-modal-dialog').style.display = 'none';
  };
  document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { window.closeSalesKitModal(e); closeYoutubeModal(); } });

  /* =============================================
     SALES KIT FORM SUBMIT
     ============================================= */
  document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('saleskit-form');
    if (!form) return;
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      var lang = document.documentElement.getAttribute('lang') || 'en';
      var t = window._translations && window._translations[lang] ? window._translations[lang] : {};
      var msgRequired = lang === 'zh-TW' ? '此欄位為必填' : lang === 'zh-CN' ? '此栏位为必填项' : lang === 'ja' ? 'この項目は必須です' : 'This field is required';
      var msgEmail = lang === 'zh-TW' ? '請輸入有效的電子郵件' : lang === 'zh-CN' ? '请输入有效的电子邮件' : lang === 'ja' ? '有効なメールアドレスを入力してください' : 'Please enter a valid email address';
      var msgPrivacy = t['saleskit.privacyRequired'] || 'Please agree to the Privacy Policy.';
      var name = document.getElementById('saleskit-name').value.trim();
      var email = document.getElementById('saleskit-email').value.trim();
      var company = document.getElementById('saleskit-company').value.trim();
      var fields = [
        { id:'saleskit-name',    errId:'saleskit-name-err',    val:name,    isEmail:false },
        { id:'saleskit-email',   errId:'saleskit-email-err',   val:email,   isEmail:true  },
        { id:'saleskit-company', errId:'saleskit-company-err', val:company, isEmail:false }
      ];
      var valid = true;
      fields.forEach(function(f) {
        var el = document.getElementById(f.id), err = document.getElementById(f.errId);
        el.style.borderColor = ''; if (err) { err.textContent = ''; err.style.display = 'none'; }
      });
      var privacyErr = document.getElementById('saleskit-privacy-err');
      if (privacyErr) { privacyErr.textContent = ''; privacyErr.style.display = 'none'; }
      fields.forEach(function(f) {
        var el = document.getElementById(f.id), err = document.getElementById(f.errId);
        if (!f.val) { el.style.borderColor = '#ff4444'; if (err) { err.textContent = msgRequired; err.style.display = 'block'; } if (valid) el.focus(); valid = false; }
        else if (f.isEmail && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(f.val)) { el.style.borderColor = '#ff4444'; if (err) { err.textContent = msgEmail; err.style.display = 'block'; } if (valid) el.focus(); valid = false; }
      });
      var privacyChecked = document.getElementById('saleskit-privacy') && document.getElementById('saleskit-privacy').checked;
      if (!privacyChecked) { if (privacyErr) { privacyErr.textContent = msgPrivacy; privacyErr.style.display = 'block'; } valid = false; }
      if (!valid) return;
      var btn = document.getElementById('download-btn');
      btn.disabled = true;
      fetch('{{ route("landingSkitRequest") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': window._csrfToken },
        body: JSON.stringify({
          name: name,
          email: email,
          company: company,
          phone: document.getElementById('saleskit-phone') ? document.getElementById('saleskit-phone').value.trim() : '',
          application: window.currentApplication || '',
          locale: window._locale || 'en'
        })
      })
      .then(function(r) { return r.json(); })
      .then(function(data) {
        if (data.status === 'success') {
          var link = document.createElement('a');
          link.href = data.download_url;
          link.download = '';
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
          window.closeSalesKitModal();
        } else {
          alert(data.message || 'Error, please try again.');
        }
      })
      .catch(function() { alert('Network error, please try again.'); })
      .finally(function() { btn.disabled = false; });
    });
  });

  /* =============================================
     YOUTUBE MODAL
     ============================================= */
  window.openYoutubeModal = function(e) {
    if (e) { e.preventDefault(); e.stopPropagation(); }
    var _ytId = (['tw','cn'].indexOf(window._locale) !== -1) ? 'bBNC4lOdEUo' : 'RTiVd5EOXXI';
    document.getElementById('yt-iframe').src = 'https://www.youtube.com/embed/' + _ytId + '?autoplay=1&mute=1&rel=0&modestbranding=1';
    document.getElementById('yt-modal').classList.add('is-open');
    document.body.style.overflow = 'hidden';
  };
  window.closeYoutubeModal = function() {
    document.getElementById('yt-modal').classList.remove('is-open');
    setTimeout(function() { document.getElementById('yt-iframe').src = 'about:blank'; }, 300);
    document.body.style.overflow = '';
  };
  document.getElementById('yt-modal').addEventListener('click', function(e) { if (e.target === this) closeYoutubeModal(); });

  /* =============================================
     PROMO MODAL
     ============================================= */
  window.closePromoModal = function() {
    document.getElementById('promo-overlay').classList.remove('is-open');
  };
  (function() {
    var shown = false;
    var contact = document.getElementById('contact');
    if (!contact) return;
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting && !shown) {
          shown = true;
          setTimeout(function() {
            document.getElementById('promo-overlay').classList.add('is-open');
          }, 600);
          observer.disconnect();
        }
      });
    }, { threshold: 0.2 });
    observer.observe(contact);
  })();

  /* =============================================
     HERO TITLE SIZE
     ============================================= */
  function setHeroTitleSize() {
    var h1 = document.querySelector('h1.hero-title');
    if (h1) h1.style.setProperty('font-size', 'clamp(1.8rem,4.8vw,6rem)', 'important');
  }
  setHeroTitleSize();
  window.addEventListener('resize', setHeroTitleSize);

  /* =============================================
     LANG SWITCHER
     ============================================= */
  window.toggleLangDropdown = function(e) {
    e.stopPropagation(); e.preventDefault();
    var switcher = document.getElementById('langSwitcher');
    if (!switcher) return;
    if (switcher.classList.contains('open')) { switcher.classList.remove('open'); return; }
    switcher.classList.add('open');
    setTimeout(function() {
      function outside(ev) { if (!switcher.contains(ev.target)) { switcher.classList.remove('open'); document.removeEventListener('click', outside, true); } }
      document.addEventListener('click', outside, true);
    }, 10);
  };
  window.switchLang = function(lang, el) {
    var url = el && el.getAttribute('data-lang-url');
    if (url) { history.pushState(null, '', url); }
    window._locale = {'en':'en','zh-TW':'tw','zh-CN':'cn','ja':'jp'}[lang] || 'en';
    var _ytId = (['tw','cn'].indexOf(window._locale) !== -1) ? 'bBNC4lOdEUo' : 'RTiVd5EOXXI';
    var overviewIframe = document.getElementById('overview-yt-iframe');
    if (overviewIframe) overviewIframe.src = 'https://www.youtube.com/embed/' + _ytId + '?autoplay=0&mute=1&rel=0&modestbranding=1&enablejsapi=1';
    var _urlBase = window._locale === 'cn' ? 'https://deltapsu.cn/cn' : 'https://psu.deltaww.com/' + window._locale;
    document.querySelectorAll('[data-url-template]').forEach(function(el) {
      el.href = el.getAttribute('data-url-template').replace('https://psu.deltaww.com/{locale}', _urlBase);
    });
    document.documentElement.setAttribute('lang', lang);
    var names = { 'en':'EN','zh-TW':'繁中','zh-CN':'简中','ja':'日本語' };
    var nameEl = document.getElementById('langCurrentName');
    if (nameEl) nameEl.textContent = names[lang] || 'EN';
    document.querySelectorAll('.lang-option').forEach(function(opt) { opt.classList.toggle('active', opt.getAttribute('data-lang') === lang); });
    document.getElementById('langSwitcher').classList.remove('open');
    var globeLink = document.getElementById('footer-globe-link');
    if (globeLink) globeLink.href = lang === 'zh-CN' ? 'https://psu.deltaww.com/cn' : lang === 'zh-TW' ? 'https://psu.deltaww.com/tw' : lang === 'ja' ? 'https://psu.deltaww.com/jp' : 'https://psu.deltaww.com/en';
    if (typeof window.setLang === 'function') window.setLang(lang);
  };

  /* =============================================
     TRANSLATIONS
     ============================================= */
  var translations = {
    'en': {
      label:'EN',
      'nav.home':'Home','nav.live':'LIVE','nav.certification':'Certification','nav.compare':'Compare','nav.solutions':'Solutions','nav.contact':'Get Info','nav.dinpro':'DIN Pro','nav.dineco':'DIN Eco',
      'overview.event.line1':'Delta Standard Power Supply','overview.event.line2':'New Product Launch Event 2026','overview.title1':'POWERING','overview.title2':'EXCELLENCE','overview.desc':'New-generation power solutions engineered for mission-critical stability','overview.videoExpiry':'2026.05.20 (Wed.) | 03:30 PM (UTC +8)',
      'hero.title':'DELTA STANDARD POWER SUPPLY','hero.subtitle':'INFINITY READY','hero.notified':'GET NOTIFIED','hero.register':'Register Now','hero.onlineEventAt':'Online Launch Event at','hero.dinRailLabel':'DIN Rail Power Supplies','hero.upcomingLabel':"Delta's Upcoming New Products at a Glance",
      'dinpro.title':'DIN Pro 1-Phase Series','dinpro.desc':'The Source of Stability, Powering the Future','dinpro.learnMore':'LEARN MORE',
      'dineco.title':'DIN Eco 3-Phase Series','dineco.desc':'Performance at the Core, Built to Last','dineco.learnMore':'LEARN MORE',
      'pro.peakLabel':'Maximum achievable','pro.peakTitle':'Peak Power','pro.peakDesc':'Starting capability',
      'pro.universalInput':'EMS Immunity','pro.universalInputDesc':'Certified IEC 61000-4-6, 20Vrms',
      'pro.semiF47Value':'85~305V','pro.semiF47':'Wide AC Input','pro.semiF47Desc':'(305V for 60s)',
      'pro.currentSharing':'Current Sharing','pro.currentSharingDesc':'Parallel operation support (960W)',
      'pro.pcbaCoating':'PCBA Coating','pro.pcbaCoatingDesc':'Industrial-grade protection',
      'pro.extremeTemp':'Extreme Temperature','common.opRange':'Operating range',
      'eco.phase':'3 Phase','eco.inputRange':'Input range','eco.wideInput':'Wide Input','eco.acSupport':'340~600V AC support','eco.acSupportNote':'(3EN series supports up to 575V)',
      'eco.effLabel':'Up to','eco.effValue':'95%','eco.effTitle':'High Efficiency',
      'eco.slim':'Slim &amp; Compact','eco.slimDesc':'Space-saving for distribution panel',
      'eco.wideTemp':'Wide Temperature',
      'eco.certified':'Global Certified','eco.certifiedDesc':'IEC/EN/UL 62368-1/61010-1',
      'eco.surge':'Surge Protection','eco.surgeDesc':'4KV / 2KV surge immunity',
      'cert.title':'National Electrical Safety','cert.desc':'Global compliance with the highest safety certifications','cert.learnMore':'LEARN MORE CERTIFICATIONS',
      'cert.usListed':'UL Listed','cert.ulRecognized':'UL Recognized','cert.tuv':'TUV Certified','cert.ce':'European Conformity','cert.ccc':'China Compulsory','cert.taiwan':'Taiwan Standard','cert.ukca':'UK Certification','cert.eac':'Eurasian Conformity','cert.bis':'Indian Standard','cert.kc':'Korea Certification',
      'cert.modalTitle':'Additional Certifications','cert.iecTitle':'IEC Electrical Safety','cert.iecSubtitle':'International Standards',
      'cert.cbScheme':'CB Scheme report','cert.cbScheme2':'CB Scheme report (AS/NZS 62368-1)','cert.listed':'LISTED',
      'cert.emcTitle':'EMC Certifications','cert.emcSubtitle':'Electromagnetic Compatibility','cert.emissions':'Emissions','cert.immunity':'Immunity',
      'compare.dinProCol':'DIN Pro<br />1-Phase Series','compare.forceGtCol':'Force-GT<br />1-Phase Series','compare.title':'Series Comparison','compare.desc':'Find the Perfect Match for Your Needs',
      'compare.feature':'Feature','compare.targetApp':'Target Application','compare.keyMission':'Key Mission','compare.missionCritical':'Mission Critical',
      'compare.motorDrive':'Motor Drive','compare.peakPowerApp':'Peak Power Applications','compare.constantCurrentCircuit':'Constant Current Circuit','compare.constantCurrentApp':'Constant Current Applications',
      'compare.phase':'Phase','compare.singlePhase':'1-Phase',
      'compare.acInput':'AC Input','compare.proAcInputValue':'90~277V','compare.dinProAcNote':'( 305V for 60s )',
      'compare.powerBoost':'Power Boost','compare.powerBoostValue':'150% for 5s','compare.msNote':'( 500% for 5ms / 200% for 50ms )',
      'compare.operatingTemp':'Operating Temp','compare.proTemp':'-40°C to +80°C','compare.forceGtTemp':'-40°C to +70°C',
      'compare.remoteControl':'Remote Control','compare.yes':'Yes',
      'compare.warranty':'Warranty','compare.years5':'5 Years','compare.years3':'3 Years',
      'compare.wattage':'Wattage','compare.na':'N/A','compare.learnMore':'LEARN MORE',
      'solutions.title':'Featured Solutions','solutions.desc':'Standard power modules ready for volume shipment','solutions.all':'All products',
      'sol.cobotArm':'Cobot','sol.semiconductor':'Semiconductor','sol.dataCenter':'Data Center','sol.evCharger':'EV Charger','sol.greenEnergy':'Green Energy','sol.processAuto':'Process Automation',
      'contact.titleStart':'REQUEST YOUR','contact.titleMid':'FREE SAMPLE','contact.titleEnd':'NOW!','contact.desc':'Simply send us your inquiry, and our sales team will get in touch with you promptly.<br><span class="disclaimer-note">* Limited quantities available.<br>* Delta reserves the right to modify or interpret this offer.</span>',
      'contact.globalOffices':'Contact Us',
      'contact.formTitle':'Request Consultation','contact.company':'COMPANY','contact.name':'NAME','contact.email':'EMAIL','contact.country':'COUNTRY','contact.countryPlaceholder':'Select Country','contact.phone':'PHONE','contact.product':'PRODUCT','contact.productPlaceholder':'-- Select --','contact.projectStatusLabel':'Do you have an active or upcoming project that requires a power supply solution?','contact.projectStatusPlaceholder':'-- Select --','contact.projectStatusOpt1':'Yes, currently in development','contact.projectStatusOpt2':'Yes, planning within the next 6 months','contact.projectStatusOpt3':'Researching for future projects','contact.projectStatusOpt4':'No specific project at the moment','contact.message':'MESSAGE','contact.send':'Send Request','contact.privacyAgree':'I have read and agree to the <a href="https://psu.deltaww.com/en/etc/privacy-policy" target="_blank" style="color:#05a3f7;">Privacy Policy</a>.','contact.privacyRequired':'Please agree to the Privacy Policy.','contact.disclaimer':'',
      'notify.title':'Stay Updated','notify.desc':'Be the first to know about our latest power solutions and product launches',
      'notify.emailPlaceholder':'Your Email Address','notify.namePlaceholder':'Your Name','notify.countryPlaceholder':'Select Country','notify.agree':'I agree to receive updates and marketing communications','notify.privacyAgree':'I have read and agree to the <a href="https://psu.deltaww.com/en/etc/privacy-policy" target="_blank" style="color:#05a3f7;">Privacy Policy</a>.','notify.subscribe':'SUBSCRIBE NOW',
      'notify.productUpdates':'Product Updates','notify.eventInvites':'Event Invites','notify.exclusiveOffers':'Exclusive Offers',
      'saleskit.title':'Request Sales Kit','saleskit.name':'Name *','saleskit.namePlaceholder':'Your name','saleskit.email':'Email *','saleskit.company':'Company *','saleskit.companyPlaceholder':'Your company name','saleskit.phone':'Phone','saleskit.phonePlaceholder':'Optional','saleskit.download':'DOWNLOAD SALES KIT','saleskit.privacyAgree':'I have read and agree to the <a href="https://psu.deltaww.com/en/etc/privacy-policy" target="_blank" style="color:#05a3f7;">Privacy Policy</a>.','saleskit.privacyRequired':'Please agree to the Privacy Policy.',
      'offices.title':'Global Operations &amp; Service Locations','offices.asia':'Asia','offices.northAmerica':'North America','offices.centralSouthAmerica':'Central &amp; South America','offices.europe':'Europe',
      'wechat.scan':'Scan to add WeChat','wechat.instruction':'Open WeChat → Scan QR Code',
      'features.title':'Engineering Excellence','features.desc':'High performance architecture for the Industry 4.0 era',
      'features.safety':'Global<br>Safety','features.safetyDesc':'Certified to IEC/EN/UL 62368-1 for worldwide deployment and safety compliance',
      'features.input':'Global<br>Service &amp; Stock','features.inputDesc':'Extensive global inventory and logistics network ensuring fast delivery and local availability',
      'features.mtbf':'Global<br>Technical Support','features.mtbfDesc':'Dedicated engineering teams providing comprehensive after-sales service worldwide',
      'features.peak':'Industrial<br>Reliability','features.peakDesc':'Robust design with premium components for long-term stable operation in harsh environments'
    },
    'zh-TW': {
      label:'繁中',
      'nav.home':'首頁','nav.live':'直播','nav.certification':'認證','nav.compare':'比較','nav.solutions':'應用方案','nav.contact':'取得資訊','nav.dinpro':'DIN Pro','nav.dineco':'DIN Eco',
      'overview.event.line1':'台達標準電源','overview.event.line2':'2026 新品上市發表會','overview.title1':'世界級電源','overview.title2':'','overview.desc':'新世代電源解決方案，專為關鍵任務穩定性而設計','overview.videoExpiry':'2026.05.20 (星期三) | 上午 09:30 (UTC +8)',
      'hero.title':'台達標準電源','hero.subtitle':'INFINITY READY','hero.notified':'訂閱通知','hero.register':'立刻報名','hero.onlineEventAt':'線上發表會時間：','hero.dinRailLabel':'導軌型工業電源供應器','hero.upcomingLabel':'即將上市新產品',
      'dinpro.title':'DIN Pro 單相電源系列','dinpro.desc':'穩定之源，智造未來','dinpro.learnMore':'了解更多',
      'dineco.title':'DIN Eco 三相電源系列','dineco.desc':'效能之本，穩築基石','dineco.learnMore':'了解更多',
      'pro.peakLabel':'最高可達','pro.peakTitle':'峰值功率','pro.peakDesc':'啟動能力',
      'pro.universalInput':'EMS 抗干擾能力','pro.universalInputDesc':'通過 IEC 61000-4-6 認證，20Vrms',
      'pro.semiF47Value':'85~305V','pro.semiF47':'寬AC電壓輸入','pro.semiF47Desc':'(305V 持續 60 秒)',
      'pro.currentSharing':'電流分配','pro.currentSharingDesc':'支援並聯擴容(960W)',
      'pro.pcbaCoating':'PCBA 防護塗層','pro.pcbaCoatingDesc':'工業級防護處理',
      'pro.extremeTemp':'極端溫度','common.opRange':'工作範圍',
      'eco.phase':'3 Phase','eco.inputRange':'輸入範圍','eco.wideInput':'寬電壓輸入','eco.acSupport':'340~600V AC 支援','eco.acSupportNote':'(3EN 系列最高支援 575V)',
      'eco.effLabel':'最高可达','eco.effValue':'95%','eco.effTitle':'高效率',
      'eco.slim':'輕薄緊湊','eco.slimDesc':'節省配電盤空間',
      'eco.wideTemp':'寬溫範圍',
      'eco.certified':'全球認證','eco.certifiedDesc':'符合 IEC/EN/UL 62368-1/61010-1',
      'eco.surge':'突波防護','eco.surgeDesc':'4KV / 2KV 突波免疫',
      'cert.title':'國家電氣安全','cert.desc':'符合全球最高安全認證標準','cert.learnMore':'查看更多認證',
      'cert.usListed':'UL 列名','cert.ulRecognized':'UL 認可','cert.tuv':'TÜV 認證','cert.ce':'歐盟一致性','cert.ccc':'中國強制認證','cert.taiwan':'台灣標準','cert.ukca':'英國認證','cert.eac':'歐亞一致性','cert.bis':'印度標準','cert.kc':'韓國認證',
      'cert.modalTitle':'其他認證','cert.iecTitle':'IEC 電氣安全','cert.iecSubtitle':'國際標準',
      'cert.cbScheme':'CB 認證報告','cert.cbScheme2':'CB 認證報告 (AS/NZS 62368-1)','cert.listed':'上架認證',
      'cert.emcTitle':'EMC 認證','cert.emcSubtitle':'電磁相容性','cert.emissions':'輻射干擾','cert.immunity':'抗擾度',
      'compare.dinProCol':'DIN Pro<br />單相電源系列','compare.forceGtCol':'Force-GT<br />單相電源系列','compare.title':'系列比較','compare.desc':'選擇最適合您應用的電源供應器',
      'compare.feature':'功能','compare.targetApp':'目標應用','compare.keyMission':'關鍵任務定位','compare.missionCritical':'關鍵任務',
      'compare.motorDrive':'馬達驅動','compare.peakPowerApp':'峰值功率應用','compare.constantCurrentCircuit':'定電流電路','compare.constantCurrentApp':'定電流應用',
      'compare.phase':'相位','compare.singlePhase':'單相',
      'compare.acInput':'交流輸入','compare.proAcInputValue':'90~277V','compare.dinProAcNote':'( 305V，持續 60 秒 )',
      'compare.powerBoost':'峰值功率','compare.powerBoostValue':'150%，持續 5 秒','compare.msNote':'（5ms 500% / 50ms 200%）',
      'compare.operatingTemp':'工作溫度','compare.proTemp':'-40°C 至 +80°C','compare.forceGtTemp':'-40°C 至 +70°C',
      'compare.remoteControl':'遠端控制','compare.yes':'是',
      'compare.warranty':'保固','compare.years5':'5 年','compare.years3':'3 年',
      'compare.wattage':'瓦數','compare.na':'N/A','compare.learnMore':'了解更多',
      'solutions.title':'精選方案','solutions.desc':'標準電源模組，準備量產出貨','solutions.all':'全部產品',
      'sol.cobotArm':'協作機器人','sol.semiconductor':'半導體','sol.dataCenter':'資料中心','sol.evCharger':'EV 充電站','sol.greenEnergy':'綠色能源','sol.processAuto':'流程自動化',
      'contact.titleStart':'立即申請','contact.titleMid':'免費樣品！','contact.titleEnd':'','contact.desc':'歡迎填寫表單送出詢問，我們的業務團隊將盡快與您聯繫。<br><span class="disclaimer-note">* 數量有限，把握機會。<br>* 台達保留對本活動之最終解釋及修改權利。</span>',
      'contact.globalOffices':'聯繫我們',
      'contact.formTitle':'申請諮詢','contact.company':'公司名稱','contact.name':'姓名','contact.email':'電子郵件','contact.country':'國家／地區','contact.countryPlaceholder':'選擇國家／地區','contact.phone':'電話','contact.product':'產品','contact.productPlaceholder':'-- 請選擇 --','contact.projectStatusLabel':'您目前是否有正在進行或即將啟動、且需要電源供應解決方案的專案？','contact.projectStatusPlaceholder':'-- 請選擇 --','contact.projectStatusOpt1':'是，目前正在開發中','contact.projectStatusOpt2':'是，計畫在未來 6 個月內啟動','contact.projectStatusOpt3':'正在為未來的專案進行研究','contact.projectStatusOpt4':'目前沒有具體的專案','contact.message':'訊息內容','contact.send':'送出申請','contact.privacyAgree':'我已閱讀並同意<a href="https://psu.deltaww.com/tw/etc/privacy-policy" target="_blank" style="color:#05a3f7;">隱私權政策</a>。','contact.privacyRequired':'請勾選同意隱私權政策。','contact.disclaimer':'',
      'notify.title':'訂閱更新','notify.desc':'搶先獲得最新電源解決方案與產品發布資訊',
      'notify.emailPlaceholder':'您的電子郵件','notify.namePlaceholder':'您的姓名','notify.countryPlaceholder':'選擇國家','notify.agree':'我同意接收最新資訊及行銷通訊','notify.privacyAgree':'已瞭解與同意我們的<a href="https://psu.deltaww.com/tw/etc/privacy-policy" target="_blank" style="color:#05a3f7;">隱私權政策</a>','notify.subscribe':'立即訂閱',
      'notify.productUpdates':'產品更新','notify.eventInvites':'活動邀請','notify.exclusiveOffers':'專屬優惠',
      'saleskit.title':'索取銷售資料','saleskit.name':'姓名 *','saleskit.namePlaceholder':'您的姓名','saleskit.email':'電子郵件 *','saleskit.company':'公司名稱 *','saleskit.companyPlaceholder':'您的公司名稱','saleskit.phone':'電話','saleskit.phonePlaceholder':'選填','saleskit.download':'下載銷售資料','saleskit.privacyAgree':'我已閱讀並同意<a href="https://psu.deltaww.com/tw/etc/privacy-policy" target="_blank" style="color:#05a3f7;">隱私權政策</a>。','saleskit.privacyRequired':'請同意隱私權政策。',
      'offices.title':'全球運營與服務據點','offices.asia':'亞洲','offices.northAmerica':'北美','offices.centralSouthAmerica':'中南美','offices.europe':'歐洲',
      'wechat.scan':'掃描加入微信','wechat.instruction':'開啟微信 → 掃描 QR Code',
      'features.title':'卓越服務','features.desc':'為工業 4.0 時代打造的高效能架構',
      'features.safety':'全球<br>安全認證','features.safetyDesc':'通過 IEC/EN/UL 62368-1 認證，符合全球部署安全標準',
      'features.input':'全球服務<br>與庫存','features.inputDesc':'完善的全球庫存及物流網絡，確保快速交貨與在地供貨',
      'features.mtbf':'全球技術<br>支援','features.mtbfDesc':'專業工程師團隊提供全面的售後服務，覆蓋全球各地區',
      'features.peak':'工業級<br>可靠性','features.peakDesc':'堅固設計搭配優質元件，確保在惡劣環境下長期穩定運行'
    },
    'zh-CN': {
      label:'简中',
      'nav.home':'首页','nav.live':'直播','nav.certification':'认证','nav.compare':'对比','nav.solutions':'应用方案','nav.contact':'获取资讯','nav.dinpro':'DIN Pro','nav.dineco':'DIN Eco',
      'overview.event.line1':'台达标准电源','overview.event.line2':'2026 新品上市发布会','overview.title1':'世界级电源','overview.title2':'','overview.desc':'新一代电源解决方案，专为关键设备稳定性而设计','overview.videoExpiry':'2026.05.20 (星期三) | 上午 09:30 (UTC +8)',
      'hero.title':'台达标准电源','hero.subtitle':'INFINITY READY','hero.notified':'订阅通知','hero.register':'立即报名','hero.onlineEventAt':'线上发布会时间：','hero.dinRailLabel':'导轨型工业电源供应器','hero.upcomingLabel':'即将上市新产品',
      'dinpro.title':'DIN Pro 系列 单相导轨电源','dinpro.desc':'稳定之源，智造未来','dinpro.learnMore':'了解更多',
      'dineco.title':'DIN Eco 系列 三相导轨电源','dineco.desc':'效能之本，稳筑基石','dineco.learnMore':'了解更多',
      'pro.peakLabel':'最高可达','pro.peakTitle':'峰值功率','pro.peakDesc':'启动能力',
      'pro.universalInput':'EMS抗扰度','pro.universalInputDesc':'通过 IEC 61000-4-6 认证，20Vrms',
      'pro.semiF47Value':'85~305V','pro.semiF47':'宽AC电压输入','pro.semiF47Desc':'(305V 持续 60 秒)',
      'pro.currentSharing':'主动均流','pro.currentSharingDesc':'支持并联扩容(960W)',
      'pro.pcbaCoating':'PCBA 防护涂层','pro.pcbaCoatingDesc':'工业级防护',
      'pro.extremeTemp':'极端温度','common.opRange':'工作范围',
      'eco.phase':'三相','eco.inputRange':'输入范围','eco.wideInput':'宽电压输入','eco.acSupport':'340~600V AC 支持','eco.acSupportNote':'(3EN 系列最高支持 575V)',
      'eco.effLabel':'最高可达','eco.effValue':'95%','eco.effTitle':'高效率',
      'eco.slim':'轻薄紧凑','eco.slimDesc':'节省安装空间',
      'eco.wideTemp':'宽温范围',
      'eco.certified':'全球认证','eco.certifiedDesc':'符合 IEC/EN/UL 62368-1/61010-1',
      'eco.surge':'浪涌防护','eco.surgeDesc':'4KV / 2KV 浪涌抗扰度',
      'cert.title':'国家电气安全','cert.desc':'符合全球最高安全认证标准','cert.learnMore':'查看更多认证',
      'cert.usListed':'UL 列名','cert.ulRecognized':'UL 认可','cert.tuv':'TÜV 认证','cert.ce':'欧盟一致性','cert.ccc':'中国强制认证','cert.taiwan':'台湾标准','cert.ukca':'英国认证','cert.eac':'欧亚一致性','cert.bis':'印度标准','cert.kc':'韩国认证',
      'cert.modalTitle':'其他认证','cert.iecTitle':'IEC 电气安全','cert.iecSubtitle':'国际标准',
      'cert.cbScheme':'CB 认证报告','cert.cbScheme2':'CB 认证报告 (AS/NZS 62368-1)','cert.listed':'上架认证',
      'cert.emcTitle':'EMC 认证','cert.emcSubtitle':'电磁兼容性','cert.emissions':'辐射干扰','cert.immunity':'抗扰度',
      'compare.dinProCol':'DIN Pro<br />单相系列','compare.forceGtCol':'Force-GT<br />单相系列','compare.title':'系列对比','compare.desc':'选择最适合您应用的电源供应器',
      'compare.feature':'功能','compare.targetApp':'目标应用','compare.keyMission':'核心应用','compare.missionCritical':'关键任务',
      'compare.motorDrive':'电机驱动','compare.peakPowerApp':'峰值功率应用','compare.constantCurrentCircuit':'恒流电路','compare.constantCurrentApp':'定电流应用',
      'compare.phase':'相位','compare.singlePhase':'单相',
      'compare.acInput':'交流输入','compare.proAcInputValue':'90~277V','compare.dinProAcNote':'( 305V，持续 60 秒 )',
      'compare.powerBoost':'峰值功率','compare.powerBoostValue':'150%，持续 5 秒','compare.msNote':'（5ms 500% / 50ms 200%）',
      'compare.operatingTemp':'工作温度','compare.proTemp':'-40°C 至 +80°C','compare.forceGtTemp':'-40°C 至 +70°C',
      'compare.remoteControl':'远程控制','compare.yes':'是',
      'compare.warranty':'保固','compare.years5':'5 年','compare.years3':'3 年',
      'compare.wattage':'功率','compare.na':'N/A','compare.learnMore':'了解更多',
      'solutions.title':'精选方案','solutions.desc':'标准电源模块，准备量产出货','solutions.all':'全部产品',
      'sol.cobotArm':'协作机器人','sol.semiconductor':'半导体','sol.dataCenter':'数据中心','sol.evCharger':'EV 充电站','sol.greenEnergy':'绿色能源','sol.processAuto':'流程自动化',
      'contact.titleStart':'立即申请','contact.titleMid':'免费样品！','contact.titleEnd':'','contact.desc':'欢迎填写表单送出询问，我们的销售团队将尽快与您联系。<br><span class="disclaimer-note">* 数量有限，把握机会。<br>* 台达保留对本活动的最终解释及修改权利。</span>',
      'contact.globalOffices':'联系我们',
      'contact.formTitle':'申请咨询','contact.company':'公司名称','contact.name':'姓名','contact.email':'电子邮件','contact.country':'国家/地区','contact.countryPlaceholder':'选择国家/地区','contact.phone':'电话','contact.product':'产品','contact.productPlaceholder':'-- 请选择 --','contact.projectStatusLabel':'您目前是否有正在进行或即将启动、且需要电源解决方案的项目？','contact.projectStatusPlaceholder':'-- 请选择 --','contact.projectStatusOpt1':'是，目前正在开发中','contact.projectStatusOpt2':'是，计划在未来 6 个月内启动','contact.projectStatusOpt3':'正在为未来的项目进行研究','contact.projectStatusOpt4':'目前没有具体的项目','contact.message':'留言内容','contact.send':'提交申请','contact.privacyAgree':'我已阅读并同意<a href="https://www.deltapsu.cn/cn/etc/privacy-policy" target="_blank" style="color:#05a3f7;">隐私政策</a>。','contact.privacyRequired':'请勾选同意隐私政策。','contact.disclaimer':'',
      'notify.title':'订阅更新','notify.desc':'抢先获得最新电源解决方案与产品发布资讯',
      'notify.emailPlaceholder':'您的电子邮件','notify.namePlaceholder':'您的姓名','notify.countryPlaceholder':'选择国家','notify.agree':'我同意接收最新资讯及营销资讯','notify.privacyAgree':'已了解并同意我们的<a href="https://www.deltapsu.cn/cn/etc/privacy-policy" target="_blank" style="color:#05a3f7;">隐私政策</a>','notify.subscribe':'立即订阅',
      'notify.productUpdates':'产品更新','notify.eventInvites':'活动邀请','notify.exclusiveOffers':'专属优惠',
      'saleskit.title':'索取销售资料','saleskit.name':'姓名 *','saleskit.namePlaceholder':'您的姓名','saleskit.email':'电子邮件 *','saleskit.company':'公司名称 *','saleskit.companyPlaceholder':'您的公司名称','saleskit.phone':'电话','saleskit.phonePlaceholder':'选填','saleskit.download':'资料下载','saleskit.privacyAgree':'我已阅读并同意<a href="https://www.deltapsu.cn/cn/etc/privacy-policy" target="_blank" style="color:#05a3f7;">隐私政策</a>。','saleskit.privacyRequired':'请同意隐私政策。',
      'offices.title':'全球运营与服务据点','offices.asia':'亚洲','offices.northAmerica':'北美','offices.centralSouthAmerica':'中南美','offices.europe':'欧洲',
      'wechat.scan':'扫描加入微信','wechat.instruction':'打开微信 → 扫描二维码',
      'features.title':'卓越服务','features.desc':'为工业 4.0 时代打造的高性能架构',
      'features.safety':'全球<br>安全认证','features.safetyDesc':'通过 IEC/EN/UL 62368-1 认证，符合全球部署安全标准',
      'features.input':'全球服务<br>与库存','features.inputDesc':'完善的全球库存及物流网络，确保快速交货与本地供货',
      'features.mtbf':'全球技术<br>支持','features.mtbfDesc':'专业工程师团队提供全面的售后服务，覆盖全球各地区',
      'features.peak':'工业级<br>可靠性','features.peakDesc':'坚固设计搭配优质元件，确保在恶劣环境下长期稳定运行'
    },
    'ja': {
      label:'日本語',
      'nav.home':'ホーム','nav.live':'ライブ','nav.certification':'認証','nav.compare':'比較','nav.solutions':'ソリューション','nav.contact':'資料請求','nav.dinpro':'DIN Pro','nav.dineco':'DIN Eco',
      'overview.event.line1':'デルタ標準電源','overview.event.line2':'2026年 新製品発表イベント','overview.title1':'卓越したパワーを追求する','overview.title2':'','overview.desc':'新世代の電源ソリューション、ミッションクリティカルな安定性のために設計','overview.videoExpiry':'2026.05.20 (水) | 03:30 PM (UTC +8)',
      'hero.title':'デルタ標準電源','hero.subtitle':'INFINITY READY','hero.notified':'通知を受け取る','hero.register':'今すぐ登録','hero.onlineEventAt':'オンライン発表会：','hero.dinRailLabel':'DINレール電源','hero.upcomingLabel':'デルタ最新製品ラインナップ一覧',
      'dinpro.title':'DIN Pro 1-Phase Series','dinpro.desc':'安定の源、未来を紡ぐ','dinpro.learnMore':'詳細を見る',
      'dineco.title':'DIN Eco 3-Phase Series','dineco.desc':'性能の礎、確かな基盤','dineco.learnMore':'詳細を見る',
      'pro.peakLabel':'最大達成値','pro.peakTitle':'ピークパワー','pro.peakDesc':'起動能力',
      'pro.universalInput':'EMS耐性','pro.universalInputDesc':'IEC 61000-4-6 認証取得、20Vrms',
      'pro.semiF47Value':'85~305V','pro.semiF47':'ワイドAC電圧入力','pro.semiF47Desc':'(305V、60秒間)',
      'pro.currentSharing':'電流共有機能','pro.currentSharingDesc':'並列運転対応(960W)',
      'pro.pcbaCoating':'PCBA コーティング','pro.pcbaCoatingDesc':'工業グレードの保護処理',
      'pro.extremeTemp':'広範囲な動作環境温度','common.opRange':'動作範囲',
      'eco.phase':'3 Phase','eco.inputRange':'入力範囲','eco.wideInput':'ワイド入力','eco.acSupport':'340~600V AC 対応','eco.acSupportNote':'(3ENシリーズは最大575Vまで対応)',
      'eco.effLabel':'最大','eco.effValue':'95%','eco.effTitle':'高効率',
      'eco.slim':'スリム＆コンパクト','eco.slimDesc':'配電盤スペース節約',
      'eco.wideTemp':'動作環境温度',
      'eco.certified':'グローバル認証','eco.certifiedDesc':'IEC/EN/UL 62368-1/61010-1 準拠',
      'eco.surge':'サージ保護','eco.surgeDesc':'4KV / 2KV サージ耐性',
      'cert.title':'国際的な認証取得','cert.desc':'最高水準の安全認証に準拠','cert.learnMore':'認証をもっと見る',
      'cert.usListed':'UL Listed','cert.ulRecognized':'UL Recognized','cert.tuv':'TÜV 認証','cert.ce':'EU 適合性','cert.ccc':'中国強制認証','cert.taiwan':'台湾規格','cert.ukca':'英国認証','cert.eac':'ユーラシア適合性','cert.bis':'インド規格','cert.kc':'韓国認証',
      'cert.modalTitle':'追加認証','cert.iecTitle':'IEC 電気安全','cert.iecSubtitle':'国際規格',
      'cert.cbScheme':'CBスキームレポート','cert.cbScheme2':'CBスキームレポート (AS/NZS 62368-1)','cert.listed':'LISTED',
      'cert.emcTitle':'EMC 認証','cert.emcSubtitle':'電磁両立性','cert.emissions':'エミッション','cert.immunity':'イミュニティ',
      'compare.dinProCol':'DIN Pro<br />1-Phase Series','compare.forceGtCol':'Force-GT<br />1-Phase Series','compare.title':'シリーズ比較','compare.desc':'アプリケーションに最適な電源を選択',
      'compare.feature':'機能','compare.targetApp':'対象アプリケーション','compare.keyMission':'キーミッション','compare.missionCritical':'ミッションクリティカル',
      'compare.motorDrive':'モータードライブ','compare.peakPowerApp':'ピークパワーアプリケーション','compare.constantCurrentCircuit':'定電流回路','compare.constantCurrentApp':'定電流アプリケーション',
      'compare.phase':'相数','compare.singlePhase':'単相',
      'compare.acInput':'交流入力','compare.proAcInputValue':'90~277V','compare.dinProAcNote':'( 305V、60秒間 )',
      'compare.powerBoost':'ピークパワー','compare.powerBoostValue':'150%，5秒間','compare.msNote':'（5ms 500% / 50ms 200%）',
      'compare.operatingTemp':'動作温度','compare.proTemp':'-40°C ～ +80°C','compare.forceGtTemp':'-40°C ～ +70°C',
      'compare.remoteControl':'リモートコントロール','compare.yes':'あり',
      'compare.warranty':'保証','compare.years5':'5年','compare.years3':'3年',
      'compare.wattage':'ワット数','compare.na':'N/A','compare.learnMore':'詳細を見る',
      'solutions.title':'注目のソリューション','solutions.desc':'量産出荷準備が整った標準電源モジュール','solutions.all':'全製品',
      'sol.cobotArm':'協働ロボット','sol.semiconductor':'半導体','sol.dataCenter':'データセンター','sol.evCharger':'EV 充電器','sol.greenEnergy':'グリーンエネルギー','sol.processAuto':'プロセスオートメーション',
      'contact.titleStart':'今すぐ','contact.titleMid':'無料サンプルをゲット！','contact.titleEnd':'','contact.desc':'今すぐフォームを送信！営業担当より迅速にご連絡いたします。<br><span class="disclaimer-note">* 数量限定の無料サンプルを入手ください。<br>* デルタは本イベントの解釈および変更の全権利を留保します。</span>',
      'contact.globalOffices':'お問い合わせ',
      'contact.formTitle':'お問合せ','contact.company':'会社名','contact.name':'氏名','contact.email':'メールアドレス','contact.country':'国・地域','contact.countryPlaceholder':'国を選択','contact.phone':'電話番号','contact.product':'製品','contact.productPlaceholder':'-- 選択してください --','contact.projectStatusLabel':'現在、電源ソリューションを必要とする進行中または予定されているプロジェクトはありますか？','contact.projectStatusPlaceholder':'-- 選択してください --','contact.projectStatusOpt1':'はい（現在開発中）','contact.projectStatusOpt2':'はい（今後6ヶ月以内に計画中）','contact.projectStatusOpt3':'将来のプロジェクトに向けて調査中','contact.projectStatusOpt4':'現時点では具体的なプロジェクトはない','contact.message':'メッセージ','contact.send':'送信する','contact.privacyAgree':'<a href="https://psu.deltaww.com/jp/etc/privacy-policy" target="_blank" style="color:#05a3f7;">プライバシーポリシー</a>を読み、同意しました。','contact.privacyRequired':'プライバシーポリシーに同意してください。','contact.disclaimer':'',
      'notify.title':'最新情報を受け取る','notify.desc':'最新の電源ソリューションと製品発表をいち早くお届けします',
      'notify.emailPlaceholder':'メールアドレス','notify.namePlaceholder':'お名前','notify.countryPlaceholder':'国を選択','notify.agree':'アップデートやマーケティング情報の受け取りに同意します','notify.privacyAgree':'<a href="https://psu.deltaww.com/jp/etc/privacy-policy" target="_blank" style="color:#05a3f7;">プライバシーポリシー</a>を理解し、これに同意しました','notify.subscribe':'今すぐ登録',
      'notify.productUpdates':'製品情報','notify.eventInvites':'イベント案内','notify.exclusiveOffers':'限定オファー',
      'saleskit.title':'営業資料の請求','saleskit.name':'お名前 *','saleskit.namePlaceholder':'お名前を入力','saleskit.email':'メールアドレス *','saleskit.company':'会社名 *','saleskit.companyPlaceholder':'会社名を入力','saleskit.phone':'電話番号','saleskit.phonePlaceholder':'任意','saleskit.download':'営業資料をダウンロード','saleskit.privacyAgree':'<a href="https://psu.deltaww.com/jp/etc/privacy-policy" target="_blank" style="color:#05a3f7;">プライバシーポリシー</a>を読み、同意しました。','saleskit.privacyRequired':'プライバシーポリシーに同意してください。',
      'offices.title':'グローバル拠点','offices.asia':'アジア','offices.northAmerica':'北米','offices.centralSouthAmerica':'中南米','offices.europe':'ヨーロッパ',
      'wechat.scan':'WeChatをスキャンして追加','wechat.instruction':'WeChatを開く → QRコードをスキャン',
      'features.title':'卓越したサービス','features.desc':'産業 4.0 時代のための高性能アーキテクチャ',
      'features.safety':'グローバル<br>安全認証','features.safetyDesc':'IEC/EN/UL 62368-1 認証取得、グローバル展開と安全基準に準拠',
      'features.input':'グローバル<br>サービス＆在庫','features.inputDesc':'充実したグローバル在庫と物流ネットワークで迅速な納品とローカル対応を実現',
      'features.mtbf':'グローバル<br>技術サポート','features.mtbfDesc':'専門エンジニアによる包括的なアフターサービスを全世界で提供',
      'features.peak':'産業用<br>信頼性','features.peakDesc':'堅牢設計と高品質部品により、過酷な環境での長期安定稼働を実現'
    }
  };

  window.setLang = function(lang) {
    var t = translations[lang];
    if (!t) return;
    window._currentTranslations = t;
    var _langAttrMap = {'en':{'lang':'en','html_lang':'en'},'zh-TW':{'lang':'zh','html_lang':'tw'},'zh-CN':{'lang':'zh','html_lang':'cn'},'ja':{'lang':'ja','html_lang':'jp'}};
    var _la = _langAttrMap[lang] || {'lang':'en','html_lang':'en'};
    document.documentElement.setAttribute('lang', _la.lang);
    document.documentElement.setAttribute('html_lang', _la.html_lang);
    document.querySelectorAll('[data-i18n]').forEach(function(el) { var k = el.getAttribute('data-i18n'); if (t[k] !== undefined) el.innerHTML = t[k]; });
    document.querySelectorAll('[data-i18n-placeholder]').forEach(function(el) { var k = el.getAttribute('data-i18n-placeholder'); if (t[k] !== undefined) el.setAttribute('placeholder', t[k]); });
    document.querySelectorAll('[data-i18n-option]').forEach(function(el) { var k = el.getAttribute('data-i18n-option'); if (t[k] !== undefined) el.textContent = t[k]; });
    // Sync language switcher UI
    var names = { 'en':'EN','zh-TW':'繁中','zh-CN':'简中','ja':'日本語' };
    var nameEl = document.getElementById('langCurrentName');
    if (nameEl) nameEl.textContent = names[lang] || 'EN';
    document.querySelectorAll('.lang-option').forEach(function(opt) { opt.classList.toggle('active', opt.getAttribute('data-lang') === lang); });
    var globeLink = document.getElementById('footer-globe-link');
    if (globeLink) globeLink.href = lang === 'zh-CN' ? 'https://psu.deltaww.com/cn' : lang === 'zh-TW' ? 'https://psu.deltaww.com/tw' : lang === 'ja' ? 'https://psu.deltaww.com/jp' : 'https://psu.deltaww.com/en';
    var titles = {'en':'2026 Delta New Product Launch Event','zh-TW':'2026 台達標準電源新品發表會','zh-CN':'2026 台达标准电源新品发布会','ja':'2026 デルタ標準電源新製品発表イベント'};
    if (titles[lang]) document.title = titles[lang];
    try { localStorage.setItem('delta-lang', lang); } catch(e) {}
  };

  /* =============================================
     INIT
     ============================================= */
  function init() {
    initNextButtons();
    initRevealAnimations();
    initDinVideo();
  }

  document.addEventListener('DOMContentLoaded', function() {
    init();
    if (window._serverLang && translations[window._serverLang]) { window.setLang(window._serverLang); return; }
    var saved; try { saved = localStorage.getItem('delta-lang'); } catch(e) {}
    if (saved && translations[saved]) { window.setLang(saved); return; }
    var bl = (navigator.language || '').toLowerCase();
    var lang = bl.startsWith('zh-tw') || bl.startsWith('zh-hant') ? 'zh-TW' : bl.startsWith('zh') ? 'zh-CN' : bl.startsWith('ja') ? 'ja' : 'en';
    window.setLang(lang);
  });

  window.addEventListener('load', function() { forceAllVisible(); setTimeout(forceAllVisible, 500); });

})();
</script>


<script src="{{ asset('frontend-asset/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend-asset/js/bootstrap.min.js') }}"></script>
</body>
</html>