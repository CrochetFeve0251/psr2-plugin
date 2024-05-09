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

This will provide access to a new method `get_inflectors` which will have to return the binding between the interface, the method used to inject the dependency and the arguments from that method:

```php

    /**
     * Returns inflectors.
     *
     * @return array[]
     */
    public function get_inflectors(): array
    {
        return [
            MyDependencyInterface::class => [
                'method' => 'set_my_dependency',
                'args' => [
                    MyDependency::class,
                ],
            ],
            MySecondDependencyAwareInteface::class => [
                'method' => 'set_my_second_dependency',
                'args' => [
                    MySecondDependency::class,
                ],
            ],
        ];
    }

```