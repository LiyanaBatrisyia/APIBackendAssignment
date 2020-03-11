<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use Illuminate\Http\Request;

use App\Models\UserModel;
use Validator;
use DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request ->get('data');

        if($request -> has('search')){
            $userList = UserModel::select('id', 'name', 'gender', 'email')
                -> where('name', 'like', "%$request->search%")
                -> orWhere('email', 'like', "%$request->search%")
                -> orWhere('gender', 'like', "%$request->search%")
                -> get();
        }
        else{
           $userList = UserModel::paginate(5);
        }

        //return response()->json($userList,  200);

        return response()->json(['data' => $userList], 200);

    }

    public function indexTrash(){
        $userList = UserModel::paginate(5);

        //show trashed data
        $trash = DB::table('users')
            -> whereNotNull('deleted_at')
            ->get();
        return view('trash', ['users' => $userList, 'trash' => $trash]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestRequest $request)
    {
        $user = UserModel::create($request->all());
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = UserModel::find($id);
        if(is_null($user)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestRequest $request, $id)
    {

        $user = UserModel::find($id);
        if(is_null($user)){
            return response()->json(["message" => "Record not found!"], 404);
        }

        $user->update($request->all());
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = UserModel::find($id);
        if(is_null($user)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        $user->delete();
        return response()->json(null, 204);
    }

}
