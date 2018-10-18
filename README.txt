# === Cambria Chat Frame ===
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This is a WordPress plugin for Cambria Solutions\' chat frame.

== Description ==
This includes Cambria\’s chat frame as a react app. 
Inside the public/app/src folder you can customize the colors, 
title, activation preferences, and the destination of the bot itself.

== Prerequisites ==
1. Install WordPress locally 
* [for mac](https://codex.wordpress.org/Installing_WordPress_Locally_on_Your_Mac_With_MAMP)
* [for pc](https://codex.wordpress.org/Test_Driving_WordPress#Installing_WordPress_on_Your_Windows_Desktop)

== Installation ==
1. Upload `cambria-chatframe.php` to the `/wp-content/plugins` directory
2. Activate the plugin through the \‘Plugins\’ menu in WordPress


== Customization ==

### Incorporation the chatbot itself
This plugin is designed to work with a [ Dialogflow ](https://dialogflow.com/docs) agent. The communication requires two web-hooks, one to communicate with the chat window, and one to communicate with the agent. Both URI/'s are set
in `public/app/src/App.js` as `dfWebhookOptions`
* `eventUrl` = dialogflow web-hook
* `textUrl` = function to send the user request from our chat frame to the web hook

Once these are populated under `dfWebhookOptions` they are passed to our window as a prop.

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
Our window is conditionally loaded on pages that we have "white-listed". These can be modified in the `public/class-cambria-chatframe-public.php`
file in the `$acceptedPathArray` array. 