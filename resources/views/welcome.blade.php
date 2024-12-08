<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <h1>SCAN YOUR QRCODE HERE</h1>
        <table class="table table-bordered">
            <th>
                <tr>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Action</td>
                </tr>
            </th>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->product}}</td>
                    <td>{{$product->price}}</td>
                    <td>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Scan
                          </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @foreach($products as $idprodcut)
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div id="reader" style="width: 600px; display: none;"></div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
           
        {{-- <div class="container-fluid">
            <button id="scan" class="btn btn-outline-info mb-3">SCAN HERE</button>
            <div id="reader" style="width: 600px; display: none;"></div>
        </div> --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                function onScanSuccess(qrCodeMessage) {
                    fetch('/scan', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ data: qrCodeMessage })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        // alert('Data berhasil dikirim: ' + data.data);
                    })
                    .catch(err => {
                        console.log("Gagal mengirim data: ", err);
                    });
                }
    
                function onScanError(errorMessage) {
                    console.warn(`QR Code scan error: ${errorMessage}`);
                }
    
                // Inisialisasi objek Html5Qrcode
                const html5QrCode = new Html5Qrcode("reader");
                
                    document.getElementById("reader").style.display = "block";
                    html5QrCode.start(
                        { facingMode: "environment" },
                        {
                            fps: 10,
                            qrbox: 250
                        },
                        onScanSuccess,
                        onScanError
                    ).catch(err => {
                        console.log("Error gagal dari html5QrCode: ", err);
                    });
                
                document.getElementById("scan").addEventListener("click",  function(){
                    startScanning();
                })
            });
        </script>
        {{-- <script>
            document.addEventListener("DOMContentLoaded", function() {
                function onScanSuccess(qrCodeMessage) {
                    fetch('/scan', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ data: qrCodeMessage })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        // alert('Data berhasil dikirim: ' + data.data);
                    })
                    .catch(err => {
                        console.log("Gagal mengirim data: ", err);
                    });
                }
    
                function onScanError(errorMessage) {
                    console.warn(`QR Code scan error: ${errorMessage}`);
                }
    
                // Inisialisasi objek Html5Qrcode
                const html5QrCode = new Html5Qrcode("reader");
                function startScanning(){
                    document.getElementById("reader").style.display = "block";
                    html5QrCode.start(
                        { facingMode: "environment" },
                        {
                            fps: 10,
                            qrbox: 250
                        },
                        onScanSuccess,
                        onScanError
                    ).catch(err => {
                        console.log("Error gagal dari html5QrCode: ", err);
                    });
                }
                document.getElementById("scan").addEventListener("click",  function(){
                    startScanning();
                })
            });
        </script> --}}
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </body>
</html>
