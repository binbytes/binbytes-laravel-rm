@extends('layouts.app', [
    'subTitle' => 'Projects',
    'pageTitle' => 'Update Project'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->modelForm($project, 'PUT', route('projects.update', $project))
                         ->acceptsFiles()
                         ->open() }}

                    @include('project._form')

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ mix('js/tag.js') }}"></script>
@endpush