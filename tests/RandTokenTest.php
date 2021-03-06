<?php

use PHPUnit\Framework\TestCase;

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

		// Retrieves a token with an index
		$token = $randToken->getToken('Foo');
		$this->assertInternalType('string', $token);
		$this->assertEquals(strlen($token), 40);

		// Retrieves another token with the same index, should be equal to the previous one
		$token2 = $randToken->getToken('Foo');
		$this->assertInternalType('string', $token2);
		$this->assertEquals($token, $token2);

		// Retrieves another token with a new index, should be different than the previous ones
		$token3 = $randToken->getToken('Bar');
		$this->assertInternalType('string', $token3);
		$this->assertEquals(strlen($token3), 40);
		$this->assertNotEquals($token, $token3);

		// Retrieves another token with a different length, should now be different than the previous ones and matching the new length
		$token4 = $randToken->getToken('Bar', 10);
		$this->assertInternalType('string', $token4);
		$this->assertEquals(strlen($token4), 20);
		$this->assertNotEquals($token4, $token3);
	}
}
