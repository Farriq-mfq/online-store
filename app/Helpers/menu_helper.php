<?php 

    if(!function_exists("printMenu")){
        function printMenu(array $a){
            $html = "";

            $html .= "<ul>";

            foreach($a as $v){
                if($v['parent_category']){
                    $html .= "<ul><li><a href='#'>".$v['category']."</a></li></ul>";
                }else{
                    $html .= '<li><a href="#">'.$v['category'].'</a></li>';
                }

                if(isset($v['child'])){
                    $html.=printMenu($v['child']);
                }
            }
            
            $html .= "</ul>";
            return $html;
        }
    }