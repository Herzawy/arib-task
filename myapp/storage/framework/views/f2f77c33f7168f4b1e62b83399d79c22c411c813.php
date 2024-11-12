

<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Employees</h1>


        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Salary</th>
                    <th>Manager</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($employee->first_name); ?></td>
                        <td>$<?php echo e(number_format($employee->salary, 2)); ?></td>
                        <td><?php echo e($employee->manager_name); ?></td>
                        <td>
                            <a href="<?php echo e(route('employees.edit', $employee->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                            <form action="<?php echo e(route('employees.destroy', $employee->id)); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        
        <div class="text-center mt-4">
            <a href="<?php echo e(route('employees.create')); ?>" class="btn btn-primary">Create New Employee</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\arib-task\resources\views/employees/index.blade.php ENDPATH**/ ?>