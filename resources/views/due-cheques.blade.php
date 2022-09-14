@extends('layouts.master')

@section('title') @lang('translation.Show_Cheques') @endsection

@section('css')
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.Cheques') @endslot
        @slot('title') @lang('translation.Show_Cheques') @endslot
    @endcomponent

    @include('cheques-datatable')

@endsection

@section('script')

    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                columns: [
                    {data: 'cheque_number', name: 'cheque_number'},
                    {data: 'bank', name: 'bank.name'},
                    {data: 'exchange_date', name: 'exchange_date'},
                    {data: 'cheque_recipient', name: 'cheque_recipient'},
                    {data: 'amount', name: 'amount'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });

    </script>
@endsection


