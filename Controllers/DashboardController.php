<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        // Carrega a view do Dashboard
       
        $data['title'] = 'InPerson Dashboard';
        return view('DashboardView', $data);
    }
}