<?php 

    if(!function_exists("printMenu")){
        function printMenu(array $a){
            if(!is_array($a)){
                return;
            }
            foreach ($a as $v) {
                if($v["parent_category"]){
                    echo ' <tr>
                    <td>'.$v['category'].'</td>
                  </tr>';
                }
                if(isset($v['child'])){
                    printMenu($v['child']);
                }             
            }
        }
    }