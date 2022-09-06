<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Add_Bank'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?> <?php echo app('translator')->get('translation.Banks'); ?> <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?> <?php echo app('translator')->get('translation.Add_Bank'); ?> <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">

                    <form class="needs-validation" id="addBank" novalidate>
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label" style="font-size: 17px;"><?php echo app('translator')->get('translation.Bank_name'); ?></label>
                                    <input type="text" class="form-control" id="validationCustom01" name="bank_name" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label" style="font-size: 17px;"><?php echo app('translator')->get('translation.Bank_number'); ?></label>
                                    <input type="text" class="form-control" id="validationCustom02" name="bank_number" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label" style="font-size: 17px;"><?php echo app('translator')->get('translation.Branch_name'); ?></label>
                                    <input type="text" class="form-control" id="validationCustom01" name="branch_name" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label" style="font-size: 17px;"><?php echo app('translator')->get('translation.Branch_number'); ?></label>
                                    <input type="text" class="form-control" id="validationCustom02" name="branch_number" placeholder="" required>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.ajaxsubmit@1.0.3/dist/jquery.ajaxsubmit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#addBank").validate({
            rules: {
                bank_name: {
                    required: true,
                },
                bank_number: {
                    required: true,
                },
                branch_name: {
                    required: true,
                },
                branch_number: {
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
                    url: "<?php echo e(route('store-bank')); ?>",
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != 0){
                            Swal.fire(
                                'تمت العملية بنجاح!',
                                'لقد قمت بإضافة بنك جديد!',
                                'success'
                            )
                            $('input').val("");
                        }
                    },
                    error:function(response){
                        if(response!=0){
                            Swal.fire(
                                'فشلت العملية!',
                                'لا يمكن إضافة بنك جديد',
                                'error'
                            )
                        }
                    }
                });

            }
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Starterkit\resources\views/add-bank.blade.php ENDPATH**/ ?>