<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Student_do_not_wear_helmet extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Student_do_not_wear_helmet_model');
        
        $this->load->library('Date_libs');
        $this->load->library('FilterBarChartData');
        $this->load->model('Users_model');
        $this->load->library('UploadImages');
    }

    private $head_topic_label           = 'สถิติไม่สวมหมวกนิรภัย';
    private $head_sub_topic_label_table = 'รายการ สถิติไม่สวมหมวกนิรภัย';
    private $head_sub_topic_label_form  = 'ฟอร์มบันทึกข้อมูล สถิติไม่สวมหมวกนิรภัย';
    private $header_columns             = array('ช่วงเวลา', 'วันที่', 'สถานที่', 'ประเภทบุคคล','ชื่อ - สกุล',  'รหัสนักศึกษา/บัตรประชาชน', 'สังกัด / คณะ', 'จักยานยนต์', 'ดูข้อมูล','แก้ไข', 'ลบ');
    private $success_message            = 'บันทึกข้อมูลสำเร็จ';
    private $warning_message            = 'ไม่สามารถทำรายการ กรุณลองใหม่อีกครั้ง';
    private $danger_message             = 'ลบข้อมูลสำเร็จ';

    public function index()
    {
        $data['head_topic_label'] = $this->head_topic_label;
        $data['head_sub_topic_label'] = $this->head_sub_topic_label_table;
        $data['link_go_to_form'] = site_url('student_do_not_wear_helmet/form_store');
        $data['link_go_to_remove'] = site_url('student_do_not_wear_helmet/remove');
        $data['header_columns'] = $this->header_columns;

        $qstr = array(
          // 'YEAR(inspect_date)'=>date('Y'),
          'status' => 'active'
        );

        $results = $this->Student_do_not_wear_helmet_model->all($qstr);
        $data['results'] = $results['results'];
        $data['bar_chart_data'] = $this->filterbarchartdata->filter($results['results'], 'inspect_date_en');
        
        $data['fields'] = $results['fields'];
        $data['content'] = 'student_do_not_wear_helmet_table';

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
        $data['link_back_to_table'] = site_url('student_do_not_wear_helmet');
        $data['form_submit_data_url'] = site_url('student_do_not_wear_helmet/store');

        if($from =='index'){
            $this->session->set_flashdata('tab_status', 'main_info') ;
        } 
        $qstr = array('status'=>'active');
        $data['users'] = $this->Users_model->all($qstr);

        $query2 = $this->db->select('*')
            ->where(array('image_category'=>'std-no-hm', 'category_id' => $id))->get('images');

        $data['images']['images'] =  $query2->result_array();
        $data['images']['numrows'] =   $query2->num_rows();

        $data['complainter'] = $this->find($id);


        $data['content'] = 'student_do_not_wear_helmet_form_store';

        // echo "<pre>", print_r($data['images']); exit();
        $this->load->view('template_layout', $data);
    }

    public function store()
    {
        $inptus = $this->input->post();
                // echo "<pre>", print_r($inptus); exit();

        $inptus['inspect_date'] = $this->date_libs->set_date_th($inptus['inspect_date']);
        $results = $this->Student_do_not_wear_helmet_model->store($inptus);

        $alert_type = ($results['query'] ? 'success' : 'warning');
        $alert_icon = ($results['query'] ? 'check' : 'warning');
        $alert_message = ($results['query'] ? $this->success_message : $this->warning_message);
        $this->session->set_flashdata('alert_type', $alert_type);
        $this->session->set_flashdata('alert_icon', $alert_icon);
        $this->session->set_flashdata('alert_message', $alert_message);
        $this->session->set_flashdata('tab_status', 'main_info');

        redirect('student_do_not_wear_helmet/form_store/'.$results['lastID']);
    }

    public function store_detective(){
        $inputs = $this->input->post();
        $results = $this->db->where('id', $inputs['id'])->update('student_do_not_wear_helmet', array('recorder'=> $inputs['name']));        
        $alert_type = ($results ==1 ? 'success' : 'warning');
        $alert_icon = ($results ==1 ? 'check' : 'warning');
        $alert_message = ($results ==1 ? $this->success_message : $this->warning_message);
        $this->session->set_flashdata('alert_type', $alert_type);
        $this->session->set_flashdata('alert_icon', $alert_icon);
        $this->session->set_flashdata('tab_status', 'complainter');

        redirect('student_do_not_wear_helmet/form_store/'.$inputs['id']);

    }

    public function remove_complainter()
    {
        $id = $this->uri->segment(3);
        $arr = array(
            'recorder' => 0
        );
        $results = $this->db->where('id', $id)->set($arr)->update('student_do_not_wear_helmet');

        $alert_type = ($results==1 ? 'danger' : 'warning');
        $alert_icon = ($results==1 ? 'trash' : 'warning');
        $alert_message = ($results==1 ? $this->danger_message : $this->warning_message);
        $this->session->set_flashdata('alert_type', $alert_type);
        $this->session->set_flashdata('alert_icon', $alert_icon);
        $this->session->set_flashdata('alert_message', $alert_message);
        $this->session->set_flashdata('tab_status','complainter');

        redirect('student_do_not_wear_helmet/form_store/'.$id);
    }

    private function find($id = 0)
    {
        $results = $this->Student_do_not_wear_helmet_model->find($id);
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
        $results = $this->Student_do_not_wear_helmet_model->remove($id);

        $alert_type = ($results['query'] ? 'danger' : 'warning');
        $alert_icon = ($results['query'] ? 'trash' : 'warning');
        $alert_message = ($results['query'] ? $this->danger_message : $this->warning_message);
        $this->session->set_flashdata('alert_type', $alert_type);
        $this->session->set_flashdata('alert_icon', $alert_icon);
        $this->session->set_flashdata('alert_message', $alert_message);

        redirect('student_do_not_wear_helmet');
    }

    public function upload_images(){
        //บันทึกรูป ถ้ามี
        if(count($_FILES) > 0){
            $arr = array(
                'file' => $_FILES,
                'image_category' =>  'std-no-hm',
                'category_id' =>  $this->input->post('id'),
            );
            $this->uploadimages->store_images($arr);

        }
        
        $this->session->set_flashdata('tab_status', 'upload_images');
        redirect('student_do_not_wear_helmet/form_store/'.$this->input->post('id'));

    }
}
