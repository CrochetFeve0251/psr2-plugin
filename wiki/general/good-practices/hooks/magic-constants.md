Magic constant are often values that the developer set in his code without apparent reason.
That can be for example a value like `3.14` inside a calculus or `24` inside an interval as you can see in the following code:

```php
$radius = 3.14 * $perimeter;
$period = 24 * 60 * 60;
```

As you can see even in this case it is simple we have two main problems with that code.

First it is up the programmer to guess what these values are. This is a code smell in the fact it increases the mental mapping from the programmer forcing him to remember that value.

The second issue we have this with that code is the problem of the non flexibility of the code.

In the case the value could be modified without impacting the validity of the code then the user will be fixed the developer value without anyway to modify it.

To address that issue we have two solution.
In the case of the magic value that can't be modified like in this example:

```php
$radius = 3.14 * $perimeter;
```

Then we can use a constant that we will share between each of its usages like this:

```php
define('PI', 3.14);
$radius = PI * $perimeter;
```

In the case of the magic value that is based on a decision from the developer and could be modified like in this example:

```php
$period = 24 * 60 * 60;
```

Then we can use a filter to make the value easily modifiable by the user later but also provide more information on what it is:

```php
/**
 * Interval for the period which is by default 24hrs.
 * @param int $interval Interval for period in seconds.
 **/
$period = apply_filter('period_interval', 24 * 60 * 60);
```

That way we can satisfy two kinds of users:

- The debutant who will have a default choice already made for them and so won't know about this decision which has been made for them.
- The expert who has with the filter a possibility to adapt the plugin to his needs.