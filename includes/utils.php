
<?php


function debugear($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
};

// Escapa html de los campos de los formularios
function sanitizar($html): string
{
    $sanitize = htmlspecialchars($html);
    return $sanitize;
}
// verifica si existe una sesion
function isAuth(): void 
{
    if(!isset($_SESSION['login'])) {
        header('Location: /upTask/auth/login');
    }
}