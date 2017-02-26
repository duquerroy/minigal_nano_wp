=== Minigal Nano WP ===
Contributors: gduquerroy
Tags: gallery
Requires at least: 4.0
Tested up to: 4.6.1
License: GNU AFFERO GENERAL PUBLIC LICENSE v3 or later
License URI: https://gnu.org/licenses/agpl-3.0.txt

MinigalNano is a very simple image gallery.

== Description ==

MinigalNano is a very simple image gallery. It adheres to the KISS principle and is very easy to install. MinigalNano does not have a web admin interface: You just upload your images in the photo folder on your server (using FTP, SFTP...). It only requires php and GD (no database, no special libraries like PEAR or ImageMagick).

MinigalNano uses a javascript Lightbox (Use left/right arrows for navigation), but it degrades gracefully if javascript is disabled.

MinigalNano is based on [Thomas Rybak's](http://www.minigal.dk/minigal-nano.html) version which seems to have been abandonned in 2010. It adds new themes and icons, use more modern html/css, updates JS libs, and wants to be more community pull-friendly for the future.

Features
============
 * Very simple media gallery
 * Support for PNG, GIF, JPEG image formats
 * Support for OGV ad WEBM video
 * Javascript lightbox, degrades gracefull if JavaScript is disabled

Adding your photos
==================

* Simply add your photos to the `wp-content/uploads/` directory via FTP or SFTP.
* You can create as many subdirectories as you want.

Adding a comment to a gallery
=============================

* Simple create `comment.html` in the gallery's folder.

Adding a comment to an image
============================

* Create an html file. Filename must be the image filename plus `.html`. (eg. `myimage.jpg` => `myimage.jpg.html`)
* The html file can contain:
 * comment
 * title::comment

Using a custom image for folders
================================

* Create `folder.jpg` inside a folder: This image will be used as default image for folder.

How does file captions work?
================================
Create a file called captions.txt in the same subfolder to /photos as your image(s). To bind a comment to a photo, captions.txt must contain this structure:

image1.jpg|Caption 1
image2.jpg|Caption 2

etc...

But remember: captions.txt MUST be placed in the same folder as the image you want to comment!

Thumbnails
=========
You do not have to care about thumbnails: They are automatically created in the `thumbs` directory.
If some thumbnails are wrong, you can purge this directory: Thumbnails will be automatically re-created.

------------------------------------------------------------

License
=======

Icons used are from the Nitrux project and licensed under the Creative Commons Attribution-NonCommercial-NoDerivatives International
4.0 License (https://creativecommons.org/licenses/by-nc-nd/4.0/).

 * [Project contributors](https://github.com/sebsauvage/MinigalNano/blob/master/AUTHORS)
 * [Original discussion page (english)](http://sebsauvage.net/wiki/doku.php?id=minigal_nano_en)
 * [Original discussion page (french)](http://sebsauvage.net/wiki/doku.php?id=minigal_nano)


== Installation ==

1. Requires `php` and `php5-gd`
1. De-zip `minigal_nano_wp.zip` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place shortcode in your page

== Screenshots ==

1. Gallery
1. Gallery mediabox
1. Admin, Basic options
1. Admin, Advanced options