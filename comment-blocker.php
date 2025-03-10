<?php
/*
Plugin Name: Comment Blocker before to save database
Description: Contact skwebguru@gmail.com 
Version: 0.0.1
Author: Saurabh Khanna
*/


/* Runs when plugin is activated */
register_activation_hook(__FILE__,'comment_blocker_install'); 

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'comment_blocker_remove' );

function comment_blocker_install() {
/* Creates new database field */
add_option("comment_blocker_data", 'Default', '', 'yes');
add_option("comment_blocker_message", 'Default', '', 'yes');
}

function comment_blocker_remove() {
/* Deletes the database field */
delete_option('comment_blocker_data');
delete_option('comment_blocker_message');
}

if ( is_admin() ){

/* Call the html code */
add_action('admin_menu', 'comment_blocker_admin_menu');

function comment_blocker_admin_menu() {
add_options_page('Comment Blocker', 'Comment Blocker', 'administrator',
'comment_blocker', 'comment_blocker_html_page');
}
}

function comment_blocker_html_page() {
?>
<div>
<h2>Comment Blocker</h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

<table width="680">
<tr valign="top">
<th width="192" scope="row">Enter Block Words</th>
<td width="556">
<textarea name="comment_blocker_data" rows="10" cols="40"><?php echo get_option('comment_blocker_data'); ?></textarea>&nbsp;(ex: Enter your word one per line)
</td>
</tr>
<tr valign="top">
<th width="192" scope="row">Enter Block Message</th>
<td width="406">
<input type="text" name="comment_blocker_message" value="<?php echo get_option('comment_blocker_message'); ?>" class="regular-text" />
</td>
</tr>
</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="comment_blocker_data,comment_blocker_message" />

<p>
<input type="submit" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
<?php
}

add_action('init', 'comment_blocker_checker');

function comment_blocker_checker() {
	
	if(isset($_POST['comment'])) {
		$word = get_option('comment_blocker_data');
		$words = explode("\n",$word);
		$preg = '(sex)';
		foreach($words as $val) {
			$preg.= '|('.trim($val).')';
		}
		
		
		
		if(preg_match('/'.$preg.'/',$_POST['comment'])) {
			?>
            <!DOCTYPE html>
<!-- Ticket #11289, IE bug fix: always pad the error page with enough characters such that it is greater than 512 bytes, even after gzip compression abcdefghijklmnopqrstuvwxyz1234567890aabbccddeeffgghhiijjkkllmmnnooppqqrrssttuuvvwwxxyyzz11223344556677889900abacbcbdcdcededfefegfgfhghgihihjijikjkjlklkmlmlnmnmononpopoqpqprqrqsrsrtstsubcbcdcdedefefgfabcadefbghicjkldmnoepqrfstugvwxhyz1i234j567k890laabmbccnddeoeffpgghqhiirjjksklltmmnunoovppqwqrrxsstytuuzvvw0wxx1yyz2z113223434455666777889890091abc2def3ghi4jkl5mno6pqr7stu8vwx9yz11aab2bcc3dd4ee5ff6gg7hh8ii9j0jk1kl2lmm3nnoo4p5pq6qrr7ss8tt9uuvv0wwx1x2yyzz13aba4cbcb5dcdc6dedfef8egf9gfh0ghg1ihi2hji3jik4jkj5lkl6kml7mln8mnm9ono
-->
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WordPress &rsaquo; Error</title>
	<style type="text/css">
		html {
			background: #f9f9f9;
		}
		body {
			background: #fff;
			color: #333;
			font-family: sans-serif;
			margin: 2em auto;
			padding: 1em 2em;
			-webkit-border-radius: 3px;
			border-radius: 3px;
			border: 1px solid #dfdfdf;
			max-width: 700px;
		}
		h1 {
			border-bottom: 1px solid #dadada;
			clear: both;
			color: #666;
			font: 24px Georgia, "Times New Roman", Times, serif;
			margin: 30px 0 0 0;
			padding: 0;
			padding-bottom: 7px;
		}
		#error-page {
			margin-top: 50px;
		}
		#error-page p {
			font-size: 14px;
			line-height: 1.5;
			margin: 25px 0 20px;
		}
		#error-page code {
			font-family: Consolas, Monaco, monospace;
		}
		ul li {
			margin-bottom: 10px;
			font-size: 14px ;
		}
		a {
			color: #21759B;
			text-decoration: none;
		}
		a:hover {
			color: #D54E21;
		}

		.button {
			font-family: sans-serif;
			text-decoration: none;
			font-size: 14px !important;
			line-height: 16px;
			padding: 6px 12px;
			cursor: pointer;
			border: 1px solid #bbb;
			color: #464646;
			-webkit-border-radius: 15px;
			border-radius: 15px;
			-moz-box-sizing: content-box;
			-webkit-box-sizing: content-box;
			box-sizing: content-box;
			background-color: #f5f5f5;
			background-image: -ms-linear-gradient(top, #ffffff, #f2f2f2);
			background-image: -moz-linear-gradient(top, #ffffff, #f2f2f2);
			background-image: -o-linear-gradient(top, #ffffff, #f2f2f2);
			background-image: -webkit-gradient(linear, left top, left bottom, from(#ffffff), to(#f2f2f2));
			background-image: -webkit-linear-gradient(top, #ffffff, #f2f2f2);
			background-image: linear-gradient(top, #ffffff, #f2f2f2);
		}

		.button:hover {
			color: #000;
			border-color: #666;
		}

		.button:active {
			background-image: -ms-linear-gradient(top, #f2f2f2, #ffffff);
			background-image: -moz-linear-gradient(top, #f2f2f2, #ffffff);
			background-image: -o-linear-gradient(top, #f2f2f2, #ffffff);
			background-image: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#ffffff));
			background-image: -webkit-linear-gradient(top, #f2f2f2, #ffffff);
			background-image: linear-gradient(top, #f2f2f2, #ffffff);
		}

			</style>
</head>
<body id="error-page">
	<p><strong>ERROR</strong>: <?php echo get_option('comment_blocker_message'); ?></p></body>
</html>
            <?
			exit;
		}
		
	}
	
	
}



?>
