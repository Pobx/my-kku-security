<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Accidents_model extends CI_Model
{

  public function __construct()
    {
        parent::__construct();

        $this->load->model('Accidents_vehicles_model');
        $this->load->model('Accidents_peoples_model');
        $this->load->library('FilterVehicles');
        $this->load->library('FilterPeoples');
    }

    private $table = 'accidents';
    private $id    = 'id';
    private $items = '
    id,
    DATE_FORMAT(DATE_ADD(accident_date, INTERVAL 543 YEAR),"%d/%m/%Y") as accident_date,
    period_time,
    place,
    accident_cause,
    status
    ';

    public function all($qstr = '')
    {
        if (isset($qstr) && !empty($qstr))
        {
            $this->db->where($qstr);
        }

        $query = $this->db->select($this->items)->from($this->table)->get();

        $results['results'] = $query->result_array();
        $results['rows'] = $query->num_rows();
        $results['fields'] = $query->list_fields();

        foreach ($results['results'] as $key => $value) {
          $conditions = array(
            'status !=' => 'disabled',
            'accident_id'=>$value['id']
          );

          $results_vehicles = $this->Accidents_vehicles_model->all($conditions);
          $results['results'][$key]['results_vehicles'] = $results_vehicles['results'];
          $results['results'][$key]['count_motocycles'] = $this->filtervehicles->filter($results['results'][$key]['results_vehicles'], $condition ='motorcycle');
          $results['results'][$key]['count_car'] = $this->filtervehicles->filter($results['results'][$key]['results_vehicles'], $condition ='car');

          $results_peoples = $this->Accidents_peoples_model->all($conditions);
          $results['results'][$key]['results_peoples'] = $results_peoples['results'];
          $results['results'][$key]['count_injury'] = $this->filterpeoples->filter($results['results'][$key]['results_peoples'], $condition ='injury');
          $results['results'][$key]['count_dead'] = $this->filterpeoples->filter($results['results'][$key]['results_peoples'], $condition ='dead');
          
        }

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

        return $results;
    }

}
