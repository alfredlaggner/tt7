<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter-pager.js"></script>
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
				<h2><?php echo $title_action ?></h2>
				<span><?php echo $top_note ?></span>
				<p style="float:right" ;>
					<?php echo anchor('template/template_create/' . $activity_id, 'Create New Template') ?>
				</p>
			</div>
			<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="template/return_to_activity_select">
					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
							           class="submit"/></th>
							<th>Activity Id</th>
							<th>Template Name</th>
							<th>Mail Subject</th>
							<th style="width:128px">Options</th>
						</tr>
						</thead>
						<tbody>

						<? if (isset($records)) : foreach ($records as $row) : ?>
							<input type="hidden" value="<?= $row->template_id ?>" name="template_id"/>
							<tr>
								<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>
								<td><?= $row->activity_id ?></td>
								<td><?= $row->name ?></td>
								<td><?= $row->subject ?></td>
								<td>
									<? if (isset($is_choose) ? $is_choose : FALSE) : ?>
										<a class="btn_no_text btn ui-state-default ui-corner-all tooltip  confirmClick"
										   title="Send mails now without changes!"
										   href="<?php echo site_url() . 'customer_contact/send_mail/' ?><?= $row->template_id . '/' . TRUE ?>">
											<span class="ui-icon ui-icon-mail-closed"></span> </a>

										<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
										   title="Send mails after editing template"
										   href="<?php echo site_url() . 'customer_contact/template_edit/' ?><?= $row->template_id . '/' . TRUE ?>">
											<span class="ui-icon ui-icon-newwin"></span> </a>

									<? else : ?>
										<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
										   title="Edit template"
										   href="<?php echo site_url() . 'template/template_view/' ?><?= $row->template_id ?>">
											<span class="ui-icon ui-icon-wrench"></span> </a>

									<? endif ?>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
									   title="Delete template"
									   href="<?php echo site_url() . 'template/delete/' ?><?= $row->template_id ?>">
										<span class="ui-icon ui-icon-trash"></span> </a></td>
							</tr>
						<? endforeach; endif; ?>
						<tr>
							<td>
								<input type="submit" name="submit" value="Return to select another acticity"
								       class="buttons"/>
							</td>
						</tr>
						</tbody>

					</table>

				</form>
				<div class="clear"></div>
				<?php $this->load->view('modules/sidebar') ?>
			</div>
		</div>
		<?php $this->load->view('modules/footer') ?>
	</div>
	</body></html>