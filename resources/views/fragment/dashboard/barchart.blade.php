<!-- Barchart -->
<div class="card mt-4 p-2">
    <div class="d-flex justify-content-center" id="bcbarangrusak"></div>
</div>

<script type="text/javascript">
    Highcharts.chart('bcbarangrusak', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Jumlah Keluhan Barang TI'
        },
        subtitle: {
            text: 'Berdasarkan Fungsi/Bagian'
        },
        xAxis: {
            categories: [
                <?php 
                    foreach($fungsis as $i => $fungsi){
                        echo "'$fungsi->nama',";
                    } 
                ?>
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Banyak Permintaan'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Jumlah Keluhan',
            data: [
                <?php 
                    for($i=2;$i<=7;$i++){
                        echo "$rusakF[$i],";
                    } 
                ?>
            ]
        }, {
            name: 'Sedang Proses',
            data: [
                <?php 
                    for($i=2;$i<=7;$i++){
                        echo "$prosesF[$i],";
                    } 
                ?>
            ]
        }, 
        {
            name: 'Sudah Selesai',
            data: [
                <?php 
                    for($i=2;$i<=7;$i++){
                        echo "$selesaiF[$i],";
                    } 
                ?>
            ]
        }]
    });
</script>
<!-- Barchart end -->