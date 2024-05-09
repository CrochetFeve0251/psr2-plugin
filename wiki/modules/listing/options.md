## Description

This module provides options facades.

For that we have 3 types of options:
- **Options**: Regular options.
- **Transients**: Temporary options.
- **Settings**: Plugin settings all saved in the same place.

## Install
To install the library run the following command: `composer require wp-launchpad/framework-options-take-off`


## Structure

Options are build around inflectors which add automatically facades to the objects aware about them.

For the `Options` you should implement the interface `LaunchpadFrameworkOptions\Interfaces\OptionsAwareInterface` and the trait `LaunchpadFrameworkOptions\Traits\OptionsAwareTrait`.
For the `Transients` you should implement the interface `LaunchpadFrameworkOptions\Interfaces\TransientsAwareInterface` and the trait `LaunchpadFrameworkOptions\Traits\TransientsAwareTrait`.
For the `Settings` you should implement the interface `LaunchpadFrameworkOptions\Interfaces\SettingsAwareInterface` and the trait `LaunchpadFrameworkOptions\Traits\SettingsAwareTrait`.