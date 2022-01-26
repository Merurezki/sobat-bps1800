<!-- Area Chart -->
<div class="card mt-4 p-2">
    <div class="d-flex justify-content-center" id="area"></div>
</div>

<script type="text/javascript">
    Highcharts.chart('area', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Jumlah Keluhan berdasarkan Status dan Waktu'
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 150,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
        },
        xAxis: {
            categories: [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ],
            plotBands: [{ // visualize the weekend
                from: 4.5,
                to: 6.5,
                color: 'rgba(68, 170, 213, .2)'
            }]
        },
        yAxis: {
            title: {
                text: 'Jumlah Barang'
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' units'
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
        series: [{
            name: 'Jumlah Keluhan',
            data: [
                <?php 
                    for($i=1;$i<=12;$i++){
                        echo "$rusakB[$i],";
                    } 
                ?>
            ]
        }, {
            name: 'Sedang Proses',
            data: [
                <?php 
                    for($i=1;$i<=12;$i++){
                        echo "$prosesB[$i],";
                    } 
                ?>
            ]
        }, {
            name: 'Sudah Selesai',
            data: [
                <?php 
                    for($i=1;$i<=12;$i++){
                        echo "$selesaiB[$i],";
                    } 
                ?>
            ]
        }]
    });
</script>
<!-- Area Chart end -->