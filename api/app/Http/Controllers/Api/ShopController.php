<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return DefaultResource::collection([]);
    }
}
