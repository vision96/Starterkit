@extends('layouts.master')

@section('title') @lang('translation.System_information') @endsection

@section('css')
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.System_information') @endslot
        @slot('title') @lang('translation.System_information') @endslot
    @endcomponent

    <div class="card">
        <div class="card-body">
            <span style="font-size: 14px;">هذا المشروع تم بإنجاز شركة Telescope</span>
        </div>
    </div>
@endsection

@section('script')

@endsection


