## Creating a simple unit test

First we we will how to create a simple testing class testing a method.

For that first we will have to create a file from the name of the method inside the `tests/Unit/inc` folder and following the namespace from the class the method belongs to.

Example if we want to test the method `my_method` from the class `Launchpad\Engine\MyNamespace\MyClass` , we will create the file `myMethod.php` in the folder `tests/Unit/inc/Engine/MyNamespace/MyClass`.

### Creating the class

Inside that class we will have then to add the following content:

- The namespace from your test that follows the path from your class in our example it is `Launchpad\Tests\Unit\inc\Engine\MyNamespace\MyClass`.
- The definition from the class with the following name Test_ followed by the name of the method, for your example will be `Test_MyMethod`.
- That class should be extending `Launchpad\Tests\Unit\TestCase`.
- Finally that class should contain a public method starting by `test` and that describe the usage from  the test in your case it will be `testReturnAsExpected` .

```php
namespace Launchpad\Tests\Unit\inc\Engine\MyNamespace\MyClass;

use Launchpad\Tests\Unit\TestCase;

class Test_MyMethod extends TestCase {

   public function testReturnAsExpected() {

   }

}
```

### Mocking classes and functions

Now that we know how to create a class we will now learn how to deal with a class using other or with a class using some external function from WordPress for example.

Let’s imagine the class we want to test has the following content:

```php
namespace Launchpad\Engine\MyNamespace\MyClass;

class {
  protected $dependency;

  public function __construct(\MyDependency $dependency) {
    $this->dependency = $dependency;
  }
 
  public function my_method() {
   $id = $this->dependency->method(12);
   $post = get_post($id);
  }
}

```

We will in this case to mock two things:

- The class `MyDependency` that our class use to use its interface without testing its content.
- The method `get_post` that my_method use to prevent use from re-implementing the method.

#### Mock a class

In this boilerplate we use Mockery to mock classes.

To mock a class with Mockery we use the Mockery::mock method this way:

```php
$mock = Mockery::mock(MyDependency::class);

```

Once we got the mock object we can then set expectation this way:

```php
$mock->expects()->method(12)->andReturn(45);
```

For more information on how Mockery work you can check [their documentation](https://github.com/mockery/mockery).

#### Mock a function 

To mock method in Rocker launcher we are using Brain Monkey.

Brain Monkey allows us to mock function with an interface close to Mockery.

To mock a function with Brain Monkey we can use the expects function this way:

```php
use Brain\Monkey\Functions;

Functions\expect('get_post')->with(48)->once()->andReturn(false);
```

For more information on how Brain Monkey work you can check [their documentation](https://giuseppe-mazzapica.gitbook.io/brain-monkey/).
