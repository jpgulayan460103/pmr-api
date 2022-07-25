<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Repositories\NotificationRepository;
use App\Transformers\NotificationTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    
    private $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $notifications = $this->notificationRepository->getByUserId($user->id);
        return fractal($notifications, new NotificationTransformer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->notificationRepository->update($id, [
            'status' => 0,
        ]);
        $user = Auth::user();
        $notifications = (new NotificationRepository())->getByUserId($user->id);
        return fractal($notifications, new NotificationTransformer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $user = Auth::user();
        if($id == null){
            (new NotificationRepository())->clearNotifications($user->id);
        }else{
            (new NotificationRepository())->delete($id);
        }
        $notifications = (new NotificationRepository())->getByUserId($user->id);
        return fractal($notifications, new NotificationTransformer);
    }
}
