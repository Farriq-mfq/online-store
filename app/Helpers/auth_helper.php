<?php

use Config\Services;

    if(!function_exists("auth_client")){
        function auth_user()
        {
            return Services::authserviceUser()->authenticated();
        }
    }
    if(!function_exists("auth_user_id")){
        function auth_user_id()
        {
            return Services::authserviceUser()->getSessionData()['user_id'];
        }
    }