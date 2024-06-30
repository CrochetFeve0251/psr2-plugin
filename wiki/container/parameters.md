## What are parameters

Not every value we want to register can be registered using a class.

Due to that need to add other values into the container than classes. 

These values are called parameters and can be an array, a string, a integer etc.

## Register a parameter

To register a parameter you will have to add it to the array inside the file `configs/parameters.php`.

The key of the parameter will be its name and the value its value.

```php
return [
   'key' => 100,
   'key2' => [
     'string'
   ],
];
```

## Use a parameter

To use a parameter you will have to call it from the constructor of the class when you are using the auto-wiring strategy:

```php
public function __construct($key) {

}
```
With the manual strategy you will have to call it from the container:
```php
$this->getContainer()->get('key');
```
