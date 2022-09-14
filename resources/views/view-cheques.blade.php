@extends('layouts.master')

@section('title') @lang('translation.Show_Cheques') @endsection

@section('css')
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <style>
        .required:after {
            content:" *";
            color: red;
        }
    </style>
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.Cheques') @endslot
        @slot('title') @lang('translation.Show_Cheques') @endslot
    @endcomponent

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addChequeModal">@lang('translation.Add_Cheque')</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered data-table">
                <thead>
                <tr style="background-color: #dbdada;">
                    <th>@lang('translation.cheque_number')</th>
                    <th>@lang('translation.Bank_name')</th>
                    <th>@lang('translation.exchange_date')</th>
                    <th>@lang('translation.cheque_recipient')</th>
                    <th>@lang('translation.amount')</th>
                    <th>@lang('translation.status')</th>
                    <th>@lang('translation.Created_at')</th>
                    <th>@lang('translation.Actions')</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    @include('add-cheque')
    @include('edit-cheque')
@endsection

@section('script')

    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.ajaxsubmit@1.0.3/dist/jquery.ajaxsubmit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">

        $('#datepicker').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
        $('#datepicker2').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('show-cheques') }}",
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#addCheque").validate({
            rules: {
                cheque_number: {
                    required: true,
                },
                bank_id: {
                    required: true,
                },
                exchange_date: {
                    required: true,
                },
                cheque_recipient: {
                    required: true,
                },
                amount: {
                    required: true,
                },
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            submitHandler: function (form) {
                var formData = new FormData(form);
                $.ajax({
                    url: "{{route('store-cheque')}}",
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response != 0) {
                            Swal.fire(
                                'تمت العملية بنجاح!',
                                'لقد قمت بإضافة شيك جديد!',
                                'success'
                            )
                            $('#addChequeModal').modal('hide');
                            $('.data-table').DataTable().ajax.reload();
                            $("#addCheque")[0].reset();
                        }
                    },
                    error: function (response) {
                        if (response != 0) {
                            Swal.fire(
                                'فشلت العملية!',
                                'لا يمكن إضافة شيك جديد',
                                'error'
                            )
                        }
                    }
                });

            }
        });


        $(document).ready(function () {
            $('select[name="bank_id"]').on('change', function() {
                var bank_id = $(this).val();
                if (bank_id) {
                    $.ajax({
                        url:'/cheque-number/' + bank_id,
                        type: 'GET' ,
                        dataType: 'json',
                        success: function(data) {
                            $('#cheque_number').val(data);
                        }
                    })
                } else {
                    $('#cheque_number').empty();
                }
            });
        });

        function edit(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('cheque.edit','id')}}",
                type: 'get',
                data: {
                    "id": id,
                },
                datatype: "json",
                success: function(response) {
                    $("#editId").val(response.id);
                    $("#edit_cheque_number").val(response.cheque_number);
                    $("#edit_bank_id").val(response.bank_id);
                    $("#edit_exchange_date").val(response.exchange_date);
                    $("#edit_cheque_recipient").val(response.cheque_recipient);
                    $("#editAmount").val(response.amount);
                    var url = '{{route("cheque.update",":id")}}';
                    url = url.replace(':id',response.id);
                    $('#editCheque').data('url',url);
                    $('#editChequeModal').modal('show');
                },
                error: function(response) {
                    if (response != 0) {
                        Swal.fire(
                            'خطأ!',
                            'لا يمكن تعديل هذا الشيك',
                            'error'
                        )
                    }
                }
            });

        }
        $(".modal").on("hidden.bs.modal", function () {
                $(".modal-backdrop").remove();
        });
        $("#editCheque").validate({
            rules: {
                edit_cheque_number: {
                    required: true,
                },
                edit_bank_id: {
                    required: true,
                },
                edit_exchange_date: {
                    required: true,
                },
                edit_cheque_recipient: {
                    required: true,
                },
                editAmount: {
                    required: true,
                },
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            submitHandler: function (form) {
                var formData = new FormData(form);
                var id = $('#editId').val();
                $.ajax({
                    url: 'cheques/'+id,
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response != 0) {
                            Swal.fire(
                                'تمت العملية بنجاح!',
                                'لقد قمت بتعديل شيك!',
                                'success'
                            )
                            $('#editChequeModal').modal('hide');
                            $('.data-table').DataTable().ajax.reload();
                            $("#editCheque")[0].reset();
                        }
                    },
                    error: function (response) {
                        if (response != 0) {
                            Swal.fire(
                                'فشلت العملية!',
                                'لا يمكن تعديل شيك',
                                'error'
                            )
                        }
                    }
                });

            }
        });

    </script>
@endsection


