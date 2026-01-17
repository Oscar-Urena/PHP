<?php

session_start();

function getCities() {
    try {
        $response = file_get_contents("./controller/city.controller.php");
        return json_decode($response, true);
    } catch (Exception $e) {
        return [];
    }
}

$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'delete':
                $id = $_POST['id'] ?? '';
                $context = stream_context_create([
                    'http' => [
                        'method' => 'DELETE',
                        'header' => 'Content-Type: application/x-www-form-urlencoded'
                    ]
                ]);
                file_get_contents("back-end/controller/city.controller.php?id=$id", false, $context);
                header("Location: app.php");
                exit;
                break;

            case 'update':
                // Lógica de actualización
                $id = $_POST['id'] ?? '';
                $name = $_POST['name'] ?? '';
                $population = $_POST['population'] ?? '';
                $country = $_POST['country'] ?? '';

                $context = stream_context_create([
                    'http' => [
                        'method' => 'PUT',
                        'header' => 'Content-Type: application/x-www-form-urlencoded',
                        'content' => http_build_query([
                            'id' => $id,
                            'name' => $name,
                            'population' => $population,
                            'country' => $country
                        ])
                    ]
                ]);
                file_get_contents("back-end/controller/city.controller.php", false, $context);
                header("Location: app.php");
                exit;
                break;
        }
    }
}

$ciudades = getCities();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ciudades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        button {
            padding: 6px 12px;
            margin: 2px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
        }
        .btn-update {
            background-color: #2196F3;
            color: white;
        }
        .btn-search {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
        }
        button:hover {
            opacity: 0.8;
        }
        .mensaje {
            padding: 10px;
            margin: 10px 0;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<h1>Gestión de Ciudades</h1>

<?php if ($mensaje): ?>
    <div class="mensaje"><?php echo htmlspecialchars($mensaje); ?></div>
<?php endif; ?>

<form method="GET" action="app.php">
    <button type="submit" id="btnBuscar" class="btn-search">Buscar/Actualizar Ciudades</button>
</form>

<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Población</th>
        <th>País</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($ciudades)): ?>
        <tr>
            <td colspan="4" style="text-align: center;">No hay ciudades registradas</td>
        </tr>
    <?php else: ?>
        <?php foreach ($ciudades as $index => $ciudad): ?>
            <tr id="<?php echo $index + 1; ?>">
                <td><?php echo htmlspecialchars($ciudad['name'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($ciudad['population'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($ciudad['country'] ?? ''); ?></td>
                <td>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($ciudad['id'] ?? $index + 1); ?>">
                        <button type="submit" class="btn-delete" onclick="return confirm('¿Estás seguro de eliminar esta ciudad?')">Delete</button>
                    </form>

                    <button type="button" class="btn-update" onclick="editarCiudad(<?php echo htmlspecialchars(json_encode($ciudad)); ?>)">Update</button>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>

<!-- Modal de edición (opcional) -->
<div id="modalEdit" style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 2px solid #333; border-radius: 8px; z-index: 1000;">
    <h2>Editar Ciudad</h2>
    <form method="POST">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" id="edit_id">
        <div>
            <label>Nombre: <input type="text" name="name" id="edit_name" required></label>
        </div>
        <div>
            <label>Población: <input type="number" name="population" id="edit_population" required></label>
        </div>
        <div>
            <label>País: <input type="text" name="country" id="edit_country" required></label>
        </div>
        <div style="margin-top: 10px;">
            <button type="submit" class="btn-update">Guardar</button>
            <button type="button" onclick="cerrarModal()">Cancelar</button>
        </div>
    </form>
</div>

<script>
    function editarCiudad(ciudad) {
        document.getElementById('edit_id').value = ciudad.id || '';
        document.getElementById('edit_name').value = ciudad.name || '';
        document.getElementById('edit_population').value = ciudad.population || '';
        document.getElementById('edit_country').value = ciudad.country || '';
        document.getElementById('modalEdit').style.display = 'block';
    }

    function cerrarModal() {
        document.getElementById('modalEdit').style.display = 'none';
    }
</script>
</body>
</html>