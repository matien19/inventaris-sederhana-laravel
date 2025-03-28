@extends('layout.main')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fas fa-cart-plus"></i> Data Transaksi</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>No</th>
                              <th>No Transaksi</th>
                              <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($transaksi as $item)
                            <tr>
                              <td>{{ $loop->iteration; }}</td>
                              <td>{{ $item->no_transaksi; }}</td>
                              <td>
                                <a href="/transaksi/detail/{{ $item->no_transaksi; }}" class="btn btn-primary btn-sm">Detail</a>
                              </td>
                            </tr>
                            @endforeach
                           
                            
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@endsection