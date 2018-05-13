<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<link rel="stylesheet" href="<?php echo base_url() ?>tablesorter/css/theme.default.css">
<link rel="stylesheet" href="<?php echo base_url() ?>tablesorter/addons/pager/jquery.tablesorter.pager.css">
<script type="text/javascript" src="<?php echo base_url() ?>tablesorter/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>tablesorter/js/jquery.tablesorter.widgets.js"></script>
<script type="text/javascript"
        src="<?php echo base_url() ?>tablesorter/addons/pager/jquery.tablesorter.pager.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		/* Table Sorter */
		$("#email-table")
			.tablesorter({
				widgets: ['zebra'],
				//	cssChildRow: 'invisible-table-row',
				headers: {
					0: {
						sorter: false
					},
					1: {
						sorter: false
					},
					2: {
						sorter: false
					},
					3: {
						sorter: false
					},
					4: {
						sorter: false
					},
					5: {
						sorter: false
					},

					6: {
						sorter: false
					},
					7: {
						sorter: false
					}
				}
			});
		;

		$(".header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');
	});

</script>


<script type="text/javascript">
	$(document).ready(function () {

		$('table').tablesorter({

			// *** APPEARANCE ***
			// Add a theme - try 'blackice', 'blue', 'dark', 'default'
			//  'dropbox', 'green', 'grey' or 'ice'
			// to use 'bootstrap' or 'jui', you'll need to add the "uitheme"
			// widget and also set it to the same name
			// this option only adds a table class name "tablesorter-{theme}"
			theme: 'blackice',

			// fix the column widths
			widthFixed: false,

			// Show an indeterminate timer icon in the header when the table
			// is sorted or filtered
			showProcessing: false,

			// header layout template (HTML ok); {content} = innerHTML,
			// {icon} = <i/> (class from cssIcon)
			headerTemplate: '{content}',

			// return the modified template string
			onRenderTemplate: null, // function(index, template){ return template; },

			// called after each header cell is rendered, use index to target the column
			// customize header HTML
			onRenderHeader: function (index) {
				// the span wrapper is added by default
				$(this).find('div.tablesorter-header-inner').addClass('roundedCorners');
			},

			// *** FUNCTIONALITY ***
			// prevent text selection in header
			cancelSelection: true,

			// other options: "ddmmyyyy" & "yyyymmdd"
			dateFormat: "mmddyyyy",

			// The key used to select more than one column for multi-column
			// sorting.
			sortMultiSortKey: "shiftKey",

			// key used to remove sorting on a column
			sortResetKey: 'ctrlKey',

			// false for German "1.234.567,89" or French "1 234 567,89"
			usNumberFormat: true,

			// If true, parsing of all table cell data will be delayed
			// until the user initializes a sort
			delayInit: false,

			// if true, server-side sorting should be performed because
			// client-side sorting will be disabled, but the ui and events
			// will still be used.
			serverSideSorting: false,

			// *** SORT OPTIONS ***
			// These are detected by default,
			// but you can change or disable them
			// these can also be set using data-attributes or class names
			headers: {
				// set "sorter : false" (no quotes) to disable the column
				1: {
					sorter: "digit"
				},
				7: {
					sorter: false
				},
				8: {
					sorter: false
				}
			},

			// ignore case while sorting
			ignoreCase: true,

			// forces the user to have this/these column(s) sorted first
			sortForce: null,
			// initial sort order of the columns, example sortList: [[0,0],[1,0]],
			// [[columnIndex, sortDirection], ... ]
			sortList: [
				[1, 0]
			],
			// default sort that is added to the end of the users sort
			// selection.
			sortAppend: null,

			// starting sort direction "asc" or "desc"
			sortInitialOrder: "asc",

			// Replace equivalent character (accented characters) to allow
			// for alphanumeric sorting
			sortLocaleCompare: false,

			// third click on the header will reset column to default - unsorted
			sortReset: true,

			// restart sort to "sortInitialOrder" when clicking on previously
			// unsorted columns
			sortRestart: false,

			// sort empty cell to bottom, top, none, zero
			emptyTo: "bottom",

			// sort strings in numerical column as max, min, top, bottom, zero
			stringTo: "max",

			// extract text from the table - this is how is
			// it done by default
			textExtraction: {
				0: function (node) {
					return $(node).text();
				},
				1: function (node) {
					return $(node).text();
				}
			},

			// use custom text sorter
			// function(a,b){ return a.sort(b); } // basic sort
			textSorter: null,

			// *** WIDGETS ***

			// apply widgets on tablesorter initialization
			initWidgets: true,

			// include zebra and any other widgets, options:
			// 'columns', 'filter', 'stickyHeaders' & 'resizable'
			// 'uitheme' is another widget, but requires loading
			// a different skin and a jQuery UI theme.
			widgets: ['zebra', 'columns'],

			widgetOptions: {

				// zebra widget: adding zebra striping, using content and
				// default styles - the ui css removes the background
				// from default even and odd class names included for this
				// demo to allow switching themes
				// [ "even", "odd" ]
				zebra: [
					"ui-widget-content even",
					"ui-state-default odd"],

				// uitheme widget: * Updated! in tablesorter v2.4 **
				// Instead of the array of icon class names, this option now
				// contains the name of the theme. Currently jQuery UI ("jui")
				// and Bootstrap ("bootstrap") themes are supported. To modify
				// the class names used, extend from the themes variable
				// look for the "$.extend($.tablesorter.themes.jui" code below
				uitheme: 'jui',

				// columns widget: change the default column class names
				// primary is the 1st column sorted, secondary is the 2nd, etc
				columns: [
					"primary",
					"secondary",
					"tertiary"],

				// columns widget: If true, the class names from the columns
				// option will also be added to the table tfoot.
				columns_tfoot: true,

				// columns widget: If true, the class names from the columns
				// option will also be added to the table thead.
				columns_thead: true,

				// filter widget: If there are child rows in the table (rows with
				// class name from "cssChildRow" option) and this option is true
				// and a match is found anywhere in the child row, then it will make
				// that row visible; default is false
				filter_childRows: false,

				// filter widget: If true, a filter will be added to the top of
				// each table column.
				filter_columnFilters: true,

				// filter widget: css class applied to the table row containing the
				// filters & the inputs within that row
				filter_cssFilter: "tablesorter-filter",

				// filter widget: Customize the filter widget by adding a select
				// dropdown with content, custom options or custom filter functions
				// see http://goo.gl/HQQLW for more details
				filter_functions: null,

				// filter widget: Set this option to true to hide the filter row
				// initially. The rows is revealed by hovering over the filter
				// row or giving any filter input/select focus.
				filter_hideFilters: false,

				// filter widget: Set this option to false to keep the searches
				// case sensitive
				filter_ignoreCase: true,

				// filter widget: jQuery selector string of an element used to
				// reset the filters.
				filter_reset: null,

				// Delay in milliseconds before the filter widget starts searching;
				// This option prevents searching for every character while typing
				// and should make searching large tables faster.
				filter_searchDelay: 300,

				// Set this option to true if filtering is performed on the server-side.
				filter_serversideFiltering: false,

				// filter widget: Set this option to true to use the filter to find
				// text from the start of the column. So typing in "a" will find
				// "albert" but not "frank", both have a's; default is false
				filter_startsWith: false,

				// filter widget: If true, ALL filter searches will only use parsed
				// data. To only use parsed data in specific columns, set this option
				// to false and add class name "filter-parsed" to the header
				filter_useParsedData: false,

				// Resizable widget: If this option is set to false, resized column
				// widths will not be saved. Previous saved values will be restored
				// on page reload
				resizable: true,

				// saveSort widget: If this option is set to false, new sorts will
				// not be saved. Any previous saved sort will be restored on page
				// reload.
				saveSort: true,

				// stickyHeaders widget: css class name applied to the sticky header
				stickyHeaders: "tablesorter-stickyHeader"

			},

			// *** CALLBACKS ***
			// function called after tablesorter has completed initialization
			initialized: function (table) {
			},

			// *** CSS CLASS NAMES ***
			tableClass: 'tablesorter',
			cssAsc: "tablesorter-headerSortUp",
			cssDesc: "tablesorter-headerSortDown",
			cssHeader: "tablesorter-header",
			cssHeaderRow: "tablesorter-headerRow",
			cssIcon: "tablesorter-icon",
			cssChildRow: "tablesorter-childRow",
			cssInfoBlock: "tablesorter-infoOnly",
			cssProcessing: "tablesorter-processing",

			// *** SELECTORS ***
			// jQuery selectors used to find the header cells.
			selectorHeaders: '> thead th, > thead td',

			// jQuery selector of content within selectorHeaders
			// that is clickable to trigger a sort.
			selectorSort: "th, td",

			// rows with this class name will be removed automatically
			// before updating the table cache - used by "update",
			// "addRows" and "appendCache"
			selectorRemove: "tr.remove-me",

			// *** DEBUGING ***
			// send messages to console
			debug: false


		});
		$(".header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');

// Extend the themes to change any of the default class names ** NEW **
		$.extend($.tablesorter.themes.jui, {
			// change default jQuery uitheme icons - find the full list of icons
			// here: http://jqueryui.com/themeroller/ (hover over them for their name)
			table: 'ui-widget ui-widget-content ui-corner-all', // table classes
			header: 'ui-widget-header ui-corner-all ui-state-default', // header classes
			icons: 'ui-icon', // icon class added to the <i> in the header
			sortNone: 'ui-icon-carat-2-n-s',
			sortAsc: 'ui-icon-carat-1-n',
			sortDesc: 'ui-icon-carat-1-s',
			active: 'ui-state-active', // applied when column is sorted
			hover: 'ui-state-hover', // hover class
			filterRow: '',
			even: 'ui-widget-content', // even row zebra striping
			odd: 'ui-state-default' // odd row zebra striping
		});
	});

	//$(document).ready(function() {
	//	/* Table Sorter */
	//	$("table")
	//	.tablesorter({
	//		widgets: ['zebra','columns'],
	//		sortList: [
	//        [1, 0],
	//    ],
	//	//	cssChildRow: 'invisible-table-row',
	//		headers: { 
	//		            8: { 
	//		                sorter: false 
	//		            } 
	//		        } 
	//	})
	//    initialized: function (table) {},
	//
	//    // *** CSS CLASS NAMES ***
	//    tableClass: 'tablesorter',
	//    cssAsc: "tablesorter-headerSortUp",
	//    cssDesc: "tablesorter-headerSortDown",
	//    cssHeader: "tablesorter-header",
	//    cssHeaderRow: "tablesorter-headerRow",
	//    cssIcon: "tablesorter-icon",
	//    cssChildRow: "tablesorter-childRow",
	//    cssInfoBlock: "tablesorter-infoOnly",
	//    cssProcessing: "tablesorter-processing",
	//
	//    // *** SELECTORS ***
	//    // jQuery selectors used to find the header cells.
	//    selectorHeaders: '> thead th, > thead td',
	//
	//    // jQuery selector of content within selectorHeaders
	//    // that is clickable to trigger a sort.
	//    selectorSort: "th, td",
	//
	//    // rows with this class name will be removed automatically
	//    // before updating the table cache - used by "update",
	//    // "addRows" and "appendCache"
	//    selectorRemove: "tr.remove-me",
	//
	//    // *** DEBUGING ***
	//    // send messages to console
	//    debug: false
	//
	//});
	//
	//// Extend the themes to change any of the default class names ** NEW **
	//$.extend($.tablesorter.themes.jui, {
	//    // change default jQuery uitheme icons - find the full list of icons
	//    // here: http://jqueryui.com/themeroller/ (hover over them for their name)
	//    table: 'ui-widget ui-widget-content ui-corner-all', // table classes
	//    header: 'ui-widget-header ui-corner-all ui-state-default', // header classes
	//    icons: 'ui-icon', // icon class added to the <i> in the header
	//    sortNone: 'ui-icon-carat-2-n-s',
	//    sortAsc: 'ui-icon-carat-1-n',
	//    sortDesc: 'ui-icon-carat-1-s',
	//    active: 'ui-state-active', // applied when column is sorted
	//    hover: 'ui-state-hover', // hover class
	//    filterRow: '',
	//    even: 'ui-widget-content', // even row zebra striping
	//    odd: 'ui-state-default' // odd row zebra striping
	//});	
	//	//$(".header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');
	//});

</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><?php echo $breadcrumb ?><?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<!--				<div class="hastable">
						<? if (isset($emailed_customer)) : ?>
										<h3> Email Recipients </h3>

							<table>
							<thead>
							<th>Recipient </th>
							<th>email </th>
							</thead>
							<tbody
						<? foreach ($emailed_customer as $customer) : ?>
					<tr>
					<td> <?= $customer->first_name . ' ' . $customer->last_name ?> </td>
					<td> <?= $customer->email ?> </td>
						</tr>
						<? endforeach; ?>
						</tbody>
						</table>
						<? else : ?>
							<h2><?php echo $title_action ?></h2>
						<? endif ?>
				
				</div>
-->
				<div>
					<? if (isset($emailed_customer)) : ?>
						<h3> Email Recipients </h3>
						<? foreach ($emailed_customer as $customer) : ?>
							<p style="font-weight:bold ; padding-top: 5px">
								<?= $customer->first_name . ' ' . $customer->last_name . ' - ' . $customer->email ?>
							</p
							>
							</tr>
						<? endforeach; ?>
					<? else : ?>
						<h2><?php echo $title_action ?></h2>
					<? endif ?>
				</div>
				<? if ($is_from_manage_templates) : ?>

					<p style="float:right" ;>
						<?php echo anchor('template/template_create/' . $activity_id, 'Create New eMail') ?>
					</p>
				<? endif ?>
			</div>
			<div class="hastable">
				<? $attributes = array('id' => 'template_select', 'class' => 'pager-form'); ?>
				<?= form_open('template/return_to_activity_select/ ' . $activity_id, $attributes); ?>
				<table id="email-table">
					<thead>
					<tr>
						<!--<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)" class="submit"/></th>-->
						<th>eMail Name</th>
						<th>Activity</th>
						<th>Subject</th>
						<th>Activated</th>
						<th>Reminder Y/N</th>
						<th>Reminder</th>
						<th>Order Confirm</th>
						<th style="width:156px">Options</th>
					</tr>
					</thead>
					<tbody>
					<? $is_choose = isset($is_choose); ?>
					<? if (isset($records)) : foreach ($records as $row) :

						$interval = "";
						if ($row->is_automated) {
							if ($row->send_interval == SEND_ONE_WEEK_PRIOR_EVENT) $interval = "One week prior";
							if ($row->send_interval == SEND_TWO_WEEK_PRIOR_EVENT) $interval = "Two weeks prior";
						}

						?>

						<input type="hidden" class="invisible-table-row" value="<?= $row->template_id ?>"
						       name="template_id"/>
						<tr>
							<!--<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>-->
							<td><?= $row->template_name ?></td>
							<td><?= $row->code ? $row->code : "all" ?></td>
							<td><?= $row->subject ?></td>
							<td><?= $row->template_active ? 'yes' : 'no' ?></td>
							<td><?= $row->is_automated ? 'yes' : 'no' ?></td>
							<td><?= $interval ?></td>
							<td><?= $row->is_confirmation ? 'yes' : 'no' ?></td>

							<td>

								<? if ($is_choose) : ?>
									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip  confirmClick"
									   title="Send mails now without changes!"
									   href="<?php echo site_url() . 'customer_contact/send_mail/' ?><?= $row->template_id . '/' . TRUE . '/' . $activity_id ?>">
										<span class="ui-icon ui-icon-mail-closed"></span> </a> <a
										class="btn_no_text btn ui-state-default ui-corner-all tooltip"
										title="Send mails after editing"
										href="<?php echo site_url() . 'customer_contact/template_edit/' ?><?= $row->template_id . '/' . TRUE . '/' . $activity_id ?>">
										<span class="ui-icon ui-icon-newwin"></span> </a>
									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Manage attachments"
									   href="<?php echo site_url() . 'attachment/index/' ?><?= $row->template_id . '/' . $activity_id ?>">
										<span class="ui-icon ui-icon-plusthick"></span> </a>
								<? else : ?>
									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="Edit eMail"
									   href="<?php echo site_url() . 'template/template_view/' ?><?= $row->template_id ?>">
										<span class="ui-icon ui-icon-wrench"></span> </a>
									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Manage attachments"
									   href="<?php echo site_url() . 'attachment/index/' ?><?= $row->template_id . '/' . $activity_id ?>">
										<span class="ui-icon ui-icon-plusthick"></span> </a>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
									   title="Delete eMail"
									   href="<?php echo site_url() . 'template/delete/' ?><?= $row->template_id ?>">
										<span class="ui-icon ui-icon-trash"></span> </a>

								<? endif ?>
							</td>
						</tr>
					<? endforeach; endif; ?>

					</tbody>

				</table>
				<? if ($is_from_manage_templates) : ?>
					<tr>
						<td><input type="submit" name="submit" value="Return to select another activity"
						           class="buttons"/></td>
					</tr>

				<? endif ?>
				</form>
				<div class="clear"></div>
				<?php $this->load->view('modules/sidebar') ?>
			</div>
		</div>
		<?php $this->load->view('modules/footer') ?>
	</div>
	</body>
	</html>
