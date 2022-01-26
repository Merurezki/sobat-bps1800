<!-- Table -->
<div class="card mt-4 p-2">
    <h3 class="text-center">Rangkuman Keluhan Barang TI</h3>
    <table class="table table-striped table-hover">

        <thead class="text-center">
            <tr>
                <th scope="col" rowspan="2">Fungsi</th>
                <th scope="col" colspan="3">Jumlah Barang TI</th>
            </tr>
            <tr>
                <th scope="col" >Total Keluhan</th>
                <th scope="col" >Sedang Proses</th>
                <th scope="col" >Sudah Selesai</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($fungsis as $i => $fungsi)
            <tr>
                <td>{{ $fungsi->nama }}</td>
                <td class="text-center">{{ $rusakF[++$i] }}</td>
                <td class="text-center">{{ $prosesF[$i] }}</td>
                <td class="text-center">{{ $selesaiF[$i] }}</td>
            </tr>
        @endforeach
        </tbody>

        <tfoot>
            <tr class="text-center">
                <th scope="col">Jumlah</th>
                <th scope="col" >{{ $card[10] }}</th>
                <th scope="col" >{{ $card[20] }}</th>
                <th scope="col" >{{ $card[30] }}</th>
            </tr>
        </tfoot>

    </table>
</div>
<!-- Table end -->