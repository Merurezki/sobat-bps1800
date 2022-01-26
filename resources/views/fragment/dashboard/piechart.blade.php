<!-- Pie Chart -->
<div class="row mt-4">
    <div class="col-sm-6">
        <div class="card" id="paichart1"></div>
    </div>

    <script type="text/javascript">
        Highcharts.chart('paichart1', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Jumlah Kerusakan Berdasarkan Jenis Barang'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
            },
            // accessibility: {
            //     // point: {
            //     //     valueSuffix: '%'
            //     // }
            // },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Jenis',
                colorByPoint: true,
                data: [
                    <?php 
                        foreach($permintaans as $i => $permintaan){
                            if($permintaanX[$i]>0){
                                echo "{name:'$permintaan->nama_permintaan',y:$permintaanX[$i]},";
                            }
                        } 
                    ?>
                ]
            }]
        });
    </script>

    <div class="col-sm-6">
        <div class="card" id="paichart2"></div>
    </div>

    <script type="text/javascript">
        Highcharts.chart('paichart2', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Jumlah Kerusakan Barang berdasarkan Merek'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
            },
            // accessibility: {
            //     point: {
            //         valueSuffix: '%'
            //     }
            // },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Merek',
                colorByPoint: true,
                data: [
                    <?php 
                        foreach($merks as $i => $merk){
                            if($merkX[$i]>0){
                                echo "{name:'$merk->nama_merk',y:$merkX[$i]},";
                            }
                        } 
                    ?>
                ]
            }]
        });
    </script>

</div>
<!-- Pie Chart end -->