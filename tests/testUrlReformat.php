<?

/**
 * Test File for checking invalid URL strings
 */
require_once __DIR__ . '/../src/UrlValidator.class.php';

use UrlValidator\UrlValidator;

$invalidUrl = 'http:yahoo.com';
$invalidUrl2 = 'http://yahoo';
$invalidUrl3 = 'google.com';
$invalidUrl4 = 'www.google.com';
$invalidUrl5 = 'subdo.domain.com';
$invalidUrl6 = 'www';


var_dump($reformattedUrl = UrlValidator::reformat($invalidUrl));
var_dump($reformattedUrl = UrlValidator::reformat($invalidUrl2));
var_dump($reformattedUrl = UrlValidator::reformat($invalidUrl3));
var_dump($reformattedUrl = UrlValidator::reformat($invalidUrl4));
var_dump($reformattedUrl = UrlValidator::reformat($invalidUrl5));
var_dump($reformattedUrl = UrlValidator::reformat($invalidUrl6));
