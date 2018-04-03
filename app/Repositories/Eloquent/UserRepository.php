<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Repository;
use App\Repositories\Contracts\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * User Model.
     *
     * @var \App\Models\User $model
     */
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param \App\Models\User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
//        $this->model = $user;
    }

    /**
     * Get all users.
     */
    public function all(){
        return $this->model->all();
    }

    /**
     * Create a user.
     *
     * @param array $data
     *
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function create($data)
    {
        return User::create($data);
    }

    /**
     * Find user id.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed|null|static|static[]
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * Delete rows by ids
     *
     * @param array|int $id
     *
     * @return int
     */
    public function delete($id)
    {
        return User::destroy($id);
    }

    /**
     * Update user row by ids.
     *
     * @param array $id
     * @param array $data
     *
     * @return bool
     */
    public function update($id, array $data)
    {
        return User::find($id)->update($data);
    }

    /**
     * Get User Model.
     *
     * @return \App\Models\User
     */
    public function getModel(){
        return $this->model;
    }
}