
drop table if exists form;

create table form (
    id int primary key,
    name varchar(255),
    description varchar(255),
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp
);

insert into form (id, name, description) values (1, 'Form 1', 'Description 1'),
                        (2, 'Form 2', 'Description 2'),
                        (3, 'Form 3', 'Description 3'), 
                        (4, 'Form 4', 'Description 4');