<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NetForesee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    <!-- Header -->
    <div class="bg-primary text-white text-center py-3 position-fixed w-100 top-0 d-flex align-items-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="ms-3" style="height: 50px;">
        <h2 class="flex-grow-1 m-0">NetForesee</h2>
    </div>

    <!-- Main Content -->
    <div class="container d-flex justify-content-center align-items-center flex-grow-1" style="margin-top: 80px;">
        <div class="col-md-8 col-lg-6">
            <div class="card p-4 shadow">
                <div class="card-header text-white text-center" style="background-color: #02084b;">
                    <h3>Form Input Komentar</h3>
                </div>
                <div class="card-body">

                    @if (session('error'))
                        <div class="alert alert-warning text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (isset($result))
                        <div class="alert text-center {{ $result === 'POSITIVE' ? 'alert-success' : 'alert-danger' }}">
                            Hasil Klasifikasi: {{ $result === 'POSITIVE' ? 'Positif 😊' : 'Negatif 😢' }}
                        </div>
                    @endif

                    <form action="{{ url('/analyze') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="teks" class="form-label">Masukkan Teks:</label>
                            <input type="text" class="form-control" id="teks" name="text"
                                value="{{ old('text') }}" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100 fw-bold">Cek</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-white text-center py-3 position-fixed w-100 bottom-0" style="background-color: #02084b;">
        <p class="m-0">&copy; 2025 NetForesee. All rights reserved.</p>
    </div>

</body>

</html>
