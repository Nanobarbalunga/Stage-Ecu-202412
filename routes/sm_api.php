<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Permission;
use App\Models\User;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Get_All_Permissions
Route::get("/permissions",function(){
    $Permissions = Permission::all();

    return response()->json([
        "permissions" => $Permissions
    ]);
});

// Create_New_Permission
Route::post("/permission",function(Request $request){
    $permission = new Permission();
    $permission->user_id = $request->user_id;
    $permission->label = $request->label;
    $permission->pretty_label = $request->pretty_label;
    $permission->description = $request->description;
    $permission->save();

    return response()->json([
        "message" => "Permission created successfully"
    ]);
});

// Update_Permission
Route::put("/permission/{id}",function(Request $request,$id){
    $permission = Permission::find($id);
    $permission->label = $request->label;
    $permission->pretty_label = $request->pretty_label;
    $permission->description = $request->description;
    $permission->save();

    return response()->json([
        "message" => "Permission updated successfully"
    ]);
});

// Delete_Permission
Route::delete("/permission/{id}",function($id){
    $permission = Permission::find($id);
    $permission->delete();

    return response()->json([
        "message" => "Permission deleted successfully"
    ]);
});

// Get_All_Users
Route::get("/users",function(){
    $users = User::all();

    return response()->json([
        "users" => $users
    ]); 
});

// Create_New_User
Route::post("/user",function(Request $request){
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->save();

    return response()->json([
        "message" => "User created successfully"
    ]);
});

// Update_User
Route::put("/user/{id}",function(Request $request,$id){
    $user = User::find($id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->save();

    return response()->json([
        "message" => "User updated successfully"
    ]);
});

// Delete_User
Route::delete("/user/{id}",function($id){
    $user = User::find($id);
    $user->delete();

    return response()->json([
        "message" => "User deleted successfully"
    ]);
});