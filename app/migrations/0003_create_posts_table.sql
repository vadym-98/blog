create table if not exists `posts` (
                                       `id` int(11) unsigned not null auto_increment,
                                       `title` varchar(255) not null unique,
                                       `content` text not null,
                                       `status` enum('new', 'open', 'closed'),
                                       `image` varchar(255) not null,
                                       `user_id` int(11) unsigned not null,
                                       `created` timestamp default current_timestamp,
                                       primary key (id),
                                       foreign key (user_id) references users(id) on delete cascade
)
    engine = InnoDB
    auto_increment = 1
    character set utf8
    collate utf8_general_ci;