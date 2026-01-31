<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include __DIR__ . '/../clientInfo.php';

final class clientInfoTest extends TestCase
{
  public function testHandleEmptyUserAgent(): void {
    $clientInfo = new clientInfo("");
    $this->assertTrue(true);
  }

  public function testCurlUserAgent(): void {
    $clientInfo = new clientInfo("curl/7.58.0");
    $this->assertTrue($clientInfo->getPlatform() == "Unknown");
    $this->assertTrue($clientInfo->getName() == "Curl");
    $this->assertTrue($clientInfo->getBrowserVersion() == "v7.58.0");
    $this->assertTrue($clientInfo->getUserAgent() == "curl/7.58.0");
  }

  public function testWindowsChromeUserAgent(): void {
    $clientInfo = new clientInfo("Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36");
    $this->assertTrue($clientInfo->getPlatform() == "Windows 10 (64-bit)");
    $this->assertTrue($clientInfo->getName() == "Google Chrome");
    $this->assertTrue($clientInfo->getBrowserVersion() == "v73.0.3683.103");
  }

  public function testiPhoneUserAgent(): void {
    $clientInfo = new clientInfo("Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345d Safari/600.1.4");
    print ("\ngetPlatform: " . $clientInfo->getPlatform());
    print ("\ngetName: " . $clientInfo->getName());
    print ("\ngetBrowserVersion: " . $clientInfo->getBrowserVersion());
    $this->assertTrue($clientInfo->getPlatform() == "iPhone; iPhone OS 8.0 like Mac OS X");
    $this->assertTrue($clientInfo->getName() == "Apple Safari");
    $this->assertTrue($clientInfo->getBrowserVersion() == "v8.0");
  }

  public function testAndroid6UserAgent(): void {
    $clientInfo = new clientInfo(" Mozilla/5.0 (Linux; U; Android 6.0.0; ko-kr; LG-L160L Build/IML74K) AppleWebkit/534.30 (KHTML, like Gecko) Version/6.0 Mobile Safari/534.30");
    print ("\ngetPlatform: " . $clientInfo->getPlatform());
    print ("\ngetName: " . $clientInfo->getName());
    print ("\ngetBrowserVersion: " . $clientInfo->getBrowserVersion());
    $this->assertTrue($clientInfo->getPlatform() == "Android v6.0 (Marshmallow)");
  }

  public function testAndroid9UserAgent(): void {
    $clientInfo = new clientInfo("Mozilla/5.0 (Linux; Android 9; motorola one power) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Mobile Safari/537.36");
    print ("\ngetPlatform: " . $clientInfo->getPlatform());
    print ("\ngetName: " . $clientInfo->getName());
    print ("\ngetBrowserVersion: " . $clientInfo->getBrowserVersion());
    $this->assertTrue($clientInfo->getPlatform() == "Android v9 (Pie)");
  }

  public function testAndroid10UserAgent(): void {
    $clientInfo = new clientInfo("Mozilla/5.0 (Linux; Android 10; SM-G970F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3396.81 Mobile Safari/537.36");
    print ("\ngetPlatform: " . $clientInfo->getPlatform());
    print ("\ngetName: " . $clientInfo->getName());
    print ("\ngetBrowserVersion: " . $clientInfo->getBrowserVersion());
    $this->assertTrue($clientInfo->getPlatform() == "Android v10 (Android 10)");
  }

  public function testAndroid12UserAgent(): void {
    $clientInfo = new clientInfo("Mozilla/5.0 (Linux; Android 12; SM-A205U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.50 Mobile Safari/537.36");
    print ("\ngetPlatform: " . $clientInfo->getPlatform());
    print ("\ngetName: " . $clientInfo->getName());
    print ("\ngetBrowserVersion: " . $clientInfo->getBrowserVersion());
    $this->assertTrue($clientInfo->getPlatform() == "Android v12 (Android 12)");
  }

  public function testMacEdgeUserAgent(): void {
    $clientInfo = new clientInfo("Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36 Edg/95.0.1020.30");
    print ("\ngetPlatform: " . $clientInfo->getPlatform());
    print ("\ngetName: " . $clientInfo->getName());
    print ("\ngetBrowserVersion: " . $clientInfo->getBrowserVersion());
    $this->assertTrue($clientInfo->getName() == "Microsoft Edge");
  }

  public function testAndroidEdgeUserAgent(): void {
    $clientInfo = new clientInfo("Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36 Edg/95.0.1020.30");
    print ("\ngetPlatform: " . $clientInfo->getPlatform());
    print ("\ngetName: " . $clientInfo->getName());
    print ("\ngetBrowserVersion: " . $clientInfo->getBrowserVersion());
    $this->assertTrue($clientInfo->getName() == "Microsoft Edge");
  }

  public function testIosEdgeUserAgent(): void {
    $clientInfo = new clientInfo("Mozilla/5.0 (iPhone; CPU iPhone OS 15_0_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.0 EdgiOS/93.961.64 Mobile/15E148 Safari/605.1.15");
    print ("\ngetPlatform: " . $clientInfo->getPlatform());
    print ("\ngetName: " . $clientInfo->getName());
    print ("\ngetBrowserVersion: " . $clientInfo->getBrowserVersion());
    $this->assertTrue($clientInfo->getName() == "Microsoft Edge");
  }

}

