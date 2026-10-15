<?php
/** Dependency-free integration checks: php src/tests/smoke.php */
declare(strict_types=1);

require_once __DIR__ . '/../view.php';
require_once __DIR__ . '/../cms.php';
require_once __DIR__ . '/../clientInfo.php';
require_once __DIR__ . '/../ipInfo.php';

set_error_handler(function ($severity, $message, $file, $line) {
    if (error_reporting() & $severity) {
        throw new ErrorException($message, 0, $severity, $file, $line);
    }
    return true;
});

$checks = 0;
function check(bool $condition, string $message): void {
    global $checks;
    if (!$condition) {
        throw new RuntimeException($message);
    }
    $checks++;
}

function renderPage(string $page): string {
    ob_start();
    require __DIR__ . '/../' . $page;
    return ob_get_clean();
}

// Local addresses make this suite deterministic and independent of IP-API.
foreach (['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED'] as $key) {
    putenv($key);
}
putenv('REMOTE_ADDR=127.0.0.1');
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
$_SERVER['SERVER_ADDR'] = '127.0.0.1';
$_SERVER['SERVER_SOFTWARE'] = 'Local test server';
$_SERVER['HTTP_USER_AGENT'] = 'curl/7.58.0';

$pages = [];
foreach (['index.php', 'client.php', 'server.php'] as $page) {
    $html = renderPage($page);
    $pages[$page] = $html;
    check(strpos($html, '<!doctype html>') !== false, "$page has a complete document");
    check(substr_count($html, '<h1 ') === 1, "$page has one primary heading");
    check(strpos($html, 'href="client.php"') !== false, "$page links to client information");
    check(strpos($html, 'href="server.php"') !== false, "$page links to server information");
    check(strpos($html, 'id="main"') !== false, "$page has a skip-link target");
}

$sites = cms::readContent('sites');
$appCount = 0;
foreach ($sites as $site) {
    check(strpos($pages['index.php'], 'href="' . escape($site['link']) . '"') !== false, $site['name'] . ' is linked');
    check(is_file(__DIR__ . '/../' . $site['image']), $site['name'] . ' has an image');
    if ($site['category'] !== 'Elsewhere') $appCount++;
}
check(substr_count($pages['index.php'], 'class="app-row"') === $appCount, 'Every app is rendered before JavaScript runs');
check(strpos($pages['client.php'], 'Curl v7.58.0') !== false, 'Client browser information is rendered');
check(strpos($pages['server.php'], 'Local test server') !== false, 'The actual server software is rendered');
check(strpos($pages['server.php'], 'Custom CSS / Vanilla JavaScript') !== false, 'The interface description is up to date');

$_SERVER['HTTP_USER_AGENT'] = '<script>alert("test")</script>';
$html = renderPage('client.php');
check(strpos($html, $_SERVER['HTTP_USER_AGENT']) === false, 'User-agent HTML cannot execute');
check(strpos($html, escape($_SERVER['HTTP_USER_AGENT'])) !== false, 'User-agent text is retained and escaped');

foreach (['', 'unrecognised browser', 'Android', 'Macintosh', 'Chrome'] as $agent) {
    $client = new clientInfo($agent);
    check($client->getUserAgent() === $agent, 'Incomplete user agents are handled without warnings');
}
$network = new ipInfo('127.0.0.1');
check($network->getLocation() === '', 'Private addresses do not use the public location service');
check(strpos($pages['client.php'], 'Unavailable') !== false, 'Unavailable network fields have a readable fallback');

echo "Passed $checks integration checks.\n";
