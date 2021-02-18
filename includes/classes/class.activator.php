<?php

class FreecalcActivator{
	private static $table_slug = FREECALC_TABLE;
	public static function activate()
	{
		global $wpdb;
		$table_name = $wpdb->prefix . self::$table_slug;
		$table_setting = $table_name.'_settings';

		if ( $wpdb->get_var( "SHOW TABLES LIKE '" . $table_name . "'" ) !=  $table_name ) {

			/* Таблица калькуляторов */
			$sql = "CREATE TABLE IF NOT EXISTS `$table_name`
			(
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`calcname` VARCHAR(100) NOT NULL,
				`content` LONGTEXT NOT NULL,
				`detailing` LONGTEXT NOT NULL,
				`settings` LONGTEXT NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=$wpdb->charset AUTO_INCREMENT=1;";

			/* Таблица настроек */
			$sql2 = "CREATE TABLE IF NOT EXISTS `$table_setting`
			(
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`settings` LONGTEXT NOT NULL,
				`promocode` LONGTEXT NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=$wpdb->charset AUTO_INCREMENT=1;";

			$wpdb->query( $sql );
			$wpdb->query( $sql2 );

		}
	}
}
