<?php
    $banks = \App\Models\Bank::all();
?>
<div id="addBranchModal" class="modal fade" tabindex="-1" aria-labelledby="addBranchLabel" aria-hidden="true">
    <form method="POST" id="addBranch" class="needs-validation" novalidate>
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('translation.Add_Branch')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="branch_name" class="form-label required" style="font-size: 17px;">@lang('translation.Branch_name')</label>
                                <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="branch_number" class="form-label required" style="font-size: 17px;">@lang('translation.Branch_number')</label>
                                <input type="text" class="form-control" id="branch_number" name="branch_number" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="control-label required" style="font-size: 17px;">@lang('translation.Bank')</label>
                                <select class="form-control select2" name="bank_id" required>
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">@lang('translation.Save')</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('translation.Close')</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>

</div><!-- /.modal -->
