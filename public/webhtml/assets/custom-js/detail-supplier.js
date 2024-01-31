
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
    fromEdit = document.getElementById('editForm');
    fvEdit_supplier = FormValidation.formValidation(fromEdit, validateF);
});


function submitFormEdit() {
    fvEdit_supplier.validate().then(function (status) {
        if (status === 'Valid') {
            // Nếu tất cả đều thoả mãn, trả về true
            // document.getElementById("editFinishedProductForm").submit();
        } else {

        }
    });
}


// {{-- modal edit --}}
// {{-- Load form --}}

function editRecord(id) {
    let authToken = localStorage.getItem('authToken') || "";
    let csrfToken = $('meta[name="csrf-token"]').attr('content');
    var domain = document.documentElement.getAttribute('data-domain');

    var editForm = document.getElementById('editForm');
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


// {{-- Load bank --}}

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
                let edit_bank_select = document.getElementById('edit_bank_select');
                let bank_qr = document.getElementById('bank_qr');
                if (bank_qr)
                    fullData.forEach(element => {
                        // Cho load mã QR code
                        let newOption = document.createElement("option");
                        newOption.value = element.code;
                        newOption.text = element.name;
                        bank_qr.appendChild(newOption);
                    });
                if (edit_bank_select)
                    fullData.forEach(element => {
                        let newOption = document.createElement("option");
                        newOption.value = element.id;
                        newOption.text = element.name;
                        edit_bank_select.appendChild(newOption);
                    });

                var valueToSelect = code;
                $('#bank_qr').val(valueToSelect).trigger('change');
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


// {{-- QR --}}

function changeQR() {
    let code = document.getElementById('bank_qr').value;
    let stk = document.getElementById('stk').value;
    let money = document.getElementById('money').value;
    let content = document.getElementById('content').value;
    let src = "https://api.vietqr.io/" + code + "/" + stk + "/" + money + "/" + content + "/vietqr_net_2.jpg";
    document.getElementById('qrcode').src = src;
}
