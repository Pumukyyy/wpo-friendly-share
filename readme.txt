=== WPO friendly Share ===
Contributors: pumukyyy
TTags: translation ready, botones para compartir, share, follow, share button, follow button, social buttons, Share on Facebook, Share on Linkedin, Share on Instagram, Share on Google My Business, Share on Twitter, Share on Pinterest, Share on Youtube, Share on Telegram, Share on Whatsapp, Share on Buffer
Requires at least: 4.0
Tested up to: 5.3
Stable tag: 1.1.0
Requires PHP: 5.2.4 or later
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple buttons to share or be followed on social networks, lightweight and friendly for WPO and SEO

== Description ==
# WPO Friendly Share 

- The simplest and lightest option of having beautiful buttons from the main social networks to share content from your website or to direct your readers to the profiles or pages of your social networks.
  
- The following social networks are currently available: Facebook, Linkedin, Instagram, Google My Business, Twitter, Pinterest, YouTube, Telegram, Whatsapp and Buffer but we are still working to incorporate our networks, if you have any suggestion write us in the support forum.

- Buttons that generate the link to share or be followed in the main social networks without using very light and really fast javascript

- Without complications, you do not need just configuration, to show follow buttons just select which social networks to share and go!

- SEO friendly, use Schema.org structured data marking to put Google, Bing, etc. into context ...

- If you whant it links to your social networks you have to put the url of your profiles in the configuration of the complement

- Translation ready, fully translatable to your preferred language, feel free to translate this plugin into your language at https://translate.wordpress.org/projects/wp-plugins/wpo-friendly-share

## - If you like the plugin leave us a review to help us keep growing


== Installation ==

**1** Upload the add-in files to the '/ wp-content / plugins / wpo-friendly-share /' directory, or install the add-in via the WordPress add-ons screen directly.

**2** Activate the plugin through the \ 'Add-ons \' screen in WordPress

**3** Use the Settings screen -> Settings -> WPO friendly share to configure the plug-in

== Frequently Asked Questions ==

= - How do I add the buttons to share on social networks in the theme template? =
Add this code in the place of the template that you want the buttons to appear `<? Php if (function_exists ('wfs_share')) {echo do_shortcode ('[wfs_share]') ; ?> `

= - How can I add the buttons to share on social networks with a short code? =
Add this short code `[wfs_share]` wherever you want it to appear

= - How do I add the buttons to follow me on social media in the theme template? =
Add this code in the place of the template that you want the buttons <<? Php if (function_exists ('wfs_follow')) {echo do_shortcode ('[wfs_follow]'); ?> `

= - How can I add the buttons to follow me on the networks with a short code? =
Add this short code `[wfs_follow]` wherever you want it to appear

= - Why does nothing appear if I already added it with short code or in the template? =
First there must be some button selected to appear


== Screenshots ==
1. Ajustes share
2. Ajustes follow
3. Ajustes avanzados
4. Ajustes de desactivacion

== Changelog ==
1.0.5

- Updated translations

1.0.4

- Added telegram to the share list

- Added telegram to the list to follow

- Added link to plugin settings

- Coding improvements

- Added a filter for the social network array follow with the url and select 'wsf_array_share_filter'

- Added a filter with the container and social media content share 'wfs_content_share_filter'

- Added default text option to share on telegram by loading one by default if none is defined

- Added a filter for the social media array follow with the url and select 'wsf_array_follow_filter'

- Added a filter with the container and social media content follow 'wfs_content_follow_filter'

- Fixed a bug showing the title with nothing marked when added by function

1.0.3

- Added option to add predefined text in bold when speaking on whatsapp

- Added new translations to English es_US and Spanish es_ES

- Check if it is mobile or web for whatsapp

- Added wfs_share_end_filter filter for share buttons

- I correct css for mobile in the administrator

- Added columns with explanation in each section of the plugin configuration

1.0.2

- Fixed a bug where the follow buttons were never shown in the public-render.php template

1.0.1

- Added function to eliminate the options created when deactivating the pluguin

1.0.0

- First version

== Upgrade Notice ==
= 1.1.0=

- Fixed bug when getting url from page to share

- Improvements for translations