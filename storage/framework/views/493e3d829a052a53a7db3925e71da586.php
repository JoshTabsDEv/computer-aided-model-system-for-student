<div id="capsLockWarning" class="text-red-500"></div>

<?php if (! $__env->hasRenderedOnce('7147a797-daa5-4259-b2f9-46ce450a0914')): $__env->markAsRenderedOnce('7147a797-daa5-4259-b2f9-46ce450a0914'); ?>
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