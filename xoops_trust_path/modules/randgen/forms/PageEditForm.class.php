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
 * Randgen_PageEditForm
**/
class Randgen_PageEditForm extends XCube_ActionForm
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
        return "module.randgen.PageEditForm.TOKEN";
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
        $this->mFormProperties['page_id'] = new XCube_IntProperty('page_id');
        $this->mFormProperties['title'] = new XCube_StringProperty('title');
        $this->mFormProperties['uid'] = new XCube_IntProperty('uid');
        $this->mFormProperties['category_id'] = new XCube_IntProperty('category_id');
        $this->mFormProperties['description'] = new XCube_TextProperty('description');
        $this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');
        $this->mFormProperties['tags'] = new XCube_TextProperty('tags');


        //
        // Set field properties
        //
       $this->mFieldProperties['page_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['page_id']->setDependsByArray(array('required'));
$this->mFieldProperties['page_id']->addMessage('required', _MD_RANDGEN_ERROR_REQUIRED, _MD_RANDGEN_LANG_PAGE_ID);
       $this->mFieldProperties['title'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['title']->setDependsByArray(array('required','maxlength'));
        $this->mFieldProperties['title']->addMessage('required', _MD_RANDGEN_ERROR_REQUIRED, _MD_RANDGEN_LANG_TITLE);
        $this->mFieldProperties['title']->addMessage('maxlength', _MD_RANDGEN_ERROR_MAXLENGTH, _MD_RANDGEN_LANG_TITLE, '255');
        $this->mFieldProperties['title']->addVar('maxlength', '255');
        $this->mFieldProperties['uid'] = new XCube_FieldProperty($this);
       $this->mFieldProperties['category_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['category_id']->setDependsByArray(array('required'));
$this->mFieldProperties['category_id']->addMessage('required', _MD_RANDGEN_ERROR_REQUIRED, _MD_RANDGEN_LANG_CATEGORY_ID);
       $this->mFieldProperties['description'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['description']->setDependsByArray(array('required'));
        $this->mFieldProperties['description']->addMessage('required', _MD_RANDGEN_ERROR_REQUIRED, _MD_RANDGEN_LANG_DESCRIPTION);
        $this->mFieldProperties['posttime'] = new XCube_FieldProperty($this);
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
        $this->set('page_id', $obj->get('page_id'));
        $this->set('title', $obj->get('title'));
        $this->set('uid', $obj->get('uid'));
        $this->set('category_id', $obj->get('category_id'));
        $this->set('description', $obj->get('description'));
        $this->set('posttime', $obj->get('posttime'));
      $tags = is_array($obj->mTag) ? implode(' ', $obj->mTag) : null;
        if(count($obj->mTag)>0) $tags = $tags.' ';
        $this->set('tags', $tags);
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
        $obj->set('category_id', $this->get('category_id'));
        $obj->set('description', $this->get('description'));
        $obj->mTag = explode(' ', trim($this->get('tags')));
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
