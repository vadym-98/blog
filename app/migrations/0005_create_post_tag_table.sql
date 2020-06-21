create table if not exists `post_tag` (
                                          `post_id` int(11) unsigned not null,
                                          `tag_id` int(11) unsigned not null,
                                          `created` timestamp default current_timestamp,
                                          PRIMARY KEY( `post_id`, `tag_id`),
                                          FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
                                          FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
)
    engine = InnoDB
    auto_increment = 1
    character set utf8
    collate utf8_general_ci;