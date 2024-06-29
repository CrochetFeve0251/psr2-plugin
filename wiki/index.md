
## What is Launchpad ?

Launchpad is a PHP framework to build WordPress plugins faster and with better standards.

It comes with the following features:
- A possibility to initialize a plugin in 2 commands.
- A CLI to generate classes for you.
- An architecture which is test friendly.
- Modules that allows you to extend the experience with popular libraries like Action Scheduler.


## The philosophy behind Launchpad

Today the WordPress community is notorious for its code standards.

This is due to numerous reasons such as the lack of a common architecture, the difficulty to produce proper code or even the hook API that can be obscure on some plugins.

Launchpad comes as a solution to these problem by offering a clean reusable base for plugin project allowing WordPress developers to finally work in a modern environnement at a low cost.

That's for these reasons that the base of this framework is opinionated.

However, WordPress plugin developers are also deeply attached to their freedom.

That's why the architecture is built around the developers needs but at the same time tries to enforce them as few possible by not forcing their code to extend from any class nor having to follow a certain architecture in the business logic more that the strict necessary.

Instead, the framework tries to provide a core as small as possible bundled a huge variety of blocks to the developers that they can install and use when they judge it necessary.

This notion of blocks is present at multiple level through the framework.

It can take the form of modules that are possible to quickly add into the project allowing usage from code between project in a couple of minutes.

But it can also take the form of traits that will be used to load automatically certain classes into your business classes providing helper logics or facades to handle certains operations faster.

When necessary it is also possible to create your own traits and modules to adapt the framework to your needs and own specifications without having to copy and paste code between projects.


## Architecture


