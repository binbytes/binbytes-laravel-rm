@extends('layouts.app', [
    'subTitle' => 'Projects',
    'pageTitle' => 'view Project Progress'
])

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom text-center">
                    <h4 class="mb-0">{{ $projectProgress->project->title }}</h4>
                </div>
                <div class="border-top border-bottom p-4">
                    <div class="row mb-3">
                        <div class="col-2">
                            <h6 class="mb-0">User</h6>
                        </div>
                        <div class="col-10">
                            <span class="text-muted">{{ $projectProgress->user->name }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h6 class="mb-0">Description</h6>
                        </div>
                        <div class="col-10">
                            <span class="text-muted">{{ $projectProgress->description }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h6 class="mb-0">Date</h6>
                        </div>
                        <div class="col-10">
                            <span class="text-muted">{{ $projectProgress->date }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ mix('js/tag.js') }}"></script>
@endpush