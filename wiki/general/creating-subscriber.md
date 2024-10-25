
## Create your subscriber

In Launchpad there are two ways to create a subscriber.

This is due to the fact the classic way provides more security preventing the developer from making certain mistakes but the counterpart is on performance as the reflection API is used in that method.

### The classic way

To create a subscriber the classic way there is nothing easier.

Just create a class.

Then for each callback create first a public method and then add the docblock `@hook` with the name of the event to register on:
```php
namespace Launchpad\Subscriber;

class Subscriber {
	/**
	* @hook hook_name
 	*/
	public function callback($param1, $param2) {
    
	}
}
```

It is possible to add a priority by adding a number after the event the following way:
```php
namespace Launchpad\Subscriber;

class Subscriber {
	/**
	* @hook hook_name 10
 	*/
	public function callback($param1, $param2) {
    
	}
}
```

Concerning the number of parameters this is done automatically by the framework and there is no need to indicate it.

### The optimized way

In Launchpad every optimized subscriber needs to implements the interface `Launchpad\Dependencies\LaunchpadCore\EventManagement\SubscriberInterface`.

Due to that your subscriber should look like that:
```php
<?php
namespace Launchpad\Subscriber;

use Launchpad\Dependencies\LaunchpadCore\EventManagement\SubscriberInterface;

/**
 * An event subscriber.
 *
 */
class Subscriber implements SubscriberInterface {
	/**
	 * Return an array of events that this subscriber wants to listen to.
	 *
	 * Each method callback is a public method in this subscriber class.
	 *
	 * @access public
	 *
	 * @return array
	 */
	public static function get_subscribed_events() {
		return [];
	}
}
```

Once you created the base from your subscriber you will then have to callbacks to the subscriber.

For that inside the `get_subscribed_events` method we will have to return an array containing the mapping between callbacks from the subscriber and events.

To create a callback you just need to create a public function with the parameters you need:
```php 
public function callback($param1, $param2) {

}
```
Then if it is a filter you will have to return a value:
```php 
public function callback($param1, $param2) {
   return $param1;
}
```

Finally you will have to register your callback to the event for that there is multiple syntaxes:
- The easiest way is to just register the callback: `'hook_name'   => 'method_callback'`.
- If you need to register the callack with a priority or more than one param, you can then use the array syntax: `'hook_name_3' => [ 'method_callback_3', 10, 2 ],`
- If you have multiple callbacks then you will have to use the array syntax wrapped into an array: `'hook_name_4' => [
			    [ 'method_callback_4' ],
			    [ 'method_callback_5' ],
			],`
			
At the end you should have this structure for your subscriber:
```php
<?php
namespace Launchpad\Subscriber;

use Launchpad\Dependencies\LaunchpadCore\EventManagement\SubscriberInterface;

/**
 * An event subscriber.
 *
 */
class Subscriber implements SubscriberInterface {
	/**
	 * Return an array of events that this subscriber wants to listen to.
	 *
	 * Each method callback is a public method in this subscriber class.
	 *
	 * @access public
	 *
	 * @return array
	 */
	public static function get_subscribed_events() {
		return [
			'hook_name'   => 'method_callback', // With no parameters for the hook
			'hook_name_2' => [ 'method_callback_2', 10 ], // With the priority parameter
			'hook_name_3' => [ 'method_callback_3', 10, 2 ], // With the priority & number of arguments parameters
			'hook_name_4' => [
			    [ 'method_callback_4' ], // Multiple callbacks can be hooked on the same event with a multidimensional array
			    [ 'method_callback_5' ],
			],
		];
	}
	
       public function method_callback_1($param1) {

       }
	
       public function method_callback_2($param1) {

       }

       public function method_callback_3($param1, $param2) {

       }
       
       public function method_callback_4($param1) {
          return $param1;
       }
       
       public function method_callback_5($param1) {
          return $param1;
       }
}
```

## Register your subscriber
Once we created your subscriber we need to then attach it to our plugin as an actual subscriber because for the moment is a simple class for the framework.

For that we will need go register it on a ServiceProvider as a subscriber.

With Launchpad default behavior we have 4 subscriber types:
- Common subscribers: Subscribers that load on any context.
- Administrative subscribers: Subscribers that load only when the admin dashboard is loaded.
- Front-end subscribers: Subscribers that load only on pages visible by regular users.
- Initialisation subscribers: Subscribers loading before other to modify the loading logic.

To define the type from we need to register the subscriber in the method matching the right type:
| Type | Method |
|:----:|:------:|
| common | `get_common_subscribers`   |
| admin  | `get_admin_subscribers`   |
| front  | `get_front_subscribers`   |
| init   | `get_init_subscribers`   |
