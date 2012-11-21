<?php

namespace li3_unit\test;

use lithium\action\Request,
	lithium\tests\mocks\template\MockRenderer;

abstract class HelperUnit extends Unit {

	/**
	 * Will create a new renderer with a request, and pull a helper out of it.
	 * @param  string $helper The name of the helper.
	 * @return object         The generated helper.
	 */
	public function create($helper) {
		$_context = new MockRenderer(array(
			'request' => new Request(array()),
		));
		$helper = $_context->helper($helper);
		return $helper;
	}
}