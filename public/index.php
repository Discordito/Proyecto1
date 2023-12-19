<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\LoginController;
use MVC\Router;
use Controllers\DashboardController;
use Controllers\PreguntaController;
use Controllers\TareaController;

$router = new Router();

//Login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Crear Cuenta
$router->get('/crear', [LoginController::class, 'crear']);
$router->post('/crear', [LoginController::class, 'crear']);

//Formulario recuperar pass
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);

//Nuevo pass
$router->get('/reestablecer', [LoginController::class, 'reestablecer']);
$router->post('/reestablecer', [LoginController::class, 'reestablecer']);

//Confirmacion
$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/confirmar', [LoginController::class, 'confirmar']);

//dashboard / estandares
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/crear-proyecto', [DashboardController::class, 'crear_proyecto']);
$router->post('/crear-proyecto', [DashboardController::class, 'crear_proyecto']);
$router->get('/proyecto', [DashboardController::class, 'proyecto']);
$router->get('/estandar', [DashboardController::class, 'estandar']);
$router->post('/estandar', [DashboardController::class, 'estandar']);
$router->get('/perfil', [DashboardController::class, 'perfil']);
$router->post('/perfil', [DashboardController::class, 'perfil']);
$router->get('/cambiar-password', [DashboardController::class, 'cambiar_password']);
$router->post('/cambiar-password', [DashboardController::class, 'cambiar_password']);
$router->get('/registro', [DashboardController::class, 'registro']);
$router->post('/registro', [DashboardController::class, 'registro']);
$router->get('/membresia', [DashboardController::class, 'membresia']);
$router->post('/membresia', [DashboardController::class, 'membresia']);
$router->get('/pregunta', [DashboardController::class, 'pregunta']);
$router->post('/pregunta', [DashboardController::class, 'pregunta']);
$router->get('/preguntas', [DashboardController::class, 'preguntas']);
$router->get('/pregunta_usuario', [DashboardController::class, 'pregunta_usuario']);
$router->get('/donaciones', [DashboardController::class, 'donaciones']);

//Adminitrador
$router->get('/administrar', [AdminController::class, 'index']);

//api para las tareas
$router->get('/api/preguntas', [PreguntaController::class, 'index']);
$router->get('/api/recomendaciones', [DashboardController::class, 'recomendaciones']);
$router->post('/api/preguntas/actualizar', [PreguntaController::class, 'actualizar']);
$router->post('/api/preguntas/responder', [PreguntaController::class, 'responder']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();