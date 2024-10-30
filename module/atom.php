<?php
namespace mediaembedder\module\atom;
use \mediaembedder\core as me;

class core {

    static public function execute($match, $url) {
        $group = $match['atom_group'];
        $id = $match['atom_id'];
        $hash = me::hasher(__NAMESPACE__, "$group/$id");
        $data = me::get_or_setup_data($hash);
        $meta = $data['meta'];
        if ($meta['content_type'] == 'video') {
            if(isset($data['video_src'])) {
                $src = $data['video_src'];
            } else {
                $src = me::dom_get($url, 'link',
                        'rel', 'video_src', 'href');
                $data['video_src'] = $src;
                me::setdata($hash, $data);
            }
            $width = me::width();
            $height = me::height();
            $title = htmlspecialchars(me::title());
            ob_start();
            include me::template(__NAMESPACE__);
            return ob_get_clean();
        }
        return false;
    }

}