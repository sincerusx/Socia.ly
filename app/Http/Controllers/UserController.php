<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Http\Request;
use Response;

class UserController extends Controller
{

    /**
     * User Repository
     *
     * @var \App\Services\UserService $User
     */
    protected $User;

    /**
     * UserController constructor.
     *
     * @param \App\Services\UserService $user
     */
    public function __construct(UserService $user)
    {
        $this->User = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        return Response::json(['user' => $this->User->all(), $this->User->getMasterUser()]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($id)
    {
        return $this->User->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int                     $id
     *
     * @return \App\Services\UserService|mixed
     */
    public function edit(Request $request, $id)
    {
        return $this->User->update($request, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return User|User[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed|null
     */
    public function update(Request $request, $id)
    {
        return $this->User->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return int
     */
    public function destroy($id)
    {
        return $this->User->delete($id);
    }

}
