@extends('layouts.element.main')

@section('title', 'Pemasok')

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
<div class="container-fluid mt--7">
          <!-- Table -->
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
                    <a href="{{ route('products.create') }}" class="btn btn-icon btn-neutral btn-round">
                        <span class="btn-inner--text">Tambah Barang Baru</span>
                        <span class="btn-inner--icon">
                            <i class="ni ni-fat-add"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <form action="{{ route('suppliers.pasok') }}" method="POST">
        <div class="table-responsive p-3" style="background: #f7f8f9;">
          <table class="table align-items-center table-flush" id="table-category">
            <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">#</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Harga Beli</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($suppliers as $s)
                <tr>

                    <td>{{ $no }}</td>
                    <td>
                        <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input check-class" id="check-{{ $s->id }}" name="pasok[]" value="{{ $s->product->id }}" type="checkbox">
                            <label class="custom-control-label pt-1" for="check-{{ $s->id }}">
                                Pasok
                            </label>
                        </div>
                    </td>
                    <td>{{ ucwords($s->product->name) }}</td>
                    <td>{{ $s->product->unit->category->name }}</td>
                    <td>{{ $s->product->unit->name }}</td>
                    <td>{{ $s->harga_beli }}</td>
                    <td>{{ $s->product->stok }}</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only pt-2 text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div style="min-width: 6rem;" class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                                <div class="dropdown-item">
                                    <a href="{{ route('suppliers.edit', $s->id) }}" class="badge badge-pill badge-success">
                                        Edit
                                    </a>
                                </div>
                                {{-- <div class="dropdown-item">
                                    <a href="{{ route('suppliers.pasok', $s->id) }}" class="badge badge-pill badge-primary">
                                        Pasok
                                    </a>
                                </div> --}}
                            </div>
                        </div>
                    </td>
                </tr>
                @php
                    $no++;
                @endphp
                @endforeach
            </tbody>
          </table>

            @csrf
                <div class="col text-right">
                    <button type="submit" class="btn btn-icon btn-primary" style="border-radius: 22px;">
                        <span class="btn-inner--text">Submit</span>
                    </button>
                </div>
            </form>
        </div>
        <div class="card-footer">
            {{ $suppliers->render() }}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<script>

    $(document).ready( function () {

        $('#table-category').DataTable({
            paging: false,
            searching: true,
        });



        $('.check-class').on('change', function(){
            var check = $(this).prop('checked');
            var val = $(this).val()
        })

    } );

</script>
