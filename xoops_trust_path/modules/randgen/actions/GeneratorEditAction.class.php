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
 * Randgen_GeneratorEditAction
**/
class Randgen_GeneratorEditAction extends Randgen_AbstractEditAction
{
    const DATANAME = 'generator';


    /**
     * _getCatId
     *
     * @param    void
     *
     * @return    int
    **/
    protected function _getCatId()
    {
        return ($this->mObject->get('category_id')) ? $this->mObject->get('category_id') : intval($this->mRoot->mContext->mRequest->getRequest('category_id'));
    }

    /**
     * hasPermission
     *
     * @param    void
     *
     * @return    bool
    **/
    public function hasPermission()
    {
        $catId = $this->_getCatId();

        if($catId>0){
            //is Manager ?
            $check = $this->mAccessController['main']->check($catId, Randgen_AbstractAccessController::MANAGE, 'generator');
            if($check==true){
                return true;
            }
            //is new post and has post permission ?
            $check = $this->mAccessController['main']->check($catId, Randgen_AbstractAccessController::POST, 'generator');
            if($check==true && $this->mObject->isNew()){
                return true;
            }
            //is old post and your post ?
            if($check==true && ! $this->mObject->isNew() && $this->mObject->get('uid')==Legacy_Utils::getUid() && $this->mObject->get('uid')>0){
                return true;
            }
        }
        else{
            $idList = array();
            $idList = $this->mAccessController['main']->getPermittedIdList(Randgen_AbstractAccessController::POST, $this->_getCatId());
            if(count($idList)>0 || $this->mAccessController['main']->getAccessControllerType()=='none'){
                return true;
            }
        }

        return false;
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
            if($this->mRoot->mContext->mUser->isInRole('Site.RegisteredUser')){
                $this->mObject->set('uid', $this->mRoot->mContext->mXoopsUser->get('uid'));
            }
            $this->mObject->set('category_id', $this->_getCatId());
        }
        $this->_setupAccessController('generator');
        $this->mObject->loadTag();
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
        $render->setTemplateName($this->mAsset->mDirname . '_generator_edit.html');
        $render->setAttribute('actionForm', $this->mActionForm);
        $render->setAttribute('object', $this->mObject);
        $render->setAttribute('dirname', $this->mAsset->mDirname);
        $render->setAttribute('dataname', self::DATANAME);

        //set tag usage
        $render->setAttribute('tag_dirname', $this->mRoot->mContext->mModuleConfig['tag_dirname']);
        
        $render->setAttribute('accessController',$this->mAccessController['main']);
        $render->setAttribute('xoops_breadcrumbs', $this->_getBreadcrumb($this->mObject));
    }
}
?>
