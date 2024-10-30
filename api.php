<?php
namespace mediaembedder\api;
use \mediaembedder\core as me;

class core {

    private static $param;

    static public function ignite() {
        \add_action('wp_ajax_mediaembedder', array(__CLASS__, 'init'));
        \add_action('wp_ajax_nopriv_mediaembedder', array(__CLASS__, 'init'));
    }

    static public function init() {
        self::$param = me::getParam();
        if (!isset(self::$param['node'])) {
            exit();
        }
        if (method_exists(__CLASS__, 'cmd_' . self::$param['node'])) {
            call_user_func(array(__CLASS__, 'cmd_' . self::$param['node']));
        } else {
            echo 'Error command does not exist';
        }

        die();
    }

    static public function checkPermission($capability) {
        if (!current_user_can($capability)) {
            exit();
        }
    }

    static public function cmd_get_editor_file_content() {
        self::checkPermission('edit_posts');
        $file = WP_CONTENT_DIR . '/mediaembedder/template/'
                . self::$param['current_file'];
        if (!file_exists($file)) {
            $file = \dirname(__FILE__) . '/template/'
                    . self::$param['current_file'];
        }
        $data = @\file_get_contents($file);
        $filename = self::$param['current_file'];
        $json = array(
            'data' => $data,
            'filename' => $filename
        );
        echo json_encode($json);
    }

    static public function cmd_get_editor_filelist() {
        self::checkPermission('edit_posts');
        $current_file = self::$param['current_file'];
        $filelist = array();

        $templatesLoc = \dirname(__FILE__) . '/template/';

        $templates = \glob($templatesLoc . "*.php");

        foreach ($templates as $template) {
            $template = basename($template);
            $filelist[] = $template;
        }

        include 'view/template-editor-filelist.php';
    }

    static public function cmd_template_file_submit() {
        self::checkPermission('edit_posts');
        $current_file = WP_CONTENT_DIR . '/mediaembedder/template/' .
                self::$param['current_file'];
        $data = self::$param['data'];
        \file_put_contents($current_file, $data);
        echo 'Success!';
    }

}

core::ignite();