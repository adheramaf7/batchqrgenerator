<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QR Code Generator</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body>

    <form method="POST" action="{{ route('generate_qr') }}" enctype="multipart/form-data">
        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh; width: 100vw">
            @csrf
            <div class="mb-5 h4 font-weight-bold">
                Generate Batch QR Code
            </div>
            <div class="mb-2">
                <input class="form-control" type="file" id="upload" name="upload" accept=".xlsx,.xls" required>
            </div>
            <div class="mb-3">
                <a href="{{ route('download_template') }}" role="button" class="btn btn-link">Download Template</a>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Generate QR Code</button>
            </div>
        </div>
    </form>
</body>

</html>
