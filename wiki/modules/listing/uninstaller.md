## Description
This module offers you a way to execute actions on the plugin uninstall easily while still respecting a modern architecture.

## Install
To install that library run the following command: `composer require wp-launchpad/uninstaller-take-off --dev`

## Structure

This module creates a `uninstall.php` file at the root of your plugin that will load selected service providers on uninstall and run action from `Uninstaller`.

### Load a service provider
To load a service provider it needs to match of theses conditions:
- Implementing the interface `LaunchpadUninstaller\Uninstall\UninstallServiceProviderInterface`.
- Implementing the interface `LaunchpadUninstaller\Uninstall\HasUninstallerServiceProviderInterface` and return at least one `Uninstaller`.

### Load an uninstaller

To create an `Uninstaller` it needs to implement the interface `LaunchpadUninstaller\Uninstall\UninstallerInterface` and be registered in the method `get_uninstallers` from a service provider.
