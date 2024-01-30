// {{-- validate form --}}


document.addEventListener('DOMContentLoaded', function () {
    let validateF = {
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: 'Tên đăng nhập không được trống'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Mật khẩu không được trống'
                    },
                    stringLength: {
                        message: 'Mật khẩu phải dài từ 6 kí tự',
                        min: 6
                    }
                }
            },
            password2: {
                validators: {
                    notEmpty: {
                        message: 'Mật khẩu nhập lại không được trống'
                    },
                    stringLength: {
                        message: 'Mật khẩu nhập lại phải dài từ 6 kí tự',
                        min: 6
                    },
                    identical: {
                        compare: function () {
                            return formAuthentication.querySelector('[name="password"]').value;
                        },
                        message: 'Mật khẩu nhập lại chưa trùng khớp'
                    },
                }
            },

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
    fv = FormValidation.formValidation(formAddNewRecord, validateF);
    fromEdit = document.getElementById('editUserForm');
    fvEdit = FormValidation.formValidation(fromEdit, validateF);
});

function submitForm() {
    fv.validate().then(function (status) {
        if (status === 'Valid') {
            // Nếu tất cả đều thoả mãn, trả về true
            document.getElementById("form-add-new-record").submit();
        } else {

        }
    });
}
function submitFormEdit() {
    fvEdit.validate().then(function (status) {
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
    editForm.action = domain + '/staff/update/' + id;

    $.ajax({
        type: 'GET',
        url: domain + '/api/v1/account/' + id,
        headers: {
            'Authorization': 'Bearer ' + authToken,
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (data) {
            console.log(data.data);
            if (data.data != undefined && data.data != []) {
                let fullData = data.data;
                document.getElementById('edit-username').value = fullData.username;
                document.getElementById('edit-name').value = fullData.name;
                document.getElementById('edit-name-title').textContent = fullData.name;
                document.getElementById('edit-email').value = fullData.email;
                document.getElementById('edit-birthday').value = fullData.birthday;
                document.getElementById('edit-cccd').value = fullData.cccd;
                document.getElementById('edit-phone_number').value = fullData.phone_number;
                document.getElementById('edit-business_day').value = fullData.business_day;
                document.getElementById('edit-allowance').value = fullData.allowance;
                document.getElementById('edit-address').value = fullData.address;
                document.getElementById('avata').src = fullData.avata;
            }
        }
    });
}
