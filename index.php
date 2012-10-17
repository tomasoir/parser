<?php 
 //header('Location: /work/');
require 'config/main.php';
require DIR_COMPONETS.'MySQl.php';
require DIR_COMPONETS.'Model.php';
require DIR_COMPONETS.'Html.php';
require DIR_COMPONETS.'View.php';
require DIR_COMPONETS.'Controller.php';
require DIR_COMPONETS.'Application.php';
Application::run(); 
?>