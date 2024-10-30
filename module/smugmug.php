<?php
namespace mediaembedder\module\smugmug;
use \mediaembedder\core as me;

class core {
    static public function execute($match, $url) {
        $hash_1 = $match['smugmug_hash_1'];
        $hash = me::hasher(__NAMESPACE__, "$hash_1");
        $data = me::get_or_setup_data($hash);
        $meta = $data['meta'];
        $width = me::width();
        if(!isset($data['oembed'])) {
            $oembed = 'http://api.smugmug.com/services/oembed/?url='.urlencode($url).'&format=json';
            $oembed = json_decode(@file_get_contents($oembed), true);
            $data['oembed'] = $oembed;
            me::setdata($hash, $data);
        }
        if($data['oembed']['type'] != 'photo') {
            return false;
        }
        $title = htmlspecialchars($data['oembed']['title']);
        $img = $data['oembed']['url'];
        ob_start();
        include me::template(__NAMESPACE__);
        return ob_get_clean();
    }
}