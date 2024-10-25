## Description
This module intent to help you exporting the list of hooks from a plugin into a YAML file.

## Install
To install this module you need to run the following command: `composer require wp-launchpad/hooks-extractor --dev`
## Commands

With this commandline the following command are available:
- `hook:extract`: Generate a file with hooks from your plugin.

### Hook:extract
Generate a file with hooks from your plugin.

On the command the following options are available:
| Option         | Short option | Value             | Default              | Description                                                             |
|:--------------:|:------------:|:-----------------:|:---------------------|:-----------------------------------------------------------------------:|
| input          |     i        | file.yml          | none                 | Input file                                                              |
| output         |     o        | file.yml          | hooks-output.yml     | Output file                                                             |
| configurations |     c        | file.yml          | hook-extractor.yml   | Configuration file                                                      |

### Input file

This file is here to provide some informations to help the command return an exhaustive list from your hooks.
For that it provides multiple fields:
- `repository`: URL from the repository 
- `branch`: branch from the repository


### Configuration file
This file is here to configure in which folder it needs to search for filters and actions.

