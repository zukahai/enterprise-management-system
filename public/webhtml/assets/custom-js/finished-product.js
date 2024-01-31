// {{-- validate form --}}

document.addEventListener('DOMContentLoaded', function () {
    let validateF = {
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Tên thành phẩm không được trống'
                    }
                }
            },
            id_custom: {
                validators: {
                    notEmpty: {
                        message: 'Mã thành phẩm không được trống'
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
    fv_finished_product = FormValidation.formValidation(formAddNewRecord, validateF);
    fromEdit = document.getElementById('editFinishedProductForm');
    fvEdit_finished_product = FormValidation.formValidation(fromEdit, validateF);
});

function submitForm() {
    fv_finished_product.validate().then(function (status) {
        if (status === 'Valid') {
            // Nếu tất cả đều thoả mãn, trả về true
            document.getElementById("form-add-new-record").submit();
        } else {

        }
    });
}

function submitFormEdit() {
    fvEdit_finished_product.validate().then(function (status) {
        if (status === 'Valid') {
            // Nếu tất cả đều thoả mãn, trả về true
            document.getElementById("editFinishedProductForm").submit();
        } else {

        }
    });
}


// {{-- modal edit --}}

function editRecord(id) {
    let authToken = localStorage.getItem('authToken') || "";
    let csrfToken = $('meta[name="csrf-token"]').attr('content');
    var domain = document.documentElement.getAttribute('data-domain');

    var editForm = document.getElementById('editFinishedProductForm');
    editForm.action = domain + '/finished-product/update/' + id;

    $.ajax({
        type: 'GET',
        url: domain + '/api/v1/finished-product/' + id,
        headers: {
            'Authorization': 'Bearer ' + authToken,
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (data) {
            if (data.data != undefined && data.data != []) {
                let fullData = data.data;
                console.log(fullData);
                document.getElementById('edit_name').value = fullData.name;
                document.getElementById('edit_note').value = fullData.note;
                document.getElementById('edit-name-title').textContent = fullData.name;
                document.getElementById('edit_ktdh_length').value = fullData.ktdh_length;
                document.getElementById('edit_ktdh_width').value = fullData.ktdh_width;
                document.getElementById('edit_ktdh_height').value = fullData.ktdh_height;
                document.getElementById('edit_ktsx_length').value = fullData.ktsx_length;
                document.getElementById('edit_ktsx_width').value = fullData.ktsx_width;
                document.getElementById('edit_ktsx_height').value = fullData.ktsx_height;
                document.getElementById('edit_song').value = fullData.song;
                document.getElementById('edit_price').value = fullData.price;
                document.getElementById('edit_rose').value = fullData.rose;
                document.getElementById('edit_rose_percent').value = fullData.rose_percent;
                document.getElementById('edit_type').value = fullData.type;
                document.getElementById('edit_delivered_enough').value = fullData.delivered_enough;
                document.getElementById('edit_xa').value = fullData.xa;
                document.getElementById('edit_x').value = fullData.x;
                document.getElementById('edit_mold').value = fullData.mold;
                document.getElementById('edit_n_color').value = fullData.n_color;
                document.getElementById('edit_in').value = fullData.in;
                document.getElementById('edit_in_n').value = fullData.in_n;
                document.getElementById('edit_mang').value = fullData.mang;
                document.getElementById('edit_mang_n').value = fullData.mang_n;
                document.getElementById('edit_be').value = fullData.be;
                document.getElementById('edit_be_n').value = fullData.be_n;
                document.getElementById('edit_chap').value = fullData.chap;
                document.getElementById('edit_chap_n').value = fullData.chap_n;
                document.getElementById('edit_dong').value = fullData.dong;
                document.getElementById('edit_dong_n').value = fullData.dong_n;
                document.getElementById('edit_dan').value = fullData.dan;
                document.getElementById('edit_dan_n').value = fullData.dan_n;
                document.getElementById('edit_other').value = fullData.other;
                document.getElementById('edit_other_n').value = fullData.other_n;
                document.getElementById('edit_id_custom').value = fullData.id_custom;

                var valueToSelect = fullData.unit_id;
                $('#edit_dvt_select').val(valueToSelect).trigger('change');
            }
        }
    });
}

// {{-- Load select --}}

window.onload = function () {
    let authToken = localStorage.getItem('authToken') || "";
    let csrfToken = $('meta[name="csrf-token"]').attr('content');
    var domain = document.documentElement.getAttribute('data-domain');
    $.ajax({
        type: 'GET',
        url: domain + '/api/v1/unit',
        headers: {
            'Authorization': 'Bearer ' + authToken,
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (data) {
            if (data.data != undefined && data.data != []) {
                let fullData = data.data;
                let dvt_select = document.getElementById('dvt_select');
                // let edit_dvt_select = document.getElementById('edit_dvt_select');
                fullData.forEach(element => {
                    let newOption = document.createElement("option");
                    newOption.value = element.id;
                    newOption.text = element.name;
                    dvt_select.appendChild(newOption);
                    let newOption2 = document.createElement("option");
                    newOption2.value = element.id;
                    newOption2.text = element.name;
                    edit_dvt_select.appendChild(newOption2);
                });
            }
        }
    });
    // Thực hiện onload ở body
    var bodyElement = document.querySelector('body');
    var onLoadAttribute = bodyElement.getAttribute('onload');
    if (onLoadAttribute) {
        eval(onLoadAttribute);
    }
};
