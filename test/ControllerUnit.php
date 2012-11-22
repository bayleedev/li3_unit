<?php

namespace li3_unit\test;

use lithium\action\Request;

abstract class ControllerUnit extends Unit {

	/**
	 * A copy of the created request for no real reason
	 * @var  object
	 */
	public $request = null;

	/**
	 * The full namespace of the controller
	 * @var string
	 */
	public $controller = ""; 

	/**
	 * Will create a new instance of the controller for you to use
	 * @param  string $action the method on the controller you wish to run
	 * @param  array $options The various options you can find
	 * @return object the created controller
	 */
	public function call($action, array $options = array()) {
		// Setup options
		if(!isset($options['params'])) {
			$options['params'] = array();
		}
		preg_match('/^.*\\\(.*)Controller$/i', $this->controller, $matches);
		list(,$baseController) = $matches; // Find controller name
		$options['params'] += array(
			'controller' => $baseController,
			'action' => $action,
		);

		// Create request
		$this->request = new Request($options);

		// Save params
		$this->request->params = isset($options['params']) ? $options['params'] : $this->request->params;

		// Create controller
		$controller = $this->controller;
		$controller = new $controller(array('request' => $this->request));

		// Call action and return
		return $controller->$action();
	}

}