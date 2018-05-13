<script type="text/javascript">
	$(function () {
		$("#dialog:ui-dialog").dialog("destroy");
		$('#home-intro-ctb').click(function (event) {

			$("#popup").dialog({
				modal: true,
				buttons: {
					Ok: function () {
						$(this).dialog("close");
					}
				}
			});
		});
	});
</script>
<script type="text/javascript">
	function MM_openBrWindow(theURL, winName, features) { //v2.0
		window.open(theURL, winName, features);
	}
</script>


<header class="sg-35">
	<a name="top"></a>
	<a id="header-logo" href="<?= site_url() . "tt_v1/index" ?>"></a>
	<nav id="header-nav">
		<ul>
			<li class="sel"><a href="<?= site_url() . "tt_v1/index" ?>">home</a></li>
			<li><a href="<?= site_url() . "menu_pages/about_us" ?>">about</a></li>
			<li><a href="<?= site_url() . "tt_v1/index/#classes" ?>">classes</a></li>
			<li><a href="<?= site_url() . "tt_v1/index/#downloads" ?>">downloads</a></li>
		</ul>
	</nav>
	<a id="home-intro-ctb"
	   onclick="MM_openBrWindow('<?= site_url() . "menu_pages/" ?>voucher','voucher','toolbar=yes,scrollbars=yes,resizable=yes,width=700px,height=400px')">Have
		a Voucher?<span></span></a>

	<!--                <form action="/search" method="get" id="header-search">
                    <input id="header-search-text" name="q"  type="text"  value="Have a Voucher?"  />
                    <input id="header-search-submit" type="image" src="<?= base_url() . IMAGE_DIR ?>img-px.png" alt="" />
                </form>
-->
</header>
<div class="sg-35">
	<nav id="header-nav-2">
		<ul>
			<!--<li>Products: &nbsp;</li>-->
			<!--<li><a href="<?= site_url() . "tt_v1/index" ?>#classes">our activities</a></li>-->
			<!--                         <li><a href="<?= site_url() . "tt_v1/index" ?>#gear">gear</a></li>
-->                    </ul>
	</nav>
</div>
