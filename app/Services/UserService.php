<?php
/**
 * Created by Liam Nelson.
 * Email: lmjnelson@yahoo.com
 */

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserService
{

    /**
     * @var \App\Repositories\Contracts\UserRepositoryInterface
     */
    private $User;

    /**
     * UserService constructor.
     *
     * @param \App\Repositories\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->User = $userRepository;
    }

    public function getAll()
    {
        return $this->User->all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->User->all();
    }

    /**
     * @return \App\Repositories\Contracts\UserRepositoryInterface
     */
    public function getUser(): \App\Repositories\Contracts\UserRepositoryInterface
    {
        return $this->User;
    }

    /**
     * @param \App\Repositories\Contracts\UserRepositoryInterface $User
     */
    public function setUser(\App\Repositories\Contracts\UserRepositoryInterface $User): void
    {
        $this->User = $User;
    }

    public function getMasterUser()
    {
        return $this->getAll()->first();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     *
     * @return mixed|static
     */
    public function update(Request $request, $id)
    {
        // update model and only pass in the fillable fields
        $this->User->update($request->only($this->User->getModel()->fillable), $id);

        return $this->User->find($id);
    }

    public function delete($id)
    {
        return $this->User->delete($id);
    }

    public function find($id)
    {
        return $this->User->find($id);
    }

}