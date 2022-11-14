<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('admin.permission.index', compact('users'));
    }
    public function permission($id)
    {
        $permission = '';
        $user = User::where('id', $id)->first();
        $orders = Page::where('group_id', 1)->get();
        $products = Page::where('group_id', 2)->get();
        $contents = Page::where('group_id', 3)->get();
        $settings = Page::where('group_id', 4)->get();
        $customers = Page::where('group_id', 5)->get();
        $others = Page::where('group_id', 6)->get();
        $permissions = Permission::where('user_id',$id)->get()->pluck('page_id')->toArray();
        return view('admin.permission.edit', compact('orders', 'products', 'contents', 'settings', 'customers', 'others', 'user','permissions'));
    }



    public function store(Request $request, $id)
    {
        try {
            $count = count($request->page_id);
        Permission::where('user_id', $id)->delete();
        for ($i = 0; $i < $count; $i++) {
            $permission = new Permission();
            $permission->user_id = $id;
            $permission->page_id = $request->page_id[$i];
            $permission->status = 1;
            $permission->save();
        }

        return back()->with('success', 'Permission Created Successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'Minimub one permission given');
        }
       
    }

    public function permissionTwo($id){
        $user = User::where('id',$id)->first();
        return view('admin.permission.permission_two',compact('user'));
    }

    public function permissionAction(Request $request,$id){
        $user = User::where('id',$id)->first();
        $user->action_process = $request->action_process ?? NULL;
        $user->action_view    = $request->action_view ?? NULL;
        $user->action_edit    = $request->action_edit ?? NULL;
        $user->action_create  = $request->action_create ?? NULL;
        $user->action_delete  = $request->action_delete ?? NULL;
        $user->save();
        return redirect()->route('permission.index')->with('success', 'Action Permission Created Successfully');
    }
}
