## Description

Action Scheduler is a famous library to create a functional queue system into Wordpress easily.

This module offers you the power from Action Scheduler encapsulated into an object structure that will help you create code using it with proper standards.


## Install

To install that library, you just have to run that command: `composer require action-scheduler-take-off`

## Structure

This module provides you two classes to extends to create an Action Scheduler queue:
- `AbstractASQueue`: it represents the actual queue.
- `AbstractQueueRunner`: it handles the logic to run the queue.

To extend the `Queue` class then you will the to define the group from the class like following:
```php
class MyQueue extends AbstractASQueue {
   public function __construct(string $prefix){ 
      parent::__construct('my-group', $prefix);
   }
}
```

Then it is also possible to define a specific behaviour for your queue and run it aside from other actions from other queues. For that you have to define an `AbstractQueueRunner` for class.

To create a queue runner for your class you need to extend the `AbstractQueueRunner` class:

```php
class MyQueueRunner extends AbstractQueueRunner {
    public function __construct( string $prefix, string $translation_key, ActionScheduler_Store $store = null, ActionScheduler_FatalErrorMonitor $monitor = null, ActionScheduler_QueueCleaner $cleaner = null, ActionScheduler_AsyncRequest_QueueRunner $async_request = null, ActionScheduler_Compatibility $compatibility = null, ActionScheduler_Lock $locker = null ) {
  parent::__construct('my-group', $prefix, $translation_key, $store, $monitor, $cleaner, $async_request, $compatibility, $locker);
}
}
```