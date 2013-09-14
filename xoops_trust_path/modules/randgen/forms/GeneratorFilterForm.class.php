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

require_once RANDGEN_TRUST_PATH . '/class/AbstractFilterForm.class.php';

define('RANDGEN_GENERATOR_SORT_KEY_GENERATOR_ID', 1);
define('RANDGEN_GENERATOR_SORT_KEY_TITLE', 2);
define('RANDGEN_GENERATOR_SORT_KEY_UID', 3);
define('RANDGEN_GENERATOR_SORT_KEY_CATEGORY_ID', 4);
define('RANDGEN_GENERATOR_SORT_KEY_DESCRIPTION', 5);
define('RANDGEN_GENERATOR_SORT_KEY_ITEMS', 6);
define('RANDGEN_GENERATOR_SORT_KEY_POSTTIME', 7);

define('RANDGEN_GENERATOR_SORT_KEY_DEFAULT', '-'.RANDGEN_GENERATOR_SORT_KEY_GENERATOR_ID);

/**
 * Randgen_GeneratorFilterForm
**/
class Randgen_GeneratorFilterForm extends Randgen_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
        RANDGEN_GENERATOR_SORT_KEY_GENERATOR_ID => 'generator_id',
        RANDGEN_GENERATOR_SORT_KEY_TITLE => 'title',
        RANDGEN_GENERATOR_SORT_KEY_UID => 'uid',
        RANDGEN_GENERATOR_SORT_KEY_CATEGORY_ID => 'category_id',
        RANDGEN_GENERATOR_SORT_KEY_DESCRIPTION => 'description',
        RANDGEN_GENERATOR_SORT_KEY_ITEMS => 'items',
        RANDGEN_GENERATOR_SORT_KEY_POSTTIME => 'posttime',

    );

    /**
     * getDefaultSortKey
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function getDefaultSortKey()
    {
        return RANDGEN_GENERATOR_SORT_KEY_DEFAULT;
    }

    /**
     * fetch
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function fetch()
    {
        parent::fetch();
    
        $root =& XCube_Root::getSingleton();
    
        if (($value = $root->mContext->mRequest->getRequest('generator_id')) !== null) {
            $this->mNavi->addExtra('generator_id', $value);
            $this->_mCriteria->add(new Criteria('generator_id', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('title')) !== null) {
            $this->mNavi->addExtra('title', $value);
            $this->_mCriteria->add(new Criteria('title', '%'.$value.'%', 'LIKE'));
        }
        if (($value = $root->mContext->mRequest->getRequest('uid')) !== null) {
            $this->mNavi->addExtra('uid', $value);
            $this->_mCriteria->add(new Criteria('uid', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('category_id')) !== null) {
            $this->mNavi->addExtra('category_id', $value);
            $this->_mCriteria->add(new Criteria('category_id', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('original_id')) !== null) {
            $this->mNavi->addExtra('original_id', $value);
            $this->_mCriteria->add(new Criteria('original_id', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('description')) !== null) {
            $this->mNavi->addExtra('description', $value);
            $this->_mCriteria->add(new Criteria('description', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('items')) !== null) {
            $this->mNavi->addExtra('items', $value);
            $this->_mCriteria->add(new Criteria('items', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('posttime')) !== null) {
            $this->mNavi->addExtra('posttime', $value);
            $this->_mCriteria->add(new Criteria('posttime', $value));
        }

    
        $this->_mCriteria->addSort($this->getSort(), $this->getOrder());
    }
}

?>
