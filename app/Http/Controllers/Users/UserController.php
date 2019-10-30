<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Main\User;
use App\Models\Main\UserType;
use App\Models\Main\UserTypeRole;
use App\Models\Main\ContactMethodType;
use App\Models\Main\Role;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use SoftDeletes, SerializesModels;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('tenant');
    }

    public function current_user()
    {
        return Auth::user();
    }

    public function index()
    {
        $users           = User::AllUsers()->get();
        $counts          = [];
        $counts['all']   = count($users);
        $counts['admin'] = count($users->whereIn('type_user_id', [User::ADMIN]));
        $counts['sales'] = count($users->whereIn('type_user_id', [User::CSR, User::SALES, User::SALES_MGR, User::MARKETING]));
        $counts['tech']  = count($users->whereIn('type_user_id', [User::TECH, User::FIELD_TECH, User::FOREMAN]));

        return view('user.index')
            ->with('users', $users)
            ->with('counts', $counts);
    }

    public function search(Request $request)
    {
        $users = User::AllUsers()->where('type_user_id', '<>', User::SUPER);
        $users = $users->where('first_name', 'LIKE', "%{$request->search_term}%")
            ->orWhere('last_name', 'LIKE', "%{$request->search_term}%")
            ->orWhere('email', 'LIKE', "%{$request->search_term}%")
            ->get();

        $counts          = [];
        $counts['all']   = count($users);
        $counts['admin'] = count($users->whereIn('type_user_id', [User::ADMIN]));
        $counts['sales'] = count($users->whereIn('type_user_id', [User::CSR, User::SALES, User::SALES_MGR, User::MARKETING]));
        $counts['tech']  = count($users->whereIn('type_user_id', [User::TECH, User::FIELD_TECH, User::FOREMAN]));

        return view('user.index')
            ->with('users', $users)
            ->with('counts', $counts);
    }

    public function create()
    {
        return view('user.create', [
            'user_method_types' => ContactMethodType::all(),
            'user_types'        => UserType::AllTypes()->get(),
        ]);
    }

    public function store(Request $request)
    {
        Log::debug($request);

        $validator = Validator::make($request->all(), [
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'user_type_id' => 'required|numeric',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails())
        {
            return redirect('/users/create')
                ->withErrors($validator)
                ->withInput();
        }

        $user               = new User();
        $user->company_id   = Auth::user()->company_id;
        $user->type_user_id = $request->user_type_id;
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->email        = $request->email;
        $user->password     = bcrypt($request->password);
        $user->save();

        // fetch default roles assigned by user type
        //
        $user_type_roles = UserTypeRole::all()->where('type_user_id', $request->user_type_id);

        foreach ($user_type_roles as $user_type_role)
        {
            $user->roles()->attach($user_type_role->role_id);
        }

        return redirect()->route('users.show', [$user->id]);
    }

    public function show($id)
    {
         $roles      = Role::Configurable()->get();
         $parents    = Role::Parent()->get();
         $user       = User::find($id);
         $user_roles = [];

         foreach ($user->roles as $i => $user_role) {
             $user_roles[] = $user_role->id;
         }

         return view('user.show', [
             'parents'    => $parents,
             'roles'      => $roles,
             'user'       => $user,
             'user_roles' => $user_roles,
             'user_type'  => UserType::find($user->type_user_id)
         ]);
    }

    public function edit(User $user)
    {
        return view('user.edit', [
            'parents'           => Role::Parent()->get(),
            'roles'             => Role::Configurable()->get(),
            'user'              => $user,
            'user_method_types' => ContactMethodType::all(),
            'user_types'        => UserType::AllTypes()->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        Log::debug($request);

        $validator = Validator::make($request->all(), [
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'user_type_id' => 'required|numeric',
        ]);

        if ($validator->fails())
        {
            return redirect("/users/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($id);
        $user->roles()->detach();

        foreach ($request->role_user as $role => $toggle) {
            if ($toggle == 'on') {
                $user->roles()->attach($role);
            }
        }

        return redirect()->route('users.show', [$user->id]);
    }

    public function profile()
    {
       return view('user.profile', ['user' => Auth::user()]);
    }

    public function settings()
    {
       return view('user.settings', ['user' => Auth::user()]);
    }

    public function destroy($id)
    {
        $user = new User;
        $user = $user->find($id);
        $user->delete();
        $user->roles()->detach();
        return redirect()->route('users.index');
    }
}
