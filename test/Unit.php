<?php

namespace li3_unit\test;

abstract class Unit extends \lithium\test\Unit {

	/**
	 * Will return true if $count and count($arr) are equal
	 * 
	 * @param  int    $count   Expected value
	 * @param  array  $array   Result
	 * @param  string $message optional
	 * @return mixed
	 */
	public function assertCount($expected, $array, $message = '{:message}') {
		if(is_array($array) || $array instanceof \Countable) {
			// Create message if it does not exist
			return $this->assert(count($result), $message, compact('expected', 'array'));
		}
		return $this->assert(false, 'Second argument must be an array or extend Countable.');
	}

	// http://www.phpunit.de/manual/current/en/writing-tests-for-phpunit.html#writing-tests-for-phpunit.assertions.assertArrayHasKey

}