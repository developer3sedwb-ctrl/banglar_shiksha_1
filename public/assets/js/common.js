//Here we will write down all the common js functions which will be used across the application
function validateRequiredFields(formSelector) {
    let invalidFields = [];
    let messages = [];

    // Clear old states
    $(formSelector).find(".is-invalid").removeClass("is-invalid");

    // Loop all fields with "required"
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
                messages.push(label + " is required");

                if (type === "radio" || type === "checkbox") {
                    $('input[name="' + name + '"]')
                        .first()
                        .addClass("is-invalid");
                } else {
                    field.addClass("is-invalid");
                }
            }
        });

    if (invalidFields.length > 0) {
        alert("Please fill required fields:\n\n" + messages.join("\n"));

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
function saveDataByAjax(formSelector, url) {
    try {
        let formData = $(formSelector).serialize();
        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: formData,
            success: function (response) {
                console.log(response);
                if (response.status) {
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Default error message
                let errorMessage = "An error occurred.";

                // Laravel validation error
                if (xhr.status === 422) {
                    let messages = [];

                    // Extract all validation error messages
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        messages.push(value[0]);
                    });

                    errorMessage = messages.join("\n");
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                alert(errorMessage);
                console.error("AJAX Validation Error:", xhr.responseJSON);
            },
        });
    } catch (err) {
        console.error("JavaScript Error:", err);
        alert("Something went wrong! Check console.");
    }
}
