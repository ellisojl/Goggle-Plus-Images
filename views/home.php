<?php
$this->load->helper('gplusphotos');
$data = array();
$url = "https://picasaweb.google.com/data/feed/api/user/" . $this->settings->google_id_setting . "?kind=album";
$data_array = get_xml_array_for_url($url);
$limit = 12;
if ($data_array) {
	$entries = $data_array['entry'];
	$count = 0;
	foreach($entries as $entry) {
		if (($count < $limit) && $entry['gphoto:numphotos'] && ($entry['gphoto:numphotos'] > 2)) {
			$data[] = array('title'=>$entry['title'],
					'albumid'=>$entry['gphoto:id'],
					'count'=>$entry['gphoto:numphotos'],
					'thumbnail'=>$entry['media:group']['media:thumbnail']['@attributes']['url']
			);
			$count++;
		}
	}
}
?>
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
<a href="/gplusphotos">More Photos</a>