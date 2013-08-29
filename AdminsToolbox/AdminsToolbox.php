<?php

Class AdminsToolboxPlugin extends MantisPlugin {
	//cmv = current my view
	private $cmv_pages;
	private $current_page;
	
	
	function register() {
		$this->name		= 'Administrator\'s Toolbox';
		$this->description 	= 'Contains some tools that should make Admins life easier.<br />- Displays an input field and button on "manage_user_edit_page" to change a users password directly.<br />- Displays access level dropdown on "manage_proj_edit_page" in manage accounts list.';
		//$this->page		= plugin_page( 'manage_tools' );

		$this->version		= '0.1';
		$this->requires		= array('MantisCore' => '1.2.14');
		
		$this->author		= 'eCola GmbH, Heiko Schneider-Lange';
		$this->contact		= 'hsl@ecola.com';
		$this->url		= 'http://www.lebensmittel.de';
	}

	function config() {
		return array( 
			'show_menu_item' => 1
			,'show_db_adminer' => 0
			,'show_db_editor' => 1
		);
	}
	
	function init() {
		$this->cmv_pages = array(
			'manage_user_edit_page.php'
			,'manage_proj_edit_page.php'
		);
		$this->current_page = basename($_SERVER['PHP_SELF']);
	}
	
	function hooks() {
		return array(
				'EVENT_LAYOUT_CONTENT_BEGIN' => 'my_begin',
				'EVENT_LAYOUT_CONTENT_END' => 'my_end',
				'EVENT_LAYOUT_RESOURCES' => 'my_resources',
				'EVENT_MENU_MANAGE'	=> 'my_admins_toolbox_menu',
			);
	}
	
	function my_admins_toolbox_menu( ) {
		if( plugin_config_get( 'show_menu_item', 0 ) == 1 ) {
			$ret = array( '<a href="' . plugin_page( 'manage_tools' ) . '">AdminsToolbox</a>', );
		} else { 
			$ret = array();
		}
		return $ret;
	}

	function my_begin($p_event) {
		if (!in_array($this->current_page, $this->cmv_pages)) return '';
		include ('pages/plugin_myview_'.$this->current_page);
		return $myView;
	}

	function my_end($p_event) {
		if (!in_array($this->current_page, $this->cmv_pages)) return '';
		return '';
	}

	function my_resources($p_event) {
		if (!in_array($this->current_page, $this->cmv_pages)) return '';
		return '<script src="plugins/AdminsToolbox/resources/jquery-1.9.1.min.js"></script>';
	}
}
