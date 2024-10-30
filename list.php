<?php

$mediaembedderlist = array(
    array(
        're' => '^http(s?)://([a-z]*).youtube.com/(watch|index)\?(.*)v=(?P<youtube_id>[a-zA-Z0-9-_]+)',
        'module' => 'youtube'
    ),
    array(
        're' => '^http(s?)://([a-z]*).youtube.com/v/(?P<youtube_id>[a-zA-Z0-9-_]+)',
        'module' => 'youtube'
    ),
    array(
        're' => '^http(s?)://youtu.be/(?P<youtube_id>[a-zA-Z0-9-_]+)',
        'module' => 'youtube'
    ),
    array(
        're' => '^http(s?)://([a-z]*).youtube.com/playlist?(.*)list=(?P<youtube_playlist_id>[a-zA-Z0-9-_]+)',
        'module' => 'youtube',
        'method' => 'playlist'
    ),
    array(
        're' => '^http(s?)://video.allthingsd.com/video/(.*)/(?P<allthingsdigital_id>[a-zA-Z0-9-_]+)(/?)',
        'module' => 'allthingsdigital'
    ),
    array(
        're' => '^http(s?)://allthingsd.com/video/\?video_id=(?P<allthingsdigital_id>[a-zA-Z0-9-_]+)(/?)',
        'module' => 'allthingsdigital'
    ),
    array(
        're' => '^http(s?)://(?:www\.)?aniboom.com/animation-video/(?P<aniboom_id>\d+)(/?)',
        'module' => 'aniboom'
    ),
    array(
        're' => '^http(s?)://www.atom.com/(?P<atom_group>[A-Za-z0-9-_]+)/(?P<atom_id>[A-Za-z0-9-_]+)(/?)',
        'module' => 'atom'
    ),
    array(
        're' => '^http(s?)://bambuser.com/v/(?P<bambuser_id>\d+)(/?)',
        'module' => 'bambuser'
    ),
    array(
        're' => '^http(s?)://bambuser.com/channel/(.*)/broadcast/(?P<bambuser_id>\d+)(/?)',
        'module' => 'bambuser'
    ),
    array(
        're' => '^http://(?:www\.)?barelydigital.com(.*)/episode/(?P<barelydigital_id>[A-Za-z0-9-_]+)/(?P<barelydigital_name>[A-Za-z0-9-_]+)',
        'module' => 'barelydigital'
    ),
    array(
        're' => '^http://(?:www\.)?barelypolitical.com(.*)/episode/(?P<barelypolitical_id>[A-Za-z0-9-_]+)/(?P<barelypolitical_name>[A-Za-z0-9-_]+)',
        'module' => 'barelypolitical'
    ),
    array(
        're' => '^http(s?)://bambuser.com/channel/(?P<bambuser>[A-Za-z0-9-_]+)(/?)',
        'module' => 'bambuser',
        'method' => 'channel'
    ),
    array(
        're' => '^http(s?)://(.*)blip.tv/(?P<bliptv_group>[a-zA-Z0-9-_]+)/(?P<bliptv_name>[a-zA-Z0-9-_]+)-(?P<bliptv_id>\d+)',
        'module' => 'bliptv'
    ),
    array(
        're' => '^http(s?)://(?:www\.)?collegehumor.com/video/(?P<collegehumor_id>\d+)/(?P<collegehumor_name>[a-zA-Z0-9-_]+)',
        'module' => 'collegehumor'
    ),
    array(
        're' => '^http(s?)://www.dailymotion.com/(.*)video/(?P<dailymotion_id>[^_]+)',
        'module' => 'dailymotion'
    ),
    array(
        're' => '^http(s?)://(?:www\.)?99dollarmusicvideos.com(.*)/episode/(?P<doller99_id>[A-Za-z0-9-_]+)/(?P<doller99_name>[A-Za-z0-9-_]+)',
        'module' => 'doller99'
    ),
    array(
        're' => '^http(s?)://www.flickr.com/photos/(?P<flickr_username>[a-zA-Z0-9-_@]+)/(?P<flickr_id>\d+)(/?)',
        'module' => 'flickr'
    ),
    array(
        're' => '^http(s?)://(?:www\.)?funnyordie.com/videos/(?P<funnyordie_id>[a-zA-Z0-9]+)/(?P<funnyordie_name>[a-zA-Z0-9-_]+)(/?)',
        'module' => 'funnyordie'
    ),
    array(
        're' => '^http(s?)://(?:www\.)?gametrailers.com/video/(?P<gametrailers_name>[a-zA-Z0-9-]+)/(?P<gametrailers_id>\d+)(/?)',
        'module' => 'gametrailers'
    ),
    array(
        're' => '^http(s?)://(?:www\.)?hulu.com/watch/(?P<hulu_id>\d+)/(?P<hulu_name>[a-zA-Z0-9-_]+)(/?)',
        'module' => 'hulu'
    ),
    array(
        're' => '^http(s?)://www.metacafe.com/watch/(?P<metacafe_id>\d+)/(?P<metacafe_name>[a-zA-Z0-9_-]+)(/?)',
        'module' => 'metacafe'
    ),
    array(
        're' => '^http(s?)://(?P<photobucket_hash_1>.*)photobucket.com/(?P<photobucket_hash_2>.+)(/?)',
        'module' => 'photobucket'
    ),
    array(
        're' => '^http(s?)://(.*)revision3.com/(?P<revision3_group>[a-zA-Z0-9-_]+)/(?P<revision3_name>[a-zA-Z0-9-_]+)(/?)',
        'module' => 'revision3'
    ),
    array(
        're' => '^http(s?)://(?:www\.)?screenr.com/(?P<screenr_id>[a-zA-Z0-9-_]+)(/?)',
        'module' => 'screenr'
    ),
    array(
        're' => '^http(s?)://(?:www\.)?scribd.com/doc/(?P<scribd_id>\d+)/(?P<scribd_name>[a-zA-Z0-9-_]+)(/?)',
        'module' => 'scribd'
    ),
    array(
        're' => '^http(s?)://(.*).smugmug.com/(?P<smugmug_hash_1>.+)',
        'module' => 'smugmug'
    ),
    array(
        're' => '^http(s?)://(.*)viddler.com/explore/(?P<viddler_group>[a-zA-Z0-9-_]+)/videos/(?P<viddler_id>\d+)(/?)',
        'module' => 'viddler'
    ),
    array(
        're' => '^http(s?)://(?:www\.)?vimeo.com/(?P<vimeo_id>\d+)',
        'module' => 'vimeo'
    ),
);