<? $this->load->view('modules/head') ?>
<? $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?= base_url() ?>js/ui/ui.tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		// Tabs
		$('#tabs').tabs();
	});
</script>
<script type="text/javascript" src="<?= base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		$("#news").validate(
			{
				rules: {
					cancel: "cancel",
					name: {
						required: true,
					},
					code: {
						required: true,
						minlength: 1,
						maxlength: 10
					},
					order: {
						range: [1, 100]
					},
					status_dependent_text: {
						required: "#is_status_dependent:checked"
					}
				},
				messages: {
					order: {
						range: "Order must be between 1 and 100"
					},
					name: {
						required: "Please enter an news name",
						minlength: "Minimum length is 3"
					},
					code: {
						required: "Please enter a 10 character code",
					},
					status_dependent_text: {
						required: "Status dependent text is checked, enter text"
					}
				}
			});
	});

</script>
<div id="sub-nav">
	<div class="page-title">
		<h1><?= $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?= anchor('news', 'news Overview'); ?>
			> <?= $title_action ?></span></div>
	<? $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<? if (isset($records)) : foreach ($records as $row) : ?>
				<h2><?= $title_action ?> <?= $row->name; ?></h2>
				<span></span></div>
			<div id="tabs">
				<div class="content-box">
					<div id="inputform">
						<ul border="0">
							<? $attributes = array('id' => 'news'); ?>
							<?= form_open('news/update/' . $row->news_id, $attributes); ?>
							<li>
								<input type="hidden" name="news_id" id="news_id" value='<?= $row->news_id; ?>'/>
							</li>
							<a href="../../../images">Treks and Tracks</a>
							<!--							<li>
								<label>Account</label>
								<select type="text" name="account_id" id="account_id" class="text"  value='<?= $row->account_id; ?>' />
								
								<? if (isset($accounts)) : foreach ($accounts as $account) : ?>
								<? if ($row->account_id == $account->account_id) : ?>
								<option selected value="<?= $account->account_id; ?>"><?= $account->account_name; ?></option>
								<? else : ?>
								<option value="<?= $account->account_id; ?>"><?= $account->account_name; ?></option>
								<? endif; ?>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
-->
							<li>
								<label>news Name</label>
								<input type="text" name="name" id="name" class="text" value='<?= $row->name; ?>'/>
							</li>
							<li>
								<label>news Code</label>
								<input type="text" name="code" id="code" class="text" value='<?= $row->code; ?>'/>
							</li>
							<li>
								<label>Group</label>
								<select type="text" name="news_group_id" id="news_group_id" class="text"
								        value='<?= $row->news_group_id; ?>'/>

								<? if (isset($news_groups)) : foreach ($news_groups as $news_group) : ?>
									<? if ($row->news_group_id == $news_group->news_group_id) : ?>
										<option selected
										        value="<?= $news_group->news_group_id; ?>"><?= $news_group->name; ?></option>
									<? else : ?>
										<option
											value="<?= $news_group->news_group_id; ?>"><?= $news_group->name; ?></option>
									<? endif; ?>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li>
								<label>Sort Order</label>
								<input type="text" name="order" id="order" class="text" value='<?= $row->order; ?>'/>
							</li>

							<li>
								<label>Division</label>
								<select type="text" name="division_id" id="division_id" class="text"
								        value='<?= $row->division_id; ?>'/>

								<? if (isset($divisions)) : foreach ($divisions as $division) : ?>
									<? if ($row->division_id == $division->division_id) : ?>
										<option selected
										        value="<?= $division->division_id; ?>"><?= $division->name; ?></option>
									<? else : ?>
										<option value="<?= $division->division_id; ?>"><?= $division->name; ?></option>
									<? endif; ?>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li>
							<li>
								<label>Headline</label>
								<input type="text" name="slogan" id="slogan" class="text" value='<?= $row->slogan; ?>'/>
							</li>
							<li>
								<label>Short Summary</label>
								<input type="text" name="description_short" id="description_short" class="text"
								       value='<?= $row->description_short; ?>'/>
							</li>
							<li>
								<label>news Text</label>
								<textarea class="text_area" name="description_long"
								          id="description_long"> <?= $row->description_long; ?></textarea>
							</li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
				<div id="inputform">
					<ul>
						<li>
							<label>Featured</label>
							<?= form_checkbox('is_featured', $row->is_featured, $row->is_featured) ?>
						</li>
						<li>&nbsp;
						</li>
						<li>
							<label>Active</label>
							<?= form_checkbox('is_active', $row->is_active, $row->is_active) ?> </li>
					</ul>
				</div>
				<div id="inputform">
					<ul>
					</ul>
				</div>
			</div>
		</div>
		<ul border="0">
			<li>
				<input type="submit" name="update" value="Update" class="buttons"/>
				<input type="submit" name="return" value="Save & Return" class="buttons"/>
				<input type="submit" name="cancel" id="cancel" value="Cancel" class="cancel buttons"/>
			</li>
			<?= form_close(); ?>
		</ul>
		<? endforeach; ?>
		<? else : ?>
			<p>No records were returned.</p>
		<? endif; ?>
	</div>
	<div class="clearfix"></div>
	<i class="note"><?= $bottom_note ?></i>
	<? $this->load->view('modules/sidebar') ?>
</div>
<div class="clear"></div>
</div>
</div>
<? $this->load->view('modules/footer') ?>
</body></html>