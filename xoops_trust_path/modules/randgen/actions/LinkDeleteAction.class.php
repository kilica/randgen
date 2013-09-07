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

require_once RANDGEN_TRUST_PATH . '/class/AbstractDeleteAction.class.php';

/**
 * Randgen_LinkDeleteAction
**/
class Randgen_LinkDeleteAction extends Randgen_AbstractDeleteAction
{
    const DATANAME = 'link';



    /**
     * hasPermission
     *
     * @param    void
     *
     * @return    bool
    **/
    public function hasPermission()
    {
        return $this->mRoot->mContext->mUser->isInRole('Site.RegisteredUser') ? true : false;
    }

    /**
     * prepare
     *
     * @param    void
     *
     * @return    bool
    **/
    public function prepare()
    {
        $ret = parent::prepare();

        return $ret;
    }

    /**
     * executeViewInput
     *
     * @param    XCube_RenderTarget    &$render
     *
     * @return    void
    **/
    public function executeViewInput(/*** XCube_RenderTarget ***/ &$render)
    {
        $render->setTemplateName($this->mAsset->mDirname . '_link_delete.html');
        $render->setAttribute('actionForm', $this->mActionForm);
        $render->setAttribute('object', $this->mObject);
    }
}

?>
