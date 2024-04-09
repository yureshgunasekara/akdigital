<?php
/**
 * Elementor product-slider control.
 *
 * A control for displaying a select field with the ability to choose currencies.
 *
 * @since 1.0.0
 */
class Elementor_Product_Slider_Control extends \Elementor\Base_Data_Control {

	/**
	 * Get product-slider control type.
	 *
	 * Retrieve the control type, in this case `product-slider`.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Control type.
	 */
	public function get_type() {
		return 'product-slider';
	}


	/**
	 * Render product-slider control output in the editor.
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