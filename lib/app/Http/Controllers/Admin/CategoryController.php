<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CategoryController extends Controller
{
    //
    public function getCategory()
    {
        return view('backend.category');
    }
    public function getEditCategory()
    {
        return view('backend.editcategory');
    }
}
