<?php
/*
Plugin Name: Dropbox videoer
Plugin URI:
Description: Benytt shortcode for å innebygge dropbox videoer
Author: Mats Berntsen
Author URI:
Version: 0.1

*/

//require_once (plugin_dir_path(_FILE_) . 'dropbox-vid-shortcode.php');

add_action("admin_menu", "addMenu");
function addMenu(){
  add_menu_page("Dropbox videoer","Dropbox videoer", 4,"dropbox-video", "menu");
}

function menu(){
  echo <<<'EOD'
<h1>Innebygging av DropBox-videoer og podcaster</h1>
<br/>
<h3>Benytt koden: [dropbox_video URL=""] for å bygge in video eller podcast fra DropBox</h3>
<h4>Linken til videoen legges i klammene etter URL</h4>
<h4>Det er ikke lenger nødvendig å endre på linken</h4>
EOD;

}


function dropbox_shortcode($atts, $content = null){
  $atts = shortcode_atts(
  		array(
  			'url' => '',
  		), $atts, 'url' );
  $url = $atts[url];
  $prefix = "www";
  $newprefix ="dl";
  $newurl = str_replace($prefix, $newprefix, $url);
  if (strpos($newurl,"mp3") !== false) {
    $height = "6em";
  }else {
    $height="auto";
  }
return '
<div style="width: inherit;">

<video style="width: 100%; height: ' . $height . ';" controls="controls">
  <source src="'
. $newurl .' " /></video></div>';

}

add_shortcode('dropbox_video','dropbox_shortcode');
