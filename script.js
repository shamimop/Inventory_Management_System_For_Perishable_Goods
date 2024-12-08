
// Your JavaScript code here
fetch('fetchgraphdata.php')
    .then(response => response.json())
    .then(data => {
        const labels = data.map(entry => entry.Crop_Quality);
        const values = data.map(entry => entry.Total_Farms);

        const ctx = document.getElementById('cropQualityChart').getContext('2d');
        const cropQualityChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Farms',
                    data: values,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Crop Quality'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Farms'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching data:', error));
