<?php
/**
 * Template Name: Landing Page
 *
 * This page allows users to add a 'coming soon' page to their website. The page
 * displays full size with the featured image as the page background.
 *
 * @package Granule
 * @subpackage PageTemplate
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */



?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="webpage landing-page">

	<main role="main">

<?php
	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();

			get_template_part( 'parts/content-single', 'landing' );

		}
	}
?>

	</main>

</div>

<?php wp_footer(); ?>

</body>

</html>
