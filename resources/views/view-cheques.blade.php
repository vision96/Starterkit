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

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>@lang('translation.Id')</th>
                        <th>@lang('translation.cheque_number')</th>
                        <th>@lang('translation.Bank_name')</th>
                        <th>@lang('translation.exchange_date')</th>
                        <th>@lang('translation.cheque_recipient')</th>
                        <th>@lang('translation.amount')</th>
                        <th>@lang('translation.status')</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

@endsection

@section('script')

    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('show-cheques') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'cheque_number', name: 'cheque_number'},
                    {data: 'bank', name: 'bank.name'},
                    {data: 'exchange_date', name: 'exchange_date'},
                    {data: 'cheque_recipient', name: 'cheque_recipient'},
                    {data: 'amount', name: 'amount'},
                    {data: 'status', name: 'status'},
                ]
            });

        });
    </script>
@endsection


