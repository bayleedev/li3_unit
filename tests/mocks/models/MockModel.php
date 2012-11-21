<?php

namespace li3_unit\tests\mocks\models;

class MockModel extends \lithium\data\Model {

	public function getName($entity) {
		return $entity->name;
	}

}