<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Auth;
use PDF;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->getAll($request);
        return fractal($users, new UserTransformer)->parseIncludes('user_information.section');
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
        return $this->userRepository->register($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->attach('user_information,signatories,permissions')->getById($id);
        return $user;
        // return fractal($User, new UserTransformer)->parseIncludes('unit_of_measure,User_category');
    }

    public function auth()
    {
        $auth_user = Auth::user();
        $user = $this->userRepository->attach('user_information,signatories,permissions')->getById($auth_user->id);
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
    public function update(Request $request, User $User)
    {
        //
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
        return $this->userRepository->register($request->all());
    }
}
