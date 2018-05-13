<div class="slide_blog_resize">
	<div class="slide_blog_resize_b"><a name="top" id="top"></a>
		<h2>Resource Articles</h2>
		<div class="clr"></div>
	</div>
</div>
<div class="body">
	<div class="body_resize">
		<div class="clr"></div>
		<div class="left">
			<?php $j = 1; ?>
			<?php if ($articles) : foreach ($articles as $article) : ?>
				<h4><span><?php echo($article->Ar_Title); ?></span></h4>
				<p><?php echo(nl2br(substr($article->Ar_Text, 0, 250))); ?> ... <a
						href="<?php echo site_url('footer/article/' . $article->Ar_ID) ?>">read the whole article</a>
				</p>
				<br/>
				<?php if ($j++ % 5 == 0) : ?>
					<p style="text-align:right"><a href="#top">Go top</a></p>
				<?php endif ?>
				<hr>
				<br/>
			<?php endforeach ?>
			<?php endif ?>
			<p style="text-align:right"><a href="#top">Go top</a></p>
		</div>
		<div class="right">
			<h2>More About Us</h2>
			<ul>
				<li><?php echo anchor('pv/team', "Management Team") ?></li>
				<li><?php echo anchor('pv/contact', "Contact Us") ?></li>
				<li>&nbsp;</li>
				<li><a href="#" onclick="history.go(-1);return false;">Back to previous page</a></li>
				<li>&nbsp;</li>
			</ul>
		</div>
		<div class="clr"></div>
	</div>
</div>
<div class="clr"></div>
</div>
