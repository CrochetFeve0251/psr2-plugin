## Minimal structure 
Simple modules that are here to install a library don't require more than a `composer.json` file.

All field Launchpad uses to install the library are inside "meta" / "Launchpad" field from the JSON.

If you need to install a libary then you need to add the field "libraries" and put the library and its version as value:
```json
{

   "meta": {
      "launchpad": {
         "libraries": {
            "my-library": "version"
         }
      }
   }
}
```

## Adding some logic
Sometimes you will need to execute more actions than adding a library.

In this case you will have to create a specific command that will run when the module is required into the project.

### Creating the command
The install command is a simple CLI and to create it that would be as easy as for a regular commmand.

For that you can check the [page of the wiki](../cli/creating-command.md) about that.
### Registering the command 
Once your command is created and the service provider linked to it too.

You can then register it to the module for that you will have to add two new fields:
- "command": This will be the name of the command to execute.
- "provider": This will be the full name of the provider to add to the CLI when installing.

```json
{

   "meta": {
      "launchpad": {
         "command": "install",
         "provider": "MyProvider",
      }
   }
}
```


## Clean up the package 
In most cases you don't need anymore the installation package.

That's why you can set an automatic clean up from the installation package when the installation is finished.

For that you need to add "clean" to `true` inside the  `composer.json`:
```json
{

   "meta": {
      "launchpad": {
         "libraries": {
            "my-library": "version",
            "clean": true
         }
      }
   }
}
```
