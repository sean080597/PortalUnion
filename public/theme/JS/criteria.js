$(document).ready(function () {
    $('#form-submit-criteria-evaluation').on('submit', function (event) {
        event.preventDefault();
        //show loading image
        $('.loading_ani_img').show();
        var _token = $('input[name="_token"]').val();
        var student_id = $('input#student_id').val();
        var role_id = $('input#role_id').val();

        var arr_criman_id = [];
        var arr_criman_selfassess = [];
        var arr_criman_markstu = [];
        var arr_criman_markcla = [];
        var arr_criman_markfac = [];
        var arr_criman_marksch = [];

        var arr_crisel_id = [];
        var arr_crisel_content = [];
        var arr_crisel_selfassess = [];
        var arr_crisel_markstu = [];
        var arr_crisel_markcla = [];
        var arr_crisel_markfac = [];
        var arr_crisel_marksch = [];

        //criteria mandatory
        $.each($('span[id*=cri_man_id]'), function (index) {
            arr_criman_id[index] = $(this).attr('criman_id');
        });
        //get mark
        $.each($('input[name*=cri_man_selfassess]'), function (index) {
            arr_criman_selfassess[index] = $(this).val();
        });
        $.each($('input[name*=cri_man_markstu]'), function (index) {
            arr_criman_markstu[index] = $(this).val();
        });
        $.each($('input[name*=cri_man_markcla]'), function (index) {
            arr_criman_markcla[index] = $(this).val();
        });
        $.each($('input[name*=cri_man_markfac]'), function (index) {
            arr_criman_markfac[index] = $(this).val();
        });
        $.each($('input[name*=cri_man_marksch]'), function (index) {
            arr_criman_marksch[index] = $(this).val();
        });

        //criteria sel-evaluation
        $.each($('span[id*=cri_sel_id]'), function (index) {
            arr_crisel_id[index] = $(this).attr('crisel_id');
        });
        //get mark
        $.each($('textarea[id*=cri_sel_content]'), function (index) {
            arr_crisel_content[index] = $(this).val();
        });
        $.each($('input[name*=cri_sel_selfassess]'), function (index) {
            arr_crisel_selfassess[index] = $(this).val();
        });
        $.each($('input[name*=cri_sel_markstu]'), function (index) {
            arr_crisel_markstu[index] = $(this).val();
        });
        $.each($('input[name*=cri_sel_markcla]'), function (index) {
            arr_crisel_markcla[index] = $(this).val();
        });
        $.each($('input[name*=cri_sel_markfac]'), function (index) {
            arr_crisel_markfac[index] = $(this).val();
        });
        $.each($('input[name*=cri_sel_marksch]'), function (index) {
            arr_crisel_marksch[index] = $(this).val();
        });

        // $.each(arr_criman_markfac, function (index) {
        //      console.log(arr_criman_markfac[index]);
        // });
        // $.each(arr_crisel_markfac, function (index) {
        //     console.log(arr_crisel_markfac[index]);
        // });

        //ajax post
        $.post("/criteria-evaluation/submit-evaluation",
            {_token:_token, student_id:student_id, arr_criman_id:arr_criman_id,
                arr_criman_selfassess:arr_criman_selfassess,
                arr_criman_markstu:arr_criman_markstu, arr_criman_markcla:arr_criman_markcla,
                arr_criman_markfac:arr_criman_markfac, arr_criman_marksch:arr_criman_marksch,
                arr_crisel_id:arr_crisel_id, arr_crisel_content:arr_crisel_content,
                arr_crisel_selfassess:arr_crisel_selfassess,
                arr_crisel_markstu:arr_crisel_markstu, arr_crisel_markcla:arr_crisel_markcla,
                arr_crisel_markfac:arr_crisel_markfac, arr_crisel_marksch:arr_crisel_marksch,
            },
            function(data){
                //hide loading image
                $('.loading_ani_img').hide();
                alert(data);
            }
        );
    });
});