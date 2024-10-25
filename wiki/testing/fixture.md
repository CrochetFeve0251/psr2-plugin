## Using Fixtures

Now that we know how to create a simple unit test to check the behavior of a class, we will now learn to use fixtures to reduce the number of tests to write.

### Scenarios

Often  when you write tests you will have to test multiple behavior on the same method increasing rapidly the number of test and the repetition from your code.

That why fixtures are used inside Rocket launcher. 

Fixtures allows you to create scenarios with set of values and expectations for each of them allowing a same test to have multiple runs. 

For creating a fixture nothing more simple: 
if we take back your example with the my method class that had a test at the path `tests/Unit/inc/Engine/MyNamespace/MyClass/myMethod.php` then we need to create a fixture following the exact same path at the only difference we are replacing `Unit` by `Fixtures`: 

`tests/Fixtures/inc/Engine/MyNamespace/MyClass/myMethod.php`

Then inside that file we will create an array with a entry for each scenario:

```php
return [
   'myFirstScenario' => [

   ],
   'mySecondScenario' => [

   ],
];
```


Finally for each scenario we will create two sets of values:

- `config` : values that we pass to the test to configure itself and initialize it
- `expected` : values that we will match against the test to be sure the output from the test is valid.

At the end our fixture file will have the following content:
```php
return [
   'myFirstScenario' => [
     'config' => [
        'my_value' => 12,
     ],
     'expected' => [
        'my_expected_value' => new stdClass(),
     ]
   ],
   'mySecondScenario' => [
     'config' => [
        'my_value' => 15,
     ],
     'expected' => [
        'my_expected_value' => false,
     ]
   ],
];
```

### Use your scenarios in a test

Once the fixture defined the next step is to link it to the actual test.

For that we will have:

- To add a provider on our old test.
- Then replace constants by the new values provided by the provider

To add a provider to your test we will have to use the docblock from the method and add it :

```php
namespace Launchpad\Tests\Unit\inc\Engine\MyNamespace\MyClass;

use Launchpad\Tests\Unit\TestCase;

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
namespace Launchpad\Tests\Unit\inc\Engine\MyNamespace\MyClass;

use Launchpad\Tests\Unit\TestCase;

class Test_MyMethod extends TestCase {

   /**
    * @dataProvider providerTestData
    */
   public function testReturnAsExpected($config, $expected) {

   }

}
```

### Generating the class and fixtures with the CLI

Creating a test with fixture can be time consuming that’s why we created a way to generate it rapidly with the CLI.

To generate the code we saw in the previous part, we could have use the command:

`bin/builder test Launchpad/Engine/MyNamespace/MyClass::my_method --type unit --scenarios myFirstScenario,mySecondScenario`

To know more about the CLI, you can check [your documentation page about it](../cli/index.md).

