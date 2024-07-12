<!DOCTYPE html>
<html>
<head>
    <title>Add Quantity</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<div class="container mt-5">
    <h1 class="text-center mb-4">Add Quantity to Item</h1>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('items.addQuantity') }}" method="POST">
        @csrf
               <div class="form-group row mb-3">
            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="barcode" class="col-sm-2 col-form-label">Barcode</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="barcode" name="barcode" value="{{ old('barcode') }}">
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Add Quantity</button>
        </div>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/quagga/dist/quagga.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Quagga.init({
                inputStream: {
                    type: "LiveStream",
                    constraints: {
                        width: 640,
                        height: 480,
                        facingMode: "environment"
                    }
                },
                decoder: {
                    readers: ["code_128_reader"]
                }
            }, (err) => {
                if (err) {
                    console.log(err);
                    return;
                }
                Quagga.start();
            });

            Quagga.onDetected((data) => {
                document.getElementById('barcode').value = data.codeResult.code;
                Quagga.stop();
            });
        });
    </script>
</body>
</html>
