@extends('layouts.app')

@section('content')
    <div class="container">

        <h4 class="mb-4">Edit Data BLC Upload FRN</h4>

        <form action="{{ route('blc-upload-frns.update', $blc_upload_frn) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-4">
                    <label>KP</label>
                    <input type="text" name="kp" class="form-control" value="{{ $blc_upload_frn->kp }}">
                </div>

                <div class="col-md-4">
                    <label>Style</label>
                    <input type="text" name="style" class="form-control" value="{{ $blc_upload_frn->style }}">
                </div>

                <div class="col-md-4">
                    <label>Country</label>
                    <input type="text" name="country" class="form-control" value="{{ $blc_upload_frn->country }}">
                </div>

                <div class="col-md-4">
                    <label>Item</label>
                    <input type="text" name="item" class="form-control" value="{{ $blc_upload_frn->item }}">
                </div>

                <div class="col-md-4">
                    <label>Color</label>
                    <input type="text" name="color" class="form-control" value="{{ $blc_upload_frn->color }}">
                </div>

                <div class="col-md-4">
                    <label>Relax</label>
                    <input type="text" name="relax" class="form-control" value="{{ $blc_upload_frn->relax }}" required>
                </div>



                <div class="col-md-4">
                    <label>Qty Request</label>
                    <input type="number" name="qty_request" class="form-control"
                        value="{{ $blc_upload_frn->qty_request }}">
                </div>

                <div class="col-md-4">
                    <label>BLC</label>
                    <input type="number" name="blc" step="any" class="form-control"
                        value="{{ $blc_upload_frn->blc }}">
                </div>

                <div class="col-md-4">
                    <label>PODO (Target Date)</label>
                    <input type="date" name="podo" class="form-control"
                        value="{{ $blc_upload_frn->podo ? $blc_upload_frn->podo->format('Y-m-d') : '' }}">
                </div>

                <div class="col-md-6">
                    <label>Kendala</label>
                    <input type="text" name="kendala" class="form-control" value="{{ $blc_upload_frn->kendala }}">
                </div>

                <div class="col-md-6">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" value="{{ $blc_upload_frn->keterangan }}">
                </div>

            </div>

            <div class="mt-4">

                <button class="btn btn-success">Update</button>

                <a href="{{ route('blc-upload-frns.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </div>

        </form>

    </div>
@endsection
