@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        <div class="row mb-4">
            <div class="col">
                <h4 class="fw-bold">Dashboard</h4>
                <p class="text-muted">Selamat datang di sistem</p>
            </div>
        </div>

        <div class="row">

            <!-- Card Users -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Total Users</h6>
                        <h3 class="fw-bold">10</h3>
                    </div>
                </div>
            </div>

            <!-- Card Obat -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Total Obat</h6>
                        <h3 class="fw-bold">25</h3>
                    </div>
                </div>
            </div>

            <!-- Card Stok -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Total Stok</h6>
                        <h3 class="fw-bold">120</h3>
                    </div>
                </div>
            </div>

            <!-- Card Kadaluarsa -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Obat Hampir Kadaluarsa</h6>
                        <h3 class="fw-bold text-danger">3</h3>
                    </div>
                </div>
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Sistem</h5>
            </div>
            <div class="card-body">
                <p>
                    Anda berhasil login ke dalam sistem. Silakan gunakan menu di sidebar
                    untuk mengelola data pada aplikasi.
                </p>
            </div>
        </div>

    </div>
@endsection
