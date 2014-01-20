ffsync-web
==========

Web interface to Firefox Sync Bookmarks

I can see this being useful in at least two situations:
* You're not on your personal PC and want to access your bookmarks without sync'ing your entire collection to the machine
* You want to use this as a bookmark sharing "platform" like Delicious, Shaarli, etc.

Demo [here](https://bkm.chromic.org/)

## Instructions

These instructions assume you have [composer](http://getcomposer.org/) installed to fetch Silex and Twig.

* Copy the files to your server and point your vhost's DocumentRoot to the public_html folder.
* See the [Silex Webserver Configuration](http://silex.sensiolabs.org/doc/web_servers.html) document for more details.
* Run `composer install` in the `private/lib/silex/` directory
* Copy /private/config.php.dist to /private/config.php
* Insert your configuration settings in /private/config.php

