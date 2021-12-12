<?php
namespace App\Repositories\Implement;


use App\Repositories\Contract\IAuthRepository;
use Illuminate\Support\Collection;

class AuthRepository extends BaseRepository implements IAuthRepository
{
    /**
     * AuthRepository constructor.
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
     * @param array $data
     * @return static
     */
    public function signup(array $data)
    {
        $this->_model->unguard();
        $user = $this->_model->create($data);
        $user->role()->attach([4]);
        $this->_model->reguard();

        return $user;
    }

}