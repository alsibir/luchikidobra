<?php
add_filter('the_content', 'add_buy_button');
function add_buy_button($content){

	global $post;

	$out = $content;

	$post_meta = get_post_meta(1, 'Цена' );

	$out = $out . 'Цена: ' . $post_meta[0] . ' руб <br>';
	$out = $out . '<a href="wp-content/plugins/toyoshop/buy.php?post_id=' . $post->ID . '" class="myButton">Купить</a>';

	return $out;
}
?>