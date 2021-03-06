<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Vehicles_forget_key_model extends CI_Model
{

    private $table = 'vehicles_forget_key';
    private $id    = 'id';
    private $items = '
    vehicles_forget_key.id,
    period_time,
    people_type,
    date_forget_key AS date_forget_key_en,
    DATE_FORMAT(DATE_ADD(date_forget_key, INTERVAL 543 YEAR),"%d/%m/%Y") as date_forget_key,
    owner_assets_name,
    owner_assets_department,
    owner_assets_age,
    owner_assets_phone,
    vehicles_forget_key_place_id,
    vehicles_forget_key_place.name AS owner_assets_forget_key_place,
    car_type,
    (
      CASE 
        WHEN car_type = "car" THEN "รถยนต์"
        WHEN car_type = "motorcycle" THEN "รถจักรยานยนต์"
        ELSE ""
      END
    ) AS car_type_name,
    model,
    brand,
    color,
    license_plate,
    car_state,
    state_comment,
    vehicles_forget_key.status,
    (
      CASE 
        WHEN vehicles_forget_key.status = "active" THEN "ACTIVE"
        WHEN vehicles_forget_key.status = "disabled" THEN "ลบรายการ"
        ELSE ""
      END
    ) AS status_name,
    recorder,
    vehicles_forget_key_detective.name as detective_name,
    vehicles_forget_key_detective.remark as detective_remark,
    ';

    private $items2 = '
    vehicles_forget_key.id,
    period_time,
    people_type,
    date_forget_key AS date_forget_key_en,
    DATE_FORMAT(DATE_ADD(date_forget_key, INTERVAL 543 YEAR),"%d/%m/%Y") as date_forget_key,
    owner_assets_name,
    owner_assets_department,
    owner_assets_age,
    owner_assets_phone,
    vehicles_forget_key_place_id,
    vehicles_forget_key_place.name AS owner_assets_forget_key_place,
    car_type,
    (
      CASE 
        WHEN car_type = "car" THEN "รถยนต์"
        WHEN car_type = "motorcycle" THEN "รถจักรยานยนต์"
        ELSE ""
      END
    ) AS car_type_name,
    model,
    brand,
    color,
    license_plate,
    car_state,
    state_comment,
    vehicles_forget_key.status,
    (
      CASE 
        WHEN vehicles_forget_key.status = "active" THEN "ACTIVE"
        WHEN vehicles_forget_key.status = "disabled" THEN "ลบรายการ"
        ELSE ""
      END
    ) AS status_name,
    recorder,
    vehicles_forget_key_detective.name as detective_name,
    vehicles_forget_key_detective.remark as detective_remark

    ';

    public function all($qstr = '')
    {
        if (isset($qstr) && !empty($qstr))
        {

            $this->db->where($qstr);
        }

       
            $query = $this->db->select($this->items)->from($this->table)
                ->join('vehicles_forget_key_place', 'vehicles_forget_key_place.id = vehicles_forget_key.vehicles_forget_key_place_id', 'left')
                ->join('vehicles_forget_key_detective', 'vehicles_forget_key_detective.vehicles_forget_key_id = vehicles_forget_key.id', 'left' )
                ->group_by('vehicles_forget_key.id')
                ->order_by('vehicles_forget_key.people_type asc')
                ->get();

        

        $results['results'] = $query->result_array();
        $results['rows'] = $query->num_rows();
        $results['fields'] = $query->list_fields();
        // echo "<pre>"; print_r($results['results']);die();
        return $results;
    }

    public function find($id)
    {
      
        $query = $this->db->select($this->items)->from($this->table)->where('vehicles_forget_key.id', $id)
        ->join('vehicles_forget_key_place', 'vehicles_forget_key_place.id = vehicles_forget_key.vehicles_forget_key_place_id', 'left')
        ->join('vehicles_forget_key_detective', 'vehicles_forget_key_detective.vehicles_forget_key_id = vehicles_forget_key.vehicles_forget_key_place_id', 'left' )
        ->get();
        
        $results['rows'] = $query->num_rows();
        $results['results'] = $query->first_row();
        $results['fields'] = $query->list_fields();

        return $results;
    }

    public function store($inputs)
    {
        // echo "<pre>", print_r($inputs); exit();
        if ($inputs['id'] != '')
        {
            $inputs['updated'] = date('Y-m-d H:i:s');
            $results['query'] = $this->db->where($this->id, $inputs['id'])->update($this->table, $inputs);
            $results['lastID'] = $inputs['id'];
        }
        else
        {
            $inputs['created'] = date('Y-m-d H:i:s');
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
// print_r($results['query']); die();
        return $results;
    }

    public function distinct_place($qstr) {
      if (isset($qstr) && !empty($qstr))
      {
          $this->db->where($qstr);
      }

      $query = $this->db->distinct()->select('vehicles_forget_key_place_id')->from($this->table)->get();

      $results['results'] = $query->result_array();
      $results['rows'] = $query->num_rows();
      $results['fields'] = $query->list_fields();

      return $results;
  }

}
