$("#paid").bind("change", function(e) {
    $(this).formatCurrency({
        symbol: "",
        positiveFormat: "%n %s",
        negativeFormat: "-%n %s",
        decimalSymbol: ".",
        digitGroupSymbol: ",",
        groupDigits: true,
        roundToDecimalPlace: 3
    });
    let balance = $("#amount").val() - $("#paid").val();
    $("#balance")
        .val(balance)
        .formatCurrency({
            symbol: "",
            positiveFormat: "%n %s",
            negativeFormat: "-%n %s",
            decimalSymbol: ".",
            digitGroupSymbol: ",",
            groupDigits: true,
            roundToDecimalPlace: 3
        });
});

$("#updateBtn").bind("click", function(e) {
    e.preventDefault();
    var getFormData = new FormData($("#order-form")[0]);
    var getCheckboxValue = $("#order-form").find("input[type=checkbox]");
    $.each(getCheckboxValue, function(key, value) {
        getFormData.append(
            $(value).attr("name"),
            $(value).is(":checked") ? 1 : 0
        );
    });

    getFormData.append("id", id);
    $.ajax({
        type: "POST",
        url: url,
        data: getFormData,
        dataType: "JSON",
        contentType: false,
        cache: false,
        processData: false,
        success: function(d) {
            isSuccess(d);
            if (d.status == 200) {
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        },
        error: function(xhr, status, error) {
            isError(xhr);
        }
    });
});
