<?php
namespace mediaembedder\module\bliptv;
use \mediaembedder\core as me;

class core {

    static public function execute($match, $url) {
        $id = $match['bliptv_id'];
        $group = $match['bliptv_group'];
        $name = $match['bliptv_name'];
        $hash = me::hasher(__NAMESPACE__, "$group/$name/$id");
        $data = me::get_or_setup_data($hash);
        $meta = $data['meta'];
        $width = me::width();
        $height = me::height();
        $title = htmlspecialchars(me::title());
        if(isset($data['id'])) {
            $id = $data['id'];
        } else {
            if(preg_match('#blip.tv/play/(?P<id>[A-Za-z0-9]+)#i',
                    $meta['og:video'], $matches)) {
                $id = $matches['id'];
                $data['id'] = $matches['id'];
                me::setdata($hash, $data);
            }
        }
        ob_start();
        include me::template(__NAMESPACE__);
        return ob_get_clean();
    }

}