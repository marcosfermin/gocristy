<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * For elFinder Libraries
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

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'elFinderConnector.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'elFinder.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'elFinderVolumeDriver.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'elFinderVolumeLocalFileSystem.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'elFinderVolumeFTP.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'elFinderVolumeDropbox.class.php';
//include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'elFinderVolumeBox.class.php'; /* Support PHP >= 5.4 */
//include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'elFinderVolumeGoogleDrive.class.php'; /* Support PHP >= 5.4 */
//include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'elFinderVolumeOneDrive.class.php'; /* Support PHP >= 5.4 */
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'elFinderVolumeGroup.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'elFinderVolumeTrash.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'libs/GdBmp.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'elFinderPlugin.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'plugins/AutoResize/plugin.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'plugins/AutoRotate/plugin.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'plugins/Normalizer/plugin.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'plugins/Sanitizer/plugin.php';

class Elfinder_lib {
    public function run($opts) {
        $connector = new elFinderConnector(new elFinder($opts));
        return $connector->run();
    }

}