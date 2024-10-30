<?php
namespace mediaembedder\module\photobucket;
use \mediaembedder\core as me;

class core {
    static public function execute($match, $url) {
        $hash_1 = $match['photobucket_hash_1'];
        $hash_2 = $match['photobucket_hash_2'];
        $hash = me::hasher(__NAMESPACE__, "$hash_1/$hash_2");
        $data = me::get_or_setup_data($hash);
        $meta = $data['meta'];
        $title = htmlspecialchars(me::title());
        if(isset($meta['og:image'])) {
            $img = $meta['og:image'];
            $img_url = $meta['og:url'];
        } else {
            return false;
        }
        ob_start();
        include me::template(__NAMESPACE__);
        return ob_get_clean();
    }
}