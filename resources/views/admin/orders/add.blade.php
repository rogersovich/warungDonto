@extends('layouts.element.main')

@section('title', 'Categories - Add')

@section('custom-css')
    <style>
        .breadcrumb-item + .breadcrumb-item::before{
            content: '-';
            color: #5e72e4;
        }
    </style>
@endsection

@section('content')

@php
    $session = Session::get('user');
@endphp

@include('layouts.element.navbar')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7 pb-4">
    <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-1">
            <div class="row">
                <div class="col-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-links" style="background:none;">
                            <li class="breadcrumb-item">
                                <a href="javascript:;">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Categories
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-4 text-right">

                </div>
            </div>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush" id="table-category">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Action</th>
                </tr>

            </thead>
            <tbody>
            <form action="{{ route('orders.store') }}" method="POST">
            @csrf
                @php
                    $no = 1;
                @endphp
                @foreach ($carts as $c)
                <tr>
                    <td>
                        {{ $no }}
                        <input type="hidden" name="Order[{{ $c->id }}][product_id]" value="{{ $c->product->id }}">
                        <input type="hidden" name="Order[{{ $c->id }}][qty]" value="{{ $c->qty }}">
                    </td>
                    <td>{{ ucwords($c->product->name.' - '.$c->product->unit->name) }}</td>
                    <td>{{ $c->product->harga_jual }}</td>
                    <td>{{ $c->qty }}</td>
                    <td>{{ $c->qty * $c->product->harga_jual }}</td>
                    <td>
                        <a href="{{ route('orders.destroy', $c->id) }}" class="badge badge-pill badge-danger">
                            Cancel
                        </a>
                        <a href="{{ route('carts.edit', $c->id) }}" class="badge badge-pill badge-primary">
                            Pesen
                        </a>
                    </td>
                </tr>
                @php
                    $no++;
                @endphp
                @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer pt-4 pb-4 pr-5">
            <div class="row">
                <div class="col-8"></div>
                <div class="col-4">
                    <div class=" pb-3">
                        <h2 class="text-primary font-weight-light">
                            <strong>
                                TOTAL KERANJANG
                            </strong>
                        </h2>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pb-1">
                        <div>
                            <h2 class="text-primary font-weight-light">
                                <strong>
                                    SUBTOTAL
                                </strong>
                            </h2>
                        </div>
                        <div class="text-right">
                            <h2 class="text-red font-weight-light">
                                <strong>
                                    Rp.{{ number_format( $subtotal ) }}
                                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                </strong>
                            </h2>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pb-2">
                        <div>
                            <h2 class="text-primary font-weight-light">
                                <strong>
                                    Uang
                                </strong>
                            </h2>
                        </div>
                        <div class="text-right">
                            <h2 class="text-red font-weight-light">
                                <strong>
                                    <div class="form-group">
                                        <input type="text" required name="duit" placeholder="Uang Duit" class="form-control form-control-alternative">
                                    </div>
                                </strong>
                            </h2>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-lg btn-block text-white text-lg font-weight-bold">
                            Bayar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<script>

    $(document).ready( function () {


    });

</script>
