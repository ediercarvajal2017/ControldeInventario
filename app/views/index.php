
<div class="inicio-container" style="display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:60vh;">
	<h1 style="font-size:2.8em;font-weight:900;color:#198754;text-align:center;margin-bottom:0.7em;letter-spacing:1.5px;">Control de Inventario MC</h1>
	<h2 style="font-size:1.5em;font-weight:600;color:#0077b6;text-align:center;margin-bottom:1em;">Bienvenido al Sistema de Control de Inventario</h2>
	<p style="font-size:1.1em;text-align:center;max-width:500px;">Utiliza el menú superior o las tarjetas de acceso rápido para navegar por las diferentes secciones del sistema.</p>

	<div class="panel-acceso">
		<a href="<?= rtrim(BASE_URL, '/') ?>/usuarios" class="tarjeta-modulo">
			<div class="icono-modulo">👤</div>
			<div class="nombre-modulo">Usuarios</div>
			<div class="desc-modulo">Gestión de usuarios del sistema</div>
		</a>
		<a href="<?= rtrim(BASE_URL, '/') ?>/elementos" class="tarjeta-modulo">
			<div class="icono-modulo">📦</div>
			<div class="nombre-modulo">Elementos</div>
			<div class="desc-modulo">Inventario de elementos registrados</div>
		</a>
		<a href="<?= rtrim(BASE_URL, '/') ?>/asignaciones" class="tarjeta-modulo">
			<div class="icono-modulo">🔗</div>
			<div class="nombre-modulo">Asignaciones</div>
			<div class="desc-modulo">Asignación de elementos a usuarios o espacios</div>
		</a>
		<a href="<?= rtrim(BASE_URL, '/') ?>/espacios" class="tarjeta-modulo">
			<div class="icono-modulo">🏢</div>
			<div class="nombre-modulo">Espacios</div>
			<div class="desc-modulo">Gestión de espacios físicos</div>
		</a>
		<a href="<?= rtrim(BASE_URL, '/') ?>/instituciones" class="tarjeta-modulo">
			<div class="icono-modulo">🏫</div>
			<div class="nombre-modulo">Instituciones</div>
			<div class="desc-modulo">Información de instituciones</div>
		</a>
		<a href="<?= rtrim(BASE_URL, '/') ?>/movimientos" class="tarjeta-modulo">
			<div class="icono-modulo">🔄</div>
			<div class="nombre-modulo">Movimientos</div>
			<div class="desc-modulo">Historial de movimientos de inventario</div>
		</a>
	</div>
</div>
