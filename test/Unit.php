<?php

namespace li3_unit\test;

use ReflectionClass;

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
	 * @return bool
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
	 * @param  string $key      The key you are looking for
	 * @param  [type] $array    The array to search through
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertArrayHasKey($key, $array, $message = '{:message}') {
		return $this->assert(isset($array[$key]), $message, array(
			'expected' => $key,
			'result' => $array
		));
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
	 * @param  int    $key      Expected count
	 * @param  [type] $array    The array to search through
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertArrayNotHasKey($key, $array, $message = '{:message}') {
		return $this->assert(!isset($array[$key]), $message, array(
			'expected' => $key,
			'result' => $array
		));
	}

	/**
	 * Will mark the test true if $class has an attribute $attributeName
	 *
	 * ~~~ php
	 * $this->assertClassHasAttribute('name', '\ReflectionClass');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertClassHasAttribute('__construct', '\ReflectionClass');
	 * ~~~
	 * 
	 * @param  string        $attributeName The attribute you wish to look for
	 * @param  string|object $class         The class name or object
	 * @param  string        $message       optional
	 * @return bool
	 */
	public function assertClassHasAttribute($attributeName, $class, $message = '{:message}') {
		$object = new ReflectionClass($class);
		return $this->assert($object->hasProperty($attributeName), $message, array(
			'expected' => $attributeName,
			'result' => $object->getProperties()
		));
	}

	/**
	 * Will mark the test true if $class has an attribute $attributeName
	 *
	 * ~~~ php
	 * $this->assertClassNotHasAttribute('__construct', '\ReflectionClass');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertClassNotHasAttribute('name', '\ReflectionClass');
	 * ~~~
	 * 
	 * @throws ReflectionException If the given class does not exist
	 * @param  string        $attributeName The attribute you wish to look for
	 * @param  string|object $class         The class name or object
	 * @param  string        $message       optional
	 * @return bool
	 */
	public function assertClassNotHasAttribute($attributeName, $class, $message = '{:message}') {
		$object = new ReflectionClass($class);
		return $this->assert(!$object->hasProperty($attributeName), $message, array(
			'expected' => $attributeName,
			'result' => $object->getProperties()
		));
	}

	/**
	 * Will mark the test true if $class has a static property $attributeName
	 *
	 * ~~~ php
	 * $this->assertClassHasStaticAttribute('foobar', '\lithium\core\StaticObject');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertClassHasStaticAttribute('_methodFilters', '\lithium\core\StaticObject');
	 * ~~~
	 * 
	 * @throws ReflectionException If the given class does not exist
	 * @param  string        $attributeName The attribute you wish to look for
	 * @param  string|object $class         The class name or object
	 * @param  string        $message       optional
	 * @return bool
	 */
	public function assertClassHasStaticAttribute($attributeName, $class, $message = '{:message}') {
		$object = new ReflectionClass($class);
		if ($object->hasProperty($attributeName)) {
			$attribute = $object->getProperty($attributeName);
			return $this->assert($attribute->isStatic(), $message, array(
				'expected' => $attributeName,
				'result' => $object->getProperties()
			));
		}
		return $this->assert(false, $message, array(
			'expected' => $attributeName,
			'result' => $object->getProperties()
		));
	}

	/**
	 * Will mark the test true if $class has a static property $attributeName
	 *
	 * ~~~ php
	 * $this->assertClassNotHasStaticAttribute('_methodFilters', '\lithium\core\StaticObject');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertClassNotHasStaticAttribute('foobar', '\lithium\core\StaticObject')
	 * ~~~
	 * 
	 * @throws ReflectionException If the given class does not exist
	 * @param  string        $attributeName The attribute you wish to look for
	 * @param  string|object $class         The class name or object
	 * @param  string        $message       optional
	 * @return bool
	 */
	public function assertClassNotHasStaticAttribute($attributeName, $class, $message = '{:message}') {
		$object = new ReflectionClass($class);
		if ($object->hasProperty($attributeName)) {
			$attribute = $object->getProperty($attributeName);
			return $this->assert(!$attribute->isStatic(), $message, array(
				'expected' => $attributeName,
				'result' => $object->getProperties()
			));
		}
		return $this->assert(true, $message, array(
			'expected' => $attributeName,
			'result' => $object->getProperties()
		));
	}

	// http://www.phpunit.de/manual/current/en/writing-tests-for-phpunit.html#writing-tests-for-phpunit.assertions.assertArrayHasKey

}