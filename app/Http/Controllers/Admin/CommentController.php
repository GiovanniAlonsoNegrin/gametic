<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.comments.index')->only('index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.comments.index');
    }
}
