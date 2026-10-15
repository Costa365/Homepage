<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header" data-header>
  <div class="container header-inner">
    <a class="wordmark" href="./" aria-label="Costa365 home"><span class="brand-mark" aria-hidden="true"><i></i><i></i><i></i><i></i></span>costa<span class="brand-number">365</span><span class="brand-period">.</span></a>
    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-navigation" data-menu-toggle hidden><span data-menu-label>Menu</span><span class="menu-lines" aria-hidden="true"></span></button>
    <nav id="site-navigation" class="site-navigation" aria-label="Main navigation">
      <a class="nav-link<?= $page === 'home' ? ' is-current' : '' ?>" href="./#collection"<?= $page === 'home' ? ' aria-current="page"' : '' ?>>The apps<span class="nav-dot" aria-hidden="true"></span></a>
      <a class="nav-link<?= $page === 'client' ? ' is-current' : '' ?>" href="client.php"<?= $page === 'client' ? ' aria-current="page"' : '' ?>><?= icon('monitor') ?><span>Client info</span></a>
      <a class="nav-link<?= $page === 'server' ? ' is-current' : '' ?>" href="server.php"<?= $page === 'server' ? ' aria-current="page"' : '' ?>><?= icon('server') ?><span>Server info</span></a>
      <a class="nav-github" href="https://github.com/costa365" target="_blank" rel="noopener noreferrer"><img class="brand-icon nav-brand-icon" src="<?= escape(assetUrl('images/github.png')) ?>" width="20" height="20" alt=""><span>GitHub</span><?= icon('external') ?><span class="sr-only">Opens in a new tab</span></a>
    </nav>
  </div>
</header>
