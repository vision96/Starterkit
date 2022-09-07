@extends('layouts.master')

@section('title') @lang('translation.Starter_Page') @endsection
@section('css')
    <style>
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
            background-color: #2a3042 !important;
        }
    </style>
@endsection
@section('content')

    @component('components.breadcrumb')
        @slot('li_1')@lang('translation.Settings') @endslot
        @slot('title') @lang('translation.Settings') @endslot
    @endcomponent

    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link mb-2 active" id="v-pills-website-settings-tab" data-bs-toggle="pill" href="#v-pills-website-settings" role="tab" aria-controls="v-pills-website-settings" aria-selected="true">@lang('translation.Website_Settings')</a>
                                <a class="nav-link" id="v-pills-notification-settings-tab" data-bs-toggle="pill" href="#v-pills-notification-settings" role="tab" aria-controls="v-pills-notification-settings" aria-selected="false">@lang('translation.Notification_Settings')</a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-website-settings" role="tabpanel" aria-labelledby="v-pills-website-settings-tab">
                                    <form method="POST" id="notificationSettings">
                                        @csrf
                                    <div class="row">
                                    <div class="mb-2">
                                        <label for="logo">@lang('translation.Website_Logo')</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control @error('logo') is-invalid @enderror" id="inputGroupFile02" name="logo" autofocus required>
                                            <label class="input-group-text" for="inputGroupFile02">@lang('translation.Upload')</label>
                                        </div>
                                        @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="v-pills-notification-settings" role="tabpanel" aria-labelledby="v-pills-notification-settings-tab">
                                    <form method="POST" id="notificationSettings">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                    <label for="phone_number">@lang('translation.Phone_number')</label>
                                                    <input id="phone_number" type="text" class="form-control" name="phone_number" autocomplete="on" placeholder="">
                                            </div>
                                        </div>

                                        <div class="mt-3 d-grid">
{{--                                            <button class="btn btn-primary waves-effect waves-light" type="submit">@lang('translation.Save')</button>--}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>

    </div>

@endsection
