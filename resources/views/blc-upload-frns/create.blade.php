@extends('layouts.app')

@section('content')
    <div class="container">

        <h4 class="mb-4">Tambah Data BLC Upload FRN</h4>

        <form action="{{ route('blc-upload-frns.store') }}" method="POST">

            @csrf

            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">KP</label>
                    <input type="text" name="kp" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Style</label>
                    <input type="text" name="style" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Item</label>
                    <input type="text" name="item" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Color</label>
                    <input type="text" name="color" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Relax</label>
                    <input type="text" name="relax" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Qty Request</label>
                    <input type="number" name="qty_request" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">BLC</label>
                    <input type="number" name="blc" step="any" class="form-control" value="0">
                </div>



                <div class="col-md-4">
                    <label class="form-label">PODO (Target Date)</label>
                    <input type="date" name="podo" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kendala</label>
                    <input type="text" name="kendala" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control">
                </div>



            </div>

            <div class="mt-4">
                <button class="btn btn-success">Simpan</button>

                <a href="{{ route('blc-upload-frns.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>

    </div>
@endsection
