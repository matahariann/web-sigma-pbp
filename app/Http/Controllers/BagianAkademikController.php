<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BagianAkademikController extends Controller
{
    public function index()
    {
        return Inertia::render('(bagian-akademik)/dashboard-bagian-akademik/page');
    }
}
