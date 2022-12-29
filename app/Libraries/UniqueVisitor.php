<?php

class UniqueVisitor
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect();
    }
    protected function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public function insert_unique_visitor()
    {
        $check = "SELECT * FROM unique_visitor WHERE ip=? LIMIT 1";
        if ($this->db->query($check, [$this->get_client_ip()])->getFirstRow() == null) {
            $insertQ =  "INSERT INTO `unique_visitor`(`ip`) VALUES (?)";
            $this->db->query($insertQ, [$this->get_client_ip()]);
        }
    }
}
