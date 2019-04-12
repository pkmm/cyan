<?php


namespace App\error;

class EmBusinessError implements CommonError
{
    private $errorCode;
    private $errorMsg;

    public function __construct(int $errorCode, string $errorMsg)
    {
        $this->errorCode = $errorCode;
        $this->errorMsg = $errorMsg;
    }

    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    public function getErrorMsg(): string
    {
        return $this->errorMsg;
    }

    public function setErrorMsg($errorMsg): CommonError
    {
        $this->errorMsg = $errorMsg;
        return $this;
    }
}
