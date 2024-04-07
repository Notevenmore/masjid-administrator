function chart(id, data) {
    return new Chart(document.getElementById(id).getContext("2d"), {
        type: "line",
        data: data,
        options: {
            plugins: {
                legend: false, // Hide legend
            },
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
}

var barChartPemasukan = chart("bar-pemasukkan", dataPemasukan);
var barChartPengeluaran = chart("bar-pengeluaran", dataPengeluaran);
var barChartRekapitulasi = chart("bar-rekapitulasi", dataRekapitulasi);
var barChartPerbandingan = chart("bar-perbandingan", dataPerbandingan);
