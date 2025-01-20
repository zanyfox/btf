<template>
  <div class="content-header">
  <h1>{{ title }}</h1>
</div>
<div class="content px-2">
<blockquote class="quote-info mt-0">
<h5 id="tip">Tip!</h5>
<p>The <a href="https://adminlte.io/themes/v3/starter.html">starter page</a> is a good place to start building your app if you’d like to start from scratch.</p>
</blockquote>
<p>The layout consists of four major parts:</p>
<ul>
<li>Wrapper <code class="language-plaintext highlighter-rouge">.wrapper</code>. A div that wraps the whole site.</li>
<li>Main Header <code class="language-plaintext highlighter-rouge">.main-header</code>. Contains the logo and navbar.</li>
<li>Main Sidebar <code class="language-plaintext highlighter-rouge">.main-sidebar</code>. Contains the sidebar user panel, search form and menu.</li>
<li>Content <code class="language-plaintext highlighter-rouge">.content-wrapper</code>. Contains the page header and content.</li>
</ul>
<h4 class="mt-4" id="layout-options">Layout Options</h4>
<blockquote class="quote-danger">
<h5 id="note">Note!</h5>
<p>You cannot use both layout-boxed and layout-navbar-fixed or layout-footer-fixed at the same time. Anything else can be mixed together.</p>
</blockquote>
<p>AdminLTE 3.2 provides a set of options to apply to your main layout. Each one of these classes can be added to the body tag to get the desired goal.</p>
<ul>
<li>Fixed Sidebar: use the class <code class="language-plaintext highlighter-rouge">.layout-fixed</code> to get a fixed sidebar.</li>
<li>Fixed Navbar: use the class <code class="language-plaintext highlighter-rouge">.layout-navbar-fixed</code> to get a fixed navbar.</li>
<li>Fixed Footer: use the class <code class="language-plaintext highlighter-rouge">.layout-footer-fixed</code> to get a fixed footer.</li>
<li>Collapsed Sidebar: use the class <code class="language-plaintext highlighter-rouge">.sidebar-collapse</code> to have a collapsed sidebar upon loading.</li>
<li>Boxed Layout: use the class <code class="language-plaintext highlighter-rouge">.layout-boxed</code> to get a boxed layout that stretches only to 1250px.</li>
<li>Top Navigation: use the class <code class="language-plaintext highlighter-rouge">.layout-top-nav</code> to remove the sidebar and have your links at the top navbar.</li>
</ul>
<h5 id="responsive-variations">Responsive Variations</h5>
<p>You can also use the following classes for responsive changes with placing</p>
<ul>
<li>Fixed Navbar:
<ul>
<li>use the class <code class="language-plaintext highlighter-rouge">.layout-*-navbar-fixed</code> to get a fixed navbar.</li>
<li>use the class <code class="language-plaintext highlighter-rouge">.layout-*-navbar-not-fixed</code> to get a not fixed navbar.</li>
</ul>
</li>
<li>Fixed Footer:
<ul>
<li>use the class <code class="language-plaintext highlighter-rouge">.layout-*-footer-fixed</code> to get a fixed footer.</li>
<li>use the class <code class="language-plaintext highlighter-rouge">.layout-*-footer-not-fixed</code> to get a not fixed footer.</li>
</ul>
</li>
</ul>
<blockquote class="quote-info">
<h5 id="tip-1">Tip!</h5>
<p>If you want to use anchors with a fixed navbar, you need to add <code class="language-plaintext highlighter-rouge">.anchor</code> to you hidden anchor, e.g. <code class="language-plaintext highlighter-rouge">&lt;a id="testAnchor" class="anchor"&gt;&lt;/a&gt;</code>.</p>
<p>To get a smooth scrolling to the anchor you need to add <code class="language-plaintext highlighter-rouge">.scroll-smooth</code> to your HTML tag like this <code class="language-plaintext highlighter-rouge">&lt;html class="scroll-smooth"&gt;</code> otherwise it jumps directly to your anchor, <code class="language-plaintext highlighter-rouge">.scroll-smooth</code> can cause issues with a Chrome extension called ScrollAnywhere.</p>
</blockquote>
<h4 id="preloader">Preloader</h4>
<p>Preloader to avoid <a href="https://github.com/ColorlibHQ/AdminLTE/discussions/3319">https://github.com/ColorlibHQ/AdminLTE/discussions/3319</a></p>
<div class="language-html highlighter-rouge"><div class="highlight"><pre class="highlight"><code><span class="nt">&lt;div</span> <span class="na">class=</span><span class="s">"wrapper"</span><span class="nt">&gt;</span>
<span class="c">&lt;!-- Preloader --&gt;</span>
<span class="nt">&lt;div</span> <span class="na">class=</span><span class="s">"preloader"</span><span class="nt">&gt;</span>
<span class="nt">&lt;img</span> <span class="na">src=</span><span class="s">"dist/img/AdminLTELogo.png"</span> <span class="na">alt=</span><span class="s">"AdminLTELogo"</span> <span class="na">height=</span><span class="s">"60"</span> <span class="na">width=</span><span class="s">"60"</span><span class="nt">&gt;</span>
<span class="nt">&lt;/div&gt;</span>
<span class="nt">&lt;/div&gt;</span>
</code></pre></div></div>
<ul>
<li>Preloader elements should be added inside <code class="language-plaintext highlighter-rouge">.wrapper</code> element.</li>
<li>You can replace image OR modify size OR include any preload items inside <code class="language-plaintext highlighter-rouge">.preloader</code> element.</li>
</ul>
<h4 id="dark-mode">Dark Mode</h4>
<p>AdminLTE 3.2 provides a dark mode option. You can add in body tag:</p>
<ul>
<li><code class="language-plaintext highlighter-rouge">.dark-mode</code></li>
</ul>
<h4 id="color-variations">Color Variations</h4>
<p>AdminLTE 3.2 provides a set of color variations to apply to your sidebar (light &amp; dark) &amp; navbar. You can combine any available color with these class prefixes:</p>
<ul>
<li><code class="language-plaintext highlighter-rouge">.navbar-*</code></li>
<li><code class="language-plaintext highlighter-rouge">.sidebar-dark-*</code></li>
<li><code class="language-plaintext highlighter-rouge">.sidebar-light-*</code></li>
<li><code class="language-plaintext highlighter-rouge">.accent-*</code></li>
</ul>
<blockquote class="quote-info">
<h6 id="new">New</h6>
<p>You can use override the link/accent color in AdminLTE, you can add <code class="language-plaintext highlighter-rouge">.accent-*</code> to <code class="language-plaintext highlighter-rouge">body</code>.</p>
</blockquote>
<blockquote class="quote-info">
<h6 id="info">Info</h6>
<p>You can combine <code class="language-plaintext highlighter-rouge">.navbar-*</code> with <code class="language-plaintext highlighter-rouge">.navbar-light</code> or <code class="language-plaintext highlighter-rouge">.navbar-dark</code>.</p>
</blockquote>
<blockquote class="quote-info">
<h6 id="recommended-for-dark-mode">Recommended for Dark Mode</h6>
<p>You must use only <code class="language-plaintext highlighter-rouge">.navbar-dark</code> without only combination.</p>
</blockquote>
<p>The following colors are available:</p>
<h5 id="theme-colors">Theme Colors</h5>
<div class="row">
<div class="col-sm-4 col-lg-3 p-3 bg-primary"> Primary (primary) / Blue (blue)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-secondary"> Secondary (secondary)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-success"> Success (success) / Green (green)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-info"> Info (info) / Cyan (cyan)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-warning"> Warning (warning) / Yellow (yellow)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-danger"> Danger (danger) / Red (red)</div>
</div>
<h5 class="mt-4" id="blackwhite-nuances">Black/White Nuances</h5>
<div class="row">
<div class="col-sm-4 col-lg-3 p-3 bg-black"> Black (black)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-gray-dark"> Gray Dark (gray-dark)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-gray"> Gray (gray)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-light"> Light (light)</div>
</div>
<h5 class="mt-4" id="colors">Colors</h5>
<div class="row">
<div class="col-sm-4 col-lg-3 p-3 bg-indigo"> Indigo (indigo)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-navy"> Navy (navy)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-purple"> Purple (purple)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-fuchsia"> Fuchsia (fuchsia)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-pink"> Pink (pink)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-maroon"> Maroon (maroon)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-orange"> Orange (orange)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-lime"> Lime (lime)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-teal"> Teal (teal)</div>
<div class="col-sm-4 col-lg-3 p-3 bg-olive"> Olive (olive)</div>
</div>
<blockquote class="quote-info">
<h5 id="tip-2">Tip!</h5>
<p>You can use these color variations even with <code class="language-plaintext highlighter-rouge">.text-*</code>, <code class="language-plaintext highlighter-rouge">.bg-*</code> &amp; much more.</p>
</blockquote>
<h5 id="custom-range--switch">Custom Range / Switch</h5>
<p>For custom colored custom-checkbox &amp; custom-radio you can add this classes:</p>
<ul>
<li><code class="language-plaintext highlighter-rouge">.custom-control-input-*</code></li>
</ul>
<p>You can also change the look to outlined checkbox &amp; radio with adding the <code class="language-plaintext highlighter-rouge">.custom-control-input-outline</code> on the custom control input.</p>
<p>For custom colored custom-range you can add this classes:</p>
<ul>
<li><code class="language-plaintext highlighter-rouge">.custom-range-*</code></li>
</ul>
<p>For custom colored custom-range you can add this classes:</p>
<ul>
<li><code class="language-plaintext highlighter-rouge">.custom-range-*</code></li>
</ul>
<p>For custom colored custom-switch you can add this classes:</p>
<ul>
<li><code class="language-plaintext highlighter-rouge">.custom-switch-off-*</code> (for custom switch off)</li>
<li><code class="language-plaintext highlighter-rouge">.custom-switch-on-*</code> (for custom switch on)</li>
</ul>
<h5 id="toasts">Toasts</h5>
<p>You can also use <code class="language-plaintext highlighter-rouge">bg-*</code> beside the <code class="language-plaintext highlighter-rouge">.toast</code> to get a nice colored toast.</p>
<h5 id="plugin-support">Plugin Support</h5>
<p>You can use the all the colors above with these plugins:</p>
<ul>
<li>Bootstrap Slider
<ul>
<li><code class="language-plaintext highlighter-rouge">.slider-*</code> (wrapped around the slider)</li>
</ul>
</li>
<li>iCheck-Bootstrap
            <ul>
            <li><code class="language-plaintext highlighter-rouge">.icheck-*</code></li>
          </ul>
        </li>
      </ul>
    </div>
</template>
<script setup>
  const title = 'Мои заказы'
</script>