$(document).ready(function () {
    $('body').addClass('loader');
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('active');
    });

    //======================================================
    function loadTableClassRoom() {
        var faculty_id = $('#choose_faculties').val();
        $.get('getlistclassrooms', {faculty_id:faculty_id}, function(data){
            $('table tbody').html('');
            $.each(data, function (key, val) {
                $('table tbody')
                .append('<tr><td class="text-center">'+ ++key +'</td>'
                    +'<td class="text-center">'+ val.id +'</td>'
                    +'<td class="text-center">'
                        +'<button class="btn btn-sm btn-info open_modal_classroom_to_edit" type="button" classroom_id="'+val.id+'" style="margin-right:5px">Edit</button>'
                        +'<button class="btn btn-sm btn-danger delete_classroom" type="button" classroom_id="'+val.id+'">Delete</button>'
                    +'</td></tr>');
            });
            //call after loading table
            runAfterLoadingTableClassRoom();
            call_tracking_input_search();//from datatable.js
        });
    }

    $('#choose_faculties').on('change', function () {
        loadTableClassRoom();
    });
    //call this function after loading table
    function runAfterLoadingTableClassRoom() {
        //button delete class room
        $('button.delete_classroom').on('click', function (e) {
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
        $('button.open_modal_classroom_to_edit').on('click', function(e){
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

    function loadTableFaculty(){
        $.get("getlistfaculties", function (data) {
            $('table tbody').html('');
            $.each(data, function (key, val) {
                $('table tbody')
                .append('<tr><td>'+ val.id +'</td>'
                    +'<td>'+ val.name +'</td>'
                    +'<td>'+ (val.note == null ? "" : val.note) +'</td>'
                    +'<td>'+ val.created_at +'</td>'
                    +'<td>'
                        +'<a href="/faculties/'+ val.id +'/edit" class="btn btn-sm btn-info pull-left" style="margin-right: 3px;">Edit</a>'
                        +'<button class="btn btn-sm btn-danger delete_faculty" type="button" faculty_id="'+val.id+'">Delete</button>'
                    +'</td></tr>');
            });
        });
    }
    $('button.delete_faculty').on('click', function (e) {
        e.preventDefault();
        if(confirm('Bạn có chắc chắn muốn xóa?')){
            var faculty_id = $(this).attr('faculty_id');
            $.get("destroy", {faculty_id:faculty_id}, function (data) {
                alert(data);
                loadTableFaculty();
            });
        }
    });

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

});

