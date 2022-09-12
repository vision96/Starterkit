<div id="addBankModal" class="modal fade" tabindex="-1" aria-labelledby="addBankLabel" aria-hidden="true">
    <form method="POST" id="addBank" class="needs-validation" novalidate>
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">@lang('translation.Add_Bank')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bank_name" class="form-label required" style="font-size: 17px;">@lang('translation.Bank_name')</label>
                                <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bank_number" class="form-label required" style="font-size: 17px;">@lang('translation.Bank_number')</label>
                                <input type="text" class="form-control" id="bank_number" name="bank_number" placeholder="" required>
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
