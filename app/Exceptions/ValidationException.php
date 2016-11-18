<?php
namespace Frameworkless\Exceptions;

/**
 * Description of Exception
 *
 * @author Dmitriy
 */
class ValidationException extends \Exception{

    private $failures;

    public function __construct($failures, $message = "", $code = 0, $previous = null){

	parent::__construct($message, $code, $previous);

	$this->failures = $failures;
    }

    function getFailures(){
	return $this->failures;
    }
}
