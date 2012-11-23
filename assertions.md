# Assertions

Base Unit class that adds extra assertion methods

 * [PHP Unit Assertions](http://www.phpunit.de/manual/current/en/writing-tests-for-phpunit.html)
 * [Lithium's Unit Testing Framework](http://lithify.me/docs/manual/quality-code/testing.wiki)

# Table of Contents

 * [assertCount](#assertCount)
 * [assertNotCount](#assertNotCount)
 * [assertArrayHasKey](#assertArrayHasKey)
 * [assertArrayNotHasKey](#assertArrayNotHasKey)
 * [assertClassHasAttribute](#assertClassHasAttribute)
 * [assertClassNotHasAttribute](#assertClassNotHasAttribute)
 * [assertClassHasStaticAttribute](#assertClassHasStaticAttribute)
 * [assertClassNotHasStaticAttribute](#assertClassNotHasStaticAttribute)
 * [assertContains](#assertContains)
 * [assertNotContains](#assertNotContains)
 * [assertContainsOnly](#assertContainsOnly)
 * [assertNotContainsOnly](#assertNotContainsOnly)
 * [assertContainsOnlyInstancesOf](#assertContainsOnlyInstancesOf)
 * [assertEmpty](#assertEmpty)
 * [assertNotEmpty](#assertNotEmpty)
 * [assertFileEquals](#assertFileEquals)
 * [assertFileNotEquals](#assertFileNotEquals)
 * [assertFileExists](#assertFileExists)
 * [assertFileNotExists](#assertFileNotExists)
 * [assertGreaterThan](#assertGreaterThan)
 * [assertGreaterThanOrEqual](#assertGreaterThanOrEqual)
 * [assertLessThan](#assertLessThan)
 * [assertLessThanOrEqual](#assertLessThanOrEqual)
 * [assertInstanceOf](#assertInstanceOf)
 * [assertNotInstanceOf](#assertNotInstanceOf)
 * [assertInternalType](#assertInternalType)
 * [assertNotInternalType](#assertNotInternalType)
 * [assertNotNull](#assertNotNull)
 * [assertObjectHasAttribute](#assertObjectHasAttribute)
 * [assertObjectNotHasAttribute](#assertObjectNotHasAttribute)
 * [assertRegExp](#assertRegExp)
 * [assertNotRegExp](#assertNotRegExp)
 * [assertStringMatchesFormat](#assertStringMatchesFormat)
 * [assertStringNotMatchesFormat](#assertStringNotMatchesFormat)
 * [assertStringEndsWith](#assertStringEndsWith)
 * [assertStringStartsWith](#assertStringStartsWith)

---------

## assertCount

Will mark the test true if $count and count($arr) are equal

bool assertCount( integer $expected, array $array, string $message = '{:message}' )

~~~ php
$this->assertCount(1, array('foo'));
~~~

~~~ php
$this->assertCount(2, array('foo', 'bar', 'bar')); 
~~~

---------

## assertNotCount

Will mark the test true if $count and count($arr) are not equal

bool assertNotCount( integer $expected, array $array, string $message = '{:message}' )

~~~ php
$this->assertNotCount(2, array('foo', 'bar', 'bar')); 
~~~

~~~ php
$this->assertNotCount(1, array('foo'));
~~~

---------

## assertArrayHasKey

Will mark the test true if $array has key $expected

bool assertArrayHasKey( string $key, [type] $array, string $message = '{:message}' )

~~~ php
$this->assertArrayHasKey('foo', array('bar' => 'baz'));
~~~

~~~ php
$this->assertArrayHasKey('bar', array('bar' => 'baz'));
~~~

---------

## assertArrayNotHasKey

Will mark the test true if $array does not have key $expected

bool assertArrayNotHasKey( integer $key, [type] $array, string $message = '{:message}' )

~~~ php
$this->assertArrayNotHasKey('foo', array('bar' => 'baz'));
~~~

~~~ php
$this->assertArrayNotHasKey('bar', array('bar' => 'baz'));
~~~

---------

## assertClassHasAttribute

Will mark the test true if $class has an attribute $attributeName

bool assertClassHasAttribute( string $attributeName, string $class, string $message = '{:message}' )

~~~ php
$this->assertClassHasAttribute('name', '\ReflectionClass');
~~~

~~~ php
$this->assertClassHasAttribute('__construct', '\ReflectionClass');
~~~

---------

## assertClassNotHasAttribute

Will mark the test true if $class has an attribute $attributeName

bool assertClassNotHasAttribute( string $attributeName, string $class, string $message = '{:message}' )

~~~ php
$this->assertClassNotHasAttribute('__construct', '\ReflectionClass');
~~~

~~~ php
$this->assertClassNotHasAttribute('name', '\ReflectionClass');
~~~

---------

## assertClassHasStaticAttribute

Will mark the test true if $class has a static property $attributeName

bool assertClassHasStaticAttribute( string $attributeName, string|object $class, string $message = '{:message}' )

~~~ php
$this->assertClassHasStaticAttribute('foobar', '\lithium\core\StaticObject');
~~~

~~~ php
$this->assertClassHasStaticAttribute('_methodFilters', '\lithium\core\StaticObject');
~~~

---------

## assertClassNotHasStaticAttribute

Will mark the test true if $class does not have a static property $attributeName

bool assertClassNotHasStaticAttribute( string $attributeName, string|object $class, string $message = '{:message}' )

~~~ php
$this->assertClassNotHasStaticAttribute('_methodFilters', '\lithium\core\StaticObject');
~~~

~~~ php
$this->assertClassNotHasStaticAttribute('foobar', '\lithium\core\StaticObject')
~~~

---------

## assertContains

Will mark the test true if $haystack contains $needle as a value

bool assertContains( string $needle, mixed $haystack, string $message = '{:message}' )

~~~ php
$this->assertContains('foo', array('foo', 'bar', 'baz'));
~~~

~~~ php
$this->assertContains(4, array(1,2,3));
~~~

---------

## assertNotContains

Will mark the test true if $haystack does not contain $needle as a value

bool assertNotContains( string $needle, mixed $haystack, string $message = '{:message}' )

~~~ php
$this->assertNotContains(4, array(1,2,3));
~~~

~~~ php
$this->assertNotContains('foo', array('foo', 'bar', 'baz'));
~~~

---------

## assertContainsOnly

Will mark the test true if $haystack contains only items of $type

bool assertContainsOnly( string $type, mixed $haystack, string $message = '{:message}' )

~~~ php
$this->assertContainsOnly('int', array(1,2,3));
~~~

~~~ php
$this->assertContainsOnly('int', array('foo', 'bar', 'baz'));
~~~

---------

## assertNotContainsOnly

Will mark the test true if $haystack does not have any of $type

bool assertNotContainsOnly( string $type, mixed $haystack, string $message = '{:message}' )

~~~ php
$this->assertNotContainsOnly('int', array('foo', 'bar', 'baz'));
~~~

~~~ php
$this->assertNotContainsOnly('int', array(1,2,3));
~~~

---------

## assertContainsOnlyInstancesOf

Will mark the test true if $haystack contains only items of $type

bool assertContainsOnlyInstancesOf( string $class, mixed $haystack, string $message = '{:message}' )

~~~ php
$this->assertContainsOnlyInstancesOf('stdClass', array(new \stdClass));
~~~

~~~ php
$this->assertContainsOnlyInstancesOf('stdClass', array(new \lithium\test\Unit));
~~~

---------

## assertEmpty

Will mark the test true if $actual is empty

bool assertEmpty( string $actual, string $message = '{:message}' )

~~~ php
$this->assertEmpty(1);
~~~

~~~ php
$this->assertEmpty(array());
~~~

---------

## assertNotEmpty

Will mark the test true if $actual is not empty

bool assertNotEmpty( string $actual, string $message = '{:message}' )

~~~ php
$this->assertNotEmpty(array());
~~~

~~~ php
$this->assertNotEmpty(1);
~~~

---------

## assertFileEquals

Will mark the test true if the contents of $expected are equal to the contents of $actual

bool assertFileEquals( string $expected, string $actual, string $message = '{:message}' )

~~~ php
$this->assertFileEquals(LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md', LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md.copy');
~~~

~~~ php
$this->assertFileEquals(LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md', LITHIUM_APP_PATH . '/tests/mocks/md/file_2.md');
~~~

---------

## assertFileNotEquals

Will mark the test true if the contents of $expected are not equal to the contents of $actual

bool assertFileNotEquals( string $expected, string $actual, string $message = '{:message}' )

~~~ php
$this->assertFileNotEquals(LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md', LITHIUM_APP_PATH . '/tests/mocks/md/file_2.md');
~~~

~~~ php
$this->assertFileNotEquals(LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md', LITHIUM_APP_PATH . '/tests/mocks/md/file_1.md.copy');
~~~

---------

## assertFileExists

Will mark the test true if the file $actual exists

bool assertFileExists( string $actual, string $message = '{:message}' )

~~~ php
$this->assertFileExists(LITHIUM_APP_PATH . '/readme.md');
~~~

~~~ php
$this->assertFileExists(LITHIUM_APP_PATH . '/does/not/exist.txt');
~~~

---------

## assertFileNotExists

Will mark the test true if the file $actual does not exist

bool assertFileNotExists( string $actual, string $message = '{:message}' )

~~~ php
$this->assertFileExists(LITHIUM_APP_PATH . '/does/not/exist.txt');
~~~

~~~ php
$this->assertFileExists(LITHIUM_APP_PATH . '/readme.md');
~~~

---------

## assertGreaterThan

Will mark the test true if $expected > $actual

bool assertGreaterThan( float|integer $expected, float|integer $actual, string $message = '{:message}' )

~~~ php
$this->assertGreaterThan(5, 3);
~~~

~~~ php
$this->assertGreaterThan(3, 5);
~~~

---------

## assertGreaterThanOrEqual

Will mark the test true if $expected >= $actual

bool assertGreaterThanOrEqual( float|integer $expected, float|integer $actual, string $message = '{:message}' )

~~~ php
$this->assertGreaterThanOrEqual(5, 5);
~~~

~~~ php
$this->assertGreaterThanOrEqual(3, 5);
~~~

---------

## assertLessThan

Will mark the test true if $expected < $actual

bool assertLessThan( float|integer $expected, float|integer $actual, string $message = '{:message}' )

~~~ php
$this->assertLessThan(3, 5);
~~~

~~~ php
$this->assertLessThan(5, 3);
~~~

---------

## assertLessThanOrEqual

Will mark the test true if $expected <= $actual

bool assertLessThanOrEqual( float|integer $expected, float|integer $actual, string $message = '{:message}' )

~~~ php
$this->assertLessThanOrEqual(5, 5);
~~~

~~~ php
$this->assertLessThanOrEqual(5, 3);
~~~

---------

## assertInstanceOf

Will mark the test true if $actual is a $expected

bool assertInstanceOf( string $expected, object $actual, string $message = '{:message}' )

~~~ php
$this->assertInstanceOf('stdClass', new stdClass);
~~~

~~~ php
$this->assertInstanceOf('ReflectionClass', new stdClass);
~~~

---------

## assertNotInstanceOf

Will mark the test true if $actual is not a $expected

bool assertNotInstanceOf( string $expected, object $actual, string $message = '{:message}' )

~~~ php
$this->assertNotInstanceOf('ReflectionClass', new stdClass);
~~~

~~~ php
$this->assertNotInstanceOf('stdClass', new stdClass);
~~~

---------

## assertInternalType

Will mark the test true if $actual if of type $expected

bool assertInternalType( string $expected, object $actual, string $message = '{:message}' )

~~~ php
$this->assertInternalType('string', 'foobar');
~~~

~~~ php
$this->assertInternalType('int', 'foobar');
~~~

---------

## assertNotInternalType

Will mark the test true if $actual if not of type $expected

bool assertNotInternalType( string $expected, object $actual, string $message = '{:message}' )

~~~ php
$this->assertNotInternalType('int', 'foobar');
~~~

~~~ php
$this->assertNotInternalType('string', 'foobar');
~~~

---------

## assertNotNull

Will mark the test as true if $actual is not null

bool assertNotNull( object $actual, string $message = '{:message}' )

~~~ php
$this->assertNotNull(1);
~~~

~~~ php
$this->assertNotNull(null);
~~~

---------

## assertObjectHasAttribute

Will mark the test true if $object has an attribute $attributeName

bool assertObjectHasAttribute( string $attributeName, string $object, string $message = '{:message}' )

~~~ php
$this->assertObjectHasAttribute('name', '\ReflectionClass');
~~~

~~~ php
$this->assertObjectHasAttribute('__construct', '\ReflectionClass');
~~~

---------

## assertObjectNotHasAttribute

Will mark the test true if $object has an attribute $attributeName

bool assertObjectNotHasAttribute( string $attributeName, string $object, string $message = '{:message}' )

~~~ php
$this->assertObjectNotHasAttribute('__construct', '\ReflectionClass');
~~~

~~~ php
$this->assertObjectNotHasAttribute('name', '\ReflectionClass');
~~~

---------

## assertRegExp

Will mark the test true if $actual matches $expected using preg_match

bool assertRegExp( string $expected, string $actual, string $message = '{:message}' )

~~~ php
$this->assertRegExp('/^foo/', 'foobar');
~~~

~~~ php
$this->assertRegExp('/^foobar/', 'bar');
~~~

---------

## assertNotRegExp

Will mark the test true if $actual does not match $expected using preg_match

bool assertNotRegExp( string $expected, string $actual, string $message = '{:message}' )

~~~ php
$this->assertNotRegExp('/^foobar/', 'bar');
~~~

~~~ php
$this->assertNotRegExp('/^foo/', 'foobar');
~~~

---------

## assertStringMatchesFormat

Will mark the test true if $actual matches $expected using PHP's build in sprintf format

NOTICE: This differs from how PHPUnit does this same assertion method

bool assertStringMatchesFormat( string $expected, string $actual, string $message = '{:message}' )

~~~ php
$this->assertStringMatchesFormat('%d', '10')
~~~

~~~ php
$this->assertStringMatchesFormat('%d', '10.555')
~~~

---------

## assertStringNotMatchesFormat

Will mark the test true if $actual doesn't match $expected using PHP's build in sprintf format

NOTICE: This differs from how PHPUnit does this same assertion method

bool assertStringNotMatchesFormat( string $expected, string $actual, string $message = '{:message}' )

~~~ php
$this->assertStringNotMatchesFormat('%d', '10.555')
~~~

~~~ php
$this->assertStringNotMatchesFormat('%d', '10')
~~~

---------

## assertStringEndsWith

Will mark the test true if $actual ends with $expected

bool assertStringEndsWith( string $expected, string $actual, string $message = '{:message}' )

~~~ php
$this->assertStringEndsWith('bar', 'foobar');
~~~

~~~ php
$this->assertStringEndsWith('foo', 'foobar');
~~~

---------

## assertStringStartsWith

Will mark the test true if $actual starts with $expected

bool assertStringStartsWith( string $expected, string $actual, string $message = '{:message}' )

~~~ php
$this->assertStringStartsWith('foo', 'foobar');
~~~

~~~ php
$this->assertStringStartsWith('bar', 'foobar');
~~~