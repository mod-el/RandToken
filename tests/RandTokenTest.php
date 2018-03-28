<?php

use PHPUnit\Framework\TestCase;

define('SESSION_ID', 'test');

require('..' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . 'Module.php');
require('RandToken.php');

class RandTokenTest extends TestCase
{
	private $model = null;

	private function getModelCore()
	{
		if (!$this->model) {
			$this->model = $this->getMockBuilder('\\Model\\Core\\Core')->getMock();
		}

		return $this->model;
	}

	public function testCreationAndStoringOfToken()
	{
		$randToken = new Model\RandToken\RandToken($this->getModelCore());

		// Retrieves a token with a seed
		$token = $randToken->getToken('Foo');
		$this->assertInternalType('string', $token);
		$this->assertEquals(strlen($token), 20);

		// Retrieves another token with the same seed, should be equal to the previous one
		$token2 = $randToken->getToken('Foo');
		$this->assertInternalType('string', $token2);
		$this->assertEquals($token, $token2);

		// Retrieves another token with a new seed, should be different than the previous ones
		$token3 = $randToken->getToken('Bar');
		$this->assertInternalType('string', $token3);
		$this->assertEquals(strlen($token3), 20);
		$this->assertNotEquals($token, $token3);
	}
}
