<div class="photonav"><a href="/gplusphotos/">Albums</a></div>
<h2><?php echo $title; ?></h2>
<div class="slideshow">
	<div class="photo-previous" id="slideshow_previous">&nbsp;</div>
	<div class="photo-count" id="slideshow_count">1/<?php echo $photoSize; ?></div>
	<?php if ($photoSize > 1): ?>
	<div class="photo-next" id="slideshow_next"><a onclick="showPhoto(1);">Next >></a></div>
	<?php endif; ?>
	<div class="slideshow-image" id="slideshow_image">
		<a href="/gplusphotos/photo/<?php echo $albumid; ?>/<?php echo $data[0]['photoid']; ?>"><img src="<?php echo $data[0]['src']; ?>" /></a>
		<div class="content"><?php echo $data[0]['description']; ?></div>
	</div>
</div>
<ul class="photo-list">
<?php foreach ($data as $entry): ?>
	<li class="photo-entry">
		<a href="/gplusphotos/photo/<?php echo $albumid; ?>/<?php echo $entry['photoid']; ?>"><div class="photo-thumb" style="background-image:url(<?php echo $entry['thumbnail']; ?>)"></div></a>
	</li>
<?php endforeach; ?>
</ul>
<script type="text/javascript">
	var albumjson = JSON.parse('<?php echo addslashes(json_encode($data)); ?>');
	function showPhoto(index) {
		document.getElementById("slideshow_image").innerHTML = "<a href=\"/gplusphotos/photo/<?php echo $albumid; ?>/" + albumjson[index]['photoid'] + "\"><img src=\"" + albumjson[index]['src'] + "\" /></a><div class=\"content\">" + albumjson[index]['description'] + "</div>";
		if (index > 0) {
			document.getElementById("slideshow_previous").innerHTML = "<a onclick=\"showPhoto(" + (index-1) + ");\"><< Previous</a>";
		} else {
			document.getElementById("slideshow_previous").innerHTML = "&nbsp;";
		}
		if ((index+1) < <?php echo $photoSize; ?>) {
			document.getElementById("slideshow_next").innerHTML = "<a onclick=\"showPhoto(" + (index+1) + ");\">Next >></a>";
		} else {
			document.getElementById("slideshow_next").innerHTML = "&nbsp;";
		}
		document.getElementById("slideshow_count").innerHTML = (index+1) + "/<?php echo $photoSize; ?>";
	}
</script>