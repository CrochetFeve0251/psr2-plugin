## Creating an Integration test

Integration tests are here to check how classes are working together.

For theses tests we will have to load a WordPress instance first and include the plugin after it loaded and that why we will have to do some setup before playing with our tests.

### Setup the integration tests environment

To run your integration test we will first need a SQL database for your WordPress instance.

Once it is setup we will launch the following command:

`bin/install-wp-tests.sh DATABASE_NAME DATABASE_USER DATABASE_PASSWORD DATABASE_HOST`

That will download an install a testing version of WordPress inside your `/tmp` folder that will be use later in the integration tests.

### Creating an simple integration test

Inside that class we will have then to add the following content:

- The namespace from your test that follows the path from your class in our example it is `Launchpad\Tests\Unit\inc\Engine\MyNamespace\MyClass`.
- The definition from the class with the following name Test_ followed by the name of the method, for your example will be `Test_MyMethod`.
- That class should be extending `Launchpad\Tests\Integration\TestCase`.
- Finally that class should contain a public method starting by `test` and that describe the usage from  the test in your case it will be `testReturnAsExpected` .

### Launching integration tests

To launch integration tests you can use the command `composer run test-integration`.

### Using fixtures

Once the fixture defined the next step is to link it to the actual test.

For that we will have:

- To add a provider on our old test.
- Then replace constants by the new values provided by the provider.

To add a provider to your test we will have to use the docblock from the method and add it :

```php
namespace Launchpad\Tests\Integration\inc\Engine\MyNamespace\MyClass;

use Launchpad\Tests\Integration\TestCase;

class Test_MyMethod extends TestCase {

   /**
    * @dataProvider providerTestData
    */
   public function testReturnAsExpected() {

   }

}
```

Once we done that the data will be automatically loaded from the fixture however theses data won’t be used by our test.

To do so we will have to add two parameters to your method config and expected that will be fed with values present inside of each scenario from our fixture file:

```php
namespace Launchpad\Tests\Integration\inc\Engine\MyNamespace\MyClass;

use Launchpad\Tests\Integration\TestCase;

class Test_MyMethod extends TestCase {

   /**
    * @dataProvider providerTestData
    */
   public function testReturnAsExpected($config, $expected) {

   }

}
```
### Isolating an action or a filter

Often actions and filters registered in a plugin is also used by other part of WordPress code and that can lead to some complexity in handling the output from integration tests.

That's why in Rocket launcher, you have a trait to unregister all callback except your on the action during the test.

To disable all callback except yours you need:
- First to use the trait `Launchpad\Tests\Integration\ActionTrait` for an action and `Launchpad\Tests\Integration\FilterTrait` for a filter.
- Create a `set_up` method and use the method `unregisterAllCallbacksFromActionExcept` for an action and `unregisterAllCallbacksFromFilterExcept` for a filter to disable all callbacks before the test.
- Create a `tear_down` method and use the method `restoreWpAction` for an action and `restoreWpFilter` for a filter to reset callbacks on that action/filter.

```php
namespace Launchpad\Tests\Integration\inc\Engine\MyNamespace\MyClass;

use Launchpad\Tests\Integration\TestCase;
use Launchpad\Tests\Integration\ActionTrait;

class Test_MyMethod extends TestCase {
   use ActionTrait;

   public function set_up() {
       parent::set_up();
       $this->unregisterAllCallbacksFromActionExcept('my_action', 'my_method');
   }

   public function tear_down() {
       $this->restoreWpAction('my_action');
       parent::tear_down();
   }

   /**
    * @dataProvider providerTestData
    */
   public function testReturnAsExpected($config, $expected) {
       do_action('my_action');
   }

}
```
### Overriding a filter

Another way to manipulate the behavior from the application during an integration test is to override some filters to change their output.

To do that we proceed in 3 steps:

- We create a callback on the test class returning the value we want.
- We create a `set_up` method and register the filter and your callback inside it.
- We create a `tear_down` and unregister the callback from the filter.

This way we have the test returning the value we want during the test without impacting other tests.

```php
namespace Launchpad\Tests\Integration\inc\Engine\MyNamespace\MyClass;

use Launchpad\Tests\Integration\TestCase;

class Test_MyMethod extends TestCase {
   protected $configs;

   public function set_up() {
       parent::set_up();
       add_filter('my_filter', [$this, 'my_callback']);
   }

   public function tear_down() {
       remove_filter('my_filter', [$this, 'my_callback']);
       parent::tear_down();
   }

   /**
    * @dataProvider providerTestData
    */
   public function testReturnAsExpected($config, $expected) {
       $this->configs = $configs;
   }

   public function my_callback() {
      return $this->configs['override'];
   }
}
```

### Generating the class and fixtures with the CLI

Creating a test with fixture can be time consuming that’s why we created a way to generate it rapidly with the CLI.

To generate the code we saw in the previous part, we could have use the command:

`bin/builder test Launchpad/Engine/MyNamespace/MyClass::my_method --type integration --scenarios myFirstScenario,mySecondScenario`

To know more about the CLI, you can check [your documentation page about it](../cli/index.md).

## Creating an external run group for my Integration tests

Sometimes modifying and isolating actions and filters is not enough to make a test run in the right environment.

A simple example of that is some hosts that have a specific environment and that are detectable only by using a constant.

In that special case it is impossible to keep the tests isolated from the others and we will have to create it a specific run to set its own configuration and not impact any other test.

### Adding a group to a class

The first step when creating an external run is to identify classes to run inside that specific run.

For that in Rocket launcher we use the `@group` attribute from the docblock that we will add on top of the class:

```php
namespace Launchpad\Tests\Integration\inc\Engine\MyNamespace\MyClass;

use Launchpad\Tests\Integration\TestCase;
/**
 * @group MyGroup
 */
class Test_MyMethod extends TestCase {

   /**
    * @dataProvider providerTestData
    */
   public function testReturnAsExpected($config, $expected) {
       $this->configs = $configs;
   }
}
```

### Creating a special run in the `composer.json`

Once we created our class group and added it to all classes from your external run, we will now create the external run by itself.

For that we will have modify our `composer.json` and more specifically the `scripts` part:

- On the `test-integration` script we will have to add our group to the excluded ones to prevent our tests to  run on normal run:
```json
"test-integration": "\"vendor/bin/phpunit\" --testsuite integration --colors=always --configuration tests/Integration/phpunit.xml.dist --exclude-group AdminOnly,MyGroup",
```
- We will add a new script to run our external run with `test-integration-my-group` as key and with the follow content:

`"\"vendor/bin/phpunit\" --testsuite integration --colors=always --configuration tests/Integration/phpunit.xml.dist --group MyGroup”`

- Finally we will add our new external run to the `run-tests` script to make sure it will run during CI:
```json
"run-tests": [
      "@test-unit",
      "@test-integration",
      "@test-integration-adminonly",
      "@test-integration-my-group"
    ],
```
### Loading specific resources depending on the group

The last step is to add the custom values that activates only on the external run.

For that we will have to modify the bootstrap file from the integration tests at the following path `/tests/Integration/bootstrap.php`.

Inside the callback from the filter `muplugins_loaded` and before `require LAUNCHPAD_PLUGIN_ROOT . '/launchpad.php';` , we need to use `isGroup` method from `WPMedia\PHPUnit\BootstrapManager` to add your logic:

```php

<?php
namespace Launchpad\Tests\Integration;

use WPMedia\PHPUnit\BootstrapManager;

define( 'LAUNCHPAD_PLUGIN_ROOT', dirname( dirname( __DIR__ ) ) . DIRECTORY_SEPARATOR );
define( 'LAUNCHPAD_TESTS_FIXTURES_DIR', dirname( __DIR__ ) . '/Fixtures' );
define( 'LAUNCHPAD_TESTS_DIR', __DIR__ );
define( 'LAUNCHPAD_IS_TESTING', true );

// Manually load the plugin being tested.
tests_add_filter(
    'muplugins_loaded',
    function() {
        if ( BootstrapManager::isGroup( 'MyGroup' ) ) {
            //your custom env
        }
        // Load the plugin.
        require LAUNCHPAD_PLUGIN_ROOT . '/launchpad.php';
    }
);
```

### Generating the external run group with the CLI
Creating an external run can be time consuming that’s why we created a way to generate it rapidly with the CLI.

To generate the code we saw in the previous part, we could have use the command:

`bin/builder test Launchpad/Engine/MyNamespace/MyClass::my_method --type integration --external MyGroup`

To know more about the CLI, you can check [your documentation page about it](../cli/index.md).
