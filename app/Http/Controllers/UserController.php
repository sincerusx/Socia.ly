<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Response;

class UserController extends Controller
{

    /**
     * User Repository
     *
     * @var \App\Repositories\Contracts\UserRepositoryInterface $User
     */
    protected $User;

    /**
     * UserController constructor.
     *
     * @param \App\Repositories\Contracts\UserRepositoryInterface $user
     */
    public function __construct(UserRepositoryInterface $user)
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
        return Response::json(['user' => $this->User->all()]);
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
     * @param  int $id
     */
    public function edit($id)
    {
        return $this->User->update($id);
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
        // update model and only pass in the fillable fields
//        $this->User->update($request->only($this->User->getModel()->fillable), $id);

        return $this->User->find($id);
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
