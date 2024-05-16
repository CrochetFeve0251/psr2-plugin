## All projects are different

All WordPress plugins are shaped in a different way and this is the strength of WordPress but also its worse weakness.

This is why it is not possible to provide you one clear tutorial about how to migrate your plugin toward Launchpad.

However, it is still possible to guide you toward the right path to integrate Launchpad into your plugin.

### Core vs Framework

The best is always to have the full framework.

However, when migrating a plugin already existing to Launchpad it is better to do it gradually and for that we can provide you different strategies based on how your plugin is built.

### WP Media standards

If your plugin is already following WP Media standards then you will be able to migrate following this tutorial:

[![alt text](imgs/wp-media.png "Migrating")](https://www.loom.com/share/0370ddf6526d4043a8fe5f2cc0b32c61?sid=d6627e4c-d997-4fe9-b89b-901117f4b19f)

1. Remove any potential use of the `league/container` inside dependencies.
2. Add and protect the `wp-launchpad/core` with `coenjacobs/mozart` or `brianhenryie/strauss`.
3. Extend subscriber interface from `Launchpad\Dependencies\LaunchpadCore\EventManagement\OptimizedSubscriberInterface`
4. Implement `Launchpad\Dependencies\LaunchpadCore\Container\ServiceProviderInterface` on each service provider or extend `Launchpad\Dependencies\LaunchpadCore\Container\AbstractServiceProvider`
5. Add each one of your subscribers inside the matching 
6. Create a folder `configs`
7. Create the file `configs/parameters.php` with the following content:
```php
return [
    'plugin_name'        => sanitize_key( 'My plugin name' ),
    'is_mu_plugin' => false,
    'translation_key'      => 'my-plugin',
    'prefix' => 'my_plugin_'
];
```
8. Create the file `configs/providers.php` with each one of the providers listed inside:
```php
return [
    MyProvider::class,
];
```
9. change the boot logic by removing all logic inside the main plugin file and replace it with `boot` function:
````php
use function LaunchpadCore\boot;

defined( 'ABSPATH' ) || exit;


require __DIR__ . '/vendor-prefixed/wp-launchpad/core/inc/boot.php';

boot(__FILE__);
````
10. Remove all the new useless classes.
11. Search for potential modules integrations.