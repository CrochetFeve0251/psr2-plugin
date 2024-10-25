## What are inflectors ?

Certain classes are used often by others.

If we needed to bind them using the container manually that would be really time-wasting and that's why use inflectors to make that job for us.

Inflectors are automatic binder that inject a dependency to a class using a predefined method when the class in question is implementing a class.

By default, we have the following inflectors available :

| Dependency                                                                                          | Interface                                                                                                                                                                         | Trait                                                                                                                                   | Description                          |
|-----------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------|:-------------------------------------|
| prefix                                                                                              | [LaunchpadCore\Container\PrefixAwareInterface](https://github.com/wp-launchpad/core/blob/main/inc/Container/PrefixAwareInterface.php)                                             | [LaunchpadCore\Container\PrefixAware](https://github.com/wp-launchpad/core/blob/main/inc/Container/PrefixAware.php)                     | Inject the prefix from the plugin    |
| [Dispatcher](https://github.com/wp-launchpad/dispatcher)                                            | [LaunchpadCore\Dispatcher\DispatcherAwareInterface](https://github.com/wp-launchpad/core/blob/main/inc/Dispatcher/DispatcherAwareInterface.php)                                   | [LaunchpadCore\Dispatcher\DispatcherAwareTrait](https://github.com/wp-launchpad/core/blob/main/inc/Dispatcher/DispatcherAwareTrait.php) | Inject the WordPress hook dispatcher |
| [EventManager](https://github.com/wp-launchpad/core/blob/main/inc/EventManagement/EventManager.php) | [LaunchpadCore\EventManagement\EventManagerAwareSubscriberInterface](https://github.com/wp-launchpad/core/blob/main/inc/EventManagement/EventManagerAwareSubscriberInterface.php) | None                                                                                                                                    | Inject event manager.                |

## How to add my own inflectors ?

Registering inflectors is possible at the level from Service Providers.

For that the service provider will have to first implement the interface [`LaunchpadCore\Container\HasInflectorInterface`](https://github.com/wp-launchpad/core/blob/main/inc/Container/HasInflectorInterface.php) and the trait [`LaunchpadCore\Container\InflectorServiceProviderTrait`](https://github.com/wp-launchpad/core/blob/main/inc/Container/InflectorServiceProviderTrait.php).

    This will provide access to a new method `register_inflector` which will be able to register inflectors inside the `define` method:

```php
class Provider extends AbstractServiceProvider implements HasInflectorInterface {
   use InflectorServiceProviderTrait; 
   
   public function define() {
    $this->register_inflector(MyInterface::class);
   }
} 
```

### Inflector structure

An inflector is always split into two parts:
- An interface to recognize classes that we want to execute logic on.
- An action to make on that class as injecting a property using a special method.

For that we can pass the interface to the `register_inflector` method and then:
- If we want to call a method we can use the method `add_method`:
```php
class Provider extends AbstractServiceProvider implements HasInflectorInterface {
   use InflectorServiceProviderTrait; 
   
   public function define() {
    $this->register_inflector(MyInterface::class)
        ->add_method('my_method', [
            10,
            'second_parameter'
        ]);
   }
} 
```
-If we want to inject a property we can use the method `add_property`:
```php
class Provider extends AbstractServiceProvider implements HasInflectorInterface {
   use InflectorServiceProviderTrait; 
   
   public function define() {
    $this->register_inflector(MyInterface::class)
        ->add_property('my_property', false);
   }
} 
```