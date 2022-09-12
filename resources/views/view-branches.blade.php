@extends('layouts.master')

@section('title') @lang('translation.Show_Branches') @endsection

@section('css')
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .required:after {
            content:" *";
            color: red;
        }
    </style>
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.Banks') @endslot
        @slot('title') @lang('translation.Show_Branches') @endslot
    @endcomponent

        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addBranchModal">@lang('translation.Add_Branch')</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr style="background-color: #dbdada;">
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

    @include('add-branch')

@endsection

@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.ajaxsubmit@1.0.3/dist/jquery.ajaxsubmit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('show-branches') }}",
                columns: [
                    {data: 'branch_name', name: 'branch_name'},
                    {data: 'branch_number', name: 'branch_number'},
                    {data: 'bank', name: 'bank.name'},
                    {data: 'created_at', name: 'created_at'}
                ]
            });

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#addBranch").validate({
            rules: {
                branch_name: {
                    required: true,
                },
                branch_number: {
                    required: true,
                },
                bank_id: {
                    required: true,
                }
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            submitHandler: function(form) {
                var formData = new FormData(form);
                $.ajax({
                    url: "{{route('store-branch')}}",
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != 0){
                            Swal.fire(
                                'تمت العملية بنجاح!',
                                'لقد قمت بإضافة فرع جديد!',
                                'success'
                            )
                            $('input').val("");
                            $('#addBranchModal').modal('hide');
                            $('.data-table').DataTable().ajax.reload();
                            $("#addBranch")[0].reset();
                        }
                    },
                    error:function(response){
                        if(response!=0){
                            Swal.fire(
                                'فشلت العملية!',
                                'لا يمكن إضافة فرع جديد',
                                'error'
                            )
                        }
                    }
                });

            }
        });
    </script>
@endsection


