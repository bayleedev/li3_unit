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

}