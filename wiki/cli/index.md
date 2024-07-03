
With this commandline the following command are available:

- `initialize`: Initialize the project.
- `subscriber`: Generate a subscriber file and attach it to the project.
- `provider`: Generate a service provider file and attach it to the project.
- `test`: Generate a test file.
- `fixture`: Generate a fixture file and attach it to the project.

### Initialize
To initialize the project.
It is possible to run that command only one time it is removed right after.

On the command the following options are available:
| Option        | Short option | Value              | Default | Description                                                                 |
|:-------------:|:------------:|:------------------:|:--------|:---------------------------------------------------------------------------:|
| name          |     n        | your name          | false   | Name from the plugin                                                        |
| description   |     d        | your description   | false   | Description from the plugin                                                 |
| author        |     a        | the author         | false   | Author from the plugin                                                      |
| url           |     u        | the url            | false   | URL from the plugin                                                         |
| php           |     p        | PHP version        | false   | Minimal PHP version to make the plugin running                              |
| wp            |     w        | WP version         | false   | Minimal WordPress version to make the plugin running                        |


### Subscriber
To create a subscriber run the following command: `subscriber Namespace/MyClass`.

On the subscriber command the following options are available:
| Option | Short option | Value   | Short value | Default | Description                                                       |
|:------:|:------------:|:-------:|:-----------:|:--------|:-----------------------------------------------------------------:|
| type   |     t        | common  | c           | true    | Common subscriber that load on both administration view and front |
| type   |     t        | admin   | a           | false   | Common subscriber that load only on administration view           |
| type   |     t        | front   | f           | false   | Common subscriber that load only on front                         |

### Provider
To create a service provider run the following command: `provider Namespace/MyClass`.

### Test
To create tests matching all public functions from a class run the following command: `test Namespace/MyClass`.

To create tests matching a single function from a class run the following commad: `test Namespace/MyClass::my_method`.

On the test command the following options are available:
| Option     | Short option | Value         | Short value    | Default | Description                                                       |
|:----------:|:------------:|:-------------:|:--------------:|:--------|:-----------------------------------------------------------------:|
| type       |     t        | both          | b              | true    | Create both unit and integration tests                            |
| type       |     t        | unit          | u              | false   | Create unit tests                                                 |
| type       |     t        | integration   | i              | false   | Create integration tests                                          |
| group      |     g        | your value    | your value     | false   | Add a group to tests                                              |
| expected   |     e        | present       | p              | false   | Force the expected parameter on tests                             |
| expected   |     e        | absent        | a              | false   | Force the expected parameter to be absent on tests                |
| scenarios  |     s        | value1,value2 | value1,value2  | false   | Add scenarios to the fixtures from the tests                      |
| external   |     x        | your value    | your value     | false   | Add external run for integration tests                            |

### Fixture
To create a service provider run the following command: `fixture MyClass`.

## Build
To build an optimized artifact from project run the following command: `build`.

---------------------------------------------------------------------
| Option  | Short option | Value | Short value | Default |                     Description                     |
|:-------:|:------------:|:-----:|:-----------:|:-------:|:---------------------------------------------------:|
| release |      r       | 1.0.0 |    1.0.0    |  none   |   Fix the value from the version of the artifact    |
|  type   |      t       | fixed |      f      |  patch  | Prevent increase from the version from the artifact |
|  type   |      t       | major |      M      |  patch  |     Increase the major field from the artifact      |
|  type   |      t       | minor |      m      |  patch  |     Increase the minor field from the artifact      |
|  type   |      t       | patch |      p      |  patch  |     Increase the patch field from the artifact      |
