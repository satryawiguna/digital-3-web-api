<?php
namespace App\Services\Contract;


use App\Http\Requests\FileManager\FileManagerRequest;

interface IFileManagerService
{
    /**
     * @param FileManagerRequest $request
     * @return mixed
     */
    public function getAccessKey(FileManagerRequest $request);

    /**
     * @param FileManagerRequest $request
     * @return mixed
     */
    public function folderPath(FileManagerRequest $request);

    /**
     * @param FileManagerRequest $request
     * @return mixed
     */
    public function subFolderPath(FileManagerRequest $request);
}