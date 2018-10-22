# Cambria Chat Frame

Contributors:
Donate link: cambriasolutions.com
Tags:
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This is a WordPress plugin for Cambria Solutions' chat frame.

## Description

This includes Cambria’s chat frame as a react app.
Inside the `public/app/src folder` you can customize the colors,
title, activation preferences, and the destination of the bot itself.

## Prerequisites

1. To run locally, install WordPress and serve with MAMP of XAMPP

- [Mac](https://codex.wordpress.org/Installing_WordPress_Locally_on_Your_Mac_With_MAMP)
- [PC](https://codex.wordpress.org/Test_Driving_WordPress#Installing_WordPress_on_Your_Windows_Desktop)

## Installation

1. Upload `cambria-chatframe.php` to the `/wp-content/plugins` directory
2. Activate the plugin through the `Plugins` menu in WordPress

## Customization

### Incorporation the chatbot itself

This plugin is designed to work with a [Dialogflow](https://dialogflow.com/docs) agent. The communication
requires two web-hooks, one to communicate with the chat window, and one to communicate with the agent.
Both URI/'s are set in `public/app/src/App.js` as `dfWebhookOptions`

- `eventUrl` = dialogflow web-hook
- `textUrl` = function to send the user request from our chat frame to the web hook

### Styling the chat frame

The following attributes are customizable in `public/app/src/App.js`

1. `avatar` = the image used as an avatar
2. `primaryColor` = the color of the chat frame itself
3. `secondaryColor` = the color of the suggestion buttons
4. `title` = the name of the chatbot
5. `fullscreen` = boolean specifying if the chat window should be fullscreen on start
6. `initialActive` = boolean specifying if the chat window should open on page load

### Building the chat frame

At its core, the plugin pulls any js files from the `/app/build/static/js/` folder and injects them to whatever pages we
have specified. Any changes to the app folder require `npm run build` or `yarn run build` to be run in the command line.

To exclude map files from being generated, create a .env file in the root directory with `GENERATE_SOURCEMAP=false`

### Specifying pages for the window to live

Our window is conditionally loaded on pages that we have "white-listed". These can be modified in the
`public/class-cambria-chatframe-public.php` file in the `$acceptedPathArray` array.

## How it Works

At its simplest, a WordPress plugin is a PHP file with a plugin header
comment. A plugin enables us to extend WordPress functionality without touching
the WordPress core. The process of a WordPress plugin is as follows:

1. WordPress scans its `/wp-content/plugins` directory for PHP files with the
   header. Wordpress then registers the activation and deactivation hooks for the plugin
   and the plugin will show up in the ‘Plugins’ menu in WordPress.

2. On activation, plugins can run a routine to add rewrite rules, add custom
   database tables, or set default option values.

   Our plugin requires none of these abilities and is simply created via the
   `register_activation_hook( __FILE__, 'activate_cambria_chatframe' );`
   hook. This activates our plugin, who's primary purpose is to conditionally
   insert our js files to specified pages.

3. As the page is loaded, WordPress checks to see if any plugins are active,
   if so, instantiate the logic supplied by the plugin files.

4. Our plugin fires the 'wp_footer' action and creates a div with the id of
   "root" right before the closing </body> tag.

5. Then our plugin fires the 'wp_enqueue_scripts', which enqueues items that
   are meant to appear on the front end.

6. The plugin then checks to see if the current page is part of our array of
   white-listed pages.

7. If so, our plugin scans the `/app/build/static/js/` folder, and calls
   `wp_enqueue_script` for each which registers and enqueues the included js files.

8. We set $in_footer to true, so that the scripts are enqueued before </body>
   instead of in the <head>. We do this because or js files depend on
   the div with the id "root", which occurs just before our scripts are loaded.

9. Our compiled js creates the chatframe, and populates the div mentioned
   earlier.
