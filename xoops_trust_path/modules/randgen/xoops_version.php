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

if(!defined('RANDGEN_TRUST_PATH'))
{
    define('RANDGEN_TRUST_PATH',XOOPS_TRUST_PATH . '/modules/randgen');
}

require_once RANDGEN_TRUST_PATH . '/class/RandgenUtils.class.php';

//
// Define a basic manifesto.
//
$modversion['name'] = $myDirName;
$modversion['version'] = 0.1;
$modversion['description'] = _MI_RANDGEN_DESC_RANDGEN;
$modversion['author'] = _MI_RANDGEN_LANG_AUTHOR;
$modversion['credits'] = _MI_RANDGEN_LANG_CREDITS;
$modversion['help'] = 'help.html';
$modversion['license'] = 'GPL';
$modversion['official'] = 0;
$modversion['image'] = 'images/module_icon.png';
$modversion['dirname'] = $myDirName;
$modversion['trust_dirname'] = 'randgen';

$modversion['cube_style'] = true;
$modversion['legacy_installer'] = array(
    'installer'   => array(
        'class'     => 'Installer',
        'namespace' => 'Randgen',
        'filepath'  => RANDGEN_TRUST_PATH . '/admin/class/installer/RandgenInstaller.class.php'
    ),
    'uninstaller' => array(
        'class'     => 'Uninstaller',
        'namespace' => 'Randgen',
        'filepath'  => RANDGEN_TRUST_PATH . '/admin/class/installer/RandgenUninstaller.class.php'
    ),
    'updater' => array(
        'class'     => 'Updater',
        'namespace' => 'Randgen',
        'filepath'  => RANDGEN_TRUST_PATH . '/admin/class/installer/RandgenUpdater.class.php'
    )
);
$modversion['disable_legacy_2nd_installer'] = false;

$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'] = array(
//    '{prefix}_{dirname}_xxxx',
##[cubson:tables]
    '{prefix}_{dirname}_generator',
    '{prefix}_{dirname}_page',
    '{prefix}_{dirname}_link',

##[/cubson:tables]
);

//
// Templates. You must never change [cubson] chunk to get the help of cubson.
//
$modversion['templates'] = array(
/*
    array(
        'file'        => '{dirname}_xxx.html',
        'description' => _MI_RANDGEN_TPL_XXX
    ),
*/
##[cubson:templates]
        array('file' => '{dirname}_generator_delete.html','description' => _MI_RANDGEN_TPL_GENERATOR_DELETE),
        array('file' => '{dirname}_generator_edit.html','description' => _MI_RANDGEN_TPL_GENERATOR_EDIT),
        array('file' => '{dirname}_generator_list.html','description' => _MI_RANDGEN_TPL_GENERATOR_LIST),
        array('file' => '{dirname}_generator_view.html','description' => _MI_RANDGEN_TPL_GENERATOR_VIEW),
        array('file' => '{dirname}_page_delete.html','description' => _MI_RANDGEN_TPL_PAGE_DELETE),
        array('file' => '{dirname}_page_edit.html','description' => _MI_RANDGEN_TPL_PAGE_EDIT),
        array('file' => '{dirname}_page_list.html','description' => _MI_RANDGEN_TPL_PAGE_LIST),
        array('file' => '{dirname}_page_view.html','description' => _MI_RANDGEN_TPL_PAGE_VIEW),
        array('file' => '{dirname}_link_delete.html','description' => _MI_RANDGEN_TPL_LINK_DELETE),
        array('file' => '{dirname}_link_edit.html','description' => _MI_RANDGEN_TPL_LINK_EDIT),
        array('file' => '{dirname}_link_list.html','description' => _MI_RANDGEN_TPL_LINK_LIST),
        array('file' => '{dirname}_link_view.html','description' => _MI_RANDGEN_TPL_LINK_VIEW),

##[/cubson:templates]
);

//
// Admin panel setting
//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php?action=Index';
$modversion['adminmenu'] = array(
/*
    array(
        'title'    => _MI_RANDGEN_LANG_XXXX,
        'link'     => 'admin/index.php?action=xxx',
        'keywords' => _MI_RANDGEN_KEYWORD_XXX,
        'show'     => true,
        'absolute' => false
    ),
*/
##[cubson:adminmenu]
##[/cubson:adminmenu]
);

//
// Public side control setting
//
$modversion['hasMain'] = 1;
$modversion['hasSearch'] = 0;
$modversion['sub'] = array(
/*
    array(
        'name' => _MI_RANDGEN_LANG_SUB_XXX,
        'url'  => 'index.php?action=XXX'
    ),
*/
##[cubson:submenu]
##[/cubson:submenu]
);

//
// Config setting
//
$modversion['config'] = array(
/*
    array(
        'name'          => 'xxxx',
        'title'         => '_MI_RANDGEN_TITLE_XXXX',
        'description'   => '_MI_RANDGEN_DESC_XXXX',
        'formtype'      => 'xxxx',
        'valuetype'     => 'xxx',
        'options'       => array(xxx => xxx,xxx => xxx),
        'default'       => 0
    ),
*/

    array(
        'name'            => 'access_controller',
        'title'         => '_MI_RANDGEN_LANG_ACCESS_CONTROLLER',
        'description'    => '_MI_RANDGEN_DESC_ACCESS_CONTROLLER',
        'formtype'        => 'server_module',
        'valuetype'     => 'text',
        'default'        => '',
        'options'        => array('none', 'cat', 'group')
    ),
    array(
        'name'            => 'auth_type' ,
        'title'         => "_MI_RANDGEN_LANG_AUTH_TYPE" ,
        'description'    => "_MI_RANDGEN_DESC_AUTH_TYPE" ,
        'formtype'        => 'textbox' ,
        'valuetype'     => 'text' ,
        'default'        => 'viewer|poster|manager' ,
        'options'        => array()
    ) ,

    array(
        'name'          => 'use_activity' ,
        'title'         => '_MI_RANDGEN_LANG_USE_ACTIVITY' ,
        'description'   => '_MI_RANDGEN_DESC_USE_ACTIVITY' ,
        'formtype'      => 'yesno',
        'valuetype'     => 'int',
        'default'       => 0,
        'options'       => array()
    ) ,
                    
    array(
        'name'          => 'tag_dirname' ,
        'title'         => '_MI_RANDGEN_LANG_TAG_DIRNAME' ,
        'description'   => '_MI_RANDGEN_DESC_TAG_DIRNAME' ,
        'formtype'      => 'server_module',
        'valuetype'     => 'text',
        'default'       => '',
        'options'       => array('none','tag')
    ) ,

    array(
        'name'          => 'introduction',
        'title'         => '_MI_RANDGEN_LANG_INTRODUCTION',
        'description'   => '_MI_RANDGEN_DESC_INTRODUCTION',
        'formtype'      => 'textarea',
        'valuetype'     => 'text',
        'default'       => '',
    ),

    array(
        'name'          => 'css_file' ,
        'title'         => "_MI_RANDGEN_LANG_CSS_FILE" ,
        'description'   => "_MI_RANDGEN_DESC_CSS_FILE" ,
        'formtype'      => 'textbox' ,
        'valuetype'     => 'text' ,
        'default'       => '/modules/'.$myDirName.'/style.css',
        'options'       => array()
    ) ,
##[cubson:config]
##[/cubson:config]
);

//
// Block setting
//
$modversion['blocks'] = array(
/*
    x => array(
        'func_num'          => x,
        'file'              => 'xxxBlock.class.php',
        'class'             => 'xxx',
        'name'              => _MI_RANDGEN_BLOCK_NAME_xxx,
        'description'       => _MI_RANDGEN_BLOCK_DESC_xxx,
        'options'           => '',
        'template'          => '{dirname}_block_xxx.html',
        'show_all_module'   => true,
        'visible_any'       => true
    ),
*/
##[cubson:block]
##[/cubson:block]
);

?>
