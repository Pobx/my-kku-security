<div class="row pad">

	<div class="box box-info box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">อัพโหลดรูปภาพ</h3>
		</div>
		<div class="box-body">
                <div class="form-group" id="upload_image_0">
                    <div class="col-sm-3">
                        <input type="file"  id="file_image_0" class="form-control" onchange="show_temp_image(this, 0)" name="upload_image[]" >
                    </div>
                    <div class="col-sm-1"><a href="javascript:append_upload_image(0)" class="btn btn-info sm" id="append_file_form_0" style="display:''"><b>+</b></a></div>
                    <div class="col-sm-1"><a href="javascript:delete_upload_image(0)" class="btn btn-danger sm" id="del_file_form_0" style="display:none"><b>-</b></a></div>
                    <div class="col-sm-5">
						<img src="" class="img-responsive"  id="temp_image_0">
					</div>
				</div>
                <!-- append form อัพโหลด รูป -->
                    <div id="append_upload_image"></div>
                    
                <div class=form-group>
                    <!-- <input type="hidden" value="<php echo $id; ?>" name="category_id"> -->
                    <button type="submit" class="btn btn-primary  pull-right">บันทึก</button>
                </div>
								

            <br style="clear:both">
            <hr>
            <!-- แสดงรูปที่ upload -->
            <?php if($images['numrows'] > 0){ ?>
                <div class='row' id="show_images_div">
                <?php foreach($images['images'] as $image ){ ?>	
                    <div class="col-sm-6">
                        <img src="<?=base_url().'/uploads/'.$image["image_path"]?>" width="450">
                        <a href="javascript:delete_raw_image(<?=$image['id'];?>, 'vehicles_forget_key/delete_raw_image')" class="btn btn-danger">ลบ</a>
                    </div>
                        
                <?php } ?>
                </div><!-- row -->
            <?php } //if ?>

		</div><!-- body-->
	</div><!-- box -->
				
</div>	


	<script src="<?php echo base_url('dist/js/my.js'); ?>"></script>
