@extends('layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('content')

@component('components.breadcrumb')
    @slot('li_1') @lang('translation.dashboards') @endslot
    @slot('title') @lang('translation.Dashboard') @endslot
@endcomponent

<div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium"> @lang('translation.number_of_cheques') </p>
                                    <h4 class="mb-0">{{$cheques_count}}</h4>
                                    <div class="mt-2">
                                        <a href="{{route('show-cheques')}}" class="btn btn-primary waves-effect waves-light btn-sm"> @lang('translation.View_all') <i class="mdi mdi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="fas fa-money-check-alt font-size-24"></i>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium"> @lang('translation.Due_cheques') </p>
                                    <h4 class="mb-0">{{$due_cheques_count}}</h4>
                                    <div class="mt-2">
                                        <a href="{{route('dueCheques')}}" class="btn btn-primary waves-effect waves-light btn-sm"> @lang('translation.View_all') <i class="mdi mdi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="fas fa-money-check-alt font-size-24"></i>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium"> @lang('translation.five_days_cheques') </p>
                                    <h4 class="mb-0">{{$cheques_due_5days_count}}</h4>
                                    <div class="mt-2">
                                        <a href="{{route('chequesDue5Days')}}" class="btn btn-primary waves-effect waves-light btn-sm"> @lang('translation.View_all') <i class="mdi mdi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="fas fa-money-check-alt font-size-24"></i>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">@lang('translation.six_months_cheques')</p>
                                    <h4 class="mb-0">{{$cheques_due_6months_count}}</h4>
                                    <div class="mt-2">
                                        <a href="{{route('chequesDue6Months')}}" class="btn btn-primary waves-effect waves-light btn-sm"> @lang('translation.View_all') <i class="mdi mdi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="fas fa-money-check-alt font-size-24"></i>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>

@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- dashboard init -->
<script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
@endsection
