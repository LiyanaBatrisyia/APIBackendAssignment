<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserModel;
use Validator;

class User extends Controller
{

    public function user(){


        if(request()->has('gender')){
            $userList = UserModel::where('gender', request('gender'))->paginate(5)->appends('gender', request('gender'));
        }
        else{
            $userList = UserModel::paginate(5);
        }

        return response()->json($userList, 200);

        //return response()->json(UserModel::get(), 200);
    }


//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }

    public function userSave(Request $request){
        $rules = [
            'name' => 'required|min:3',
            'gender' => 'required|min:4',
            'email' => 'required|min:10',
            'password' => 'required|min:4',
        ];
        $validator = Validator::make($request->all(), USER);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = UserModel::create($request->all());
        return response()->json($user, 201);
    }

    public function userByID($id){
        $user = UserModel::find($id);
        if(is_null($user)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        return response()->json($user, 200);
    }


//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        //
//    }

    public function userUpdate(Request $request, $id){
        $user = UserModel::find($id);
        if(is_null($user)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function userDelete(Request $request, $id){
        $user = UserModel::find($id);
        if(is_null($user)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        $user->delete();
        return response()->json(null, 204);
    }
}
