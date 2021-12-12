<?php
namespace App\Http\Responses;


class GenericPageResponse
{
    public $draw;

    public $recordsTotal;

    public $recordsFiltered;

    public $dto;

    /**
     * @return mixed
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * @param mixed $draw
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;
    }

    /**
     * @return mixed
     */
    public function getRecordsTotal()
    {
        return $this->recordsTotal;
    }

    /**
     * @param mixed $recordsTotal
     */
    public function setRecordsTotal($recordsTotal)
    {
        $this->recordsTotal = $recordsTotal;
    }

    /**
     * @return mixed
     */
    public function getRecordsFiltered()
    {
        return $this->recordsFiltered;
    }

    /**
     * @param mixed $recordsFiltered
     */
    public function setRecordsFiltered($recordsFiltered)
    {
        $this->recordsFiltered = $recordsFiltered;
    }

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