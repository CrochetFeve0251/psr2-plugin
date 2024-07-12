In that tutorial we will cover how to use Launchpad to generate a WordPress plugin.

### Create the project

#### Generate the project using composer
The first step in creating the project itself is by using the composer command line with the following input: `composer create-project wp-launchpad/launchpad my-plugin`

Once this is completed, you should be able to see a new folder with the code for your project inside it. However, it is not yet ready to be used as it is still Launchpad default code and needs to be initialized.

#### Initialize project with launchpad command

As multiple projects can exist on the same WordPress website at once, it is important to containerize all of them, and for that purpose we will use a specific namespace for our code.

To do so with Launchpad, we need to run the following command in the terminal:
`bin/generator initialize`

Note: For the moment the character `-` inside the plugin name so use a space instead. (The name is the one displayed to the user)

Once the command has been executed, it should ask you for your plugin name, and it will generate the necessary changes from it.

You can assert the command executed successfully by checking if the name from your plugin file matches what was the name from your plugin.

### Install a module in your project using composer

Now that the project is set up properly, it is now time to install some modules to gain time and effort when working on your project.

A good option to start with would be to use the WordPress options facade to inside the module `wp-launchpad/framework-options`.

For that we will need to install the corresponding take off package `wp-launchpad/framework-options-take-off` that will set it up automatically for us.

For that we will have to run the following command: `composer require wp-launchpad/framework-options-take-off`

Once this is done, then you can assert everything went as expected by looking that the provider has been added to `configs/providers.php` and that we have the matching package installed in the `composer.json` file:
```php
return  [
...
\MyPlugin\Dependencies\LaunchpadFrameworkOptions\ServiceProvider::class,
];
```

It is possible to find a list of every module available on [the module list page](../../modules/listing.md).

### Create a new subscriber

Once the project is now set up properly, it is now a great time to create our first subscriber.

A subscriber is a class that will contain our plugin logic by defining some callbacks methods to hooks.

For that the `add_action` and `add_filter` won't be used but instead replaced by a `@hook` annotation as following:

```php
/**
* @hook my_event
 */
public function my_callback($my_parameter, $my_second_parameter) {
    
}
```

If you want more information about this notation you can check [the subscriber documentation](../creating-subscriber.md).

If you are interested about the inner working of subscribers some documentations is available [here](../concepts/subscribers.md).

#### Create a new subscriber

To create a subscriber, we can create any class with the name of your choice.

What will make it become a subscriber is actually adding a docblock with the annotation `@hook`.

This annotation signals that this method should be used as an event handler for some event.
It is possible to assign the same method on another event by using multiple annotations `@hook`.

In our case the subscriber looks like this and needs to be added inside `inc/MySubcribers`:

```php

namespace MyPlugin;

class MySubscriber {
    /**
     * @hook init
     */
    public function initialize() {
    
    }
}

```

#### Attach the subscriber to the plugin
Once the subscriber is created, the next step would be attaching it to the plugin.
For that we will have to register it in one of the service providers methods.

There are [multiple methods available](../../container/providers.md) to load them depending on the context but in this tutorial we will add them to `get_common_subscribers` method which load the subscribers in any context.

Inside the `inc` folder from your plugin a default service provider has been created in the file `inc/ServiceProvider.php`.

To register the subscriber we need to add the following code:

```php
public function get_common_subscribers(): array {
    return [
        MySubscriber::class,
    ];
}
```

#### Use inflectors
Inflectors are a key tool when working with Launchpad plugins and services.
These allow you to access some features without having to bind them directly to your code.

In our case we're going to use one to load the option facade from the module we installed earlier on.

For that on our subscriber we will have to first implement the interface `LaunchpadFrameworkOptions\Interfaces\OptionsAwareInterface` and use the trait `LaunchpadFrameworkOptions\Traits\OptionsAwareTrait`.

Once this is done, then now the framework will automatically inject an instance of the facade into the subscriber, and in our case the name of the property injected is `options`.

This gives us the following code:

```php
namespace MyPlugin;

use MyPlugin\Dependencies\LaunchpadFrameworkOptions\Interfaces\OptionsAwareInterface;
use MyPlugin\Dependencies\LaunchpadFrameworkOptions\Traits\OptionsAwareTrait;

class MySubscriber implements OptionsAwareInterface {
    use OptionsAwareTrait;
    /**
     * @hook init
     */
    public function initialize() {
        $this->options->set('my_option', true);
    }
}
```

This the end of this tutorial but if you are interested about going further theses are some important resources.

If you are interested about testing your code, you can take a look at [the testing sections](../tests/index.md) from the documentation which is here to provide you help on this.

If you are interested about good practices and when to use hooks you can take a look to [our hook section](../good-practices/hooks).

If you want to check the list of modules available and their usage you can check [the module listing](../../modules/listing.md).