create table if not exists `tags` (
                                       `id` int(11) unsigned not null auto_increment,
                                       `name` varchar(255) not null unique,
                                       `created` timestamp default current_timestamp,
                                       primary key (id)
)
    engine = InnoDB
    auto_increment = 1
    character set utf8
    collate utf8_general_ci;
INSERT INTO tags (name) values ('php');
INSERT INTO tags (name) values ('study');
INSERT INTO tags (name) values ('books');