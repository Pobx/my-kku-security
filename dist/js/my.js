function append_upload_image(_id){
    $('#del_file_form_'+_id).css('display', '')
    $('#append_file_form_'+_id).css('display', 'none')

id = _id+1;
var str= `<div class="row" style="margin-top:5px">
<div class="form-group" id="upload_image_`+id+`" style="margin-left:2%">
    <div class="col-sm-3">
        <input type="file" class="form-control"  id="file_image_`+id+`" onchange="show_temp_image(this,`+id+`)" name="upload_image[]">
    </div>
    <div class="col-sm-1"><a href="javascript:append_upload_image(`+id+`)" class="btn btn-info sm" id="append_file_form_`+id+`" style="display:''"><b>+</b></a></div>
    <div class="col-sm-1"><a href="javascript:delete_upload_image(`+id+`)" id="del_file_form_`+id+`" class="btn btn-danger sm" style="display:none"><b>-</b></a></div>
    <div class="col-sm-5">
                    <img src="" class="img-responsive" id="temp_image_`+id+`">
                </div>
</div></div>
`;
$('#append_upload_image').append(str);
}

function delete_upload_image(id){
$('#upload_image_'+id).remove();
}

function _delete(id){
console.log(id)
$.post( "<?php echo site_url('accidents/inactive');?>", { 'id': id})
.done(function( data ) {
    console.log(data );
});

}

function show_temp_image(input,id){
var url = input.value;
var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $('#temp_image_'+id).attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
}else{
    $('#temp_image_0').attr('src', '/assets/no_preview.png');
}
}


function delete_raw_image(id){
$.post( "<?php echo site_url('"+url+"');?>", { 'id': id})
.done(function( data ) {
    $('#show_images_div').html(data);
});
}