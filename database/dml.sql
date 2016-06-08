insert into Login values ('jsmith', 'qpowierjfo');
insert into Login values ('jbrown', '903refdjl');
insert into Login values ('dsmith', 'f09jiokertg');
insert into Login values ('alopez', 'sadfzvcsfd');
insert into Login values ('tspells', 'ILoveCats');
insert into Login values ('rpeterson', 'ILoveDogs');
insert into Login values ('acole', 'ILovePets');
insert into Login values ('jnguyen', 'DontForget!');
insert into Login values ('lnorman', 'pAsSWORD!!!!kdf');
insert into Login values ('apointer', 'wlfdcc9992');

insert into Login values ('admin1', 'SuperSecurePassword');
insert into Login values ('admin2', 'SuperSecurePassword2');

insert into Admin values (001, 'Jane', 'Powers', 'admin1');
insert into Admin values (002, 'Jack', 'Johnson', 'admin2');

insert into User values ('8317239', 'John', 'Smith','123-123-1234', 'jsmith@test.com', '1234 I St', 'Salem', 'OR', 98123, 'jsmith');
insert into User values ('BROWNJ255DR ', 'Jane', 'Brown','253-123-4312', 'jbrown@mail.com', '1234 I St', 'Tacoma','WA', 94321, 'jbrown');
insert into User values ('69KED76646', 'David', 'Smith', '345-644-3454','dsmith@email.com', '5432 N Cat Ave', 'Dangit', 'NH', 32456, 'dsmith');
insert into User values ('B6167567', 'Alice', 'Lopez', '594-321-3456', 'alopez@mail.com', '567 Kittens Loop', 'Kansas City','KS', 93432, 'alopez');
insert into User values ('SPELLT959ZE', 'Taylor', 'Spells', '253-236-6546', 'tspells@test.com', '7854 N 23 St', 'Tacoma','WA', 98417, 'tspells');
insert into User values ('J7891449', 'Rick', 'Peterson', '302-942-0012', 'rpeterson@email.com', '1003 S 52 Ave', 'Los Angeles','CA', 95403, 'rpeterson');
insert into User values ('575531227', 'Alice', 'Cole', '403-219-0493', 'acole@mail.com', '1132 Lassen St', 'Honolulu', 'HI', 75444, 'acole');
insert into User values ('387709714', 'Jason', 'Nguyen', '506-434-3921', 'jnguyen@mail.com', '409 Lily St', 'Boulder','CO', 20192, 'jnguyen');
insert into User values ('387730714', 'Lauren', 'Norman', '506-432-2912', 'lnorman@zmail.com', '800 West Place', 'Boulder','CO', 20193, 'lnorman');
insert into User values ('838595338', 'Alex', 'Pointer', '302-232-1209', 'apointer@email.com', '900 S 52 Ave', 'Los Angeles','CA', 95403, 'apointer');

insert into Vehicle values(1, 10.0, 'Honda', 'Civic', 2014, 'Automatic', 5);
insert into Vehicle values(2, 15.0, 'Kia', 'Rio', 2013, 'Automatic', 4);
insert into Vehicle values(3, 12.0, 'Nissan', 'Versa', 2015, 'Automatic', 4);
insert into Vehicle values(4, 11.0, 'Toyota', 'Corolla', 2010, 'Automatic', 5);
insert into Vehicle values(5, 20.0, 'Volkswagen', 'Jetta', 2014, 'Manual', 5);
insert into Vehicle values(6, 13.0, 'Ford', 'Fusion', 2012, 'Automatic', 5);
insert into Vehicle values(7, 13.50, 'Chrysler', '300', 2014, 'Automatic', 5);
insert into Vehicle values(8, 20.0, 'Cadillac', 'ATS', 2015, 'Automatic', 5);
insert into Vehicle values(9, 18.0, 'Ford', 'Mustang', 2013, 'Automatic', 4);
insert into Vehicle values(10, 17.50, 'Chevy', 'Volt', 2015, 'Automatic', 4);
insert into Vehicle values(14, 19.0, 'BMW', '5 Series', 2015, 'Automatic', 5);
insert into Vehicle values(12, 15.5, 'Honda', 'Accord', 2009, 'Automatic', 6);
insert into Vehicle values(15, 5.5, 'Nissan', 'Maxima', 200, 'Manual', 4);

insert into UserBalance values ('8317239', 8973435727952008, 135.24);
insert into UserBalance values ('BROWNJ255DR', 5955828028396627, 20.00);
insert into UserBalance values ('69KED76646', 4303516381796122, 15.60);
insert into UserBalance values ('B6167567', 7328499279595547, 240.33);
insert into UserBalance values ('SPELLT959ZE', 0371499725956104, 5999.00);
insert into UserBalance values ('J7891449', 3490407431187808, 67.01);
insert into UserBalance values ('575531227', 8019649175288013, 2.10);
insert into UserBalance values ('387709714', 2504494864763622, 0.00);
insert into UserBalance values ('387730714', 6500609394846938, 1.88);
insert into UserBalance values ('838595338', 1072812336759281, 11111111.11);

insert into UserCreditCard values (8973435727952008, '12/20', 555);
insert into UserCreditCard values (5955828028396627, '5/18', 444);
insert into UserCreditCard values (4303516381796122, '6/19', 111);
insert into UserCreditCard values (7328499279595547, '1/18', 222);
insert into UserCreditCard values (0371499725956104, '3/21', 333);
insert into UserCreditCard values (3490407431187808, '9/21', 666);
insert into UserCreditCard values (8019649175288013, '6/32', 777);
insert into UserCreditCard values (2504494864763622, '8/54', 888);
insert into UserCreditCard values (6500609394846938, '11/12', 999);
insert into UserCreditCard values (1072812336759281, '7/15', 000);

insert into Reservation values(12345678,'69KED76646','2015/07/30 11:00','2015/08/05 12:00','Tacoma,WA', 420.0,'2');
insert into Reservation values(23476546,'SPELLT959ZE','2015/08/12 12:00', '2015/08/20 15:00', 'Los Angeles,CA', 367.0,'3');
insert into Reservation values(23487987,'575531227','2015/08/13 13:00','2015/08/14 13:00','Salem,OR',115.0,'1');
insert into Reservation values(36849905,'SPELLT959ZE','2015/09/09 08:00', '2015/09/09 15:00', 'Seattle,WA',120.0,'8');
insert into Reservation values(98903456,'838595338','2015/09/09 15:00', '2015/09/21 10:00', 'Boston,MA',500.0,'4');
