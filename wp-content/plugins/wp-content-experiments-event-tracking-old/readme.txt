=== WP Content Experiments & Event Tracking===
Contributors: WPSolutions HQ
Tags: google content experiments, A/B testing, split testing, google analytics, event tracking
Donate link: http://www.wpsolutions-hq.com/
Requires at least: 3.4.0
Tested up to: 3.4.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


This plugin enables you to easily add Google Content Experiments control code and/or event tracking into your WordPress pages and posts.

== Description ==

The WP Content Experiments & Event Tracking plugin gives you the ability to conduct Content Experiments on your WordPress site by providing an easy interface which you can use to paste the relevant google experiments control code into the header of the page/post of your choice.

Google Content Experiments replaces Google Website Optimizer as the tool which website owners can 
use for the split testing of their site's pages. 
Content Experiments is a tool which can found in your Google Analytics account from which you can do your split testing with.

This plugin also gives you the ability to perform event tracking on certain page elements such as buttons, links or other elements. 
The plugin will automatically add the event tracking code to particular elements on the wordpress post/page of your choice based on the configuration in the post/page editor window.

== Installation ==
pre-requisites:
a) You will need an active google analytics account. If you don't have one, you can create a new one here:
http://www.google.com/analytics/
b) You will need to have installed and configured the Google Analytics for WordPress plugin 
which can be found here: http://wordpress.org/extend/plugins/google-analytics-for-wordpress/


1. Upload the `wp-content-experiments` folder to the `/wp-content/plugins/` directory
2. Activate the WP Content Experiments plugin through the 'Plugins' menu in WordPress

== Usage ==
pre-requisites:
a) You will need an active google analytics account. If you don't have one, you can create a new one here:
http://www.google.com/analytics/

b) You will need to have installed and configured the Google Analytics for WordPress plugin 
which can be found here: http://wordpress.org/extend/plugins/google-analytics-for-wordpress/
(this will ensure that your Google Analytics tracking code will be inserted inside your site's <head> tags)

Adding Content Experiments code to a post or page
================================================
1) Using the WP editor open the page or post you wish to treat as the "Original" page for the content experiment you want to perform.
Please see the google help pages for how to setup/run experiments: 
https://support.google.com/analytics/bin/answer.py?hl=en&answer=1745216

2) Enable the checkbox in the "Content Experiments For WP" section to activate the feature

3) Paste the Google Content Experiments code into the text box.

IMPORTANT: You should only paste the content experiments code in the page which you set as the "Original" in the experiments setup of your google analytics account,
ie, do not paste the code in the "Variation" page(s).
You can check whether your code was added correctly within the page's <head></head> tags by viewing the source of the web page.

Adding google event tracking code to an element on a post or page
================================================================
NOTE: To perform event tracking you will need to set up a goal in your google analytics account.
Please see the google help pages:
http://support.google.com/analytics/bin/answer.py?hl=en&answer=1032415

1) Using the WP editor open the page or post you wish to perform event tracking on.

2) Enable the checkbox called "Enable Event Tracking for this page" in the "Event Tracking" section to activate the feature

3) Enter the values for the Category, Action and Label fields. (These values should have been set by you when you were configuring youyr goal in you
google analytics account)

4) Enter either a CSS ID name and/or CSS classname of the element you wish to track.

In order to obtain the CSS ID or class values of an element you can use firebug by right-clicking on the element and choosing "Inspect element with firebug".

Example 1:
Let's say I had a link on one of my wordpress pages which I wanted to track and the html for my link looks like the following:

<a id="my_link_id" href="http://www.yourdomain.com/somepage">click me</a>

I would enter "my_link_id" in the Element ID field in order perform event tracking on this link.

Example 2:
If I had a button which I wanted to track and the html for this button looks like the following:

<input class="coolbutton-submit" type="submit" value="Send">

In order to track this button, I would simply copy the class value "coolbutton-submit" and paste it into the "Element Classname" field.


Tip:
You can check whether your event tracking code was added correctly to the appropriate element by viewing it in firebug by rightclicking the element and selecting "Inspect Element with Firebugt" when using the Firefix browser.
(Alternatively if you are using Chrome right-click the element and select "Inspect element")

== Screenshots ==
Visit the plugin site at href="http://wpsolutions-hq.com/google-content-experiments-for-wordpress/ for screenshots and more info.

== Frequently Asked Questions ==

= Do I need a Google Analytics account in order to use Content Experiments? =
Yes. You will need to create an account by going here:
http://www.google.com/analytics/

= How do I setup a content experiment? =
Google has a wealth of information and help documentation about Content Experiments.
See the following to learn more:
http://support.google.com/analytics/bin/answer.py?hl=en&answer=1745147

Also go here for some setup information:
http://support.google.com/analytics/bin/answer.py?hl=en&answer=1745216


== Changelog ==
= 1.1 =

* oops...had to resubmit because my readme.txt file had mistake

= 1.0 =

* Initial release


== Upgrade Notice ==

= 1.0 =

* Initial release

For more information on the WP Content Experiments & Event Tracking and other plugins, visit the <a href="http://wpsolutions-hq.com/" target="_blank">WPSolutions-HQ Blog</a>.
Post any questions or feedback regarding this plugin at our website here: <a href="http://wpsolutions-hq.com/google-content-experiments-for-wordpress/" target="_blank">cf7-autoresponder-addon</a>.
