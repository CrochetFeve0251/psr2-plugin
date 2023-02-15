## Rocket launcher
Rocket launcher is a boilerplate for WordPress plugin that allows you to create a modern PHP plugin in no 
time.

### Install
You create a new project with the following command `composer create-project crochetfeve0251/psr2-plugin my-plugin`.
Then you will have to run the script `build/init` to generate the project.

### Class generator
This boilerplate comes with a class generator that will make you save ton of time while developing new 
classes to use it you can run the following command `bin/generator`.

With this commandline the following command are available:
- `subscriber`: Generate a subscriber file and attach it to the project.
- `provider`: Generate a service provider file and attach it to the project.
- `test`: Generate a test file.
- `table`: Generate files for adding a new table to the project.

### Testing
This boilerplate offers an architecture that makes testing your code simple and time efficient.

For every test you will be able to fast generate new test cases with the fixtures.
You will be also able to mock unit tests quickly using Mockery and Brain Monkey.
Finally, the subscriber architecture will make it easier for you to create integration tests for your code.