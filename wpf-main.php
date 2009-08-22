<?php
/*
	Plugin Name: Forum Server
	Plugin Author: Eric Hamby
	Plugin URI: http://vasthtml.com
	Author URI: http://erichamby.com
	Version: 1.2
*/

//$plugin_dir = basename(dirname(__FILE__)); 
//load_plugin_textdomain( 'vasthtml', ABSPATH.'wp-content/plugins/'. $plugin_dir.'/', $plugin_dir.'/' ); 
include_once("wpf.class.php");

// Short and sweet :)
$vasthtml = new vasthtml();

// Activating?
register_activation_hook(__FILE__ ,array(&$vasthtml,'wp_forum_install'));

add_action("the_content", array(&$vasthtml, "go"));
add_action('init', array(&$vasthtml,'set_cookie'));
add_filter("wp_title", array(&$vasthtml, "set_pagetitle"));
function latest_activity($num = 5){
	global $vasthtml;
	return $vasthtml->latest_activity($num);
}

?>