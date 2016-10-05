<?php

namespace Frameworkless\Controllers;

class InstallController
{

    static public function postPackageInstall()
    {
        $finder = \Symfony\Component\Finder\Finder::create();

        $root_path = __DIR__ . "../../..";

        $iterator = $finder
                ->files()
                ->in($root_path . "/vendor/*/*/install/db");

        foreach ($iterator as $file) {
            //print $file->getRealpath() . PHP_EOL;

            // Dump the relative path to the file, omitting the filename
            //var_dump($file->getRelativePath());

            // Dump the relative path to the file
            //var_dump($file->getRelativePathname());

            if (!copy($file->getRealpath(), $root_path . '/db/' . $file->getRelativePathname())) {
               echo sprintf("error copy migration %s..." . PHP_EOL, $file->getRelativePathname());
            }
            else{
                echo sprintf("copy migration %s" . PHP_EOL, $file->getRelativePathname());
            }
        }
        
        echo "completed!" . PHP_EOL;
    }
}
