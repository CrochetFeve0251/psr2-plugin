# Local environment

Being able to run our code locally is not always a simple process as you have to set up a WordPress installation in local.

That is why Launchpad comes with a local environment easy to set up.

## wp-env

For that Launchpad uses a WordPress library called [wp-env](https://developer.wordpress.org/block-editor/getting-started/devenv/get-started-with-wp-env/).

Wp-env is working over Node.js and Docker, so the first step is to make sure both of them are installed:

- For Node, it is possible to find a tutorial to install it here: https://developer.wordpress.org/block-editor/getting-started/devenv/#node-js-development-tools
- For Docker, here is a tutorial: https://www.docker.com/products/docker-desktop/

Once this is done, it is now possible to install the project dependencies using the command `npm i` inside your Launchpad project.

If everything works correctly, it should create a new folder called `node_modules`.

## Booting the local environment

Now that everything necessary to launch the environment is installed, it is now time to boot it.

For that inside the Launchpad project folder open a terminal and run the following command `npm run wp-env:start`.

Once the command has finished executing, a new instance of WordPress should be running on your computer with your plugin installed.

To access it, you need to go to your browser and reach the URL `http://localhost:8888`.

In the same fashion as a WordPress website it is possible to access the administration going on the following URL `http://localhost:8888/wp-admin`.

**Note:** The username is `admin` and the password `password`.

## Stopping the local environment

As running a full environment is taking some resources and keeping it on all the time is not the best.

That is why it is possible to switch it off using the following command: `npm run wp-env:stop`.

## Cleaning the local environment

In the same logic, if you want to destroy the local environment cleanly to save some space, it is also possible with the command `npm run wp-env:destroy`.