<?php
namespace Frameworkless;

/**
 * Description of SeedInterface
 *
 * @author Dmitriy
 */
interface SeedInterface{

    public static function build($id = 1);

    public static function reset();
}
