<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use SoftDeletes;
    public function store(Request $request)
    {
        $user = User::create( $request->all());
        return true;
    }
    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->update($request->all());
        return 'update';
    }
    public function destroy($id)
    {
        if(User::destroy($id)){
            return 'delete';
        }else{
            return 'no delete';
        }
    }

}
