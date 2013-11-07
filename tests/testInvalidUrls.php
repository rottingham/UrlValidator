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

// Will throw InvalidArgumentException when provided with empty URL
try {
	$isValid = UrlValidator::validate($emptyUrl);
} catch (InvalidArgumentException $e) {
	var_dump($e->getMessage());
}

$isValid = UrlValidator::validate($invalidUrl1) === false ? "No" : "Yes";
var_dump('URL: ' . $invalidUrl1 . ' - ' . $isValid);

$isValid = UrlValidator::validate($invalidUrl2) === false ? "No" : "Yes";
var_dump('URL: ' . $invalidUrl2 . ' - ' . $isValid);

$isValid = UrlValidator::validate($invalidUrl3) === false ? "No" : "Yes";
var_dump('URL: ' . $invalidUrl3 . ' - ' . $isValid);

$isValid = UrlValidator::validate($invalidUrl4) === false ? "No" : "Yes";
var_dump('URL: ' . $invalidUrl4 . ' - ' . $isValid);