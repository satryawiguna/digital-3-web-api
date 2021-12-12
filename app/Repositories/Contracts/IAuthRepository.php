<?php
namespace App\Repositories\Contract;


interface IAuthRepository
{
    /**
     * @return mixed
     */
    public function model();

    /**
     * @param array $data
     * @return mixed
     */
    public function signup(array $data);
}