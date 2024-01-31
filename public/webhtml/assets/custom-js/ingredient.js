// {{-- validate form --}}

document.addEventListener('DOMContentLoaded', function () {
    let validateF = {
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Tên nguyên liệu không được trống'
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
    fv_ingredient = FormValidation.formValidation(formAddNewRecord, validateF);
    fromEdit = document.getElementById('editUserForm');
    fvEdit_ingredient = FormValidation.formValidation(fromEdit, validateF);
});

function submitForm() {
    fv_ingredient.validate().then(function (status) {
        if (status === 'Valid') {
            // Nếu tất cả đều thoả mãn, trả về true
            document.getElementById("form-add-new-record").submit();
        } else {

        }
    });
}

function submitFormEdit() {
    fvEdit_ingredient.validate().then(function (status) {
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
    editForm.action = domain + '/ingredient/update/' + id;

    $.ajax({
        type: 'GET',
        url: domain + '/api/v1/ingredient/' + id,
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
                document.getElementById('edit_name-title').textContent = fullData.name;
                document.getElementById('edit_length').value = fullData['length'];
                document.getElementById('edit_width').value = fullData.width;
                document.getElementById('edit_height').value = fullData.height;
                document.getElementById('edit_buying_price').value = fullData.buying_price;
                document.getElementById('edit_selling_price').value = fullData.selling_price;
                var valueToSelect = fullData.unit_id;
                $('#edit_dvt_select').val(valueToSelect).trigger('change');
            }
        }
    });
}



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
                let edit_dvt_select = document.getElementById('edit_dvt_select');
                if (dvt_select)
                    fullData.forEach(element => {
                        let newOption = document.createElement("option");
                        newOption.value = element.id;
                        newOption.text = element.name;
                        dvt_select.appendChild(newOption);
                    });
                if (edit_dvt_select)
                    fullData.forEach(element => {
                        let newOption = document.createElement("option");
                        newOption.value = element.id;
                        newOption.text = element.name;
                        edit_dvt_select.appendChild(newOption);
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
