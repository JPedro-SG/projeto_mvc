<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

spl_autoload_register(function ($class) {
    if (file_exists("$class.php")) {
        require_once "$class.php";
        return true;
    }
    if (file_exists("model/$class.php")) {
        require_once "model/$class.php";
        return true;
    }
    if (file_exists("view/$class.php")) {
        require_once "view/$class.php";
        return true;
    }
    if (file_exists("controller/$class.php")) {
        require_once "controller/$class.php";
        return true;
    }
    if (file_exists("helpers/$class.php")) {
        require_once "helpers/$class.php";
        return true;
    }
});
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto MVC</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            min-height: 100vh;
        }

        #side_nav {
            min-height: 100vh;
            height: 100%;
        }
    </style>
</head>

<body>

<?php 
    // $ftp = FtpConexao::getInstance();

    // $arquivos = ftp_nlist($ftp, "/Downloads");
    // foreach ($arquivos as $arq) {
    //     echo $arq;
    // }
?>
    <div class="d-flex p-2 px-4 bg-primary text-white">
        <h1 class="fs-3">ARGOS</h1>
        <button onclick="toggleSideBar()" class="ms-auto btn d-md-none d-block close-btn px-1 py-0 text-white" id="nab_btn"><i class="fal fa-stream"></i></button>
    </div>
    <div class="d-flex">
        <div class="bg-dark p-4" id="side_nav">

            <ul class="flex-column text-left list-unstyled">
                <li class="px-3 py-2 d-block"><a href="?controller=EstagiarioController&method=listar" aria-current="page" class="text-decoration-none">Estagiarios</a></li>
                <li class="px-3 py-2 d-block"><a href="?controller=ProjetoController&method=listar" class="text-decoration-none">Projetos</a></li>
                <li class="px-3 py-2 d-block"><a href="?controller=PagamentoController&method=listar" class="text-decoration-none">Pagamentos</a></li>
            </ul>
        </div>
        <div class="container">
            <?php
            if ($_GET) {
                $controller = isset($_GET['controller']) ? ((class_exists($_GET['controller'])) ? new $_GET['controller'] : NULL) : null;
                $method     = isset($_GET['method']) ? $_GET['method'] : null;
                if ($controller && $method) {
                    if (method_exists($controller, $method)) {
                        $parameters = $_GET;
                        unset($parameters['controller']);
                        unset($parameters['method']);
                        call_user_func(array($controller, $method), $parameters);
                    } else {
                        echo "Método não encontrado!";
                    }
                } else {
                    echo "Controller não encontrado!";
                }
            } else {

                $estagiarioController = new EstagiarioController();
                $estagiarioController->listar();
            }
            ?>

        </div>
    </div>

    <script>
        const sideNav = document.getElementById('side_nav');
        const ulElement = sideNav.querySelector('ul');

        function toggleSideBar() {
            if (sideNav.classList.contains('active')) sideNav.classList.remove('active')
            else sideNav.classList.add('active')
        }

    </script>
</body>

</html>