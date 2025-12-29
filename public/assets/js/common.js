//Here we will write down all the common js functions which will be used across the application
function validateRequiredFields(formSelector) {
    let invalidFields = [];
    let messages = [];

    // Clear old states & messages
    $(formSelector).find(".is-invalid").removeClass("is-invalid");
    $(formSelector).find(".required-error").remove();

    // Loop all required fields
    $(formSelector)
        .find("[required]")
        .each(function () {
            let field = $(this);
            let type = field.attr("type");
            let name = field.attr("name");
            let label =
                $('label[for="' + field.attr("id") + '"]')
                    .text()
                    .trim() || name;

            let isEmpty = false;

            if (type === "radio" || type === "checkbox") {
                if ($('input[name="' + name + '"]:checked').length === 0) {
                    isEmpty = true;
                }
            } else if (field.is("select")) {
                if (!field.val() || field.val() === "") {
                    isEmpty = true;
                }
            } else {
                if (!field.val().trim()) {
                    isEmpty = true;
                }
            }

            if (isEmpty) {
                invalidFields.push(field);
                messages.push(label);

                // Add red border
                field.addClass("is-invalid");

                // Add inline message
                field.after(
                    '<small class="text-danger required-error">This field is required</small>'
                );

                // For radio/checkbox, mark first input
                if (type === "radio" || type === "checkbox") {
                    $('input[name="' + name + '"]').first().addClass("is-invalid");
                }
            }
        });

    // If invalid fields found
    if (invalidFields.length > 0) {
        let msg = messages.join(", ");

        let firstInvalid = invalidFields[0];

        $("html, body").animate(
            {
                scrollTop: firstInvalid.offset().top - 100,
            },
            400
        );

        firstInvalid.focus();

        return false;
    }

    return true;
}
async function sendRequest(url, method = "POST", formSelector = null, extraData = {}) {
    try {
        let headers = {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Accept": "application/json"
        };

        let bodyData = null;

        // If a form is passed, convert to FormData
        if (formSelector) {
            let form = document.querySelector(formSelector);
            bodyData = new FormData(form);
        }

        // Add extra data if provided
        if (extraData && Object.keys(extraData).length > 0) {
            if (!bodyData) bodyData = new FormData();
            for (const key in extraData) {
                bodyData.append(key, extraData[key]);
            }
        }

        // Fetch Call
        let response = await fetch(url, {
            method: method,
            headers: headers,
            body: (method !== "GET" ? bodyData : null)
        });

        let result = await response.json();

        // Handle Validation (422)
        if (response.status === 422) {
            let messages = [];
            Object.values(result.errors).forEach(err => messages.push(err[0]));
            throw new Error(messages.join("\n"));
        }

        // Handle Other Errors
        if (!response.ok) {
            throw new Error(result.message || "Something went wrong.");
        }

        return result;

    } catch (error) {
        console.error("Fetch Error:", error);
        return null;
    }
}
function showAlert({
    type = 'info',     // success | error | warning | info | validation
    message = '',
    messages = []
}) {
    return new Promise(resolve => {

        const config = {
            success:    { label: 'SUCCESS',    icon: 'bx-check-circle', bg: 'bg-success', text: 'text-success' },
            error:      { label: 'ERROR',      icon: 'bx-error',        bg: 'bg-danger',  text: 'text-danger' },
            warning:    { label: 'WARNING',    icon: 'bx-error-circle', bg: 'bg-warning', text: 'text-dark'  },
            info:       { label: 'INFO',       icon: 'bx-info-circle',  bg: 'bg-info',    text: 'text-primary' },
            validation: { label: 'VALIDATION', icon: 'bx-shield-x',     bg: 'bg-danger',  text: 'text-danger' }
        };

        if (!config[type]) type = 'info';

        const modalEl  = document.getElementById('globalAlertModal');
        const modal    = new bootstrap.Modal(modalEl);

        const headerEl = document.getElementById('globalAlertHeader');
        const titleEl  = document.getElementById('globalAlertTitle');

        const iconEl   = document.getElementById('globalAlertIcon');
        const typeEl   = document.getElementById('globalAlertType');
        const msgEl    = document.getElementById('globalAlertMessage');
        const listEl   = document.getElementById('globalAlertList');

        const okBtn      = document.getElementById('globalAlertOkBtn');
        const cancelBtn  = document.getElementById('globalAlertCancelBtn');
        const confirmBtn = document.getElementById('globalAlertConfirmBtn');

        /* ================= RESET EVERYTHING ================= */
        headerEl.classList.remove('bg-success','bg-danger','bg-warning','bg-info');
        titleEl.classList.remove('text-white','text-dark');

        okBtn.classList.add('d-none');
        cancelBtn.classList.add('d-none');
        confirmBtn.classList.add('d-none');

        listEl.classList.add('d-none');
        listEl.innerHTML = '';

        /* ================= APPLY TYPE ================= */
        const { label, icon, bg, text } = config[type];

        headerEl.classList.add(bg);
        titleEl.classList.add(text);
        titleEl.textContent = label;

        iconEl.className = `bx ${icon} fs-1 ${text}`;
        typeEl.textContent = label;
        typeEl.className = `fw-bold ${text}`;

        msgEl.textContent = message;

        if (messages.length) {
            listEl.classList.remove('d-none');
            messages.forEach(err => {
                const li = document.createElement('li');
                li.textContent = err;
                listEl.appendChild(li);
            });
        }

        /* ================= ALERT MODE ================= */
        okBtn.classList.remove('d-none');
        okBtn.onclick = () => modal.hide();

        modalEl.addEventListener(
            'hidden.bs.modal',
            () => resolve(true),
            { once: true }
        );

        modal.show();
    });
}



