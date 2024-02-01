// {{-- validate form --}}

document.addEventListener('DOMContentLoaded', function () {
    let validateF = {
        fields: {
           
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
    fv_bank = FormValidation.formValidation(formAddNewRecord, validateF);
    fromEdit = document.getElementById('editUserForm');
    fvEdit_bank = FormValidation.formValidation(fromEdit, validateF);
});

function submitForm() {
    fv_bank.validate().then(function (status) {
        if (status === 'Valid') {
            // Nếu tất cả đều thoả mãn, trả về true
            document.getElementById("form-add-new-record").submit();
        } else {

        }
    });
}

function submitFormEdit() {
    fvEdit_bank.validate().then(function (status) {
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

    var editForm = document.getElementById('editForm');
    editForm.action = domain + '/export-order/update/' + id;

    $.ajax({
        type: 'GET',
        url: domain + '/api/v1/export-order/' + id,
        headers: {
            'Authorization': 'Bearer ' + authToken,
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (data) {
            if (data.data != undefined && data.data != []) {
                let fullData = data.data;
                $('#customer_select').val(fullData.customer_id).trigger('change');
                $('#finished_product_select').val(fullData.finished_product_id).trigger('change');
                $('#status_select').val(fullData.status).trigger('change');
                document.getElementById('edit_count').value = fullData.count;
                document.getElementById('edit_delivery_date').value = fullData.delivery_date;
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
        url: domain + '/api/v1/customer',
        headers: {
            'Authorization': 'Bearer ' + authToken,
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (data) {
            if (data.data != undefined && data.data != []) {
                let fullData = data.data;
                let customer_select = document.getElementById('customer_select');
                let customer_select_add = document.getElementById('customer_select_add');
                if (customer_select)
                    fullData.forEach(element => {
                        let newOption = document.createElement("option");
                        newOption.value = element.id;
                        newOption.text = element.id_custom + "|\t" + element.name;
                        customer_select.appendChild(newOption);
                    });
                if (customer_select_add)
                    fullData.forEach(element => {
                        let newOption = document.createElement("option");
                        newOption.value = element.id;
                        newOption.text = element.id_custom + "|\t" + element.name;
                        customer_select_add.appendChild(newOption);
                    });
            }
        }
    });

    $.ajax({
        type: 'GET',
        url: domain + '/api/v1/finished-product',
        headers: {
            'Authorization': 'Bearer ' + authToken,
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (data) {
            if (data.data != undefined && data.data != []) {
                let fullData = data.data;
                let finished_product_select = document.getElementById('finished_product_select');
                let finished_product_select_add = document.getElementById('finished_product_select_add');
                if (finished_product_select)
                    fullData.forEach(element => {
                        let newOption = document.createElement("option");
                        newOption.value = element.id;
                        newOption.text = element.id_custom + "|\t" + element.name;
                        finished_product_select.appendChild(newOption);
                    });
                if (finished_product_select_add)
                    fullData.forEach(element => {
                        let newOption = document.createElement("option");
                        newOption.value = element.id;
                        newOption.text = element.id_custom + "|\t" + element.name;
                        finished_product_select_add.appendChild(newOption);
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
