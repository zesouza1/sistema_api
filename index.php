<?php
require_once './core/Http.php';
require_once './core/Routes.php';
require_once './core/Core.php';

Core::dispatch( Http::routes());

//ALTERAR  NO CONTROLLER, ADICIONAR AS VALIDAÇÕES