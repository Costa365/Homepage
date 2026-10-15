<?php
require_once __DIR__ . '/view.php';
require_once __DIR__ . '/cms.php';
$sites = cms::readContent('sites');
$apps = array_values(array_filter($sites, function ($site) { return ($site['category'] ?? '') !== 'Elsewhere'; }));
$profiles = array_filter($sites, function ($site) { return ($site['category'] ?? '') === 'Elsewhere'; });
$categories = array_values(array_unique(array_column($apps, 'category')));
$page = 'home';
$pageTitle = 'Costa365 — Useful things. Playful ideas.';
$pageDescription = 'An independent collection of apps, useful tools, games, and experiments by Costa365. Find your next useful thing.';
?>
<!doctype html>
<html lang="en">
<head><?php require __DIR__ . '/head.php'; ?></head>
<body id="top">
<?php require __DIR__ . '/header.php'; ?>
<main id="main">
  <div class="hero-band">
  <section class="hero container" aria-labelledby="hero-title">
    <div class="hero-kicker eyebrow"><span class="status-dot" aria-hidden="true"></span> Independent apps &amp; experiments <span class="hero-edition">The Costa365 collection</span></div>
    <div class="hero-main">
      <h1 id="hero-title">Useful things.<br><span>Playful ideas.</span></h1>
      <div class="hero-art" aria-hidden="true">
        <svg class="studio-mark" viewBox="0 0 240 240" fill="none">
          <g fill="currentColor">
            <path d="M106 12h28v72l-14 18-14-18z"/>
            <path d="M106 12h28v72l-14 18-14-18z" transform="rotate(45 120 120)"/>
            <path d="M106 12h28v72l-14 18-14-18z" transform="rotate(90 120 120)"/>
            <path d="M106 12h28v72l-14 18-14-18z" transform="rotate(135 120 120)"/>
            <path d="M106 12h28v72l-14 18-14-18z" transform="rotate(180 120 120)"/>
            <path d="M106 12h28v72l-14 18-14-18z" transform="rotate(225 120 120)"/>
            <path d="M106 12h28v72l-14 18-14-18z" transform="rotate(270 120 120)"/>
            <path d="M106 12h28v72l-14 18-14-18z" transform="rotate(315 120 120)"/>
          </g>
        </svg>
        <span class="art-caption eyebrow">A little curiosity goes a long way.</span>
      </div>
    </div>
    <div class="hero-bottom">
      <a class="explore-link" href="#collection"><span class="circle-arrow"><?= icon('down') ?></span> Explore the collection <span class="mono">/ <?= count($apps) ?></span></a>
      <p>A home for the things I build.<br>Tools to make life simpler. Games to make it a little more fun.</p>
    </div>
  </section>
  </div>
  <div class="container">
  <section id="collection" class="collection" aria-labelledby="collection-title" data-directory>
    <div class="section-heading">
      <div><p class="eyebrow section-index">01 / Explore</p><h2 id="collection-title">The collection<span class="heading-count"><?= sprintf('%02d', count($apps)) ?></span></h2></div>
      <p class="section-note">Find something useful.<br>Or something just for fun.</p>
    </div>
    <div class="directory-toolbar" data-directory-controls hidden>
      <div class="filters" role="group" aria-label="Filter apps by category">
        <button class="filter is-active" type="button" data-filter="all" aria-pressed="true" aria-controls="app-list">All apps <span><?= count($apps) ?></span></button>
        <?php foreach ($categories as $category): ?>
        <button class="filter" type="button" data-filter="<?= escape($category) ?>" aria-pressed="false" aria-controls="app-list"><?= escape($category) ?> <span><?= count(array_filter($apps, function ($app) use ($category) { return $app['category'] === $category; })) ?></span></button>
        <?php endforeach; ?>
      </div>
      <div class="search-field">
        <?= icon('search') ?>
        <label class="sr-only" for="app-search">Search apps</label>
        <input id="app-search" type="search" placeholder="Find an app…" autocomplete="off" aria-controls="app-list">
        <kbd aria-hidden="true">/</kbd>
      </div>
    </div>
    <div class="directory-meta"><p role="status" aria-live="polite" aria-atomic="true" data-results-count><?= count($apps) ?> apps to explore</p><span>Open an app <?= icon('external') ?></span></div>
    <ol class="app-list" id="app-list">
      <?php foreach ($apps as $index => $app): ?>
      <li class="app-item" data-category="<?= escape($app['category']) ?>" data-search="<?= escape($app['name'] . ' ' . $app['description'] . ' ' . $app['category']) ?>">
        <a class="app-row" href="<?= escape($app['link']) ?>" target="_blank" rel="noopener noreferrer">
          <span class="app-number mono" aria-hidden="true"><?= sprintf('%02d', $index + 1) ?></span>
          <span class="app-icon"><img src="<?= escape($app['image']) ?>" width="32" height="32" alt="" loading="lazy"></span>
          <h3><?= escape($app['name']) ?></h3>
          <p class="app-description"><?= escape($app['description']) ?></p>
          <span class="app-category"><?= escape($app['category']) ?></span>
          <span class="app-arrow" aria-hidden="true"><?= icon('external') ?></span>
          <span class="sr-only">Opens in a new tab</span>
        </a>
      </li>
      <?php endforeach; ?>
    </ol>
    <div class="empty-state" data-empty-state hidden>
      <span class="empty-symbol" aria-hidden="true"><?= icon('search') ?></span>
      <h3>No apps found.</h3>
      <p>Try a different search, or explore the whole collection.</p>
      <button class="text-button" type="button" data-reset-filters>Show all apps <?= icon('right') ?></button>
    </div>
    <div class="collection-end"><span class="small-cross" aria-hidden="true">+</span><p>Built with curiosity. Shared for you to explore.</p><span class="mono">END OF INDEX</span></div>
  </section>
  <section class="elsewhere" aria-labelledby="elsewhere-title">
    <div class="elsewhere-intro"><p class="eyebrow section-index">02 / Beyond the apps</p><h2 id="elsewhere-title">More of the work.</h2><p>Code, experiments, and a little problem-solving.</p></div>
    <div class="profile-links">
      <?php foreach ($profiles as $profile): ?>
      <a class="profile-link" href="<?= escape($profile['link']) ?>" target="_blank" rel="noopener noreferrer">
        <div><span class="eyebrow"><?= escape($profile['label']) ?></span><h3><?= escape($profile['name']) ?></h3><p><?= escape($profile['description']) ?></p></div>
        <?= icon('external') ?><span class="sr-only">Opens in a new tab</span>
      </a>
      <?php endforeach; ?>
    </div>
  </section>
  </div>
</main>
<?php require __DIR__ . '/footer.php'; ?>
</body>
</html>

