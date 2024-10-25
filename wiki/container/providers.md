## Configurations
All service providers from Launchpad are registered inside the `configs/providers.php`.

If you need to add or remove a service provider you will have to register it there.

## Service providers structure 
Each section from the project have it's own service provider.

They are like the pillar sections are build around as they are the link to the container which links classes together.
Theses service providers are structured in 3 parts:
- A declarative part where the service provider declares which IDs (classes) he is providing.
- A part for subscribers where the service providers declare subscribers and their type.
- A part to load and link classes together.

### Wiring strategies
Currently, two strategies are possible to wire classes between them:
- Auto wiring which let the framework resolve classes by itself.
- Manual wiring that require  the developer to tell the framework what goes where.

Both strategies have advantages and drawbacks however it is strongly advised for a beginner to use auto wiring to simplify his development.

### Subscriber declaration
To declare which subscriber it will provider to the application each provider can use 3 methods returning ids from the subscribers from that type:
- `get_common_subscribers`: Returns the ids of common subscribers.
```php
public function get_common_subscribers(): array {
   return [
      MySubscriber1::class,
      MySubscriber2::class,
   ];
}
``` 
- `get_front_subscribers`: Returns the ids of front subscribers.
```php
public function get_front_subscribers(): array {
   return [
      MySubscriber1::class,
      MySubscriber2::class,
   ];
}
``` 
- `get_admin_subscribers`: Returns the ids of admin subscribers.
```php
public function get_admin_subscribers(): array {
   return [
      MySubscriber1::class,
      MySubscriber2::class,
   ];
}
``` 
