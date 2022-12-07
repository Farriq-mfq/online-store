<?php 
    if(!function_exists("admin_url")){
        function admin_url(string $url):string
        {
            return base_url(ADMIN_PATH."/".$url);            
        }
    }