<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
Class UserController extends Controller {
private $request;
public function __construct(Request $request){
$this->request = $request;
}
    public function GetUsers(){
        $users = User::all();
        return response()->json($users, 200);
    }
    public function show($id)
    {
        //
        return User::where('id','like','%'.$id.'%')->get();
    }
    public function add(Request $request ){
        $rules = [
        'customer_first_name' => 'required|max:20',
        'customer_last_name' => 'required|max:20',
        ];
        $this->validate($request,$rules);
        $user = User::create($request->all());
        return $user;
       
}
    public function update(Request $request,$id)
    {
    $rules = [
    'customer_first_name' => 'max:20',
    'customer_last_name' => 'max:20',
    ];
    $this->validate($request, $rules);
    $user = User::findOrFail($id);
    $user->fill($request->all());

    // if no changes happen
    if ($user->isClean()) {
    return $this->errorResponse('At least one value must
    change', Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    $user->save();
    return $user;
}
    public function delete($id)
    {
    $user = User::findOrFail($id);
    $user->delete();

 
    // old code
    /*
    $user = User::where('userid', $id)->first();
    if($user){
    $user->delete();
    return $this->successResponse($user);
    }
    {
    return $this->errorResponse('User ID Does Not Exists',
    Response::HTTP_NOT_FOUND);
    }
    */
    }
}
