<!-- Xajax pagination -->
<table cellpadding='0' cellspacing='0' id='paged-table' style='margin-top:5px;'>
	<thead>
	<tr>
		<th>ID</th>
		<th>Name</th>
	</tr>
	</thead>

	<tbody>
	<?php $i = 0; ?>
	<?php foreach ($grid_list as $item): ?>
		<tr class="<?php echo ($i % 2 == 0) ? "even" : "odd"; ?>">
			<td><?php echo $item->id; ?></td>
			<td><?php echo $item->name; ?></td>
			<!--<td> any function like edit, delete, etc </td>-->
		</tr>
		<?php $i++; ?>
	<?php endforeach; ?>
	</tbody>
</table>

<br/>

<?php echo $pager_links; ?>

<!-- End of Xajax pagination! -->