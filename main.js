const ctx = document.getElementById('tradingSignalChart').getContext('2d');
const chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [], // This will hold the x-axis labels (e.g., timestamps)
        datasets: [{
            label: 'Trading Signal',
            data: [], // This will hold the trading signal values
            borderColor: 'rgba(75, 192, 192, 1)',
            tension: 0.1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

function fetchTradingSignalData() {
    fetch('index.php')
        .then(response => response.json())
        .then(data => {
            // Update the chart with the new data
            chart.data.labels.push(data.timestamp);
            chart.data.datasets[0].data.push(data.tradingSignal);
            chart.update();
        })
        .catch(error => {
            console.error('Error fetching trading signal data:', error);
        });
}

// Fetch trading signal data every 5 seconds
setInterval(fetchTradingSignalData, 5000);
