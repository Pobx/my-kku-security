<?php  print_r($arr);
    $query = $this->db->where(array('image_category'=>$arr['image_category'], 'category_id' => $arr['category_id']))->get('images');
    $images = $query->result_array();
    // print_r($images);
    $images_num_rows = $query->num_rows();
    if($images_num_rows > 0){
?>

        <div class="row">
            <div class="box box-success box-solid mr-20 ml-20">
                <div class="box-header with-border">
                    <h3 class="box-title">ภาพถ่ายเหตุการณ์</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php foreach($images as $img){ ?>
                        <div class="col-sm-12 col-md-4">
                            <img class='img-responsive shadow-none p-3 mb-5 bg-light rounded' src="<?php echo base_url()."/uploads/".$img['image_path'];?>">
                        </div>
                    <?php	}//foreach ?>
                </div>
            </div>
        </div><!-- row -->
<?php }//if ?>