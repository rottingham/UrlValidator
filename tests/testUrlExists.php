<?

/**
 * Test File for checking invalid URL strings
 */
require_once __DIR__ . '/../src/UrlValidator.class.php';

use UrlValidator\UrlValidator;

$emptyUrl = '';
$invalidUrl1 = 'http//yahoo';
$invalidUrl2 = 'yahoo.co';
$invalidUrl3 = 'http://www.google';
$invalidUrl4 = 'http:/www.google.com';
$invalidUrl5 = 'http:/www.www.com';

$validUrl = 'http://www.yahoo.com';

// Will throw InvalidArgumentException when provided with empty URL
try {
	$isValid = UrlValidator::exists($emptyUrl);
} catch (InvalidArgumentException $e) {
	var_dump($e->getMessage());
}

$isValid = UrlValidator::exists($invalidUrl1) === false ? "No" : "Yes";
var_dump('URL: ' . $invalidUrl1 . ' - ' . $isValid);

$isValid = UrlValidator::exists($invalidUrl2) === false ? "No" : "Yes";
var_dump('URL: ' . $invalidUrl2 . ' - ' . $isValid);

$isValid = UrlValidator::exists($invalidUrl3) === false ? "No" : "Yes";
var_dump('URL: ' . $invalidUrl3 . ' - ' . $isValid);

$isValid = UrlValidator::exists($invalidUrl4) === false ? "No" : "Yes";
var_dump('URL: ' . $invalidUrl4 . ' - ' . $isValid);

$isValid = UrlValidator::exists($invalidUrl5) === false ? "No" : "Yes";
var_dump('URL: ' . $invalidUrl5 . ' - ' . $isValid);

$isValid = UrlValidator::exists($validUrl) === false ? "No" : "Yes";
var_dump('URL: ' . $validUrl . ' - ' . $isValid);