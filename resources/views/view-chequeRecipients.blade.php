@extends('layouts.master')

@section('title') @lang('translation.Show_Cheque_Recipients') @endsection

@section('css')
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.Cheques') @endslot
        @slot('title') @lang('translation.Show_Cheque_Recipients') @endslot
    @endcomponent

        <div class="card">
            <div class="card-header">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal">@lang('translation.add_chequeRecipients')</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr style="background-color: #dbdada;">
                    <th style="width: 85px;">@lang('translation.Id')</th>
                        <th>@lang('translation.Recipient_Name')</th>
                        <th>@lang('translation.Created_at')</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">@lang('translation.add_chequeRecipients')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="addRecipient">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient_name">@lang('translation.Recipient_Name')</label>
                            <input id="recipient_name" type="text" class="form-control" name="recipient_name" autocomplete="on" placeholder="">
                        </div>

                        <div class="mt-3 d-grid">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">@lang('translation.Save')</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@section('script')

    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.ajaxsubmit@1.0.3/dist/jquery.ajaxsubmit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('show-chequeRecipients') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'}
                ]
            });

        });
    </script>

    <script>
        $('#addRecipient').on('submit',function(event){
            event.preventDefault();
            var name = $('#recipient_name').val();

            $.ajax({
                url: "{{ url('store-chequeRecipients') }}",
                type:"POST",
                data:{
                    "name": name,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response){
                    if(response != 0){
                        Swal.fire(
                            'تمت العملية بنجاح!',
                            'لقد قمت بإضافة مستفيد جديد!',
                            'success'
                        )
                        $('input').val("");
                        $('#myModal').modal('hide');
                        $('.data-table').DataTable().ajax.reload();
                    }
                },
                error:function(response){
                    if(response!=0){
                        Swal.fire(
                            'فشلت العملية!',
                            'لا يمكن إضافة مستفيد جديد',
                            'error'
                        )
                    }
                }
            });
        });
    </script>
@endsection


