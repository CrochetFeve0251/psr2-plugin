# Beginner handbook

Starting developing inside a framework is always something slower than usual due to the number of new things to learn.

That is why, a beginner handbook has been created to try answering the main questions you will encounter while working with Launchpad.


## Setting a local environment

The first step with working on a plugin is to have something to test locally and visualize changes.

To keep this step simple, Launchpad provides [a local environment](./local-env.md).

## Working with subscribers

Subscribers are the central notion of Launchpad development.

[Creating subscribers and registering callbacks](./subscribers.md) will be the base of any feature you will develop.

## Wiring classes

Event if any logic in Launchpad starts in a subscriber, most of them will have dependencies.

Launchpad [offers auto wiring](./wiring.md) to ease these for developers.

## Adding a front-end

WordPress is not famous for its templating.

That is why[ Launchpad offers modules](./front.md) to work modern front-end solutions.

## Building a release

A Launchpad project is a development environment, and it is important to not use it as a plugin.

That is why Launchpad [offers a command `build`](./build.md) to generate a version from the plugin usable in the real world.


