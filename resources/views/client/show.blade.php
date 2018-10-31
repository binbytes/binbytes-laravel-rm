@extends('layouts.app', [
    'subTitle' => 'Clients',
    'pageTitle' => 'View Client'
])

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-small mb-4 pt-3">
                <div class="card-header border-bottom text-center">
                    @if($client->avatar)
                        <div class="mb-3 mx-auto">
                            <img class="rounded-circle" src="{{ $client->avatar_url }}" alt="{{ $client->name }}" width="90" height="90">
                        </div>
                    @endif

                    <h4 class="mb-0">{{ $client->name }}</h4>

                    <div class="d-block mb-2">
                        @if($client->github)
                            <a href="{{ $client->github }}" class="mx-1"><i class="fab fa-github"></i></a>
                        @endif
                        @if($client->twitter)
                            <a href="{{ $client->twitter }}" class="mx-1"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if($client->linkedin)
                            <a href="{{ $client->linkedin }}" class="mx-1"><i class="fab fa-linkedin"></i></a>
                        @endif
                        @if($client->facebook)
                            <a href="{{ $client->facebook }}" class="mx-1"><i class="fab fa-facebook-f"></i></a>
                        @endif
                    </div>
                </div>

                <div class="border-top border-bottom p-4">
                    <div class="mb-3">
                        <h6 class="mb-0">Email <i class="fas fa-envelope-open"></i></h6>
                        <span class="text-muted">{{ $client->email }}</span>
                    </div>
                    <div>
                        <h6 class="mb-0">Phone <i class="fas fa-phone"></i></h6>
                        <span class="text-muted">{{ $client->mobile_no }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card card-small mb-4">
                <div class="card-header">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true">Personal Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab" aria-controls="social" aria-selected="false">Social Details</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body tab-content p-4">
                    <div class="tab-pane fade active show" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-light">Personal info</h6>
                                <div class="row">
                                    <div class="col-4">
                                        <h6>Name</h6>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-muted">{{ $client->name }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <h6>Company</h6>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-muted">{{ $client->company_name ?? '---' }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <h6>Birthday</h6>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-muted">
                                            {{ $client->dob ?? '---' }}
                                            <i class="fas fa-birthday-cake ml-2"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="px-4">
                                    <h6 class="text-light">Contact info</h6>
                                    <div class="row">
                                        <div class="col-4">
                                            <h6>Address</h6>
                                        </div>
                                        <div class="col-8">
                                            <span class="text-muted">{{ $client->address ?? '---' }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <h6>City</h6>
                                        </div>
                                        <div class="col-8">
                                            <span class="text-muted">{{ $client->city ?? '---' }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <h6>Country</h6>
                                        </div>
                                        <div class="col-8">
                                            <span class="text-muted">{{ $client->country ?? '---' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-4">
                                        <h6>Skype</h6>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-muted">{{ $client->skype ?? '---' }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <h6>Trello</h6>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-muted">{{ $client->trello ?? '---' }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <h6>Slack</h6>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-muted">{{ $client->slack ?? '---' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-4">
                                        <h6>Github</h6>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-muted">{{ $client->github ?? '---' }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <h6>Twitter</h6>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-muted">{{ $client->twitter ?? '---' }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <h6>Linkedin</h6>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-muted">{{ $client->linkedin ?? '---' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection