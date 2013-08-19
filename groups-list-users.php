<?php
/*
 Plugin Name: Groups List Users
Plugin URI: http://www.eggemplo.com
Description: List users of a group.
Author: Antonio Blanco
Version: 1.0
Author URI: http://www.eggemplo.com
*/

add_shortcode('groups_users_list_group', 'groups_users_list_group');

function groups_users_list_group( $atts, $content = null ) {
	$output = "";
	$options = shortcode_atts(
			array(
					'group_id' => null
			),
			$atts
	);
	if ($options['group_id']) {
		$group = new Groups_Group($options['group_id']);
		if ($group) {
			$users = $group->__get("users");
			if (count($users)>0) {
				foreach ($users as $group_user) {
					$user = $group_user->user;
					$user_info = get_userdata($user->ID);
      				
					$output .= $user_info->ID . "-" . $user_info-> user_lastname .  ", " . $user_info-> user_firstname . "<br>";
      			}
			}
		}
	}
	echo $output;
}

?>