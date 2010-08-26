<?php
/*
 * This file contains code specific for PRO version of the plugin.
 * If the file is empty, you are using a free version.
 *
 */
class vasthtml_pro {

	// Remember to flush_rules() when adding rules
	function do_flush_rules() {
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}

	// Adding a new rule
	function set_rewrite_rules($rules) {
		$newrules = array();
		$forum_path = trim(str_replace(get_bloginfo('siteurl'), "", get_permalink($this->page_id)), "/");
		$newrules["(".$forum_path.")(/[-/0-9a-zA-Z]+)?/(.*)$"] = 'index.php?pagename=$matches[1]&page=$matches[2]';

		return $newrules + $rules;
	}

	// Adding the id var so that WP recognizes it
	function set_rewrite_qvars($vars) {
		array_push($vars, 'id');
		return $vars;
	}

	function get_seo_query(){
		$forum = str_replace(get_bloginfo('siteurl'), "", get_permalink($this->page_id));
		$full_uri = $_SERVER['REQUEST_URI'];
		$uri = trim(str_replace($forum, "", $full_uri), "/");
		$uri = explode("/", $uri);
		if (array_count_values($uri)) {
			$puri = end($uri);
			preg_match("/.*-(g|f|t)(\d*(\.?\d+)?)$/", $puri, $matches);
		}
		if (!empty($matches)) {
			$result = array(
				'action' => $matches[1],
				'id' => $matches[2],
			);
		}
		return $result;
	}
	
	
	
}

?>