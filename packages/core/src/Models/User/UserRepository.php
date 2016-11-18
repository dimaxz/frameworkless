<?php
namespace Core\Models\User;

use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Frameworkless\Exceptions\ValidationException;

/**
 * Description of UserRepo
 *
 * @author Dmitriy
 */
class UserRepository implements \Frameworkless\CrudInterface{

    public function find(array $conditions = []){
	return UserQuery::create()->findOneByArray($conditions);
    }

    /**
     * Поиск по id
     * @param type $id
     * @return \Models\User\User $User
     * @throws \InvalidArgumentException
     */
    public function findById($id){
	if(!$User = UserQuery::create()->findPk($id)){
	    throw new \InvalidArgumentException(sprintf('User with ID %d does not exist', $id));
	}

	return $User;
    }

    public function findMany(array $conditions = [], $limit = false){
	$Users = UserQuery::create()
		->_if($limit)
		->limit($limit)
		->_endif()
		->findByArray($conditions);
	return $Users;
    }

    public function delete(ActiveRecordInterface $Model){
	return $Model->delete();
    }

    /**
     * Сохраняем
     * @param ActiveRecordInterface $Model
     * @return boolean
     * @throws \DomainException
     */
    public function save(ActiveRecordInterface $Model){
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
