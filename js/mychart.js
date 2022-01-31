/* line chart */

var ctxL = document.getElementById("lineChart").getContext('2d');
var gradientFill = ctxL.createLinearGradient(0, 0, 0, 290);
gradientFill.addColorStop(0, "rgba(255, 134, 122, 1)");
gradientFill.addColorStop(1, "rgba(255, 134, 122, 0.1)");
var myLineChart = new Chart(ctxL, {
    type: 'line',
    data: {
        labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9"],
        datasets: [
            {
                label: 'Grafico mensile',
                data: [0, 65, 45, 65, 35, 65, 0],
                backgroundColor: gradientFill,
                borderColor: [
                    '#FF7A7A',
                ],
                borderWidth: 2,
                pointBorderColor: "#FF7A7A",
                pointBackgroundColor: "#FF7A7A",
            }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Costo',
                    fontColor: 'black'
                }
            }],
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Anni',
                    fontColor: 'black'
                }
            }]
        },
        responsive: true
    }
});

var ctxL1 = document.getElementById("lineChart1").getContext('2d');
var gradientFill1 = ctxL1.createLinearGradient(0, 0, 0, 290);
gradientFill1.addColorStop(0, "rgba(255, 0, 244, 1)");
gradientFill1.addColorStop(1, "rgba(255, 0, 244, 0.1)");
var myLineChart1 = new Chart(ctxL1, {
    type: 'line',
    data: {
        labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9"],
        datasets: [
            {
                label: 'Grafico totale',
                data: [0, 65, 45, 65, 35, 65, 0],
                backgroundColor: gradientFill1,
                borderColor: [
                    '#7A00FF',
                ],
                borderWidth: 2,
                pointBorderColor: "#7A00FF",
                pointBackgroundColor: "#7A00FF",
            }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Costo',
                    fontColor: 'black'
                }
            }],
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Anni',
                    fontColor: 'black'
                }
            }]
        },
        responsive: true
    }
});