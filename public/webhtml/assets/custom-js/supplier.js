// {{-- validate form --}}

document.addEventListener('DOMContentLoaded', function () {
    let validateF = {
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Tên nhà cung cấp không được trống'
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
    fv_supplier = FormValidation.formValidation(formAddNewRecord, validateF);
    fromEdit = document.getElementById('editUserForm');
    fvEdit_supplier = FormValidation.formValidation(fromEdit, validateF);
});

function submitForm() {
    fv_supplier.validate().then(function (status) {
        if (status === 'Valid') {
            // Nếu tất cả đều thoả mãn, trả về true
            document.getElementById("form-add-new-record").submit();
        } else {

        }
    });
}

function submitFormEdit() {
    fvEdit_supplier.validate().then(function (status) {
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
    editForm.action = domain + '/supplier/update/' + id;

    $.ajax({
        type: 'GET',
        url: domain + '/api/v1/supplier/' + id,
        headers: {
            'Authorization': 'Bearer ' + authToken,
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (data) {
            if (data.data != undefined && data.data != []) {
                let fullData = data.data;
                console.log(fullData);
                document.getElementById('edit_name').value = fullData.name;
                document.getElementById('edit_address').value = fullData.address;
                document.getElementById('edit_mst').value = fullData.mst;
                document.getElementById('edit_stk').value = fullData.stk;
                document.getElementById('edit_phone_number').value = fullData.phone_number;
                document.getElementById('edit_note').value = fullData.note;
                document.getElementById('edit_contact').value = fullData.contact;
                document.getElementById('edit_note').value = fullData.note;
                document.getElementById('edit_name-title').textContent = fullData.name;

                var selectElement = document.getElementById('edit_bank_select');
                var options = selectElement.options;

                var valueToSelect = fullData.bank_id;
                $('#edit_bank_select').val(valueToSelect).trigger('change');
            }
        }
    });
}


// {{-- Load banks --}}

window.onload = function () {
    let authToken = localStorage.getItem('authToken') || "";
    let csrfToken = $('meta[name="csrf-token"]').attr('content');
    var domain = document.documentElement.getAttribute('data-domain');
    $.ajax({
        type: 'GET',
        url: domain + '/api/v1/bank',
        headers: {
            'Authorization': 'Bearer ' + authToken,
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (data) {
            if (data.data != undefined && data.data != []) {
                let fullData = data.data;
                let bank_select = document.getElementById('bank_select');
                let edit_bank_select = document.getElementById('edit_bank_select');
                fullData.forEach(element => {
                    let newOption = document.createElement("option");
                    newOption.value = element.id;
                    newOption.text = element.name + " \t (" + element.code + ")";
                    bank_select.appendChild(newOption);
                    let newOption2 = document.createElement("option");
                    newOption2.value = element.id;
                    newOption2.text = element.name + " \t (" + element.code + ")";
                    edit_bank_select.appendChild(newOption2);
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
