<div class="row">
	<div class="box box-warning box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">อัพโหลดรูปภาพ</h3>
		</div>
		<div class="box-body">
			<form action="<?php echo site_url('accidents/store_image');?>" method="post" enctype="multipart/form-data">
                <div class="form-group" id="upload_image_0">
                    <div class="col-sm-3">
                        <input type="file"  id="file_image_0" class="form-control" onchange="show_temp_image(this, 0)" name="upload_image[]" >
                    </div>
                    <div class="col-sm-1"><a href="javascript:append_upload_image(0)" class="btn btn-info sm" id="append_file_form_0" style="display:''"><b>+</b></a></div>
                    <div class="col-sm-1"><a href="javascript:delete_upload_image(0)" class="btn btn-danger sm" id="del_file_form_0" style="display:none"><b>-</b></a></div>
                    <div class="col-sm-5">
						<img src="" class="image_responsive" id="temp_image_0">
					</div>
				</div>
                <!-- append form อัพโหลด รูป -->
                <div>
                    <div id="append_upload_image"></div>
                </div>
                <div class=form-group>
                    <input type="hidden" value="<?php echo $id; ?>" name="category_id">
                    <button type="submit" class="btn btn-primary btn-lg  pull-right">บันทึก</button>
                </div>
								
			</form>

            <br style="clear:both">
            <hr>
            <!-- แสดงรูปที่ upload -->
            <?php if($images['numrows'] > 0){ ?>
                <div class='row' id="show_images_div">
                <?php foreach($images['images'] as $image ){ ?>	
                    <div class="col-sm-6">
                        <img src="<?=base_url().'/uploads/'.$image["image_path"]?>" width="450">
                        <a href="javascript:delete_raw_image(<?=$image['id'];?>)" class="btn btn-danger">ลบ</a>
                    </div>
                        
                <?php } ?>
                </div><!-- row -->
            <?php } //if ?>

		</div><!-- body-->
	</div><!-- box -->

    <ul class="list-unstyled list-inline pull-right">
        <li><button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i> Back</button></li>
        <li><button type="button" class="btn btn-info next-step">Next <i class="fa fa-chevron-right"></i></button></li>
    </ul>
				
</div>	