<?php

namespace li3_unit\tests\mocks\controllers;

class MockController extends \lithium\data\Model {

	public function view() {
		return array(
			'location' => 'Tulsa, Oklahoma'
		);
	}

}