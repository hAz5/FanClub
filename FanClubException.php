<?php
/**
 * Created by PhpStorm.
 * User: joker
 * Date: 3/20/2018
 * Time: 9:32 PM
 */

namespace FanClub;

use Exception;
use Throwable;

class FanClubException extends Exception
{
    protected $message;
    public function __construct(Throwable $previous = null)
    {
        $message = 'Fanclub not Exist.';
        $code = 404;
        parent::__construct($message, $code, $previous);
    }
}
