<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created with PhpDesigner7.
 * Created by: The Development Team.
 * User: Raymond L King Sr. aka: (InsiteFX)
 * Date: 1/28/2012
 * Time: 10:20:03 PM
 * @copyright 1/28/2012 by Raymond L King Sr.
 *
 * Class name: ./application/libraries/Class_name.php
 *
 * To change this template use File | Settings | File Templates.
 */
class New_pagination
{

	/**
	 * Class variables - public, private, protected and static.
	 */
	private $_ci;

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

	// --------------------------------------------------------------------

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

		if ($this->anchor_class != '') {
			//$this->anchor_class = 'class="'.$this->anchor_class.'" ';
		}
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
	}

	// -----------------------------------------------------------------------

	/**
	 * method_name()
	 *
	 * Description
	 *
	 * @access    public
	 * @param    string
	 * @return    void
	 */
	public function create_links()
	{
		$total_pages = $total_pages[num];

		$stages = 3;

		$page = mysql_escape_string($_GET['page']);

		if ($page) {
			$start = ($page - 1) * $limit;
		} else {
			$start = 0;
		}

		// Initial page num setup
		if ($page == 0) {
			$page = 1;
		}

		$prev = $page - 1;
		$next = $page + 1;

		$last_page = ceil($total_pages / $limit);

		$last_pagem1 = $last_page - 1;

		$output = '';

		if ($last_page > 1) {
			$output .= "<div class='paginate'>";

			// Previous
			if ($page > 1) {
				$output .= "<a href='$target_page?page=$prev'>previous</a>";
			} else {
				$output .= "<span class='disabled'>previous</span>";
			}

			// Pages
			if ($last_page < 7 + ($stages * 2))    // Not enough pages to breaking it up
			{
				for ($counter = 1; $counter <= $last_page; $counter++) {
					if ($counter == $page) {
						$output .= "<span class='current'>$counter</span>";
					} else {
						$output .= "<a href='$target_page?page=$counter'>$counter</a>";
					}
				}
			} elseif ($last_page > 5 + ($stages * 2))    // Enough pages to hide a few?
			{
				// Beginning only hide later pages
				if ($page < 1 + ($stages * 2)) {
					for ($counter = 1; $counter < 4 + ($stages * 2); $counter++) {
						if ($counter == $page) {
							$output .= "<span class='current'>$counter</span>";
						} else {
							$output .= "<a href='$target_page?page=$counter'>$counter</a>";
						}
					}

					$output .= "...";
					$output .= "<a href='$target_page?page=$last_pagem1'>$last_pagem1</a>";
					$output .= "<a href='$target_page?page=$last_page'>$last_page</a>";
				} // Middle hide some front and some back
				elseif ($last_page - ($stages * 2) > $page && $page > ($stages * 2)) {
					$output .= "<a href='$target_page?page=1'>1</a>";
					$output .= "<a href='$target_page?page=2'>2</a>";
					$output .= "...";

					for ($counter = $page - $stages; $counter <= $page + $stages; $counter++) {
						if ($counter == $page) {
							$output .= "<span class='current'>$counter</span>";
						} else {
							$output .= "<a href='$target_page?page=$counter'>$counter</a>";
						}
					}

					$output .= "...";
					$output .= "<a href='$target_page?page=$last_pagem1'>$last_pagem1</a>";
					$output .= "<a href='$target_page?page=$last_page'>$last_page</a>";
				} // End only hide early pages
				else {
					$output .= "<a href='$target_page?page=1'>1</a>";
					$output .= "<a href='$target_page?page=2'>2</a>";
					$output .= "...";

					for ($counter = $last_page - (2 + ($stages * 2)); $counter <= $last_page; $counter++) {
						if ($counter == $page) {
							$output .= "<span class='current'>$counter</span>";
						} else {
							$output .= "<a href='$target_page?page=$counter'>$counter</a>";
						}
					}
				}
			}

			// Next
			if ($page < $counter - 1) {
				$output .= "<a href='$target_page?page=$next'>next</a>";
			} else {
				$output .= "<span class='disabled'>next</span>";
			}

			$output .= "</div>";

			return $output;
		}
	}

	// -----------------------------------------------------------------------

	/**
	 * method_name()
	 *
	 * Description
	 *
	 * @access    public
	 * @param    string
	 * @return    void
	 */
	public function xajax_create_links()
	{

	}

}


// ------------------------------------------------------------------------
/* End of file Class_name.php */
/* Location: ./application/libraries/Class_name.php */