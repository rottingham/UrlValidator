<?

namespace UrlValidator;

/**
 * UrlValidator
 *
 * Utility to validate URL string format as well as determine if the URL exists.
 *
 * Author: Ralph Brickley <brickleyralph@gmail.com>
 */
class UrlValidator {

	/**
	 * Validate URL String
	 *
	 * Uses PHP's filter_var method to ensure the URL string is valid.
	 *
	 * @param string $url Url to validate
	 * @throws InvalidArgumentException If the provided URL string is empty.
	 * @return Returns TRUE if the valid string is a legitimate URL
	 */
	public static function validate($url) {
		$url = trim($url);

		if (strlen($url) <= 0) {
			throw new \InvalidArgumentException('URL string cannot be empty.', 0);
		}

		return filter_var($url, FILTER_VALIDATE_URL) === $url;
	}

	/**
	 * Url Exists
	 *
	 * Tests whether or not a URL is legitimate by looking up the
	 * URL headers.
	 *
	 * Uses error silencing on get_headers(). PHP issues warning
	 * php_network_getaddresses: getaddrinfo on some invalid URL's
	 *
	 * @param string $url Url to lookup
	 * @return Returns TRUE if the URL exists or FALSE if not.
	 */
	public static function exists($url) {

		if (!UrlValidator::validate($url)) {
			return false;
		}

		try {
			// Change default stream context. get_headers uses GET by default.
			stream_context_set_default(array (
				'http' => array (
					'method' => 'HEAD'
				)
			));

			$headers = @get_headers($url);
			if (!$headers || preg_match('/404/', $headers[0]) === 1) {
				return false;
			}
		} catch (Exception $e) {
			return false;
		}

		return true;
	}

	/**
	 * Reformat
	 *
	 * Attempts to reformat a URL string to replace missing data parts,
	 * IE if the URL does not have HTTP : or // prefixes,
	 *
	 * @param string $url Url to format
	 * @throws InvalidArgumentException If the URL string is empty
	 * @return Returns an array containing the original and reformatted URL
	 * if the new URL validates. Returns FALSE otherwise.
	 */
	public static function reformat($url) {

		$url = trim($url);
		if (strlen($url) <= 0) {
			throw new \InvalidArgumentException('URL string cannot be empty.', 0);
		}

		preg_match('/(http)?(:)?(\/\/)?(www.|www2.)?([a-zA-Z0-9-]{0,})?([.a-z]{3,4})?/i', $url, $matches);

		$prefix = (strlen($matches[1]) < 4) ? 'http' : $matches[1];
		$colon = (strlen($matches[2]) < 1) ? ':' : $matches[2];
		$slashes = (strlen($matches[3]) < 2) ? '//' : $matches[3];

		// WWW  or www2 is not required for a valid URL so accept empty results
		$www = $matches[4];
		$primaryUrl = (!isset($matches[5])) ? '' : $matches[5];
		$postfix = (!isset($matches[6])) ? '.com' : $matches[6];

		$newUrl = $prefix . $colon . $slashes . $www . $primaryUrl . $postfix;

		if (UrlValidator::validate($newUrl)) {
			return array (
				'original' => $url,
				'url' => $newUrl
			);
		}

		return false;
	}
}
