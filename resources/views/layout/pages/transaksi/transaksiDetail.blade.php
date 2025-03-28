@extends('layout.main')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fas fa-cart-plus"></i> Data Transaksi</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div id="reader" width="600px"></div>
                    </div>
                    <div class="col-lg-6">
                        <h4>No Trasnsaksi : {{ $id }}</h4>
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama Produk</th>
                              <th>Harga Produk</th>
                              <th>Jumlah</th>
                              <th>Subtotal</th>
                              <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($transaksi as $item )
                            <tr>
                              <td>{{ $loop->iteration; }}</td>
                              <td>{{ $item->produk->name }}</td>
                              <td>{{ $item->produk->price }}</td>
                              <td>1</td>
                              <td>{{ $item->produk->price * 1 }}</td>
                              <td>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash"></i></a>
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
  
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        var id          = "{{ $id }}";
        const method    = "POST";
        const formData  = new FormData();

        function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        //    console.log(`Code matched = ${decodedText}`, decodedResult);
        const url       = "/transaksi/detail/store/{id}/{produkId}".replace('{id}', id).replace('{produkId}', decodedText); // Ganti dengan URL yang sesuai

        // console.log(url);
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
                },
                complete: function() {
                },
                success: function(response) {
                    alert('sukses');
                    let item = response.data; // Pastikan respons dari server mengandung data transaksi baru
                    let newRow = `
                        <tr>
                            <td>${$('#example tbody tr').length + 1}</td>
                            <td>${item.produk.name}</td>
                            <td>${item.produk.price}</td>
                            <td>1</td>
                            <td>${item.produk.price * 1}</td>
                            <td>
                                <a href="#" class="btn btn-danger btn-sm delete-btn" data-id="${item.id}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    `;

                    $('#example tbody').append(newRow);
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
        }

        function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: {width: 250, height: 250} },
        /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection