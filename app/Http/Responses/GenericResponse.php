<?php
namespace App\Http\Responses;


class GenericResponse
{
    public $dto;

    /**
     * @return mixed
     */
    public function getDto()
    {
        return $this->dto;
    }

    /**
     * @param mixed $dto
     */
    public function setDto($dto)
    {
        $this->dto = $dto;
    }


}