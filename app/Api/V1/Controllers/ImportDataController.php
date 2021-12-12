<?php
namespace App\Api\V1\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\ImportData\ImportDataRequest;
use App\Http\Requests;
use App\Services\Contract\IImportDataService;
use Illuminate\Http\Request;

class ImportDataController extends Controller
{   private $_importDataService;

    private $_request;

    private $_importDataRequest;

    /**
     * RoleController constructor.
     * @param Request $request \
     * @param IImportDataService $importDataService
     */
    public function __construct(Request $request, IImportDataService $importDataService)
    {
        $this->_request = $request;

        $this->_importDataService = $importDataService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function product()
    {
        $this->_importDataRequest = new ImportDataRequest();

        $this->_importDataRequest->file = $this->_request->file('file');

        $result = $this->_importDataService->importData($this->_importDataRequest);

        return response()->json($result);
    }
}