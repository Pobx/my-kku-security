<div class="row">
    <div class="col-md-4">
        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><?php echo $cause_title; ?></span>
                <span class="info-box-number"><?php echo $vh_fg_key_info['owner_assets_forget_key_place']; ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
            </div><!-- /.info-box-content -->
        </div>	<!-- /.info-box -->

        
    </div>
    <div class="col-md-4">
        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">รถที่เกิดเหตุ</h3>
                <!-- <div class="box-tools pull-right"> -->
            </div><!-- /.box-header -->
            
            <div class="box-body">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>วันที่เกิดเหตุ</b> <a class="pull-right"><?php echo $vh_fg_key_info['date_forget_key'];?></a>
                    </li>
                    <li class="list-group-item">
                        <b>ประเภทรถ</b> <a class="pull-right"><?php echo $vh_fg_key_info['car_type_name'];?></a>
                    </li>
                    <li class="list-group-item">
                        <b>ยี่ห้อรถ</b> <a class="pull-right"><?php echo $vh_fg_key_info['brand']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>รุ่นรถ</b> <a class="pull-right"><?php echo $vh_fg_key_info['model']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>สีรถ</b> <a class="pull-right"><?php echo $vh_fg_key_info['color']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>ทะเบียนรถ</b> <a class="pull-right"><?php echo $vh_fg_key_info['license_plate']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>สภาพรถรถ</b> <a class="pull-right"><?php echo $vh_fg_key_info['car_state']; ?></a>
                    </li>
                    
                </ul>
            </div><!-- /.box-body -->
        </div><!-- box box-primary -->
    </div>

        <!-- --------------------- -->
    <div class="col-md-4">
        <!-- USERS LIST -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">ผู้ประสบเหตุ</h3>
                <div class="box-tools pull-right">
                    <span class="label label-danger"></span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('dist/img/user4-128x128.jpg')?>" alt="User profile picture">
                            <h3 class="profile-username text-center"><?php echo $vh_fg_key_info['owner_assets_name'];?></h3>
                            <p class="text-muted text-center"><?php echo $vh_fg_key_info['people_type'];?></p>
                            
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b> หน่วยงานสังกัด</b> <a class="pull-right"><?=$vh_fg_key_info['owner_assets_department'];?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>ประเภทบุคคล</b> <a class="pull-right"><?php echo $vh_fg_key_info['people_type'];?></a>
                                </li>	
                                <li class="list-group-item">
                                    <b> อายุ</b> <a class="pull-right"><?=$vh_fg_key_info['owner_assets_age'];?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>เบอร์โทรศัพท์</b> <a class="pull-right"><?php echo $vh_fg_key_info['owner_assets_phone'];?></a>
                                </li>		
                            </ul>
                        </div><!-- /.box-body -->
                    </div>
                </div><!-- row -->
            </div><!-- /.box-body -->
        </div><!--/.box -->
    </div>
</div><!--row -->

<?php 
    $query = $this->db->where(['image_category'=>$image_category, 'category_id' => $category_id])->get('images');
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

