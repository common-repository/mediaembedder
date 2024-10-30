<?php
namespace mediaembedder\module\screenr;
use \mediaembedder\core as me;

class core {

    static public function execute($match, $url) {
        $id = $match['screenr_id'];
        if(preg_match('#^(stream|record|user|privacy|help|terms|account)$#i', $id)) {
            return false;
        }
        $hash = me::hasher(__NAMESPACE__, "$id");
        $data = me::get_or_setup_data($hash);
        $meta = $data['meta'];
        $width = me::width();
        $height = me::height();
        ob_start();
        include me::template(__NAMESPACE__);
        return ob_get_clean();
    }

}