<div class="photonav"><a href="/gplusphotos/album/<?php echo $albumid; ?>"><?php echo $albumtitle; ?></a></div>
<br />
<div class="slideshow">
	<div class="photo-previous">
	<?php if ($previousphoto): ?>
		<a href="/gplusphotos/photo/<?php echo $albumid; ?>/<?php echo $previousphoto; ?>"><< Prevous</a>
	<?php else: ?>
		&nbsp;
	<?php endif; ?>
	</div>
	<div class="photo-count" id="slideshow_count"><?php echo $albumindex+1; ?>/<?php echo $albumcount; ?></div>
	<?php if ($nextphoto): ?>
		<div class="photo-next"><a href="/gplusphotos/photo/<?php echo $albumid; ?>/<?php echo $nextphoto; ?>">Next >></a></div>
	<?php endif; ?>
	<div class="slideshow-image">
		<a href="<?php echo $data['src']; ?>"><img src="<?php echo $data['src']; ?>" title="<?php echo $data['title']; ?>" class="photo-image" border="0"></a>
		<div class="content"><?php echo $data['description']; ?></div>
	</div>
</div>
