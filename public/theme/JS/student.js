$(document).ready(function () {
    var old_profile_img;
    $('#profile-img').on('click', function (e) {
        e.preventDefault();
        old_profile_img = $("#profile-img-to-change").attr("src");
        $('#profile-img-to-change').attr('src', old_profile_img);
        $('#select_file').val(null);
        $('#select_file').removeClass('error-input');
        $('#error-null-file').css('display', 'none');
        $('#modal_change_image').modal('show');
    });

    $('.modal-footer button[type="button"]').on('click', function(event){
        event.preventDefault();
        $('#profile-img-to-change').attr('src', old_profile_img);
    });

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

    $('#btn_change_image').on('click', function (event) {
        event.preventDefault();
        if($('#select_file').val() == null || $('#select_file').val() == ''){
            $('#select_file').addClass('error-input');
            $('#error-null-file').css('display', 'block');
        }else{
            $('#uploadimage_form').submit();
        }
    });

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
                // $('#layout-profile-img').attr('src', '/images/'+data.uploaded_image);
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
                location.reload();
            }
        });
    });
    //============================================================================
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height()){
            var stt_student = $('#stt_student').val();
            $.get("/students/getMoreStudents", {stt_student: stt_student}, function (data) {
                if(data != null && data != ''){
                    $('tbody').append(data);
                    stt_student = parseInt(stt_student) + 10;
                    $('#stt_student').val(stt_student);
                }
            });
        }
      });

});