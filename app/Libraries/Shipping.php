<?php
class Shipping
{
    private string $API_KEY = "55ccf2fcf872b094d5764522261a6113";
    private string $provinceEndoint = "https://api.rajaongkir.com/starter/province";
    private string $cityEndoint = "https://api.rajaongkir.com/starter/city";
    private string $costEndoint = "https://api.rajaongkir.com/starter/cost";
    private int $origin = 349;
    public function getOrigin():int
    {
        return $this->origin;
    }
    public function get_province(?int $id = null): array | object
    {
        try {
            $curl = curl_init();
            if ($id) {
                $endpoint = $this->provinceEndoint . "?id=" . $id;
            } else {
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
                    "key:" . $this->API_KEY . ""
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response)->rajaongkir->results;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function get_city(?int $id = null): array | object
    {
        try {
            $curl = curl_init();
            if ($id) {
                $endpoint = $this->cityEndoint . "?id=" . $id;
            } else {
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
                    "key:" . $this->API_KEY . ""
                ),
            ));
            $response = curl_exec($curl);

            curl_close($curl);
            return json_decode($response)->rajaongkir->results;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function get_cost(int $destination, int $weight, string $courier)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->costEndoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "origin=" . $this->getOrigin() . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier . "",
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key:" . $this->API_KEY . ""
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response)->rajaongkir;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function filterCost($cost_result, $service)
    {
        $filter = array_filter($cost_result, function ($val) use ($service) {
            return $val->service == $service;
        });

        return array_values($filter);
    }
}
