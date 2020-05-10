--Fill Genres into Database
insert into genre (genre_name) values ("roman");
insert into genre (genre_name) values ("krimi");
insert into genre (genre_name) values ("science fiction");
insert into genre (genre_name) values ("historische romane");
insert into genre (genre_name) values ("liebesromane");
insert into genre (genre_name) values ("familienleben");
insert into genre (genre_name) values ("comic und cartoon");
insert into genre (genre_name) values ("belletristik");
insert into genre (genre_name) values ("lyrik");
insert into genre (genre_name) values ("thriller");
insert into genre (genre_name) values ("fantasy");
insert into genre (genre_name) values ("familiensaga");
insert into genre (genre_name) values ("erotik");
insert into genre (genre_name) values ("sportromane");
insert into genre (genre_name) values ("musik");
insert into genre (genre_name) values ("spekulative literatur");
insert into genre (genre_name) values ("horror");
insert into genre (genre_name) values ("legenden");
insert into genre (genre_name) values ("abenteuerromane");
insert into genre (genre_name) values ("lifestyle");
insert into genre (genre_name) values ("satiere");
insert into genre (genre_name) values ("religion");
insert into genre (genre_name) values ("biografie");
insert into genre (genre_name) values ("sozial");
insert into genre (genre_name) values ("sprache");
insert into genre (genre_name) values ("naturwissenschaft");
insert into genre (genre_name) values ("ladwirtschaft");
insert into genre (genre_name) values ("tatsachenbericht");
insert into genre (genre_name) values ("reden");
insert into genre (genre_name) values ("politik");
insert into genre (genre_name) values ("nachschlagewerk");
insert into genre (genre_name) values ("umweltwissenschaft");
insert into genre (genre_name) values ("it");
insert into genre (genre_name) values ("memoiren");
insert into genre (genre_name) values ("kultur");
insert into genre (genre_name) values ("geschichte");
insert into genre (genre_name) values ("wirtschaft");
insert into genre (genre_name) values ("recht");
insert into genre (genre_name) values ("technik");
insert into genre (genre_name) values ("körper");
insert into genre (genre_name) values ("magie");
insert into genre (genre_name) values ("medizin");
insert into genre (genre_name) values ("gesundheit");
insert into genre (genre_name) values ("partnerschaft");

--Fill Produkts into Database
insert into Produkt (name,author,verlag,isbn,preis,genre_id) values
    ("1965 – Der erste Fall für Thomas Engel","Thomas Cristos", "blanvalet", "978-3-7645-0719-0", 20.00, (select id from GENRE where genre_name="roman") ),
    ("1q84","Ursula Graefe", "shinchosa", "973-3-442-74362-9", 16.00, (select id from GENRE where genre_name="roman") ),
    ("Blackout – morgen ist es zu spät","Marc Elsberg", "blanvalet", "978-3442380299", 10.99, (select id from GENRE where genre_name="roman") ),
    ("Zero – Sie wissen, was du tust","Marc Elsberg", "blanvalet", "978-3734100932", 10.99, (select id from GENRE where genre_name="roman") ),
    ("Helix – Sie werden uns ersetzen","Marc Elsberg", "blanvalet", "978-3734105579", 10.99, (select id from GENRE where genre_name="roman") ),
    ("9 Stunden Angst","Max Kinings", "ebook", "ebook", 8.99 , (select id from GENRE where genre_name="krimi") ),
    ("Abendlied für einen Moerder","Maruizio deGiovanni", "goldmann", "978-3-442-31463-8", 20.00 , (select id from GENRE where genre_name="krimi") ),
    ("1. Preis: Allmaechtigkeit","Robert Sheckley", "ebook", "ebook", 2.99 , (select id from GENRE where genre_name="science fiction") ),
    ("2012 – Die Prophezeiung", "Steve Alten", "ebook", "ebook", 9.99 , (select id from GENRE where genre_name="science fiction") ),
    ("Alexander", "Gisbert Haefs", "heyne", "978-3-453-47116-0", 9.99 , (select id from GENRE where genre_name="historische romane") ),
    ("Alexanders Erbe", "Gisbert Haefs", "heyne", "978-3-453-47129-0", 9.99 , (select id from GENRE where genre_name="historische romane") ),
    ("Arena", "Simo Scarrow", "heyne", "978-3-453-47128-3", 9.99 , (select id from GENRE where genre_name="historische romane") ),
    ("Blut Schwerter", "Simo Scarrow", "heyne", "978-3-453-47328-3", 9.99 , (select id from GENRE where genre_name="historische romane") ),
    ("Abingdon Hall- Der letzte Sommer", "Phillip Rock", "ebook", "ebook", 9.99 , (select id from GENRE where genre_name="liebesromane") ),
    ("4 Seasons – Labyrinth des Begehres", "Vina Jackson", "calis book", "978-3-641-14970-3", 9.99 , (select id from GENRE where genre_name="liebesromane") ),
    ("4 Seasons – Naechte der Leidenschaft", "Vina Jackson", "calis book", "978-3-641-14990-3", 9.99 , (select id from GENRE where genre_name="liebesromane") ),
    ("4 Seasons – Zeiten der Lust", "Vina Jackson", "calis book", "978-3-641-14150-3", 9.99 , (select id from GENRE where genre_name="liebesromane") ),
    ("Andersens Maerchen", "Christia Andersen", "anaconda", "978-3-86647-546-5", 9.95 , (select id from GENRE where genre_name="legenden") ),
    ("Bechtsteins Maerchen", "Ludwi Bechtstein", "anaconda", "978-3-7306-0670-4", 14.99 , (select id from GENRE where genre_name="legenden") ),
    ("Wikinger Mythen", "Peter Archer", "anaconda", "978-3-7306-0629-2", 9.95 , (select id from GENRE where genre_name="legenden") )
    ;