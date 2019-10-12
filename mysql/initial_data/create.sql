USE dbbolton;

DROP TABLE IF EXISTS nfevalue;

CREATE TABLE nfevalue (
access_key varchar(200),
value  varchar(25),
PRIMARY KEY (access_key)
);
