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

/**
 * Randgen_GeneratorObject
**/
class Randgen_GeneratorObject extends Legacy_AbstractObject
{
    const PRIMARY = 'generator_id';
    const DATANAME = 'generator';
    const MAXREPEAT = 100;

    /**
     * __construct
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function __construct()
    {
        parent::__construct();  
        $this->initVar('generator_id', XOBJ_DTYPE_INT, '', false);
        $this->initVar('title', XOBJ_DTYPE_STRING, '', false, 255);
        $this->initVar('uid', XOBJ_DTYPE_INT, '', false);
        $this->initVar('category_id', XOBJ_DTYPE_INT, '', false);
        $this->initVar('description', XOBJ_DTYPE_TEXT, '', false);
        $this->initVar('items', XOBJ_DTYPE_TEXT, '**1|sample-1|1|
**1|sample-2|2|
**4|sample-3
This is sample-3 description|1|
**1|sample-4|1|', false);
        $this->initVar('posttime', XOBJ_DTYPE_INT, time(), false);
   }

    public function showCategory()
    {
        if(! $this->get('category_id')){
            return '';
        }

        $chandler = xoops_gethandler('config');
        $conf = $chandler->getConfigsByDirname($this->getDirname());
        $catDirname = $conf['access_controller'];

        $category = '';
        XCube_DelegateUtils::call('Legacy_Category.'.$catDirname.'.GetTitle', new XCube_Ref($category), $catDirname, $this->get('category_id'));
        return $category;
    }

    public function getItemArray()
    {
        $ret = array('ratio'=>array(), 'description'=>array(), 'repeat'=>array(), 'child'=>array());
        $items = $this->get('items');
        $itemLines = explode('**', $items);
        array_shift($itemLines);
        foreach($itemLines as $item){
            $cols = explode('|', $item);
            $ret['ratio'][] = (int)$cols[0];
            $ret['description'][] = $cols[1];
            $ret['repeat'][] = isset($cols[2]) ? (int)$cols[2] : 1;
            $ret['child'][] = $cols[3] ? explode(',',$cols[3]) : array();
        }
        return $ret;
    }

    public function getRandomItem($depth=0)
    {
        static $repeated = 0;
        static $handler = null;
        if(! $handler){
            $handler = Legacy_Utils::getModuleHandler('generator', $this->getDirname());
        }

        $repeated++;
        if($repeated > self::MAXREPEAT){
            return array('ratio'=>array(), 'description'=>array(), 'repeat'=>array(), 'child'=>array(), 'depth'=>array());
        }
        $ret = array('ratio'=>array(), 'description'=>array(), 'repeat'=>array(), 'child'=>array(), 'depth'=>array());
        $itemArray = $this->getItemArray();
        $sum = array_sum($itemArray['ratio']);
        $rand = mt_rand(1, $sum);
        $count = 0;
        for($i=0;$i<count($itemArray['ratio']);$i++){
            $count = $count + $itemArray['ratio'][$i];
            if($count>=$rand){
                if(count($itemArray['child'][$i])>0){
                    foreach($itemArray['child'][$i] as $childId){
                        $generator = $handler->get($childId);
                        if($generator instanceof Randgen_GeneratorObject){
                            $item = $generator->getRandomItem($depth+1);
                            $ret['ratio'] = array_merge($item['ratio'], $ret['ratio']);
                            $ret['description'] = array_merge($item['description'], $ret['description']);
                            $ret['repeat'] = array_merge($item['repeat'], $ret['repeat']);
                            $ret['child'] = array_merge($item['child'], $ret['child']);
                            $ret['depth'] = array_merge($item['depth'], $ret['depth']);
                        }
                        unset($generator);
                    }
                }
                if($itemArray['repeat'][$i]>1){
                    for($j=0;$j<$itemArray['repeat'][$i];$j++){
                        $item = $this->getRandomItem($depth);
                        $ret['ratio'] = array_merge($item['ratio'], $ret['ratio']);
                        $ret['description'] = array_merge($item['description'], $ret['description']);
                        $ret['repeat'] = array_merge($item['repeat'], $ret['repeat']);
                        $ret['child'] = array_merge($item['child'], $ret['child']);
                        $ret['depth'] = array_merge($item['depth'], $ret['depth']);
                    }
                    break;
                }
                else{
                    array_unshift($ret['ratio'], $itemArray['ratio'][$i]);
                    array_unshift($ret['description'], $this->_parseItemDescription($itemArray['description'][$i]));
                    array_unshift($ret['repeat'], $itemArray['repeat'][$i]);
                    array_unshift($ret['child'], $itemArray['child'][$i]);
                    array_unshift($ret['depth'], $depth);
                    break;
                }
            }
        }
        return $ret;
    }

    protected function _parseItemDescription($description)
    {
        static $handler = null;
        if(! $handler){
            $handler = Legacy_Utils::getModuleHandler('generator', $this->getDirname());
        }
        $matches = array();
        if(preg_match('/\{(\d+)\}/', $description, $matches)){
            array_shift($matches);
            foreach($matches as $id){
                $generator = $handler->get($id);
                if($generator instanceof Randgen_GeneratorObject){
                    $item = $generator->getRandomItem();
                    $description = str_replace('{'.$id.'}', $item['description'][0], $description);
                }
            }
        }
        return $description;
    }

    public function getImageNumber()
    {
        return 0;
    }

}

/**
 * Randgen_GeneratorHandler
**/
class Randgen_GeneratorHandler extends Legacy_AbstractClientObjectHandler
{
    public /*** string ***/ $mTable = '{dirname}_generator';
    public /*** string ***/ $mPrimary = 'generator_id';
    public /*** string ***/ $mClass = 'Randgen_GeneratorObject';

    /**
     * __construct
     * 
     * @param   XoopsDatabase  &$db
     * @param   string  $dirname
     * 
     * @return  void
    **/
    public function __construct(/*** XoopsDatabase ***/ &$db,/*** string ***/ $dirname)
    {
        $this->mTable = strtr($this->mTable,array('{dirname}' => $dirname));
        parent::XoopsObjectGenericHandler($db);
    }

}

?>
