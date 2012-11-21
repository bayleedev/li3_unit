<?php

namespace li3_unit\tests\cases\test;

use li3_unit\tests\mocks\test\MockUnit;

class UnitTest extends \lithium\test\Unit {

	public function setUp() {
		$this->unit = new MockUnit();
	}

	public function testAssertCountTrue() {
		$this->assertTrue($this->unit->assertCount(1, array('foo')));
	}

	public function testAssertCountFalse() {
		$this->assertFalse($this->unit->assertCount(2, array('foo', 'bar', 'bar')));
	}

	public function testAssertCountFalseResults() {
		$this->unit->assertCount(2, array('foo', 'bar', 'bar'));
		
		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertIdentical(array(
			'expected' => 2,
			'result' => 3
		), $result['data']);
	}

	public function testAssertNotCountTrue() {
		$this->assertTrue($this->unit->assertNotCount(2, array('foo', 'bar', 'bar')));
	}

	public function testAssertNotCountFalse() {
		$this->assertFalse($this->unit->assertNotCount(1, array('foo')));
	}

	public function testAssertNotCountFalseResults() {
		$this->unit->assertNotCount(1, array('foo'));
		
		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertIdentical(array(
			'expected' => 1,
			'result' => 1
		), $result['data']);
	}

	public function testArrayHasKeyTrue() {
		$this->assertTrue($this->unit->assertArrayHasKey('bar', array('bar' => 'baz')));
	}

	public function testArrayHasKeyFalse() {
		$this->assertFalse($this->unit->assertArrayHasKey('foo', array('bar' => 'baz')));
	}

	public function testArrayHasKeyFalseResults() {
		$this->assertFalse($this->unit->assertArrayHasKey('foo', array('bar' => 'baz')));
		
		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertIdentical(array(
			'expected' => 'foo',
			'result' => array('bar' => 'baz')
		), $result['data']);
	}

	public function testArrayNotHasKeyTrue() {
		$this->assertTrue($this->unit->assertArrayNotHasKey('foo', array('bar' => 'baz')));
	}

	public function testArrayNotHasKeyFalse() {
		$this->assertFalse($this->unit->assertArrayNotHasKey('bar', array('bar' => 'baz')));
	}

	public function testArrayNotHasKeyFalseResults() {
		$this->assertFalse($this->unit->assertArrayNotHasKey('bar', array('bar' => 'baz')));
		
		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertIdentical(array(
			'expected' => 'bar',
			'result' => array('bar' => 'baz')
		), $result['data']);
	}

	public function testClassHasAttributeTrue() {
		$this->assertTrue($this->unit->assertClassHasAttribute('name', '\ReflectionClass'));
	}

	public function testClassHasAttributeFalse() {
		$this->assertFalse($this->unit->assertClassHasAttribute('foo', '\ReflectionClass'));
	}

	public function testClassHasAttributeFalseResults() {
		$this->assertFalse($this->unit->assertClassHasAttribute('foo', '\ReflectionClass'));
		
		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => 'foo',
			'result' => array(
				new \ReflectionProperty('ReflectionClass', 'name')
			)
		), $result['data']);
	}

	public function testClassHasAttributeClassNotFound() {
		$self =& $this;
		$this->assertException('ReflectionException', function() use($self) {
			$self->unit->assertClassHasAttribute('foo', '\foo\bar\baz');
		});
	}

	public function testClassNotHasAttributeTrue() {
		$this->assertTrue($this->unit->assertClassNotHasAttribute('foo', '\ReflectionClass'));
	}

	public function testClassNotHasAttributeFalse() {
		$this->assertFalse($this->unit->assertClassNotHasAttribute('name', '\ReflectionClass'));
	}

	public function testClassNotHasAttributeFalseResults() {
		$this->assertFalse($this->unit->assertClassNotHasAttribute('name', '\ReflectionClass'));
		
		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => 'name',
			'result' => array(
				new \ReflectionProperty('ReflectionClass', 'name')
			)
		), $result['data']);
	}

	public function testClassNotHasAttributeClassNotFound() {
		$self =& $this;
		$this->assertException('ReflectionException', function() use($self) {
			$self->unit->assertClassNotHasAttribute('foo', '\foo\bar\baz');
		});
	}

	public function testClassHasStaticAttributeTrue() {
		$this->assertTrue($this->unit->assertClassHasStaticAttribute('_methodFilters', '\lithium\core\StaticObject'));
	}

	public function testClassHasStaticAttributeFalse() {
		$this->assertFalse($this->unit->assertClassHasStaticAttribute('foobar', '\lithium\core\StaticObject'));
	}

	public function testClassHasStaticAttributeFalseResults() {
		$this->assertFalse($this->unit->assertClassHasStaticAttribute('foobar', '\lithium\core\StaticObject'));
		
		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => 'foobar',
			'result' => array(
				new \ReflectionProperty('lithium\\core\\StaticObject', '_methodFilters'),
				new \ReflectionProperty('lithium\\core\\StaticObject', '_parents')
			)
		), $result['data']);
	}

	public function testClassHasStaticAttributeClassNotFound() {
		$self =& $this;
		$this->assertException('ReflectionException', function() use($self) {
			$self->unit->assertClassHasStaticAttribute('foo', '\foo\bar\baz');
		});
	}

	public function testClassNotHasStaticAttributeTrue() {
		$this->assertTrue($this->unit->assertClassNotHasStaticAttribute('foobar', '\lithium\core\StaticObject'));
	}

	public function testClassNotHasStaticAttributeFalse() {
		$this->assertFalse($this->unit->assertClassNotHasStaticAttribute('_methodFilters', '\lithium\core\StaticObject'));
	}

	public function testClassNotHasStaticAttributeFalseResults() {
		$this->assertFalse($this->unit->assertClassNotHasStaticAttribute('_methodFilters', '\lithium\core\StaticObject'));
		
		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => '_methodFilters',
			'result' => array(
				new \ReflectionProperty('lithium\\core\\StaticObject', '_methodFilters'),
				new \ReflectionProperty('lithium\\core\\StaticObject', '_parents')
			)
		), $result['data']);
	}

	public function testClassNotHasStaticAttributeClassNotFound() {
		$self =& $this;
		$this->assertException('ReflectionException', function() use($self) {
			$self->unit->assertClassNotHasStaticAttribute('foo', '\foo\bar\baz');
		});
	}

	public function testAssertContainsStringInStrTrue() {
		$this->assertTrue($this->unit->assertContains('foo', 'foobar'));
	}

	public function testAssertContainsStringInStrFalse() {
		$this->assertFalse($this->unit->assertContains('baz', 'foobar'));
	}

	public function testAssertContainsTrue() {
		$this->assertTrue($this->unit->assertContains('bar', array('foo', 'bar', 'baz')));
	}

	public function testAssertContainsFalse() {
		$this->assertFalse($this->unit->assertContains('foobar', array('foo', 'bar', 'baz')));
	}

	public function testAssertContainsFalseResults() {
		$this->unit->assertContains('foobar', array('foo', 'bar', 'baz'));

		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => 'foobar',
			'result' => array(
				'foo', 'bar', 'baz'
			)
		), $result['data']);
	}

	public function testAssertNotContainsStringInStrTrue() {
		$this->assertTrue($this->unit->assertNotContains('baz', 'foobar'));
	}

	public function testAssertNotContainsStringInStrFalse() {
		$this->assertFalse($this->unit->assertNotContains('foo', 'foobar'));
	}

	public function testAssertNotContainsTrue() {
		$this->assertTrue($this->unit->assertNotContains('foobar', array('foo', 'bar', 'baz')));
	}

	public function testAssertNotContainsFalse() {
		$this->assertFalse($this->unit->assertNotContains('bar', array('foo', 'bar', 'baz')));
	}

	public function testAssertNotContainsFalseResults() {
		$this->unit->assertNotContains('bar', array('foo', 'bar', 'baz'));

		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => 'bar',
			'result' => array(
				'foo', 'bar', 'baz'
			)
		), $result['data']);
	}

	public function testAssertContainsOnlyTrue() {
		$this->assertTrue($this->unit->assertContainsOnly('int', array(1,2,3)));
	}

	public function testAssertContainsOnlyFalse() {
		$this->assertFalse($this->unit->assertContainsOnly('string', array(1,2,3)));
	}

	public function testAssertContainsOnlyFalseResults() {
		$this->unit->assertContainsOnly('string', array(1,2,3));

		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => 'string',
			'result' => array(
				1,2,3
			)
		), $result['data']);
	}

	public function testAssertNotContainsOnlyTrue() {
		$this->assertTrue($this->unit->assertNotContainsOnly('string', array(1,2,3)));
	}

	public function testAssertNotContainsOnlyFalse() {
		$this->assertFalse($this->unit->assertNotContainsOnly('int', array(1,2,3)));
	}

	public function testAssertNotContainsOnlyFalseResults() {
		$this->unit->assertNotContainsOnly('int', array(1,2,3));

		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => 'int',
			'result' => array(
				1,2,3
			)
		), $result['data']);
	}

	public function testAssertContainsOnlyInstanceOfTrue() {
		$this->assertTrue($this->unit->assertContainsOnlyInstancesOf('stdClass', array(new \stdClass)));
	}

	public function testAssertContainsOnlyInstanceOfFalse() {
		$this->assertFalse($this->unit->assertContainsOnlyInstancesOf('stdClass', array(new \lithium\test\Unit)));
	}

	public function testAssertContainsOnlyInstanceOfFalseResults() {
		$this->assertFalse($this->unit->assertContainsOnlyInstancesOf('stdClass', array(new \lithium\test\Unit)));

		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => 'stdClass',
			'result' => array(
				0 => new \lithium\test\Unit
			)
		), $result['data']);
	}

	public function testAssertEmptyTrue() {
		$this->assertTrue($this->unit->assertEmpty(array()));
	}

	public function testAssertEmptyFalse() {
		$this->assertFalse($this->unit->assertEmpty(array(1)));
	}

	public function testAssertEmptyFalseResults() {
		$this->unit->assertEmpty(array(1));

		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => array(1),
			'result' => false
		), $result['data']);
	}

	public function testAssertNotEmptyTrue() {
		$this->assertTrue($this->unit->assertNotEmpty(array(1)));
	}

	public function testAssertNotEmptyFalse() {
		$this->assertFalse($this->unit->assertNotEmpty(array()));
	}

	public function testAssertNotEmptyFalseResults() {
		$this->unit->assertNotEmpty(array());

		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => array(),
			'result' => false
		), $result['data']);
	}

	public function testAssertFileEqualsTrue() {
		$file1 = LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md';
		$file2 = LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md.copy';
		$this->assertTrue($this->unit->assertFileEquals($file1, $file2));
	}

	public function testAssertFileEqualsFalse() {
		$file1 = LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md';
		$file2 = LITHIUM_APP_PATH . '/tests/mocks/md/file_2.md';
		$this->assertFalse($this->unit->assertFileEquals($file1, $file2));
	}

	public function testAssertFileEqualsFalseResults() {
		$file1 = LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md';
		$file2 = LITHIUM_APP_PATH . '/tests/mocks/md/file_2.md';
		$this->unit->assertFileEquals($file1, $file2);

		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => md5_file($file1),
			'result' => md5_file($file2)
		), $result['data']);
	}

	public function testAssertFileNotEqualsTrue() {
		$file1 = LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md';
		$file2 = LITHIUM_APP_PATH . '/tests/mocks/md/file_2.md';
		$this->assertTrue($this->unit->assertFileNotEquals($file1, $file2));
	}

	public function testAssertFileNotEqualsFalse() {
		$file1 = LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md';
		$file2 = LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md.copy';
		$this->assertFalse($this->unit->assertFileNotEquals($file1, $file2));
	}

	public function testAssertFileNotEqualsFalseResults() {
		$file1 = LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md';
		$file2 = LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md.copy';
		$this->assertFalse($this->unit->assertFileNotEquals($file1, $file2));

		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => md5_file($file1),
			'result' => md5_file($file2)
		), $result['data']);
	}

	public function testAssertFileExistsTrue() {
		$file1 = LITHIUM_APP_PATH . '/readme.md';
		$this->assertTrue($this->unit->assertFileExists($file1));
	}

	public function testAssertFileExistsFalse() {
		$file1 = LITHIUM_APP_PATH . '/does/not/exist.txt';
		$this->assertFalse($this->unit->assertFileExists($file1));
	}

	public function testAssertFileExistsFalseResults() {
		$file1 = LITHIUM_APP_PATH . '/does/not/exist.txt';
		$this->assertFalse($this->unit->assertFileExists($file1));

		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => LITHIUM_APP_PATH . '/does/not/exist.txt',
			'result' => false
		), $result['data']);
	}

	public function testAssertFileNotExistsTrue() {
		$file1 = LITHIUM_APP_PATH . '/does/not/exist.txt';
		$this->assertTrue($this->unit->assertFileNotExists($file1));
	}

	public function testAssertFileNotExistsFalse() {
		$file1 = LITHIUM_APP_PATH . '/readme.md';
		$this->assertFalse($this->unit->assertFileNotExists($file1));
	}

	public function testAssertFileNotExistsFalseResults() {
		$file1 = LITHIUM_APP_PATH . '/readme.md';
		$this->assertFalse($this->unit->assertFileNotExists($file1));

		$results = $this->unit->results();
		$result = array_pop($results);
		
		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => LITHIUM_APP_PATH . '/readme.md',
			'result' => false
		), $result['data']);
	}

	public function testAssertGreaterThanTrue() {
		$this->assertTrue($this->unit->assertGreaterThan(5, 3));
	}

	public function testAssertGreaterThanFalse() {
		$this->assertFalse($this->unit->assertGreaterThan(3, 5));
	}

	public function testAssertGreaterThanFalseResults() {
		$this->unit->assertGreaterThan(3, 5);

		$results = $this->unit->results();
		$result = array_pop($results);

		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => 3,
			'result' => 5
		), $result['data']);
	}

	public function testAssertGreaterThanOrEqualTrue() {
		$this->assertTrue($this->unit->assertGreaterThanOrEqual(5, 5));
	}

	public function testAssertGreaterThanOrEqualFalse() {
		$this->assertFalse($this->unit->assertGreaterThanOrEqual(3, 5));
	}

	public function testAssertGreaterThanOrEqualFalseResults() {
		$this->unit->assertGreaterThanOrEqual(3, 5);

		$results = $this->unit->results();
		$result = array_pop($results);

		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => 3,
			'result' => 5
		), $result['data']);
	}

	public function testAssertLessThanTrue() {
		$this->assertTrue($this->unit->assertLessThan(3, 5));
	}

	public function testAssertLessThanFalse() {
		$this->assertFalse($this->unit->assertLessThan(5, 3));
	}

	public function testAssertLessThanFalseResults() {
		$this->unit->assertLessThan(5, 3);

		$results = $this->unit->results();
		$result = array_pop($results);

		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => 5,
			'result' => 3
		), $result['data']);
	}

	public function testAssertLessThanOrEqualTrue() {
		$this->assertTrue($this->unit->assertLessThanOrEqual(5, 5));
	}

	public function testAssertLessThanOrEqualFalse() {
		$this->assertFalse($this->unit->assertLessThanOrEqual(5, 3));
	}

	public function testAssertLessThanOrEqualFalseResults() {
		$this->unit->assertLessThanOrEqual(5, 3);

		$results = $this->unit->results();
		$result = array_pop($results);

		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => 5,
			'result' => 3
		), $result['data']);
	}

	public function testAssertInstanceOfTrue() {
		$this->assertTrue($this->unit->assertInstanceOf('\stdClass', new \stdClass));
	}

	public function testAssertInstanceOfFalse() {
		$this->assertFalse($this->unit->assertInstanceOf('\ReflectionClass', new \stdClass));
	}

	public function testAssertInstanceOfFalseResults() {
		$this->assertFalse($this->unit->assertInstanceOf('\ReflectionClass', new \stdClass));

		$results = $this->unit->results();
		$result = array_pop($results);

		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => '\ReflectionClass',
			'result' => 'stdClass'
		), $result['data']);
	}

	public function testAssertNotInstanceOfTrue() {
		$this->assertTrue($this->unit->assertNotInstanceOf('\ReflectionClass', new \stdClass));
	}

	public function testAssertNotInstanceOfFalse() {
		$this->assertFalse($this->unit->assertNotInstanceOf('\stdClass', new \stdClass));
	}

	public function testAssertNotInstanceOfFalseResults() {
		$this->assertFalse($this->unit->assertNotInstanceOf('\stdClass', new \stdClass));

		$results = $this->unit->results();
		$result = array_pop($results);

		$this->assertEqual('fail', $result['result']);
		$this->assertEqual(array(
			'expected' => '\stdClass',
			'result' => 'stdClass'
		), $result['data']);
	}

}