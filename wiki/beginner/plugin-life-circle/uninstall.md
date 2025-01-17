# Uninstall 

The uninstall logic is some logic executed when the plugin is executed.

By default, Launchpad doesn't ship with a way to execute logic on uninstall.

However, it is possible to install a module to have uninstall logic.

## Install the module

To install [the module `wp-launchpad/uninstaller-take-off`](https://github.com/wp-launchpad/uninstaller-take-off)
you need to run the following command:
`composer require wp-launchpad/uninstaller-take-off`.

Once the command finished being executed [a new file `uninstall.php`](https://github.com/wp-launchpad/launchpad-examples/blob/main/uninstall/uninstall.php) should have been added to your project and it is now possible to take advantage of the uninstall module.

## Creating an uninstall logic

In Launchpad, to create a logic which will be executed when the plugin is uninstalled, we need to use an Uninstaller.

To create an uninstaller, any class can be used as the only requirement is to [use the `@uninstall` annotation](https://github.com/wp-launchpad/launchpad-examples/blob/f1a8f3567e04402b969812974918a865fd3bd124/uninstall/inc/Uninstaller.php#L7) inside the docblock of at least one of the methods:

```php
class MyUninstaller {
    /**
    * @uninstall
    */
    public function unregister_options() {
        
    }
}
```

Once the uninstaller class is created, it needs to be registered on a service provider to be loaded.

For that it is important to first [add the necessary logic into the provider](https://github.com/wp-launchpad/launchpad-examples/blob/f1a8f3567e04402b969812974918a865fd3bd124/uninstall/inc/ServiceProvider.php#L9)
using [`HasUninstallerServiceProviderInterface`](https://github.com/wp-launchpad/uninstaller/blob/3.1/inc/Uninstall/HasUninstallerServiceProviderInterface.php) interface and [`HasUninstallerServiceProviderTrait`](https://github.com/wp-launchpad/uninstaller/blob/3.1/inc/Uninstall/HasUninstallerServiceProviderTrait.php) trait:

```php
class Provider extends AbstractServiceProvider implements HasUninstallerServiceProviderInterface {
   use HasUninstallerServiceProviderTrait; 
   
   public function define() {

   }
} 
```

It is then possible to have access to the [`register_uninstaller` method to register our uninstaller](https://github.com/wp-launchpad/launchpad-examples/blob/f1a8f3567e04402b969812974918a865fd3bd124/uninstall/inc/ServiceProvider.php#L20) inside [the `define` method](https://github.com/wp-launchpad/launchpad-examples/blob/f1a8f3567e04402b969812974918a865fd3bd124/uninstall/inc/ServiceProvider.php#L18):
```php
class Provider extends AbstractServiceProvider implements HasUninstallerServiceProviderInterface {
   use HasUninstallerServiceProviderTrait; 
   
   public function define() {
    $this->register_uninstaller(MyUninstaller::class);
   }
} 
```