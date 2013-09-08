<?php
/**
 * @package randgen
 * @version $Id: DelegateFunctions.class.php,v 1.1 2007/05/15 02:35:07 minahito Exp $
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

/**
 * cool uri delegate
**/
class Randgen_DelegateFunctions
{
    /**
     * getNormalUri
     *
     * @param string    $uri
     * @param string    $dirname
     * @param string    $dataname
     * @param int       $data_id
     * @param string    $action
     * @param string    $query
     *
     * @return  void
     */
    public static function getNormalUri(/*** string ***/ &$uri, /*** string ***/ $dirname, /*** string ***/ $dataname=null, /*** int ***/ $data_id=0, /*** string ***/ $action=null, /*** string ***/ $query=null)
    {
        $sUri = '/%s/index.php?action=%s%s';
        $lUri = '/%s/index.php?action=%s%s&%s=%d';

        $table = isset($dataname) ? $dataname : 'generator';
        $handler = Legacy_Utils::getModuleHandler($table, $dirname);
        $key = $handler->mPrimary;

        if(isset($dataname)){
            if($data_id>0){
                if(isset($action)){
                    $uri = sprintf($lUri, $dirname, ucfirst($dataname), ucfirst($action), $key, $data_id);
                }
                else{
                    $uri = sprintf($lUri, $dirname, ucfirst($dataname), 'View', $key, $data_id);
                }
            }
            else{
                if(isset($action)){
                    $uri = sprintf($sUri, $dirname, ucfirst($dataname), ucfirst($action));
                }
                else{
                    $uri = sprintf($sUri, $dirname, ucfirst($dataname), 'List');
                }
            }
            $uri = isset($query) ? $uri.'&'.$query : $uri;
        }
        else{
            if($data_id>0){
                if(isset($action)){
                    die('invalid uri');
                }
                else{
                    $uri = sprintf($lUri, $dirname, ucfirst($table), 'View', $key, $data_id);
                }
                $uri = isset($query) ? $uri.'&'.$query : $uri;
            }
            else{
                if(isset($action)){
                    die('invalid uri');
                }
                else{
                    $uri = sprintf('/%s/', $dirname);
                    $uri = isset($query) ? $uri.'index.php?'.$query : $uri;
                }
            }
        }
    }


    public static function getBreadcrumbs(/*** mixed[] ***/ &$breadcrumbs, /***string ***/ $dirname, /*** Legacy_AbstractObject ***/ $object=null)
    {
        $categoryDirname = null;

        //module name set
        $modHandler = xoops_gethandler('module');
        $module = $modHandler->getByDirname($dirname);
        $breadcrumbs[] = array('name'=>$module->getVar('name'), 'url'=>Legacy_Utils::renderUri($dirname));

        //catetgory name set
        if($object instanceof Legacy_AbstractObject){
            if($object->get('category_id')>0){
                $accessController = Randgen_Utils::getAccessController($dirname);
                if($accessController instanceof XoopsModule){
                    $categoryDirname = $accessController->getVar('dirname');
                }
                switch($accessController->getInfo('role')){
                    case 'cat':
                        $catArr = array();
                        XCube_DelegateUtils::call('Legacy_Category.'.$categoryDirname.'.GetCatPath', new XCube_Ref($catArr), $categoryDirname, $object->get('category_id'), 'ASC');
                        foreach(array_keys($catArr['title']) as $key){
                            $breadcrumbs[] = array('name'=>$catArr['title'][$key], 'url'=>Legacy_Utils::renderUri($dirname, $object->getDataname(), 0, null, 'category_id='.$catArr['cat_id'][$key]));
                        }
                        break;
                    case 'group':
                        $groupName = null;
                        XCube_DelegateUtils::call('Legacy_Category.'.$categoryDirname.'.GetTitle', new XCube_Ref($groupName), $categoryDirname, $object->get('category_id'));
                        $breadcrumbs[] = array('name'=>$groupName, 'url'=>Legacy_Utils::renderUri($dirname, 'page', 0, null, 'category_id='.$object->get('category_id')));
                        break;
                    default:
                }
            }
            $breadcrumbs[] = array('name'=>$object->getShow('title'), 'url'=>Legacy_Utils::renderUri($dirname, null, $object->getShow($object->getPrimary())));
        }
    }
}
?>
