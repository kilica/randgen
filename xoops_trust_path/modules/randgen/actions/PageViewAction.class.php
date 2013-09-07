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
 * Randgen_PageViewAction
**/
class Randgen_PageViewAction extends Randgen_AbstractViewAction
{
    const DATANAME = 'page';


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
        $this->_setupAccessController('page');

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
        $render->setTemplateName($this->mAsset->mDirname . '_page_view.html');
        $render->setAttribute('object', $this->mObject);
        $render->setAttribute('dirname', $this->mAsset->mDirname);
        $render->setAttribute('dataname', self::DATANAME);
        $render->setAttribute('accessController', $this->mAccessController['main']);
    }
}

?>
