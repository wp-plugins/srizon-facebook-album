=== Srizon Facebook Album ===
Contributors: afzal_du
Donate link: http://www.srizon.com/srizon-facebook-album
Tags: Facebook, Album, Gallery, Photo Album, Photo Gallery, Facebook Connect, Facebook Album, Facebook Gallery
Requires at least: 3.3
Tested up to: 4.2.2
Stable tag: 2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This wordpress plugin fetches the facebook albums or the whole galleries from your Facebook Fanpage/Fanpages and display them on your site as albums and galleries. You can add as many albums and galleires as you want. It will generate the shortcodes automatically which you can copy/paste into your post or page

== Description ==

This wordpress plugin fetches the facebook albums or the whole galleries from your Facebook Fanpage/Fanpages and display them on your site as albums and galleries. You can add as many albums and galleires as you want. It will generate the shortcodes automatically which you can copy/paste into your post or page
= Demo =
* http://wp.srizon.com/srizon-facebook-album-demo/

= Free Version's Limitation =
This Free version shows only 25 images per album and 25 (or less) album covers per gallery. Also image caption (or description) is not fetched from facebook to show below the lightbox or as a caption

= Pro Version =
Pro version shows All the images from each album and all the album covers from each gallery. Image descriptions are also fetched for showing as image caption on lightbox.
You can also include/exclude albums in gallery view in pro version

* Go to: http://www.srizon.com/srizon-facebook-album to get the pro version

== Installation ==

1. Upload srizon-facebook-album folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the admin Menu 'FB Album' and Submenus under it to create albums and galleries
4. Get the auto generated shortcode and copy/paste into a page or post

== Frequently asked questions ==

= Can I add my own lightbox for the images =
Yes, You can. There's one lightbox added with this plugin. Also You'll find instructions inside on how to add fancybox as your lightbox. The process of adding other lightbox should be similar.

= Why there's only 25 images on my album =
This Free version shows only 25 images per album and 25 (or less) album covers per gallery. Get the Pro version to show all the images.

= Why the layout breaks on my template =
Most probably a duplicate jQuery is loaded (or a very older version of jQuery is loaded) by your theme or some other plugin.
This plugin loads the default jQuery provided with WordPress which should be used by all other plugins/themes also. 
Solution:
Find the plugin/theme that's loading a copy of it's own jQuery. Disable that plugin/theme or make changes to is so that it uses default jQuery provided with WordPress

== Screenshots ==
1. Gallery View (First Level)
2. Album - Collage layout
3. Responsive Lightbox
4. Slider layout variations
5. Other layouts
6. Common options (backend -1)
7. List of albums with shortcode (backend -2)
8. Add/Edit album (backend -3)
9. Add/Edit gallery (backend -4)

== Changelog ==

= 1.0.0 =
* First Release

= 1.1.0 =
*Minor Edit

= 1.1.1 =
*Added wp_remote_get as an alternative for getting the api response.

= 1.1.2 =
*bugfix

= 1.1.3 =
*bugfix

= 1.1.4 =
*Responsive lightbox 'Magnificent Popup' Added

= 1.2.0 =
*Fixed a problem where some images failed to appear for some facebook albums
*Modified so that it works on multisite setup

= 1.2.2 =
*Fixed small image problem on lightbox

= 1.2.3 =
*Small image on lightbox (more fix)
*Blank page on failed sync

= 1.3.1 =
*Changed some code to cope with facebook's recent change

= 1.4.0 =
*Cache data on file (if writable) for faster loading - It was database only previously
*Auto update feature for pro version
*Album and Image sorting option added
*Change the text for 'back to gallery' link in gallery view

= 1.4.1 =
*API request timeout increased in order to make it work on slower servers

= 2.1 =
*All new responsive layout and mostly re-writeen code

= 2.2 =
*Minor Bug Fix
*Default app id/secret added
