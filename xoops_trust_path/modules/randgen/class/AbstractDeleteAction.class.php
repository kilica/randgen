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
 * Randgen_AbstractDeleteAction
**/
abstract class Randgen_AbstractDeleteAction extends Randgen_AbstractEditAction
{
    /**
     * _isEnableCreate
     * 
     * @param   void
     * 
     * @return  bool
    **/
    protected function _isEnableCreate()
    {
        return false;
    }

    /**
     * _getActionTitle
     * 
     * @param   void
     * 
     * @return  string
    **/
    protected function _getActionTitle()
    {
        return _DELETE;
    }

    /**
     * _getActionName
     * 
     * @param   void
     * 
     * @return  string
    **/
    protected function _getActionName()
    {
        return 'delete';
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
        return parent::prepare() && is_object($this->mObject);
    }

    /**
     * _doExecute
     * 
     * @param   void
     * 
     * @return  Enum
    **/
    protected function _doExecute()
    {
        if($this->mObjectHandler->delete($this->mObject))
        {
            return RANDGEN_FRAME_VIEW_SUCCESS;
        }
    
        return RANDGEN_FRAME_VIEW_ERROR;
    }

    /**
     * executeViewSuccess
     * 
     * @param   XCube_RenderTarget  &$render
     * 
     * @return  void
    **/
    public function executeViewSuccess(/*** XCube_RenderTarget ***/ &$render)
    {
        $this->mRoot->mController->executeForward($this->_getNextUri($this->_getConst('DATANAME'), 'list'));
    }
}

?>
