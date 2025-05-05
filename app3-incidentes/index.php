<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Incidentes TI</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
<?php
session_start();

// Simulación de un proceso de autenticación: en un escenario real, validarías contra una BDD.
if (isset($_POST['login'])) {
    // Estas son las "credenciales" de ejemplo
    $users = [
        'usuario'    => ['password' => 'user123',    'role' => 'usuario'],
        'tecnico'    => ['password' => 'tech123',    'role' => 'tecnico'],
        'supervisor' => ['password' => 'super123',   'role' => 'supervisor']
    ];

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        // Se guarda la información del usuario en la sesión
        $_SESSION['user'] = [
            'username' => $username,
            'role'     => $users[$username]['role']
        ];
        // Redirecciona para evitar reenvío del form
        header("Location: index.php");
        exit();
    } else {
        $error = "Credenciales no válidas.";
    }
}
?>
    <?php if (!isset($_SESSION['user'])): ?>
        <!-- Vista de login -->
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" action="index.php">
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Entrar</button>
        </form>
    <?php else: ?>
        <!-- Vista para usuarios autenticados -->
        <?php 
            $username = htmlspecialchars($_SESSION['user']['username']);
            $role     = htmlspecialchars($_SESSION['user']['role']);
        ?>
        <h2>Bienvenido, <?= ucfirst($username); ?></h2>
        <p>Rol asignado: <strong><?= ucfirst($role); ?></strong></p>
        
        <!-- Menú según rol -->
        <nav class="my-4">
            <ul class="nav nav-tabs">
                <!-- Incidentes: vista general accesible a todos -->
                <li class="nav-item">
                    <a class="nav-link" href="incidentes.php">Incidentes</a>
                </li>
                <!-- Rol de Supervisor: acceso a la asignación de incidentes -->
                <?php if ($role === 'supervisor'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="asignar_incidentes.php">Asignar Incidentes</a>
                    </li>
                <?php endif; ?>
                <!-- Rol de Técnico: acceso a resolver incidentes -->
                <?php if ($role === 'tecnico'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="resolver_incidentes.php">Resolver Incidentes</a>
                    </li>
                <?php endif; ?>
                <!-- Rol de Usuario: acceso a crear nuevos incidentes -->
                <?php if ($role === 'usuario'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="crear_incidente.php">Crear Incidente</a>
                    </li>
                <?php endif; ?>
                <!-- Opción para cerrar sesión -->
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Cerrar Sesión</a>
                </li>
            </ul>
        </nav>
        
        <div class="mt-4">
            <p>No hay incidentes que mostrar</p>
        </div>
    <?php endif; ?>
</div>
</body>
</html>


