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

require_once RANDGEN_TRUST_PATH . '/class/AbstractListAction.class.php';

/**
 * Randgen_LinkListAction
**/
class Randgen_LinkListAction extends Randgen_AbstractListAction
{
    const DATANAME = 'link';


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
     * executeViewIndex
     *
     * @param    XCube_RenderTarget    &$render
     *
     * @return    void
    **/
    public function executeViewIndex(/*** XCube_RenderTarget ***/ &$render)
    {
        $render->setTemplateName($this->mAsset->mDirname . '_link_list.html');
        $render->setAttribute('objects', $this->mObjects);
        $render->setAttribute('dirname', $this->mAsset->mDirname);
        $render->setAttribute('dataname', self::DATANAME);
        $render->setAttribute('pageNavi', $this->mFilter->mNavi);
    }
}

?>
