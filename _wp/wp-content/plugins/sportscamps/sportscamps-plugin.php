<?php
/*
Plugin Name: Site Plugin for Sports Camps
Description: Site specific code changes for Sports Camps
*/
/* Start Adding Functions Below this Line */

function sportsCamps_create_cpt() {
	$labels = array(
		'name' => 'Teams',
		'singular_name' => 'Team',
		'add_new' => 'Add New Team',
		'add_new_item' => 'Add New Team',
		'edit_item' => 'Edit Team',
		'new_item' => 'New Team',
		'all_items' => 'All Teams',
		'view_item' => 'View Team',
		'search_items' => 'Search Teams',
		'not_found' =>  'No Teams Found',
		'not_found_in_trash' => 'No Teams found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Teams',
	);
	register_post_type( 'teams', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'supports' => array( 'title', 'editor', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'Team Name' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'team-pages', 'with_front'=> false ),
		'register_meta_box_cb' => 'team_info_meta_box',
		)
	);
	register_taxonomy(
		'Team Name',
		'teams',
		array(
			'label' => __( 'Team Name' ),
			'rewrite' => array( 'slug' => 'team' ),
			'capabilities' => array(
			'assign_terms' => 'edit_guides',
			'edit_terms' => 'publish_guides'
			)
		)
	);
}
add_action( 'init', 'sportsCamps_create_cpt' );

function sportsCamps_remove_cpt_slug( $post_link, $post, $leavename ) {
	 if ( 'teams' != $post->post_type || 'publish' != $post->post_status ) {
			 return $post_link;
	 }
	 $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
	 return $post_link;
}
add_filter( 'post_type_link', 'sportscamps_remove_cpt_slug', 10, 3 );

function sportsCamps_parse_request_trick( $query ) {
	 if ( ! $query->is_main_query() )
			 return;
	 if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
			 return;
	 }
	 if ( ! empty( $query->query['name'] ) ) {
			 $query->set( 'post_type', array( 'post', 'page', 'teams' ) );
	 }
}
add_action( 'pre_get_posts', 'sportsCamps_parse_request_trick' );

function team_info_meta_box() {
    add_meta_box(
        'team_id',
        __( 'Team ID', 'sportsCamps' ),
        'team_id_meta_box_callback'
    );
		add_meta_box(
        'team_name',
        __( 'Team Name', 'sportsCamps' ),
        'team_name_meta_box_callback'
    );
		add_meta_box(
        'team_url',
        __( 'Custom URL', 'sportsCamps' ),
        'team_url_meta_box_callback'
    );
		add_meta_box(
        'coach_name',
        __( 'Coach Name', 'sportsCamps' ),
        'coach_name_meta_box_callback'
    );
		add_meta_box(
        'coach_bio',
        __( 'Coach Bio', 'sportsCamps' ),
        'coach_bio_meta_box_callback'
    );
}

function team_id_meta_box_callback( $post ) {
    wp_nonce_field( 'team_id_nonce', 'team_id_nonce' );
    $team_id = get_post_meta( $post->ID, '_team_id', true );
    echo '<textarea style="width:100%" id="team_id" name="team_id">' . esc_attr( $team_id ) . '</textarea>';
}
function team_name_meta_box_callback( $post ) {
    wp_nonce_field( 'team_name_nonce', 'team_name_nonce' );
    $team_name = get_post_meta( $post->ID, '_team_name', true );
    echo '<textarea style="width:100%" id="team_name" name="team_name">' . esc_attr( $team_name ) . '</textarea>';
}
function team_url_meta_box_callback( $post ) {
    wp_nonce_field( 'team_url_nonce', 'team_url_nonce' );
    $team_url = get_post_meta( $post->ID, '_team_url', true );
    echo '<textarea style="width:100%" id="team_url" name="team_url">' . esc_attr( $team_url ) . '</textarea>';
}
function coach_name_meta_box_callback( $post ) {
    wp_nonce_field( 'coach_name_nonce', 'coach_name_nonce' );
    $coach_name = get_post_meta( $post->ID, '_coach_name', true );
    echo '<textarea style="width:100%" id="coach_name" name="coach_name">' . esc_attr( $coach_name ) . '</textarea>';
}
function coach_bio_meta_box_callback( $post ) {
    wp_nonce_field( 'coach_bio_nonce', 'coach_bio_nonce' );
    $coach_bio = get_post_meta( $post->ID, '_coach_bio', true );
    echo '<textarea style="width:100%" id="coach_bio" name="coach_bio">' . esc_attr( $coach_bio ) . '</textarea>';
}

function save_team_info_meta_box_data( $post_id ) {
/*
	if ( ! isset( $_POST['team_id_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['team_id_nonce'], 'team_id_nonce' ) ) {
		return;
	}
*/



	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	}
	else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}


/*
	if ( ! isset( $_POST['team_id'] ) ) {
		return;
	}
*/
	//Create inserts
	$team_id = sanitize_text_field( $_POST['team_id'] );
	$team_name = sanitize_text_field( $_POST['team_name'] );
	$team_url = sanitize_text_field( $_POST['team_url'] );
	$coach_name = sanitize_text_field( $_POST['coach_name'] );
	$coach_bio = sanitize_text_field( $_POST['coach_bio'] );
	// Insert Updates
	update_post_meta( $post_id, '_team_id', $team_id );
	update_post_meta( $post_id, '_team_name', $team_name );
	update_post_meta( $post_id, '_team_url', $team_url );
	update_post_meta( $post_id, '_coach_name', $coach_name );
	update_post_meta( $post_id, '_coach_bio', $coach_bio );

}
add_action( 'save_post', 'save_team_info_meta_box_data' );








?>
