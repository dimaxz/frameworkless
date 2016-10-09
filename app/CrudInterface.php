<?php

namespace Frameworkless;

use Propel\Runtime\ActiveRecord\ActiveRecordInterface;

/**
 * Description of CrudInterface
 *
 * @author Dmitriy
 */
interface CrudInterface
{
    public function findById($id);
    
    public function save(ActiveRecordInterface $Model);
    
    public function delete(ActiveRecordInterface $Model);
    
    public function findMany(array $conditions = []);
    
    public function find(array $conditions = []);
    
    public function build();
    
}
