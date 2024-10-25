## Description

A command bus for the Launchpad framework.

## Install
Just run the following command:
```composer require wp-launchpad/bus-take-off```

## Usage

With this commandline the following command are available:

- `bus:make:query`: Generate a query file and attach it to the project.
- `bus:make:command`: Generate a command file and attach it to the project.

### Make query
To create a query run the following command: `bus:make:query Namespace/MyClass`.

### Make command
To create a subscriber run the following command: `bus:make:command Namespace/MyClass`.

