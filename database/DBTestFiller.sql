-- Account (user admin password admin (md5 hash))
INSERT INTO Account(privilege, user, password) VALUES ('admin','admin','21232f297a57a5a743894a0e4a801fc3');

-- Boys
INSERT INTO Boy(name, surname, address, CAP, city, commune, city_of_birth, phone, mobile_phone, mail, codice_fiscale) VALUES ('Manuel','Vieider','Viale Monti n.2','23412','Bolzano','Cortaccia','Bolzano','123456','65421','manuel@vieider.com','C0D1C3F1SC4L31');
INSERT INTO Boy(name, surname, address, CAP, city, commune, city_of_birth, phone, mobile_phone, mail, codice_fiscale) VALUES ('Mario','Rossi','Via Pascoli n.3','47900','Rimini','Viserba','Cesena','321412431','4123123','boh@test.com','C0D1C3F1SC4L32');
INSERT INTO Boy(name, surname, address, CAP, city, commune, city_of_birth, phone, mobile_phone, mail, codice_fiscale) VALUES ('Giovanni','Parisi','Via dei Sassi 18','42132','Roma','Roma','Roma','214132131','4214213213','giovanni@example.com','C0D1C3F1SC4L33');
INSERT INTO Boy(name, surname, address, CAP, city, commune, city_of_birth, phone, mobile_phone, mail, codice_fiscale) VALUES ('Giacomo','Bianchi','Via qualcosa 29','421312','Milano','Cologno','Imola','23321321','523432432','giacomo@example.com','C0D1C3F1SC4L34');

-- Organization
INSERT INTO Organization(name, address, city, commune, CAP, phone, mobile_phone, mail, reference) VALUES ('Casa di riposo di Bolzano','Via Montale 92','Bolzano','Bolzano','44423','1421321','32132131','info@casariposo.it','Mario portineria');
INSERT INTO Organization(name, address, city, commune, CAP, phone, mobile_phone, mail, reference) VALUES ('Centro giovani di Corona','Viale Mantova 23','Bolzano','Corona','42312','231321312','421423123','serena@giovani.it','Serena');
INSERT INTO Organization(name, address, city, commune, CAP, phone, mobile_phone, mail, reference) VALUES ('Cooperativa sociale Cortaccia','Via del vino 2','Bolzano','Cortaccia','32321','2321312312','2332132312','luca@coop.it','Luca');

-- Company
INSERT INTO Company(name, address, city, commune, CAP, reference, p_iva, phone, mobile_phone, mail) VALUES ('Buffetti','Via dei platani 23','Bolzano','Bolzano','23123','Giorgio','42142131232133','78321778','4332321321','giorgio@buffetti.it');
INSERT INTO Company(name, address, city, commune, CAP, reference, p_iva, phone, mobile_phone, mail) VALUES ('Enoteca Vivaldi','Via del vino 2','Bolzano','Cortaccia','213213','Mario','3223131231','7823232','4214214','mario@enotecavivaldi.it');
INSERT INTO Company(name, address, city, commune, CAP, reference, p_iva, phone, mobile_phone, mail) VALUES ('Rossi Guido','Via Roma 23','Bolzano','Bolzano','53443','Guido','C0D1C3F1SC4L3','232321','32132131','guido@rossi.com');
INSERT INTO Company(name, address, city, commune, CAP, reference, p_iva, phone, mobile_phone, mail) VALUES ('Ristorante La Bufala','Via Gransasso 44','Bolzano','Bolzano','23123','Gianni','2312323112','2332132','2313213','info@labufala.it');

-- Items
INSERT INTO Item(name, price, points, company_id, company_name) VALUES ('Ricarica TIM','10','4','42142131232133','Buffetti');
INSERT INTO Item(name, price, points, company_id, company_name) VALUES ('Ricarica Vodafone','10','4','42142131232133','Buffetti');
INSERT INTO Item(name, price, points, company_id, company_name) VALUES ("Bottiglia Nero D'Avola",'10','4','3223131231','Enoteca Vivaldi');
INSERT INTO Item(name, price, points, company_id, company_name) VALUES ('Cavatappi','5','2','3223131231','Enoteca Vivaldi');
INSERT INTO Item(name, price, points, company_id, company_name) VALUES ('Ripetizioni di Matematica','20','8','C0D1C3F1SC4L3','Rossi Guido');
INSERT INTO Item(name, price, points, company_id, company_name) VALUES ('Pizza Margherita','5','2','2312323112','Ristorante La Bufala');
INSERT INTO Item(name, price, points, company_id, company_name) VALUES ('Pizza Farcita','7.50','3','2312323112','Ristorante La Bufala');

-- Invoices

INSERT INTO Invoice(inv_date, amount, company_id, company_name) VALUES ('2012-02-23','90','42142131232133','Buffetti');
INSERT INTO Invoice(inv_date, amount, company_id, company_name) VALUES ('2012-03-03','25.50','3223131231','Enoteca Vivaldi');
INSERT INTO Invoice(inv_date, amount, company_id, company_name) VALUES ('2012-04-30','100','42142131232133','Buffetti');
INSERT INTO Invoice(inv_date, amount, company_id, company_name) VALUES ('2012-05-12','20','C0D1C3F1SC4L3','Rossi Guido');
INSERT INTO Invoice(inv_date, amount, company_id, company_name) VALUES ('2012-06-08','30','2312323112','Ristorante La Bufala');

-- Tokens

INSERT INTO Token(boy_id, points, company_id, token_date, company_name, boy_surname) VALUES ('C0D1C3F1SC4L32','3','42142131232133','2012-06-13','Buffetti','Rossi');
INSERT INTO Token(boy_id, points, company_id, token_date, company_name, boy_surname) VALUES ('C0D1C3F1SC4L33','2','3223131231','2012-05-23','Enoteca Vivaldi','Parisi');
INSERT INTO Token(boy_id, points, company_id, token_date, company_name, boy_surname) VALUES ('C0D1C3F1SC4L31','4','42142131232133','2012-06-15','Buffetti','Vieider');
INSERT INTO Token(boy_id, points, company_id, token_date, company_name, boy_surname) VALUES ('C0D1C3F1SC4L32','3','C0D1C3F1SC4L3','2012-05-13','Rossi Guido','Rossi');
INSERT INTO Token(boy_id, points, company_id, token_date, company_name, boy_surname) VALUES ('C0D1C3F1SC4L31','5','2312323112','2012-07-03','Ristorante La Bufala','Vieider');
INSERT INTO Token(boy_id, points, company_id, token_date, company_name, boy_surname) VALUES ('C0D1C3F1SC4L34','6','2312323112','2012-06-30','Ristorante La Bufala','Bianchi');

-- Volunteering

INSERT INTO Volunteering(boy_id, organization_id, vol_date, points, organization_name, boy_surname) VALUES ('C0D1C3F1SC4L32','1','2012-04-13','10','Casa di riposo di Bolzano','Rossi');
INSERT INTO Volunteering(boy_id, organization_id, vol_date, points, organization_name, boy_surname) VALUES ('C0D1C3F1SC4L31','1','2012-03-23','12','Casa di riposo di Bolzano','Vieider');
INSERT INTO Volunteering(boy_id, organization_id, vol_date, points, organization_name, boy_surname) VALUES ('C0D1C3F1SC4L32','1','2012-04-15','20','Casa di riposo di Bolzano','Rossi');
INSERT INTO Volunteering(boy_id, organization_id, vol_date, points, organization_name, boy_surname) VALUES ('C0D1C3F1SC4L31','2','2012-03-06','24','Centro giovani di Corona','Vieider');
INSERT INTO Volunteering(boy_id, organization_id, vol_date, points, organization_name, boy_surname) VALUES ('C0D1C3F1SC4L33','3','2012-02-09','10','Cooperativa sociale Cortaccia','Parisi');
INSERT INTO Volunteering(boy_id, organization_id, vol_date, points, organization_name, boy_surname) VALUES ('C0D1C3F1SC4L34','2','2012-04-21','15','Centro giovani di Corona','Bianchi');