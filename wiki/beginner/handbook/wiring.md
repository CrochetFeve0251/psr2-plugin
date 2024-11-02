# Wiring classes

Launchpad wires automatically classes between them for you using dependency injection.

## Understanding what is wiring

While writing code, it is a good practice to split classes by intent.

However, when doing this, we are facing another problem, assembling our classes.

For example, with the following classes:

```php
class Dependency {
    public function method() {
    
    }
}

class Subscriber {
    
    /**
     * @var Dependency
     */
    protected $dependency;
    
    public function __construct(Dependency $dependency) {
        $this->dependency = $dependency;
    }
    
    /**
     * @hook init
     */
    public function callback() {
        $this->dependency->method();
    }
}
```

To combine classes, we would need to write the following code:

```php
$subscriber = new Subscriber(new Dependency());
```

However, often that code is time expensive and often leads to conflicts when merging branches.

That is why Launchpad is doing this code by itself.

That way to load a dependency inside a class or a subscriber, you need to add it as a parameter from its constructor:

```php
class SubDependency {

}

class Dependency {

    /**
     * @var SubDependency
     */
    protected $subdependency;

    public function __construct(SubDependency $subdependency) {
        $this->subdependency = $subdependency;
    }

    public function method() {
    
    }
}

class Subscriber {
    
    /**
     * @var Dependency
     */
    protected $dependency;
    
    public function __construct(Dependency $dependency) {
        $this->dependency = $dependency;
    }
    
    /**
     * @hook init
     */
    public function callback() {
        $this->dependency->method();
    }
}
```

## Loading a framework parameter 

Sometimes it can be useful to load some parameters from the plugin inside the [`inc/parameters.php`](https://github.com/wp-launchpad/launchpad-examples/blob/c130dc6bd1f4ac6a5352c507eb31c79f9f69b1f6/base/configs/parameters.php#L10).

For parameters unlike classes, it is using the name from the parameter to wire it.

For example, if my parameters look like this:

```php
return [
    'app_client_id' => '12df12df1',
    'app_api_url' => 'https://example.org'
];
```

Then to wire these parameters into a class or a subscriber would look like that:

```php
class Subscriber {
    /**
     * @var string
     */
    protected $client_id;
    /**
     * @var string
     */    
    protected $api_url;
    
    public function __construct(string $app_client_id, string $app_api_url) {
        $this->client_id = $app_client_id;
        $this->api_url = $app_api_url;
    }
}
```
