function openCreateModal() {
    Swal.fire({
        title: 'Nueva Denuncia',
        html: `
            <form id="create-form" class="text-left">
                <div class="mb-4">
                    <label for="titulo" class="block text-gray-700 font-bold mb-2">Título</label>
                    <input type="text" id="titulo" name="titulo" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="ubicacion" class="block text-gray-700 font-bold mb-2">Ubicación</label>
                    <input type="text" id="ubicacion" name="ubicacion" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="ciudadano" class="block text-gray-700 font-bold mb-2">Nombre del Ciudadano</label>
                    <input type="text" id="ciudadano" name="ciudadano" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="telefono_ciudadano" class="block text-gray-700 font-bold mb-2">Teléfono del Ciudadano</label>
                    <input type="tel" id="telefono_ciudadano" name="telefono_ciudadano" class="w-full px-3 py-2 border border-gray-300 rounded-md" pattern="[0-9]{9}" title="Debe contener exactamente 9 dígitos numéricos" required>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonColor: '#119e40ff',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar',
        preConfirm: () => {
            const form = document.getElementById('create-form');
            const telefono = form.querySelector('#telefono_ciudadano').value;
            if (!/^[0-9]{9}$/.test(telefono)) {
                Swal.showValidationMessage('El teléfono del ciudadano debe contener exactamente 9 dígitos numéricos.');
                return false;
            }
            if (!form.checkValidity()) {
                Swal.showValidationMessage('Por favor, complete todos los campos requeridos.');
                return false;
            }
            return new FormData(form);
        }
    }).then((result) => {
        if (result.isConfirmed) {
            submitForm(null, result.value);
        }
    });
}

function openEditModal(id) {
    fetch(`?action=getDenuncia&id=${id}`)
        .then(response => response.json())
        .then(denuncia => {
            Swal.fire({
                title: 'Editar Denuncia',
                html: `
                    <form id="edit-form-${id}" class="text-left">
                        <div class="mb-4">
                            <label for="titulo" class="block text-gray-700 font-bold mb-2">Título</label>
                            <input type="text" id="titulo" name="titulo" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="${denuncia.titulo}" required>
                        </div>
                        <div class="mb-4">
                            <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción</label>
                            <textarea id="descripcion" name="descripcion" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>${denuncia.descripcion}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="ubicacion" class="block text-gray-700 font-bold mb-2">Ubicación</label>
                            <input type="text" id="ubicacion" name="ubicacion" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="${denuncia.ubicacion}" required>
                        </div>
                        <div class="mb-4">
                            <label for="ciudadano" class="block text-gray-700 font-bold mb-2">Nombre del Ciudadano</label>
                            <input type="text" id="ciudadano" name="ciudadano" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="${denuncia.ciudadano}" required>
                        </div>
                        <div class="mb-4">
                            <label for="telefono_ciudadano" class="block text-gray-700 font-bold mb-2">Teléfono del Ciudadano</label>
                            <input type="tel" id="telefono_ciudadano" name="telefono_ciudadano" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="${denuncia.telefono_ciudadano}" pattern="[0-9]{9}" title="Debe contener exactamente 9 dígitos numéricos" required>
                        </div>
                        <div class="mb-4">
                            <label for="estado" class="block text-gray-700 font-bold mb-2">Estado</label>
                            <select id="estado" name="estado" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <option value="pendiente" ${denuncia.estado === 'pendiente' ? 'selected' : ''}>Pendiente</option>
                                <option value="en proceso" ${denuncia.estado === 'en proceso' ? 'selected' : ''}>En Proceso</option>
                                <option value="resuelto" ${denuncia.estado === 'resuelto' ? 'selected' : ''}>Resuelto</option>
                            </select>
                        </div>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Actualizar',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    const form = document.getElementById(`edit-form-${id}`);
                    const telefono = form.querySelector('#telefono_ciudadano').value;
                    if (!/^[0-9]{9}$/.test(telefono)) {
                        Swal.showValidationMessage('El teléfono del ciudadano debe contener exactamente 9 dígitos numéricos.');
                        return false;
                    }
                    if (!form.checkValidity()) {
                        Swal.showValidationMessage('Por favor, complete todos los campos requeridos.');
                        return false;
                    }
                    return new FormData(form);
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    submitForm(id, result.value);
                }
            });
        });
}

function deleteDenuncia(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, ¡bórralo!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`?action=delete&id=${id}`, {
                method: 'POST' // Or 'DELETE' if you configure your server to handle it
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire(
                        '¡Borrado!',
                        'La denuncia ha sido eliminada.',
                        'success'
                    ).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire(
                        'Error',
                        'Ocurrió un error al eliminar la denuncia.',
                        'error'
                    );
                }
            });
        }
    });
}

function submitForm(id, formData) {
    const url = id ? `?action=edit&id=${id}` : '?action=create';
    const method = 'POST';

    fetch(url, {
        method: method,
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: 'Éxito',
                text: data.message,
                icon: 'success'
            }).then(() => {
                window.location.reload();
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: data.message,
                icon: 'error'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            title: 'Error',
            text: 'Ocurrió un error al procesar la solicitud.',
            icon: 'error'
        });
    });
}
