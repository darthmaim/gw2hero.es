<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends TestCase {
	use DatabaseMigrations;

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$response = $this->call('GET', '/');

		$this->assertEquals(200, $response->getStatusCode());
	}

}
