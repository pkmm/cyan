<?php


namespace App\error;

class BusinessException extends \Exception implements CommonError
{
    private $commonError;

    public function __construct(CommonError $commonError)
    {
        parent::__construct();
        $this->commonError = $commonError;
    }

    public function getErrorCode():int
    {
        return $this->commonError->getErrorCode();
    }

    public function getErrorMsg():string
    {
        $this->commonError->getErrorMsg();
    }

    public function setErrorMsg($errorMsg): CommonError
    {
        $this->commonError->setErrorMsg($errorMsg);
        return $this;
    }
}
