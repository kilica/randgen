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

define('RANDGEN_LINK_SORT_KEY_LINK_ID', 1);
define('RANDGEN_LINK_SORT_KEY_TITLE', 2);
define('RANDGEN_LINK_SORT_KEY_PAGE_ID', 3);
define('RANDGEN_LINK_SORT_KEY_GENERATOR_ID', 4);
define('RANDGEN_LINK_SORT_KEY_WEIGHT', 5);

define('RANDGEN_LINK_SORT_KEY_DEFAULT', RANDGEN_LINK_SORT_KEY_LINK_ID);

/**
 * Randgen_LinkFilterForm
**/
class Randgen_LinkFilterForm extends Randgen_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
        RANDGEN_LINK_SORT_KEY_LINK_ID => 'link_id',
        RANDGEN_LINK_SORT_KEY_TITLE => 'title',
        RANDGEN_LINK_SORT_KEY_PAGE_ID => 'page_id',
        RANDGEN_LINK_SORT_KEY_GENERATOR_ID => 'generator_id',
        RANDGEN_LINK_SORT_KEY_WEIGHT => 'weight',

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
        return RANDGEN_LINK_SORT_KEY_DEFAULT;
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
    
        if (($value = $root->mContext->mRequest->getRequest('link_id')) !== null) {
            $this->mNavi->addExtra('link_id', $value);
            $this->_mCriteria->add(new Criteria('link_id', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('title')) !== null) {
            $this->mNavi->addExtra('title', $value);
            $this->_mCriteria->add(new Criteria('title', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('page_id')) !== null) {
            $this->mNavi->addExtra('page_id', $value);
            $this->_mCriteria->add(new Criteria('page_id', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('generator_id')) !== null) {
            $this->mNavi->addExtra('generator_id', $value);
            $this->_mCriteria->add(new Criteria('generator_id', $value));
        }
        if (($value = $root->mContext->mRequest->getRequest('weight')) !== null) {
            $this->mNavi->addExtra('weight', $value);
            $this->_mCriteria->add(new Criteria('weight', $value));
        }

    
        $this->_mCriteria->addSort($this->getSort(), $this->getOrder());
    }
}

?>
