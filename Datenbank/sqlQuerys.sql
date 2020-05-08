-- -----------------------------------------------------
-- Insert statemant
-- -----------------------------------------------------

-- Neuen Kunden Anlegen
insert into Account (
	username,password,email,treuepunkte
	) 
	values("Milten3110","md5Hash","web@test.de",0);


insert into KUNDE (vorname, nachname,geburtsdatum, nummer, bundesland, plz, ort, strasse, hausnummer, account_id) 
values("Silvia","S....","2000-01-01",0151234567,"Th","99099","Ef","PeterStra","14a", (select id from ACCOUNT where username="Milten3110") );

	

-- Genre Anlegen
insert into GENRE(genre_name) 
values("Thriller");


-- Produkt erzeugen
insert into PRODUKT (name,author,verlag,isbn,preis,genre_id)
values("Timmy Black","Timmy","GeoDeck","123-888-91aas", 17.75,(select id from GENRE where genre_name="Thriller") );


-- Besellung aufgeben
insert into BESTELLUNGEN(account_id,bestelldatum,produkt_id) 
	values( (select id from ACCOUNT where username="Milten3110"),"2000-01-01", 1);
	
insert into KUNDEN_INTERESSE(genre,ausgeliehen,gekauft,kunden_id)
	values( (select genre_name from GENRE where id=1 ), 0, 0, 1 );


-- Bestellungs abfrage eines Kunden
select produkt_id as Produkt,bestelldatum from BESTELLUNGEN 
where account_id=1;
