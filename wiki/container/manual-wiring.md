## Wiring classes

With the manual strategy you have to indicate the application what is the dependency tree between classes.

For that you will have to implement the `define` method.

To register a class you will have to use the method `register_service`.

This method only takes the name of the class as parameter when the class has no dependencies.

```php
class Provider extends AbstractServiceProvider {
   public function define() {
    $this->register_service(MyClass::class);
   }
}
```

## Adding a definition
However, when the instantiation is more complex it takes a method as second parameters that pass as parameter the definition of the class.

Inside that function you can use the container to get dependencies and pass them to the class as following:

```php
use Launchpad\Dependencies\League\Container\Definition\DefinitionInterface;

class Provider extends AbstractServiceProvider {
   public function define() {
    $this->register_service(MyClass::class)->set_definition(DefinitionInterface::class $defintion) {
     $definition->addArgument(MyDependency::class);
    });
   }
}
```

Under the hood Launchpad is using the package `league/container` for IoC, it is possible to have more information about `DefinitionInterface` [there](https://container.thephpleague.com/unstable/definitions/).

## Registering different concrete class

In some occasion it is possible to have a difference between the name of the class we want to register on the container and the class instantiated.

For that it is possible to use the method `set_concrete` on the registration from the class:

```php
class Provider extends AbstractServiceProvider {
   public function define() {
    $this->register_service(MyClass::class)->set_concrete(MyConcreteClass::class);
   }
}
```

## Sharing a class

For optimizing performance and memory it is common practice to instantiate certain classes only once.

This is possible using the method `share` on the registration from the class:

```php
class Provider extends AbstractServiceProvider {
   public function define() {
    $this->register_service(MyClass::class)->share();
   }
}
```

## Registering subscribers

With Launchpad default behavior we have 4 subscriber types:
- Common subscribers: Subscribers that load on any context.
- Administrative subscribers: Subscribers that load only when the admin dashboard is loaded.
- Front-end subscribers: Subscribers that load only on pages visible by regular users.
- Initialisation subscribers: Subscribers loading before other to modify the loading logic.

To define the type from the subscriber we need to register the subscriber with the matching method inside `define` instead of using `register_service`:

| Type | Method |
|:----:|:------:|
| common | `register_common_subscriber`   |
| admin  | `register_admin_subscriber`   |
| front  | `register_front_subscriber`   |
| init   | `register_init_subscriber`   |
