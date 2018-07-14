<?php
#require_once '../bootstrap.php';

use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase {

	public function tearUp() {

	}

	public function testAppPath() {
		$currentDir = explode('/', __DIR__);
		$removeLast = array_splice($currentDir, -1);
		$this->assertEquals(implode('/', $currentDir), app_path());
	}

}