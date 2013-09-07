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

interface Randgen_AuthType
{
    const VIEW = "view";
    const POST = "post";
    const MANAGE = "manage";
}

?>
