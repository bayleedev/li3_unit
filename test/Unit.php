<?php

namespace li3_unit\test;

use ReflectionClass;

abstract class Unit extends \lithium\test\Unit {

	static protected $_internalTypes = array(
		'array' => 'is_array',
		'bool' => 'is_bool',
		'callable' => 'is_callable',
		'double' => 'is_double',
		'float' => 'is_float',
		'int' => 'is_int',
		'integer' => 'is_integer',
		'long' => 'is_long',
		'null' => 'is_null',
		'numeric' => 'is_numeric',
		'object' => 'is_object',
		'real' => 'is_real',
		'resource' => 'is_resource',
		'scalar' => 'is_scalar',
		'string' => 'is_string'
	);

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
	 * Will mark the test true if $count and count($arr) are not equal
	 * 
	 * ~~~ php
	 * $this->assertCount(2, array('foo', 'bar', 'bar')); 
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertCount(1, array('foo'));
	 * ~~~
	 * 
	 * @param  int    $expected Expected count
	 * @param  array  $array    Result
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertNotCount($expected, $array, $message = '{:message}') {
		return $this->assert($expected !== ($result = count($array)), $message, compact('expected', 'result'));
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
	 * Will mark the test true if $array does not have key $expected
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
	 * Will mark the test true if $class does not have a static property $attributeName
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

	/**
	 * Will mark the test true if $haystack contains $needle as a value
	 * 
	 * ~~~ php
	 * $this->assertContains('foo', array('foo', 'bar', 'baz'));
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertContains(4, array(1,2,3));
	 * ~~~
	 * 
	 * @param  string $needle   The needle you are looking for
	 * @param  mixed  $haystack An array, iterable object, or string
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertContains($needle, $haystack, $message = '{:message}') {
		if(is_string($haystack)) {
			return $this->assert(strpos($haystack, $needle) !== false, $message, array(
				'expected' => $needle,
				'result' => $haystack
			));
		}
		foreach($haystack as $key => $value) {
			if($value === $needle) {
				return $this->assert(true, $message, array(
					'expected' => $needle,
					'result' => $haystack
				));
			}
		}
		return $this->assert(false, $message, array(
			'expected' => $needle,
			'result' => $haystack
		));
	}

	/**
	 * Will mark the test true if $haystack does not contain $needle as a value
	 * 
	 * ~~~ php
	 * $this->assertNotContains(4, array(1,2,3));
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertNotContains('foo', array('foo', 'bar', 'baz'));
	 * ~~~
	 * 
	 * @param  string $needle   The needle you are looking for
	 * @param  mixed  $haystack An array, iterable object, or string
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertNotContains($needle, $haystack, $message = '{:message}') {
		if(is_string($haystack)) {
			return $this->assert(strpos($haystack, $needle) === false, $message, array(
				'expected' => $needle,
				'result' => $haystack
			));
		}
		foreach($haystack as $key => $value) {
			if($value === $needle) {
				return $this->assert(false, $message, array(
					'expected' => $needle,
					'result' => $haystack
				));
			}
		}
		return $this->assert(true, $message, array(
			'expected' => $needle,
			'result' => $haystack
		));
	}

	/**
	 * Will mark the test true if $haystack contains only items of $type
	 * 
	 * ~~~ php
	 * $this->assertContainsOnly('int', array(1,2,3));
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertContainsOnly('int', array('foo', 'bar', 'baz'));
	 * ~~~
	 * 
	 * @param  string $type     The data type to check for array|bool|callable|double|float|int|integer|long|null|numeric|object|real|resource|scalar|string
	 * @param  mixed  $haystack An array or iterable object
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertContainsOnly($type, $haystack, $message = '{:message}') {
		$method = self::$_internalTypes[$type];
		foreach($haystack as $key => $value) {
			if(!$method($value)) {
				return $this->assert(false, $message, array(
					'expected' => $type,
					'result' => $haystack
				));
			}
		}
		return $this->assert(true, $message, array(
			'expected' => $type,
			'result' => $haystack
		));
	}

	/**
	 * Will mark the test true if $haystack does not have any of $type
	 * 
	 * ~~~ php
	 * $this->assertNotContainsOnly('int', array('foo', 'bar', 'baz'));
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertNotContainsOnly('int', array(1,2,3));
	 * ~~~
	 * 
	 * @param  string $type     The data type to check for array|bool|callable|double|float|int|integer|long|null|numeric|object|real|resource|scalar|string
	 * @param  mixed  $haystack An array or iterable object
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertNotContainsOnly($type, $haystack, $message = '{:message}') {
		$method = self::$_internalTypes[$type];
		foreach($haystack as $key => $value) {
			if(!$method($value)) {
				return $this->assert(true, $message, array(
					'expected' => $type,
					'result' => $haystack
				));
			}
		}
		return $this->assert(false, $message, array(
			'expected' => $type,
			'result' => $haystack
		));
	}

	/**
	 * Will mark the test true if $haystack contains only items of $type
	 * 
	 * ~~~ php
	 * $this->assertContainsOnlyInstancesOf('stdClass', array(new \stdClass));
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertContainsOnlyInstancesOf('stdClass', array(new \lithium\test\Unit));
	 * ~~~
	 * 
	 * @param  string $class    The fully namespaced class name
	 * @param  mixed  $haystack An array or iterable object
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertContainsOnlyInstancesOf($class, $haystack, $message = '{:message}') {
		$result = array();
		foreach($haystack as $key => &$value) {
			if(!is_a($value, $class)) {
				$result[$key] =& $value;
				break;
			}
		}
		return $this->assert(empty($result), $message, array(
			'expected' => $class,
			'result' => $result
		));
	}

	/**
	 * Will mark the test true if $actual is empty
	 * 
	 * ~~~ php
	 * $this->assertEmpty(1);
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertEmpty(array());
	 * ~~~
	 * 
	 * @param  string $actual   The variable to check
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertEmpty($actual, $message = '{:message}') {
		return $this->assert(empty($actual), $message, array(
			'expected' => $actual,
			'result' => empty($actual)
		));
	}

	/**
	 * Will mark the test true if $actual is not empty
	 * 
	 * ~~~ php
	 * $this->assertNotEmpty(array());
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertNotEmpty(1);
	 * ~~~
	 * 
	 * @param  string $actual   The variable to check
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertNotEmpty($actual, $message = '{:message}') {
		return $this->assert(!empty($actual), $message, array(
			'expected' => $actual,
			'result' => !empty($actual)
		));
	}

	/**
	 * Will mark the test true if the contents of $expected are equal to the contents of $actual
	 *
	 * ~~~ php
	 * $this->assertFileEquals(LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md', LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md.copy');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertFileEquals(LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md', LITHIUM_APP_PATH . '/tests/mocks/md/file_2.md');
	 * ~~~
	 * 
	 * @param  string $expected The path to the expected file
	 * @param  string $actual   The path to the actual file
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertFileEquals($expected, $actual, $message = '{:message}') {
		$expected = md5_file($expected);
		$result = md5_file($actual);
		return $this->assert($expected === $result, $message, compact('expected', 'result'));
	}

	/**
	 * Will mark the test true if the contents of $expected are not equal to the contents of $actual
	 *
	 * ~~~ php
	 * $this->assertFileNotEquals(LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md', LITHIUM_APP_PATH . '/tests/mocks/md/file_2.md');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertFileNotEquals(LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md', LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md.copy');
	 * ~~~
	 * 
	 * @param  string $expected The path to the expected file
	 * @param  string $actual   The path to the actual file
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertFileNotEquals($expected, $actual, $message = '{:message}') {
		$expected = md5_file($expected);
		$result = md5_file($actual);
		return $this->assert($expected !== $result, $message, compact('expected', 'result'));
	}

	/**
	 * Will mark the test true if the file $actual exists
	 *
	 * ~~~ php
	 * $this->assertFileExists(LITHIUM_APP_PATH . '/readme.md');
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertFileExists(LITHIUM_APP_PATH . '/does/not/exist.txt');
	 * ~~~
	 * 
	 * @param  string $actual  The path to the file you are asserting
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertFileExists($actual, $message = '{:message}') {
		return $this->assert(file_exists($actual), $message, array(
			'expected' => $actual,
			'result' => file_exists($actual)
		));
	}

	/**
	 * Will mark the test true if the file $actual does not exist
	 * 
	 * ~~~ php
	 * $this->assertFileExists(LITHIUM_APP_PATH . '/does/not/exist.txt');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertFileExists(LITHIUM_APP_PATH . '/readme.md');
	 * ~~~
	 * 
	 * @param  string $actual  The path to the file you are asserting
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertFileNotExists($actual, $message = '{:message}') {
		return $this->assert(!file_exists($actual), $message, array(
			'expected' => $actual,
			'result' => !file_exists($actual)
		));
	}

	/**
	 * Will mark the test true if $expected > $actual
	 *
	 * ~~~ php
	 * $this->assertGreaterThan(5, 3);
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertGreaterThan(3, 5);
	 * ~~~
	 * 
	 * @param  float|int $expected
	 * @param  float|int $actual
	 * @param  string    $message  optional
	 * @return bool
	 */
	public function assertGreaterThan($expected, $actual, $message = '{:message}') {
		return $this->assert($expected > $actual, $message, array(
			'expected' => $expected,
			'result' => $actual
		));
	}

	/**
	 * Will mark the test true if $expected >= $actual
	 *
	 * ~~~ php
	 * $this->assertGreaterThanOrEqual(5, 5);
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertGreaterThanOrEqual(3, 5);
	 * ~~~
	 * 
	 * @param  float|int $expected
	 * @param  float|int $actual
	 * @param  string    $message  optional
	 * @return bool
	 */
	public function assertGreaterThanOrEqual($expected, $actual, $message = '{:message}') {
		return $this->assert($expected >= $actual, $message, array(
			'expected' => $expected,
			'result' => $actual
		));
	}

	/**
	 * Will mark the test true if $expected < $actual
	 *
	 * ~~~ php
	 * $this->assertGreaterThanOrEqual(3, 5);
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertGreaterThanOrEqual(5, 3);
	 * ~~~
	 * 
	 * @param  float|int $expected
	 * @param  float|int $actual
	 * @param  string    $message  optional
	 * @return bool
	 */
	public function assertLessThan($expected, $actual, $message = '{:message}') {
		return $this->assert($expected < $actual, $message, array(
			'expected' => $expected,
			'result' => $actual
		));
	}

	/**
	 * Will mark the test true if $expected <= $actual
	 *
	 * ~~~ php
	 * $this->assertGreaterThanOrEqual(5, 5);
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertGreaterThanOrEqual(5, 3);
	 * ~~~
	 * 
	 * @param  float|int $expected
	 * @param  float|int $actual
	 * @param  string    $message  optional
	 * @return bool
	 */
	public function assertLessThanOrEqual($expected, $actual, $message = '{:message}') {
		return $this->assert($expected <= $actual, $message, array(
			'expected' => $expected,
			'result' => $actual
		));
	}

	/**
	 * Will mark the test true if $actual is a $expected
	 *
	 * ~~~ php
	 * $this->assertInstanceOf('stdClass', new stdClass);
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertInstanceOf('ReflectionClass', new stdClass);
	 * ~~~
	 * 
	 * @param  string $expected The fully namespaced expected class
	 * @param  object $actual   The object you are testing
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertInstanceOf($expected, $actual, $message = '{:message}') {
		return $this->assert(is_a($actual, $expected), $message, array(
			'expected' => $expected,
			'result' => get_class($actual)
		));
	}

	/**
	 * Will mark the test true if $actual is not a $expected
	 *
	 * ~~~ php
	 * $this->assertNotInstanceOf('ReflectionClass', new stdClass);
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertNotInstanceOf('stdClass', new stdClass);
	 * ~~~
	 * 
	 * @param  string $expected The fully namespaced expected class
	 * @param  object $actual   The object you are testing
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertNotInstanceOf($expected, $actual, $message = '{:message}') {
		return $this->assert(!is_a($actual, $expected), $message, array(
			'expected' => $expected,
			'result' => get_class($actual)
		));
	}

	/**
	 * Will mark the test true if $actual if of type $expected
	 *
	 * ~~~ php
	 * $this->assertInternalType('string', 'foobar');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertInternalType('int', 'foobar');
	 * ~~~
	 * 
	 * @param  string $expected The internal data type: array|bool|callable|double|float|int|integer|long|null|numeric|object|real|resource|scalar|string
	 * @param  object $actual   The object you are testing
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertInternalType($expected, $actual, $message = '{:message}') {
		$method = self::$_internalTypes[$expected];
		return $this->assert($method($actual), $message, array(
			'expected' => $expected,
			'result' => gettype($actual)
		));
	}

	/**
	 * Will mark the test true if $actual if not of type $expected
	 *
	 * ~~~ php
	 * $this->assertInternalType('int', 'foobar');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertInternalType('string', 'foobar');
	 * ~~~
	 * 
	 * @param  string $expected The internal data type: array|bool|callable|double|float|int|integer|long|null|numeric|object|real|resource|scalar|string
	 * @param  object $actual   The object you are testing
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertNotInternalType($expected, $actual, $message = '{:message}') {
		$method = self::$_internalTypes[$expected];
		return $this->assert(!$method($actual), $message, array(
			'expected' => $expected,
			'result' => gettype($actual)
		));
	}

	/**
	 * Will mark the test as true if $actual is not null
	 * 
	 * ~~~ php
	 * $this->assertNotNull(1);
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertNotNull(null);
	 * ~~~
	 * 
	 * @param  object $actual   The variable you are testing
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertNotNull($actual, $message = '{:message}') {
		return $this->assert(!is_null($actual), $message, array(
			'expected' => null,
			'actual' => gettype($actual)
		));
	}

	// http://www.phpunit.de/manual/current/en/writing-tests-for-phpunit.html#writing-tests-for-phpunit.assertions.assertArrayHasKey

}