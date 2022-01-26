<!-- Bubble -->
<div class="row mt-4">
    <div class="col-sm-6">
        <div class="card" id="bubble1"></div>
    </div>

    <script type="text/javascript">
        Highcharts.chart('bubble1', {
            chart: {
                type: 'packedbubble',
                height: '100%'
            },
            title: {
                text: 'Jumlah Kerusakan berdasarkan Pemegang BMN dan Fungsi'
            },
            tooltip: {
                useHTML: true,
                pointFormat: '<b>{point.name}:</b> {point.value}'
            },
            plotOptions: {
                packedbubble: {
                    minSize: '5%',
                    maxSize: '120%',
                    zMin: 0,
                    zMax: 15,
                    layoutAlgorithm: {
                        splitSeries: false,
                        gravitationalConstant: 0.02
                    },
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}',
                        filter: {
                            property: 'y',
                            operator: '>',
                            value: 15
                        },
                        style: {
                            color: 'black',
                            textOutline: 'none',
                            fontWeight: 'normal'
                        }
                    }
                }
            },
            series: [
                <?php 
                    foreach($fungsis as $i => $fungsi){
                        echo "{name:'$fungsi->nama',data:[";
                        foreach($pegawais[$i] as $j => $pegawai){
                            if($pegawaiX[$i][$j]>0){
                                echo "{name:'$pegawai->nama_pegawai',value:".$pegawaiX[$i][$j]."},";
                            }
                        }
                        echo "]},";           
                    } 
                ?>
            ]
        });
    </script>

    <div class="col-sm-6">
        <div class="card" id="bubble2"></div>
    </div>

    <script type="text/javascript">
        Highcharts.chart('bubble2', {
            chart: {
                type: 'packedbubble',
                height: '100%'
            },
            title: {
                text: 'Jumlah Kerusakan berdasarkan Jenis Barang dan Merek'
            },
            tooltip: {
                useHTML: true,
                pointFormat: '<b>{point.name}:</b> {point.value}'
            },
            plotOptions: {
                packedbubble: {
                    minSize: '5%',
                    maxSize: '120%',
                    zMin: 0,
                    zMax: 15,
                    layoutAlgorithm: {
                        splitSeries: false,
                        gravitationalConstant: 0.02
                    },
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}',
                        filter: {
                            property: 'y',
                            operator: '>',
                            value: 15
                        },
                        style: {
                            color: 'black',
                            textOutline: 'none',
                            fontWeight: 'normal'
                        }
                    }
                }
            },
            series: [
                <?php 
                    foreach($permintaans as $i => $permintaan){
                        echo "{name:'$permintaan->nama_permintaan',data:[";
                        foreach($types[$i]->unique('id_merk') as $j => $type){
                            if($typeX[$i][$j]>0){
                                echo "{name:'$type->nama_merk',value:".$typeX[$i][$j]."},";
                            }
                        }
                        echo "]},";           
                    } 
                ?>
            ]
        });
    </script>
</div>
<!-- Bubble end -->