
## Creating a command

Every command in the application are all a child from the `LaunchpadCLI\Commands\Command` class.

To create a command you will have to extend from it.

Once this is done the next step is to implement methods on the class:
- `__construct`: Create the command and load dependencies.
- `interact`: Interact with the user to get missing data.
- `execute`: Execute the actual command.

## Linking it to the CLI

Once the command is created we will have to link it to the CLI. To do that we will have to create a service provider for that command and attach it to the CLI.

First we will have to create the service provider itself by creating a class extending `LaunchpadCLI\ServiceProviders\ServiceProviderInterface` interface:
```php
class ServiceProvider implements LaunchpadCLI\ServiceProviders\ServiceProviderInterface {
     /**
     * Attach commands from the service provider to the cli.
     *
     * @param App $app cli.
     *
     * @return App
     */
    public function attach_commands(App $app): App {
      return $app;
    }

}
```
If needed every service provider will receive 3 parameters in their constructor:
- `Configurations $configs`: Configurations from the project.
- `Filesystem $filesystem`: Filesystem initialized at the root from the project.
- `string $app_dir`: path from the application directory.

Then inside the `attach_commands` method you can register by using the method `add` on `$app` as following:

```php
$app->add(new Command());
```

Finally the last step is to register the service provider into the CLI.

## Event listener
An event listener is available inside the CLI.

To use it you need to implement `LaunchpadCLI\ServiceProviders\EventDispatcherAwareInterface` interface then you will be able to share the event manager with each classe you need to use it.

We propose a trait `LaunchpadCLI\ServiceProviders\EventDispatcherAwareTrait` to use to prevent you from implementing the logic from the interface.

### Dispatching an event
To dispatch an event you need first to use the trait `LaunchpadCLI\Events\UseHookTrait`.

If you want to run a filter you can run the method `apply_filter`:

```php
$results = $this->apply_filter('my_filter', [
   'test' => []
]);
```

If you want to run an action you can run the method `do_action`:

```php
$this->do_action('my_action', [
   'test' => []
]);
```

Then depending on your 
### Registering a subscriber
To register a subscriber you need to create a service provider that implements `LaunchpadCLI\ServiceProviders\EventDispatcherAwareInterface` and implement `set_event_dispatcher` method.

Then you will have to implement a [League listener subscriber](https://event.thephpleague.com/3.0/extra-utilities/listener-subscriber/) and register it as following into your service provider:

```php
public function set_event_dispatcher(EventDispatcher $event_dispatcher) {
  $this->event_dispatcher->subscribeListenersFrom(new MyListenerSubscriber());
}
```
