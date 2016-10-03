<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1475520687.
 * Generated on 2016-10-03 21:51:27 
 */
class PropelMigration_1475520687
{
    public $comment = '';

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `migrations`;

DROP TABLE IF EXISTS `password_resets`;

ALTER TABLE `tasks`

  DROP `name`,

  DROP `user_id`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `tasks`

  ADD `name` VARCHAR(50) AFTER `updated_at`,

  ADD `user_id` INTEGER AFTER `name`;

CREATE TABLE `migrations`
(
    `migration` VARCHAR(255) NOT NULL,
    `batch` INTEGER NOT NULL
) ENGINE=InnoDB;

CREATE TABLE `password_resets`
(
    `email` VARCHAR(255) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX `password_resets_email_index` (`email`),
    INDEX `password_resets_token_index` (`token`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}