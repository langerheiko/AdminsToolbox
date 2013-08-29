<?php
require_once dirname( dirname( dirname( dirname( __FILE__ ) ) ) ). DIRECTORY_SEPARATOR . 'core.php';

function adminer_object() {
	class AdminerSoftware extends Adminer {
		function name() {
			return 'MantisBT - DB-ADMIN';
		}

		function credentials() {
			return array(config_get('hostname'), config_get('db_username'), config_get('db_password'));
		}

		function database() {
			return config_get('database_name');
		}

		function login($login, $password) {
			return ($login == 'dbsa' && $password == '20achim#11');
		}
	}

return new AdminerSoftware;
}

//include 'editor-3.7.1.php';
include 'db_adminer-3.7.1.php';
