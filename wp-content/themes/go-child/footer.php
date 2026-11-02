<?php
/** Shared BARZZA footer, navigation and frontend design system. @package Go */
?>
    </main>
    <?php Go\footer_variation(); ?>
    </div>

    <?php wp_footer(); ?>

    <style id="barzza-global-system-20261028">
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Manrope:wght@400;500;600&display=swap');
    :root{--brz-paper:#f4f1eb;--brz-brown:#3a2a22;--brz-ink:#4b4b4c;--brz-width:914.286px}
    body{background:var(--brz-paper);color:var(--brz-ink);font-family:'DM Sans',sans-serif;font-size:15px;line-height:1.5}
    #site-content p,#site-content li,#site-content a,#site-content button,#site-content input,#site-content textarea{font-family:'DM Sans',sans-serif}
    #site-content h1,#site-content h2,#site-content h3,#site-content .h3{font-family:'Manrope',sans-serif;font-weight:400;letter-spacing:-.045em;line-height:1.02}
    #site-header{position:fixed!important;top:0!important;left:0!important;right:0!important;z-index:10000!important;height:92px!important;min-height:92px!important;background:var(--brz-paper)!important;color:var(--brz-ink)!important;border:0!important;box-shadow:none!important}
    body.admin-bar #site-header{top:32px!important}
    #site-content{padding-top:92px}
    #site-header .header__inner{width:min(var(--brz-width),calc(100% - 48px))!important;max-width:var(--brz-width)!important;height:92px!important;min-height:92px!important;margin:0 auto!important;padding:0!important;display:flex!important;align-items:center!important}
    #site-header .header__title-nav{display:flex!important;width:100%!important;height:100%!important;align-items:center!important;justify-content:space-between!important;gap:24px!important}
    body #site-header .header__titles,body #site-header .custom-logo{display:flex!important;align-items:center!important;height:100%!important;margin:0!important}
    body #site-header .custom-logo,body.home #site-header .custom-logo{width:154px!important;flex:0 0 154px!important}
    body #site-header .custom-logo-link,body.home #site-header .custom-logo-link{display:flex!important;align-items:center!important;justify-content:flex-start!important;width:154px!important;height:52px!important;margin:0!important;transform:none!important;flex:0 0 154px!important}
    body #site-header .custom-logo-link img{display:none!important}
    body #site-header .custom-logo-link img.brz-wordmark,body.home #site-header .custom-logo-link img.brz-wordmark{display:block!important;width:154px!important;height:42px!important;object-fit:contain!important;object-position:left center!important;filter:none!important;mix-blend-mode:multiply!important}
    body #site-header.brz-light .custom-logo-link img.brz-wordmark{filter:none!important;mix-blend-mode:multiply!important}
    body #site-header .custom-logo-link:after{content:none!important;display:none!important}
    #site-header .header__extras{display:none!important}
    #site-header #header__navigation{display:flex!important;align-items:center!important;height:100%!important;padding:0!important;margin:0!important}
    #site-header #header__navigation .header__navigation-inner,#site-header #header__navigation .menu-barzza-menu-container,#site-header #header__navigation .primary-menu{height:100%!important}
    #site-header #header__navigation .primary-menu{display:flex!important;align-items:center!important;gap:22px!important;margin:0!important;padding:0!important;list-style:none!important}
    #site-header #header__navigation .menu-item{position:relative;display:flex!important;align-items:center!important;height:100%!important;margin:0!important;padding:0!important;list-style:none!important}
    #site-header #header__navigation a{display:flex!important;align-items:center!important;color:var(--brz-ink)!important;font-size:11px!important;font-weight:500!important;line-height:18px!important;text-decoration:none!important;white-space:nowrap!important}
    #site-header #header__navigation .brz-products>a:after{content:'⌄';margin-left:7px;font-size:10px}
    #site-header #header__navigation .sub-menu{position:absolute!important;top:70px!important;left:-18px!important;display:block!important;width:286px!important;height:auto!important;margin:0!important;padding:8px!important;background:var(--brz-paper)!important;color:var(--brz-ink)!important;box-shadow:0 22px 70px rgba(0,0,0,.24)!important;opacity:0!important;visibility:hidden!important;transform:translateY(-7px)!important;transition:.2s!important;list-style:none!important}
    #site-header #header__navigation .brz-products:hover>.sub-menu,#site-header #header__navigation .brz-products:focus-within>.sub-menu{opacity:1!important;visibility:visible!important;transform:none!important}
    #site-header #header__navigation .sub-menu .menu-item{display:block!important;height:auto!important;border-bottom:1px solid rgba(75,75,76,.2)!important}
    #site-header #header__navigation .sub-menu .menu-item{background:transparent!important}
    #site-header #header__navigation .sub-menu .menu-item>a,#site-header #header__navigation .sub-menu .menu-item>span{display:grid!important;grid-template-columns:28px 1fr auto!important;align-items:center!important;width:100%!important;box-sizing:border-box!important;min-height:48px!important;padding:12px 10px!important;background:transparent!important;color:var(--brz-ink)!important;font-size:12px!important}
    #site-header #header__navigation .sub-menu .menu-item>a>span,#site-header #header__navigation .sub-menu b{display:inline!important;position:static!important;min-height:0!important;padding:0!important;background:transparent!important;color:inherit!important;font-size:inherit!important;font-weight:inherit!important}
    #site-header #header__navigation .sub-menu .menu-item>a:hover{background:#fff!important}
    html body.home #site-header #header__navigation .sub-menu{width:286px!important;min-width:0!important;padding:8px!important;background:var(--brz-paper)!important;border:0!important;color:var(--brz-ink)!important}
    html body.home #site-header #header__navigation .sub-menu .menu-item{background:transparent!important;border:0!important;border-bottom:1px solid rgba(75,75,76,.2)!important}
    html body.home #site-header #header__navigation .sub-menu a,html body.home #site-header #header__navigation .sub-menu .menu-item>span{color:var(--brz-ink)!important;background:transparent!important}
    html body.home #site-header #header__navigation .sub-menu a:hover{background:#fff!important}
    html body.home #site-header #header__navigation .sub-menu::before, 
    html body.home #site-header #header__navigation .sub-menu::after,
    html body.home #site-header #header__navigation .sub-menu li::before {display:none}
    #site-header #header__navigation .sub-menu .brz-soon{opacity:.45!important;cursor:not-allowed!important}
    #site-header #header__navigation .sub-menu small{font-size:8px!important;letter-spacing:.08em!important;text-transform:uppercase!important}
    .page-id-627 #site-content,.page-id-667 #site-content{background:var(--brz-paper)!important}
    .page-id-627 #site-content p,.page-id-667 #site-content p,.page-id-627 #site-content li,.page-id-667 #site-content li{font-size:15px!important;line-height:1.55!important}
    .page-id-627 #site-content h1,.page-id-667 #site-content h1{font-size:clamp(48px,6vw,82px)!important}
    .page-id-627 #site-content h2,.page-id-667 #site-content h2{font-size:clamp(38px,4.8vw,64px)!important}
    .page-id-627 #site-content h3,.page-id-667 #site-content h3{font-size:clamp(24px,2.5vw,34px)!important}
    .page-id-627 #site-content .wp-block-themeisle-blocks-advanced-columns,.page-id-667 #site-content .wp-block-themeisle-blocks-advanced-columns{background-color:var(--brz-paper)!important}
    .page-id-667 #site-content label,.page-id-667 #site-content input,.page-id-667 #site-content textarea,.page-id-667 #site-content button,.page-id-667 #site-content select{font-family:'DM Sans',sans-serif!important}
    .page-id-667 #wp-block-themeisle-blocks-advanced-columns-990a718e,.page-id-667 #wp-block-themeisle-blocks-advanced-columns-990a718e .wp-block-themeisle-blocks-advanced-column{background:var(--brz-brown)!important;color:var(--brz-paper)!important}
    .page-id-667 #wp-block-themeisle-blocks-advanced-columns-990a718e h1,.page-id-667 #wp-block-themeisle-blocks-advanced-columns-990a718e h2,.page-id-667 #wp-block-themeisle-blocks-advanced-columns-990a718e h3,.page-id-667 #wp-block-themeisle-blocks-advanced-columns-990a718e p,.page-id-667 #wp-block-themeisle-blocks-advanced-columns-990a718e a{color:var(--brz-paper)!important}
    body.home #wp-block-themeisle-blocks-advanced-columns-61b7c2e3,
    body.home #wp-block-themeisle-blocks-advanced-columns-61b7c2e3>.wp-block-themeisle-blocks-advanced-columns-overlay,
    body.home #wp-block-themeisle-blocks-advanced-columns-61b7c2e3 .wp-block-themeisle-blocks-advanced-columns-separators,
    body.home #wp-block-themeisle-blocks-advanced-columns-61b7c2e3 .wp-block-themeisle-blocks-advanced-columns-innerblocks-wrap,
    body.home #wp-block-themeisle-blocks-advanced-columns-61b7c2e3 .wp-block-themeisle-blocks-advanced-column,
    body.home #wp-block-themeisle-blocks-advanced-columns-61b7c2e3 .wp-block-video{background:var(--brz-paper)!important}
    body.home #wp-block-themeisle-blocks-advanced-columns-61b7c2e3{margin-top:0!important;margin-bottom:0!important;padding-top:0!important;padding-bottom:0!important}
    body.home #wp-block-themeisle-blocks-advanced-columns-61b7c2e3 .wp-block-themeisle-blocks-advanced-columns-innerblocks-wrap,
    body.home #wp-block-themeisle-blocks-advanced-columns-61b7c2e3 .wp-block-themeisle-blocks-advanced-column,
    body.home #wp-block-themeisle-blocks-advanced-columns-61b7c2e3 .wp-block-themeisle-blocks-advanced-column>div{margin-top:0!important;margin-bottom:0!important;padding-top:0!important;padding-bottom:0!important}
    body.home #wp-block-themeisle-blocks-advanced-columns-61b7c2e3 .wp-block-video{position:relative!important;overflow:hidden!important;margin:0!important;padding:0!important;line-height:0!important;aspect-ratio:3840/1812!important;height:auto!important;min-height:0!important}
    body.home #wp-block-themeisle-blocks-advanced-columns-61b7c2e3 .wp-block-video video{display:block!important;width:100%!important;height:auto!important;aspect-ratio:3840/1812!important;margin:0!important;transform:none!important;object-fit:contain!important}
    .site-footer{height:auto!important;min-height:0!important;margin:0!important;padding:0!important;background:var(--brz-brown)!important;color:var(--brz-paper)!important;overflow:visible!important}
    .site-footer .brz-footer{display:grid!important;grid-template-columns:minmax(220px,1.2fr) minmax(140px,.72fr) minmax(190px,.9fr) minmax(260px,1.15fr)!important;gap:64px!important;align-items:start!important;width:min(1200px,calc(100% - 96px))!important;margin:0 auto!important;padding:76px 0 56px!important}
    .site-footer .brz-footer>div{display:flex!important;flex-direction:column!important;align-items:flex-start!important;gap:9px!important;margin:0!important;padding:0!important}
    .site-footer .brz-footer h2{margin:0 0 22px!important;font:600 10px/14px 'DM Sans',sans-serif!important;letter-spacing:.18em!important;text-transform:uppercase!important;color:var(--brz-paper)!important}
    .site-footer .brz-footer a,.site-footer .brz-footer p{margin:0!important;font:400 12px/1.55 'DM Sans',sans-serif!important;color:rgba(244,241,235,.62)!important;text-decoration:none!important}
    .site-footer .brz-footer a:hover{color:#fff!important}
    .site-footer .brz-footer .footer-contact{min-height:220px!important;padding-left:40px!important;border-left:1px solid rgba(244,241,235,.2)!important;justify-content:space-between!important}
    .site-footer .brz-footer .footer-contact>p{font:400 30px/1.05 'Manrope',sans-serif!important;letter-spacing:-.04em!important;color:var(--brz-paper)!important}
    .site-footer .brz-footer .footer-contact-button{display:inline-flex!important;align-items:center!important;justify-content:center!important;min-height:42px!important;padding:11px 18px!important;border:1px solid rgba(244,241,235,.5)!important;color:var(--brz-paper)!important}
    @media(max-width:1100px){#site-header #header__navigation .primary-menu{gap:13px!important}#site-header #header__navigation a{font-size:10px!important}.site-footer .brz-footer{width:calc(100% - 48px)!important;gap:36px!important}}
    @media(max-width:782px){body.admin-bar #site-header{top:46px!important}#site-header{height:76px!important;min-height:76px!important;background:var(--brz-paper)!important;color:var(--brz-ink)!important}#site-content{padding-top:76px}#site-header .header__inner{width:calc(100% - 40px)!important;height:76px!important;min-height:76px!important}body #site-header .custom-logo,body #site-header .custom-logo-link,body.home #site-header .custom-logo,body.home #site-header .custom-logo-link{width:142px!important;flex:0 0 142px!important}body #site-header .custom-logo-link img.brz-wordmark,body.home #site-header .custom-logo-link img.brz-wordmark{width:142px!important;height:38px!important}#site-header #nav-toggle{display:flex!important;align-items:center!important;justify-content:center!important;margin-left:auto!important;color:var(--brz-ink)!important;z-index:2!important}body #site-header #header__navigation,body.home #site-header #header__navigation{display:none!important;position:fixed!important;top:76px!important;left:0!important;right:0!important;max-height:calc(100vh - 76px)!important;overflow:auto!important;height:auto!important;background:var(--brz-paper)!important;color:var(--brz-ink)!important;border-top:1px solid rgba(75,75,76,.2)!important}body.admin-bar #site-header #header__navigation{top:122px!important;max-height:calc(100vh - 122px)!important}body #site-header.brz-mobile-open #header__navigation,body.home #site-header.brz-mobile-open #header__navigation{display:block!important;opacity:1!important;visibility:visible!important;transform:none!important}#site-header #header__navigation .primary-menu{display:block!important;height:auto!important;padding:16px 24px 26px!important}#site-header #header__navigation .menu-item{display:block!important;height:auto!important}#site-header #header__navigation a{padding:12px 0!important;font-size:14px!important;color:var(--brz-ink)!important}#site-header #header__navigation .sub-menu{position:static!important;width:100%!important;box-shadow:none!important;opacity:1!important;visibility:visible!important;transform:none!important;background:var(--brz-paper)!important}.site-footer .brz-footer{grid-template-columns:1fr 1fr!important}.site-footer .brz-footer .footer-contact{grid-column:1/-1!important;min-height:140px!important;padding:30px 0 0!important;border-left:0!important;border-top:1px solid rgba(244,241,235,.2)!important}}
    @media(max-width:560px){.site-footer .brz-footer{grid-template-columns:1fr!important;padding:54px 0 36px!important}.site-footer .brz-footer .footer-contact{grid-column:auto!important}}
    body #site-header,body.home #site-header{background:var(--brz-paper)!important;color:var(--brz-ink)!important}
    body #site-header #header__navigation a,body.home #site-header #header__navigation a{color:var(--brz-ink)!important}
    body.home #site-header #header__navigation .menu-item:last-child a{min-height:auto!important;padding:0!important;background:transparent!important;color:var(--brz-ink)!important;border:0!important}
    body.page-id-667 #site-content label,body.page-id-667 #site-content input,body.page-id-667 #site-content textarea,body.page-id-667 #site-content button,body.page-id-667 #site-content select{font-family:'DM Sans',sans-serif!important}
    body.page-id-667 #wp-block-themeisle-blocks-advanced-columns-990a718e,body.page-id-667 #wp-block-themeisle-blocks-advanced-columns-990a718e .wp-block-themeisle-blocks-advanced-column{background:var(--brz-brown)!important;color:var(--brz-paper)!important}
    body.page-id-667 #wp-block-themeisle-blocks-advanced-columns-990a718e h1,body.page-id-667 #wp-block-themeisle-blocks-advanced-columns-990a718e h2,body.page-id-667 #wp-block-themeisle-blocks-advanced-columns-990a718e h3,body.page-id-667 #wp-block-themeisle-blocks-advanced-columns-990a718e p,body.page-id-667 #wp-block-themeisle-blocks-advanced-columns-990a718e a{color:var(--brz-paper)!important}
    html body #page #site-header{background:var(--brz-paper)!important;color:var(--brz-ink)!important}
    html body #page #site-header #header__navigation a{color:var(--brz-ink)!important}
    html body.page-id-667 #page #site-content #wp-block-themeisle-blocks-advanced-columns-990a718e{--background:var(--brz-brown)!important;background-color:var(--brz-brown)!important;color:var(--brz-paper)!important}
    html body.page-id-667 #page #site-content #wp-block-themeisle-blocks-advanced-columns-990a718e .wp-block-themeisle-blocks-advanced-column{--background:var(--brz-brown)!important;background-color:var(--brz-brown)!important;color:var(--brz-paper)!important}
    @media(max-width:782px){html body.home #site-header #header__navigation,html body.home #site-header #header__navigation .header__navigation-inner,html body.home #site-header #header__navigation .menu-barzza-menu-container,html body.home #site-header #header__navigation .primary-menu{background:var(--brz-paper)!important;color:var(--brz-ink)!important}html body.home #site-header #header__navigation .primary-menu>.menu-item>a{color:var(--brz-ink)!important;font-size:15px!important}html body.home #site-header #header__navigation .brz-products:not(.brz-sub-open)>.sub-menu{display:none!important}html body.home #site-header #header__navigation .sub-menu{position:static!important;display:block!important;width:100%!important;margin:0 0 6px!important;padding:0 0 0 12px!important;background:transparent!important;border:0!important;box-shadow:none!important;opacity:1!important;visibility:visible!important;transform:none!important}html body.home #site-header #header__navigation .sub-menu .menu-item{border-bottom:1px solid rgba(75,75,76,.15)!important}}
    @media(max-width:782px){html body.home #site-header #header__navigation .primary-menu{padding:12px 24px 24px!important;box-sizing:border-box!important;width:100%!important}html body.home #site-header #header__navigation .primary-menu>.menu-item{display:block!important;position:static!important;width:100%!important;height:auto!important;border-bottom:1px solid rgba(75,75,76,.15)!important}html body.home #site-header #header__navigation .primary-menu>.menu-item>a{display:flex!important;justify-content:space-between!important;width:100%!important;min-height:0!important;padding:14px 0!important}html body.home #site-header #header__navigation .sub-menu{left:auto!important;top:auto!important;right:auto!important}html body.home #site-header #header__navigation .sub-menu .menu-item{display:block!important;width:100%!important}}
    @media(max-width:782px){html body #site-header #nav-toggle>*{display:none!important}html body #site-header #nav-toggle::after{content:none!important}html body #site-header #nav-toggle::before{content:'Menu'!important;display:block!important;position:static!important;width:auto!important;height:auto!important;background:none!important;border:0!important;transform:none!important;box-shadow:none!important;font:500 13px/1 'DM Sans',sans-serif!important;letter-spacing:.04em!important;color:var(--brz-ink)!important}html body #site-header.brz-mobile-open #nav-toggle::before{content:'Close'!important}}
    @media(max-width:782px){html body #page #site-header .custom-logo,html body #page #site-header .custom-logo-link{width:142px!important;flex:0 0 142px!important}html body #page #site-header .custom-logo-link img.brz-wordmark{width:142px!important;height:38px!important}}
    </style>

    <script id="barzza-global-system-script-20261028">
    (function(){
      function buildHeader(){
        var logo=document.querySelector('#site-header .custom-logo-link');
        if(logo)logo.innerHTML='<img class="brz-wordmark" src="https://barzza-configurator-demo.christophkayser.chatgpt.site/assets/website-logo.png" alt="BARZZA">';
        var menu=document.querySelector('#site-header #header__navigation .primary-menu');
        if(!menu)return;
        menu.innerHTML='<li class="menu-item"><a href="https://barzza.ae/">Home</a></li><li class="menu-item menu-item-has-children brz-products"><a href="https://barzza.ae/#product-amenities">Our Products</a><ul class="sub-menu"><li class="menu-item"><a href="https://barzza.ae/#product-amenities"><b>01</b><span>Amenities</span></a></li><li class="menu-item"><a href="https://barzza.ae/#hospitality"><b>02</b><span>Hospitality</span></a></li><li class="menu-item brz-soon"><span><b>03</b>Commercial <small>Coming soon</small></span></li><li class="menu-item brz-soon"><span><b>04</b>Residential <small>Coming soon</small></span></li></ul></li><li class="menu-item"><a href="https://barzza.ae/#how-it-works">How it works</a></li><li class="menu-item"><a href="https://barzza.ae/partnership/">Partnership</a></li><li class="menu-item"><a href="https://barzza-configurator-demo.christophkayser.chatgpt.site/#configure">Configurator</a></li><li class="menu-item"><a href="https://barzza.ae/contacts/">Contact Us</a></li>';
      }
      function bindMobileMenu(){
        var header=document.querySelector('#site-header'),toggle=document.querySelector('#nav-toggle');
        if(!header||!toggle||toggle.dataset.brzBound)return;
        toggle.dataset.brzBound='1';
        toggle.addEventListener('click',function(event){
          event.preventDefault();event.stopImmediatePropagation();
          var open=header.classList.toggle('brz-mobile-open');
          toggle.setAttribute('aria-expanded',open?'true':'false');
          toggle.setAttribute('aria-label',open?'Close menu':'Open menu');
        },true);
        header.addEventListener('click',function(event){var pa=event.target.closest('.brz-products>a');if(pa&&window.innerWidth<=782){event.preventDefault();event.stopImmediatePropagation();pa.parentNode.classList.toggle('brz-sub-open');return}if(event.target.closest('#header__navigation a')&&!event.target.closest('.brz-products>a')){header.classList.remove('brz-mobile-open');toggle.setAttribute('aria-expanded','false')}},true);
        window.addEventListener('resize',function(){if(window.innerWidth>782){header.classList.remove('brz-mobile-open');toggle.setAttribute('aria-expanded','false')}});
      }
      function buildFooter(){
        var footer=document.querySelector('.site-footer');
        if(!footer)return;
        footer.innerHTML='<div class="brz-footer"><div><h2>Explore</h2><a href="https://barzza.ae/">Home</a><a href="https://barzza.ae/#product-amenities">Amenities</a><a href="https://barzza.ae/#hospitality">Hospitality</a><a href="https://barzza.ae/#how-it-works">How it works</a><a href="https://barzza.ae/partnership/">Partnership</a><a href="https://barzza-configurator-demo.christophkayser.chatgpt.site/#configure">Configurator</a><a href="https://barzza.ae/contacts/">Contact Us</a></div><div><h2>Follow</h2><a href="https://www.instagram.com/barzza.uae" target="_blank" rel="noopener">Instagram</a><a href="https://www.facebook.com/profile.php?id=61579398868015" target="_blank" rel="noopener">Facebook</a></div><div><h2>Barzza</h2><p>© 2026 BARZZA.</p><a href="https://barzza.ae/privacy-policy/">Privacy Policy</a><a href="https://barzza.ae/terms-of-service/">Terms of Service</a></div><div class="footer-contact"><p>Have questions?</p><a class="footer-contact-button" href="https://barzza.ae/contacts/">Contact Us</a></div></div>';
      }
      function cleanLinks(){
        document.querySelectorAll('a[href*="barzza-configurator-demo.goldenhinny9.chatgpt.site"]').forEach(function(a){a.href='https://barzza-configurator-demo.christophkayser.chatgpt.site/#configure'});
        document.querySelectorAll('a[href*="/book-consultation"],a[href*="/addons/"]').forEach(function(a){
          if(a.closest('.site-footer,#site-header'))a.remove();
          else if(a.textContent.trim().toLowerCase().indexOf('partner')>-1)a.href='https://barzza.ae/contacts/';
          else a.remove();
        });
      }
      function startSlider(){
        if(!document.body.classList.contains('home'))return;
        window.setInterval(function(){
          var next=document.querySelector('#wp-block-themeisle-blocks-slider-e5d03f3d [data-glide-dir=">"],#wp-block-themeisle-blocks-slider-e5d03f3d .glide__arrow--right');
          if(next&&document.visibilityState==='visible')next.click();
        },3000);
      }
      function init(){buildHeader();bindMobileMenu();buildFooter();cleanLinks();window.addEventListener('load',cleanLinks,{once:true});window.setTimeout(cleanLinks,600);window.setTimeout(cleanLinks,1800);startSlider()}
      if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init,{once:true});else init();
    })();
    </script>

    </body>
</html>

