<h2>Photo Albums</h2>
<ul class="album-list">
<?php foreach ($data as $entry): ?>
	<li class="album-entry">
		<a href="/gplusphotos/album/<?php echo $entry['albumid']; ?>">
			<div class="album-image" style="background-image:url(<?php echo $entry['thumbnail']; ?>)">
				<div class="titlebox"><h4><?php echo $entry['title']; ?></h4></div>
				<div class="img-count">Images: <?php echo $entry['count']; ?></div>
			</div>
		</a>
	</li>
<?php endforeach; ?>
</ul>