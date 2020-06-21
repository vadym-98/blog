create table if not exists `comments` (
                                      `id` int(11) unsigned not null auto_increment,
                                      `content` text not null,
                                      `post_id` int(11) unsigned not null,
                                      `user_mail` varchar(255) not null,
                                      `created` timestamp default current_timestamp,
                                      primary key (id),
                                      FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
                                      FOREIGN KEY (user_mail) REFERENCES users(username) ON DELETE CASCADE
)
    engine = InnoDB
    auto_increment = 1
    character set utf8
    collate utf8_general_ci;