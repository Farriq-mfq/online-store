<?php 

    if(!function_exists("printMenu")){
        function printMenu($a){
            if(!is_array($a)){
                return;
            }
            foreach ($a as $v) {
                if($v["parent_category"]){
                    echo "<tr><td>".$v["category"]."</td></tr>";
                }else{
                    if(is_array($v['child'])){
                        printMenu($v['child']);
                    }
                }
            }
        }
    }