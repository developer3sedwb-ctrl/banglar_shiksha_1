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
        alert("Please fill required fields:\n\n" + msg);

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
        alert(error.message);
        console.error("Fetch Error:", error);
        return null;
    }
}

