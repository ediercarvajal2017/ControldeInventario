// public/assets/js/elementos.js
// JS para confirmación de eliminación con estilo profesional en el módulo elementos

document.addEventListener('DOMContentLoaded', function() {
    const deleteLinks = document.querySelectorAll('.elementos-action-delete');
    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            mostrarConfirmacionElemento(link.getAttribute('href'));
        });
    });
});

function mostrarConfirmacionElemento(url) {
    // Crear overlay
    const overlay = document.createElement('div');
    overlay.className = 'modal-overlay';
    // Crear modal
    const modal = document.createElement('div');
    modal.className = 'modal-confirmacion';
    modal.innerHTML = `
        <h3>¿Eliminar elemento?</h3>
        <p>Esta acción no se puede deshacer.<br>¿Deseas continuar?</p>
        <div class="modal-btns">
            <button class="btn btn-cancelar">Cancelar</button>
            <button class="btn btn-eliminar">Eliminar</button>
        </div>
    `;
    overlay.appendChild(modal);
    document.body.appendChild(overlay);

    // Botones
    modal.querySelector('.btn-cancelar').onclick = function() {
        document.body.removeChild(overlay);
    };
    modal.querySelector('.btn-eliminar').onclick = function() {
        window.location.href = url;
    };
}
