<?php
namespace App\Http\Responses;


use App\Helper\MessageHelper;
use Illuminate\Database\Eloquent\Collection;

class BaseResponse
{
    public $_result;

    public $_messages;

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->_result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->_result = $result;
    }

    /**
     * @return mixed
     */
    public function getMessages()
    {
        return !isset($this->_messages) ? Collection::make($this->_messages) : $this->_messages;
    }

    /**
     * @param mixed $messages
     */
    public function setMessages($messages)
    {
        $this->_messages = $messages;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return $this->getMessages()->filter(function($item) { return $item->getType() == MessageHelper::ERROR; })->count() > 0;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->getMessages()->filter(function($item) { return $item->getType() == MessageHelper::SUCCESS; })->count() > 0;
    }

    /**
     * @return bool
     */
    public function isInfo()
    {
        return $this->getMessages()->filter(function($item) { return $item->getType() == MessageHelper::INFO; })->count() > 0;
    }

    /**
     * @return bool
     */
    public function isWarning()
    {
        return $this->getMessages()->filter(function($item) { return $item->getType() == MessageHelper::WARNING; })->count() > 0;
    }

    /**
     * @param $text
     */
    public function addErrorMessage($text)
    {
        $messageResponse = new MessageResponse();
        $messageResponse->type = MessageHelper::ERROR;
        $messageResponse->text = $text;

        $message = $this->getMessages()->push($messageResponse);
        $this->_messages = $message;
    }

    /**
     * @param $text
     */
    public function addSuccessMessage($text)
    {
        $messageResponse = new MessageResponse();
        $messageResponse->type = MessageHelper::SUCCESS;
        $messageResponse->text = $text;

        $message = $this->getMessages()->push($messageResponse);
        $this->_messages = $message;
    }

    /**
     * @param $text
     */
    public function addInfoMessage($text)
    {
        $messageResponse = new MessageResponse();
        $messageResponse->type = MessageHelper::INFO;
        $messageResponse->text = $text;

        $message = $this->getMessages()->push($messageResponse);
        $this->_messages = $message;
    }

    /**
     * @param $text
     */
    public function addWarningMessage($text)
    {
        $messageResponse = new MessageResponse();
        $messageResponse->type = MessageHelper::WARNING;
        $messageResponse->text = $text;

        $message = $this->getMessages()->push($messageResponse);
        $this->_messages = $message;
    }

    /**
     * @return mixed
     */
    public function getMessageResponseToArray()
    {
        return $this->getMessages()->all();
    }

    /**
     * @return mixed
     */
    public function getErrorMessageResponseToArray()
    {
        return $this->getMessages()->filter(function($item) { return $item->getType() == MessageHelper::ERROR; })->all();
    }

    /**
     * @return mixed
     */
    public function getSuccessMessageResponseToArray()
    {
        return $this->getMessages()->filter(function($item) { return $item->getType() == MessageHelper::SUCCESS; })->all();
    }

    /**
     * @return mixed
     */
    public function getInfoMessageResponseToArray()
    {
        return $this->getMessages()->filter(function($item) { return $item->getType() == MessageHelper::INFO; })->all();
    }

    /**
     * @return mixed
     */
    public function getWarningMessageResponseToArray()
    {
        return $this->getMessages()->filter(function($item) { return $item->getType() == MessageHelper::WARNING; })->all();
    }
}