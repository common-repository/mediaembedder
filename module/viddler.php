<?php
namespace mediaembedder\module\viddler;
use \mediaembedder\core as me;

class core {
    static public function execute($match, $url) {
        $id = $match['viddler_id'];
        $group = $match['viddler_group'];
        $hash = me::hasher(__NAMESPACE__, "$id/$group");
        $data = me::get_or_setup_data($hash);
        $meta = $data['meta'];
        $width = me::width();
        $height = me::height();
        if(isset($data['id'])) {
            $id = $data['id'];
        } else {
            $video = me::dom_get($url,
                    'link', 'rel', 'video_src', 'href');
            if(preg_match('#www.viddler.com/player/(?P<id>[a-zA-Z0-9]+)(/?)#i', $video, $matches)) {
                $id = $matches['id'];
                $data['id'] = $id;
                me::setdata($hash, $data);
            }
        }
        ob_start();
        include me::template(__NAMESPACE__);
        return ob_get_clean();
    }
}