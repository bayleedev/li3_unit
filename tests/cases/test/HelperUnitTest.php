<?php

namespace li3_unit\tests\cases\test;

use li3_unit\tests\mocks\test\MockHelperUnit;

class HelperUnitTest extends \lithium\test\Unit {

	protected $helperUnit;

	public function setUp() {
		$this->helperUnit = new MockHelperUnit();
	}
	public function testCreation() {
		$helper = $this->helperUnit->create('html');
		$this->assert(is_a($helper, '\\lithium\\template\\Helper'));
	}
}