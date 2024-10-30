=== MediaEmbedder ===
Contributors: CJ_Jackson
Donate link: http://cj-jackson.com/donate/
Tags: media, embed, video, photo, image, audio
Requires at least: 3.2.0
Tested up to: 3.3
Stable tag: 2012.02.12

Multimedia Embedder that relies on template, unlike oEmbed, therefore allowing
users full control over html code.

== Description ==

Multimedia Embedder is plugin that allows user to embed multimedia just like
oEmbed, but with the added convenient of an HTML template system, each site has
at least one template each for example Flickr will have two templates (photo
and video).  The users will get full control of the HTML template, for example
the YouTube template can be modified to embed YouTube into JW Player rather than
using YouTube default player.

This plugin also utilise HTML DOM to fetch Meta tag and other vital data about
the media in question, if there is not enough data it will use the data from
oEmbed as the last resort, all the collected data will get stored to the
database for maximum speed and efficiency.

This plugin extends on Wordpress Embed, so therefore it embedded the same way as
oEmbed and requires PHP 5.3 and above.

Current supported sites are:

* [$99 Music Videos](http://www.99dollarmusicvideos.com/)
* [All Things Digital](http://allthingsd.com/)
* [Aniboom](http://www.aniboom.com/)
* [Atom.com](http://www.atom.com/)
* [Bambuser](http://bambuser.com/)
* [Barely Digital](http://barelydigital.com/)
* [Barely Political](http://barelypolitical.com/)
* [Blip.tv](http://blip.tv/)
* [CollegeHumor](http://www.collegehumor.com/)
* [DailyMotion](http://www.dailymotion.com/)
* [Flickr](http://www.flickr.com/) (Photo and Video)
* [FunnyOrDie](http://www.funnyordie.com/)
* [GameTrailers](http://www.gametrailers.com/)
* [Hulu](http://www.hulu.com/)
* [MetaCafe](http://www.metacafe.com/)
* [PhotoBucket](http://photobucket.com/)
* [Revision3](http://revision3.com/)
* [Screenr](http://www.screenr.com/)
* [Scribd](http://www.scribd.com/)
* [SmugMug](http://www.smugmug.com/)
* [Viddler](http://viddler.com/)
* [YouTube](http://www.youtube.com/) (including Playlists)
* And more coming soon...

Further Instructions are in the admin panel.

== Installation ==

1. Upload folder `mediaembedder` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Check Settings in admin panel.

== Changelog ==

= 2012.02.12 =
* Now uses namespace.
* Now requires PHP 5.3 and above.

= 2011.12.29 =
* Major Fixes.

= 2011.12.28 =
* Added Template Editor into Admin-CP.

= 2011.12.01 =
* Fixed Screenr regular expression.

= 2011.11.28 =
* Improved some of the regular expression.
* Added Barely Digital
* Added Barely Political
* Now versioned by date, it's more practical.

= 0.0.4 =
* Added Screenr

= 0.0.3 =
* Added $99 Music Videos
* Added All Things Digital
* Added Aniboom
* Added Atom.com
* Added Bambuser

= 0.0.2 =
* Added CollegeHumor.
* Have YouTube on top of list, then the rest in alphabetical order.

= 0.0.1 =
* First Release.