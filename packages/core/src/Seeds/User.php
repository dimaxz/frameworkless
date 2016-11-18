<?php
namespace Core\Seeds;

/**
 * Description of User
 *
 * @author Dmitriy
 */
class User implements \Frameworkless\SeedInterface{

    /**
     * 
     * @param type $id
     * @return type
     */
    static public function build($id = 1){
	$generator	 = \Faker\Factory::create();
	$populator	 = new \Faker\ORM\Propel2\Populator($generator);
	$populator->addEntity(\Core\Models\User\User::class, $id);
	return $populator->execute();
    }

    /**
     * 
     * @return type
     */
    public static function reset(){
	return \Core\Models\User\UserQuery::create()->deleteAll();
    }
}
