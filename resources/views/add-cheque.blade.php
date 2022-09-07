@extends('layouts.master')

@section('title')
    @lang('translation.Add_Cheque')
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            @lang('translation.Cheques')
        @endslot
        @slot('title')
            @lang('translation.Add_Cheque')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <form class="needs-validation" id="addCheque" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom1" class="form-label"
                                           style="font-size: 17px;">@lang('translation.cheque_number')</label>
                                    <input type="text" class="form-control" id="validationCustom1" name="cheque_number"
                                           placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="control-label"
                                           style="font-size: 17px;">@lang('translation.Bank')</label>
                                    <select class="form-control select2" name="bank_id">
                                        <option>@lang('translation.select')</option>
                                        @isset($banks)
                                            @foreach($banks as $bank)
                                                <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div>
                                    <label for="datepicker" class="form-label"
                                           style="font-size: 17px;">@lang('translation.exchange_date')</label>
                                    <div class="docs-datepicker">
                                        <div class="input-group date" id="datepicker">
                                            <input type="text" class="form-control docs-date" name="exchange_date"
                                                   placeholder="Pick a date" autocomplete="off">
                                            <button type="button" class="btn btn-secondary docs-datepicker-trigger"
                                                    disabled>
                                                <i class="mdi mdi-calendar" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div class="docs-datepicker-container"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom2" class="form-label"
                                           style="font-size: 17px;">@lang('translation.cheque_recipient')</label>
                                    <input type="text" class="form-control" id="validationCustom2"
                                           name="cheque_recipient" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom3" class="form-label"
                                           style="font-size: 17px;">@lang('translation.amount')</label>
                                    <input type="text" class="form-control" id="validationCustom3" name="amount"
                                           placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="control-label"
                                           style="font-size: 17px;">@lang('translation.status')</label>
                                    <select class="form-control select2" name="status">
                                        <option value="0" selected>@lang('translation.paid')</option>
                                        <option value="1">@lang('translation.returned')</option>
                                        <option value="2">@lang('translation.canceled')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">@lang('translation.Save')</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.ajaxsubmit@1.0.3/dist/jquery.ajaxsubmit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
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
                status: {
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
                            $('input').val("");
                            $('input').removeAttr('required');
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
    </script>

    <script type="text/javascript">
        $(function () {
            $('#datepicker').datepicker();
        });
    </script>
@endsection
