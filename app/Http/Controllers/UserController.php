<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Repositories\AuthRepository;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Auth;
use PDF;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth:api', ['except' => ['register']]);
        $this->middleware('role_or_permission:super-admin|admin|users.permission.update', ['only' => ['updatePermission']]);
        $this->middleware('role_or_permission:super-admin|admin|users.delete', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:super-admin|admin|users.view', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:super-admin|admin|users.update|profile.information.update|profile.twg.update', ['only' => ['update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $filters = [];
        if($user->hasRole('admin')){
            $offices_ids = $user->user_offices->pluck('office_id');
            $filters['offices_ids'] = $offices_ids;
        }
        $attach = "user_information.section,user_offices.office,user_information.position,user_groups.group,permissions,roles";
        $users = $this->userRepository->attach($attach)->search($filters);
        return fractal($users, new UserTransformer)->parseIncludes($attach);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('pdf.purchase-request');
        $ou = "CN=Gracel Amor P. Torion,OU=Pantawid Pamilya Encoders,OU=Pantawid Provincial Office,OU=4Ps Division,OU=Clients,OU=FO11,DC=ENTDSWD,DC=LOCAL"; 
        return explode(",",$ou);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        return $this->userRepository->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->attach('user_information,user_offices,permissions,roles, user_groups.group')->getById($id);
        return fractal($user, new UserTransformer)->parseIncludes('user_information,user_offices,permissions,roles, user_groups.group');
    }

    public function auth()
    {
        $auth_user = Auth::user();
        $user = $this->userRepository->attach('user_information,user_offices.office,permissions,roles, user_groups.group')->getById($auth_user->id);
        // return $user;
        return fractal($user, new UserTransformer)->parseIncludes('user_information,user_offices.office,permissions,roles, user_groups.group');
        // sleep(5);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        return $this->userRepository->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        //
    }

    public function register(CreateUserRequest $request)
    {
        $user = $this->userRepository->create($request->all());
        $token = (new AuthRepository)->getAccessToken(['username' => $user->username, 'password' => ''], $user); // with refresh token
        return response()->json($token);  
    }

    public function updatePermission(Request $request, $id)
    {
        $user = $this->userRepository->getById($id);
        $user->syncPermissions(request('permissions'));
        $user->syncRoles(request('role'));
        return $user->permissions;
    }
}
