<?php
require_once __DIR__ . '/view.php';
require_once __DIR__ . '/clientInfo.php';
require_once __DIR__ . '/ipInfo.php';
$client = new clientInfo($_SERVER['HTTP_USER_AGENT'] ?? '');
$network = new ipInfo('');
$version = $client->getBrowserVersion() === clientInfo::UNKNOWN ? '' : ' ' . $client->getBrowserVersion();
$rows = [
    'IP address' => $network->getIpAddress(),
    'Location' => $network->getLocation(),
    'Autonomous system' => $network->getAs(),
    'Service provider' => $network->getIsp(),
    'Organisation' => $network->getOrganisation(),
    'Browser' => $client->getName() . $version,
    'Platform' => $client->getPlatform(),
    'User agent' => $client->getUserAgent(),
];
$page = 'client';
$pageTitle = 'Client information — Costa365';
$pageDescription = 'A simple overview of your browser, platform, and network connection.';
?>
<!doctype html>
<html lang="en">
<head><?php require __DIR__ . '/head.php'; ?></head>
<body id="top">
<?php require __DIR__ . '/header.php'; ?>
<main id="main" class="container utility-main">
  <section class="utility-hero" aria-labelledby="utility-title">
    <a class="breadcrumb" href="./#collection"><?= icon('right') ?> Back to the collection</a>
    <p class="eyebrow section-index">Utilities / 01</p>
    <div class="utility-title"><h1 id="utility-title">Client information<span class="brand-period">.</span></h1><?= icon('monitor') ?></div>
    <p>A closer look at your side of the connection. Your browser, device platform, and network, in one place.</p>
  </section>
  <div class="information-layout">
    <aside class="information-aside"><h2>Your connection</h2><p>Details reported by your current request. Network location is approximate and may reflect a VPN or proxy.</p><a class="text-button" href="client.php">Refresh details <?= icon('right') ?></a></aside>
    <div>
      <table class="information-table"><caption class="sr-only">Client browser and network information</caption><tbody>
        <?php foreach ($rows as $label => $value): ?>
        <tr><th scope="row"><?= escape($label) ?></th><td><?= informationValue($value) ?></td></tr>
        <?php endforeach; ?>
      </tbody></table>
      <p class="information-note">Network details are provided by IP-API. Your public IP is used for this lookup. If the lookup is unavailable, your browser information still appears here.</p>
    </div>
  </div>
</main>
<?php require __DIR__ . '/footer.php'; ?>
</body>
</html>
