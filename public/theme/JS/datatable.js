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
function table_pagination($table){
    var $tb = '#'+$table;
    $($tb+' tr:gt(0)').each(function(){
        $(this).attr('display','block');
    });
    $('#maxRows').on('change',function(){
        $('.pagination').html();
        var $trnum = 0;
        var $maxRows = parseInt($(this).val());
        var $totalRows = $($tb + ' tbody tr').length;
        if($maxRows <= 0){
            $($tb+' tr:gt(0)').each(function(){
                $(this).attr('display','block').show();
            });
        }else{
            $($tb+' tr:gt(0)').each(function(){
                $trnum++;
                if($trnum > $maxRows){
                    $(this).attr('display','').hide();
                }
                else{
                    $(this).attr('display','block').show();
                }
            });
        }
        $('.pagination').empty();
        if($totalRows >$maxRows && $maxRows != 0){
            var $pagenum = Math.ceil($totalRows/$maxRows);
            for(var i=1;i<=$pagenum;){
                $('.pagination').append(
                    '<li class="page-item" data-page="'+ i +'">'+
                        '<span class="page-link">'+ i++ +
                            '<span class="sr-only">(current)</span>'+
                        '</span>'+
                    '</li>'
                ).show();
            }
            $('.pagination li:nth-child(2)').addClass('active');
            $('.pagination li').on('click',function(){
                $numPage = $(this).attr('data-page');
                var $trIndex = 0;
                $(this).addClass('active').siblings().removeClass('active');
                $($tb+ ' tr:gt(0)').each(function(){
                    $trIndex++;
                    if($trIndex <= (($maxRows*$numPage)-$maxRows) || $trIndex > $maxRows*$numPage){
                        $(this).attr('display','').hide();
                    }
                    else{
                        $(this).attr('display','block').show();
                    }
                });
            });
        }
    });
}
function call_tracking_input_search(){
    $('#table-search').on("keyup",function(){
        $value = change_alias($(this).val()).toLowerCase();
        $('.table tr[display="block"]').filter(function(){
           $index = change_alias($(this).text()).toLowerCase().indexOf($value);
            $(this).toggle($index > -1);
        });
    });
    var $table = 'table';
    table_pagination($table);
}
$(document).ready(function () {
    call_tracking_input_search();
});
