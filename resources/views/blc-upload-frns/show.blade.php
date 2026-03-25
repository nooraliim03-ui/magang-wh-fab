@extends('layouts.app')

@section('content')
    <div class="container">

        <h4 class="mb-4">Detail BLC Upload FRN</h4>

        <div class="card">
            <div class="card-body">

                <table class="table">

                    <tr>
                        <th width="200">KP</th>
                        <td>{{ $blc_upload_frn->kp }}</td>
                    </tr>

                    <tr>
                        <th>Style</th>
                        <td>{{ $blc_upload_frn->style }}</td>
                    </tr>

                    <tr>
                        <th>Country</th>
                        <td>{{ $blc_upload_frn->country }}</td>
                    </tr>

                    <tr>
                        <th>Item</th>
                        <td>{{ $blc_upload_frn->item }}</td>
                    </tr>


                    <tr>
                        <th>Color</th>
                        <td>{{ $blc_upload_frn->color }}</td>
                    </tr>

                    <tr>
                        <th>Relax</th>
                        <td>{{ $blc_upload_frn->relax }}</td>
                    </tr>

                    <tr>
                        <th>Request</th>
                        <td>{{ number_format($blc_upload_frn->qty_request) }}</td>
                    </tr>

                    <tr>
                        <th>BLC</th>
                        <td>{{ number_format($blc_upload_frn->blc, 2) }}</td>
                    </tr>


                    <tr>
                        <th>PODO</th>
                        <td>{{ $blc_upload_frn->podo ? $blc_upload_frn->podo->format('d F Y') : '-' }}</td>
                    </tr>

                    <tr>
                        <th>Filled</th>
                        <td>{{ number_format($blc_upload_frn->current_filled, 2) }}</td>
                    </tr>

                    <tr>
                        <th>Progress</th>
                        <td>{{ number_format($blc_upload_frn->progress, 2) }} %</td>
                    </tr>

                    <tr>
                        <th>Kendala</th>
                        <td>{{ $blc_upload_frn->kendala }}</td>
                    </tr>

                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $blc_upload_frn->keterangan }}</td>
                    </tr>

                </table>

                <a href="{{ route('blc-upload-frns.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </div>
        </div>

    </div>
@endsection
