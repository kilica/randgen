<?php
/**
 * @package randgen
 * @version $Id: ImageClient.class.php,v 1.0 $
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

/**
 * image client delegate
**/
class Randgen_ImageClientDelegate implements Legacy_iImageClientDelegate
{
    /**
     * getClientList
     *
     * @param mixed[]   &$list
     *  @list[]['dirname']
     *  @list[]['dataname']
     *
     * @return  void
     */ 
    public static function getClientList(/*** mixed[] ***/ &$list)
    {
        $dirnames = Legacy_Utils::getDirnameListByTrustDirname(basename(dirname(dirname(dirname(__FILE__)))));
    
        //don't call this method multiple times when site owner duplicate this module.
        static $isCalled = false;
        if($isCalled === true){
            return;
        }
    
        $list[] = array('dirname'=>$dir, 'dataname'=>'page');

    
        $isCalled = true;
    }
}

?>
