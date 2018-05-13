<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<style type="text/css">
	.calendar {
		font-family: Arial;
		font-size: 12px;
	}

	table.calendar {
		margin: auto;
		border-collapse: collapse;
	}

	.calendar .content {
		font-size: 10px;
	}

	.calendar .days td {
		width: 140px;
		height: 80px;
		padding: 4px;
		border: 1px solid #999;
		vertical-align: top;
		background-color: #DEF;
	}

	.calendar .days td:hover {
		background-color: #FFF;
	}

	.calendar .days a:hover {
		color: #000;
	}

	.calendar .highlight {
		font-weight: bold;
		color: #00F;
	}
</style>
<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> <?php echo $title_action ?></span>
	</div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span> <?php echo $top_note ?></span></div>
			<div class="content-box">
				<?php echo $calendar; ?>
			</div>
			<div class="clearfix"></div>
			<i class="note"></i>
			<?php $this->load->view('modules/sidebar') ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>