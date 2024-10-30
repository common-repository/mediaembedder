<?php
namespace mediaembedder\module\flickr;
use \mediaembedder\core as me;

class core {

    static public function execute($match, $url) {
        $id = $match['flickr_id'];
        $username = $match['flickr_username'];
        $hash = me::hasher(__NAMESPACE__, "$id/$username");
        $data = me::get_or_setup_data($hash);
        $meta = $data['meta'];
        $width = me::width();
        $height = me::height();
        $title = htmlspecialchars(me::title());
        if (isset($data['video'])) {
            $id = $data['video']['id'];
            $photo_secret = $data['video']['photo_secret'];
            $photo_id = $data['video']['photo_id'];
            $video_mode = true;
        } elseif (isset($data['img'])) {
            $img = $data['img'];
            $video_mode = false;
        } else {
            if ($meta['medium'] == 'video') {
                $video_src = me::dom_get($url, 'link', 'rel', 'video_src', 'href');
                if(preg_match("#v=(?P<id>\d+)(.*)photo_secret=(?P<photo_secret>[a-zA-Z0-9]+)(.*)photo_id=(?P<photo_id>\d+)(.*)#i", $video_src, $matches)) {
                    $id = $matches['id'];
                    $photo_secret = $matches['photo_secret'];
                    $photo_id = $matches['photo_id'];
                    $data['video'] = array(
                        'id' => $id,
                        'photo_secret' => $photo_secret,
                        'photo_id' => $photo_id
                    );
                }
                $video_mode = true;
            } else {
                $img = me::dom_get($url, 'link', 'rel', 'image_src', 'href');
                $data['img'] = $img;
                $video_mode = false;
            }
            me::setdata($hash, $data);
        }
        ob_start();
        if($video_mode) {
            include me::template(__NAMESPACE__ . '_video');
        } else {
            include me::template(__NAMESPACE__);
        }
        return ob_get_clean();
    }

}
