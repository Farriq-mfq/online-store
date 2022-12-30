<?php

namespace App\Models;

use App\Interface\AuthInterface;
use CodeIgniter\Model;

class User extends Model implements AuthInterface
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["name","email","password"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    public function getFieldData()
    {
        return $this->db->getFieldData($this->table);
    }
    public function report()
    {
        $this_week = $this->select('created_at,count(*) as "total_user_register",DAYNAME(created_at) as "day"')->where("date_format(created_at,'%Y-%m-%d') BETWEEN date_sub(CURRENT_DATE,INTERVAL 6 DAY) AND CURRENT_DATE")->groupBy('DAYNAME(created_at)')->findAll();
        $last_week = $this->select('created_at,count(*) as "total_user_register",DAYNAME(created_at) as "day"')->where("date_format(created_at,'%Y-%m-%d') BETWEEN date_sub(CURRENT_DATE,INTERVAL 13 DAY) AND date_sub(CURRENT_DATE,INTERVAL 7 DAY)")->groupBy('DAYNAME(created_at)')->findAll();
        $total_all_user = $this->countAllResults();
        // $percentage_this_week 
        return [
            'this_week'=>$this_week,
            'last_week'=>$last_week,
            'total_all_user'=>$total_all_user
        ];
    }
}
