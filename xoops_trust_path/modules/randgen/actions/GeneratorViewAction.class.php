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

require_once RANDGEN_TRUST_PATH . '/class/AbstractViewAction.class.php';

/**
 * Randgen_GeneratorViewAction
**/
class Randgen_GeneratorViewAction extends Randgen_AbstractViewAction
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
        return $this->mObject->get('category_id');
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
        return $this->mAccessController['main']->check($this->_getCatId(), Randgen_AbstractAccessController::VIEW, 'randgen');
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
        $this->_setupAccessController('generator');

        return $ret;
    }

    /**
     * executeViewSuccess
     *
     * @param    XCube_RenderTarget    &$render
     *
     * @return    void
    **/
    public function executeViewSuccess(/*** XCube_RenderTarget ***/ &$render)
    {
        $render->setTemplateName($this->mAsset->mDirname . '_generator_view.html');
        $render->setAttribute('object', $this->mObject);
        $render->setAttribute('itemArray', $this->mObject->getRandomItem());
        $render->setAttribute('dirname', $this->mAsset->mDirname);
        $render->setAttribute('dataname', self::DATANAME);
        $render->setAttribute('accessController', $this->mAccessController['main']);
        $render->setAttribute('isEditor', $this->_isEditor());
        $render->setAttribute('xoops_breadcrumbs', $this->_getBreadcrumb($this->mObject));
    }


    protected function _isEditor()
    {
        $catId = $this->mObject->get('category_id');

        //is Manager ?
        $check = $this->mAccessController['main']->check($catId, Randgen_AbstractAccessController::MANAGE, 'generator');
        if($check==true){
            return true;
        }
        //is old post and your post ?
        $check = $this->mAccessController['main']->check($catId, Randgen_AbstractAccessController::POST, 'generator');
        if($check==true && $this->mObject->get('uid')==Legacy_Utils::getUid()){
            return true;
        }
    }
}

?>
