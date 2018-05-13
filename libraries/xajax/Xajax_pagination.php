<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package        CodeIgniter
 * @author        ExpressionEngine Dev Team
 * @copyright    Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license        http://codeigniter.com/user_guide/license.html
 * @link        http://codeigniter.com
 * @since        Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Xajax Pagination Class
 *
 * @package        CodeIgniter    - v2.1.0
 * @subpackage    Libraries
 * @category    Pagination
 * @author        ExpressionEngine Dev Team
 * @link        http://codeigniter.com/user_guide/libraries/pagination.html
 */
class Xajax_pagination
{

	public $function_to_call = '';                // The function registered by Xajax to call
	public $panel_to_update = '';

	public $base_url = '';                // The page we are linking to
	public $prefix = '';                // A custom prefix added to the path.
	public $suffix = '';                // A custom suffix added to the path.

	public $total_rows = 0;                // Total number of items (database results)
	public $per_page = 10;                // Max number of items you want shown per page
	public $num_links = 2;                // Number of "digit" links to show before/after the currently viewed page
	public $cur_page = 0;                // The current page being viewed
	public $use_page_numbers = FALSE;            // Use page number for segment instead of offset
	public $first_link = '&lsaquo; First';
	public $next_link = '&gt;';
	public $prev_link = '&lt;';
	public $last_link = 'Last &rsaquo;';
	public $uri_segment = 3;
	public $full_tag_open = '';
	public $full_tag_close = '';
	public $first_tag_open = '';
	public $first_tag_close = '&nbsp;';
	public $last_tag_open = '&nbsp;';
	public $last_tag_close = '';
	public $first_url = '';                // Alternative URL for the First Page.
	public $cur_tag_open = '&nbsp;<strong>';
	public $cur_tag_close = '</strong>';
	public $next_tag_open = '&nbsp;';
	public $next_tag_close = '&nbsp;';
	public $prev_tag_open = '&nbsp;';
	public $prev_tag_close = '';
	public $num_tag_open = '&nbsp;';
	public $num_tag_close = '';
	public $page_query_string = FALSE;
	public $query_string_segment = 'per_page';
	public $display_pages = TRUE;
	public $anchor_class = '';

	/**
	 * Constructor
	 *
	 * @access    public
	 * @param    array    initialization parameters
	 */
	public function __construct($params = array())
	{
		if (count($params) > 0) {
			$this->initialize($params);
		}

		log_message('debug', "Xajax Pagination Class Initialized");
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize Preferences
	 *
	 * @access    public
	 * @param    array    initialization parameters
	 * @return    void
	 */
	function initialize($params = array())
	{
		if (count($params) > 0) {
			foreach ($params as $key => $val) {
				if (isset($this->$key)) {
					$this->$key = $val;
				}
			}
		}

		if ($this->anchor_class != '') {
			//$this->anchor_class = 'class="' . $this->anchor_class . '" ';
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Generate the pagination links
	 *
	 * @access    public
	 * @return    string
	 */
	function create_links($cur_page = 0)
	{
		$this->cur_page = $cur_page;

		// If our item count or per-page total is zero there is no need to continue.
		if ($this->total_rows == 0 OR $this->per_page == 0) {
			return '';
		}

		// Calculate the total number of pages
		$num_pages = ceil($this->total_rows / $this->per_page);

		$info = '';

		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1) {
			$info = 'Pages : ' . $this->total_rows;
			return $info;
		}

		// Set the base page index for starting page number
		if ($this->use_page_numbers) {
			$base_page = 1;
		} else {
			$base_page = 0;
		}

		// Determine the current page number.
		$CI =& get_instance();

		if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE) {
			if ($CI->input->get($this->query_string_segment) != $base_page) {
				$this->cur_page = $CI->input->get($this->query_string_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int)$this->cur_page;
			}
		} else {
			if ($CI->uri->segment($this->uri_segment) != $base_page) {
				$this->cur_page = $CI->uri->segment($this->uri_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int)$this->cur_page;
			}
		}

		// Set current page to 1 if using page numbers instead of offset
		if ($this->use_page_numbers AND $this->cur_page == 0) {
			$this->cur_page = $base_page;
		}

		$this->num_links = (int)$this->num_links;

		if ($this->num_links < 1) {
			show_error('Your number of links must be a positive number.');
		}

		if (!is_numeric($this->cur_page)) {
			$this->cur_page = $base_page;
		}

		// Is the page number beyond the result range? If so we show the last page
		if ($this->use_page_numbers) {
			if ($this->cur_page > $num_pages) {
				$this->cur_page = $num_pages;
			}
		} else {
			if ($this->cur_page > $this->total_rows) {
				$this->cur_page = ($num_pages - 1) * $this->per_page;
			}
		}

		$uri_page_number = $this->cur_page;

		if (!$this->use_page_numbers) {
			$this->cur_page = floor(($this->cur_page / $this->per_page) + 1);
		}

		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
		$end = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

		// Is pagination being used over GET or POST?  If get, add a per_page query
		// string. If post, add a trailing slash to the base URL if needed
		if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE) {
			$this->base_url = rtrim($this->base_url) . '&amp;' . $this->query_string_segment . '=';
		} else {
			$this->base_url = rtrim($this->base_url, '/') . '/';
		}

		// And here we go...
		$output = '';

		// SHOWING LINKS

		$curr_offset = $CI->uri->segment($this->uri_segment);

		$info = 'Page ' . ($curr_offset + 1) . ' to ';

		if (($curr_offset + $this->per_page) < ($this->total_rows - 1)) {
			$info .= $curr_offset + $this->per_page;
		} else {
			$info .= $this->total_rows;
		}

		$info .= ' of ' . $this->total_rows . ' | ';

		$output .= $info;

		// Render the "First" link
		if ($this->first_link !== FALSE AND $this->cur_page > ($this->num_links + 1)) {
			$first_url = ($this->first_url == '') ? $this->base_url : $this->first_url;
			$output .= $this->first_tag_open . $this->create_ajax_links($this->first_link, $first_url) . $this->first_tag_close;
		}

		// Render the "previous" link
		if ($this->prev_link !== FALSE AND $this->cur_page != 1) {
			if ($this->use_page_numbers) {
				$i = $uri_page_number - 1;
			} else {
				$i = $uri_page_number - $this->per_page;
			}

			if ($i == 0 && $this->first_url != '') {
				$first_url = $i;
				$output .= $this->prev_tag_open . $this->create_ajax_links($this->prev_link, $this->first_url) . $this->prev_tag_close;
			} else {
				$i = ($i == 0) ? '' : $this->prefix . $i . $this->suffix;
				$output .= $this->prev_tag_open . $this->create_ajax_links($this->prev_link, $i) . $this->prev_tag_close;
			}
		}

		// Render the pages
		if ($this->display_pages !== FALSE) {
			// Write the digit links
			for ($loop = $start - 1; $loop <= $end; $loop++) {
				if ($this->use_page_numbers) {
					$i = $loop;
				} else {
					$i = ($loop * $this->per_page) - $this->per_page;
				}

				if ($i >= $base_page) {
					if ($this->cur_page == $loop) {
						$output .= $this->cur_tag_open . $this->create_ajax_links($loop, $i) . $this->cur_tag_close;
					} else {
						$n = ($i == $base_page) ? '' : $i;

						if ($n == '' && $this->first_url != '') {
							//$first_url = $n;						
							$output .= $this->num_tag_open . $this->create_ajax_links($loop, $this->first_url) . $this->num_tag_close;
						} else {
							$output .= $this->num_tag_open . $this->create_ajax_links($loop, $n) . $this->num_tag_close;
						}
					}
				}
			}
		}

		// Render the "next" link
		if ($this->next_link !== FALSE AND $this->cur_page < $num_pages) {
			if ($this->use_page_numbers) {
				$i = $this->cur_page + 1;
			} else {
				$i = ($this->cur_page * $this->per_page);
			}

			$output .= $this->next_tag_open . $this->create_ajax_links($this->next_link, $this->prefix . $i . $this->suffix) . $this->next_tag_close;
		}

		// Render the "Last" link
		if ($this->last_link !== FALSE AND ($this->cur_page + $this->num_links) < $num_pages) {
			if ($this->use_page_numbers) {
				$i = $num_pages;
			} else {
				$i = (($num_pages * $this->per_page) - $this->per_page);
			}

			$output .= $this->last_tag_open . $this->create_ajax_links($this->last_link, $this->prefix . $i . $this->suffix) . $this->last_tag_close;
		}

		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace("#([^:])//+#", "\\1/", $output);

		// Add the wrapper HTML if exists
		$output = $this->full_tag_open . $output . $this->full_tag_close;

		return $output;
	}

	// --------------------------------------------------------------------

	/**
	 * create_ajax_links()
	 *
	 * Creates the xajax links on the html web page.
	 *
	 * @access    public
	 * @param    string
	 * @return    void
	 */
	public function create_ajax_links($text, $page = '')
	{
		return "<a " . $this->anchor_class . " href='javascript:void(0);' onclick=xajax_" . $this->function_to_call . "('" . $page . "');return false;>" . $text . "</a>";
	}

}


/* ------------------------------------------------------------------------
 * End of file Xajax_pagination.php
 * Location: ./application/libraries/Xajax_pagination.php
 * ------------------------------------------------------------------------
 */