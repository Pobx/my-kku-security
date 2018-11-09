<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UploadImages {
    protected $CI;

    // We'll use a constructor, as you can't directly call a function
    // from a property definition.
    public function __construct()
    {
            // Assign the CodeIgniter super-object
            $this->CI =& get_instance();
    }

    public function store_images($arr)
    {
        $_FILES = $arr['file'];
        $image_category = $arr['image_category'];
        $category_id = $arr['category_id'];
        
        $countfiles = count($_FILES['upload_image']['name']);
        $data = array();

        // Looping all files
        for($i=0;$i<$countfiles;$i++){
            if(!empty($_FILES['upload_image']['name'][$i])){

                // Define new $file array - $file['file']
                $_FILES['file']['name'] = $_FILES['upload_image']['name'][$i];
                $_FILES['file']['type'] = $_FILES['upload_image']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['upload_image']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['upload_image']['error'][$i];
                $_FILES['file']['size'] = $_FILES['upload_image']['size'][$i];
    
                // Set preference
                $config['upload_path'] = 'uploads/'; 
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '225000'; // max_size in kb
                $config['file_name'] = $_FILES['upload_image']['name'][$i];
    
                //Load upload library
                $this->CI->load->library('upload',$config); 
                $this->CI->upload->initialize($config);
                // File upload
               
                if($this->CI->upload->do_upload('file')){
                    // Get data about the file
                    $uploadData = $this->CI->upload->data();
                    $filename = $uploadData['file_name'];
        
                    // Initialize array
                    $data['filenames'][] = $filename;
                
                    $_file = [
                        'image_category' => $image_category,
                        'image_path' => $filename,
                        'category_id' => $category_id,
                        'create_date' => date('Y-m-d H:i:s'),
                        'update_date' => date('Y-m-d H:i:s'),
                    ];
                    $this->CI->db->insert('images', $_file);
                }
            }
        }
    }
    
}
