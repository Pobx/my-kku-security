<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Vehicles_forget_key extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Vehicles_forget_key_model');
        $this->load->model('Vehicles_forget_key_detective_model');
        $this->load->model('Vehicles_forget_key_place_model');
        $this->load->model('Users_model');

        
        $this->load->library('Date_libs');
        $this->load->library('FilterBarChartData');
        $this->load->library('UploadImages');

    }

    private $head_topic_label           = 'สถิติการลืมกุญแจ';
    private $head_sub_topic_label_table = 'รายการ สถิติการลืมกุญแจ';
    private $head_sub_topic_label_form  = 'ฟอร์มบันทึกข้อมูล สถิติการลืมกุญแจ';
    private $header_sub_topic_label_owner_assets = 'ข้อมูลเจ้าของทรัพย์สิน';
    private $header_sub_topic_label_detective = 'ข้อมูลผู้ตรวจพบ';
    
    private $header_columns             = array('วันที่', 'ชื่อ - สกุล', 'สังกัดหน่วยงาน', 'อายุ(ปี)', 'เบอร์ติดต่อ', 'สถานที่ลืมกุญแจ', 'สถานะ', 'ดูข้อมูล', 'แก้ไข', 'ลบ');
    private $header_columns_detective   = array('ชื่อ - สกุล', 'สังกัดหน่วยงาน','หมายเหตุ', 'ลบ');
    private $success_message            = 'บันทึกข้อมูลสำเร็จ';
    private $warning_message            = 'ไม่สามารถทำรายการ กรุณลองใหม่อีกครั้ง';
    private $danger_message             = 'ลบข้อมูลสำเร็จ';

    public function index()
    {
        $data['head_topic_label'] = $this->head_topic_label;
        $data['head_sub_topic_label'] = $this->head_sub_topic_label_table;
        $data['link_go_to_form'] = site_url('vehicles_forget_key/form_store');
        $data['link_go_to_remove'] = site_url('vehicles_forget_key/remove');
        $data['header_columns'] = $this->header_columns;

        $qstr = array(
          // 'YEAR(vehicles_forget_key.date_forget_key)'=>date('Y'),
          'vehicles_forget_key.status !=' => 'disabled'
        );

        if($this->session->userdata['roles'] == 'security'){
            $qstr['recorder']  = $this->session->userdata['id'];
        }
        $results = $this->Vehicles_forget_key_model->all($qstr);
        $data['results'] = $results['results'];

        $data['bar_chart_data'] = $this->filterbarchartdata->filter($results['results'], 'date_forget_key_en');
        $data['fields'] = $results['fields'];
        $data['users_model'] = $this->Users_model;
        $data['content'] = 'vehicles_forget_key_table';

        // echo "<pre>", print_r($data['results']); exit();
        $this->load->view('template_layout', $data);
    }

    public function form_store()
    {
        $id = $this->uri->segment(3);
        $from = $this->uri->segment(4);

        $inputs = $this->input->post();


        $data = $this->find($id);
        $data['vehicles_forget_key_id'] = $id;
        $data['head_topic_label'] = $this->head_topic_label;
        $data['head_sub_topic_label'] = $this->head_sub_topic_label_form;
        $data['header_sub_topic_label_owner_assets'] = $this->header_sub_topic_label_owner_assets; 
        $data['header_sub_topic_label_detective'] = $this->header_sub_topic_label_detective;
        $data['header_columns_detective'] = $this->header_columns_detective;
                // echo "<pre>", print_r($data); exit();


        $data['link_back_to_table'] = site_url('vehicles_forget_key');
        $data['form_submit_data_url'] = site_url('vehicles_forget_key/store');
        $data['form_submit_data_url_modal'] = site_url('vehicles_forget_key/store_detective');
        
        $data['link_go_to_detective_remove'] = site_url('vehicles_forget_key/remove_detective/'.$id);

        $qstr = array('vehicles_forget_key_id'=>$id, 'status'=>'active');
        $vehicles_forget_key_detective = $this->Vehicles_forget_key_detective_model->all($qstr);
        $data['vehicles_forget_key_detective'] = $vehicles_forget_key_detective['results'];

        $qstr_forget_key_place = array('status'=>'active');
        $resluts_forget_key_place = $this->Vehicles_forget_key_place_model->all($qstr_forget_key_place);
        $data['resluts_forget_key_place'] = $resluts_forget_key_place['results'];

        $qstr_key_keeper = array('roles' => 'security');
        $results_key_keeper = $this->Users_model->all($qstr_key_keeper);
        $data['key_keeper'] = $results_key_keeper['results'];

        $query2 = $this->db->select('*')
            ->where(array('image_category'=>'vh-fg-k', 'category_id' => $id))->get('images');

        $data['images']['images'] =  $query2->result_array();
        $data['images']['numrows'] =   $query2->num_rows();
        
        if($from == 'index'){
            $this->session->set_flashdata('tab_status', 'main_info');
        }

        $data['content'] = 'vehicles_forget_key_form_store';
        
        $qstr = array('status'=>'active');
        $data['users'] = $this->Users_model->all($qstr);
        // echo "<pre>", print_r($data['images']['images']); exit();
        $this->load->view('template_layout', $data);
    }

    public function store()
    {
        $inputs = $this->input->post();

        if (isset($inputs['chk_place']) && $inputs['chk_place'] == 'checked_new_place') {
          $inputs['vehicles_forget_key_place_id'] = $this->create_new_place($inputs);
        }

        $inputs['date_forget_key'] = $this->date_libs->set_date_th($inputs['date_forget_key']);
        unset($inputs['chk_place'], $inputs['place_text']);
        $results = $this->Vehicles_forget_key_model->store($inputs);
        
       
        $alert_type = ($results['query'] ? 'success' : 'warning');
        $alert_icon = ($results['query'] ? 'check' : 'warning');
        $alert_message = ($results['query'] ? $this->success_message : $this->warning_message);
        $this->session->set_flashdata('alert_type', $alert_type);
        $this->session->set_flashdata('alert_icon', $alert_icon);
        $this->session->set_flashdata('alert_message', $alert_message);
        $this->session->set_flashdata('tab_status', 'main_info');
        // redirect('vehicles_forget_key');
        redirect('vehicles_forget_key/form_store/'.$results['lastID']);
    }

    private function create_new_place($inputs) {
      $data = array(
        'id'=>'',
        'name'=>$inputs['place_text'],
        'status'=>'active'
      );

      $results = $this->Vehicles_forget_key_place_model->store($data);
      return $results['lastID'];
    }

    private function find($id = 0)
    {
        $results = $this->Vehicles_forget_key_model->find($id);
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
        $results = $this->Vehicles_forget_key_model->remove($id);

        $alert_type = ($results['query'] ? 'danger' : 'warning');
        $alert_icon = ($results['query'] ? 'trash' : 'warning');
        $alert_message = ($results['query'] ? $this->danger_message : $this->warning_message);
        $this->session->set_flashdata('alert_type', $alert_type);
        $this->session->set_flashdata('alert_icon', $alert_icon);
        $this->session->set_flashdata('alert_message', $alert_message);

        redirect('vehicles_forget_key');
    }

    public function remove_detective() {
      $vehicles_forget_key_id = $this->uri->segment(3);
      $id = $this->uri->segment(4);
      
      $results = $this->Vehicles_forget_key_detective_model->remove($id);

      $alert_type = ($results['query'] ? 'danger' : 'warning');
      $alert_icon = ($results['query'] ? 'trash' : 'warning');
      $alert_message = ($results['query'] ? $this->danger_message : $this->warning_message);
      $this->session->set_flashdata('alert_type', $alert_type);
      $this->session->set_flashdata('alert_icon', $alert_icon);
      $this->session->set_flashdata('alert_message', $alert_message);
      $this->session->set_flashdata('tab_status', 'complainter');
      $redirect_page = 'vehicles_forget_key/form_store/';
      redirect($redirect_page.$vehicles_forget_key_id);
  }

    public function store_detective() {
        $inputs = $this->input->post();
        $results = $this->Vehicles_forget_key_detective_model->store($inputs);

        $alert_type = ($results['query'] ? 'success' : 'warning');
        $alert_icon = ($results['query'] ? 'check' : 'warning');
        $alert_message = ($results['query'] ? $this->success_message : $this->warning_message);
        $this->session->set_flashdata('alert_type', $alert_type);
        $this->session->set_flashdata('alert_icon', $alert_icon);
        $this->session->set_flashdata('alert_message', $alert_message);
        $this->session->set_flashdata('tab_status', 'complainter');

        redirect('vehicles_forget_key/form_store/'.$inputs['vehicles_forget_key_id']);
    }

    public function upload_images(){
        //บันทึกรูป ถ้ามี
        if(count($_FILES) > 0){
            $arr = array(
                'file' => $_FILES,
                'image_category' =>  'vh-fg-k',
                'category_id' =>  $this->input->post('id'),
            );
            $this->uploadimages->store_images($arr);

        }
        $this->session->set_flashdata('tab_status', 'upload_images');
        redirect('vehicles_forget_key/form_store/'.$this->input->post('id'));

    }
    
}
