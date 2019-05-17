<?php 

/**
 * Helper function for post type tokoo-team
 *
 * @since 1.0
 **/

/**
 * Get testimony link
 *
 * @return string
 * @author tokoo
 **/
function tokoo_team_get_role() {
	$meta 	= get_post_meta( get_the_ID(), '_team_details', true );
	$role 	= ! empty( $meta['role'] ) ? $meta['role'] : '';

	return $role;
}

/**
 * Get testimony social account array
 *
 * @return array
 * @author tokoo
 **/
function tokoo_team_get_social_account_array() {
	$meta 			= get_post_meta( get_the_ID(), '_team_details', true );
	$social_account = ! empty( $meta['social_account'] ) ? $meta['social_account'] : '';

	return $social_account;
}

/**
 * Get testimony social account
 *
 * @return void
 * @author tokoo
 **/
function tokoo_team_social_accounts() {
	$meta 				= get_post_meta( get_the_ID(), '_team_details', true );
	$social_accounts 	= ! empty( $meta['social_account'] ) ? $meta['social_account'] : '';

	foreach ( $social_accounts as $key => $account ) {
		echo '<a href="'.esc_url( $account['url'] ).'">';
		echo '<i class="'.esc_attr( $account['icon'] ).'"></i>';
		echo '</a>';
	}
}

/**
 * Get testimony social account biography
 *
 * @return array
 * @author tokoo
 **/
function tokoo_team_get_biography() {
	$meta 		= get_post_meta( get_the_ID(), '_team_details', true );
	$biography 	= ! empty( $meta['biography'] ) ? $meta['biography'] : '';

	return $biography;
}

/**
 * Get testimony skills array
 *
 * @return void
 * @author tokoo
 **/
function tokoo_team_get_skills_array() {
	$meta 	= get_post_meta( get_the_ID(), '_team_details', true );
	$skill 	= ! empty( $meta['skill'] ) ? $meta['skill'] : '';

	return $skill;
}

/**
 * Get testimony skills
 *
 * @return void
 * @author tokoo
 **/
function tokoo_team_skills() {
	$meta 		= get_post_meta( get_the_ID(), '_team_details', true );
	$skills 	= ! empty( $meta['skill'] ) ? $meta['skill'] : '';

	foreach ( $skills as $key => $skill ) {
		echo '<span class="team-skill-name">'.esc_attr( $skill['skill_name'] ).'</span>';
		echo '<span class="team-skill-level">'.esc_attr( $skill['skill_level'] ).'</span>';
	}
}