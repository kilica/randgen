<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kilica
 * Date: 13/09/07
 * Time: 17:30
 * To change this template use File | Settings | File Templates.
 */

function smarty_function_randgen_generator_tree($params, &$smarty)
{
    $tree = $params['tree'];
    $htmltag = '<div class="well"><em class="title">%s</em> : %s';
    $depth = 0;
    $html = '';
    foreach(array_keys($tree['description']) as $key){
        $currentDepth = $tree['depth'][$key];
        $description = nl2br(htmlspecialchars($tree['description'][$key], ENT_QUOTES, 'UTF-8'));
        if($depth == $currentDepth){
            $html .= "</div>";
            $html .= sprintf($htmltag, $tree['title'][$key], $description);
        }
        elseif($depth > $currentDepth){
            for($i=0;$i<$depth-$currentDepth;$i++){
                $html .= "</div>";
            }
            $html .= sprintf($htmltag, $tree['title'][$key], $description);
            $depth = $currentDepth;
        }
        elseif($depth < $currentDepth){
            $html .= sprintf($htmltag, $tree['title'][$key], $description);
            $depth = $currentDepth;
        }
    }
    for($i=0;$i<$currentDepth;$i++){
        $html .= "</div>";
    }

    return $html;
}
