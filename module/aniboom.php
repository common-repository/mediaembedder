<?php
namespace mediaembedder\module\aniboom;
use \mediaembedder\core as me;

class core {

    static public function execute($match, $url) {
        $id = $match['aniboom_id'];
        $hash = me::hasher(__NAMESPACE__, $id);
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