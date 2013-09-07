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
 * Randgen_GeneratorDeleteAction
**/
class Randgen_GeneratorDeleteAction extends Randgen_AbstractDeleteAction
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
     * executeViewInput
     *
     * @param    XCube_RenderTarget    &$render
     *
     * @return    void
    **/
    public function executeViewInput(/*** XCube_RenderTarget ***/ &$render)
    {
        $render->setTemplateName($this->mAsset->mDirname . '_generator_delete.html');
        $render->setAttribute('actionForm', $this->mActionForm);
        $render->setAttribute('object', $this->mObject);
        $render->setAttribute('accessController', $this->mAccessController['main']);
        $render->setAttribute('xoops_breadcrumbs', $this->_getBreadcrumb($this->mObject));
    }
}

?>
