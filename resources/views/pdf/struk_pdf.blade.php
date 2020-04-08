
<title>Laporan</title>

<style>
    

    .container {
        width: 100%;
        padding-right: 5px;
        padding-left: 5px;
        margin-right: auto;
        margin-left: auto;
    }

    .table {
        font-family: sans-serif;
        color: #232323;
        border-collapse: collapse;
    }


    th, td {
        font-weight: 300;
        font-size: 12px;
    }

    .text-center{
        text-align: center;
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

    .pl-100{
        padding-left: 100px;
    }

    .pr-100{
        padding-right: 100px;
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

</style>

@php
    $session = Session::get('user');
@endphp

<body class="pt-50 pb-50">

    <div class="container">
        <p class="mt-3">
            Nama Toko Anda
            <br>
            Jl.absdfsdfsdfsdf
            <br>
            Telp (023)24223423423
            <br>
            {{ $data->code_report }}
        </p>
        <span>
            -------------------------------------------------------------------------------
        </span>
        <table class="table">
            <tr>
                <th class="wt-250">Nama Barang</th>
                <th class="wt-50 text-center">Jumlah</th>
                <th class="wt-50 text-center">Harga</th>
                <th class="wt-50 text-center">Subtotal</th>
            </tr>
        </table>
        <span>
            -------------------------------------------------------------------------------
        </span>
        <table class="table">
            @foreach ($order_details as $od)
            <tr>
                <td class="wt-250">{{ ucwords($od->product->name.' - '.$od->product->unit->name) }}</td>
                <td class="wt-50 text-center">{{ $od->qty }}</td>
                <td class="wt-50 text-center">{{ $od->product->harga_jual }}</td>
                <td class="wt-50 text-center">{{ $od->product->harga_jual * $od->qty }}</td>
            </tr>
            @endforeach
        </table>
        <span>
            -------------------------------------------------------------------------------
        </span>
        <table class="table">
            <tr>
                <td class="wt-350">Total</td>
                <td class="wt-100">
                    Rp {{ number_format($order->total_harga) }}
                </td>
            </tr>
            <tr>
                <td class="wt-350">Tunai</td>
                <td class="wt-100">
                    Rp {{ number_format($order->total_bayar) }}
                </td>
            </tr>
            <tr>
                <td class="wt-350">Kembali</td>
                <td class="wt-100">
                    Rp {{ number_format($order->kembalian) }}
                </td>
            </tr>
        </table>
        <span>
            -------------------------------------------------------------------------------
        </span>
        <div class="container text-center pr-100 pl-100 pt-50">
            <p>
                Terima Kasih & Selamat Berbelanja Kembali
                <br><br>
                Pembeli Adalah Raja Kami
            </p>
        </div>
    </div>

</body>

