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

//=========================================================================
//handle query
function loadTrackingPaginate(){
    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        //show loading image
        $('.loading_ani_img').show();

        var page = $(this).attr('href').split('page=')[1];
        var query = change_alias($('#table-search').val()).toLowerCase();
        //check if fetching classrooms or students
        var isFetchingClassrooms = change_alias($(this).attr('href')).includes('classrooms');
        if(isFetchingClassrooms){
            fetch_data_classrooms(page, query);
        }else{
            // var classroom_id = $('#classroom_id').val();
            // fetch_data_students(page, classroom_id, query);
        }
    });

    function fetch_data_classrooms(page, query){
        $.get("/getPaginateClassroomsManage?page="+page+"&query="+query,
            function (data) {
                $('#load_table_classrooms_manage').html(data);

                //hide loading image
                $('.loading_ani_img').hide();
            }
        );
    }
    function fetch_data_students(page, classroom_id, query){
        $.get("/getPaginateStudents?page="+page+"&classroom_id="+classroom_id+"&query="+query,
            function (data) {
                $('#load_table_students').html(data);

                //hide loading image
                $('.loading_ani_img').hide();
            }
        );
    }
}
//-------------------------------------------------------------------------
function call_search_faculties(query){
    $.get("/getSearchFaculties?query="+query,
        function (data) {
            $('#load_table_faculties_manage').html(data);
            //hide loading image
            $('.loading_ani_img').hide();
        }
    );
}
function call_search_classrooms(query){
    $.get("/getPaginateClassroomsManage?query="+query,
        function (data) {
            $('#load_table_classrooms_manage').html(data);
            $('#total_found_result').val($('#return_found_results').val());

            //hide loading image
            $('.loading_ani_img').hide();
        }
    );
}
function call_search_students(query, classroom_id){
    $.get("/getPaginateStudents?classroom_id="+classroom_id+"&query="+query,
        function (data) {
            $('#load_table_students').html(data);
            $('#total_found_result').val($('#return_found_results').val());

            //hide loading image
            $('.loading_ani_img').hide();
        }
    );
}
//detect when click button search & run fetch_search_classrooms()
function call_tracking_input_search(){
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
            // var classroom_id = $('#classroom_id').val();
            // call_search_students(query, classroom_id);
        }
    });
}

$(document).ready(function () {
    loadTrackingPaginate();
    call_tracking_input_search();
});
