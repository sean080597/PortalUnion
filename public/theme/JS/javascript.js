$(document).ready(function () {
    $('body').addClass('loader');
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('active');
    });

    //call to delete faculty
    runAfterLoadingTableFaculty();
    //======================================================
    //load table faculty
    function loadTableFaculty(){
        $.get("getlistfaculties", function (data) {
            $('table tbody').html('');
            $.each(data, function (key, val) {
                $('table tbody')
                .append('<tr><td class="text-center"><input type="checkbox"></td>'
                    +'<td class="text-center">'+ ++key +'</td>'
                    +'<td>'+ val.id +'</td>'
                    +'<td>'+ val.name +'</td>'
                    +'<td>'+ (val.note == null ? "" : val.note) +'</td>'
                    +'<td class="text-center">'
                    +  '<a href="#" class="text-primary open_modal_faculty_to_edit" data-toggle="modal" data-target="#modal_adjust_faculty" faculty_id="'+ val.id +'">'
                    +       '<i class="fas fa-user-edit"></i>'
                    +  '</a>'
                    +'</td>'
                    +'<td class="text-center">'
                    +  '<a href="#" class="text-danger delete_faculty" faculty_id="'+ val.id +'">'
                    +       '<i class="fas fa-trash-alt"></i>'
                    +  '</a>'
                    +'</td></tr>');
            });
            //call after loading table
            runAfterLoadingTableFaculty();
            call_tracking_input_search();
        });
    }

    //to add new faculty
    $('#open_modal_faculty_to_add_new').on('click', function(event){
        event.preventDefault();
        $('#modal_adjust_faculty .modal-title').text('Thêm khoa');
        $('#modal_adjust_faculty .modal-footer').html(
            '<button type="submit" id="btn_add_new_faculty" class="btn btn-success">Thêm mới</button>'
        );
        call_after_loading_modal_faculty();
    });

    function runAfterLoadingTableFaculty() {
        //to delete faculty
        $('.delete_faculty').on('click', function (e) {
            e.preventDefault();
            if(confirm('Bạn có chắc chắn muốn xóa?')){
                var faculty_id = $(this).attr('faculty_id');
                $.get("destroy", {faculty_id:faculty_id}, function (data) {
                    alert(data);
                    loadTableFaculty();
                });
            }
        });

        //to edit faculty
        $('.open_modal_faculty_to_edit').on('click', function(e){
            e.preventDefault();
            var fac_id = $(this).attr('faculty_id');
            $('#modal_adjust_faculty .modal-title').text('Sửa khoa');
            $.get("getInfoFaculty", {fac_id:fac_id}, function(data){
                $('input#fac_id').val(fac_id);
                $('input#fac_name').val(data.fac_name);
                $('input#fac_note').val(data.fac_note);
            });
            $('#modal_adjust_faculty .modal-footer').html(
                '<button type="submit" id="btn_edit_faculty" class="btn btn-success" old_faculty_id="'+fac_id+'">Sửa khoa</button>'
            );
            call_after_loading_modal_faculty();
        });
    }

    //=====================================
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
                $.get('/faculties/create', {fac_id:fac_id, fac_name:fac_name, fac_note:fac_note}, function(data){
                    if(data.error == null){
                        $('#modal_adjust_faculty').modal('hide');
                        alert(data.success);
                        loadTableFaculty();
                    }else{
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
            var new_faculty_id = $('input#fac_id').val();
            var new_faculty_name = $('input#fac_name').val();

            if(new_faculty_id == '' || new_faculty_name == ''){
                alert('Không được để trống mục nào!');
            }else{
                $('#form_adjust_faculty').submit();
            }
        });

        $('#form_adjust_faculty').on('submit', function(event){
            event.preventDefault();
            var old_faculty_id = $("#btn_edit_faculty").attr('old_faculty_id');
            var new_faculty_id = $('input#fac_id').val();
            var new_faculty_name = $('input#fac_name').val();
            var new_faculty_note = $('input#fac_note').val();

            $.get("/faculties/update", {
                old_faculty_id:old_faculty_id,
                new_faculty_id:new_faculty_id,
                new_faculty_name:new_faculty_name,
                new_faculty_note:new_faculty_note
            }, function (data) {
                if(data.error == null){
                    $('#modal_adjust_faculty').modal('hide');
                    alert(data.success);
                    loadTableFaculty();
                }else{
                    $('#error_add_new_faculty').text(data.error);
                    $('#error_add_new_faculty').css('display', 'block');
                    $('#fac_id').css('border-color', 'red');
                }
            });
        });
    }

    //======================================================
    function loadTableClassRoom() {
        var faculty_id = $('#choose_faculties').val();
        $.get('getlistclassrooms', {faculty_id:faculty_id}, function(data){
            $('table tbody').html('');
            $.each(data, function (key, val) {
                $('table tbody')
                .append('<tr><td class="text-center"><input type="checkbox"></td>'
                    +'<td class="text-center">'+ ++key +'</td>'
                    +'<td class="text-center">'+ val.id +'</td>'
                    +'<td class="text-center">'
                    +   '<a href="#" class="text-primary open_modal_classroom_to_edit" data-toggle="modal" data-target="#myModal" classroom_id="'+val.id+'">'
                    +       '<i class="fas fa-user-edit"></i>'
                    +   '</a>'
                    +'</td>'
                    +'<td class="text-center">'
                    +   '<a href="#" class="text-danger delete_classroom" classroom_id="'+val.id+'">'
                    +       '<i class="fas fa-trash-alt"></i>'
                    +   '</a>'
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

});

