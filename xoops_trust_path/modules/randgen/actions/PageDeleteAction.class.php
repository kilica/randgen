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
 * Randgen_PageDeleteAction
**/
class Randgen_PageDeleteAction extends Randgen_AbstractDeleteAction
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
     * executeViewInput
     *
     * @param    XCube_RenderTarget    &$render
     *
     * @return    void
    **/
    public function executeViewInput(/*** XCube_RenderTarget ***/ &$render)
    {
        $render->setTemplateName($this->mAsset->mDirname . '_page_delete.html');
        $render->setAttribute('actionForm', $this->mActionForm);
        $render->setAttribute('object', $this->mObject);
        $render->setAttribute('accessController', $this->mAccessController['main']);
    }
}

?>
