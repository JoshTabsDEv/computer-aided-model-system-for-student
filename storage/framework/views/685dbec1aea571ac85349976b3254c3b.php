<div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4">
    <?php echo e($slot); ?>

</div>

<script>
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.transition = 'opacity 0.5s ease-out';
            successMessage.style.opacity = '0';
            setTimeout(function() {
                successMessage.remove();
            }, 500);
        }
    }, 5000); // 3 seconds
</script>
<?php /**PATH C:\Users\Joshua Tabura\Desktop\computer-aided-model-system-for-student\resources\views\components\success-message.blade.php ENDPATH**/ ?>