<?php
namespace App\Controller;

class Error
{
    public function index()
    {
        require_once 'app/Views/Error404.php';
    }
}