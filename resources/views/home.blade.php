@extends('adminlte::page')

@section('content')
<div class="container">
  <div class="row">
        <div class="col-lg-5 mr-3">
            <div class="mb-4">
                <!-- Dashboard Card-->
                <div class="card border-0 overflow-hidden p-4 p-lg-0">
                    <div class="card-body p-lg-5">
                        <h2 class="h1 mb-0 text-dark">{{ $companies }}</h2>
                        <p class="text-muted mb-0">Companies</p>
                        <i class="dash-card-icon fas fa-building"></i>
                        <div class="pt-2">
                            <a class="btn btn-link p-0 btn-arrow" href="{{route('company.index')}}">
                                <span>View details</span>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <!-- Dashboard Card-->
                <div class="card border-0 overflow-hidden p-4 p-lg-0">
                    <div class="card-body p-lg-5">
                        <h2 class="h1 mb-0 text-dark">{{ $categories }}</h2>
                        <p class="text-muted mb-0">Categories</p>
                        <i class="dash-card-icon fas fa-list-alt"></i>
                        <div class="pt-2">
                            <a class="btn btn-link p-0 btn-arrow" href="{{ route('category.index') }}">
                                <span>View details</span>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 mr-3">
            <div class="mb-4">
                <!-- Dashboard Card-->
                <div class="card border-0 overflow-hidden p-4 p-lg-0">
                    <div class="card-body p-lg-5">
                        <h2 class="h1 mb-0 text-dark">{{ $countries }}</h2>
                        <p class="text-muted mb-0">Countries</p>
                        <i class="dash-card-icon fas fa-flag"></i>
                        <div class="pt-2">
                            <a class="btn btn-link p-0 btn-arrow" href="{{ route('country.index') }}">
                                <span>View details</span>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <!-- Dashboard Card-->
                <div class="card border-0 overflow-hidden p-4 p-lg-0">
                    <div class="card-body p-lg-5">
                        <h2 class="h1 mb-0 text-dark">{{ $degrees }}</h2>
                        <p class="text-muted mb-0">Degrees</p>
                        <i class="dash-card-icon fas fa-graduation-cap"></i>
                        <div class="pt-2">
                            <a class="btn btn-link p-0 btn-arrow" href="{{ route('degree.index') }}">
                                <span>View details</span>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
