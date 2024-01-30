function deleteObject(id, prefix, name) {
    let authToken = localStorage.getItem('authToken') || "";
    var domain = document.documentElement.getAttribute('data-domain');

    // Get CSRF token value from the meta tag
    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type: 'DELETE',
        url: domain + '/api/v1/' + prefix + '/' + id,
        headers: {
            'Authorization': 'Bearer ' + authToken,
            'X-CSRF-TOKEN': csrfToken
        }
    }).done(function (data) {
        if (Math.floor(data.data > 0)) {
            toastr.success("Xóa " + name + " thành công");
            setTimeout(() => {
                window.location = "./";
            }, 1000);
        } else {
            toastr.error("Xóa " + name + " thất bại");
        }

    }).fail(function (error) {
        console.log(error);
    });
}