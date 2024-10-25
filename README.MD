## Launchpad
Launchpad is a framework for WordPress plugin that allows you to create a modern PHP plugin in no time.

### Install
You create a new project with the following command `composer create-project wp-launchpad/launchpad my-plugin`.
Then you will have to run the script `bin/generator` to generate the project.

### Class generator
This framework comes with a class generator that will make you save ton of time while developing new 
classes to use it you can run the following command `bin/generator initialize`.

With this commandline the following command are available:
- `initialize`: Initialize the project.
- `subscriber`: Generate a subscriber file and attach it to the project.
- `provider`: Generate a service provider file and attach it to the project.
- `test`: Generate a test file.
- `fixture`: Generate a fixture file and attach it to the project.
- `build`: Generate an optimized artifact for the plugin.

### Testing
This framework offers an architecture that makes testing your code simple and time efficient.

For every test you will be able to fast generate new test cases with the fixtures.
You will be also able to mock unit tests quickly using Mockery and Brain Monkey.
Finally, the subscriber architecture will make it easier for you to create integration tests for your code.

### Modules
Multiple modules are available to allow faster development on specific tasks:

| Module   | Description |
|:-------:|-------------|
| [Action scheduler](https://github.com/CrochetFeve0251/rocket-launcher-action-scheduler-take-off) | Handle asynchronous code or code to execute later|
|[BerlinDB](https://github.com/CrochetFeve0251/rocket-launcher-database)| A simple Database library |
|[Logger](https://github.com/CrochetFeve0251/rocket-launcher-logger-take-off) |A PSR-3 compatible logger|
|[Uninstaller](https://github.com/CrochetFeve0251/rocket-launcher-uninstaller-take-off) |Set actions to be done on uninstall|
|[Filesystem](https://github.com/CrochetFeve0251/rocket-launcher-filesystem-take-off)|Interact with the filesystem|
|[Front-end](https://github.com/CrochetFeve0251/rocket-launcher-front-take-off)|Create a front-end with Bud.js for your plug-in|
|[Hook extractor](https://github.com/CrochetFeve0251/rocket-launcher-hooks-extractor)|Extract hooks from your plugin into a yaml file|
