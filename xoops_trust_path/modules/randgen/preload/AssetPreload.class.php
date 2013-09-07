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
require_once RANDGEN_TRUST_PATH . '/class/Enum.class.php';
/**
 * Randgen_AssetPreloadBase
**/
class Randgen_AssetPreloadBase extends XCube_ActionFilter
{
    public $mDirname = null;

    /**
     * prepare
     *
     * @param   string  $dirname
     *
     * @return  void
    **/
    public static function prepare(/*** string ***/ $dirname)
    {
        static $setupCompleted = false;
        if(!$setupCompleted)
        {
            $setupCompleted = self::_setup($dirname);
        }
    }

    /**
     * _setup
     *
     * @param   void
     *
     * @return  bool
    **/
    public static function _setup(/*** string ***/ $dirname)
    {
        $root =& XCube_Root::getSingleton();
        $instance = new self($root->mController);
        $instance->mDirname = $dirname;
        $root->mController->addActionFilter($instance);
        return true;
    }

    /**
     * preBlockFilter
     *
     * @param   void
     *
     * @return  void
    **/
    public function preBlockFilter()
    {
        $file = RANDGEN_TRUST_PATH . '/class/callback/DelegateFunctions.class.php';
        $this->mRoot->mDelegateManager->add('Module.randgen.Global.Event.GetAssetManager','Randgen_AssetPreloadBase::getManager');
        $this->mRoot->mDelegateManager->add('Legacy_Utils.CreateModule','Randgen_AssetPreloadBase::getModule');
        $this->mRoot->mDelegateManager->add('Legacy_Utils.CreateBlockProcedure','Randgen_AssetPreloadBase::getBlock');
        $this->mRoot->mDelegateManager->add('Module.'.$this->mDirname.'.Global.Event.GetNormalUri','Randgen_DelegateFunctions::getNormalUri', $file);
        $this->mRoot->mDelegateManager->add('Module.'.$this->mDirname.'.Global.Event.GetBreadcrumbs','Randgen_DelegateFunctions::getBreadcrumbs', $file);

        $this->mRoot->mDelegateManager->add('Legacy_CategoryClient.GetClientList','Randgen_CatClientDelegate::getClientList', RANDGEN_TRUST_PATH.'/class/callback/AccessClient.class.php');
        $this->mRoot->mDelegateManager->add('Legacy_CategoryClient.'.$this->mDirname.'.GetClientData','Randgen_CatClientDelegate::getClientData', RANDGEN_TRUST_PATH.'/class/callback/AccessClient.class.php');
        //Group Client
        $this->mRoot->mDelegateManager->add('Legacy_GroupClient.GetClientList','Randgen_GroupClientDelegate::getClientList', RANDGEN_TRUST_PATH.'/class/callback/AccessClient.class.php');
        $this->mRoot->mDelegateManager->add('Legacy_GroupClient.'.$this->mDirname.'.GetClientData','Randgen_GroupClientDelegate::getClientData', RANDGEN_TRUST_PATH.'/class/callback/AccessClient.class.php');
        $this->mRoot->mDelegateManager->add('Legacy_GroupClient.GetActionList','Randgen_GroupClientDelegate::getActionList', RANDGEN_TRUST_PATH.'/class/callback/AccessClient.class.php');
        $this->mRoot->mDelegateManager->add('Legacy_ActivityClient.GetClientList','Randgen_ActivityClientDelegate::getClientList', RANDGEN_TRUST_PATH.'/class/callback/ActivityClient.class.php');
        $this->mRoot->mDelegateManager->add('Legacy_ActivityClient.'.$this->mDirname.'.GetClientData','Randgen_ActivityClientDelegate::getClientData', RANDGEN_TRUST_PATH.'/class/callback/ActivityClient.class.php');
        $this->mRoot->mDelegateManager->add('Legacy_ActivityClient.'.$this->mDirname.'.GetClientFeed','Randgen_ActivityClientDelegate::getClientFeed', RANDGEN_TRUST_PATH.'/class/callback/ActivityClient.class.php');
        $this->mRoot->mDelegateManager->add('Legacy_TagClient.GetClientList','Randgen_TagClientDelegate::getClientList', RANDGEN_TRUST_PATH.'/class/callback/TagClient.class.php');
        $this->mRoot->mDelegateManager->add('Legacy_TagClient.'.$this->mDirname.'.GetClientData','Randgen_TagClientDelegate::getClientData', RANDGEN_TRUST_PATH.'/class/callback/TagClient.class.php');
        $this->mRoot->mDelegateManager->add('Legacy_ImageClient.GetClientList','Randgen_ImageClientDelegate::getClientList', RANDGEN_TRUST_PATH.'/class/callback/ImageClient.class.php');  }

    /**
     * getManager
     *
     * @param   Randgen_AssetManager  &$obj
     * @param   string  $dirname
     *
     * @return  void
    **/
    public static function getManager(/*** Randgen_AssetManager ***/ &$obj,/*** string ***/ $dirname)
    {
        require_once RANDGEN_TRUST_PATH . '/class/AssetManager.class.php';
        $obj = Randgen_AssetManager::getInstance($dirname);
    }

    /**
     * getModule
     *
     * @param   Legacy_AbstractModule  &$obj
     * @param   XoopsModule  $module
     *
     * @return  void
    **/
    public static function getModule(/*** Legacy_AbstractModule ***/ &$obj,/*** XoopsModule ***/ $module)
    {
        if($module->getInfo('trust_dirname') == 'randgen')
        {
            require_once RANDGEN_TRUST_PATH . '/class/Module.class.php';
            $obj = new Randgen_Module($module);
        }
    }

    /**
     * getBlock
     *
     * @param   Legacy_AbstractBlockProcedure  &$obj
     * @param   XoopsBlock  $block
     *
     * @return  void
    **/
    public static function getBlock(/*** Legacy_AbstractBlockProcedure ***/ &$obj,/*** XoopsBlock ***/ $block)
    {
        $moduleHandler =& Randgen_Utils::getXoopsHandler('module');
        $module =& $moduleHandler->get($block->get('mid'));
        if(is_object($module) && $module->getInfo('trust_dirname') == 'randgen')
        {
            require_once RANDGEN_TRUST_PATH . '/blocks/' . $block->get('func_file');
            $className = 'Randgen_' . substr($block->get('show_func'), 4);
            $obj = new $className($block);
        }
    }
}

?>
