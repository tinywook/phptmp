<?php
/*
$redirect_url_requested_uri = $_SERVER['REQUEST_URI'];
$redirect_url_requested_host = $_SERVER['HTTP_HOST'];
$redirect_url_requested_scheme = $_SERVER['REQUEST_SCHEME'];


$redirect_url_destination_url = get_field('vanitydomain');
$redirect_url_destination_host = $redirect_url_destination_url;
$redirect_url_destination_host = str_replace( "http://.", "", $redirect_url_destination_host);
$redirect_url_destination_host = str_replace( "https://.", "", $redirect_url_destination_host);
$redirect_url_destination_host = str_replace( "www.", "", $redirect_url_destination_host);

if (($redirect_url_requested_host != $redirect_url_destination_host) && (strlen($redirect_url_destination_host > "" )) && (strlen($redirect_url_requested_uri > "" )) ) {

$redirect_url_final_url = $redirect_url_requested_scheme . "://" . $redirect_url_destination_host . $redirect_url_requested_uri ;
header("HTTP/1.1 301 Moved Permanently");
header("Location: " . $redirect_url_final_url);
}
echo "| redirect_url_final_url = '" .$redirect_url_final_url . "' | ";
//echo "| redirect_url_destination_path = '" . $redirect_url_destination_path . "' | ";


?>
<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php get_template_part( 'template-parts/header/header', 'image' ); ?>

		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<div class="navigation-top">
				<div class="wrap">
					<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
				</div><!-- .wrap -->
			</div><!-- .navigation-top -->
		<?php endif; ?>

	</header><!-- #masthead -->

	<?php
	// If a regular post or page, and not the front page, show the featured image.
	if ( has_post_thumbnail() && ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) ) :
		echo '<div class="single-featured-image-header">';
		the_post_thumbnail( 'twentyseventeen-featured-image' );
		echo '</div><!-- .single-featured-image-header -->';
	endif;
	?>

	<div class="site-content-contain">
		<div id="content" class="site-content">
