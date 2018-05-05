<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * GOCRISTY CMS
 *
 * An open source content management system
 *
 * Copyright (c) 2018, Marcos Fermin.
 *
 *
 *
 * 
 *
 *
 *
 * @author	Marcos Fermin
 * @copyright   Copyright (c) 2018, Marcos Fermin.
 * @license	The MIT License (MIT)
 * @link	http://www.gocristy.com
 * @since	Version 0.0.1
 */
/*
 * For GOCRISTY CMS version config
 */
$config['GoCristy_version'] = '0.0.1'; /* For CMS Version */
$config['GoCristy_release'] = 'release'; /* For release or beta */

/*
 * For GOCRISTY CMS Credit
 * Please do not remove or change this credit
 */
$config['gocristy_credit'] = 'Powered by <a href="http://www.gocristy.com" target="_blank" style="color: gray;">GOCRISTY CMS</a>'; /* Please do not remove or change this credit */

/*
 * For GOCRISTY CMS check lastest version xml url
 * Defualt url http://www.gocristy.com/downloads/lastest_version.xml
 * Backup url https://gocristy.sourceforge.io/xml/lastest_version.xml
 */
$config['GoCristy_chkverxmlurl_main'] = 'http://www.gocristy.com/downloads/lastest_version.xml';
$config['GoCristy_chkverxmlurl_backup'] = 'https://gocristy.sourceforge.io/xml/lastest_version.xml';

/*
 * For GOCRISTY CMS upgrade server file path Ex. http://www.gocristy.com/downloads/upgrade/upgrade-to-1.1.4.zip
 * The upgrade file is "upgrade-to-1.1.4.zip" (Can't change the file upgrade name to other format. This format only)
 * Please set the server with path only http://www.gocristy.com/downloads/upgrade/
 */
$config['GoCristy_upgrade_server_1'] = 'https://jaist.dl.sourceforge.net/project/gocristy/upgrade/';
$config['GoCristy_upgrade_server_2'] = 'http://www.gocristy.com/downloads/upgrade/';

/*
 * For GOCRISTY CMS Official Website News RSS Feed URL on Backend Dashboard
 * Defualt Url http://www.gocristy.com/plugin/article/rss
 */
$config['GoCristy_backend_feed_url'] = 'http://www.gocristy.com/plugin/article/rss';
$config['GoCristy_backend_feed_backup_url'] = 'https://www.astian.org/plugin/article/rss';

/*
 * For GOCRISTY CMS plugin version checking xml url
 * Defualt url http://localhost/plugintest/plugin_list.xml
 * Backup url http://localhost/plugintest/plugin_list.xml
 */
$config['GoCristy_pluginxmlurl_main'] = 'http://www.gocristy.com/downloads/plugins/plugin_list.xml';
$config['GoCristy_pluginxmlurl_backup'] = 'https://gocristy-plugin.sourceforge.io/plugin_list.xml';

/*
 * For GOCRISTY CMS plugin install server file path Ex. http://localhost/plugintest/install/shop_install_1.0.6.zip
 * The upgrade file is "shop_install_1.0.6.zip" (Can't change the file install name to other format. This format only)
 * Please set the server with path only http://localhost/plugintest/install/
 */
$config['GoCristy_plugin_install_server_1'] = 'https://jaist.dl.sourceforge.net/project/gocristy-plugin/install/';
$config['GoCristy_plugin_install_server_2'] = 'http://www.gocristy.com/downloads/plugins/install/';

/*
 * For GOCRISTY CMS plugin upgrade server file path Ex. http://localhost/plugintest/upgrade/shop_upgrade_1.0.6.zip
 * The upgrade file is "shop_upgrade_1.0.6.zip" (Can't change the file upgrade name to other format. This format only)
 * Please set the server with path only http://localhost/plugintest/upgrade/
 */
$config['GoCristy_plugin_upgrade_server_1'] = 'https://jaist.dl.sourceforge.net/project/gocristy-plugin/upgrade/';
$config['GoCristy_plugin_upgrade_server_2'] = 'http://www.gocristy.com/downloads/plugins/upgrade/';
