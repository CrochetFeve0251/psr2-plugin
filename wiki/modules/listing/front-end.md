## Description
This module provides a front-end for your plug-in based on Bud.js.


## Install 
To install run the following command: `composer require wp-launchpad/front-take-off --dev`
## Structure 

All resources used for the front are inside the `_dev` folder.
To install dependencies run `npm i`.

When you build assets they will go to the assets folder.

## Use Bud.js asssets
If you need to enqueue your assets into your plugin then you can use the trait `MyNamespace\LaunchpadFront\UseAssets` and an interface `MyNamespace\LaunchpadFront\UseAssetsInterface`.

Then you can use the following methods:

- `enqueue_script`: to enqueue a script.
- `enqueue_style`: to enqueue a style.

To use these methods they works exactly as the WordPress ones except on the name from the script which should be the name from your bud endpoint.
