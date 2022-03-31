$(document).on('submit', '.delete-form', function(e) {
    e.preventDefault();
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        location.reload();
                        swal("Poof! Data has been deleted!", {
                            icon: "success",
                        });
                    }
                });
            }
        });
});

$("#profileImage").click(function(e) {
    $("#imageUpload").click();
});

function fasterPreview(uploader) {
    if (uploader.files && uploader.files[0]) {
        $('#profileImage').attr('src',
            window.URL.createObjectURL(uploader.files[0]));
    }
}

$("#imageUpload").change(function() {
    fasterPreview(this);
});

$(".update-status").click(function(e){
    $(this).parent().submit();
})

$('.datatable').DataTable();

$(".view-order").click(function(e){
    e.preventDefault();
    $.ajax({
        url: $(this).attr('href'),
        method: 'get',
        success: function(data) {
            $(".view-order-data").html(data);
        }
    });
});

var disablepast = new Date();
var disbaleddate = new Date(disablepast.getFullYear(), disablepast.getMonth(), disablepast.getDate());
$('#entries_acceptance_date').datetimepicker({
lang:'ch',
timepicker:true,
scrollInput : false,
minDate:disbaleddate
});
$('#entries_acceptance_date').change(function(e){
    allDates()
});
$('#entries_close_date').change(function(e){
    allDates()
});
$('#contest_live_date').change(function(e){
    allDates()
});
$('#contest_close_date').change(function(e){
    allDates()
});

function allDates()
{
    $('#entries_close_date').datetimepicker({
        lang:'ch',
        timepicker:true,
        scrollInput : false,
        minDate:addDays($("#entries_acceptance_date").val(),1)
    }); 
    $('#contest_live_date').datetimepicker({
        lang:'ch',
        timepicker:true,
        scrollInput : false,
        minDate:addDays($("#entries_close_date").val(),1)
    }); 
    $('#contest_close_date').datetimepicker({
        lang:'ch',
        timepicker:true,
        scrollInput : false,
        minDate:addDays($("#contest_live_date").val(),1)
    }); 
    $('#result_announce_date').datetimepicker({
        lang:'ch',
        timepicker:true,
        scrollInput : false,
        minDate:addDays($("#contest_close_date").val(),1)
    }); 
}
allDates()


function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}