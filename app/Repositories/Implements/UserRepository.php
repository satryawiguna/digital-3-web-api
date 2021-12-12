<?php
namespace App\Repositories\Implement;


use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Repositories\Contract\IUserRepository;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class UserRepository extends BaseRepository implements IUserRepository
{

    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_criteria = new Collection();
    }

    /**
     *
     */
    public function model()
    {
        return 'App\Models\User';
    }

    /**
     * @param CreateUserRequest $request
     * @return int|mixed
     */
    public function create(CreateUserRequest $request)
    {
        $user = $this->_model;

        $user->email = $request->getEmail();
        $user->password = $request->getPassword();
        $user->created_at = Carbon::now();

        $result = $user->save() ? $user->id : 0;

        $user->role()->attach([$request->getRole()->role_id]);

        return $result;
    }

    /**
     * @param UpdateUserRequest $request
     * @return int
     */
    public function update(UpdateUserRequest $request)
    {
        $user = $this->_model->find($request->getId());

        $user->email = $request->getEmail();

        if (!empty($request->getPassword())) {
            $user->password = $request->getPassword();
        }

        $user->status = $request->getStatus();
        $user->updated_at = Carbon::now();

        $result = $user->save() ? $user->id : 0;

        $user->role()->sync([$request->getRole()->role_id]);

        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $user = $this->_model->whereId($id);

        return $user->delete();
    }

    /**
     * @param $email
     * @return \Illuminate\Database\Eloquent\Collection|int|mixed|static[]
     */
    public function userActivate($email)
    {
        $user = $this->_model->where('email', $email)->firstOrFail();

        $user->status = 1;
        $user->updated_at = Carbon::now();

        $result = $user->save() ? $user->id : 0;

        return $result;
    }
}