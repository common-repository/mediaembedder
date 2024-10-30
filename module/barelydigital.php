<?php
namespace mediaembedder\module\barelydigital;
use \mediaembedder\core as me;

class core {

    static public function execute($match, $url) {
        $id = $match['barelydigital_id'];
        $name = $match['barelydigital_name'];
        $hash = me::hasher(__NAMESPACE__, "$id/$name");
        $data = me::get_or_setup_data($hash);
        $meta = $data['meta'];
        $width = me::width();
        $height = me::height();
        $title = htmlspecialchars(me::title());
        ob_start();
        include me::template(__NAMESPACE__);
        return ob_get_clean();
    }

}