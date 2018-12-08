$(document).ready(function () {
    $('#form-submit-criteria-evaluation').on('submit', function (event) {
        event.preventDefault();
        // var _token = $('input[name="_token"]').val();
        var formData = new FormData(this);
        formData.append('student_id', $('input#student_id').val());
        $.ajax({
            type: "POST",
            url: "/criteria-evaluation/submit-evaluation",
            data: new FormData(this),
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                // alert(data.message);
                console.log(data);
            }
        });
    });
});