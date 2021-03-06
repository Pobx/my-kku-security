<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation_model extends CI_Model {

  private $table='evaluations';
  private $id    = 'id';
  private $items = '
  evaluations.id, 
    eval_date AS eval_date_en,
    DATE_FORMAT(DATE_ADD(eval_date, INTERVAL 543 YEAR),"%d/%m/%Y") as eval_date,
    gender,
    (
      CASE
        WHEN evaluations.gender = "male" THEN "ชาย"
        WHEN evaluations.gender = "female" THEN "หญิง"
        ELSE ""
      END
    ) AS gender_name,
    age,
    (
      CASE
        WHEN evaluations.age = "less_than_20" THEN "ต่ำกว่า 20 ปี"
        WHEN evaluations.age = "between_21_and_25" THEN "21 - 25 ปี"
        WHEN evaluations.age = "between_26_and_30" THEN "26 - 30 ปี"
        WHEN evaluations.age = "between_31_and_35" THEN "31 - 35 ปี"
        WHEN evaluations.age = "between_36_and_40" THEN "36 - 40 ปี"
        WHEN evaluations.age = "between_41_and_45" THEN "41 - 45 ปี"
        WHEN evaluations.age = "between_46_and_50" THEN "46 - 50 ปี"
        WHEN evaluations.age = "more_than_50" THEN "51 ปี ขึ้นไป"
        ELSE ""
      END
    ) AS age_between_name,
    personal_id,
    faculty_id,
    performance,
    performance,
    success,
    timeline,
    service_clear,
    materials,
    servicemind,
    communication,
    knowlage,
    questions,
    followup,
    comment,
    faculty.name AS faculty_name
  ';

  public function all($qstr = '')
    {
        if (isset($qstr) && !empty($qstr))
        {
            $this->db->where($qstr);
        }

        $query = $this->db->select($this->items)
        ->from($this->table)
        ->join('faculty', 'evaluations.faculty_id = faculty.id', 'left')
        ->get();
        
        $results['results'] = $query->result_array();
        $results['rows'] = $query->num_rows();
        $results['fields'] = $query->list_fields();

        return $results;
    }

  public function store($inputs)
	{
    //echo "<pre>", print_r($inputs); exit();

    if ($inputs['id'] != '') {
      $inputs['updated'] = date('Y-m-d H:i:s');
      $results['query'] = $this->db->where($this->id, $inputs['id'])->update($this->table, $inputs);
      $results['lastID'] = $inputs['id'];
    }else {
      $inputs['created'] = date('Y-m-d H:i:s');
      $results['query'] = $this->db->insert($this->table, $inputs);
      $results['lastID'] = $this->db->insert_id();
    }

    return $results;
  }

}
