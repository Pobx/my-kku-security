<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Authen extends CI_Controller
{
  public function __construct()
    {
        parent::__construct();

        $this->load->model('Users_model');
        $this->load->library('session');

    }

    public function index()
    {

      $data['form_submit'] = site_url('authen/login');
      $data['attr'] = array(
          'id' => 'my_form_submit'
          , 'class' => 'form-horizontal'
          , 'role' => 'form'
          , 'autocomplete' => 'off',
      );

      if($this->uri->segment(3)  == "app"){
        $this->session->set_userdata('from_app', 1);
      }else{
        $this->session->set_userdata('from_app', 0);

      }
     
        $this->load->view('template_authen2', $data);
    }


    public function login() {

      $inputs = $this->input->post();
      $inputs['passwords'] = md5($inputs['passwords']);
      $inputs['status'] = 'active';
      $results = $this->Users_model->all($inputs);

      // if ($results['rows'] > 0 && $results['results'][0]['roles'] =='admin') {
      //   $results['results'][0]['logged'] = true;
      //   $this->session->set_userdata($results['results'][0]);
        
      //   redirect('dashboard');
      // } else if ($results['rows'] > 0 && $results['results'][0]['roles'] =='security') {
      //   $results['results'][0]['logged'] = true;
      //   $this->session->set_userdata($results['results'][0]);
      //   if($this->session->userdata('from_app') == 1 ){
          
      //     redirect('redbox_security_only/form_store');
      //   }else{
      //     redirect('dashboardsecurity');
      //   }

      if ($results['rows'] > 0) {
          $results['results'][0]['logged'] = true;
          $this->session->set_userdata($results['results'][0]);
          if($this->session->userdata('from_app') == 1 ){
            redirect('redbox_security_only/form_store');
          }else{
            if($results['results'][0]['roles'] =='admin'){
              redirect('dashboard');
            }else{
              redirect('dashboardsecurity');
            }
            
          }
          
        
      }else {
        redirect('authen');
      }
    }

    public function logout() {
      $this->session->sess_destroy();
      redirect('authen');
    }
}
