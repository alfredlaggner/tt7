<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
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
 * @copyright    Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright    Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license    http://opensource.org/licenses/MIT	MIT License
 * @link    http://codeigniter.com
 * @since    Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter String Helpers
 *
 * @package        CodeIgniter
 * @subpackage    Helpers
 * @category    Helpers
 * @author        EllisLab Dev Team
 * @link        http://codeigniter.com/user_guide/helpers/string_helper.html
 */

// ------------------------------------------------------------------------

if (!function_exists('debug_print')) {
	/**
	 * Trim Slashes
	 *
	 * Removes any leading/trailing slashes from a string:
	 *
	 * /this/that/theother/
	 *
	 * becomes:
	 *
	 * this/that/theother
	 *
	 * @todo    Remove in version 3.1+.
	 * @deprecated    3.0.0    This is just an alias for PHP's native trim()
	 *
	 * @param    string
	 * @return    string
	 */
	function debug_print($var, $nfo = 'DEBUG', $htm = false, $ret = false)
	{

		$var_str = print_r($var, true);

		if ($htm !== false) {
			$var_str = htmlentities($var_str);
		}

		$outstr = '';

		$outstr = '<p>--------- <strong>' . $nfo . '</strong> ---------</p>' . "\n";

		$outstr .= '<pre style="margin:18px 4px; padding:6px; text-align:left; background:#DEDEDE; color:#000099;">' . "\n";
		$outstr .= $var_str . "\n";
		$outstr .= '</pre>' . "\n";

		if ($ret !== false) {
			$result = $outstr;
		} else {
			print $outstr;
			$result = true;
		}

		return $result;
	}

	function print_r_reverse($in)
	{
		$lines = explode("\n", trim($in));
		if (trim($lines[0]) != 'Array') {
			// bottomed out to something that isn't an array 
			return $in;
		} else {
			// this is an array, lets parse it 
			if (preg_match("/(\s{5,})\(/", $lines[1], $match)) {
				// this is a tested array/recursive call to this function 
				// take a set of spaces off the beginning 
				$spaces = $match[1];
				$spaces_length = strlen($spaces);
				$lines_total = count($lines);
				for ($i = 0; $i < $lines_total; $i++) {
					if (substr($lines[$i], 0, $spaces_length) == $spaces) {
						$lines[$i] = substr($lines[$i], $spaces_length);
					}
				}
			}
			array_shift($lines); // Array 
			array_shift($lines); // ( 
			array_pop($lines); // ) 
			$in = implode("\n", $lines);
			// make sure we only match stuff with 4 preceding spaces (stuff for this array and not a nested one) 
			preg_match_all("/^\s{4}\[(.+?)\] \=\> /m", $in, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
			$pos = array();
			$previous_key = '';
			$in_length = strlen($in);
			// store the following in $pos: 
			// array with key = key of the parsed array's item 
			// value = array(start position in $in, $end position in $in) 
			foreach ($matches as $match) {
				$key = $match[1][0];
				$start = $match[0][1] + strlen($match[0][0]);
				$pos[$key] = array($start, $in_length);
				if ($previous_key != '') $pos[$previous_key][1] = $match[0][1] - 1;
				$previous_key = $key;
			}
			$ret = array();
			foreach ($pos as $key => $where) {
				// recursively see if the parsed out value is an array too 
				$ret[$key] = print_r_reverse(substr($in, $where[0], $where[1] - $where[0]));
			}
			return $ret;
		}
	}

	function print_r2($val)
	{
		echo '<pre>';
		print_r($val);
		echo '</pre>';
	}
}