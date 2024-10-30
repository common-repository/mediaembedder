<?php
namespace mediaembedder\module\hulu;
use \mediaembedder\core as me;

class core {

    static public function execute($match, $url) {
        $id = $match['hulu_id'];
        $name = $match['hulu_name'];
        $hash = me::hasher(__NAMESPACE__, "$name/$id");
        $data = me::get_or_setup_data($hash);
        $meta = $data['meta'];
        $width = me::width();
        $height = me::height();
        $title = htmlspecialchars(me::title());
        if(isset($data['id'])) {
            $id = $data['id'];
        } else {
            $video = me::dom_get($url,
                    'link', 'rel', 'media:video', 'href');
            if(preg_match("#hulu.com/embed/(?P<id>[a-zA-Z0-9-_]+)#i", $video, $matches)) {
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
