In WordPress it is possible to fire actions when you enable or disable a plugin.

In Launchpad theses actions are also possible but we made it easier for you to use your objects from the container.
For that we used a couple of interface that describes the actions that should be executed and the service providers to load.

## Activation
When we are activating the plugin with Launchpad providers selected will load and execute specific tasks called activator.

To make a service provider load on activate you need it to implements the interface `LaunchpadCore\Activation\ActivationServiceProviderInterface` or to implements the interface `LaunchpadCore\Activation\HasActivatorServiceProviderInterface` while having one or multiple activators registered with the method `get_activators`.
 
Each activator will have to implement the interface `LaunchpadCore\Activation\ActivationInterface` and the method `activate` which is called to execute the logic during the activation.


## Deactivate

When we are deactivating the plugin with Launchpad providers selected will load and execute specific tasks called deactivator.

To make a service provider load on deactivate you need it to implements the interface `LaunchpadCore\Deactivation\DeactivationServiceProviderInterface` or to implements the interface `LaunchpadCore\Deactivation\HasDeactivatorServiceProviderInterface` while having one or multiple deactivators registered with the method `get_deactivators`.
 
Each activator will have to implement the interface `LaunchpadCore\Deactivation\DeactivationInterface` and the method `get_deactivators` which is called to execute the logic during the activation.
