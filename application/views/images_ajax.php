<div class="row-fluid">
	<?php
	$i = 0;
	foreach ($images as $image) {
		$i++;
		?>
		<a href="/web/uploads/<?php echo $image['filename']; ?>">
			<img src="/web/script/timthumb.php?w=300&h=200&src=<?php echo urlencode('/web/uploads/'.$image['filename']); ?>"
				alt="<?php echo $image['date']; ?>" class="span4" />
		</a>
		<?php
		if(($i%3) == 0) echo '</div><div class="row-fluid">';
	}
	?>
</div>
