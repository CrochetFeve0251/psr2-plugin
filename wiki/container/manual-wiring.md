## Wiring classes

With the manual strategy you have to indicate the application what is the dependency tree between classes.

For that you will have to implement the `define` method.

To register a class you will have to use the method `register_service`.

This method only takes the name of the class as parameter when the class has no dependencies.

However, when the instantiation is more complex it takes a method as second parameters that pass as parameter the definition of the class.

Inside that function you can use the container to get dependencies and pass them to the class as following:
```php
class Provider extends AbstractServiceProvider {
   public function define() {
    $this->register_service(MyClass::class, function($defintion) {
     $definition->addArgument($this->getContainer()->get(MyDependency::class));
    });
   }
}
```

## Registering subscribers

With Launchpad default behavior we have 4 subscriber types:
- Common subscribers: Subscribers that load on any context.
- Administrative subscribers: Subscribers that load only when the admin dashboard is loaded.
- Front-end subscribers: Subscribers that load only on pages visible by regular users.
- Initialisation subscribers: Subscribers loading before other to modify the loading logic.

To define the type from we need to register subscribers in the method matching the right type:
| Type | Method |
|:----:|:------:|
| common | `get_common_subscribers`   |
| admin  | `get_admin_subscribers`   |
| front  | `get_front_subscribers`   |
| init   | `get_init_subscribers`   |
