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

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';
require_once XOOPS_MODULE_PATH . '/legacy/class/Legacy_Validator.class.php';

/**
 * Randgen_GeneratorDeleteForm
**/
class Randgen_GeneratorDeleteForm extends XCube_ActionForm
{
    /**
     * getTokenName
     * 
     * @param   void
     * 
     * @return  string
    **/
    public function getTokenName()
    {
        return "module.randgen.GeneratorDeleteForm.TOKEN";
    }

    /**
     * prepare
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function prepare()
    {
        //
        // Set form properties
        //
        $this->mFormProperties['generator_id'] = new XCube_IntProperty('generator_id');
    
        //
        // Set field properties
        //
        $this->mFieldProperties['generator_id'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['generator_id']->setDependsByArray(array('required'));
        $this->mFieldProperties['generator_id']->addMessage('required', _MD_RANDGEN_ERROR_REQUIRED, _MD_RANDGEN_LANG_GENERATOR_ID);
    }

    /**
     * load
     * 
     * @param   XoopsSimpleObject  &$obj
     * 
     * @return  void
    **/
    public function load(/*** XoopsSimpleObject ***/ &$obj)
    {
        $this->set('generator_id', $obj->get('generator_id'));
    }

    /**
     * update
     * 
     * @param   XoopsSimpleObject  &$obj
     * 
     * @return  void
    **/
    public function update(/*** XoopsSimpleObject ***/ &$obj)
    {
        $obj->set('generator_id', $this->get('generator_id'));
    }
}

?>
