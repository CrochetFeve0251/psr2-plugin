# Uninstall 

The uninstall logic is some logic executed when the plugin is executed.

By default, Launchpad doesn't ship with a way to execute logic on uninstall.

However, it is possible to install a module to have uninstall logic.

## Install the module

To install [the module `wp-launchpad/uninstaller-take-off`](https://github.com/wp-launchpad/uninstaller-take-off)
you need to run the following command:
`composer require wp-launchpad/uninstaller-take-off`.

Once the command finished being executed [a new file `uninstall.php`](https://github.com/wp-launchpad/launchpad-examples/blob/main/uninstall/uninstall.php) should have been added to your project.