<?php
namespace mediaembedder\module\bambuser;
use \mediaembedder\core as me;

class core {

    static public function execute($match, $url) {
        $id = $match['bambuser_id'];
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
    
    static public function channel($match, $url) {
        $user = $match['bambuser'];
        $hash = me::hasher(__NAMESPACE__, $user, __FUNCTION__);
        $data = me::get_or_setup_data($hash);
        $meta = $data['meta'];
        $width = me::width();
        $height = me::height();
        $title = htmlspecialchars(me::title());
        ob_start();
        include me::template(__NAMESPACE__, __FUNCTION__);
        return ob_get_clean();
    }

}