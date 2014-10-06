<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Gplusphotos Plugin
 *
 * Create lists of albums
 * 
 * @author		Josh Ellison
 */
class Plugin_Gplusphotos extends Plugin
{
	/**
	 * Gplusphotos Albums
	 *
	 * Creates a list of albums
	 *
	 * Usage:
	 * {{ gplusphotos:albums }}
	 *
	 * @param	array
	 * @return	array
	 */
	public function albums()
	{
/*
		$this->load->helper('gplusphotos');
		$data = array();
		$url = "https://picasaweb.google.com/data/feed/api/user/" . $this->settings->google_id_setting . "?kind=album";
		$data_array = get_xml_array_for_url($url);
		if ($data_array) {
			$entries = $data_array['entry'];
			foreach($entries as $entry) {
				if ($entry['gphoto:numphotos'] && ($entry['gphoto:numphotos'] > 1)) {
					$data[] = array('title'=>$entry['title'],
							'albumid'=>$entry['gphoto:id'],
							'count'=>$entry['gphoto:numphotos'],
							'thumbnail'=>$entry['media:group']['media:thumbnail']['@attributes']['url']
					);
				}
			}
		}
*/
        // Loads from modules/gplusphotos/views/albums.php
		return $this->module_view(
			'gplusphotos', // Module name
			'home', // View filename
			TRUE // Return?
		);

	}

}
/* End of file plugin.php */