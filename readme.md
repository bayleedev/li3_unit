# li3_unit - [Lithium PHP](http://lithify.me)

Adds extra assert methods and simple ways to create models, controllers, and helpers.

[![Build Status](https://secure.travis-ci.org/BlaineSch/li3_unit.png?branch=master)](http://travis-ci.org/BlaineSch/li3_unit)

## Installation

### Composer
~~~ json
{
    "require": {
        ...
        "blainesch/li3_unit": ">=1.0.0"
        ...
    }
}
~~~
~~~ bash
php composer.phar install
~~~

### Submodule
~~~ bash
git submodule add git://github.com/blainesch/li3_unit.git libraries/li3_unit
~~~

### Clone Directly
~~~ bash
git clone git://github.com/blainesch/li3_unit.git libraries/li3_unit
~~~

## Usage

### Load the plugin

Add the plugin to be loaded with Lithium's autoload magic

In `app/config/bootstrap/libraries.php` add:

~~~ php
<?php
	Libraries::add('li3_unit');
?>
~~~

### Extra Assertions

Currently tests extend \lithium\test\Unit instead, extend \li3_unit\test\Unit which extends the default lithium Unit this gives you access to new assertion methods.

~~~ php
<?php

namespace app\tests\cases;

use li3_unit\test\Unit;

class SampleTest extends Unit {

	public function testSomething() {
		$this->assertCount(3, array('foo', 'bar', 'baz'));
	}

}
?>
~~~

### Calling a controller
Instead of extending our built-in Unit class, extend ControllerUnit. You still have access to all of the extra assertion methods and Lithium's built in features, but also have access to a new 'call' method.
~~~ php
<?php

namespace app\tests\cases\controllers;

use li3_unit\test\ControllerUnit;

class UsersControllerTest extends ControllerUnit {

	protected static $controller = 'app\\controllers\\UsersController';

	public function testSomething() {
		$data = self::call('profile', array(
			'params' => array(
				'name' => 'Blaine',
			)
		));

		$user = $data['user'];

		$this->assertEqual('Blaine', $user->username);
	}

}
?>
~~~

### Calling a helper
Similar to before we will change ControllerUnit to HelperUnit and have access to a new method 'create' which will help create new helpers for us to test against.
~~~ php
<?php

namespace app\tests\cases\controllers;

use li3_unit\test\ControllerUnit;

class UsersControllerTest extends ControllerUnit {

	protected static $controller = 'app\\controllers\\UsersController';

	public function testSomething() {
		$data = self::call('profile', array(
			'params' => array(
				'name' => 'Blaine',
			)
		));

		$user = $data['user'];

		$this->assertEqual('Blaine', $user->username);
	}

}
?>
~~~

### Calling a model
You're probably better off using a library such as [li3_fixtures](https://github.com/daschl/li3_fixtures), but for those of us just wanting a one-in-all package this library can help test non-relational model instance methods.
~~~ php
<?php

namespace app\tests\cases\models;

use li3_unit\test\ModelUnit;

class UsersTest extends ModelUnit {

	public static $model = 'app\\models\\Users';

	public static $defaultData = array(
		'id' => '10',
		'fname' => 'Blaine',
		'lname' => 'Smith',
	);

	public function testName() {
		$user = self::create(array(
			'fname' => 'Blaine',
			'lname' => 'Schmeisser',
		));
		$expected = 'Blaine Schmeisser';
		$this->assertEqual($expected, $user->fullName());
	}

}
?>
~~~