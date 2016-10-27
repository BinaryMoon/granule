<?php
/**
 * Theme Customizer Classes
 *
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/
 *
 * @package Granule
 * @subpackage ThemeCustomizerCustomControls
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Leave this file if the WP_Customize_Control class does not exist since it will create php errors.
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {

	return null;

}

/**
 * A custom control that displays a category dropdown selection for use in the Customizer.
 *
 * Displays a dropdown box that contains a list of categories that can be selected from.
 * Also displays options for 'No Categories', and 'All Categories'.
 */
class Granule_Category_Dropdown_Custom_Control extends WP_Customize_Control {

	/**
	 * Render category dropdown element
	 */
	public function render_content() {

		$value = $this->value();
		if ( empty( $value ) ) {
			$value = -2;
		}
?>
	<label>
		<span class="customize-category-select-control customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<select <?php $this->link(); ?>>
			<option value="-2" <?php echo selected( $value, -2, false ); ?>><?php echo esc_html__( 'No Categories (Hide)', 'granule' ); ?></option>
			<option value="-1" <?php echo selected( $value, -1, false ); ?>><?php echo esc_html__( 'All Categories', 'granule' ); ?></option>
<?php
		$args = array();
		$cats = get_categories( $args );
		foreach ( $cats as $cat ) {
			echo '<option value="' . absint( $cat->term_id ) . '"' . selected( $value, $cat->term_id, false ) . '>' . esc_html( $cat->name ) . '</option>';
		}
?>
		</select>
	</label>
<?php

	}

}

/**
 * A custom control that displays a dropdown box filled with a list of user defined 'things'.
 *
 * Displays a dropdown box filled with the contents of ...
 */
class Granule_Dropdown_Custom_Control extends WP_Customize_Control {

	/**
	 * Control parameters
	 *
	 * @var array
	 */
	public $params;

	/**
	 * Default seleted object id
	 *
	 * @var integer
	 */
	public $default;


	/**
	 * Initialize the dropdown custom control
	 *
	 * @param object $manager Control parent object.
	 * @param int    $id Customizer control id.
	 * @param array  $args Arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {

		$this->params = $args['params'];
		$this->default = (int) $args['default'];
		parent::__construct( $manager, $id, $args );

	}


	/**
	 * Render form elements for this control
	 */
	public function render_content() {

		$value = $this->value();

		if ( empty( $value ) ) {
			$value = $this->default;
		}
?>
	<label>
		<span class="customize-select-control customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<select <?php $this->link(); ?>>
<?php
		foreach ( $this->params as $k => $v ) {
?>
			<option value="<?php echo esc_attr( $k ); ?>" <?php echo selected( $value, $k, false ); ?>><?php echo esc_html( $v ); ?></option>
<?php
		}
?>
		</select>
	</label>
<?php

	}

}

/**
 * A list control with drag and drop facilities.
 *
 * A custom control that displays a list of user defined items.
 * The list can be added to with items from a dropdown control.
 * The list can be rearranged with drag and drop.
 * This is great for selecting and reordering categories so that a user can decide how they display on the site.
 */
class Granule_DragDrop_List_Control extends WP_Customize_Control {

	/**
	 * Type of control (for css and js targetting)
	 *
	 * @var string
	 */
	public $type = 'dragdrop-list';

	/**
	 * Construct the Drag and Drop list control.
	 *
	 * @param object $manager Control parent object.
	 * @param int    $id Customizer control id.
	 * @param array  $args Arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {

		parent::__construct( $manager, $id, $args );

		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

	}


	/**
	 * Display list of checkboxes for categories.
	 */
	public function render_content() {

		// Displays checkbox heading.
		echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';

		// Get the list of selected categories from the string and convert them to an array.
		$values = array_map( 'intval', explode( ',', $this->value() ) );

		// Displays selected items.
		echo '<ul class="granule-sortable">';
		foreach ( get_categories() as $category ) {
			if ( in_array( (int) $category->term_id, $values, true ) ) {
				echo '<li data-value="' . (int) $category->term_id . '">' . esc_html( $category->name ) . '</li>';
			}
		}
		echo '</ul>';

		// Displays selectable items.
		echo '<select class="granule-dragdrop-select">';
		echo '<option disabled selected>' . esc_html__( 'Select a category to display +', 'granule' ) . '</option>';
		foreach ( get_categories() as $category ) {
			if ( ! in_array( (int) $category->term_id, $values, true ) ) {
				echo '<option value="' . (int) $category->term_id . '">' . esc_html( $category->name ) . '</option>';
			}
		}
		echo '</select>';

		// Hidden input field that stores the saved category list.
?>
		<input type="hidden" id="<?php echo absint( $this->id ); ?>" class="granule-hidden-categories" <?php $this->link(); ?> value="<?php echo esc_html( $this->value() ); ?>">
<?php
	}


	/**
	 * Scripts and styles required for the drag and drop control.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_style( 'granule-theme-customizer', get_template_directory_uri() . '/styles/css/customizer.css' );
		wp_enqueue_script( 'granule-theme-customizer', get_template_directory_uri() . '/scripts/theme-customizer.js', array( 'jquery' ), '1.0', true );

	}

}
