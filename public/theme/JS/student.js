$(document).ready(function () {
    var old_profile_img;
    //open modal & save current profile image
    $('#profile-img').on('click', function (e) {
        e.preventDefault();
        old_profile_img = $("#profile-img-to-change").attr("src");
        $('#profile-img-to-change').attr('src', old_profile_img);
        $('#select_file').val(null);
        $('#select_file').removeClass('error-input');
        $('#error-null-file').css('display', 'none');
        $('#modal_change_image').modal('show');
    });
    //button close modal
    $('.modal-footer button[type="button"]').on('click', function(event){
        event.preventDefault();
        $('#profile-img-to-change').attr('src', old_profile_img);
    });
    //handle when choose image
    $('#select_file').on('change', function (event) {
        event.preventDefault();
        var files = $(this)[0].files;
		var file = files[0];
        if($(this).val() == null || $(this).val() == ''){
            $("#profile-img-to-change").attr("src", old_profile_img);//set null image for cropbox
            $(this).addClass('error-input');
            $('#error-null-file').css('display', 'block');
        }else{
            $("#profile-img-to-change").attr("src", window.URL.createObjectURL(file));//set image for cropbox
            $(this).removeClass('error-input');
            $('#error-null-file').css('display', 'none');
        }
    });
    //check if new profile image is not null & submit upload image
    $('#btn_change_image').on('click', function (event) {
        event.preventDefault();
        if($('#select_file').val() == null || $('#select_file').val() == ''){
            $('#select_file').addClass('error-input');
            $('#error-null-file').css('display', 'block');
        }else{
            $('#uploadimage_form').submit();
        }
    });
    //submit new profile image & student_id to change image of student
    $('#uploadimage_form').on('submit', function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        formData.append('student_id', $('input#student_id').val());
        $.ajax({
            type: "POST",
            url: "/students/ajaxupload",
            data: formData,
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#profile-img img').attr('src', '/images/'+data.uploaded_image);
                $('#current_img').val(data.uploaded_image);
                alert(data.message);
                $('#modal_change_image').modal('hide');
            }
        });
    });

    $('#form-change-info-student').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "/students/update",
            data: new FormData(this),
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                alert(data.message);
                //location.reload();
                // console.log(data);
            }
        });
    });

    $('#is_submit').on('change', function (event) {
        event.preventDefault();
        var is_submit = $(this).is(":checked");
        var student_id = $('#student_id').val();
        var _token = $('input[name="_token"]').val();
        console.log(is_submit);
        $.post("/students/submit_union_note",
            {_token:_token, student_id:student_id, is_submit:is_submit}
        );
    });
    //============================================================================
    $('#faculty').change(function(){
        if($(this).val() != ''){
            var faculty_id = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.post("/students/fetchclassrooms",
                {faculty_id:faculty_id, _token:_token, dependent:dependent},
                function (data) {
                    $('#class_room').html(data);
                }
            );
        }
    });
});