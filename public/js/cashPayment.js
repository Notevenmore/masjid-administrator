$("#cashPaymentForm").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
        url: url,
        method: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response.snapToken);
            window.snap.pay(response.snapToken, {
                onSuccess: function (result) {
                    window.location.href = urlafter;
                },
                onPending: function (result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function (result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function () {
                    /* You may add your own implementation here */
                    alert("you closed the popup without finishing the payment");
                },
            });
        },
    });
});
