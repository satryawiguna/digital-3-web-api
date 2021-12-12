<?php
namespace App\Services\Implement;


use App\Helper\DirectoryHelper;
use App\Http\Requests\ImportData\ImportDataRequest;
use App\Services\Contract\IImportDataService;
use PHPHtmlParser\Dom;

class ImportDataService extends BaseService implements IImportDataService
{
    public function importData(ImportDataRequest $request)
    {
        $file = $request->file;
        $file->move(DirectoryHelper::IMPORT, $file->getClientOriginalName());

        $dom = new Dom;
        $dom->loadFromFile(public_path() . '/' . DirectoryHelper::IMPORT . '/' . $file->getClientOriginalName());
        $a = $dom->find('.title');
        echo count($a);
    }

}