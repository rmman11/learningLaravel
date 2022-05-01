<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{



  public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


         $users= AdminUser::orderBy('id', 'DESC')->get();

      //  dd($users);
        return view('admin.users.index', compact('users'),['users' => $users]);
    }

    public function profile(AdminUser $user)
    {
        $title = 'Edit';
        $user  = Auth::user();

          $roles = Role::all()->pluck('title', 'id');
      //  dd($user);
        return view('admin.profile.index', compact('user'));
    }
    public function create()
    {


        $roles = Role::all()->pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }


  //create user and store in database
    public function store(Request $request)
    {



    $admin = new AdminUser();
    $roles = Role::all()->pluck('title');

    $this -> validate($request, ['password' => 'required',
                                'username' => 'required |max:8']);


  $time = Carbon::now();

  $admin->username = $request->username;
  $admin->email = $request->email;
  $admin->password = $request->password;
  $admin->created_at = $time;


  if ($request->hasFile('avatar')) {
    //$file = Input::file('image');
    $file = $request->file('avatar');
    //getting timestamp
    $timestamp = str_replace([' ', ':'], '-', Carbon::now() -> toDateTimeString());

    $name = $timestamp . '-' . $file -> getClientOriginalName();
    $data['avatar'] = '/image/avatars/' .$request->file('avatar')->getClientOriginalName();
    $admin->avatar = $name;

    $file->move(public_path() . '/image/avatars/', $name);
    //dd($name);

  }


  $admin->save();
  return redirect()->route('admin.users.index');
    }

    public function edit(AdminUser $user)
     {
        // $user = Auth::user();
         $roles = Role::all()->pluck('title', 'id');

         $user->load('roles');

      return view('admin.users.edit', compact('roles', 'user'));

     }


  public function update(UpdateUserRequest $request, AdminUser $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

  public function show(AdminUser $user)
    {


        $user->load('roles');
        return view('admin.users.show', compact('user'));
    }

    public function destroy(AdminUser $user)
    {

        $user->delete();
        return back();
    }

    public function massDestroy(Request $request)
     {
         User::whereIn('id', request('ids'))->delete();

         return response(null, Response::HTTP_NO_CONTENT);
     }


}
