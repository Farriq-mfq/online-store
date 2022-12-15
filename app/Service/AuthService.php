<?php 
    namespace App\Service;

use Config\Encryption;

    /**
     * AUTH SERVICE CLASS 
     * CODED BY FARRIQ MFQ
     * token_name required
     */
    class AuthService {
        protected $session;
        protected $encryption;
        protected $db;
        protected string $token_name;
        public function __construct(string $token_name)
        {
            $this->session = \Config\Services::session();
            $this->session->start();
            $this->encryption =\Config\Services::encrypter(); 
            $this->db = db_connect();
            $this->token_name = $token_name;
        }
        /**
         * make same key in database
         * ex : key email (same db)
         * ex : key password (same db)
         */
        public function attempt(array $credentials,string $key_session,string $table,string $password_key = "password"):bool
        {
           try{
            $db_field = array_column($this->db->getFieldData($table),"name");
            $query_search = array_intersect(array_keys($credentials),$db_field);
            if(count($query_search) == count($credentials)){
                if(in_array($password_key,$query_search)){ // check field password
                    $data_credential = array_diff_key($credentials, array_flip([$password_key])); // except password
                    $checkuser = $this->db->table($table)->where($data_credential)->get()->getFirstRow();
                    if($checkuser){
                        $password_db = $checkuser->$password_key;
                        if(password_verify($credentials[$password_key],$password_db)){
                            $data_user = array_merge(array_diff_key((array) $checkuser,array_flip([$password_key])),["IS_LOGIN"=>true]);
                            $this->setToken($data_user);
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
           }catch(\Exception $e){
            return false;
           }
        }
        public function logout()
        {
            $this->session->remove($this->token_name);
        }
        public function setToken(array $data)
        {
            try{
                $this->session->set($this->token_name,$this->encryption->encrypt(http_build_query($data)));
            }catch(\Exception $e){
                throw $e;
            }
        }
        public function getSesssionData():?array
        {
            // get session login
            try{
                if($this->session->get($this->token_name)){
                    parse_str(urldecode($this->encryption->decrypt($this->session->get($this->token_name))),$output);
                    if(count($output) || $output != null){
                        return $output;
                    }else{
                        return null;
                    }
                }
                return null;
            }catch(\Exception $e){
                return null;
            }
        }
    }