@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Usuarios</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Activo</th>
                <th class="text-nowrap">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr class="{{ $user->activo ? '' : 'inactive-user' }}">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <input type="checkbox" class="form-check-input" {{ $user->activo ? 'checked' : '' }} 
                               onchange="updateUserStatus({{ $user->id }}, this)">
                    </td>
                    <td class="text-nowrap">
                        <button class="btn btn-info btn-sm me-1" onclick="showUserDetails({{ $user->id }})">Ver</button>
                        <button class="btn btn-warning btn-sm me-1" onclick="editUser({{ $user->id }})">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }})">Eliminar</button>       
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay usuarios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal para Ver los Detalles del Usuario -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDetailsModalLabel">Detalles del Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nombre:</strong> <span id="detailsName"></span></p>
                <p><strong>Email:</strong> <span id="detailsEmail"></span></p>
                <p><strong>Administrador:</strong> <span id="detailsAdmin"></span></p>
                <p><strong>Revisor:</strong> <span id="detailsRevisor"></span></p>
                <p><strong>Activo:</strong> <span id="detailsActivo"></span></p>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar el Usuario -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editName" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="editAdmin" class="form-label">Administrador</label>
                        <select class="form-control" id="editAdmin" name="es_administrador">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editRevisor" class="form-label">Revisor</label>
                        <select class="form-control" id="editRevisor" name="es_revisor">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editActivo" class="form-label">Activo</label>
                        <select class="form-control" id="editActivo" name="activo">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script de JavaScript para manejar las acciones de los botones -->
<script>
    // Función para mostrar los detalles del usuario
    function showUserDetails(userId) {
        fetch(`/admin/usuarios/${userId}`)
            .then(response => response.json())
            .then(user => {
                document.getElementById('detailsName').textContent = user.name;
                document.getElementById('detailsEmail').textContent = user.email;
                document.getElementById('detailsAdmin').textContent = user.es_administrador ? 'Sí' : 'No';
                document.getElementById('detailsRevisor').textContent = user.es_revisor ? 'Sí' : 'No';
                document.getElementById('detailsActivo').textContent = user.activo ? 'Sí' : 'No';

                const modal = new bootstrap.Modal(document.getElementById('userDetailsModal'));
                modal.show();
            });
    }

    // Función para editar el usuario
    function editUser(userId) {
        fetch(`/admin/usuarios/${userId}/edit`)
            .then(response => response.json())
            .then(user => {
                document.getElementById('editName').value = user.name;
                document.getElementById('editEmail').value = user.email;
                document.getElementById('editAdmin').value = user.es_administrador ? 1 : 0;
                document.getElementById('editRevisor').value = user.es_revisor ? 1 : 0;
                document.getElementById('editActivo').value = user.activo ? 1 : 0;

                // Actualiza la acción del formulario para que envíe el PUT correctamente
                document.getElementById('editUserForm').action = `/admin/usuarios/${userId}`;

                const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
                modal.show();
            });
    }

    // Función para eliminar el usuario
    function deleteUser(userId) {
        if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
            fetch(`/admin/usuarios/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                location.reload(); // Recarga la página para reflejar la eliminación
            })
            .catch(error => {
                alert('Error al eliminar el usuario.');
            });
        }
    }

    // Función para actualizar el estado del usuario
    function updateUserStatus(userId, checkbox) {
        const isActive = checkbox.checked ? 1 : 0;

        fetch(`/admin/usuarios/${userId}/update-status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ activo: isActive })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualización exitosa
                alert("Estado actualizado.");
            } else {
                // En caso de error
                alert("Error al actualizar el estado.");
            }
        });
    }
</script>

@endsection

<!-- CSS para ocultar usuarios inactivos -->
<style>
    .inactive-user {
        opacity: 0.5;
    }
</style>
