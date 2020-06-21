create table if not exists `users` (
                                          `id` int(11) unsigned not null auto_increment,
                                          `username` varchar(255) not null unique,
                                          `password` varchar(255) not null,
                                          `created` timestamp default current_timestamp,
                                          primary key (id)
)
    engine = InnoDB
    auto_increment = 1
    character set utf8
    collate utf8_general_ci;