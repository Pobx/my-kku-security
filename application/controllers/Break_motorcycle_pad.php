<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Break_motorcycle_pad extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Break_motorcycle_pad_model');
        $this->load->library('Date_libs');
        $this->load->library('FilterBarChartData');
        $this->load->model('Users_model');
        $this->load->library('UploadImages');


    }

    private $head_topic_label           = 'สาเหตุงัดเบาะรถจักยานยนต์ ';
    private $head_sub_topic_label_table = 'รายการ สาเหตุงัดเบาะรถจักยานยนต์ ';
    private $head_sub_topic_label_form  = 'ฟอร์มบันทึกข้อมูล สาเหตุงัดเบาะรถจักยานยนต์ ';
    private $header_columns             = array('ช่วงเวลา', 'วันที่', 'ชื่อ - สกุล', 'สังกัดหน่วยงาน/คณะ', 'สถานที่เกิดเหตุ', 'รายการของที่สูญหาย', 'หมายเหตุ', 'สถานะ', 'ดูข้อมูล'  ,'แก้ไข', 'ลบ');
    private $success_message            = 'บันทึกข้อมูลสำเร็จ';
    private $warning_message            = 'ไม่สามารถทำรายการ กรุณลองใหม่อีกครั้ง';
    private $danger_message             = 'ลบข้อมูลสำเร็จ';

    public function index()
    {
        $data['head_topic_label'] = $this->head_topic_label;
        $data['head_sub_topic_label'] = $this->head_sub_topic_label_table;
        $data['link_go_to_form'] = site_url('break_motorcycle_pad/form_store');
        $data['link_go_to_remove'] = site_url('break_motorcycle_pad/remove');
        $data['header_columns'] = $this->header_columns;

        $qstr = array(
        //   'YEAR(date_break)'=>date('Y'),
          'status !=' => 'disabled'
        );

        $results = $this->Break_motorcycle_pad_model->all($qstr);
        $data['results'] = $results['results'];

        $data['bar_chart_data'] = $this->filterbarchartdata->filter($results['results'], 'date_break_en');
        $data['fields'] = $results['fields'];
        $data['content'] = 'break_motorcycle_pad/break_motocycle_pad_table';

        // echo "<pre>", print_r($data['results']); exit();
        $this->load->view('template_layout', $data);
    }

    public function form_store()
    {
        $id = $this->uri->segment(3);
        $from = $this->uri->segment(4);

        $data = $this->find($id);
        $data['head_topic_label'] = $this->head_topic_label;
        $data['head_sub_topic_label'] = $this->head_sub_topic_label_form;
        $data['link_back_to_table'] = site_url('break_motorcycle_pad');
        $data['form_submit_data_url'] = site_url('break_motorcycle_pad/store');

        $qstr = array('status'=>'active');
        $data['users'] = $this->Users_model->all($qstr);

    
        $data['complainter'] = $this->find($id);

        $data['content'] = 'break_motorcycle_pad/break_motocycle_pad_form_store';
        
        if($from == 'index'){
            $this->session->set_flashdata('tab_status', 'main_info');
        }
        $query2 = $this->db->select('*')
            ->where(array('image_category'=>'bk-mc-p', 'category_id' => $id))->get('images');

        $data['images']['images'] =  $query2->result_array();
        $data['images']['numrows'] =   $query2->num_rows();

        // echo "<pre>", print_r($data['complainter']); exit();
        $this->load->view('template_layout', $data);
    }

    public function store()
    {
        $inputs = $this->input->post();
        $inputs['date_break'] = $this->date_libs->set_date_th($inputs['date_break']);
        $inputs['date_break'].=' '.$inputs['time_break'].":00";
        unset($inputs['time_break']);
        // echo "<pre>", print_r($inputs); exit();
        $results = $this->Break_motorcycle_pad_model->store($inputs);

        $alert_type = ($results['query'] ? 'success' : 'warning');
        $alert_icon = ($results['query'] ? 'check' : 'warning');
        $alert_message = ($results['query'] ? $this->success_message : $this->warning_message);
        $this->session->set_flashdata('alert_type', $alert_type);
        $this->session->set_flashdata('alert_icon', $alert_icon);
        $this->session->set_flashdata('alert_message', $alert_message);

        redirect('break_motorcycle_pad/form_store/'.$inputs['id']);
    }

    public function stor_detective(){
        $inputs = $this->input->post();
        $results = $this->db->where('id', $inputs['id'])->update('break_motorcycle_pad', array('recorder'=> $inputs['name']));        
        $alert_type = ($results ==1 ? 'success' : 'warning');
        $alert_icon = ($results ==1 ? 'check' : 'warning');
        $alert_message = ($results ==1 ? $this->success_message : $this->warning_message);
        $this->session->set_flashdata('alert_type', $alert_type);
        $this->session->set_flashdata('alert_icon', $alert_icon);
        $this->session->set_flashdata('tab_status', 'complainter');

        redirect('break_motorcycle_pad/form_store/'.$inputs['id']);

    }

    private function find($id = 0)
    {
        $results = $this->Break_motorcycle_pad_model->find($id);
        $values = $results['results'];
        $fields = $results['fields'];
        $rows = $results['rows'];
        $data = array();

        foreach ($fields as $key => $value)
        {
            if ($rows <= 0)
            {
                $data[$value] = '';
            }
            else
            {
                $data[$value] = $values->$value;
            }
        }

        return $data;
    }

    public function remove()
    {
        $id = $this->uri->segment(3);
        $results = $this->Break_motorcycle_pad_model->remove($id);

        $alert_type = ($results['query'] ? 'danger' : 'warning');
        $alert_icon = ($results['query'] ? 'trash' : 'warning');
        $alert_message = ($results['query'] ? $this->danger_message : $this->warning_message);
        $this->session->set_flashdata('alert_type', $alert_type);
        $this->session->set_flashdata('alert_icon', $alert_icon);
        $this->session->set_flashdata('alert_message', $alert_message);

        redirect('break_motorcycle_pad');
    }

    public function remove_complainter()
    {
        $id = $this->uri->segment(3);
        $arr = array(
            'recorder' => 0
        );
        $results = $this->db->where('id', $id)->set($arr)->update('break_motorcycle_pad');

        $alert_type = ($results==1 ? 'danger' : 'warning');
        $alert_icon = ($results==1 ? 'trash' : 'warning');
        $alert_message = ($results==1 ? $this->danger_message : $this->warning_message);
        $this->session->set_flashdata('alert_type', $alert_type);
        $this->session->set_flashdata('alert_icon', $alert_icon);
        $this->session->set_flashdata('alert_message', $alert_message);
        $this->session->set_flashdata('tab_status',$this->uri->segment(4));

        redirect('break_motorcycle_pad/form_store/'.$id);
    }

    public function upload_images(){
        //บันทึกรูป ถ้ามี
        if(count($_FILES) > 0){
            $arr = [
                'file' => $_FILES,
                'image_category' =>  'bk-mc-p',
                'category_id' =>  $this->input->post('id'),
            ];
            $this->uploadimages->store_images($arr);

        }
        
        $this->session->set_flashdata('tab_status', 'upload_images');
        redirect('break_motorcycle_pad/form_store/'.$this->input->post('id'));

    }
}
