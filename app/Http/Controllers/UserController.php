<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponser;
use DB;

Class UserController extends Controller {
    use ApiResponser;
    private $request;
    public function __construct(Request $request){
    $this->request = $request;
}
public function getUsers(){
    $users = DB::connection('mysql')
    ->select("Select * from tbluser");
    // return response()->json($users, 200);
    return $this->successResponse($users);
}
// GET
    public function index(){
        $users = User::all();
        
        // return response()->json($users, 200);
        return $this->successResponse($users);
    }
// GET (ID)
    public function showUsers($id)
    {
        $users = User::findOrFail($id);
        return $this->successResponse($users);
    
    // old code
    /*
    $user = User::where('userid', $id)->first();
    if($user){
    return $this->successResponse($user);
    }
    {
    return $this->errorResponse('User ID Does Not Exists',
    Response::HTTP_NOT_FOUND);
    }
    */
}
// ADD 
    public function addUsers(Request $request ){
        $rules = [
            'customer_first_name' => 'required|max:20',
            'customer_last_name' => 'required|max:20',
            'customer_phone_number' => 'required|max:20',
        ];
        $this->validate($request,$rules);
        $users = User::create($request->all());
        return $this->successResponse($users);
// UPDATE
}
    public function updateUsers(Request $request,$id)
    {
    $rules = [
        'customer_first_name' => 'required|max:20',
        'customer_last_name' => 'required|max:20',
        'customer_phone_number' => 'required|max:20',
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

// DELETE
}
    public function deleteUsers($id)
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