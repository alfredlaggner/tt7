<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 *         $this->load->library('form_validator');
 *
 * $object = (object)$array;
 *
 * $array = (object)$array;
 *
 *
 */
class Xajax_validator
{

	/**
	 * private variables
	 */
	private $_error_list;
	private $form_data;

	// Math Captcha variables.
	public $digits = 1;                                // Specify how many digits your number will have. Example: (2) => 12; (3) => 123.
	public $showres = 1;                                // Specify if you want to display (1) or hide (0 )the result on the page. Example: 2+2=4.
	public $image = 0;                                // Specify if you want to display image (1) or text (0).
	public $size = 14;                                // Specify the size of the text. You can modify the font by replacing font.ttf file.

	// Math Captcha messages.
	public $success = 'Correct Captcha!';                // This message will appear if the entered code is correct
	public $wrong = 'Invalid Captcha!';                // This message will appear if the entered code is incorrect
	public $fill = 'Please fill in Captcha text!';    // This message will appear if there is no value entered

	// --------------------------------------------------------------------

	/**
	 * __Construct()
	 *
	 * Constructor    PHP 5+    NOTE: Not needed if not setting values!
	 *
	 * @access    public
	 * @return    void
	 */
	public function __construct()
	{
		$this->reset_error_list();
	}

	// --------------------------------------------------------------------

	/**
	 * set_form_data()
	 *
	 * Sets the form_data array with the $_data
	 *
	 * @access    public
	 * @param    string - $_data
	 * @return    void
	 */
	public function set_form_data($_data)
	{
		$this->form_data = $_data;
	}

	// --------------------------------------------------------------------

	/**
	 * _get_value()
	 *
	 * Returns the value from the form_data array.
	 *
	 * @access    private
	 * @param    string - $field
	 * @return    mixed
	 */
	private function _get_value($field)
	{
		return $this->form_data{$field};
	}

	// --------------------------------------------------------------------

	/**
	 * isEmpty()
	 *
	 * Checks to see if $field is empty.
	 *
	 * @access    public
	 * @param    string - $field
	 * @param    string - $msg
	 * @return    boolean
	 */
	public function isEmpty($field, $msg)
	{
		$value = $this->_get_value($field);

		if (trim($value) == "") {
			$this->_error_list[] = array(
				'field' => $field,
				'value' => $value,
				'msg' => $msg
			);

			return FALSE;
		} else {
			return TRUE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * isString()
	 *
	 * Checks to see if $field is a string.
	 *
	 * @access    public
	 * @param    string - $field
	 * @param    string - $msg
	 * @return    boolean
	 */
	public function isString($field, $msg)
	{
		$value = $this->_get_value($field);

		if (!is_string($value)) {
			$this->_error_list[] = array(
				'field' => $field,
				'value' => $value,
				'msg' => $msg
			);

			return FALSE;
		} else {
			return TRUE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * isNumber()
	 *
	 * Checks to see if $field is a numeric number.
	 *
	 * @access    public
	 * @param    string - $field
	 * @param    string - $msg
	 * @return    boolean
	 */
	public function isNumber($field, $msg)
	{
		$value = $this->_get_value($field);

		if (!is_numeric($value)) {
			$this->_error_list[] = array(
				'field' => $field,
				'value' => $value,
				'msg' => $msg
			);

			return FALSE;
		} else {
			return TRUE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * isInteger()
	 *
	 * Checks to see if $field is an integer.
	 *
	 * @access    public
	 * @param    string - $field
	 * @param    string - $msg
	 * @return    boolean
	 */
	public function isInteger($field, $msg)
	{
		$value = $this->_get_value($field);

		if (!is_integer($value)) {
			$this->_error_list[] = array(
				'field' => $field,
				'value' => $value,
				'msg' => $msg
			);

			return FALSE;
		} else {
			return TRUE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * isFloat()
	 *
	 * Checks to see if $field is a float.
	 *
	 * @access    public
	 * @param    string - $field
	 * @param    string - $msg
	 * @return    boolean
	 */
	public function isFloat($field, $msg)
	{
		$value = $this->_get_value($field);

		if (!is_float($value)) {
			$this->_error_list[] = array(
				'field' => $field,
				'value' => $value,
				'msg' => $msg
			);

			return FALSE;
		} else {
			return TRUE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * isWithinRange()
	 *
	 * Checks to see if $field is within the specified range values.
	 *
	 * @access    public
	 * @param    string - $field
	 * @param    string - $msg
	 * @param    string - $min
	 * @param    string - $max
	 * @return    boolean
	 */
	public function isWithinRange($field, $msg, $min, $max)
	{
		$value = $this->_get_value($field);

		if (!is_numeric($value) || $value < $min || $value > $max) {
			$this->_error_list[] = array(
				'field' => $field,
				'value' => $value,
				'msg' => $msg
			);

			return FALSE;
		} else {
			return TRUE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * isAlpha()
	 *
	 * Checks to see if $field is alphanumeric.
	 *
	 * @access    public
	 * @param    string - $field
	 * @param    string - $msg
	 * @return    boolean
	 */
	public function isAlpha($field, $msg)
	{
		$value = $this->_get_value($field);
		$pattern = "/^[a-zA-Z]+$/";

		if (preg_match($pattern, $value)) {
			return TRUE;
		} else {
			$this->_error_list[] = array(
				'field' => $field,
				'value' => $value,
				'msg' => $msg
			);

			return FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * isEmailAddress()
	 *
	 * Checks to see if $field is a valid email address.
	 *
	 * @access    public
	 * @param    string - $field
	 * @param    string - $msg
	 * @return    boolean
	 */
	public function isEmailAddress($field, $msg)
	{
		$value = $this->_get_value($field);

		$pattern = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";

		if (preg_match($pattern, $value)) {
			return TRUE;
		} else {
			$this->_error_list[] = array(
				'field' => $field,
				'value' => $value,
				'msg' => $msg
			);

			return FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * key_exsits()
	 *
	 * Checks to see if $field in the form_data key exsits in the array.
	 *
	 * @access    public
	 * @param    string - $field
	 * @return    boolean
	 */
	public function key_exsits($field = FALSE)
	{
		return array_key_exists($field, $this->form_data) ? TRUE : FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * isError()
	 *
	 * Checks to see if there is an Error.
	 *
	 * @access    public
	 * @return    boolean
	 */
	public function isError()
	{
		return (sizeof($this->_error_list) > 0) ? TRUE : FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * get_error_list()
	 *
	 * Returns an array of Errors.
	 *
	 * @access    public
	 * @return    mixed
	 */
	public function get_error_list()
	{
		return $this->_error_list;
	}

	// --------------------------------------------------------------------

	/**
	 * reset_error_list()
	 *
	 * Resets the _error_List array.
	 *
	 * @access    public
	 * @return    mixed
	 */
	public function reset_error_list()
	{
		$this->_error_list = array();
	}

	// -----------------------------------------------------------------------

	/**
	 * Math Captcha Methods.
	 */

	// --------------------------------------------------------------------

	/**
	 * show_captcha()
	 *
	 * Returns the captcha for displaying.
	 *
	 * @access    public
	 * @return    mixed
	 */
	public function show_captcha()
	{
		$CI = get_instance();

		if ($this->image == 1) {
			$this->image_captcha();
		} else {
			$this->text_captcha();

			$number_1 = $CI->session->userdata('number_1');
			$number_2 = $CI->session->userdata('number_2');
			$operator = $CI->session->userdata('operator');

			if ($number_1 <= $number_2) {
				return ($operator == 0) ? $number_2 . ' + ' . $number_1 : $number_2 . ' - ' . $number_1;
			} else {
				return ($operator == 0) ? $number_1 . ' + ' . $number_2 : $number_1 . ' - ' . $number_2;
			}

			if ($this->showres == 1) {
				return ' = ' . $CI->session->userdata('code');
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * image_captcha()
	 *
	 * Returns the image captcha for displaying.
	 *
	 * @access    public
	 * @return    string
	 */
	public function image_captcha()
	{
		return '<img src="captcha.php" />';
	}

	// --------------------------------------------------------------------

	/**
	 * text_captcha()
	 *
	 * Sets up the text captcha vaiables.
	 *
	 * @access    public
	 * @return    void
	 */
	public function text_captcha()
	{
		$CI = get_instance();

		// Generate random values based on the maximum number of digits
		for ($i = 0; $i <= $this->digits; $i++) {
			$max = str_repeat('9', $i);
		}

		$number_1 = rand(1, $max);
		$number_2 = rand(1, $max);
		$operator = rand(0, 1);

		// Do the math
		if ($operator == 0) {
			$result = $number_1 + $number_2;
		} else {
			$result = ($number_1 <= $number_2) ? $result = $number_2 - $number_1 : $result = $number_1 - $number_2;
		}

		// Sets a cookie for jQuery to read the answer.
		setcookie("wt", $result);

		// Sending the result in a session variable
		$CI = get_instance();

		$data = array(
			'code' => $result,
			'number_1' => $number_1,
			'number_2' => $number_2,
			'operator' => $operator
		);

		$CI->session->set_userdata($data);
	}

	// --------------------------------------------------------------------

	/**
	 * validate_captcha()
	 *
	 * Validates the captcha code and sets the seesion message.
	 *
	 * @access    public
	 * @param    string - $security
	 * @return    void
	 */
	public function validate_captcha($security)
	{
		$CI = get_instance();

		if (!empty($security)) {
			if ($CI->session->userdata('code') == $security) {
				$CI->session->set_userdata('security_message', $this->success);
			} else {
				$CI->session->set_userdata('security_message', $this->wrong);
			}
		} else {
			$CI->session->set_userdata('security_message', $this->fill);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * captcha_message()
	 *
	 * Returns the captcha message from the session variable.
	 *
	 * @access    public
	 * @return    mixed
	 */
	public function captcha_message()
	{
		$CI = get_instance();

		return $CI->session->userdata('security_message');
	}

	// --------------------------------------------------------------------
	// End of Math Captcha Methods.

}

// ------------------------------------------------------------------------
/* End of file Form_validator.php */
/* Location: ./application/libraries/Form_validator.php */