<?php
namespace App\Models;
use CodeIgniter\Model;

class AuthModel extends Model
{
    private $adminTbl;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->adminTbl = 'tbl_admin';
        // $this->privilegeTbl = 'tbl_privilege';
        // $this->privilegePathTbl = 'tbl_privilege_path';
    }
    public function isvalidate($email)
    {
        //$pass=md5($password);
        $builder = $this->db->table($this->adminTbl);
        $builder->where('email', $email);
        $builder->where('status', 1);
        $query = $builder->get();
        //print_r($query);exit;
        $result = $query->getRow();
        //print_r($result);exit;
        return $result;
    }

}
