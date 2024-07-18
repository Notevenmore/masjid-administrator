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
                    alert("Pembayaran Uang kas berhasil dilakukan!");
                },
                onPending: function (result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                },
                onError: function (result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                },
                onClose: function () {
                    /* You may add your own implementation here */
                    alert(
                        "Jika kamu keluar dari pop up pembayaran, maka pembayaran akan terdaftar batal dilakukan!"
                    );
                },
            });
        },
    });
});
