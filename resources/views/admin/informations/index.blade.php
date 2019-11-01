@extends('layouts.element.main')

@section('title', 'Keterangan Satuan')

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
                                informations
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-4 text-right">
                    <a href="{{ route('informations.create') }}" class="btn btn-icon btn-neutral btn-round">
                        <span class="btn-inner--text">Add</span>
                        <span class="btn-inner--icon">
                            <i class="ni ni-fat-add"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush" id="table-category">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Satuan Awal</th>
                    <th scope="col">Jumlah Awal</th>
                    <th scope="col">Satuan Akhir</th>
                    <th scope="col">Jumlah Akhir</th>
                    <th scope="col">Action</th>
                </tr>

            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($informations as $i)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $i->name }}</td>
                    <td>{{ $i->satuan_awal }}</td>
                    <td>{{ $i->jumlah_awal }}</td>
                    <td>{{ $i->satuan_akhir }}</td>
                    <td>{{ $i->satuan_akhir }}</td>
                    <td>
                        <div class="dropdown bd-dark">
                            <a class="btn btn-sm btn-icon-only ln-normal mr-0 text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div style="min-width: 6rem;" class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                                <div class="dropdown-item">
                                    <a href="{{ route('informations.edit', $i->id) }}" class="badge badge-pill badge-success">
                                        Edit
                                    </a>
                                </div>
                                <div class="dropdown-item">
                                    <a href="{{ route('informations.destroy', $i->id) }}" class="badge badge-pill badge-danger">
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
            {{ $informations->render() }}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

<script>

    $(document).ready( function () {

        $('#table-category').DataTable({
            paging: false,
            searching: true,
        });
    } );

</script>

@endsection
