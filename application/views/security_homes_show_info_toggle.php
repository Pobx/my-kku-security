<div class="row">
    <div class="col-md-4">
        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><?php echo $cause_title; ?></span>
                <span class="info-box-number"><?php echo $sec_home_info['address']; ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
            </div><!-- /.info-box-content -->
        </div>	<!-- /.info-box -->
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลการรับเรื่องของเจ้าหน้าที่</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> เจ้าหน้าที่ผู้รับเรื่อง</strong>
                <?php
                    if($sec_home_info['recorder'] > 0){
                        $complainter = $users_model->find($sec_home_info['recorder']);
                         echo '<p class="text-muted"> ' .$complainter['results']->name.'</p>';
                    }else{
                        echo '<p class="text-muted"> ยังไม่ได้ระบุ</p>';
                    }
                    
                ?>
             
              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> หมายเหตุ</strong>

              <p class="text-muted"><?php echo '';//$sec_home_info['remark'];?></p>

              <hr>

            </div>
            <!-- /.box-body -->
          </div><!-- box box-primary -->
        
    </div>
    <div class="col-md-4">
        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">ข้อมูล</h3>
                <!-- <div class="box-tools pull-right"> -->
            </div><!-- /.box-header -->
            
            <div class="box-body">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>วันที่เริ่มฝากบ้าน</b> <a class="pull-right"><?php echo $sec_home_info['start_date'];?></a>
                    </li>
                    <li class="list-group-item">
                        <b>วันที่สิ้นสุดฝากบ้าน</b> <a class="pull-right"><?php echo $sec_home_info['end_date'];?></a>
                    </li>
                    <li class="list-group-item">
                        <b>ช่วงเวลาฝากบ้าน</b> <a class="pull-right"><?php echo $sec_home_info['period']; ?></a>
                    </li>

                    <li class="list-group-item">
                        <b>สถานะการส่งมอบ</b> <a class="pull-right"><?php echo $sec_home_info['status_name']; ?></a>
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
                <h3 class="box-title">ผู้ฝากบ้าน</h3>
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
                            <h3 class="profile-username text-center"><?php echo $sec_home_info['owner_home_name'];?></h3>
                            <p class="text-muted text-center"><?php echo $sec_home_info['owner_home_position_name'];?></p>
                            
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>ตำแหน่ง</b> <a class="pull-right"><?php echo $sec_home_info['owner_home_position_name'];?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>สังกัด</b> <a class="pull-right"><?php echo $sec_home_info['owner_home_department_name'];?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>ที่ทำงาน</b> <a class="pull-right"><?php echo $sec_home_info['owner_home_office_name'];?></a>
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
<?php  }//if ?>

