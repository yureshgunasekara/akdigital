<?php
/**
 * Elementor plan-box control.
 *
 * A control for displaying a select field with the ability to choose currencies.
 *
 * @since 1.0.0
 */
class Elementor_Plan_Box_Control extends \Elementor\Base_Data_Control {

	/**
	 * Get plan-box control type.
	 *
	 * Retrieve the control type, in this case `plan-box`.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Control type.
	 */
	public function get_type() {
		return 'plan-box';
	}


	/**
	 * Render plan-box control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
	}

}