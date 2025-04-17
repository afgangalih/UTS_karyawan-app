<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }
    
    public function dashboard()
    {
        $breadcrumb = (object) [
            'title' => 'Dashboard Admin',
            'list' => ['Home', 'Dashboard']
        ];

        $page = (object) [
            'title' => 'Panel Kontrol Admin'
        ];

        $activeMenu = 'dashboard';
        
        return view('admin.dashboard', compact('breadcrumb', 'page', 'activeMenu'));
    }
}