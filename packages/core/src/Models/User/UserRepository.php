<?php

namespace Core\Models\User;

use Propel\Runtime\ActiveRecord\ActiveRecordInterface;

use Frameworkless\Exceptions\ValidationException;


use Symfony\Component\Validator\Validator\RecursiveValidator;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\ConstraintValidatorFactory;
use Symfony\Component\Translation\IdentityTranslator;
use Symfony\Component\Validator\Mapping\Loader\StaticMethodLoader;
use Symfony\Component\Validator\Context\ExecutionContextFactory;

/**
 * Description of UserRepo
 *
 * @author Dmitriy
 */
class UserRepository implements \Frameworkless\CrudInterface
{   
	/**
	 * Symfony\Component\Validator\Validator\RecursiveValidator
	 * @var type 
	 */
	protected $validator;
			
    function __construct()
	{
		$this->validator = new RecursiveValidator(
            new ExecutionContextFactory(new IdentityTranslator()),
            new LazyLoadingMetadataFactory(new StaticMethodLoader()),
            new ConstraintValidatorFactory()
        );
	}


	
    public function find(array $conditions = [])
    {
        return UserQuery::create()->findOneByArray($conditions);  
    }

    /**
     * Поиск по id
     * @param type $id
     * @return \Models\User\User $User
     * @throws \InvalidArgumentException
     */
    public function findById($id)
    {
        if (!$User = UserQuery::create()->findPk($id)) {
            throw new \InvalidArgumentException(sprintf('User with ID %d does not exist',$id));
        }

        return $User;
    }

    public function findMany(array $conditions = [])
    {
        return UserQuery::create()->findByArray($conditions);    
    }

    public function delete(ActiveRecordInterface $Model)
    {
        return $Model->delete();
    }

    /**
     * Сохраняем
     * @param ActiveRecordInterface $Model
     * @return boolean
     * @throws \DomainException
     */
    public function save(ActiveRecordInterface $Model)
    {
		
        if (!$Model->validate($this->validator)) {
            throw new ValidationException($Model->getValidationFailures(),"User not valid");
        }        

        return $Model->save();        
    }
    
    /**
     * 
     * @return \Core\Models\User\User $User
     */
    public function build(){
        return new User;
    }

}
