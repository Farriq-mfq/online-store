<?php 

    function alert($message,$type)
    {
        session()->setFlashdata("alert",["message"=>$message,"type"=>$type]);
    }