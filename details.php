<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_GPlusPhotos extends Module {

	public $version = '1.0.1';
	const MIN_PHP_VERSION = '5.3.0';

	/**
	 * Module information
	 *
	 * @access public
	 * @return void
	 */
	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Google+ Photos'
			),
			'description' => array(
				'en' => 'Display Google+ Photos on your website.'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'content'
		);
	}

	/**
	 * Install module
	 *
	 * @access public
	 * @return bool
	 */
	public function install()
	{
		$gpulsphotos_setting = array(
			'slug' => 'google_id_setting',
			'title' => 'Google ID',
			'description' => 'Enter your Google ID',
			'`default`' => '',
			'`value`' => '',
			'type' => 'text',
			'`options`' => '',
			'is_required' => 1,
			'is_gui' => 1,
			'module' => 'gpulsphotos'
		);
		
		if (!$this->db->insert('settings', $gpulsphotos_setting)) {
			return FALSE;
		}
		return true;
	}

	/**
	 * Uninstall module
	 *
	 * @access public
	 * @return bool
	 */
	public function uninstall()
	{
		$this->db->delete('settings', array('module' => 'gpulsphotos'));
		return TRUE;
	}
	
	public function upgrade($old_version)
    {
        // Your Upgrade Logic
        return true;
    }

}

// EOF