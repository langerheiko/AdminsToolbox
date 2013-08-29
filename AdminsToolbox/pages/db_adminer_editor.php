<?php
require_once dirname( dirname( dirname( dirname( __FILE__ ) ) ) ). DIRECTORY_SEPARATOR . 'core.php';

function adminer_object() {
	class AdminerSoftware extends Adminer {
		function name() {
			return 'MantisBT - Editor';
		}

		function credentials() {
			return array(config_get('hostname'), config_get('db_username'), config_get('db_password'));
		}

		function database() {
			return config_get('database_name');
		}

		function login($login, $password) {
			return ($login == 'dbed' && $password == '20artur$13');
		}
	}

return new AdminerSoftware;
}

include 'db_editor-3.7.1.php';
//include 'adminer-3.7.1.php';
