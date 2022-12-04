<?php 

    function alert($message,$type)
    {
        session()->setFlashdata("alert",["message"=>$message,"type"=>$type]);
    }


    function show_error($key):string
    {
        return isset(session()->getFlashdata("validation")[$key]) ? "<div class='invalid-feedback'>".session()->getFlashdata("validation")[$key]."</div>":"";
    }

    function show_class_error(string $key){
        return isset(session()->getFlashdata("validation")[$key]) ? "is-invalid":"";
    }

    