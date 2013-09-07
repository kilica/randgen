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

require_once RANDGEN_TRUST_PATH . '/class/AbstractEditAction.class.php';

/**
 * Randgen_LinkEditAction
**/
class Randgen_LinkEditAction extends Randgen_AbstractEditAction
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
     * @param   void
     *
     * @return  bool
    **/
    public function prepare()
    {
        $ret = parent::prepare();
        if($this->mObject->isNew()){

        }
     return $ret;
    }

    /**
     * executeViewInput
     *
     * @param   XCube_RenderTarget  &$render
     *
     * @return  void
    **/
    public function executeViewInput(/*** XCube_RenderTarget ***/ &$render)
    {
        $render->setTemplateName($this->mAsset->mDirname . '_link_edit.html');
        $render->setAttribute('actionForm', $this->mActionForm);
        $render->setAttribute('object', $this->mObject);
        $render->setAttribute('dirname', $this->mAsset->mDirname);
        $render->setAttribute('dataname', self::DATANAME);

        //set tag usage
        $render->setAttribute('tag_dirname', $this->mRoot->mContext->mModuleConfig['tag_dirname']);
        
  }

}
?>
