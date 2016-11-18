<?php
namespace Frameworkless;

use Symfony\Component\Validator\Validator\RecursiveValidator;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\ConstraintValidatorFactory;
use Symfony\Component\Translation\IdentityTranslator;
use Symfony\Component\Validator\Mapping\Loader\StaticMethodLoader;
use Symfony\Component\Validator\Context\ExecutionContextFactory;
use Frameworkless\Exceptions\ValidationException;

/**
 * Description of ValidatorTrait
 *
 * @author Dmitriy
 */
trait ValidatorTrait{

    /**
     * 
     * @var Symfony\Component\Validator\Validator\RecursiveValidator
     */
    protected $validator;

    function __construct(){
	$this->validator = new RecursiveValidator(
		new ExecutionContextFactory(new IdentityTranslator()), new LazyLoadingMetadataFactory(new StaticMethodLoader()), new ConstraintValidatorFactory()
	);
    }

    public function preSave(\Propel\Runtime\Connection\ConnectionInterface $con = null){
	if(!$result = $this->validate($this->validator)){
	    throw new ValidationException($this->getValidationFailures(), "Validation error");
	}
	return $result;
    }

    public abstract function validate(\Symfony\Component\Validator\Validator\ValidatorInterface $validator = NULL);

    public abstract function getValidationFailures();
}
