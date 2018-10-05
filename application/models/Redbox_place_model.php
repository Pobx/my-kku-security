<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Redbox_place_model extends CI_Model
{

    private $table = 'redbox_place';
    private $id    = 'id';
    private $items = 'id, name,';

    public function all($qstr = '')
    {
        if (isset($qstr) && !empty($qstr))
        {
            $this->db->where($qstr);
        }

        $query = $this->db->select($this->items)->from($this->table)->get();
        $query2 = $this->db->select('
            redbox_place.name
        ')->from($this->table)
        ->join('redbox_inspect_transaction','redbox_inspect_transaction.redbox_place_id = redbox_place.id', 'left')
        ->where('redbox_inspect_transaction.user_id',2)
        ->like('redbox_inspect_transaction.inspect_date', '2018-09-20', 'after')
        ->get();
        $results['results'] = $query->result_array();
        $results['rows'] = $query->num_rows();
        $results['fields'] = $query->list_fields();
        $results['results2'] = $query2->result_array();
        $results['rows2'] = $query2->num_rows();
        $results['fields2'] = $query2->list_fields();
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
