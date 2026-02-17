<?php
namespace App\Models;
use CodeIgniter\Model;

class CommonModel extends Model
{
    private $adminTbl;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->adminTbl = 'tbl_admin';
        // $this->privilegeTbl = 'tbl_privilege';
        // $this->privilegePathTbl = 'tbl_privilege_path';
    }
    public function insertRecord($table, $data)
    {
        $builder = $this->db->table($table);
        $builder->Insert($data);
        return $this->db->insertID();
    }
    public function getAllRecord($table,$whereArr=null,$orderBy=null)
    {
        $builder = $this->db->table($table);
        if($whereArr != null){
            $builder->where($whereArr);

        }
        if($orderBy != null){
            $builder->orderBy($orderBy[0], $orderBy[1]);

        }
        $query = $builder->get();

        // echo $this->db->getLastQuery(); exit;

        $result = $query->getResult();
        // echo '<pre>';print_r($result); exit;
        return $result;
    }
    public function getOneRecord($table,$whereArr=null)
    {
        $builder = $this->db->table($table);
        if($whereArr != null){
            $builder->where($whereArr);

        }
        $query = $builder->get();

        $result = $query->getRow();
        // echo '<pre>';print_r($result); exit;
        return $result;
    }
    public function updateRecord($table, $data, $whereArr){
        $builder = $this->db->table($table);
        $builder->where($whereArr);
        $result = $builder->update($data);
        return $result;
    }

}
