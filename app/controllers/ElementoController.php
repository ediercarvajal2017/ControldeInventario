<?php
// Controlador para la gestión de elementos del inventario
// Permite listar, crear, editar, actualizar y eliminar elementos
namespace App\Controllers;

require_once __DIR__ . '/../models/Elemento.php';
use App\Models\Elemento;

class ElementoController {
    /**
     * Muestra el listado de elementos
     */
    public function index() {
        $elementos = Elemento::getAll(); // Obtener todos los elementos
        include __DIR__ . '/../views/elementos/index.php'; // Incluir la vista
    }

    /**
     * Muestra el formulario para crear un nuevo elemento
     */
    public function create() {
        include __DIR__ . '/../views/elementos/create.php';
    }

    /**
     * Procesa el formulario de creación de elemento
     * @param array $data Datos del formulario
     */
    public function store()
    {


    // Procesar subida de archivos
    $ruta_foto = '';
    $ruta_factura = '';
    $error = '';
        // Validar código único antes de guardar
        require_once __DIR__ . '/../models/Elemento.php';
        if (\App\Models\Elemento::codigoExiste($_POST['codigo'] ?? '')) {
            $error .= "El código ingresado ya existe. Por favor, ingresa uno diferente.";
            include __DIR__ . '/../views/elementos/create.php';
            return;
        }

        // Procesar foto
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $nombreFoto = uniqid() . '_' . basename($_FILES['foto']['name']);
            $destinoFoto = __DIR__ . '/../../public/uploads/' . $nombreFoto;
            if (!is_dir(__DIR__ . '/../../public/uploads/')) {
                mkdir(__DIR__ . '/../../public/uploads/', 0777, true);
            }
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $destinoFoto)) {
                $error .= "Error al subir la foto. ";
            } else {
                $ruta_foto = 'uploads/' . $nombreFoto;
            }
        } else {
            $error .= "La foto es obligatoria. ";
        }

        // Procesar factura
        if (isset($_FILES['factura']) && $_FILES['factura']['error'] === UPLOAD_ERR_OK) {
            $nombreFactura = uniqid() . '_' . basename($_FILES['factura']['name']);
            $destinoFactura = __DIR__ . '/../../public/uploads/' . $nombreFactura;
            if (!is_dir(__DIR__ . '/../../public/uploads/')) {
                mkdir(__DIR__ . '/../../public/uploads/', 0777, true);
            }
            if (!move_uploaded_file($_FILES['factura']['tmp_name'], $destinoFactura)) {
                $error .= "Error al subir la factura. ";
            } else {
                $ruta_factura = 'uploads/' . $nombreFactura;
            }
        } else {
            $error .= "La factura es obligatoria. ";
        }

        // Obtener un usuario válido de la base de datos
        $usuario_registro_id = null;
        try {
            require_once __DIR__ . '/../models/Conexion.php';
            $pdo = \App\Models\Conexion::conectar();
            $stmt = $pdo->query("SELECT id FROM usuarios LIMIT 1");
            $usuario = $stmt->fetch();
            if ($usuario) {
                $usuario_registro_id = $usuario['id'];
            } else {
                $error .= "No hay usuarios registrados. ";
            }
        } catch (\Exception $e) {
            $error .= "Error de conexión a la base de datos. ";
        }

        // Validar campos requeridos
        if (
            empty($_POST['codigo']) ||
            empty($_POST['descripcion']) ||
            empty($ruta_foto) ||
            empty($_POST['valor']) ||
            empty($ruta_factura) ||
            empty($_POST['fecha_ingreso']) ||
            empty($usuario_registro_id)
        ) {
            $error .= "Todos los campos son obligatorios y debe existir al menos un usuario registrado.";
        }

        if ($error === '') {
            $data = [
                'codigo' => $_POST['codigo'],
                'descripcion' => $_POST['descripcion'],
                'foto' => $ruta_foto,
                'valor' => $_POST['valor'],
                'factura' => $ruta_factura,
                'fecha_ingreso' => $_POST['fecha_ingreso'],
                'usuario_registro_id' => $usuario_registro_id
            ];

            if (\App\Models\Elemento::create($data)) {
                header('Location: /ControldeInventario/elementos/create?exito=1');
                exit;
            } else {
                $error = "Ocurrió un error al registrar el elemento en la base de datos.";
                include __DIR__ . '/../views/elementos/create.php';
            }
        } else {
            include __DIR__ . '/../views/elementos/create.php';
        }
    }

    /**
     * Muestra el formulario para editar un elemento existente
     * @param int $id ID del elemento
     */
    public function edit($id) {
        $elemento = Elemento::getById($id); // Obtener el elemento
        include __DIR__ . '/../views/elementos/edit.php'; // Incluir la vista
    }

    /**
     * Procesa el formulario de actualización de elemento
     * @param int $id ID del elemento
     * @param array $data Datos del formulario
     */
    public function update($id, $data) {
        // Obtener el elemento actual
        $elemento = Elemento::getById($id);
        if (!$elemento) {
            die('Elemento no encontrado.');
        }
        // Validar código único antes de actualizar
        require_once __DIR__ . '/../models/Elemento.php';
        if (\App\Models\Elemento::codigoExiste($_POST['codigo'] ?? '', $id)) {
            $error = "El código ingresado ya existe. Por favor, ingresa uno diferente.";
            include __DIR__ . '/../views/elementos/edit.php';
            return;
        }

        // Procesar foto
        $ruta_foto = $elemento['foto'];
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $nombreFoto = uniqid() . '_' . basename($_FILES['foto']['name']);
            $destinoFoto = __DIR__ . '/../../public/uploads/' . $nombreFoto;
            if (!is_dir(__DIR__ . '/../../public/uploads/')) {
                mkdir(__DIR__ . '/../../public/uploads/', 0777, true);
            }
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $destinoFoto)) {
                $ruta_foto = 'uploads/' . $nombreFoto;
            }
        }

        // Procesar factura
        $ruta_factura = $elemento['factura'];
        if (isset($_FILES['factura']) && $_FILES['factura']['error'] === UPLOAD_ERR_OK) {
            $nombreFactura = uniqid() . '_' . basename($_FILES['factura']['name']);
            $destinoFactura = __DIR__ . '/../../public/uploads/' . $nombreFactura;
            if (!is_dir(__DIR__ . '/../../public/uploads/')) {
                mkdir(__DIR__ . '/../../public/uploads/', 0777, true);
            }
            if (move_uploaded_file($_FILES['factura']['tmp_name'], $destinoFactura)) {
                $ruta_factura = 'uploads/' . $nombreFactura;
            }
        }

        // Obtener un usuario válido de la base de datos (mantener el actual)
        $usuario_registro_id = $elemento['usuario_registro_id'];

        $dataUpdate = [
            'codigo' => $_POST['codigo'],
            'descripcion' => $_POST['descripcion'],
            'foto' => $ruta_foto,
            'valor' => $_POST['valor'],
            'factura' => $ruta_factura,
            'fecha_ingreso' => $_POST['fecha_ingreso'],
            'usuario_registro_id' => $usuario_registro_id
        ];
        if (Elemento::update($id, $dataUpdate)) {
            header('Location: /ControldeInventario/elementos/edit?id=' . $id . '&exito=1');
            exit;
        } else {
            $error = "Ocurrió un error al actualizar el elemento.";
            include __DIR__ . '/../views/elementos/edit.php';
        }
    }

    public function delete($id) {
    Elemento::delete($id); // Eliminar el elemento
    header('Location: /ControldeInventario/elementos'); // Redirigir al listado
    exit;
    }
}
