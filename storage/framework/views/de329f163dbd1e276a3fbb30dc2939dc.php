<form id="userForm">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control" name="name" id="name" required>
    </div>
    <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email" class="form-control" name="email" id="email" required>
    </div>
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>
    <div class="form-group">
        <label>Roles</label>
        <div>
            <input type="checkbox" name="es_administrador" id="es_administrador" value="1">
            <label for="es_administrador">Administrador</label>
        </div>
        <div>
            <input type="checkbox" name="es_revisor" id="es_revisor" value="1">
            <label for="es_revisor">Revisor</label>
        </div>
    </div>
    <div class="form-group">
        <label for="active">Activo</label>
        <div>
            <!-- Hidden input para asegurar que se envíe siempre un valor -->
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" id="active" value="1"> Sí
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>


<!-- Área para mostrar el mensaje -->
<div id="responseMessage" style="margin-top: 20px; display: none;" class="alert alert-success"></div>
<script>
    document.getElementById('userForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Evita la recarga de la página

        const form = e.target;
        const formData = new FormData(form);

        fetch('<?php echo e(route('usuarios.store')); ?>', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
            },
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud.');
            }
            return response.json();
        })
        .then(data => {
            // Mostrar el mensaje de éxito
            const messageDiv = document.getElementById('responseMessage');
            messageDiv.textContent = 'Usuario ingresado correctamente.';
            messageDiv.style.display = 'block';

            // Limpiar el formulario
            form.reset();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un problema al guardar el usuario. Por favor, inténtalo de nuevo.');
        });
    });
</script>
<?php /**PATH C:\laragon\www\portafolio3\resources\views/admin/usuarios/create.blade.php ENDPATH**/ ?>