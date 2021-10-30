<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\AuthModel;
use App\Models\Master\RoleModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $page = "User";
        $title = "Cerita Kopi - User";

        $data_role = RoleModel::orderBy('name')->get();
        $data_user = AuthModel::orderBy('name')->get();

        //Notification
        $expired = expiredBahanBaku();

        return view('master.user', compact('expired', 'data_role', 'data_user', 'page', 'title'));
    }
}
