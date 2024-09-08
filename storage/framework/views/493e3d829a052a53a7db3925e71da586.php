<div id="capsLockWarning" class="text-red-500"></div>

<?php if (! $__env->hasRenderedOnce('7123fd6a-6bee-4324-9dda-d3258efd1c85')): $__env->markAsRenderedOnce('7123fd6a-6bee-4324-9dda-d3258efd1c85'); ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const inputFields = document.querySelectorAll("input[type='text']");
                inputFields.forEach(function(input) {
                    input.addEventListener("keyup", function(event) {
                        const capsLockActive = event.getModifierState && event.getModifierState("CapsLock");
                        const warningElement = document.getElementById("capsLockWarning");
                        if (capsLockActive) {
                            warningElement.textContent = "Caps Lock is ON";
                        } else {
                            warningElement.textContent = "";
                        }
                    });
                });
            });
        </script>
    <?php endif; ?>
<?php /**PATH C:\Users\Joshua Tabura\Desktop\computer-aided-model-system-for-student\resources\views\components\capslock-detector.blade.php ENDPATH**/ ?>