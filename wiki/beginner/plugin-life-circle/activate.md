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

To create an activator, any class can be used as the only requirement is to use the `@activate` annotation inside the docblock of at least one of the methods:

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

For that it is important to first add the necessary logic into the provider using `` and ``:

```php

```