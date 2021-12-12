<?php
namespace App\Services\Contract;


use App\Http\Requests\ImportData\ImportDataRequest;

interface IImportDataService
{
    public function importData(ImportDataRequest $request);
}