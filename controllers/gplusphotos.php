<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Gplusphotos extends Public_Controller {

    function index()
    {
		$this->load->helper('gplusphotos');
		$data = array();
		$url = "https://picasaweb.google.com/data/feed/api/user/" . $this->settings->google_id_setting . "?kind=album";
		$data_array = get_xml_array_for_url($url);
		if ($data_array) {
			$entries = $data_array['entry'];
			foreach($entries as $entry) {
				if ($entry['gphoto:numphotos'] && ($entry['gphoto:numphotos'] > 2)) {
					$data[] = array('title'=>$entry['title'],
							'albumid'=>$entry['gphoto:id'],
							'count'=>$entry['gphoto:numphotos'],
							'thumbnail'=>$entry['media:group']['media:thumbnail']['@attributes']['url']
					);
				}
			}
		}
        // Loads from modules/gplusphotos/views/albums.php
        $this->template
                ->set('data' , $data)
//				->append_css('module::gplusphotos.css')
				->title('Photo Albums')
                ->build('albums');
    }
	
	function album($albumid = '') {
		$this->load->helper('gplusphotos');
		$data = array();
		// Get Album Info
		$url = "https://picasaweb.google.com/data/feed/api/user/" . $this->settings->google_id_setting . "/albumid/" . $albumid;
		$data_array = get_xml_array_for_url($url);
		$title = "";
		if ($data_array) {
			$title = $data_array['title'];
			$entries = $data_array['entry'];
			$count = 0;
			foreach($entries as $entry) {
				$description = $entry['media:group']['media:description'];
				if (is_array($description)) {
					$description = "";
				}
				$count++;
				$data[] = array('title'=>$entry['title'],
						'photoid'=>$entry['gphoto:id'],
						'thumbnail'=>$entry['media:group']['media:thumbnail'][2]['@attributes']['url'],
						'src'=>$entry['content']['@attributes']['src'],
						'description'=>$description
				);
			}
		}
        // Loads from modules/gplusphotos/views/albums.php
        $this->template
                ->set('albumid', $albumid)
				->set('title', $title)
				->set('data', $data)
				->set('photoSize', $count)
//				->append_css('module::gplusphotos.css')
				->title('Photo Album - ' . $title)
                ->build('album');
		
	}

	function photo($albumid = '', $photoid = "") {
		$this->load->helper('gplusphotos');
		$data = array();
		// Get Album Info
		$title = "";
		$url = "https://picasaweb.google.com/data/feed/api/user/" . $this->settings->google_id_setting . "/albumid/" . $albumid;
		$data_array = get_xml_array_for_url($url);
		$next_photo = "";
		$previous_photo = "";
		$albumTitle = "";
		$count = 0;
		$myindex = 0;
		if ($data_array) {
			$albumTitle = $data_array['title'];
			$entries = $data_array['entry'];
			$album = array();
			foreach($entries as $entry) {
				if ($entry['gphoto:id'] == $photoid) {
					$myindex = $count;
					$title = $entry['title'];
					$description = $entry['media:group']['media:description'];
					if (is_array($description)) {
						$description = "";
					} else {
						$title = $description;
					}
					$data = array('title'=>$entry['title'],
						'photoid'=>$entry['gphoto:id'],
						'thumbnail'=>$entry['media:group']['media:thumbnail'][2]['@attributes']['url'],
						'src'=>$entry['content']['@attributes']['src'],
						'description'=>$description
					);
				}
				$album[] = $entry['gphoto:id'];
				$count++;
			}
			if ($myindex < ($count-1)) {
				$next_photo = $album[$myindex+1];
			}
			if ($myindex > 0) {
				$previous_photo = $album[$myindex-1];
			}
		}
        // Loads from modules/gplusphotos/views/albums.php
        $this->template
                ->set('albumid', $albumid)
				->set('albumtitle', $albumTitle)
				->set('albumcount', $count)
				->set('albumindex', $myindex)
				->set('photoid', $photoid)
				->set('data', $data)
				->set('nextphoto', $next_photo)
				->set('previousphoto', $previous_photo)
//				->append_css('module::gplusphotos.css')
				->title('Photo Album - ' . $title)
                ->build('photo');
		
	}
	
}