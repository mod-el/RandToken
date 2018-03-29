<?php namespace Model\RandToken;

use Model\Core\Module;

class RandToken extends Module
{
	/**
	 * @param string $seed
	 * @return string
	 */
	public function getToken(string $seed): string
	{
		if (!isset($_SESSION[SESSION_ID]['randToken-' . $seed]) or !is_string($_SESSION[SESSION_ID]['randToken-' . $seed]) or strlen($_SESSION[SESSION_ID]['randToken-' . $seed]) != 20) {
			mt_srand(array_sum(array_map(function ($l) {
				return ord($l);
			}, str_split($seed))));

			$_SESSION[SESSION_ID]['randToken-' . $seed] = '';
			for ($c = 1; $c <= 20; $c++) {
				$array_for_randomness = [mt_rand(48, 57), mt_rand(65, 90), mt_rand(97, 122)];
				$_SESSION[SESSION_ID]['randToken-' . $seed] .= chr($array_for_randomness[array_rand($array_for_randomness)]);
			}
		}
		return $_SESSION[SESSION_ID]['randToken-' . $seed];
	}
}
