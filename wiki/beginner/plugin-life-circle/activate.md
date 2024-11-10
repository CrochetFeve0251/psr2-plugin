# Activate

The activate logic is some logic that execute when the plugin is activated.

This happens in two cases:

- when the plugin installs.
- when the plugin got disabled and is re-enabled.

It is possible to use that state to initialize the plugin:
- By creating tables.
- By creating initial configurations.

## Creating an activate logic

In Launchpad, to create a logic which will be executed when the plugin is activated, we need to use an Activator.

To create an activator, any class can be used as the only requirement is to [use the `@activate` annotation](https://github.com/wp-launchpad/launchpad-examples/blob/316e6927e24339550a81879fdaf189d73a9acf4b/activate/inc/MyActivator.php#L12) inside the docblock of at least one of the methods:

```php
class MyActivator {
    /**
    * @activate
    */
    public function register_options() {
        
    }
}
```

Once the activator class is created, it needs to be registered on a service provider to be loaded.

For that it is important to first [add the necessary logic into the provider](https://github.com/wp-launchpad/launchpad-examples/blob/316e6927e24339550a81879fdaf189d73a9acf4b/activate/inc/ServiceProvider.php#L9)
using [`HasActivatorServiceProviderInterface`](https://github.com/wp-launchpad/core/blob/develop/inc/Activation/HasActivatorServiceProviderInterface.php) interface and [`HasActivatorServiceProviderTrait`](https://github.com/wp-launchpad/core/blob/develop/inc/Activation/HasActivatorServiceProviderTrait.php) trait:

```php
class Provider extends AbstractServiceProvider implements HasActivatorServiceProviderInterface {
   use HasActivatorServiceProviderTrait; 
   
   public function define() {

   }
} 
```

It is then possible to have access to the [`register_activator` method to register our activator](https://github.com/wp-launchpad/launchpad-examples/blob/316e6927e24339550a81879fdaf189d73a9acf4b/activate/inc/ServiceProvider.php#L18) inside [the `define` method](https://github.com/wp-launchpad/launchpad-examples/blob/316e6927e24339550a81879fdaf189d73a9acf4b/activate/inc/ServiceProvider.php#L17):
```php
class Provider extends AbstractServiceProvider implements HasActivatorServiceProviderInterface {
   use HasActivatorServiceProviderTrait; 
   
   public function define() {
    $this->register_activator(MyActivator::class);
   }
} 
```