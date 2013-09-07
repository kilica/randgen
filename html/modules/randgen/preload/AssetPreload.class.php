<?php
/**
 * @file
 * @package randgen
 * @version $Id$
**/

if(!defined('XOOPS_ROOT_PATH'))
{
    exit;
}

require_once XOOPS_TRUST_PATH . '/modules/randgen/preload/AssetPreload.class.php';
Randgen_AssetPreloadBase::prepare(basename(dirname(dirname(__FILE__))));

?>
