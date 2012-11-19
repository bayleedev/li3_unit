<?php

namespace li3_unit\test;

abstract class Unit extends \lithium\test\Unit {

	/**
	 * Will mark the test true if $count and count($arr) are equal
	 *
	 * ~~~ php
	 * $this->assertCount(1, array('foo'));
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertCount(2, array('foo', 'bar', 'bar')); 
	 * ~~~
	 * 
	 * @param  int    $expected Expected count
	 * @param  array  $array    Result
	 * @param  string $message  optional
	 * @return mixed
	 */
	public function assertCount($expected, $array, $message = '{:message}') {
		return $this->assert($expected === ($result = count($array)), $message, compact('expected', 'result'));
	}

	/**
	 * Will mark the test true if $array has key $expected
	 *
	 * ~~~ php
	 * $this->assertArrayHasKey('foo', array('bar' => 'baz'));
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertArrayHasKey('bar', array('bar' => 'baz'));
	 * ~~~
	 * 
	 * @param  [type] $expected [description]
	 * @param  [type] $array    [description]
	 * @param  string $message  [description]
	 * @return [type]           [description]
	 */
	public function assertArrayHasKey($expected, $result, $message = '{:message}') {
		return $this->assert(isset($result[$expected]), $message, compact('expected', 'result'));
	}

	/**
	 * Will mark the test true if $array has key $expected
	 *
	 * ~~~ php
	 * $this->assertArrayNotHasKey('foo', array('bar' => 'baz'));
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertArrayNotHasKey('bar', array('bar' => 'baz'));
	 * ~~~
	 * 
	 * @param  [type] $expected [description]
	 * @param  [type] $array    [description]
	 * @param  string $message  [description]
	 * @return [type]           [description]
	 */
	public function assertArrayNotHasKey($expected, $result, $message = '{:message}') {
		return $this->assert(!isset($result[$expected]), $message, compact('expected', 'result'));
	}

	// http://www.phpunit.de/manual/current/en/writing-tests-for-phpunit.html#writing-tests-for-phpunit.assertions.assertArrayHasKey

}