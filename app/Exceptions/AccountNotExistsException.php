<?php

namespace App\Exceptions;

use Exception;

class AccountNotExistsException extends Exception
{
    protected $message = "El usuario no existe.";
}
