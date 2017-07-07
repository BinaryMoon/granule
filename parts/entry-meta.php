<?php
/**
 * Post Meta Data
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

?>

	<div class="post-meta-data entry-meta">

<?php
	granule_post_time();

	granule_comments_link();

	granule_post_author();

	granule_the_main_category();

	get_template_part( 'parts/edit-post' );
?>

	</div>
