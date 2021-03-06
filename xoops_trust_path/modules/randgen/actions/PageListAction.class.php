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
 * Randgen_PageListAction
**/
class Randgen_PageListAction extends Randgen_AbstractListAction
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
        return intval($this->mRoot->mContext->mRequest->getRequest('category_id'));
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
        if($this->_getCatId() > 0){
            return $this->mAccessController['main']->check($this->_getCatId(), Randgen_AbstractAccessController::VIEW, 'randgen');
        }
        return true;
    }
    /**
     * getDefaultView
     *
     * @param    void
     *
     * @return    Enum
    **/
    public function getDefaultView()
    {
        $this->mFilter =& $this->_getFilterForm();
        $this->mFilter->fetch();

        $handler =& $this->_getHandler();
        $criteria=$this->mFilter->getCriteria();

        $tree = array();
        if(! $this->_getCatId()){
            $catCriteria = new CriteriaCompo();

            //get permitted categories to show
            $idList = $this->mAccessController['main']->getPermittedIdList(Randgen_AbstractAccessController::VIEW, $this->_getCatId());
            if(count($idList)>0 && $this->mAccessController['main']->getAccessControllerType()!='none'){
                $catCriteria->add(new Criteria('category_id', $idList, 'IN'));
                $criteria->add($catCriteria);
            }
        }
        $this->mObjects = $handler->getObjects($criteria);

        return RANDGEN_FRAME_VIEW_INDEX;
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
     * executeViewIndex
     *
     * @param    XCube_RenderTarget    &$render
     *
     * @return    void
    **/
    public function executeViewIndex(/*** XCube_RenderTarget ***/ &$render)
    {
        $render->setTemplateName($this->mAsset->mDirname . '_page_list.html');
        $render->setAttribute('objects', $this->mObjects);
        $render->setAttribute('dirname', $this->mAsset->mDirname);
        $render->setAttribute('dataname', self::DATANAME);
        $render->setAttribute('pageNavi', $this->mFilter->mNavi);
        $render->setAttribute('accessController', $this->mAccessController['main']);
    }
}

?>
