$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let $btnSearch = $("button#btn-search");
    let $inputSearchField = $("input[name = search_field]"); //hidden
    let $inputSearchValue = $("input[name = search_value]");

    // chọn filed cần search
    $(".select-field").click(function () {
        // Lấy giá trị của data-field từ mục được chọn
        var searchType = $(this).data("field");
        // Gán giá trị cho input hidden
        $inputSearchField.val(searchType);

        // Thay đổi nội dung của button thành giá trị của data-field
        $("#selectDataField").text($(this).text());
    });

    // nút search
    $btnSearch.click(function (e) {
        let params = ["page", "filter_status", "select_field", "select_value"];
        let pathname = window.location.pathname; // /admin/sliders
        let searchField =
            $inputSearchField.val() == "" ? "all" : $inputSearchField.val();
        let searchValue = $inputSearchValue.val();

        // lấy params hiện tại có trên thanh địa chỉ
        let link = "";
        let searchParams = new URLSearchParams(window.location.search);
        $.each(params, function (key, value) {
            if (searchParams.has(value)) {
                link += value + "=" + searchParams.get(value) + "&";
            }
        });

        if (searchValue.replace(/\s/g, "") == "") {
            alert("Nhập giá trị cần tìm");
        } else {
            window.location.href =
                pathname +
                "?" +
                link +
                "search_field=" +
                searchField +
                "&search_value=" +
                searchValue.replace(/\s+/g, "+").toLowerCase();
        }
    });

    // ================== DELETE SLIDER ====================
    $(".item_delete").on("click", function (e) {
        if (confirm("Xóa mục này?")) {
            var id = $(this).data("id");
            var type = $(this).data("type");
            $.ajax({
                url: "/admin/" + type + "/" + id,
                type: "DELETE",
                data: {
                    id: id,
                },
                success: function (response) {
                    if (response.success) {
                        window.location.reload();
                    } else {
                        alert("Xóa mục không thành công");
                    }
                },
                error: function () {
                    alert("Đã có lỗi xảy ra");
                },
            });
        }
    });
});
