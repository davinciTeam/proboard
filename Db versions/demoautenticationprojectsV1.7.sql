ALTER TABLE `users`
  DROP `profile_image`,
  DROP `menu_state`,
  DROP `start_page`,
  DROP `slogan`;

ALTER TABLE `users` ADD `activation_hash` VARCHAR(255) NOT NULL AFTER `active`;

ALTER TABLE `users` CHANGE `activation_hash` `activation_hash` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
