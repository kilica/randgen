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

require_once RANDGEN_TRUST_PATH . '/actions/GeneratorEditAction.class.php';

/**
 * Randgen_GeneratorEditAction
**/
class Randgen_GeneratorCopyAction extends Randgen_GeneratorEditAction
{
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
            return $this->mAccessController['main']->check($catId, Randgen_AbstractAccessController::POST, 'generator');
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
     * _setupObject
     *
     * @param   void
     *
     * @return  void
     **/
    protected function _setupObject()
    {
        $this->mObjectHandler =& $this->_getHandler();

        $original = $this->mObjectHandler->get($this->_getId());
        if($original instanceof Randgen_GeneratorObject){
            $this->mObject = $this->mObjectHandler->create();
            $this->mObject->set('title', $original->get('title'));
            $this->mObject->set('category_id', $original->get('category_id'));
            $this->mObject->set('description', $original->get('description'));
            $this->mObject->set('items', $original->get('items'));
        }
        else{
            die('Invalid generator_id');
        }
    }
}
?>
