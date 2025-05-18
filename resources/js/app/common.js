$(function () {
    // Initialize DataTable
    console.log("common initialized");
    //$('#city_name').find('option').remove();

    //update stock status
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.menu-switch-input').on('change', function () {
        var menuId = $(this).data('menu-id');
        var newStatus = $(this).is(':checked') ? 1 : 0;
        var url = $(this).data('url');
        var statusTextElement = $(this).siblings('label').find('.status-text');

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                menuId: menuId,
                StockStatus: newStatus
            },
            success: function (response) {
                if (response.success) {
                    if (newStatus === 1) {
                        statusTextElement.text('Stock Available');
                    } else {
                        statusTextElement.text('Out Of Stock');
                    }
                } else {
                    console.log('Failed to update stock status');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                console.log('An error occurred while updating the stock status.');
            }
        });
    });

    //menu delete
    // var deleteUrl = '';

    // $('#deleteConfirmationModal').on('show.bs.modal', function (event) {
    //     var button = $(event.relatedTarget);
    //     deleteUrl = button.data('url');
    // });

    // $('#confirmDeleteButton').on('click', function() {
    //     window.location.href = deleteUrl;
    // });


    $(".back").on("click", () => history.back());

    VirtualSelect.init({
        ele: ".virtual-select",
        maxWidth: "100%",
        placeholder: "Select an option",
    });

    $(".filter-trigger").on("click", function () {
        $(".filter-body").toggle("fast");
    });

    $(".filter-clear").on("click", function () {
        $(".filter-body").find("input, select").val("");
        // $(".filter-body").toggle();
        let dtId = $(this).data("table-id");
        $("#" + dtId)
            .DataTable()
            .ajax.reload();
    });

    $(".filter-apply").on("click", function () {
        // $(".filter-body").toggle();
        let dtId = $(this).data("table-id");
        $("#" + dtId)
            .DataTable()
            .ajax.reload();
    });

    $(".img-container").on("click", function () {
        $(this).siblings("input[type=file]")[0].click();
    });

    $("input[type=file]").on("change", function () {
        let input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(input)
                    .siblings(".img-container")
                    .children("img.default")
                    .remove();
                $(input)
                    .siblings(".img-container")
                    .children("img")
                    .attr("src", e.target.result)
                    .removeClass("d-none");
            };

            reader.readAsDataURL(input.files[0]);
        }
    });

    $(document).on("click", ".destroy_btn", function () {
        Swal.fire({
            //title: "Are you sure?",
            text: $(this).attr("data-text"),
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCancelButton: true,
        }).then((response) => {
            if (response.isConfirmed) {
                var form_id = $(this).attr("data-origin");
                $("#" + form_id).submit();
            }
        });
    });

    $(document).on("click", ".menu_delete_btn", function () {
        Swal.fire({
            //title: "Are you sure?",
            text: $(this).attr("data-text"),
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCancelButton: true,
        }).then((response) => {
            if (response.isConfirmed) {
                var form_id = $(this).attr("data-origin");
                $("#" + form_id).submit();
            }
        });
    });

    $(document).on("click", ".change_status", function () {
        Swal.fire({
            //title: "Are you sure?",
            text: $(this).attr("data-text"),
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                var form_id = $(this).attr("data-origin");
                $("#" + form_id).submit();
            }
        });
    });

    $(document).on("click", ".change_suspend", function () {
        Swal.fire({
            //title: "Are you sure?",
            text: $(this).attr("data-text"),
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCancelButton: true,
        }).then((response) => {
            if (response.isConfirmed) {
                var form_id = $(this).attr("data-origin");
                $("#" + form_id).submit();
            }
        });
    });

    $("#approve_btn").on("click", async function () {
        Swal.fire({
            title: "Are you sure?",
            text: $(this).attr("data-text"),
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCancelButton: true,
        }).then((response) => {
            if (response.isConfirmed) {
                $(this).closest("form")[0].submit();
            }
        });
    });

    $(".city.virtual-select").on("change", function () {
        append_townships();
    });

    $(".group.virtual-select").on("change", function () {
        append_restaurants();
    });

    $(".reserve_status.virtual-select").on("change", function () {
        $("#reservation_status").val(
            $(".reserve_status.virtual-select").val() || null
        );
    });

    $(".order_info_status.virtual-select").on("change", function () {
        $("#order_info_status").val(
            $(".order_info_status.virtual-select").val() || null
        );
    });

    $(".status.virtual-select").on("change", function () {
        $("#status").val(
            $(".status.virtual-select").val() || null
        );
    });

    $("#allcheck").on("click", function () {
        toggle(this);
    });

    $(".promoter_check").on("change", function () {
        let isCheck = $(this).is(":checked");
        if (isCheck) {
            $(this)
                .parent()
                .siblings("input[type=number]")
                .attr("disabled", false);
            return;
        }
        $(this).parent().siblings("input[type=number]").attr("disabled", true);
        $(this).parent().siblings("input[type=number]").val("");
    });

    $(document).on("click", "#old_password_toggle", function () {
        const icon = $(this).find('i');
        const passwordField = $('#old_password');
        showHidePassword(passwordField, icon);
    });

    $(document).on("click", "#new_password_toggle", function () {
        const icon = $(this).find('i');
        const passwordField = $('#new_password');
        showHidePassword(passwordField, icon);
    });

    $(document).on("click", "#new_password_confirm_toggle", function () {
        const icon = $(this).find('i');
        const passwordField = $('#new_password_confirmation');
        showHidePassword(passwordField, icon);
    });
});

/**
 * Author : MTK
 * Updates the list of restaurants in a virtual select element based on the selected group.
 */
function append_restaurants() {
    let group_id = $(".group.virtual-select").val() || null;
    let old_restaurant_id = $(".restaurant.data").attr("data-old-id") || null;
    let url = $(".restaurant.data").attr("data-attr-url") + "/" + group_id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            console.log(data);
            if (data.status == true) {
                let options = [];
                $.each(data.data, function (index, restaurant) {
                    options[index] = {
                        label: restaurant.Name,
                        value: restaurant.RestaurantId,
                        selected: true
                    };
                });
                document.querySelector(".restaurant.virtual-select").setOptions(options);
                document.querySelector(".restaurant.virtual-select").setValue(old_restaurant_id)
            }
        },
    });
}


function append_townships() {
    let city_id = $(".city.virtual-select").val() || null;
    let old_township_id = $(".township.data").attr("data-old-id") || null;
    let url = $(".township.data").attr("data-attr-url") + "/" + city_id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            if (data.status == true) {
                let options = [];
                $.each(data.data, function (index, township) {

                    options[index] = {
                        label: township.TownshipName,
                        value: township.TownshipId,
                        selected: true,
                    };
                });
                document
                    .querySelector(".township.virtual-select")
                    .setOptions(options);
                document
                    .querySelector(".township.virtual-select")
                    .setValue(old_township_id);
            }
        },
    });
}


function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source) checkboxes[i].checked = source.checked;
    }
}

function showHidePassword(passwordField, icon) {
    const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
    passwordField.attr('type', type);
    if (type === 'password') {
        icon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
        icon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
}
