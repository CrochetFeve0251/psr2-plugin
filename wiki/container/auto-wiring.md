## Wiring classes
As the name of this strategy let you understand wiring is done automatically for most classes.

For that Launchpad framework will use the reflection API to resolve dependencies.
Depending on the dependency the resolver will use a different strategy:
- If it is a class it will use the reflection API to find the class and implement it.
- If it is a basic type or has no type it will search with the name of the parameter inside the container for a value.
- If no value is found then the resolver will search for a default value.

## Biding classes
Some dependencies can be abstract classes or interfaces.

In that case it won't be possible to instantiate them. That's for that reason we introduced class binding.

When you bind a class to another the bound class will be instantiated each type we try to instantiate the original class.

To bind a class you need to override the `define` method and use the method `bind` for each class you want to bind:
```php
<?php

namespace Launchpad;

class ServiceProvider extends Dependencies\LaunchpadAutoresolver\ServiceProvider
{

    /**
     * Define classes.
     *
     * @return void
     * @throws ReflectionException
     */
    protected function define()
    {
      $this->bind(MyInterface::class, MyConcreteClass::class);
      parent::define();
    }
}
```

In some case we need different classes to be bound for different parent classes.

In that case you can use the `$when` parameter on the `bind` method.

For that you just have to put the parent class name in an array that will pass to the `$when` parameter:
```php
$this->bind(MyInterface::class, MyConcreteClass::class, [Parent::class]);
```
Once this is set the concrete class will only be instanced when the parent class is the one indicated.

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
