@extends('layout.main')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fas fa-th"></i> Data Produk</h3>
            </div>
            <div class="card-body">
                {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-tambahdata" style="background-color:#86090f">
                    <i class="nav-icon fas fa-plus"></i>  Tambah Data
                </button> --}}
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Produk</th>
                      <th>Deskripsi</th>
                      <th>Kode</th>
                      <th>harga</th>
                      <th>Stok</th>
                      <th>Kategori</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                    <tr>
                      <td>1</td>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->description }}</td>
                      <td>{{ $product->sku }}</td>
                      <td>{{ $product->price }}</td>
                      <td>{{ $product->stock }}</td>
                      <td>{{ $product->category->name }}</td>
                      <td>aksi</td>
                    </tr>
                    @endforeach
                   
                    
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection