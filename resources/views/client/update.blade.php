@extends('layouts.app', [
    'subTitle' => 'Client',
    'pageTitle' => 'Update Client'
])

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->modelForm($client, 'PUT', route('clients.update', $client))
                         ->acceptsFiles()
                         ->open() }}

                    {{ html()->hidden('id', $client->id) }}

                    @include('client._form')

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
@endpush