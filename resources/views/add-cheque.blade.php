<?php
$banks = \App\Models\Bank::all();
?>
<div id="addChequeModal" class="modal fade" tabindex="-1" aria-labelledby="addChequeLabel" aria-hidden="true">
    <form method="POST" id="addCheque" class="needs-validation" novalidate>
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('translation.Add_Cheque')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label required"
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
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cheque_number" class="form-label required"
                                       style="font-size: 17px;">@lang('translation.cheque_number')</label>
                                <input type="text" class="form-control" id="cheque_number" name="cheque_number"
                                       placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label required"
                                       style="font-size: 17px;">@lang('translation.amount')</label>
                                <input type="text" class="form-control" id="amount" name="amount"
                                       placeholder="" required>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div>
                                <label for="datepicker" class="form-label required"
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
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="cheque_recipient" class="form-label required"
                                       style="font-size: 17px;">@lang('translation.cheque_recipient')</label>
                                <input type="text" class="form-control" id="cheque_recipient"
                                       name="cheque_recipient" placeholder="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">@lang('translation.Save')</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('translation.Close')</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>

</div><!-- /.modal -->
