<?php namespace Model\RandToken;

use Model\Core\Module;

class RandToken extends Module
{
	/**
	 * @param string $idx
	 * @return string
	 */
	public function getToken(string $idx): string
	{
		if (!isset($_SESSION[SESSION_ID]['randToken-' . $idx]) or !is_string($_SESSION[SESSION_ID]['randToken-' . $idx]) or strlen($_SESSION[SESSION_ID]['randToken-' . $idx]) != 20)
			$_SESSION[SESSION_ID]['randToken-' . $idx] = bin2hex(random_bytes(10));
		return $_SESSION[SESSION_ID]['randToken-' . $idx];
	}
}
