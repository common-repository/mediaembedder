<?php
namespace mediaembedder;
include "list.php";

class core {

    static private $meta;
    static private $url;
    static private $dom;
    static private $param;

    static public function ignite() {
        \add_action('init', array(__CLASS__, 'init'));
        \register_activation_hook(__FILE__, array(__CLASS__, 'activate'));
        \add_action('admin_menu', array(__CLASS__, 'admin_page'));
    }

    static public function init() {
        global $wpdb;
        \wp_embed_register_handler('mediaembedder', '#http(s?)://(.*)#i', array(__CLASS__, 'handler'));
        $sql = \file_get_contents(dirname(__FILE__) . '/sql/main.sql');
        $sql = \str_replace("__prefix__", $wpdb->base_prefix, $sql);
        $wpdb->query($sql);

        // Set up param
        self::$param = self::cleanParam();

        \wp_enqueue_script('jquery');

        $custom_path = WP_CONTENT_DIR . '/mediaembedder/template';
        if (!\file_exists($custom_path)) {
            \mkdir($custom_path, 0755, true);
        }
    }

    static public function getParam() {
        return self::$param;
    }

    static public function handler($matches, $attr, $url, $rawattr) {
        self::$meta = array();
        self::$url = $url;
        self::$dom = false;
        unset($matches);
        global $mediaembedderlist;
        foreach ($mediaembedderlist as $list) {
            $pattern = self::patternWrap($list['re']);
            if (preg_match($pattern, $url, $matches)) {
                if (file_exists(self::module($list['module']))) {
                    include_once self::module($list['module']);
                    $namespace = "\\mediaembedder\\module\\" . $list['module'] . "\\core";
                    if (\class_exists($namespace)) {
                        $method = 'execute';
                        if (isset($list['method'])) {
                            $method = $list['method'];
                        }
                        if (method_exists($namespace, $method)) {
                            $code = \call_user_func(
                                    array($namespace, $method), $matches, $url);
                            if (!$code) {
                                return false;
                            }
                            if (self::title() && self::title_enabled())
                                return self::title() . "\n" . $code;
                            else
                                return $code;
                        }
                    }
                }
            }
        }
        return false;
    }

    static private function patternWrap($pattern, $count = false) {
        return "#" . str_replace("#", "\#", $pattern) . "#i";
    }

    static public function module($module) {
        return dirname(__FILE__) . '/module/' . $module . '.php';
    }

    static public function template($namespace, $method = null) {
        $slashnumber = strrpos($namespace, '\\') + 1;
        $module = substr($namespace, $slashnumber);
        if ($method)
            $module .= '_' . $method;
        $custompath = WP_CONTENT_DIR . '/mediaembedder/template/' . $module . '.php';
        if (file_exists($custompath)) {
            return $custompath;
        } else {
            return \dirname(__FILE__) . '/template/' . $module . '.php';
        }
    }

    static public function width() {
        if (\is_numeric(\get_option('mediaembedder_width'))) {
            return (int) \get_option('mediaembedder_width');
        } else {
            return 560;
        }
    }

    static public function height() {
        if (\is_numeric(\get_option('mediaembedder_height'))) {
            return (int) \get_option('mediaembedder_height');
        } else {
            return 320;
        }
    }

    static public function title_enabled() {
        if (\get_option('mediaembedder_title_enabled') == '1') {
            return true;
        } else {
            return false;
        }
    }

    static public function title() {
        if (isset(self::$meta['og:title'])) {
            return self::$meta['og:title'];
        } elseif (isset(self::$meta['title'])) {
            return self::$meta['title'];
        } else {
            return false;
        }
    }

    static public function hasher($namespace, $data, $method = null) {
        $slashnumber = \strrpos($namespace, '\\') + 1;
        $module = 'me_' . \substr($namespace, $slashnumber);
        if ($method)
            $module .= '/' . $method;
        $data = $module . '/' . $data;
        return \hash('ripemd160', $data);
    }

    static public function get_or_setup_data($hash) {
        global $wpdb;
        $record = $wpdb->get_row(
                $wpdb->prepare(
                        "SELECT * FROM " . $wpdb->base_prefix . "mediaembedder_cache
                            WHERE hash=%s", array($hash)
                ), ARRAY_A
        );
        if ($record) {
            $data = \json_decode($record['data'], true);
        } else {
            self::$dom = new \DOMDocument();
            @self::$dom->loadHTMLfile(self::$url);
            $nodes = self::$dom->getElementsByTagName('meta');
            $meta = array();
            foreach ($nodes as $node) {
                if ($node->getAttribute('property') != "") {
                    $meta[strtolower($node->getAttribute('property'))] = $node->getAttribute('content');
                }
                if ($node->getAttribute('name') != "") {
                    $meta[strtolower($node->getAttribute('name'))] = $node->getAttribute('content');
                }
            }
            $data = array('meta' => $meta);
            $datajson = \json_encode($data);
            $wpdb->insert(
                    $wpdb->base_prefix . 'mediaembedder_cache', array(
                'hash' => $hash,
                'data' => $datajson
                    ), array(
                '%s',
                '%s'
                    )
            );
        }
        self::$meta = $data['meta'];
        return $data;
    }

    static public function setdata($hash, $data) {
        global $wpdb;
        $data = \json_encode($data);
        $wpdb->update(
                $wpdb->base_prefix . 'mediaembedder_cache', array(
            'data' => $data
                ), array(
            'hash' => $hash
                ), array(
            '%s',
                ), array(
            '%s',
                )
        );
    }

    static public function dom_get($url, $tag, $property_name, $property_value = false, $content_name = false) {
        if (self::$dom && self::$url == $url) {
            $dom = self::$dom;
        } else {
            $dom = new \DOMDocument();
            @$dom->loadHTMLfile($url);
        }
        $nodes = $dom->getElementsByTagName($tag);
        foreach ($nodes as $node) {
            if (!$property_value) {
                return $node->getAttribute($property_name);
            }
            if ($node->getAttribute($property_name) == $property_value) {
                return $node->getAttribute($content_name);
            }
        }
        return false;
    }

    static public function doms_get($string, $tag, $property_name, $property_value = false, $content_name = false) {
        $dom = new \DOMDocument();
        @$dom->loadHTML($string);
        $nodes = $dom->getElementsByTagName($tag);
        foreach ($nodes as $node) {
            if (!$property_value) {
                return $node->getAttribute($property_name);
            }
            if ($node->getAttribute($property_name) == $property_value) {
                return $node->getAttribute($content_name);
            }
        }
        return false;
    }

    static public function activate() {
        \add_option('mediaembedder_title_enabled', 0);
        \add_option('mediaembedder_width', 560);
        \add_option('mediaembedder_height', 320);
    }

    static public function admin_page() {
        \add_menu_page('MediaEmbedder', 'MediaEmbedder', 'manage_options', 'mediaembedder.php', array(__CLASS__, 'settings'));
        \add_submenu_page('mediaembedder.php', 'MediaEmbedder', 'MediaEmbedder', 'manage_options', 'mediaembedder.php', array(__CLASS__, 'settings'));
        \add_submenu_page('mediaembedder.php', 'Template Editor', 'Template Editor', 'manage_options', 'mediaembedder-template.php', array(__CLASS__, 'template_editor'));

        $settings = array(
            'mediaembedder_title_enabled',
            'mediaembedder_width',
            'mediaembedder_height'
        );
        foreach ($settings as $setting) {
            \register_setting('mediaembedder_settings', $setting);
        }
        unset($settings);
    }

    static public function settings() {
        $width = self::width();
        $height = self::height();
        $title_enabled = '';
        if (self::title_enabled()) {
            $title_enabled = 'checked';
        }
        include \dirname(__FILE__) . '/view/settings.php';
    }

    static public function template_editor() {
        include \dirname(__FILE__) . '/view/template-editor.php';
    }

    static private function cleanParam() {
        $param = \array_merge($_POST, $_GET);

        $param = \is_array($param) ?
                \array_map('stripslashes_deep', $param) :
                \stripslashes($param);

        return $param;
    }

}

core::ignite();

require_once 'api.php';