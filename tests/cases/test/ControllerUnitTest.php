<?php

namespace li3_unit\tests\cases\test;

use li3_unit\tests\mocks\test\MockControllerUnit;

class ControllerUnitTest extends \lithium\test\Unit {

	protected $controllerUnit;

	public function setUp() {
		$this->controllerUnit = new MockControllerUnit();
	}
	public function testCreation() {
		$this->controllerUnit->controller = '\\li3_unit\\tests\\mocks\\controllers\\MockController';
		$data = $this->controllerUnit->call('view');
		$this->assertEqual(array(
			'location' => 'Tulsa, Oklahoma'
		), $data);
	}
}