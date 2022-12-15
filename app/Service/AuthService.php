<?php 
    namespace App\Service;

use Config\Encryption;

    class AuthService {
        protected $session;
        protected $encryption;
        public function __construct()
        {
            $this->session = \Config\Services::session();
            $this->session->start();
            $this->encryption =\Config\Services::encrypter(); 
            $data =[
                "nama"=>"FARRIQ",
                "KELAS"=>12
            ];
            $enc_data = $this->encryption->encrypt(http_build_query($data));
            $this->session->set(['token'=>$enc_data]);
        }
        public function attempt($username = null,$password = null)
        {
           $token_to_data = $this->encryption->decrypt($this->session->get("token"));
           dd($this->parseData($token_to_data));
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