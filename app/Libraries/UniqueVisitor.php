<?php

class UniqueVisitor
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect();
    }
    protected function getUserIP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }
    public function insert_unique_visitor()
    {
        $check = "SELECT * FROM unique_visitor WHERE ip=? AND created_at=CURRENT_TIMESTAMP LIMIT 1";
        // dd($check);
        if ($this->db->query($check, [$this->getUserIP()])->getFirstRow() == null) {
            $insertQ =  "INSERT INTO `unique_visitor`(`ip`) VALUES (?)";
            $this->db->query($insertQ, [$this->getUserIP()]);
        }
    }
}
