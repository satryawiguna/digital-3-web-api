<?php
namespace App\Http\Requests\FileManager;


class FileManagerRequest
{
    // Default Property

    public $email;

    public $folder_path;

    public $sub_folder_path;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFolderPath()
    {
        return $this->folder_path;
    }

    /**
     * @param mixed $folder_path
     */
    public function setFolderPath($folder_path)
    {
        $this->folder_path = $folder_path;
    }

    /**
     * @return mixed
     */
    public function getSubFolderPath()
    {
        return $this->sub_folder_path;
    }

    /**
     * @param mixed $sub_folder_path
     */
    public function setSubFolderPath($sub_folder_path)
    {
        $this->sub_folder_path = $sub_folder_path;
    }
}