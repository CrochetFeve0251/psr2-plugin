## Description
This module intent to offer a logging library respecting PSR-3 standard and that you can extend easily.

## Install 
To install the library run the following command: `composer require wp-launchpad/logger-take-off`
## Structure 
On install the module creates new parameters into `configs/parameters.php`:
```php
 'log_enabled' => false,
 'log_handlers' => [
    \Launchpad\Dependencies\Monolog\MonologHandler::class,  
 ],
 'logger_name' => 'launchpad',
 'log_file_name' => 'launchpad.log',
 'log_path' => '',
 'log_debug_interval' => 0,
```
Each parameter control a configuration: 
- `log_enabled`: Enable or disable log.
- `log_handlers`: Handlers used in the logger.
- `logger_name`: Name from the Monolog logger.
- `log_file_name`: Name from the Monolog log file.
- `log_path`: Path from the Monolog logger.
- `log_debug_interval`: Interval before changing file.

You can easily create your own logger by implementing the `LaunchpadLogger\HandlerInterface` that follows the PSR-3 standard then add it to the `log_handlers` confguration.
