<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Add_Cheque'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('/assets/libs/select2/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo e(URL::asset('/assets/libs/datepicker/datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?> <?php echo app('translator')->get('translation.Cheques'); ?> <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?> <?php echo app('translator')->get('translation.Add_Cheque'); ?> <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <form class="needs-validation" id="addCheque" novalidate>
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom1" class="form-label" style="font-size: 17px;"><?php echo app('translator')->get('translation.cheque_number'); ?></label>
                                    <input type="text" class="form-control" id="validationCustom1" name="cheque_number" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="control-label" style="font-size: 17px;"><?php echo app('translator')->get('translation.Bank'); ?></label>
                                    <select class="form-control select2" name="bank_id">
                                        <option><?php echo app('translator')->get('translation.select'); ?></option>
                                        <?php if(isset($banks)): ?>
                                        <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($bank->id); ?>"><?php echo e($bank->bank_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div>
                                    <h4 class="font-size-14 mb-3"><?php echo app('translator')->get('translation.exchange_date'); ?></h4>
                                    <div class="docs-datepicker">
                                        <div class="input-group">
                                            <input type="text" class="form-control docs-date" name="date"
                                                   placeholder="Pick a date" autocomplete="off">
                                            <button type="button" class="btn btn-secondary docs-datepicker-trigger" disabled>
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
                                    <label for="validationCustom2" class="form-label" style="font-size: 17px;"><?php echo app('translator')->get('translation.cheque_recipient'); ?></label>
                                    <input type="text" class="form-control" id="validationCustom2" name="cheque_recipient" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom3" class="form-label" style="font-size: 17px;"><?php echo app('translator')->get('translation.amount'); ?></label>
                                    <input type="text" class="form-control" id="validationCustom3" name="amount" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="control-label" style="font-size: 17px;"><?php echo app('translator')->get('translation.status'); ?></label>
                                    <select class="form-control select2">
                                        <option value="0" selected><?php echo app('translator')->get('translation.paid'); ?></option>
                                        <option value="1"><?php echo app('translator')->get('translation.returned'); ?></option>
                                        <option value="2"><?php echo app('translator')->get('translation.canceled'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit"><?php echo app('translator')->get('translation.Save'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/pages/form-validation.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/datepicker/datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/select2/select2.min.js')); ?>"></script>

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
                    url: "<?php echo e(route('store-cheque')); ?>",
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != 0){
                            Swal.fire(
                                '?????? ?????????????? ??????????!',
                                '?????? ?????? ???????????? ?????? ????????!',
                                'success'
                            )
                            $('input').val("");
                            $('input').removeAttr('required');
                        }
                    },
                    error:function(response){
                        if(response!=0){
                            Swal.fire(
                                '???????? ??????????????!',
                                '???? ???????? ?????????? ?????? ????????',
                                'error'
                            )
                        }
                    }
                });

            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Starterkit\resources\views/add-cheque.blade.php ENDPATH**/ ?>