<?php 
    enum Courier {
        case JNE;
        case POS;
        case TIKI;
    };

 class Shipping 
 {
    private string $API_KEY = "55ccf2fcf872b094d5764522261a6113";
    private string $provinceEndoint = "https://api.rajaongkir.com/starter/province";
    private string $cityEndoint = "https://api.rajaongkir.com/starter/city";
    private string $costEndoint = "https://api.rajaongkir.com/starter/cost";
    public function get_province(?int $id = null):array | object
    {
        
        $curl = curl_init();
        if($id){
            $endpoint = $this->provinceEndoint."?id=".$id;
        }else{
            $endpoint = $this->provinceEndoint;
        }
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key:".$this->API_KEY.""
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response)->rajaongkir->results;
        }
    }
    public function get_city(?int $id = null):array | object
    {
        
        $curl = curl_init();
        if($id){
            $endpoint = $this->cityEndoint."?id=".$id;
        }else{
            $endpoint = $this->cityEndoint;
        }
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key:".$this->API_KEY.""
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response)->rajaongkir->results;
        }
    }
    public function get_cost(int $origin,int $destination,int $weight,Courier $courier)
    {
        $match_courier = match($courier){
            Courier::JNE=>"jne",
            Courier::POS=>"pos",
            Courier::TIKI=>"tiki",
        };

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->costEndoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$destination."&weight=".$weight."&courier=".$match_courier."",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key:".$this->API_KEY.""
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        return "cURL Error #:" . $err;
        } else {
        return json_decode($response)->rajaongkir;
        }
    }
 }
 