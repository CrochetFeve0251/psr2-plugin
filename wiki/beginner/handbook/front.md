# Front-end

Launchpad does not provide any front-end feature directly into its core.

However, it is possible to use some modules to help you at that point:
- A renderer module.
- A front-end module.

Depending on your needs one or the other, will suit your project better.

## Renderer module 

The renderer is a way to separate easier logic from the views inside your plugin.

This module is thought as a small library rather than a bulletproof approach.

### Install

To install it, it is possible to use the following command `composer require wp-launchpad/renderer-take-off --dev` inside the folder from the Launchpad project.

Once it is installed a new provider should be installed inside [`inc/providers.php`](https://github.com/wp-launchpad/launchpad-examples/blob/f95ed8d0fb15641a16e98d52a796379d5e507afd/renderer/configs/providers.php#L7) and a new folder should be present [`templates`](https://github.com/wp-launchpad/launchpad-examples/tree/main/renderer/templates).

### Create a new template

To create a new template a new template, we first need to call it and pass it some data.

For example, to [call the template `my-template`](https://github.com/wp-launchpad/launchpad-examples/blob/26d46475ce599e1bc89421a3420a111010e4476a/renderer/inc/Subscriber.php#L13) with a parameter `title` and the value `My title` :

```php
do_action("my_plugin_prefix_render_template", 'my-template' ,[
    'parameters' => [
        'title' => 'My title'
    ]
]);
```

Once this is done, we need to create inside the folder [`templates`](https://github.com/wp-launchpad/launchpad-examples/tree/main/renderer/templates) the template file matching the template we called, [`templates/my-template.php`](https://github.com/wp-launchpad/launchpad-examples/blob/main/renderer/templates/my-template.php).

Finally, once this is done, it is possible to use parameters we passed to the template inside it:

```php
<div>
    <h2><?php echo $title ?></h2>
</div>
```

If you want to check the whole code at [the example repository](https://github.com/wp-launchpad/launchpad-examples/tree/main/renderer).

## Front-end module

The front-end module is thought more for the more complex front-end using some modern libraries and frameworks to handle it.

### Install 

To install it, it is possible to use the following command `composer require wp-launchpad/front-take-off --dev` inside the folder from the Launchpad project.

Unlike most modules, this module requires you to take an action once installed.

### Front-end technologies

Launchpad front-end modules propose you to pick one of the following technologies for your front-end:
- `Javascript vanilla`
- [`React.js`](https://react.dev/)
- [`Vue.js`](https://vuejs.org/)

### Install the correct front-end

To install the front-end library you want it is possible using the command `bin/generator front:install` with a parameter matching the version you want:
- Javascript vanilla: `bin/generator front:install vanilla`
- React.js: `bin/generator front:install react`
- Vue.js: `bin/generator front:install vue`

Once this is done then the command `bin/generator front:install` should have disappeared and a new folder [`_dev`](https://github.com/wp-launchpad/launchpad-examples/tree/main/front-end/_dev) should be present on the project.

### Working with assets

All front-end resources
required for developing are present within [`_dev` folder](https://github.com/wp-launchpad/launchpad-examples/tree/main/front-end/_dev) for one simple reason:
it is easier to remove these assets when [building the production version](./build.md) from the plugin.

Assets inside that folder are organized around a Node.js project using [Bud.js](https://bud.js.org/) to build assets.

The reason behind this choice is due to the fact Bud.js is thought for WordPress and its constraints and due to that it is hard to find a better fit.

#### Installing dependencies

As any Node.js project working with Launchpad front-end assets project requires to install its dependencies.

To do so make sure you are inside the [`_dev` folder](https://github.com/wp-launchpad/launchpad-examples/tree/main/front-end/_dev) from your Launchpad project and execute the following command: `npm i`.

Once this command executed you should have a new folder `node_modules` inside the Launchpad front-end assets project.

#### Building assets

In the same fashion as a Launchpad project,
development resources are not intended to be directly used on production
and so it is mandatory
to pass by a building step before being able to have the real assets that will be used in the plugin.

For that it is possible to run the command `npm run build` inside the [`_dev` folder](https://github.com/wp-launchpad/launchpad-examples/tree/main/front-end/_dev).

Once it finished
executing [a new folder `assets`](https://github.com/wp-launchpad/launchpad-examples/tree/main/front-end/assets) should have appeared inside your Launchpad project.

#### Editing resources

Any file
containing some business logic will be inside the [`src` folder](https://github.com/wp-launchpad/launchpad-examples/tree/main/front-end/_dev/src) from [`_dev` folder](https://github.com/wp-launchpad/launchpad-examples/tree/main/front-end/_dev).

By default,
the project is configured with one [entry point `app.js`](https://github.com/wp-launchpad/launchpad-examples/blob/main/front-end/_dev/src/app.js) and only code inside this or code imported inside this file
will be compiled into the [`assets` folder](https://github.com/wp-launchpad/launchpad-examples/tree/main/front-end/assets).

However,
it is possible to add more entry points
by configuring the [`bud.config.js` file](https://github.com/wp-launchpad/launchpad-examples/blob/main/front-end/_dev/bud.config.js).

For example,
if you want another [script `admin.js`](https://github.com/wp-launchpad/launchpad-examples/blob/main/front-end/_dev/src/admin.js) for your back office script then it is possible to define it as a new entry point inside the [`bud.config.js` file](https://github.com/wp-launchpad/launchpad-examples/blob/main/front-end/_dev/bud.config.js):

```js
/**
 * @typedef {import('@roots/bud').Bud} Bud
 *
 * @param {Bud} bud
 */
module.exports = async bud => {
    bud.externals({
        jQuery: 'window.jquery',
        wp: 'window.wp',
        react: 'window.React'
    })
    await bud
        .setPath('@dist', '../assets')
        .entry({
            app: 'app.js',
            admin: 'admin.js'
        })
        .when( bud.isProduction, () => bud.splitChunks().minimize() )
}

```

In the same fashion, it is also possible to add CSS entrypoints to also take advantage of modern CSS technologies.

For example,
if to make [a CSS file `app.css`](https://github.com/wp-launchpad/launchpad-examples/blob/main/front-end/_dev/src/app.css) become an entrypoint,
we can do the following inside the [`bud.config.js` file](https://github.com/wp-launchpad/launchpad-examples/blob/main/front-end/_dev/bud.config.js): 

```js
/**
 * @typedef {import('@roots/bud').Bud} Bud
 *
 * @param {Bud} bud
 */
module.exports = async bud => {
    bud.externals({
        jQuery: 'window.jquery',
        wp: 'window.wp',
        react: 'window.React'
    })
    await bud
        .setPath('@dist', '../assets')
        .entry({
            app: [
                'app.js',
                'app.css'
            ]
        })
        .when( bud.isProduction, () => bud.splitChunks().minimize() )
}

```

### Enqueueing assets

While having the assets built is one thing, having WordPress loading these assets is another.

To achieve this,
we would have
to take advantage of the WordPress enqueue API and the helper given inside Launchpad front-end module to make it easier.


#### Understanding the assets folder

Unlike what could be expected, the [`assets` folder](https://github.com/wp-launchpad/launchpad-examples/tree/main/front-end/assets) is not reflecting your entry points, which can be misguiding at the beginning.

Instead, the folder contains the following elements:
- [`js` folder](https://github.com/wp-launchpad/launchpad-examples/tree/main/front-end/assets/js)
- [`css` folder](https://github.com/wp-launchpad/launchpad-examples/tree/main/front-end/assets/css) if you have at least a CSS entrypoint
- [`entrypoints.json` file](https://github.com/wp-launchpad/launchpad-examples/blob/main/front-end/assets/entrypoints.json)
- [`manifest.json` file](https://github.com/wp-launchpad/launchpad-examples/blob/main/front-end/assets/manifest.json)

That is due to the fact the output files are often more complex than just the entrypoint files.

This is why Bud.js uses a system to always map final assets to the entries.

To understand that we need to first open the [`entrypoints.json` file](https://github.com/wp-launchpad/launchpad-examples/blob/main/front-end/assets/entrypoints.json):

```json
{
  "app.css": "css/app.css",
  "app.js": "js/app.js",
  "admin.js": "js/admin.js",
  "runtime.js": "js/runtime.js",
  "entrypoints.json": "entrypoints.json"
}
```

What you can see in this file is a mapping between the name from the entrypoint and the path from its final asset.

For example, if we want to find back the file corresponding to the [entrypoint `app.js`](https://github.com/wp-launchpad/launchpad-examples/blob/main/front-end/_dev/src/app.js), the mapping tells you it will at the [path `js/app.js`](https://github.com/wp-launchpad/launchpad-examples/blob/main/front-end/assets/js/app.js).

However,
just loading [`js/app.js`](https://github.com/wp-launchpad/launchpad-examples/blob/main/front-end/assets/entrypoints.json#L2-L6)
will result as an error as this scripts has dependencies.

This is where [`manifest.json` file](https://github.com/wp-launchpad/launchpad-examples/blob/main/front-end/assets/entrypoints.json) becomes useful:

```json
{
  "app": {
    "js": [
      "js/runtime.js",
      "js/app.js"
    ],
    "css": [
      "css/app.css"
    ]
  },
  "admin": {
    "js": [
      "js/runtime.js",
      "js/admin.js"
    ]
  }
}
```

It gives us dependencies from each entry point and the order they should be charged.

That way for [`js/app.js`](https://github.com/wp-launchpad/launchpad-examples/blob/main/front-end/_dev/src/app.js), we will to:
- Load [`js/runtime.js`](https://github.com/wp-launchpad/launchpad-examples/blob/26d46475ce599e1bc89421a3420a111010e4476a/front-end/assets/entrypoints.json#L4)
- Load [`js/app.js`](https://github.com/wp-launchpad/launchpad-examples/blob/26d46475ce599e1bc89421a3420a111010e4476a/front-end/assets/entrypoints.json#L5)

Hopefully Launchpad offers us a facade
to abstract all that logic with the [`Assets` class](https://github.com/wp-launchpad/bud-assets/blob/main/inc/Assets.php).

#### Enqueueing using Launchpad

To prevent having to deal with all these notions listed before it is recommended to use [`Assets` class](https://github.com/wp-launchpad/bud-assets/blob/main/inc/Assets.php).

The [`Assets` class](https://github.com/wp-launchpad/bud-assets/blob/main/inc/Assets.php) can be injected in any class using the [interface `UseAssetsInterface`](https://github.com/wp-launchpad/front/blob/main/inc/UseAssetsInterface.php) and the [trait `UseAssets`](https://github.com/wp-launchpad/front/blob/main/inc/UseAssets.php):

```php
class MySubscriber implements UseAssetsInterface {
    use UseAssets;
    
    
}
```

Once the class is injected, the next step is to use it to enqueue scripts.

Methods reflecting WordPress API are available but not recommended.

Instead, Launchpad front-end module enforces a builder approach to make it more lisible.

##### Select the type of asset

The first step is to call the right method depending on the type from the asset.

In case of a script, then you would use [`with_script` method](https://github.com/wp-launchpad/launchpad-examples/blob/0bfd94b7df24dc02206f5074d2d7f9e512c4b7c4/front-end/inc/Subscriber.php#L16):

```php
$this->assets->with_script('app.js');
```

In case of a style, then you would use [`with_style` method](https://github.com/wp-launchpad/launchpad-examples/blob/0bfd94b7df24dc02206f5074d2d7f9e512c4b7c4/front-end/inc/Subscriber.php#L24):

```php
$this->assets->with_style('app.css');
```

**Note:** In case of an asset built with Bud, you can directly indicate the name from the entry point.

##### Add more information

Once the type from the asset is selected, it is possible to add more information on it chaining methods on the base method.

###### Define a key

To define a custom key, you can use the [method `with_key`](https://github.com/wp-launchpad/launchpad-examples/blob/0bfd94b7df24dc02206f5074d2d7f9e512c4b7c4/front-end/inc/Subscriber.php#L17):

```php
$this->assets
    ->with_script('app.js')
    ->with_key('my_key');
```

###### Define dependencies
To define required dependencies, you can use the [method `with_dependencies`](https://github.com/wp-launchpad/launchpad-examples/blob/0bfd94b7df24dc02206f5074d2d7f9e512c4b7c4/front-end/inc/Subscriber.php#L18):

```php
$this->assets
    ->with_script('app.js')
    ->with_dependencies(['my_dependency_key']);
```
###### Move to footer
If the asset is a script, it is possible to force the script to be in the footer using the [method `in_footer`](https://github.com/wp-launchpad/launchpad-examples/blob/0bfd94b7df24dc02206f5074d2d7f9e512c4b7c4/front-end/inc/Subscriber.php#L21):

```php
$this->assets
    ->with_script('app.js')
    ->in_footer();
```
###### Define media
If the asset is a style, it is possible to set a media the style will be loaded on with the [method `with_media`](https://github.com/wp-launchpad/launchpad-examples/blob/0bfd94b7df24dc02206f5074d2d7f9e512c4b7c4/front-end/inc/Subscriber.php#L29):

```php
$this->assets
    ->with_style('app.css')
    ->with_media('desktop');
```
##### Enqueue or register the asset

WordPress authorizes two types of registrations on assets.

###### Enqueue

Enqueue is a way to load the asset on the page, adding the style or script into the HTML from the page.

On Launchpad, it is possible to enqueue an asset using the [method `enqueue`](https://github.com/wp-launchpad/launchpad-examples/blob/0bfd94b7df24dc02206f5074d2d7f9e512c4b7c4/front-end/inc/Subscriber.php#L30) at the end of the chain:

```php
$this->assets
    ->with_script('app.js')
    ->enqueue();
```

###### Register

Register is a way to make an asset available to other scripts without loading it on the page.

That way, the asset would be loaded only if another asset requires it as a dependency.

On Launchpad, it is possible to register an asset using the [method `register`](https://github.com/wp-launchpad/launchpad-examples/blob/0bfd94b7df24dc02206f5074d2d7f9e512c4b7c4/front-end/inc/Subscriber.php#L22) at the end of the chain:

```php
$this->assets
    ->with_script('app.js')
    ->register();
```