<?php

namespace li3_unit\test;

use ReflectionClass;

/**
 * Base Unit class that adds extra assertion methods
 *
 * @link http://www.phpunit.de/manual/current/en/writing-tests-for-phpunit.html
 * @link http://lithify.me/docs/manual/quality-code/testing.wiki
 */
abstract class Unit extends \lithium\test\Unit {

	/**
	 * The internal types and how to test for them
	 * @var array
	 */
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
	 * The unit object we are testing against
	 * @var object
	 */
	protected $unit;

	/**
	 * ## assertCount
	 *
	 * Will mark the test true if $count and count($arr) are equal
	 *
	 * bool assertCount( integer $expected, array $array, string $message = '{:message}' )
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
	 * ## assertNotCount
	 *
	 * Will mark the test true if $count and count($arr) are not equal
	 * 
	 * bool assertNotCount( integer $expected, array $array, string $message = '{:message}' )
	 * 
	 * ~~~ php
	 * $this->assertNotCount(2, array('foo', 'bar', 'bar')); 
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertNotCount(1, array('foo'));
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
	 * ## assertArrayHasKey
	 *
	 * Will mark the test true if $array has key $expected
	 *
	 * bool assertArrayHasKey( string $key, [type] $array, string $message = '{:message}' )
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
	 * ## assertArrayNotHasKey
	 * 
	 * Will mark the test true if $array does not have key $expected
	 *
	 * bool assertArrayNotHasKey( integer $key, [type] $array, string $message = '{:message}' )
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
	 * ## assertClassHasAttribute
	 * 
	 * Will mark the test true if $class has an attribute $attributeName
	 *
	 * bool assertClassHasAttribute( string $attributeName, string $class, string $message = '{:message}' )
	 *
	 * ~~~ php
	 * $this->assertClassHasAttribute('name', '\ReflectionClass');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertClassHasAttribute('__construct', '\ReflectionClass');
	 * ~~~
	 * 
	 * @see    self::assertObjectHasAttribute()
	 * @throws InvalidArgumentException If $class is not an object
	 * @throws ReflectionException      If the given class does not exist
	 * @param  string $attributeName    The attribute you wish to look for
	 * @param  string $class            The class name
	 * @param  string $message          optional
	 * @return bool
	 */
	public function assertClassHasAttribute($attributeName, $class, $message = '{:message}') {
		if(!is_string($class)) {
			throw new \InvalidArgumentException('Second argument $class must be a string. Type ' . gettype($class) . ' given');
		}
		$object = new ReflectionClass($class);
		return $this->assert($object->hasProperty($attributeName), $message, array(
			'expected' => $attributeName,
			'result' => $object->getProperties()
		));
	}

	/**
	 * ## assertClassNotHasAttribute
	 * 
	 * Will mark the test true if $class has an attribute $attributeName
	 *
	 * bool assertClassNotHasAttribute( string $attributeName, string $class, string $message = '{:message}' )
	 *
	 * ~~~ php
	 * $this->assertClassNotHasAttribute('__construct', '\ReflectionClass');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertClassNotHasAttribute('name', '\ReflectionClass');
	 * ~~~
	 *
	 * @see    self::assertObjectNotHasAttribute()
	 * @throws InvalidArgumentException If $class is not an object
	 * @throws ReflectionException      If the given class does not exist
	 * @param  string $attributeName    The attribute you wish to look for
	 * @param  string $class            The class name
	 * @param  string $message          optional
	 * @return bool
	 */
	public function assertClassNotHasAttribute($attributeName, $class, $message = '{:message}') {
		if(!is_string($class)) {
			throw new \InvalidArgumentException('Second argument $class must be a string. Type ' . gettype($class) . ' given');
		}
		$object = new ReflectionClass($class);
		return $this->assert(!$object->hasProperty($attributeName), $message, array(
			'expected' => $attributeName,
			'result' => $object->getProperties()
		));
	}

	/**
	 * ## assertClassHasStaticAttribute
	 * 
	 * Will mark the test true if $class has a static property $attributeName
	 *
	 * bool assertClassHasStaticAttribute( string $attributeName, string|object $class, string $message = '{:message}' )
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
	 * ## assertClassNotHasStaticAttribute
	 * 
	 * Will mark the test true if $class does not have a static property $attributeName
	 *
	 * bool assertClassNotHasStaticAttribute( string $attributeName, string|object $class, string $message = '{:message}' )
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
	 * ## assertContains
	 * 
	 * Will mark the test true if $haystack contains $needle as a value
	 *
	 * bool assertContains( string $needle, mixed $haystack, string $message = '{:message}' )
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
	 * ## assertNotContains
	 * 
	 * Will mark the test true if $haystack does not contain $needle as a value
	 *
	 * bool assertNotContains( string $needle, mixed $haystack, string $message = '{:message}' )
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
	 * ## assertContainsOnly
	 * 
	 * Will mark the test true if $haystack contains only items of $type
	 *
	 * bool assertContainsOnly( string $type, mixed $haystack, string $message = '{:message}' )
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
	 * ## assertNotContainsOnly
	 * 
	 * Will mark the test true if $haystack does not have any of $type
	 *
	 * bool assertNotContainsOnly( string $type, mixed $haystack, string $message = '{:message}' )
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
	 * ## assertContainsOnlyInstancesOf
	 * 
	 * Will mark the test true if $haystack contains only items of $type
	 *
	 * bool assertContainsOnlyInstancesOf( string $class, mixed $haystack, string $message = '{:message}' )
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
	 * ## assertEmpty
	 * 
	 * Will mark the test true if $actual is empty
	 *
	 * bool assertEmpty( string $actual, string $message = '{:message}' )
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
	 * ## assertNotEmpty
	 * 
	 * Will mark the test true if $actual is not empty
	 *
	 * bool assertNotEmpty( string $actual, string $message = '{:message}' )
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
	 * ## assertFileEquals
	 * 
	 * Will mark the test true if the contents of $expected are equal to the contents of $actual
	 *
	 * bool assertFileEquals( string $expected, string $actual, string $message = '{:message}' )
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
	 * ## assertFileNotEquals
	 * 
	 * Will mark the test true if the contents of $expected are not equal to the contents of $actual
	 *
	 * bool assertFileNotEquals( string $expected, string $actual, string $message = '{:message}' )
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
	 * ## assertFileExists
	 * 
	 * Will mark the test true if the file $actual exists
	 *
	 * bool assertFileExists( string $actual, string $message = '{:message}' )
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
	 * ## assertFileNotExists
	 * 
	 * Will mark the test true if the file $actual does not exist
	 *
	 * bool assertFileNotExists( string $actual, string $message = '{:message}' )
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
	 * ## assertGreaterThan
	 * 
	 * Will mark the test true if $expected > $actual
	 *
	 * bool assertGreaterThan( float|integer $expected, float|integer $actual, string $message = '{:message}' )
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
	 * ## assertGreaterThanOrEqual
	 * 
	 * Will mark the test true if $expected >= $actual
	 *
	 * bool assertGreaterThanOrEqual( float|integer $expected, float|integer $actual, string $message = '{:message}' )
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
	 * ## assertLessThan
	 * 
	 * Will mark the test true if $expected < $actual
	 *
	 * bool assertLessThan( float|integer $expected, float|integer $actual, string $message = '{:message}' )
	 *
	 * ~~~ php
	 * $this->assertLessThan(3, 5);
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertLessThan(5, 3);
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
	 * ## assertLessThanOrEqual
	 * 
	 * Will mark the test true if $expected <= $actual
	 *
	 * bool assertLessThanOrEqual( float|integer $expected, float|integer $actual, string $message = '{:message}' )
	 *
	 * ~~~ php
	 * $this->assertLessThanOrEqual(5, 5);
	 * ~~~
	 * 
	 * ~~~ php
	 * $this->assertLessThanOrEqual(5, 3);
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
	 * ## assertInstanceOf
	 * 
	 * Will mark the test true if $actual is a $expected
	 *
	 * bool assertInstanceOf( string $expected, object $actual, string $message = '{:message}' )
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
	 * ## assertNotInstanceOf
	 * 
	 * Will mark the test true if $actual is not a $expected
	 *
	 * bool assertNotInstanceOf( string $expected, object $actual, string $message = '{:message}' )
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
	 * ## assertInternalType
	 * 
	 * Will mark the test true if $actual if of type $expected
	 *
	 * bool assertInternalType( string $expected, object $actual, string $message = '{:message}' )
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
	 * ## assertNotInternalType
	 * 
	 * Will mark the test true if $actual if not of type $expected
	 *
	 * bool assertNotInternalType( string $expected, object $actual, string $message = '{:message}' )
	 *
	 * ~~~ php
	 * $this->assertNotInternalType('int', 'foobar');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertNotInternalType('string', 'foobar');
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
	 * ## assertNotNull
	 * 
	 * Will mark the test as true if $actual is not null
	 *
	 * bool assertNotNull( object $actual, string $message = '{:message}' )
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

	/**
	 * ## assertObjectHasAttribute
	 * 
	 * Will mark the test true if $object has an attribute $attributeName
	 *
	 * bool assertObjectHasAttribute( string $attributeName, string $object, string $message = '{:message}' )
	 *
	 * ~~~ php
	 * $this->assertObjectHasAttribute('name', '\ReflectionClass');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertObjectHasAttribute('__construct', '\ReflectionClass');
	 * ~~~
	 *
	 * @see    self::assertClassHasAttribute()
	 * @throws InvalidArgumentException If $object is not an object
	 * @param  string $attributeName    The attribute you wish to look for
	 * @param  string $object           The object to assert
	 * @param  string $message          optional
	 * @return bool
	 */
	public function assertObjectHasAttribute($attributeName, $object, $message = '{:message}') {
		if(!is_object($object)) {
			throw new \InvalidArgumentException('Second argument $object must be an object. Type ' . gettype($object) . ' given');
		}
		$object = new ReflectionClass($object);
		return $this->assert($object->hasProperty($attributeName), $message, array(
			'expected' => $attributeName,
			'result' => $object->getProperties()
		));
	}

	/**
	 * ## assertObjectNotHasAttribute
	 * 
	 * Will mark the test true if $object has an attribute $attributeName
	 *
	 * bool assertObjectNotHasAttribute( string $attributeName, string $object, string $message = '{:message}' )
	 *
	 * ~~~ php
	 * $this->assertObjectNotHasAttribute('__construct', '\ReflectionClass');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertObjectNotHasAttribute('name', '\ReflectionClass');
	 * ~~~
	 *
	 * @see    self::assertClassHasNotAttribute()
	 * @throws InvalidArgumentException If $object is not an object
	 * @param  string $attributeName    The attribute you wish to look for
	 * @param  string $object           The object to assert
	 * @param  string $message          optional
	 * @return bool
	 */
	public function assertObjectNotHasAttribute($attributeName, $object, $message = '{:message}') {
		if(!is_object($object)) {
			throw new \InvalidArgumentException('Second argument $object must be an object. Type ' . gettype($object) . ' given');
		}
		$object = new ReflectionClass($object);
		return $this->assert(!$object->hasProperty($attributeName), $message, array(
			'expected' => $attributeName,
			'result' => $object->getProperties()
		));
	}

	/**
	 * ## assertRegExp
	 * 
	 * Will mark the test true if $actual matches $expected using preg_match
	 *
	 * bool assertRegExp( string $expected, string $actual, string $message = '{:message}' )
	 *
	 * ~~~ php
	 * $this->assertRegExp('/^foo/', 'foobar');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertRegExp('/^foobar/', 'bar');
	 * ~~~
	 * 
	 * @param  string $expected A regex to match against $actual
	 * @param  string $actual   The string to be matched upon
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertRegExp($expected, $actual, $message = '{:message}') {
		return $this->assert(preg_match($expected, $actual, $matches) === 1, $message, array(
			'expected' => $expected,
			'result' => $matches
		));
	}

	/**
	 * ## assertNotRegExp
	 * 
	 * Will mark the test true if $actual does not match $expected using preg_match
	 *
	 * bool assertNotRegExp( string $expected, string $actual, string $message = '{:message}' )
	 *
	 * ~~~ php
	 * $this->assertNotRegExp('/^foobar/', 'bar');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertNotRegExp('/^foo/', 'foobar');
	 * ~~~
	 * 
	 * @param  string $expected A regex to match against $actual
	 * @param  string $actual   The string to be matched upon
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertNotRegExp($expected, $actual, $message = '{:message}') {
		return $this->assert(preg_match($expected, $actual, $matches) === 0, $message, array(
			'expected' => $expected,
			'result' => $matches
		));
	}

	/**
	 * ## assertStringMatchesFormat
	 * 
	 * Will mark the test true if $actual matches $expected using PHP's build in sprintf format
	 *
	 * NOTICE: This differs from how PHPUnit does this same assertion method
	 *
	 * bool assertStringMatchesFormat( string $expected, string $actual, string $message = '{:message}' )
	 *
	 * ~~~ php
	 * $this->assertStringMatchesFormat('%d', '10')
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertStringMatchesFormat('%d', '10.555')
	 * ~~~
	 * 
	 * @link   http://php.net/sprintf
	 * @link   http://php.net/sscanf
	 * @param  string $expected The expected format using sscanf's format
	 * @param  string $actual   The value to compare against
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertStringMatchesFormat($expected, $actual, $message = '{:message}') {
		$result = sscanf($actual, $expected);
		return $this->assert($result[0] == $actual, $message, compact('expected', 'result'));
	}

	/**
	 * ## assertStringNotMatchesFormat
	 * 
	 * Will mark the test true if $actual doesn't match $expected using PHP's build in sprintf format
	 *
	 * NOTICE: This differs from how PHPUnit does this same assertion method
	 *
	 * bool assertStringNotMatchesFormat( string $expected, string $actual, string $message = '{:message}' )
	 *
	 * ~~~ php
	 * $this->assertStringNotMatchesFormat('%d', '10.555')
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertStringNotMatchesFormat('%d', '10')
	 * ~~~
	 * 
	 * @link   http://php.net/sprintf
	 * @link   http://php.net/sscanf
	 * @param  string $expected The expected format using sscanf's format
	 * @param  string $actual   The value to compare against
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertStringNotMatchesFormat($expected, $actual, $message = '{:message}') {
		$result = sscanf($actual, $expected);
		return $this->assert($result[0] != $actual, $message, compact('expected', 'result'));
	}

	/**
	 * ## assertStringEndsWith
	 * 
	 * Will mark the test true if $actual ends with $expected
	 *
	 * bool assertStringEndsWith( string $expected, string $actual, string $message = '{:message}' )
	 *
	 * ~~~ php
	 * $this->assertStringEndsWith('bar', 'foobar');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertStringEndsWith('foo', 'foobar');
	 * ~~~
	 * 
	 * @param  string $expected The suffix to check for
	 * @param  string $actual   The value to test against
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertStringEndsWith($expected, $actual, $message = '{:message}') {
		return $this->assert(preg_match("/$expected$/", $actual, $matches) === 1, $message, array(
			'expected' => $expected,
			'result' => $actual
		));
	}

	/**
	 * ## assertStringStartsWith
	 * 
	 * Will mark the test true if $actual starts with $expected
	 *
	 * bool assertStringStartsWith( string $expected, string $actual, string $message = '{:message}' )
	 *
	 * ~~~ php
	 * $this->assertStringStartsWith('foo', 'foobar');
	 * ~~~
	 *
	 * ~~~ php
	 * $this->assertStringStartsWith('bar', 'foobar');
	 * ~~~
	 * 
	 * @param  string $expected The prefix to check for
	 * @param  string $actual   The value to test against
	 * @param  string $message  optional
	 * @return bool
	 */
	public function assertStringStartsWith($expected, $actual, $message = '{:message}') {
		return $this->assert(preg_match("/^$expected/", $actual, $matches) === 1, $message, array(
			'expected' => $expected,
			'result' => $actual
		));
	}

}