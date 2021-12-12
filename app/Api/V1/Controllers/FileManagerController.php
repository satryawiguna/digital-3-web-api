<?php
namespace App\Api\V1\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileManager\FileManagerRequest;
use App\Services\Contract\IFileManagerService;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    private $_fileManagerService;

    private $_request;

    private $_fileManagerRequest;

    /**
     * RoleController constructor.
     * @param Request $request \
     * @param IFileManagerService $fileManagerService
     */
    public function __construct(Request $request, IFileManagerService $fileManagerService)
    {
        $this->_request = $request;

        $this->_fileManagerService = $fileManagerService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAccessKey()
    {
        $this->_fileManagerRequest = new FileManagerRequest();

        $this->_fileManagerRequest->email = $this->_request->get('email');

        $result = $this->_fileManagerService->getAccessKey($this->_fileManagerRequest);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function folderPath()
    {
        $this->_fileManagerRequest = new FileManagerRequest();

        $this->_fileManagerRequest->folder_path = $this->_request->get('folderPath');

        $result = $this->_fileManagerService->folderPath($this->_fileManagerRequest);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function subFolderPath()
    {
        $this->_fileManagerRequest = new FileManagerRequest();

        $this->_fileManagerRequest->folder_path = $this->_request->get('folderPath');
        $this->_fileManagerRequest->sub_folder_path = $this->_request->get('subFolderPath');

        $result = $this->_fileManagerService->subFolderPath($this->_fileManagerRequest);

        return response()->json($result);
    }
}
