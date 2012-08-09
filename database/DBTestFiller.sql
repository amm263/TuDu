-- Account (user admin password admin (md5 hash))
INSERT INTO Account(privilege, user, password) VALUES ('admin','admin','21232f297a57a5a743894a0e4a801fc3');

-- Boys
INSERT INTO Boy(name, surname, address, CAP, city, city_of_birth, phone, mobile_phone, mail, codice_fiscale) VALUES ('Manuel','Vieider','Viale Monti n.2','23412','Cortaccia','Bolzano','123456','65421','manuel@vieider.com','C0D1C3F1SC4L31');
INSERT INTO Boy(name, surname, address, CAP, city, city_of_birth, phone, mobile_phone, mail, codice_fiscale) VALUES ('Mario','Rossi','Via Pascoli n.3','47900','Rimini','Cesena','321412431','4123123','boh@test.com','C0D1C3F1SC4L32');
INSERT INTO Boy(name, surname, address, CAP, city, city_of_birth, phone, mobile_phone, mail, codice_fiscale) VALUES ('Giovanni','Parisi','Via dei Sassi 18','42132','Roma','Roma','214132131','4214213213','giovanni@example.com','C0D1C3F1SC4L33');
INSERT INTO Boy(name, surname, address, CAP, city, city_of_birth, phone, mobile_phone, mail, codice_fiscale) VALUES ('Giacomo','Bianchi','Via qualcosa 29','421312','Milano','Imola','23321321','523432432','giacomo@example.com','C0D1C3F1SC4L34');

-- Organization
INSERT INTO Organization(name, address, city, CAP, phone, mobile_phone, reference) VALUES ('Casa di riposo di Bolzano','Via Montale 92','Bolzano','44423','1421321','32132131','Mario portineria');
INSERT INTO Organization(name, address, city, CAP, phone, mobile_phone, reference) VALUES ('Centro giovani di Corona','Viale Mantova 23','Corona','42312','231321312','421423123','Serena');
INSERT INTO Organization(name, address, city, CAP, phone, mobile_phone, reference) VALUES ('Cooperativa sociale Cortaccia','Via del vino 2','Cortaccia','32321','2321312312','2332132312','Luca');

-- Company
INSERT INTO Company(name, address, city, CAP, reference, p_iva, phone, mobile_phone, mail) VALUES ('Buffetti','Via dei platani 23','Bolzano','23123','Giorgio','42142131232133','78321778','4332321321','giorgio@buffetti.it');
INSERT INTO Company(name, address, city, CAP, reference, p_iva, phone, mobile_phone, mail) VALUES ('Enoteca Vivaldi','Via del vino 2','Cortaccia','213213','Mario','3223131231','7823232','4214214','mario@enotecavivaldi.it');
INSERT INTO Company(name, address, city, CAP, reference, p_iva, phone, mobile_phone, mail) VALUES ('Rossi Guido','Via Roma 23','Bolzano','53443','Guido','C0D1C3F1SC4L3','232321','32132131','guido@rossi.com');
INSERT INTO Company(name, address, city, CAP, reference, p_iva, phone, mobile_phone, mail) VALUES ('Ristorante La Bufala','Via Gransasso 44','Bolzano','23123','Gianni','2312323112','2332132','2313213','info@labufala.it');

-- Items
INSERT INTO Item(name, price, points, company_id) VALUES ('Ricarica TIM','10','4','42142131232133');
INSERT INTO Item(name, price, points, company_id) VALUES ('Ricarica Vodafone','10','4','42142131232133');
INSERT INTO Item(name, price, points, company_id) VALUES ("Bottiglia Nero D'Avola",'10','4','3223131231');
INSERT INTO Item(name, price, points, company_id) VALUES ('Cavatappi','5','2','3223131231');
INSERT INTO Item(name, price, points, company_id) VALUES ('Ripetizioni di Matematica','20','8','C0D1C3F1SC4L3');
INSERT INTO Item(name, price, points, company_id) VALUES ('Pizza Margherita','5','2','2312323112');
INSERT INTO Item(name, price, points, company_id) VALUES ('Pizza Farcita','7.50','3','2312323112');

-- Invoices

INSERT INTO Invoice(inv_date, amount, company_id) VALUES ('2012-02-23','90','42142131232133');
INSERT INTO Invoice(inv_date, amount, company_id) VALUES ('2012-03-03','25.50','3223131231');
INSERT INTO Invoice(inv_date, amount, company_id) VALUES ('2012-04-30','100','42142131232133');
INSERT INTO Invoice(inv_date, amount, company_id) VALUES ('2012-05-12','20','C0D1C3F1SC4L3');
INSERT INTO Invoice(inv_date, amount, company_id) VALUES ('2012-06-08','30','2312323112');

-- Tokens

INSERT INTO Token(boy_id, points, company_id, token_date) VALUES ('C0D1C3F1SC4L32','3','42142131232133','2012-06-13');
INSERT INTO Token(boy_id, points, company_id, token_date) VALUES ('C0D1C3F1SC4L33','2','3223131231','2012-05-23');
INSERT INTO Token(boy_id, points, company_id, token_date) VALUES ('C0D1C3F1SC4L31','4','42142131232133','2012-06-15');
INSERT INTO Token(boy_id, points, company_id, token_date) VALUES ('C0D1C3F1SC4L32','3','C0D1C3F1SC4L3','2012-05-13');
INSERT INTO Token(boy_id, points, company_id, token_date) VALUES ('C0D1C3F1SC4L31','5','2312323112','2012-07-03');
INSERT INTO Token(boy_id, points, company_id, token_date) VALUES ('C0D1C3F1SC4L34','6','2312323112','2012-06-30');

-- Volunteering

INSERT INTO Volunteering(boy_id, organization_id, vol_date, points) VALUES ('C0D1C3F1SC4L32','1','2012-04-13','10');
INSERT INTO Volunteering(boy_id, organization_id, vol_date, points) VALUES ('C0D1C3F1SC4L31','1','2012-03-23','12');
INSERT INTO Volunteering(boy_id, organization_id, vol_date, points) VALUES ('C0D1C3F1SC4L32','1','2012-04-15','20');
INSERT INTO Volunteering(boy_id, organization_id, vol_date, points) VALUES ('C0D1C3F1SC4L31','2','2012-03-06','24');
INSERT INTO Volunteering(boy_id, organization_id, vol_date, points) VALUES ('C0D1C3F1SC4L33','3','2012-02-09','10');
INSERT INTO Volunteering(boy_id, organization_id, vol_date, points) VALUES ('C0D1C3F1SC4L34','2','2012-04-21','15');