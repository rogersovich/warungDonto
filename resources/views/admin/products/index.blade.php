@extends('layouts.element.main')

@section('title', 'Produk')

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
        <div class="card-header border-0">
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
                                Produk
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-4 text-right">
                    <a href="{{ route('products.create') }}" class="btn btn-icon btn-neutral btn-round">
                        <span class="btn-inner--text">Add</span>
                        <span class="btn-inner--icon">
                            <i class="ni ni-fat-add"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush" id="table-product">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Kode Barang</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($products as $p)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ ucwords($p->name) }}</td>
                    <td>{{ $p->unit->category->name }}</td>
                    <td>{{ $p->unit->name }}</td>
                    <td>{{ $p->code_item }}</td>
                    <td>{{ $p->harga_jual }}</td>
                    <td>{{ $p->stok }}</td>
                    <td>
                        <div class="dropdown bg-dark">
                            <a class="btn btn-sm btn-icon-only text-light mr-0" style="line-height: 1.5!important;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div style="min-width: 6rem;" class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                                <div class="dropdown-item">
                                    <a href="{{ route('products.edit', $p->id) }}" class="badge badge-pill badge-success">
                                        Edit
                                    </a>
                                </div>
                                <div class="dropdown-item">
                                    <a href="{{ route('products.destroy', $p->id) }}" class="badge badge-pill badge-danger">
                                        Delete
                                    </a>
                                </div>
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
        </div>
        <div class="card-footer py-4">
          <nav aria-label="...">
            <ul class="pagination justify-content-end mb-0">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">
                  <i class="fas fa-angle-left"></i>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
              </li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">
                  <i class="fas fa-angle-right"></i>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

<script>

    $(document).ready( function () {

        $('#table-product').DataTable({
            paging: true,
            searching: true,
        });
    } );

</script>

@endsection
