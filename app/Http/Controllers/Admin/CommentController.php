<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.comments.index');
    }
}
