$(document).ready(function () {
    $('#form-submit-criteria-evaluation').on('submit', function (event) {
        event.preventDefault();
        var _token = $('input[name="_token"]').val();
        var student_id = $('input#student_id').val();

        var arr_criman_id = [];
        var arr_criman_selfassess = [];
        var arr_criman_mark = [];

        var arr_crisel_id = [];
        var arr_crisel_content = [];
        var arr_crisel_selfassess = [];
        var arr_crisel_mark = [];

        $.each($('span[id*=cri_man_id]'), function (index) {
            arr_criman_id[index] = $(this).attr('criman_id');
        });
        $.each($('input[name*=cri_man_selfassess]'), function (index) {
            arr_criman_selfassess[index] = $(this).val();
        });
        $.each($('input[name*=cri_man_mark]'), function (index) {
            arr_criman_mark[index] = $(this).val();
        });
        $.each($('span[id*=cri_sel_id]'), function (index) {
            arr_crisel_id[index] = $(this).attr('crisel_id');
        });
        $.each($('textarea[name*=cri_sel_content]'), function (index) {
            arr_crisel_content[index] = $(this).val();
        });
        $.each($('input[name*=cri_sel_selfassess]'), function (index) {
            arr_crisel_selfassess[index] = $(this).val();
        });
        $.each($('input[name*=cri_sel_mark]'), function (index) {
            arr_crisel_mark[index] = $(this).val();
        });

        $.post("/criteria-evaluation/submit-evaluation",
            {_token:_token, student_id:student_id, arr_criman_id:arr_criman_id,
                arr_criman_selfassess:arr_criman_selfassess, arr_criman_mark:arr_criman_mark,
                arr_crisel_id:arr_crisel_id, arr_crisel_content:arr_crisel_content,
                arr_crisel_selfassess:arr_crisel_selfassess, arr_crisel_mark:arr_crisel_mark},
            function(data){
                alert(data);
            }
        );
    });
});