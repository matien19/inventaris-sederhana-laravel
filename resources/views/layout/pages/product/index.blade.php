@extends('layout.main')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fas fa-th"></i> Data Produk</h3>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">
                  <i class="nav-icon fas fa-plus"></i>  Tambah Data
                </button>
                <button type="button" class="btn btn-success swalDefaultSuccess">
                  Launch Success Toast
                </button>
                <br><br>
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
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title">Tambah Produk</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="form-tambah-data" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nama Produk">
              </div>
              <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="" cols="30" rows="4" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <label for="sku">Kode</label>
                <input type="text" class="form-control" name="sku" id="sku" placeholder="Kode Produk">
              </div>
              <div class="form-group">
                <label for="harga">harga</label>
                <input type="number" class="form-control" name="price" id="price" placeholder="Harga Produk">
              </div>
              <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" class="form-control" name="stock" id="stock" placeholder="Stok Produk">
              </div>
              <div class="form-group">
                <label for="stok">Kategori</label>
                <select name="category_id" id="category_id" class="form-control">
                  <option value="" checked>Pilih Kategori</option>
                  @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
            </div>
          </form>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <script>
      $(document).ready(function() {
        $('#form-tambah-data').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const url = "{{ route('add.product') }}";
                const method = 'POST'; 
                console.log(url);
                
                // Clear previous error messages
                // $('.invalid-feedback').text('').hide();
                $.ajax({
                    type: method,
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#simpan').attr('disabled', 'disabled');
                        $('#simpan').html(
                            '<i class="fa fa-spinner fa-spin mr-1"></i> Menyimpan');
                    },
                    complete: function() {
                        $('#simpan').removeAttr('disabled');
                        $('#simpan').html('Simpan');
                    },
                    success: function(response) {
                      $('#modal-default').modal('hide');
                        Toast.fire({
                          icon: 'success',
                          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                        })
                        $('#form-tambah-data')[0].reset();
                        setTimeout(function() {
                            location.reload();
                        }, 2500);
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan: ';
                        
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                errorMessage += value[0] + ' '; 
                                $('#error-' + key).text(value[0]).show();
                            });
                        } else if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage += xhr.responseJSON.error; // Menambahkan error umum
                        } else {
                            errorMessage += 'Kesalahan tidak terduga. Silakan coba lagi'; // Pesan default
                        }
                        
                        alert(errorMessage);
                    }
                });

            });
      });
    </script>
@endsection