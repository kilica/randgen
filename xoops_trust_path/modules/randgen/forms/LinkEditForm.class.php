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
 * Randgen_LinkEditForm
**/
class Randgen_LinkEditForm extends XCube_ActionForm
{
    /**
     * getTokenName
     *
     * @param    void
     *
     * @return    string
    **/
    public function getTokenName()
    {
        return "module.randgen.LinkEditForm.TOKEN";
    }

    /**
     * prepare
     *
     * @param    void
     *
     * @return    void
    **/
    public function prepare()
    {
        //
        // Set form properties
        //
        $this->mFormProperties['link_id'] = new XCube_IntProperty('link_id');
        $this->mFormProperties['title'] = new XCube_StringProperty('title');
        $this->mFormProperties['page_id'] = new XCube_IntProperty('page_id');
        $this->mFormProperties['generator_id'] = new XCube_IntProperty('generator_id');
        $this->mFormProperties['weight'] = new XCube_IntProperty('weight');


        //
        // Set field properties
        //
       $this->mFieldProperties['link_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['link_id']->setDependsByArray(array('required'));
$this->mFieldProperties['link_id']->addMessage('required', _MD_RANDGEN_ERROR_REQUIRED, _MD_RANDGEN_LANG_LINK_ID);
       $this->mFieldProperties['title'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['title']->setDependsByArray(array('required','maxlength'));
        $this->mFieldProperties['title']->addMessage('required', _MD_RANDGEN_ERROR_REQUIRED, _MD_RANDGEN_LANG_TITLE);
        $this->mFieldProperties['title']->addMessage('maxlength', _MD_RANDGEN_ERROR_MAXLENGTH, _MD_RANDGEN_LANG_TITLE, '255');
        $this->mFieldProperties['title']->addVar('maxlength', '255');
       $this->mFieldProperties['page_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['page_id']->setDependsByArray(array('required'));
$this->mFieldProperties['page_id']->addMessage('required', _MD_RANDGEN_ERROR_REQUIRED, _MD_RANDGEN_LANG_PAGE_ID);
       $this->mFieldProperties['generator_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['generator_id']->setDependsByArray(array('required'));
$this->mFieldProperties['generator_id']->addMessage('required', _MD_RANDGEN_ERROR_REQUIRED, _MD_RANDGEN_LANG_GENERATOR_ID);
       $this->mFieldProperties['weight'] = new XCube_FieldProperty($this);
$this->mFieldProperties['weight']->setDependsByArray(array('required'));
$this->mFieldProperties['weight']->addMessage('required', _MD_RANDGEN_ERROR_REQUIRED, _MD_RANDGEN_LANG_WEIGHT);

    }

    /**
     * load
     *
     * @param    XoopsSimpleObject  &$obj
     *
     * @return    void
    **/
    public function load(/*** XoopsSimpleObject ***/ &$obj)
    {
        $this->set('link_id', $obj->get('link_id'));
        $this->set('title', $obj->get('title'));
        $this->set('page_id', $obj->get('page_id'));
        $this->set('generator_id', $obj->get('generator_id'));
        $this->set('weight', $obj->get('weight'));
    }

    /**
     * update
     *
     * @param    XoopsSimpleObject  &$obj
     *
     * @return    void
    **/
    public function update(/*** XoopsSimpleObject ***/ &$obj)
    {
        $obj->set('title', $this->get('title'));
        $obj->set('page_id', $this->get('page_id'));
        $obj->set('generator_id', $this->get('generator_id'));
        $obj->set('weight', $this->get('weight'));
    }

    /**
     * _makeDateString
     *
     * @param    string    $key
     * @param    XoopsSimpleObject    $obj
     *
     * @return    string
     **/
    protected function _makeDateString($key, $obj)
    {
        return $obj->get($key) ? date(_PHPDATEPICKSTRING, $obj->get($key)) : '';
    }

    /**
     * _makeUnixtime
     *
     * @param    string    $key
     *
     * @return    unixtime
    **/
    protected function _makeUnixtime($key)
    {
        if(! $this->get($key)){
            return 0;
        }
        $timeArray = explode('-', $this->get($key));
        return mktime(0, 0, 0, $timeArray[1], $timeArray[2], $timeArray[0]);
    }
}

?>
