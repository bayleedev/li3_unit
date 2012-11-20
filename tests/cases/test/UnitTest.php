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

}