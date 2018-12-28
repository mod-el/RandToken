<?php namespace Model\RandToken;

use Model\Core\Module;

class RandToken extends Module
{
	/**
	 * @param string $idx
	 * @return string
	 */
	public function getToken(string $idx, int $bytesLength = 20): string
	{
		if (!isset($_SESSION['randToken-' . $idx]) or !is_string($_SESSION['randToken-' . $idx]) or strlen($_SESSION['randToken-' . $idx]) != $bytesLength * 2)
			$_SESSION['randToken-' . $idx] = bin2hex(random_bytes($bytesLength));
		return $_SESSION['randToken-' . $idx];
	}
}
