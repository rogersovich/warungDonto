
<title>Laporan Harian</title>

<style>

    .container {
        width: 100%;
        margin-right: auto;
        margin-left: auto;
    }

    .table {
        font-family: sans-serif;
        color: #232323;
        border-collapse: collapse;

    }

    .table, th, td {
        font-weight: 300;
        font-size: 15px;
        padding: 2px 10px;
        text-align: center;
        border: 1px solid #999;
    }

    .table-none{
        font-family: sans-serif;
        color: #232323;
        border-collapse: collapse;
    }

    .table-none, .th, .td {
        font-weight: 300;
        font-size: 15px;
        padding: 2px 10px;
        text-align: center;
        border: none!important;
    }

    .bg-red{
        background: red;
    }

    .bg-blue{
        background: blue;
    }

    .text-center{
        text-align: center!important;
    }

    .text-right{
        text-align: right!important;
    }

    .text-left{
        text-align: left!important;
    }

    .wt-10{
        width: 10px;
    }

    .wt-50{
        width: 50px;
    }

    .wt-70{
        width: 70px;
    }

    .wt-100{
        width: 100px;
    }

    .wt-150{
        width: 150px;
    }

    .wt-200{
        width: 200px;
    }

    .wt-250{
        width: 250px;
    }

    .wt-300{
        width: 300px;
    }

    .wt-350{
        width: 350px;
    }

    .wt-550{
        width: 550px;
    }

    .wt-555{
        width: 555px;
    }

    .pl-150{
        padding-left: 150px;
    }

    .pr-150{
        padding-right: 150px;
    }

    .pb-50{
        padding-bottom: 50px;
    }

    .pt-50{
        padding-top: 50px;
    }

    .p-0{
        padding: 0px;
    }

    .f-20{
        font-size: 20px;
    }

</style>

@php
    $session = Session::get('user');
@endphp

<body class="pt-50 pb-50">
    <div class="">
        <h1>
            Laporan Mingguan -
            <span class="f-20">
                2019 11 08
            </span>
        </h1>
        <table class="table">
            <tr>
                <th rowspan="2" class="bg-blue">No</th>
                <th rowspan="2" class="bg-red wt-150">Nama Barang</th>
                <th rowspan="2" class="bg-blue">Harga Beli</th>
                <th rowspan="2" class="bg-red">Harga Jual</th>
                <th colspan="2" class="bg-blue">Pesedian Awal</th>
                <th colspan="2" class="bg-red">Penjualan</th>
                <th colspan="2" class="bg-blue">Persediaan Akhir</th>
                <th colspan="2" class="bg-red">Keterangan</th>
            </tr>
            <tr>
                <th class="">Jumlah</th>
                <th class="">Harga</th>
                <th class="">Jumlah</th>
                <th class="">Harga</th>
                <th class="">Jumlah</th>
                <th class="">Harga</th>
                <th class="" style="border-right: none;"></th>
                <th class="" style="border-left: none;"></th>
            </tr>
            <tr>
                <td >1</td>
                <td >Djarum Coklat - Pack - Rokok</td>
                <td >300000</td>
                <td >400000</td>
                <td >10</td>
                <td >1500000</td>
                <td >10</td>
                <td >1500000</td>
                <td >10</td>
                <td >1500000</td>
                <td >Untung</td>
                <td >Rugi</td>
            </tr>
        </table>
        <br><br>
        <table class="table-none">
            <tr>
                <td class="wt-555 text-left td">Total</td>
                <td class="wt-100 text-right td">
                    900000
                </td>
            </tr>
            <tr>
                <td class="wt-555 text-left td">Tunai</td>
                <td class="wt-100 text-right td">
                    1000000
                </td>
            </tr>
            <tr>
                <td class="wt-555 text-left td">Kembali</td>
                <td class="wt-100 text-right td">
                    10000
                </td>
            </tr>
        </table>
    </div>

</body>

