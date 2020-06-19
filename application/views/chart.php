<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<canvas id="myChart"></canvas>
<script>
    var data_nama = [];
    var data_jumlah = [];

    $.post("<?=base_url('dashboard/getChart')?>",
        function(data) {
            var obj = JSON.parse(data);
            $.each(obj, function(test, item) {
                data_nama.push(item.cusnama);
                data_jumlah.push(item.pencre);

            });
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {
                    // labels: data_nama,
                    labels: 'nama',
                    datasets: [{
                        label: 'My First dataset',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: [0, 10, 5, 2, 20, 30, 45]
                        // data: data_jumlah,
                    }]
                },
                //Configuration options go here
                options: {}
            });
        });
</script>
</body>

</html>


 -->







<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <canvas id="myChart"></canvas>
    <script>
        
        $(function() {
            let labelsPenjualan = [];
            let dataPenjualan = [];
            bulan($bln)

            $.ajax({
                url: "<?=site_url('dashboard/getChart')?>",
                dataType: "json",
                success: function(data) {
                    data.forEach(function() {
                        labelsPenjualan.push(penjualan.bulan);
                        dataPenjualan.push(penjualan.total);
                    });
                }
            });
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',
                // The data for our dataset
                data: {
                    // labelks: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    labels: bulan(labelsPenjualan),
                    datasets: [{
                        label: 'Chart Penjualan',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        //data: [0, 10, 5, 2, 20, 30, 45]
                        // data: [5, 10, 15, 20, 2, 45, 45]
                        data: dataPenjualan
                    }]
                },

                //Configuration options go here
                options: {}
            });

        });
    </script>
</body>

</html>