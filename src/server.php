<?php
require_once __DIR__ . '/view.php';
require_once __DIR__ . '/ipInfo.php';
$serverAddress = $_SERVER['SERVER_ADDR'] ?? $_SERVER['LOCAL_ADDR'] ?? $_SERVER['SERVER_NAME'] ?? '';
if (!filter_var($serverAddress, FILTER_VALIDATE_IP)) {
    $serverAddress = '';
}
$network = $serverAddress !== '' ? new ipInfo($serverAddress) : null;
$rows = [
    'Operating system' => PHP_OS,
    'Server language' => 'PHP ' . PHP_VERSION,
    'Interface' => 'Custom CSS / Vanilla JavaScript',
    'Web server' => $_SERVER['SERVER_SOFTWARE'] ?? '',
    'IP address' => $serverAddress,
    'Location' => $network ? $network->getLocation() : '',
    'Autonomous system' => $network ? $network->getAs() : '',
    'Service provider' => $network ? $network->getIsp() : '',
    'Organisation' => $network ? $network->getOrganisation() : '',
];
$page = 'server';
$pageTitle = 'Server information — Costa365';
$pageDescription = 'A look at the server and software behind the Costa365 app collection.';
?>
<!doctype html>
<html lang="en">
<head><?php require __DIR__ . '/head.php'; ?></head>
<body id="top">
<?php require __DIR__ . '/header.php'; ?>
<main id="main" class="container utility-main">
  <section class="utility-hero" aria-labelledby="utility-title">
    <a class="breadcrumb" href="./#collection"><?= icon('right') ?> Back to the collection</a>
    <p class="eyebrow section-index">Utilities / 02</p>
    <div class="utility-title"><h1 id="utility-title">Server information<span class="brand-period">.</span></h1><?= icon('server') ?></div>
    <p>A look behind the collection. The system, software, and network serving this little corner of the web.</p>
  </section>
  <div class="information-layout">
    <aside class="information-aside"><h2>Behind the scenes</h2><p>Information from the server handling this request, with network details where available.</p><a class="text-button" href="server.php">Refresh details <?= icon('right') ?></a></aside>
    <div>
      <table class="information-table"><caption class="sr-only">Server software and network information</caption><tbody>
        <?php foreach ($rows as $label => $value): ?>
        <tr><th scope="row"><?= escape($label) ?></th><td><?= informationValue($value) ?></td></tr>
        <?php endforeach; ?>
      </tbody></table>
      <p class="information-note">Network details are provided by IP-API. Private or local server addresses do not have public location information.</p>
    </div>
  </div>
</main>
<?php require __DIR__ . '/footer.php'; ?>
</body>
</html>
