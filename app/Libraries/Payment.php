<?php

enum BANK:string{
    case PERMATA = "bank_permata";
    case BNI = "bank_bni";
    case BRI = "bank_bri";
    case BCA = "bank_bca";
    case MANDIRI = "bank_mandiri";
}
enum EMONEY:string{
    case QRIS = "qris";
}

    class Payment{
        private string $serverKey = "SB-Mid-server-bp_Ld2gLB8ijyBJGwu_7mBfb";
        private bool $isProduction = false;
        private bool $isSanitized = false;
        private bool $is3ds  = false;
        private $db;
        public function __construct()
        {
            \Midtrans\Config::$serverKey = $this->serverKey;
            \Midtrans\Config::$isSanitized = $this->isSanitized;
            \Midtrans\Config::$isProduction = $this->isProduction;
            \Midtrans\Config::$is3ds = $this->is3ds;
            $this->db = db_connect();
        }
        public function bank_transfer(BANK $bank,array $params)
        {
            try{
                switch ($bank->value) {
                    case 'bank_permata':
                        $bank_permata = [
                            "payment_type"=> "bank_transfer",
                            "bank_transfer"=> [
                                "bank"=> "permata",
                            ]
                        ];
                        return \Midtrans\CoreApi::charge(array_merge($bank_permata,["transaction_details"=>$params])); 
                    case "bank_bca":
                        $bank_bca = [
                            "payment_type"=> "bank_transfer",
                            "bank_transfer"=> [
                                "bank"=> "bca",
                            ]
                        ];
                        return \Midtrans\CoreApi::charge(array_merge($bank_bca,["transaction_details"=>$params]));            
                    case "bank_mandiri":
                        $bank_mandiri = [
                            "payment_type"=> "echannel",
                            "echannel"=>[
                                "bill_info1"=>"Payment For:",
                                "bill_info2"=>"debt"
                            ]
                        ];
                        return \Midtrans\CoreApi::charge(array_merge($bank_mandiri,["transaction_details"=>$params]));            
                    case "bank_bni":
                        $bank_bni = [
                            "payment_type"=> "bank_transfer",
                            "bank_transfer"=>[
                                "bank"=> "bni",
                            ]
                        ];
                        return \Midtrans\CoreApi::charge(array_merge($bank_bni,["transaction_details"=>$params]));            
                    case "bank_bri":
                        $bank_bri = [
                            "payment_type"=> "bank_transfer",
                            "bank_transfer"=>[
                                "bank"=> "bri",
                            ]
                        ];
                        return \Midtrans\CoreApi::charge(array_merge($bank_bri,["transaction_details"=>$params]));            
                    default:
                        return "Invalid Bank choose";
                }
            }catch(\Exception $e){
                throw $e;
            }
        }
        public function e_money(EMONEY $emoney,array $params,int $userID)
        {
            try{
                $expired = date("Y-m-d H:i:s");
                $query = "SELECT * FROM session_emoney WHERE user_id=? AND expired >= ?";
                $check = $this->db->query($query,[1,$expired])->getFirstRow();
                if($check==null){
                    switch ($emoney->value) {
                        case 'qris':
                            $qris = [
                                "payment_type"=> "qris",
                                "qris"=> [
                                    "acquirer"=> "gopay",
                                ]
                            ];
                            $result =  \Midtrans\CoreApi::charge(array_merge($qris,["transaction_details"=>$params]));
                            $query = "INSERT INTO `session_emoney`(`name`, `method`, `url`,`user_id`, `expired`) VALUES (?,?,?,?,?)";
                            $this->db->query($query,[$result->actions[0]->name,$result->actions[0]->method,$result->actions[0]->url,$userID,$result->expire_time]);
                            return $result;  
                            /* NO SERVICE */      
                        // case 'shopeepay':
                        //     $shopeepay = [
                        //         "payment_type"=> "shopeepay",
                        //         "shopeepay"=> [
                        //             "callback_url"=> base_url(),
                        //         ]
                        //     ];
                        //     return \Midtrans\CoreApi::charge(array_merge($shopeepay,$params));        
                        default:
                            return "Invalid E-Money choose";
                    }
                }else{
                    return $check;
                }
            }catch(\Exception $e){
                throw $e;
            }
        }
        public function get_status(string $orderId)
        {
            try{
                return \Midtrans\Transaction::status($orderId);
            }catch(\Exception $e){
                throw $e;
            }
        }
        public function payment_cencel(string $orderId)
        {
            try{
                return \Midtrans\Transaction::cancel($orderId);
            }catch(\Exception $e){
                throw $e;
            }
        }
        /* refun_key,amount,reason */
        public function payment_refund(string $orderId,array $params)
        {
            try{
                return \Midtrans\Transaction::refund($orderId,$params);
            }catch(\Exception $e){
                throw $e;
            }
        }
    }