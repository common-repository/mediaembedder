<?php
namespace mediaembedder\module\revision3;
use \mediaembedder\core as me;

class core {
    static public function execute($match, $url) {
        $group = $match['revision3_group'];
        $name = $match['revision3_name'];
        $hash = me::hasher(__NAMESPACE__, "$group/$name");
        $data = me::get_or_setup_data($hash);
        $meta = $data['meta'];
        $width = me::width();
        $height = me::height();
        $title = htmlspecialchars(me::title());
        if(isset($data['id'])) {
            $id = $data['id'];
        } else {
            $pattern = '#revision3.com/player-v(?P<id>\d+)#i';
            if(preg_match($pattern, $meta['og:video'], $matches)) {
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