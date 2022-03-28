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