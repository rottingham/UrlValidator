UrlValidator
============

Utility Class to validate URL string as well as determine if the URL exists.

For extended usage examples, see test files.

#### Sample Usage

Simply import the `Urlvalidator.class.php` file into your project if you are not using dependency injection.

    require __DIR__ . '/src/UrlValidator.class.php';

##### Valiate URL

To validate a URL string, use the `UrlValidator::validate(url)` method;

    $url = 'http://www.yahoo.com';
    $isValid = UrlValidator\UrlValidator::validate($url);
    var_dump($isValid);
    
#### Check if URL Exists

To determine if a URL actaully exists, IE the domain exists and the URL request is not bounced, use the `UrlValidator::exists(url)` method;

    $url = 'http://www.yahoo.com';
    $exists = UrlValidator\UrlValidator::exists($url);
    var_dump($exists);
    
**Note:** `UrlValidator::exists(url)` calls `UrlValidator::validate(url)` and will return FALSE if the URL is invalid before every checking the URL headers.

#### Reformat URL

You can attempt to reformat a bad URL with the `UrlValidator::reformat(url)` method. This method is far from perfect, but since `www.yahoo.com` is technically an invalid URL, it can be quite useful.

    $url = 'google.com';
    $newUrl = UrlValidator\UrlValidator::reformat($url);
    var_dump($newUrl);
    
    // Outputs `http://www.google.com`
    
