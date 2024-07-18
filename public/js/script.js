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
function barchart(id, data) {
    return new Chart(document.getElementById(id).getContext("2d"), {
        type: "bar",
        data: data,
        options: {
            indexAxis: "y",
            plugins: {
                legend: false, // Hide legend
            },
            scales: {
                x: {
                    beginAtZero: true,
                },
            },
        },
    });
}
function pieChart(id, data) {
    return new Chart(document.getElementById(id).getContext("2d"), {
        type: "pie",
        data: data,
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: "right",
                    align: "center",
                }, // Hide legend
            },
            responsive: false,
            maintainAspectRatio: false,
        },
    });
}
var dataRekapitulasi = {
    labels: rekapitulasi["tanggal"],
    datasets: [
        {
            label: "Pemasukkan Harian",
            data: rekapitulasi["total"],
            backgroundColor: ["#05934A"],
        },
    ],
};
var dataPemasukan = {
    labels: pemasukan.map(function (item) {
        return item.category;
    }),
    datasets: [
        {
            data: pemasukan.map(function (item) {
                return item.nominal;
            }),
            backgroundColor: pemasukan.map(function (item) {
                return getRandomColor();
            }),
        },
    ],
};
var dataPengeluaran = {
    labels: pengeluaran.map(function (item) {
        return item.category;
    }),
    datasets: [
        {
            data: pengeluaran.map(function (item) {
                return item.nominal;
            }),
            backgroundColor: pengeluaran.map(function (item) {
                return getRandomColor();
            }),
        },
    ],
};
var barChartRekapitulasi = chart("bar-rekapitulasi", dataRekapitulasi);
var barChartPemasukan = barchart("bar-pemasukan", dataPemasukan);
var barChartPemasukan = barchart("bar-pengeluaran", dataPengeluaran);
var piechart = document.querySelector(".pie-chart #report-info");
recapKas.forEach((element, index) => {
    if (index % 2 == 0) {
        const reportcontent = document.createElement("div");
        reportcontent.className = "report-content";
        reportcontent.style = "margin-top: 30px";
        piechart.appendChild(reportcontent);
    }
    const reportcontent = piechart.querySelectorAll(".report-content");
    const perbandingan = document.createElement("div");
    perbandingan.className = "perbandingan";
    perbandingan.style = "display: flex; align-items: center; height: 200px;";
    const heading = document.createElement("div");
    heading.className = "heading";
    const textpart = document.createElement("div");
    textpart.className = "text-part";
    const h3 = document.createElement("h3");
    h3.innerHTML = `Uang Kas ${element.tanggal}`;
    textpart.appendChild(h3);
    heading.appendChild(textpart);
    perbandingan.appendChild(heading);
    const graph = document.createElement("div");
    graph.className = "graph";
    const canvas = document.createElement("canvas");
    canvas.id = `recap-${index}`;
    graph.appendChild(canvas);
    perbandingan.appendChild(graph);
    reportcontent[Math.floor(index / 2)].appendChild(perbandingan);
    const dataKas = {
        labels: ["Telah Membayar", "Belum Membayar"],
        datasets: [
            {
                label: `lunas sebanyak ${element.userpaided} dari ${countJamaah} jamaah`,
                data: [element.userpaided, countJamaah - element.userpaided],
                backgroundColor: ["#05934A", "#EA3C53"],
            },
        ],
    };
    pieChart(`recap-${index}`, dataKas);
    console.log(canvas.width, canvas.height);
});
