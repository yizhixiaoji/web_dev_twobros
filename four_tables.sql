## create table
create table apartment
(apartmentId int NOT NULL AUTO_INCREMENT,
 price int NOT NULL,
 pictures char(30),
 size int NOT NULL,
 streetAddress char(60) NOT NULL,
 unitNumber char(20),
  PRIMARY KEY (apartmentId)
);

## create agent table
create table agent
 (agentId int NOT NULL AUTO_INCREMENT,
 agentLastName char(15),
 agentFirstName char(15),
 contactInfomation  char(30),
  PRIMARY KEY (agentId)
);

## create customer table
create table customer
(customerId int NOT NULL,
password char(30) NOT NULL,
nickName char(30),
createDate date,
PRIMARY KEY (customerId)
);

## create user_apt_like table
create table user_apt_like(
customerId int NOT NULL,
apartmentId int NOT NULL, 
FOREIGN KEY (customerId) REFERENCES customer(customerId),
FOREIGN KEY (apartmentId) REFERENCES apartment(apartmentId)
);

========
## generated some random data for test:) 

INSERT INTO apartment (price, size, streetAddress, unitNumber)
VALUES ('2500', '500', '3619  Rosewood Lane', '1');

INSERT INTO apartment (price, size, streetAddress, unitNumber)
VALUES ('2500', '1000', '4082  Settlers Lane', '2');

INSERT INTO apartment (price, size, streetAddress, unitNumber)
VALUES ('2800', '600', '361 Bicetown Road', '3');

INSERT INTO apartment (price, size, streetAddress, unitNumber)
VALUES ('2700', '700', '19  wood Lane', '1');

INSERT INTO apartment (price, size, streetAddress, unitNumber)
VALUES ('1300', '400', '360  Rosebud Lane', '5');

INSERT INTO apartment (price, size, streetAddress, unitNumber)
VALUES ('2000', '550', '266  Godfrey Road', '6');

======

INSERT INTO user_apt_like (customerId, apartmentId)
VALUES ('30', '1');

INSERT INTO user_apt_like (customerId, apartmentId)
VALUES ('20', '2');

INSERT INTO user_apt_like (customerId, apartmentId)
VALUES ('10', '3');

INSERT INTO user_apt_like (customerId, apartmentId)
VALUES ('10', '4');

INSERT INTO user_apt_like (customerId, apartmentId)
VALUES ('10', '5');
=====
INSERT INTO customer (customerId, password)
VALUES ('10', 'hello');

INSERT INTO customer (customerId, password)
VALUES ('20', 'hellohi');

INSERT INTO customer (customerId, password)
VALUES ('30', 'hellohihi');
