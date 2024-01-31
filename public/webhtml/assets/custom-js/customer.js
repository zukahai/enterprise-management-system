// {{-- validate form --}}

document.addEventListener('DOMContentLoaded', function () {
    let validateF = {
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Tên khách hàng không được trống'
                    }
                }
            },
            id_custom: {
                validators: {
                    notEmpty: {
                        message: 'Mã khách hàng không được trống'
                    }
                }
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                // Use this for enabling/changing valid/invalid class
                // eleInvalidClass: '',
                eleValidClass: '',
                rowSelector: '.col-sm-12'
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
            instance.on('plugins.message.placed', function (e) {
                if (e.element.parentElement.classList.contains('input-group')) {
                    e.element.parentElement.insertAdjacentElement('afterend', e
                        .messageElement);
                }
            });
        }
    }
    formAddNewRecord = document.getElementById('form-add-new-record');
    fv_customer = FormValidation.formValidation(formAddNewRecord, validateF);
    fromEdit = document.getElementById('editUserForm');
    fvEdit_customer = FormValidation.formValidation(fromEdit, validateF);
});

function submitForm() {
    fv_customer.validate().then(function (status) {
        if (status === 'Valid') {
            // Nếu tất cả đều thoả mãn, trả về true
            document.getElementById("form-add-new-record").submit();
        } else {

        }
    });
}

function submitFormEdit() {
    fvEdit_customer.validate().then(function (status) {
        if (status === 'Valid') {
            // Nếu tất cả đều thoả mãn, trả về true
            document.getElementById("editUserForm").submit();
        } else {

        }
    });
}


// {{-- modal edit --}}

function editRecord(id) {
    let authToken = localStorage.getItem('authToken') || "";
    let csrfToken = $('meta[name="csrf-token"]').attr('content');
    var domain = document.documentElement.getAttribute('data-domain');

    var editForm = document.getElementById('editUserForm');
    editForm.action = domain + '/customer/update/' + id;

    $.ajax({
        type: 'GET',
        url: domain + '/api/v1/customer/' + id,
        headers: {
            'Authorization': 'Bearer ' + authToken,
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (data) {
            if (data.data != undefined && data.data != []) {
                let fullData = data.data;
                console.log(fullData);
                document.getElementById('edit-name').value = fullData.name;
                document.getElementById('edit-address').value = fullData.address;
                document.getElementById('edit-mst').value = fullData.mst;
                document.getElementById('edit-time').value = fullData.time;
                document.getElementById('edit-phone_number').value = fullData.phone_number;
                document.getElementById('edit-contact').value = fullData.contact;
                document.getElementById('edit-note').value = fullData.note;
                document.getElementById('edit-name-title').textContent = fullData.name;
                document.getElementById('edit_id_custom').value = fullData.id_custom;
            }
        }
    });
}
