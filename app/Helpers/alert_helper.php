<?php 

    function alert($message,$type)
    {
        session()->setFlashdata("alert",["message"=>$message,"type"=>$type]);
    }


    function show_error($key,$notemplate=false):string
    {
        if($notemplate){
            return isset(session()->getFlashdata("validation")[$key]) ? session()->getFlashdata("validation")[$key]:"";
        }else{
            return isset(session()->getFlashdata("validation")[$key]) ? "<div class='invalid-feedback'>".session()->getFlashdata("validation")[$key]."</div>":"";
        }
    }

    function show_class_error(string $key){
        return isset(session()->getFlashdata("validation")[$key]) ? "is-invalid":"";
    }

    function show_array_errors(array $array,string $label):string{
        if(count($array)){
            $str = "";
            $str .= "<label>".$label."</label>";
            $str .= "<ul class='text-danger'>";
            foreach ($array as $val) {
                 $str.='
                    <li>
                        '.show_error($val,true).' 
                    </li>
                    ';
                }
            $str .=" </ul>";
            return $str;
        }else{
            return "";
        }
    }