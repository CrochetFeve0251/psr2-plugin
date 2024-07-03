
## General
The first when understanding the architecture of a project is to get the general overview of the project and it's purposes.

Unlike most of WordPress plugin if you search inside Launchpad code base you won't be able to find a lot of references to `add_action` or `add_filter` methods which are normally an institution in Wordpress plugins.

This is due to the Subscriber based Architecture of the project instead of adding this function of each piece of our code and have mock it back afterwards during tests, we centralised it in one place and automatically add it.

That why most pieces of logic inside the plugin finish by a subscriber.

## Subscriber loading

To load these subscribers and to allow us to have IOC we are using league container that is loading inside the `inc/plugin.php` file inside the core.

Inside the `configs/providers.php` file we register all Services providers from the app that provides any class that are present inside the plugin.

With this service providers we will then load needed subscribers depending on the context.
