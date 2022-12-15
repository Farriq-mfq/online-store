<?php 
    namespace App\Service;

use Config\Encryption;

    /**
     * AUTH SERVICE CLASS 
     * CODED BY FARRIQ MFQ
     */
    class AuthService {
        protected $session;
        protected $encryption;
        protected $db;
        public function __construct()
        {
            $this->session = \Config\Services::session();
            $this->session->start();
            $this->encryption =\Config\Services::encrypter(); 
            $this->db = db_connect();
        }
        /**
         * make same key in database
         * ex : key email (same db)
         * ex : key password (same db)
         */
        public function attempt(array $credentials,string $key_session,string $password_key = "password"):bool
        {
           try{
            $db_field = array_column($this->db->getFieldData("users"),"name");
            $query_search = array_intersect(array_keys($credentials),$db_field);
            if(count($query_search) == count($credentials)){
                if(in_array($password_key,$query_search)){ // check field password
                    $data_credential = array_diff_key($credentials, array_flip([$password_key])); // except password
                    $checkuser = $this->db->table("users")->where($data_credential)->get()->getFirstRow();
                    if($checkuser){
                        $password_db = $checkuser->$password_key;
                        if(password_verify($credentials[$password_key],$password_db)){
                            $data_user = array_merge(array_diff_key((array) $checkuser,array_flip([$password_key])),["IS_LOGIN"=>true]);
                            $enc_data = $this->encryption->encrypt(http_build_query($data_user));
                            $this->session->set($key_session,$enc_data);
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
            throw $e;
           }
        }
        public function getSesssionData(string $key):array
        {
            // get session login
            if($key){
                return $this->parseData($this->encryption->decrypt($this->session->get($key)));
            }
            return [];
        }
        private function parseData(string $data):array
        {
            $parse_data = [];
            foreach (explode("&",$data) as $pv ) {
                $field=explode("=",$pv);
                $parse_data[$field[0]] =$field[1];
            }
            return $parse_data;
        }
    }