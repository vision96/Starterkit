@extends('layouts.master')

@section('title') @lang('translation.Add_Branch') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.Banks') @endslot
        @slot('title') @lang('translation.Add_Branch') @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <form class="needs-validation" id="addBranch" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom03" class="form-label" style="font-size: 17px;">@lang('translation.Branch_name')</label>
                                    <input type="text" class="form-control" id="validationCustom03" name="branch_name" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label" style="font-size: 17px;">@lang('translation.Branch_number')</label>
                                    <input type="text" class="form-control" id="validationCustom04" name="branch_number" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="control-label" style="font-size: 17px;">@lang('translation.Bank')</label>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.ajaxsubmit@1.0.3/dist/jquery.ajaxsubmit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
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
                            $('input').removeAttr('required');

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
