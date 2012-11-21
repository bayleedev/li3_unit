<?php

namespace li3_unit\tests\mocks\models;

class MockModel extends \lithium\data\Model {

	public $_meta = array('connection' => 'li3_unit_mock_default');

	public function fullName($entity) {
		return $entity->fname . ' ' . $entity->lname;
	}

}