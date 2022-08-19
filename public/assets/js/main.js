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
    // alert($(this).parents().find('tr').text())
    $(this).parents().find('tr').removeClass('bg-light-danger')
    var unseen = $(".unseen-order-count").text();
    unseen = parseInt(unseen);
    if(unseen > 0){
        unseen = unseen -1;
        $(".unseen-order-count").text(unseen)
    }
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


var imagesPreview = function(input, placeToInsertImagePreview) {
    if (input.files) {
        $(".gallery").empty()
        var filesAmount = input.files.length;
        
        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();

            reader.onload = function(event) {
                $($.parseHTML('<img max-height="10px;" max-width="100px;" style="height:100px;width:100px;">')).attr('src', event.target.result).appendTo($(".gallery"));
            }

            reader.readAsDataURL(input.files[i]);
        }
    }

};

$('#gallery-photo-add').on('change', function() {
    imagesPreview(this, 'div.gallery');
});

$(".delete-img-btn").click(function(){
    var after_success = $(this).parent();
    $.ajax({
        url: base_url+'/product/delete-media/'+$(this).data('id'),
        method: 'get',
        success: function(data) {
            alert(data)
            after_success.remove()
        }
    });
})


$(".get-products").change(function(){
    $(".product-selector").empty();
    var row;
    $.ajax({
        url:base_url+"/inventory/get-product/"+$(this).val(),
        method:"get",
        success:function(data){
            row = `<select class="get-product-stock js-example-basic-single" name="product" id="product" style="width: 100%;">`;
            data.products.forEach(product => {
                row += `<option value="${product.id}">${product.title}</option>`;
            })
            row += '</select>'
            $(".product-selector").append(
                row
            )
            $(".js-example-basic-single").select2(); 
            getStock()
        },
        error:function(error){

        }

    })
})
$(document).on("change",".get-product-stock",function(){
    getStock()
})
function getStock()
{
    $.ajax({
        url:base_url+"/inventory/get-product-stock/"+$('.get-product-stock').find(":selected").val(),
        method:"get",
        success:function(data){
           $(".current-stock").text(data.stock)
        },
        error:function(error){

        }

    })
}
getStock()


// $('.amount').keyup(function(){

//     var amount = $(this);
//     var regex = /^\d+(\.\d{1,2})?$/;
//     var error = 0;
//     if(amount.val() <= 0 || regex.test(amount.val()) == false){
//         $(amount).addClass('error');
//         error++;
//     }else{
//         $(amount).removeClass('error');
//     }
//     if(error > 0){
//         return false;
//     }

// });

// $('.number').keyup(function(){

//     var amount = $(this);
//     var regex = /^\d+?$/;
//     var error = 0;
//     if(amount.val() <= 0 || regex.test(amount.val()) == false){
//         $(amount).addClass('error');
//         error++;
//     }else{
//         $(amount).removeClass('error');
//     }
//     if(error > 0){
//         return false;
//     }

// });

