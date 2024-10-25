In WordPress, it is possible to fire actions when you enable or disable a plugin.

In Launchpad these actions are also possible but we made it easier for you to use your objects from the container.
For that we used a couple of interface that describes the actions that should be executed and the service providers to load.

## Activation 

### Make provider visible during activation
When we are activating the plugin with Launchpad providers selected will load and execute specific tasks called activator.

To make a service provider load on activate you need it to :
- Implements the interface `LaunchpadCore\Activation\ActivationServiceProviderInterface`: Use this when you need the logic inside a provider, but you don't have an activator inside.
- Implement the interface `LaunchpadCore\Activation\HasActivatorServiceProviderInterface`: Use this when you have an activator inside the provider.

### Create activator

Any class can be used as an activator.

The only thing required is to add the annotation `@activate` on the method to execute during activation:

```php
class MyActivator {
    /**
    * @activate
    */
    public function register_options() {
    
    }
}
```

### Register activator

To register an activator we first need to make sure you implement the interface `LaunchpadCore\Activation\HasActivatorServiceProviderInterface` on the service provider you want to register it.

Then you need to import the logic to register the activator using `LaunchpadCore\Activation\HasActivatorServiceProviderTrait` trait.

Finally inside the method `define` from the provider you will have to register the activator using the method `register_activator`:

```php
class Provider extends AbstractServiceProvider implements HasActivatorServiceProviderInterface {
   use HasActivatorServiceProviderTrait; 
   
   public function define() {
    $this->register_activator(MyActivator::class);
   }
} 
```

## Deactivate

When we are deactivating the plugin with Launchpad providers selected will load and execute specific tasks called deactivator.

### Make provider visible during deactivation
When we are deactivating the plugin with Launchpad providers selected will load and execute specific tasks called deactivator.

To make a service provider load on deactivate you need it to :
- Implements the interface `LaunchpadCore\Deactivation\DeactivationServiceProviderInterface`: Use this when you need the logic inside a provider, but you don't have a deactivator inside.
- Implement the interface `LaunchpadCore\Deactivation\HasDeactivatorServiceProviderInterface`: Use this when you have a deactivator inside the provider.

### Create deactivator

Any class can be used as a deactivator.

The only thing required is to add the annotation `@deactivate` on the method to execute during deactivation:

```php
class MyDeactivator {
    /**
    * @deactivate
    */
    public function unregister_options() {
    
    }
}
```

### Register deactivator

To register a deactivator we first need to make sure you implement the interface `LaunchpadCore\Deactivation\HasDeactivatorServiceProviderInterface` on the service provider you want to register it.

Then you need to import the logic to register the activator using `LaunchpadCore\Activation\HasDesactivatorServiceProviderTrait` trait.

Finally inside the method `define` from the provider you will have to register the activator using the method `register_deactivator`:

```php
class Provider extends AbstractServiceProvider implements HasDeactivatorServiceProviderInterface {
   use HasDesactivatorServiceProviderTrait; 
   
   public function define() {
    $this->register_deactivator(MyDeactivator::class);
   }
} 
```