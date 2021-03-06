<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Users_model extends CI_Model
{

    private $table = 'users';
    private $id    = 'id';
    private $items = '
    id,
    username,
    name,
    roles,
    (
      CASE
        WHEN roles = "admin" THEN "ผู้ดูแลระบบ"
        WHEN roles = "operation" THEN "เจ้าหน้าที่"
        WHEN roles = "management" THEN "ผู้บริหาร"
        WHEN roles = "security" THEN "เจ้าหน้าที่รักษาความปลอดภัย"
        WHEN roles = "traffic" THEN "หน่วยจราจร" 
        WHEN roles = "vehicle" THEN  "หน่วยยานพาหนะ"
        WHEN roles = "special_unit"  THEN  "หน่วยปฏิบัติการเฉพาะกิจ"
        WHEN roles = "sitan_news"  THEN  "หน่วยข่าวสีฐาน"
        WHEN roles = "sirikunakorn"  THEN  "ศิริคุณากร"
        WHEN roles = "fire_hydrant" THEN  "หน่วยดับเพลิง"
        ELSE ""
      END
    ) AS roles_name,
    status,
    (
      CASE
        WHEN status = "active" THEN "ACTIVE"
        WHEN status = "disabled" THEN "ลบรายการ"
        ELSE ""
      END
    ) AS status_name,
    ';

    public function all($qstr = '')
    {
        if (isset($qstr) && !empty($qstr))
        {
            $this->db->where($qstr);
        }

        $query = $this->db->select($this->items)->from($this->table)->order_by('username', 'asc')->get();

        $results['results'] = $query->result_array();
        $results['rows'] = $query->num_rows();
        $results['fields'] = $query->list_fields();

        return $results;
    }

    public function find($id)
    {
        $query = $this->db->select($this->items)->from($this->table)->where('id', $id)->get();

        $results['rows'] = $query->num_rows();
        $results['results'] = $query->first_row();
        $results['fields'] = $query->list_fields();

        return $results;
    }

    public function store($inputs)
    {
        $inputs['passwords'] =  md5($inputs['passwords']);
        $inputs['updated'] = date('Y-m-d H:i:s');

        if ($inputs['id'] != '')
        {

            $results['query'] = $this->db->where($this->id, $inputs['id'])->update($this->table, $inputs);
            $results['lastID'] = $inputs['id'];
        }
        else
        {
            $results['query'] = $this->db->insert($this->table, $inputs);
            $results['lastID'] = $this->db->insert_id();
        }

        return $results;
    }

    public function remove($id)
    {
        $inputs = array(
            'id'      => $id,
            'updated' => date('Y-m-d H:i:s'),
            'status'  => 'disabled',
        );

        $results['query'] = $this->db->where($this->id, $inputs['id'])->update($this->table, $inputs);

        return $results;
    }

}
