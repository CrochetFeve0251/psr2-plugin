# Build a release

Unlike most boilerplates, Launchpad comes as a developing environment which means it includes the code from the plugin but also some code to make your developing experience more confortable.

This is why it is important to never push a Launchpad project as it is on a WordPress website.

Instead, you should pass by the `build` command that will sort what should go to the final plugin and development dependencies.

## The build command 

The build command is here to abstract all operations necessary to prepare a secure and optimised version from the plugin which can be used on a real WordPress website.

To run the process, it is possible to run the following command `bin/generator build` inside the folder from the Launchpad project.

Once the command finished executing a new folder `build` should be present inside your project.

If you go inside it, two versions from the plugin should be present:
- Within a folder: this version is the best if you want to install by FTP or you need to manipulate files.
- Within a zip: this version is the best to install by the WordPress back office.

By default, at each run from the command the version will increment by itself.

### Set the release

However, it is possible to define the version from the release we want to build using the `-r` parameter.

It is possible to use it the following way:
```shell
bin/generator build -r 2.1.3
```