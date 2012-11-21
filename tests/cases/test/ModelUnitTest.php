<?php

namespace li3_unit\tests\cases\test;

use li3_unit\tests\mocks\test\MockModelUnit;

class ModelUnitTest extends \lithium\test\Unit {

	protected $modelUnit;

	public function setUp() {
		\lithium\data\Connections::add('li3_unit_mock_default', array(
			'type' => 'database',
			'adapter' => 'Sqlite3',
			'database' => LITHIUM_APP_PATH . '/resources/db/demo.sqlite'
		));
		$this->modelUnit = new MockModelUnit();
	}
	public function testCreation() {
		$this->modelUnit->model = "li3_unit\\tests\\mocks\\models\\MockModel";
		$model = $this->modelUnit->create();
		$this->assertEqual($model->model(), "li3_unit\\tests\\mocks\\models\\MockModel");
	}

	public function testGettingData() {
		$this->modelUnit->model = "li3_unit\\tests\\mocks\\models\\MockModel";
		$model = $this->modelUnit->create(array(
			'name' => 'BlaineSch'
		));
		$this->assertEqual($model->name, 'BlaineSch');
	}

	public function testCallingMethod() {
		$this->modelUnit->model = "li3_unit\\tests\\mocks\\models\\MockModel";
		$model = $this->modelUnit->create(array(
			'fname' => 'Blaine',
			'lname' => 'Sch'
		));
		$this->assertEqual($model->fullName(), 'Blaine Sch');
	}
}