<div class="card">
    <div class="card-header">
        @if(isset($add_cheque))
            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addChequeModal">@lang('translation.Add_Cheque')</button>
        @endif
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