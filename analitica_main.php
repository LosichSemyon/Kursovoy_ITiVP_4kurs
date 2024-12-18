<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Круговая диаграмма</title>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
 
    <h2>Анализ загруженности склада</h2>

    
    <canvas id="myChart" width="450" height="450"></canvas>

    <script>
        var jsonData = <?php json_encode(include 'analitica_serv.php'); ?>;
      
        var labels = jsonData.map(function(item) {
            return item.label;
        });

        var dataValues = jsonData.map(function(item) {
            return item.value;
        });

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(100, 200, 100, 0.7)',
                        'rgba(200, 100, 200, 0.7)',
                        'rgba(100, 100, 200, 0.7)',
                    ],
                }],
            },
        });

    
    </script>
</body>
</html>
