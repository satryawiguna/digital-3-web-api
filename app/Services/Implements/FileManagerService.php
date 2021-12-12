<?php
namespace App\Services\Implement;


use App\Helper\DirectoryHelper;
use App\Http\Requests\FileManager\FileManagerRequest;
use App\Http\Responses\BaseResponse;
use App\Http\Responses\GenericResponse;
use App\Services\Contract\IFileManagerService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class FileManagerService extends BaseService implements IFileManagerService
{
    /**
     * RoleService constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param FileManagerRequest $request
     * @return GenericResponse
     */
    public function getAccessKey(FileManagerRequest $request)
    {
        $akey = md5($request->getEmail() . '4dm!nFCM5');

        session_start();
        $_SESSION['RF']['akey'] = $akey;

        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->dto = compact('akey');

        return $this->_genericResponse;
    }

    /**
     * @param FileManagerRequest $request
     * @return BaseResponse
     */
    public function folderPath(FileManagerRequest $request)
    {
        $this->_baseResponse = new BaseResponse();

        if (!File::exists('uploads/' . $request->getFolderPath())) {
            File::makeDirectory('uploads/' . $request->getFolderPath(), $mode = 0755, true, true);
            File::makeDirectory('uploads/' . $request->getFolderPath() . '/files/', $mode = 0755, true, true);
            File::makeDirectory('uploads/' . $request->getFolderPath() . '/thumbs/', $mode = 0755, true, true);
        }

        session_start();
        $_SESSION['RF']['folder'] = $request->getFolderPath();

        $this->_baseResponse->_result = Session::all();
        $this->_baseResponse->addSuccessMessage("Success folder session created");

        return $this->_baseResponse;

    }

    /**
     * @param FileManagerRequest $request
     * @return BaseResponse
     */
    public function subFolderPath(FileManagerRequest $request)
    {
        $this->_baseResponse = new BaseResponse();

        if ($request->getSubFolderPath() != 0) {
            if (!File::exists('uploads/' . $request->getFolderPath() . '/files/' . $request->getSubFolderPath() . '/')) {
                File::makeDirectory('uploads/' . $request->getFolderPath() . '/files/' . $request->getSubFolderPath(), $mode = 0755, true, true);
            }

            if (!File::exists('uploads/' . $request->getFolderPath() . '/thumbs/' . $request->getSubFolderPath() . '/')) {
                File::makeDirectory('uploads/' . $request->getFolderPath() . '/thumbs/' . $request->getSubFolderPath(), $mode = 0755, true, true);
            }

        }

        session_start();
        if ($request->getSubFolderPath() != 0) {
            $_SESSION['RF']['subfolder'] = $request->getSubFolderPath();
        } else {
            unset($_SESSION['RF']['subfolder']);
        }

        $this->_baseResponse->_result = Session::all();
        $this->_baseResponse->addSuccessMessage("Success subfolder session created");

        return $this->_baseResponse;
    }


}