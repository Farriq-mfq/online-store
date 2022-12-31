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
    if(!function_exists("user")){
        function user()
        {
            return Services::authserviceUser()->getSessionData();
        }
    }
    if(!function_exists("admin")){
        function admin()
        {
            return Services::authserviceAdmin()->getSessionData();
        }
    }