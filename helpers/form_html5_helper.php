<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package    CodeIgniter
 * @author    EllisLab Dev Team
 * @copyright    Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright    Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license    http://opensource.org/licenses/MIT	MIT License
 * @link    https://codeigniter.com
 * @since    Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('form_date')) {
	/**
	 * Text date Field
	 *
	 * @param    mixed
	 * @param    string
	 * @param    mixed
	 * @return    string
	 */
	function form_date($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'type' => 'date',
			'name' => is_array($data) ? '' : $data,
			'value' => $value
		);

		return '<input ' . _parse_form_attributes($data, $defaults) . _attributes_to_string($extra) . " />\n";
	}
}
if (!function_exists('form_number')) {
	/**
	 * Text date Field
	 *
	 * @param    mixed
	 * @param    string
	 * @param    mixed
	 * @return    string
	 */
	function form_number($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'type' => 'number',
			'name' => is_array($data) ? '' : $data,
			'value' => $value
		);

		return '<input ' . _parse_form_attributes($data, $defaults) . _attributes_to_string($extra) . " />\n";
	}
}
if (!function_exists('form_textarea_5')) {
	/**
	 * Textarea field
	 *
	 * @param    mixed $data
	 * @param    string $value
	 * @param    mixed $extra
	 * @return    string
	 */
	function form_textarea5($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'name' => is_array($data) ? '' : $data,
		);

		if (!is_array($data) OR !isset($data['value'])) {
			$val = $value;
		} else {
			$val = $data['value'];
			unset($data['value']); // textareas don't use the value attribute
		}

		return '<textarea ' . _parse_form_attributes($data, $defaults) . _attributes_to_string($extra) . '>'
		. html_escape($val)
		. "</textarea>\n";
	}
}

// ------------------------------------------------------------------------
