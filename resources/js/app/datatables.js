$(function () {
    var brand_list = $("#brand_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $("#index_route_route").val(),
            data: function (data) { },
        },
        columns: [
            {
                data: "DT_RowIndex", name: "DT_RowIndex",
                orderable: false,
                searchable: false,
                class: "text-left"
            },
            { data: "logo_url", name: "logo_url" },
            { data: "name", name: "name" },
            { data: "website_url", name: "website_url" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
                class: "td-actions",
            },
        ],
        scrollX: true,
    });

    var spec_category_list = $("#spec_category_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $("#index_route_route").val(),
            data: function (data) { },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
                class: "text-left"
            },
            { data: "name", name: "name" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
                class: "td-actions",
            },
        ],
        scrollX: true,
    });

    var spec_list = $("#spec_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $("#index_route_route").val(),
            data: function (data) { },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
                class: "text-left"
            },
            { data: "brand_name", name: "brand_name" },
            { data: "device_name", name: "device_name" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
                class: "text-center",
            },
        ],
        scrollX: true,
    });

    var device_list = $("#device_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $("#index_route_route").val(),
            data: function (data) { },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
                class: "text-left"
            },
            { data: "brand_name", name: "brand_name" },
            { data: "name", name: "name" },
            { data: "release_date", name: "release_date" },
            { data: "price", name: "price" },
            { data: "image_url", name: "image_url" },
            { data: "os", name: "os" },
            { data: "device_type", name: "device_type" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
                class: "td-actions",
            },
        ],
        scrollX: true,
    });

    var review_list = $("#review_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $("#index_route_route").val(),
            data: function (data) { },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
                class: "text-left"
            },
            { data: "device_name", name: "device_name" },
            { data: "user_name", name: "user_name" },
            { data: "heading", name: "heading" },
            { data: "image_1", name: "image_1" },
            { data: "image_2", name: "image_2" },
            { data: "rating", name: "rating" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
                class: "td-actions",
            },
        ],
        scrollX: true,
    });
});
