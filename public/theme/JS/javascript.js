$(document).ready(function () {
    $('body').addClass('loader');
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('active');
    });

    //to call button delete event
    runAfterLoadingTableFaculty();
    //======================================================
    //load table faculty
    function fetch_data_faculties(notify_success){
        $.get("/getPaginateFaculties", function (data) {
            $('#load_table_faculties_manage').html(data);
            //hide loading image
            $('.loading_ani_img').hide();
            //show msg successfully
            alert(notify_success);
            runAfterLoadingTableFaculty();
        });
    }

    //to add new faculty
    $('#open_modal_faculty_to_add_new').on('click', function(event){
        event.preventDefault();
        //set add new title
        $('#modal_adjust_faculty .modal-title').text('Thêm khoa');
        //remove if disabled
        $('#modal_adjust_faculty .modal-body input#fac_id').prop("disabled", false);
        //set all null
        $('#modal_adjust_faculty .modal-body input#fac_id').val('');
        $('#modal_adjust_faculty .modal-body input#fac_name').val('');
        $('#modal_adjust_faculty .modal-body input#fac_note').val('');
        //add button add new to footer
        $('#modal_adjust_faculty .modal-footer').html(
            '<button type="submit" id="btn_add_new_faculty" class="btn btn-success">Thêm mới</button>'
        );
        //call event add new faculty
        call_after_loading_modal_faculty();
    });

    function runAfterLoadingTableFaculty(event) {
        //to edit faculty
        $('.open_modal_faculty_to_edit').on('click', function(event){
            event.preventDefault();
            //show loading image
            $('.loading_ani_img').show();

            var fac_id = $(this).attr('faculty_id');
            //set edit title
            $('#modal_adjust_faculty .modal-title').text('Sửa khoa');
            $('#modal_adjust_faculty input#fac_id').attr( "disabled", "disabled" );
            $.get("/getInfoFaculty", {fac_id:fac_id}, function(data){
                $('input#fac_id').val(fac_id);
                $('input#fac_name').val(data.fac_name);
                $('input#fac_note').val(data.fac_note);
                //hide loading image
                $('.loading_ani_img').hide();
            });
            $('#modal_adjust_faculty .modal-footer').html(
                '<button type="submit" id="btn_edit_faculty" class="btn btn-success">Sửa khoa</button>'
            );
            call_after_loading_modal_faculty();
        });

        //to delete faculty
        $('.delete_faculty').on('click', function (e) {
            e.preventDefault();
            if(confirm('Bạn có chắc chắn muốn xóa?')){
                //show loading image
                $('.loading_ani_img').show();

                var faculty_id = $(this).attr('faculty_id');
                $.get("/faculties/destroy", {faculty_id:faculty_id}, function (data) {
                    //reload table faculty
                    fetch_data_faculties(data);
                });
            }
        });
    }

    function call_after_loading_modal_faculty(){
        //to add new faculty
        $('#btn_add_new_faculty').on('click', function(event){
            event.preventDefault();
            var fac_id = $('#fac_id').val();
            var fac_name = $('#fac_name').val();
            var fac_note = $('#fac_note').val();
            if(fac_id == '' || fac_name == ''){
                alert('Không được để trống mã khoa hoặc tên khoa!');
            }else{
                //show loading image
                $('.loading_ani_img').show();

                $.get('/faculties/create', {fac_id:fac_id, fac_name:fac_name, fac_note:fac_note}, function(data){
                    if(data.error == null){
                        //reload table faculty & close modal
                        fetch_data_faculties(data.success);
                        $('#modal_adjust_faculty').modal('hide');
                    }else{
                        //hide loading image
                        $('.loading_ani_img').hide();
                        $('#error_add_new_faculty').text(data.error);
                        $('#error_add_new_faculty').css('display', 'block');
                        $('#fac_id').css('border-color', 'red');
                    }
                });
            }
        });

        //to edit faculty
        $('#btn_edit_faculty').on('click', function (e) {
            e.preventDefault();
            //show loading image
            $('.loading_ani_img').show();

            var faculty_id = $('input#fac_id').val();
            var new_faculty_name = $('input#fac_name').val();
            var new_faculty_note = $('input#fac_note').val();

            if(new_faculty_name == ''){
                alert('Không được để trống tên khoa!');
            }else{
                $.get("/faculties/update",
                {
                    faculty_id:faculty_id,
                    new_faculty_name:new_faculty_name,
                    new_faculty_note:new_faculty_note
                },
                function (data) {
                    //reload table faculty & close modal
                    fetch_data_faculties(data);
                    $('#modal_adjust_faculty').modal('hide');
                });
            }
        });
    }
    //======================================================
    //load table classroom
    function fetch_data_classrooms(notify_success) {
        $.get('/getPaginateClassroomsManage', function(data){
            $('#load_table_classrooms_manage').html(data);
            //hide loading image
            $('.loading_ani_img').hide();
            //show msg successfully
            alert(notify_success);
            //call after loading table
            runAfterLoadingTableClassRoom();
        });
    }

    //call this function after loading table
    function runAfterLoadingTableClassRoom() {
        //button delete class room
        $('.delete_classroom').on('click', function (e) {
            e.preventDefault();
            if(confirm('Bạn có chắc chắn muốn xóa?')){
                var classroom_id = $(this).attr('classroom_id');
                $.get("destroy", {classroom_id:classroom_id}, function (data) {
                    alert(data);
                    loadTableClassRoom();
                });
            }
        });

        //button edit class room
        $('.open_modal_classroom_to_edit').on('click', function(e){
            e.preventDefault();

            var classroom_id = $(this).attr('classroom_id');
            var faculty_id = $('#choose_faculties').val();

            $('#modal_classroom .modal-title').text('Sửa lớp');
            $.get("get_sel_faculties", {classroom_id:classroom_id, faculty_id:faculty_id}, function(data){
                $('#modal_classroom .modal-body').html(data);
            });
            $('#modal_classroom .modal-footer').html(
                '<button type="button" id="btn_edit_classroom" class="btn btn-primary mb-2" old_classroom_id="'+classroom_id+'" style="margin:0 !important">Sửa</button>'
                +'<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>'
            );
            $('#modal_classroom').modal('show');

            call_after_loading_classroom_form();
        });
    }
    //-------------------------------------------------------------------
    //button add new class room
    $('button#open_modal_classroom_to_add_new').on('click', function(e){
        e.preventDefault();

        $('#modal_classroom .modal-title').text('Tạo mới lớp');
        $.get("get_sel_faculties", function(data){
            $('#modal_classroom .modal-body').html(data);
        });
        $('#modal_classroom .modal-footer').html(
            '<button type="button" id="btn_add_new_classroom" class="btn btn-primary mb-2" style="margin:0 !important">Tạo mới</button>'
            +'<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>'
        );
        $('#modal_classroom').modal('show');

        call_after_loading_classroom_form();
    });

    //------------------------------------------------------------------------------------
    function call_after_loading_classroom_form(){
        $('#btn_add_new_classroom').on('click', function (e) {
            e.preventDefault();
            var new_classname = $('#form_add_new_classroom input#add_new_classroom_name').val();
            var faculty_id = $('#choose_faculty_for_new_classroom').val();
            if(new_classname == null || faculty_id == null){
                alert('Không được để trống mục nào!');
            }else{
                $.get('add_new_classroom', {new_classname:new_classname, faculty_id:faculty_id}, function(data){
                    if(data.error == null){
                        $('#modal_classroom').modal('hide');
                        alert(data.success);
                        loadTableClassRoom();
                    }else{
                        $('#error_add_new_classname').text(data.error);
                        $('#error_add_new_classname').css('display', 'block');
                        $('#add_new_classroom_name').css('border-color', 'red');
                    }
                });
            }
        });

        $('#btn_edit_classroom').on('click', function (e) {
            e.preventDefault();
            var old_classname = $(this).attr('old_classroom_id');
            var new_classname = $('#form_add_new_classroom input#add_new_classroom_name').val();
            var faculty_id = $('#choose_faculty_for_new_classroom').val();

            if(new_classname == null || faculty_id == null){
                alert('Không được để trống mục nào!');
            }else{
                $.get('update', {old_classname:old_classname, new_classname:new_classname, faculty_id:faculty_id}, function(data){
                    if(data.error == null){
                        $('#modal_classroom').modal('hide');
                        alert(data.success);
                        loadTableClassRoom();
                    }else{
                        $('#error_add_new_classname').text(data.error);
                        $('#error_add_new_classname').css('display', 'block');
                        $('#add_new_classroom_name').css('border-color', 'red');
                    }
                });
            }
        });
    }
    //=============================================================================

});

