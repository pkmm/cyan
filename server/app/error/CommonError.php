<?php


namespace App\error;

interface CommonError
{
    public function getErrorCode(): int;

    public function getErrorMsg(): string;

    public function setErrorMsg($errorMsg): CommonError;
}
