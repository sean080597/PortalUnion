$(document).ready(function () {
    $('body').addClass('loader');
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('active');
    });

    function change_alias(alias) {
        var str = alias;
        str = str.toLowerCase();
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
        str = str.replace(/đ/g,"d");
        str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
        str = str.replace(/ + /g," ");
        str = str.trim();
        return str;
    }

    //to call button delete event
    runAfterLoadingTableFaculty();

    //call tracking paginate
    loadTrackingPaginate();

    //======================================================
    //set error faculty
    function setErrFaculty() {
        $('#modal_adjust_faculty input#fac_id').css('border-color', 'red');
        $('#error_add_new_faculty').css('display', 'block');
    }
    //remove error faculty
    function removeErrFaculty() {
        $('#modal_adjust_faculty input#fac_id').removeAttr( "style");
        $('#error_add_new_faculty').css('display', 'none');
    }
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

    function runAfterLoadingTableFaculty() {
        //to edit faculty
        $('.open_modal_faculty_to_edit').on('click', function(event){
            event.preventDefault();
            //show loading image
            $('.loading_ani_img').show();

            var fac_id = $(this).attr('faculty_id');
            //set edit title
            $('#modal_adjust_faculty .modal-title').text('Sửa khoa');
            $('#modal_adjust_faculty input#fac_id').attr( "disabled", "disabled");

            //remove err faculty
            removeErrFaculty();

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

                        //set err faculty
                        setErrFaculty();
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
    //set error faculty
    function setErrClassroom() {
        $('#modal_adjust_classroom input#cla_id').css('border-color', 'red');
        $('#error_add_new_classname').css('display', 'block');
    }
    //remove error faculty
    function removeErrClassroom() {
        $('#modal_adjust_classroom input#cla_id').removeAttr( "style");
        $('#error_add_new_classname').css('display', 'none');
    }
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
    //to add new faculty
    $('#open_modal_classroom_to_add_new').on('click', function(event){
        event.preventDefault();
        //show loading image
        $('.loading_ani_img').show();
        //set add new title
        $('#modal_adjust_classroom .modal-title').text('Thêm khoa');
        //remove if disabled
        $('#modal_adjust_classroom .modal-body input#cla_id').prop("disabled", false);
        //set all null
        $('#modal_adjust_classroom .modal-body input#cla_id').val('');
        //remove err classroom
        removeErrClassroom();

        $.get("/getSelFaculties", function(data){
            $('#modal_adjust_classroom .modal-body #sel-fac').html(data);
            //hide loading image
            $('.loading_ani_img').hide();
        });
        //add button add new to footer
        $('#modal_adjust_classroom .modal-footer').html(
            '<button type="submit" id="btn_add_new_classroom" class="btn btn-success">Thêm mới</button>'
        );
        $('#modal_adjust_classroom').modal('show');
        //call event add new classroom
        call_after_loading_modal_classroom();
    });

    function runAfterLoadingTableClassRoom() {
        //to open modal edit classroom
        $('.open_modal_classroom_to_edit').on('click', function(e){
            e.preventDefault();
            //show loading image
            $('.loading_ani_img').show();

            //remove error on input class name
            removeErrClassroom();

            var classroom_id = $(this).attr('classroom_id');
            var faculty_id = $(this).attr('fa_id');
            //set title edit classroom
            $('#modal_adjust_classroom .modal-title').text('Sửa lớp');
            //set disabled
            $('#modal_adjust_classroom .modal-body #cla_id').attr( "disabled", "disabled" );
            $('#modal_adjust_classroom .modal-body #cla_id').val(classroom_id);
            $.get("/getSelFaculties?faculty_id="+faculty_id,
            function(data){
                $('#modal_adjust_classroom .modal-body #sel-fac').html(data);
                //hide loading image
                $('.loading_ani_img').hide();
            });
            $('#modal_adjust_classroom .modal-footer').html(
                '<button type="button" id="btn_edit_classroom" class="btn btn-primary mb-2" style="margin:0 !important">Sửa</button>'
                +'<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>'
            );
            $('#modal_adjust_classroom').modal('show');

            call_after_loading_modal_classroom();
        });

        callTrackingDeleteClassroom();
    }

    //button delete class room
    function callTrackingDeleteClassroom(){
        $('.delete_classroom').on('click', function (e) {
            e.preventDefault();
            if(confirm('Bạn có chắc chắn muốn xóa?')){
                //show loading image
                $('.loading_ani_img').show();

                var classroom_id = $(this).attr('classroom_id');
                $.get("/classrooms/destroy", {classroom_id:classroom_id}, function (data) {
                    //reload table classroom
                    fetch_data_classrooms(data);
                });
            }
        });
    }

    function call_after_loading_modal_classroom(){
        //to add new classroom
        $('#btn_add_new_classroom').on('click', function(event){
            event.preventDefault();
            var new_classname = $('#form_adjust_classroom input#cla_id').val();
            var faculty_id = $('#sel-fac').val();
            if(new_classname == null || faculty_id == null){
                alert('Không được để trống mục nào!');
            }else{
                //show loading image
                $('.loading_ani_img').show();
                $.get('/classrooms/create', {new_classname:new_classname, faculty_id:faculty_id},
                function(data){
                    if(data.error == null){
                        //reload table classrooms
                        fetch_data_classrooms(data.success);
                        $('#modal_adjust_classroom').modal('hide');
                    }else{
                        //hide loading image
                        $('.loading_ani_img').hide();
                        $('#error_add_new_classname').text(data.error);
                        //set err classroom
                        setErrClassroom();
                    }
                });
            }
        });

        //button edit classroom
        $('#btn_edit_classroom').on('click', function (e) {
            e.preventDefault();
            //show loading image
            $('.loading_ani_img').show();

            //get values
            var classroom_id = $('#form_adjust_classroom input#cla_id').val();
            var faculty_id = $('#sel-fac').val();

            $.get('update', {classroom_id:classroom_id, faculty_id:faculty_id}, function(data){
                //reload table classrooms
                fetch_data_classrooms(data);
                $('#modal_adjust_classroom').modal('hide');
            });
        });
    }
    //=============================================================================
    //handle Paginate
    function loadTrackingPaginate(){
        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            //show loading image
            $('.loading_ani_img').show();

            var page = $(this).attr('href').split('page=')[1];
            var query = change_alias($('#table-search').val()).toLowerCase();

            //check if fetching classrooms or students
            var isFetchingClassrooms = change_alias($(this).attr('href')).includes('classrooms/manage');
            if(isFetchingClassrooms){
                fetch_classrooms_paginate_without_facultyid(page, faculty_id, query);
            }else{
                var classroom_id = $('#classroom_id').val();
                fetch_students_paginate_without_classroomid(page, classroom_id, query);
            }
        });
        function fetch_classrooms_paginate_without_facultyid(page, faculty_id, query){
            $.get("/getPaginateClassrooms?page="+page+"&faculty_id="+faculty_id+"&query="+query,
                function (data) {
                    $('#load_table_classrooms').html(data);

                    //hide loading image
                    $('.loading_ani_img').hide();
                }
            );
        }
        function fetch_students_paginate_without_classroomid(page, classroom_id, query){
            $.get("/getPaginateStudents?page="+page+"&classroom_id="+classroom_id+"&query="+query,
                function (data) {
                    $('#load_table_students').html(data);

                    //hide loading image
                    $('.loading_ani_img').hide();
                }
            );
        }
    }
    //              SEARCH FACULTIES
    function call_search_faculties(query){
        $.get("/getSearchFaculties?query="+query,
            function (data) {
                $('#load_table_faculties_manage').html(data);
                //hide loading image
                $('.loading_ani_img').hide();
                runAfterLoadingTableFaculty();
            }
        );
    }
    //              SEARCH CLASSROOMS
    function call_search_classrooms(query){
        $.get("/getPaginateClassroomsManage?query="+query,
            function (data) {
                $('#load_table_classrooms_manage').html(data);
                $('#total_found_result').val($('#return_found_results').val());

                //hide loading image
                $('.loading_ani_img').hide();
                runAfterLoadingTableClassRoom();
            }
        );
    }
    //              SEARCH STUDENTS
    function call_search_students(query){
        $.get("/getPaginateStudentsManage?query="+query,
            function (data) {
                $('#load_table_students_manage').html(data);
                $('#total_found_result').val($('#return_found_results').val());

                //hide loading image
                $('.loading_ani_img').hide();
            }
        );
    }

    //handle when click button search
    $('.cus-btn-search').on("click",function(){
        //show loading image
        $('.loading_ani_img').show();

        var query = change_alias($('#table-search').val());
        //check if fetching classrooms or students
        var isFetchingStudents = window.location.href;
        if(isFetchingStudents.includes('faculties')){
            call_search_faculties(query);
        }else if(isFetchingStudents.includes('classrooms')){
            call_search_classrooms(query);
        }else{
            call_search_students(query);
        }
    });
});

