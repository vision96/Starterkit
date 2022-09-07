<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Show_Cheques'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?> <?php echo app('translator')->get('translation.Cheques'); ?> <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?> <?php echo app('translator')->get('translation.Show_Cheques'); ?> <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th><?php echo app('translator')->get('translation.Id'); ?></th>
                        <th><?php echo app('translator')->get('translation.cheque_number'); ?></th>
                        <th><?php echo app('translator')->get('translation.Bank_name'); ?></th>
                        <th><?php echo app('translator')->get('translation.exchange_date'); ?></th>
                        <th><?php echo app('translator')->get('translation.cheque_recipient'); ?></th>
                        <th><?php echo app('translator')->get('translation.amount'); ?></th>
                        <th><?php echo app('translator')->get('translation.status'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?php echo e(route('show-cheques')); ?>",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'cheque_number', name: 'cheque_number'},
                    {data: 'bank.bank_name', name: 'bank_id'},
                    {data: 'exchange_date', name: 'exchange_date'},
                    {data: 'cheque_recipient', name: 'cheque_recipient'},
                    {data: 'amount', name: 'amount'},
                    {data: 'status', name: 'status'},

                ]
            });

        });
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Starterkit\resources\views/view-cheques.blade.php ENDPATH**/ ?>