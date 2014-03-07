<?php
/*
Plugin Name: Customized Blockquotes
Plugin URI: www.beyond-paper.com
Description: Replaces a shortcode with a formatted blockquote.  Use the following format: [quote image="theimage.jpg" title="the title" source="the_source.html" author="The Author"]The Quotation Body[/quote]  Original CSS by CoDrops (http://tympanus.net/codrops/2012/07/25/modern-block-quote-styles/)
Version: 1.0
Author: Diane Ensey
Author URI: www.beyond-paper.com
Copyright 2014  Diane Ensey  (email : diane@beyond-paper.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * 1. WP path definitions ----------------------------------------------------------------->
**/

if(!defined('WP_CONTENT_URL'))
	define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
if(!defined('WP_CONTENT_DIR'))
	define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
if(!defined('WP_PLUGIN_URL'))
	define('WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins');
if(!defined('WP_PLUGIN_DIR'))
	define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');


/**
 * 2. CSS and JS definitions ----------------------------------------------------------------->
**/
class BPcb {
    function bpIncludes() {
      $cssPath = WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)).'/styles/'.'/';
	  //$jsPath = WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)).'/js/'.'/';

      echo '<link rel="stylesheet" type="text/css" media="screen" href="' . $cssPath . 'bp_style.css" />'."\n";
	
    }
}


/**
 * 3. Functions ----------------------------------------------------------------->
**/

/** ---------- Custom functions START ---------- **/


/*Add the Shortcode 
** Format is 
** [quote style = 'leather' image="theimage.jpg" title="the title" source="the_source.html" author="The Author"]The Quotation Body[/quote]
** styles:
** 		leather ( CSS credit to CoDrops: http://tympanus.net/codrops/2012/07/25/modern-block-quote-styles/)
**      swoosh ( CSS credit to CoDrops: http://tympanus.net/codrops/2012/07/25/modern-block-quote-styles/)
**      balloon ( CSS credit to CoDrops: http://tympanus.net/codrops/2012/07/25/modern-block-quote-styles/)
**      vinyl ( CSS credit to CoDrops: http://tympanus.net/codrops/2012/07/25/modern-block-quote-styles/)
**      polaroid ( CSS credit to CoDrops: http://tympanus.net/codrops/2012/07/25/modern-block-quote-styles/)
**      playbill ( CSS credit to CoDrops: http://tympanus.net/codrops/2012/07/25/modern-block-quote-styles/) 
*/
function bp_custom_block_quote($atts, $content = null) {
   extract(shortcode_atts(array(
   	  "style"  => 'leather',
      "image"  => ' ',
      "title"  => 'no title provided',
      "source" => ' ',
      "author" => 'Unknown'
   ), $atts));
   return '<div class="'.$style.' bp-wrap">
		<div class="bp-thumb" data-image="'.$image.'" style="background:url('.$image.') no-repeat center center"></div>
		<div class="blockquote" cite="'.$source.'"><p>'.$content.'</p></div>
		<div class="bp-attribution">
		<p class="bp-author">'.$author.'</p>
		<p><cite><a href="'.$source.'">'.$title.'</a></cite></p>
		</div>
		</div>';
}

/** ---------- Custom functions END ---------- **/

/**
 * 4. Actions ----------------------------------------------------------------->
**/

if (class_exists("BPcb")) {
	$dl_plugin = new BPcb();
}
//Actions
if (isset($dl_plugin)) {
	//Add Action To Footer
	add_action('wp_footer', array(&$dl_plugin, 'bpIncludes')); //Add the CSS and JS definitions to the footer section
}

/**
 * 5. Shortcodes ----------------------------------------------------------------->
**/

add_shortcode("quote", "bp_custom_block_quote");
?>