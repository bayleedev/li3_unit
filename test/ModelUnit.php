<?php

namespace li3_unit\test;

use lithium\action\Request;

abstract class ModelUnit extends Unit {

	/**
	 * The full namespace of the model
	 * @var string
	 */
	public $model = "";

	/**
	 * The default model data should be overwritten
	 * @var array
	 */
	public $defaultData = array();

	/**
	 * Will create a new instance of a model with the given data merged with the default data.
	 * @param  array  $data The new data to overwrite the default.
	 * @return object       The newly created model.
	 */
	public function create(array $data = array()) {
		$data += $this->defaultData;
		$class = $this->model;
		return $class::create($data);
	}

}