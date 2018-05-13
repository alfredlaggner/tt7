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
					name: {
						required: true,
						minlength: 3
					},
					code: {
						required: true,
						minlength: 5,
						maxlength: 5
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
						required: "Please enter a 5 character code",
						maxlength: "Maximum length is 5",
						minlength: "Minimum length is 5"
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
		<span></span></div>
	<? $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?= $title_action ?></h2>
				<span></span></div>
			<div id="tabs">
				<div class="content-box">
					<div id="inputform">
						<ul>
							<? $attributes = array('id' => 'news'); ?>
							<?= form_open('news/create', $attributes); ?>
							<!--								<li>
									<label>Account</label>
									<select type="text" name="account_id" id="account_id" class="text"  value='' />
									
									<? if (isset($accounts)) : foreach ($accounts as $account): ?>
									<option value="<?= $account->account_id; ?>"><?= $account->account_name; ?></option>
									<? endforeach; ?>
									<? endif; ?>
									</select>
								</li>
-->
							<li>
								<label>news Name</label>
								<input type="text" name="name" id="name" class="text" value=''/>
							</li>
							<li>
								<label>news Code</label>
								<input type="text" name="code" id="code" class="text" value=''/>
							</li>
							<li>
								<label>Group</label>
								<select type="text" name="news_group_id" id="news_group_id" class="text" value=''/>

								<? if (isset($news_groups)) : foreach ($news_groups as $news_group) : ?>
									<option
										value="<?= $news_group->news_group_id; ?>"><?= $news_group->name; ?></option>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<!--								<li>
									<label>Division</label>
									<select type="text" name="division_id" id="division_id" class="text"  value='' />
									
									<? if (isset($divisions)) : foreach ($divisions as $division) : ?>
									<option          value="<?= $division->division_id; ?>"><?= $division->name; ?></option>
									<? endforeach; ?>
									<? endif; ?>
									</select>
								</li>
-->
							<li>
								<label>Sort Order</label>
								<input type="text" name="order" id="order" class="text" value=''/>
							</li>

							<li>
								<label>Headline</label>
								<input type="text" name="slogan" id="slogan" class="text" value=''/>
							</li>
							<li>
								<label>Short Summary</label>
								<input type="text" name="description_short" id="description_short" class="text"
								       value=''/>
							</li>
							<li>
								<label>news Text</label>
								<textarea class="text_area" name="description_long" id="description_long"></textarea>
							</li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
				<div id="inputform">
					<ul>
						<li>
							<label>Featured</label>
							<?= form_checkbox('is_featured', 'no', FALSE) ?> </li>
						<li>
							<label>Active</label>
							<?= form_checkbox('is_active', 'no', FALSE) ?> </li>
					</ul>
				</div>
				<div id="inputform">
					<ul>
						<li>
							<input type="submit" name="create" value="Create" class="buttons"/>
							<input type="submit" name="cancel" value="Cancel" class="cancel  buttons"/>
						</li>
						<?= form_close(); ?>
					</ul>
				</div>
			</div>
			<div class="clearfix"></div>
			<i class="note">* To see more boxes examples, like the ones above, visit for the menu, the Layout Options
				pages.</i>
			<? $this->load->view('modules/sidebar') ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<? $this->load->view('modules/footer') ?>
</body></html>