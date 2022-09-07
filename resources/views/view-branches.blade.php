@extends('layouts.master')

@section('title') @lang('translation.Show_Branches') @endsection

@section('css')
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.Banks') @endslot
        @slot('title') @lang('translation.Show_Branches') @endslot
    @endcomponent

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>@lang('translation.Id')</th>
                        <th>@lang('translation.Branch_name')</th>
                        <th>@lang('translation.Branch_number')</th>
                        <th>@lang('translation.Bank_name')</th>
                        <th>@lang('translation.Created_at')</th>
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
                ajax: "{{ route('show-branches') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'branch_name', name: 'branch_name'},
                    {data: 'branch_number', name: 'branch_number'},
                    {data: 'bank', name: 'bank.name'},
                    {data: 'created_at', name: 'created_at'}
                ]
            });

        });
    </script>
@endsection


