<?php
namespace mediaembedder\module\doller99;
use \mediaembedder\core as me;

class core {

    static public function execute($match, $url) {
        $name = $match['doller99_name'];
        $id = $match['doller99_id'];
        $hash = me::hasher(__NAMESPACE__, "$name/$id");
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