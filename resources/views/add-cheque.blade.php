@extends('layouts.master')

@section('title') @lang('translation.Add_Cheque') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.Cheques') @endslot
        @slot('title') @lang('translation.Add_Cheque') @endslot
    @endcomponent

@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>

@endsection
