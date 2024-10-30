<?php
namespace mediaembedder\module\scribd;
use \mediaembedder\core as me;

class core {
    static public function execute($match, $url) {
        $id = $match['scribd_id'];
        $name = $match['scribd_name'];
        $hash = me::hasher(__NAMESPACE__, "$id/$name");
        $data = me::get_or_setup_data($hash);
        $meta = $data['meta'];
        $width = me::width();
        $height = me::height();
        $title = htmlspecialchars(me::title());
        if(isset($data['scribd'])) {
            $doc_id = $data['scribd']['doc_id'];
            $access_key = $data['scribd']['access_key'];
        } else {
            $oembed = 'http://www.scribd.com/services/oembed?url='. urlencode($url) .'&format=json';
            $oembed = json_decode(@file_get_contents($oembed), true);
            $html = $oembed['html'];
            $doc_id = me::doms_get($html,
                    'object', 'id');
            $doc_id = substr($doc_id, 4);
            $flashvars = me::doms_get($html,
                    'param', 'name', 'FlashVars', 'value');
            $pattern = '#access_key=key-(?P<access_key>[a-zA-Z0-9]+)#i';
            preg_match($pattern, $flashvars, $matches);
            $access_key = $matches['access_key'];
            $data['scribd'] = array(
                'doc_id' => $doc_id,
                'access_key' => $access_key
            );
            me::setdata($hash, $data);
        }
        ob_start();
        include me::template(__NAMESPACE__);
        return ob_get_clean();
    }
}