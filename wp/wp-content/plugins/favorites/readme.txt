=== Favorites ===
Contributors: shut
Donate link: http://shino.vn/
Tags: favorites, like, bookmark, favorite, likes, bookmarks, favourite, favourites, multisite, wishlist, wish list
Requires at least: 3.8
Requires PHP: 5.6
Tested up to: 5.6
Stable tag: 2.3.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Favorites for any post type. Easily add favoriting/liking, wishlists, or any other similar functionality using the developer-friendly API.
 

== Installation ==

1. Upload the favorites plugin directory to the wp-content/plugins/ directory
2. Activate the plugin through the Plugins menu in WordPress
3. Visit the plugin settings to configure display options
4. Use the template functions, display settings, or shortcodes to display the favorite button, favorite counts, and/or user favorites.

== Frequently Asked Questions ==

= Does this worked on cached pages? =
Yes, although the buttons may display the incorrect state momentarily. Button states are updated via an AJAX call after page load in order to accommodate cached pages. This may be noticeable on slower servers.

= Is this plugin compatible with Multisite? =
As of version 1.1.0, Favorites is compatible with multisite installations. By default, all shortcodes and template functions will pull data from the site being viewed. Specific site IDs may be passed as parameters for more control. See the documentation for more information.


== Screenshots ==

1. Developer-friendly – easily unenqueue styles if you are combining and minifying your own. 

2. Enable for anonymous users and save in the session or a browser cookie. Logged-in users' favorites are saved in a custom user meta field.

3. Optionally add a modal authentication gate for unauthenticated users

4. Enable and display per post type, or use the functions/shortcodes to manually add to templates.

5. Customize the button markup to fit your theme

6. Or use a predefined button type and customize colors to fit your site's style.

7. Every option is customizable, including the loading state for favorite buttons.

8. Customize favorite lists
 

== Usage ==

**Favorite Button**

The favorite button can be added automatically to the content by enabling specific post types in the plugin settings. It may also be added to template files or through the content editor using the included functions or shortcodes. The post id may be left blank in all cases if inside the loop. The site id parameter is optional, for use in multisite installations (defaults to current site).

* **Get function:** `get_favorites_button($post_id, $site_id)`
* **Print function:** `the_favorites_button($post_id, $site_id)`
* **Shortcode:** `[favorite_button post_id="" site_id=""]`

**Favorite Count (by Post)**

Total favorites for each post are saved as a simple integer. If a user unfavorites a post, this count is updated. Anonymous users' favorites count towards the total by default, but may be disabled via the plugin settings. The post id may be left blank in all cases if inside the loop.

* **Get function:** `get_favorites_count($post_id)`
* **Print function:** `the_favorites_count($post_id)`
* **Shortcode:** `[favorite_count post_id=""]`

**Favorite Count (by User)**
Displays the total number of favorites a user has favorited. Template functions accept the same filters parameter as the user favorites functions.

* **Get function:** `get_user_favorites_count($user_id, $site_id, $filters)`
* **Print function:** `the_user_favorites_count($user_id, $site_id, $filters)`
* **Shortcode:** `[user_favorites user_id="" site_id="" post_types=""]`

**User Favorites**

User favorites are stored as an array of post ids. Logged-in users' favorites are stored as a custom user meta field, while anonymous users' favorites are stored in either the session or browser cookie (configurable in the plugin settings). If the user id parameter is omitted, the favorites default to the current user. The site id parameter is optional, for use in multisite installations (defaults to current site).

* **Get function (returns array of IDs):** `get_user_favorites($user_id, $site_id)`
* **Get function (returns html list):** `get_user_favorites_list($user_id, $site_id, $include_links, $filters, $include_button, $include_thumbnails = false, $thumbnail_size = 'thumbnail', $include_excerpt = false)`
* **Print function (prints an html list):** `the_user_favorites_list($user_id, $site_id, $include_links, $filters, $include_button, $include_thumbnails = false, $thumbnail_size = 'thumbnail', $include_excerpt = false)`
* **Shortcode (prints an html list, with the option of omitting links):** `[user_favorites user_id="" include_links="true" site_id="" include_buttons="false" post_types="post" include_thumbnails="false" thumbnail_size="thumbnail" include_excerpt="false"]

**List Users Who Have Favorited a Post**

Display a list of users who have favorited a specific post. If the user id parameter is omitted, the favorites default to the current user. The site id parameter is optional, for use in multisite installations (defaults to current site). The get function returns an array of user objects.

* **Get function (returns array of User Objects):** `get_users_who_favorited_post($post_id, $site_id)`
* **Print function (prints an html list):** `the_users_who_favorited_post($post_id = null, $site_id = null, $separator = 'list', $include_anonymous = true, $anonymous_label = 'Anonymous Users', $anonymous_label_single = 'Anonymous User')`
* **Shortcode (prints an html list):** `[post_favorites post_id="" site_id="" separator="list" include_anonymous="true" anonymous_label="Anonymous Users" anonymous_label_single="Anonymous User"]


**Clear Favorites Button**

Displays a button that allows users to clear all of their favorites.

* **Get function:** `get_clear_favorites_button($site_id, $text)`
* **Print function:** `the_clear_favorites_button($site_id, $text)`
* **Shortcode:** `[clear_favorites_button site_id="" text="Clear Favorites"]

**Favorite Count (Across all Posts)**
Displays the total number of favorites for a given site.

* **Get function:** `get_total_favorites_count($site_id)`
* **Print function:** `the_total_favorites_count($site_id)`
