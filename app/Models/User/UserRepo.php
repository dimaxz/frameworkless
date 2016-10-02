<?php

namespace Models\User;

use Propel\Runtime\ActiveRecord\ActiveRecordInterface;

use Models\User\User;
use Models\User\UserQuery;

/**
 * Description of UserRepo
 *
 * @author Dmitriy
 */
class UserRepo implements \Models\CrudInterface
{   
    
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
        
    }

    /**
     * Сохраняем
     * @param ActiveRecordInterface $Model
     * @return boolean
     * @throws \DomainException
     */
    public function save(ActiveRecordInterface $Model)
    {
        if (!$Model->save()) {
            throw new \DomainException(sprintf('User not save',$id));
        }

        return true;        
    }

}
