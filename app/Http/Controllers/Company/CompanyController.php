<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Main\Company;
use App\Models\Main\User;
use App\Models\Main\UserType;
use App\Models\Main\UserTypeRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superuser');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.index', ['companies' => Company::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create', ['user_types' => UserType::all()->where('id', '!=', '1')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::debug($request);

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'user_type_id' => 'required|numeric',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails())
        {
            return redirect('/companies/create')
                ->withErrors($validator)
                ->withInput();
        }

        // Create new database for new company.
        //
        $db_name = preg_replace('/[^\w]/', '', $request->company_name);
        $db_name = strtolower($db_name) . '_' . time();
        $company = new Company();

        if ($company->createSchema($db_name)) {
            $main              = Config::get('database.connections.main');
            $company->name     = $request->company_name;
            $company->hostname = $main['host'];
            $company->username = $main['username'];
            $company->password = encrypt($main['password']);
            $company->database = $db_name;
            $company->save();
            $company->migrateNewCompanySchema($company->id, $db_name);

            // Create first Admin User for New Company
            //
            $user               = new User();
            $user->company_id   = $company->id;
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
        }

        return redirect()->route('companies.show', [$company->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('company.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
