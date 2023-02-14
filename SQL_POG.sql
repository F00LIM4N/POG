CREATE TABLE edition(
        id_edition   Int  Auto_increment  NOT NULL ,
        name_edition Varchar (255) NOT NULL
	,CONSTRAINT edition_PK PRIMARY KEY (id_edition)
)ENGINE=InnoDB;

CREATE TABLE mailTemplate(
        id_mailTemplate      Int  Auto_increment  NOT NULL ,
        object_mailTemplate  Varchar (255) NOT NULL ,
        content_mailTemplate Text NOT NULL ,
        date_mailTemplate    Datetime NOT NULL
	,CONSTRAINT mailTemplate_PK PRIMARY KEY (id_mailTemplate)
)ENGINE=InnoDB;

CREATE TABLE twoFA(
        id_authentification     Int  Auto_increment  NOT NULL ,
        method_authentification Varchar (255) NOT NULL ,
        info_2fa                Varchar (255) NOT NULL
	,CONSTRAINT twoFA_PK PRIMARY KEY (id_authentification)
)ENGINE=InnoDB;

CREATE TABLE role(
        id_role  Int  Auto_increment  NOT NULL ,
        nom_role Varchar (255) NOT NULL
	,CONSTRAINT role_PK PRIMARY KEY (id_role)
)ENGINE=InnoDB;

CREATE TABLE promo(
        id_promo    Int  Auto_increment  NOT NULL ,
        value_promo Float NOT NULL ,
        start_date  Datetime NOT NULL ,
        end_date    Datetime NOT NULL
	,CONSTRAINT promo_PK PRIMARY KEY (id_promo)
)ENGINE=InnoDB;

CREATE TABLE pegi(
        id_pegi    Int  Auto_increment  NOT NULL ,
        value_pegi Varchar (10) NOT NULL
	,CONSTRAINT pegi_PK PRIMARY KEY (id_pegi)
)ENGINE=InnoDB;

CREATE TABLE category(
        id_category   Int  Auto_increment  NOT NULL ,
        id_promo      Int NOT NULL ,
        name_category Varchar (255) NOT NULL
	,CONSTRAINT category_PK PRIMARY KEY (id_category)

	,CONSTRAINT category_promo_FK FOREIGN KEY (id_promo) REFERENCES promo(id_promo)
)ENGINE=InnoDB;

CREATE TABLE country(
        id_country   Int  Auto_increment  NOT NULL ,
        name_country Varchar (255) NOT NULL
	,CONSTRAINT country_PK PRIMARY KEY (id_country)
)ENGINE=InnoDB;

CREATE TABLE city(
        id_city    Int  Auto_increment  NOT NULL ,
        id_country Int NOT NULL ,
        name_city  Varchar (255) NOT NULL
	,CONSTRAINT city_PK PRIMARY KEY (id_city)

	,CONSTRAINT city_country_FK FOREIGN KEY (id_country) REFERENCES country(id_country)
)ENGINE=InnoDB;

CREATE TABLE address(
        id_address     Int  Auto_increment  NOT NULL ,
        id_city       Int NOT NULL ,
        number_address Int NOT NULL ,
        name_address   Varchar (255) NOT NULL
	,CONSTRAINT address_PK PRIMARY KEY (id_address)

	,CONSTRAINT address_city_FK FOREIGN KEY (id_city) REFERENCES city(id_city)
)ENGINE=InnoDB;

CREATE TABLE `user`(
        `id_user`          Int  Auto_increment  NOT NULL ,
        `id_role`           Int NOT NULL ,
        `id_address`         Int NOT NULL ,
        `id_authentification`Int NOT NULL ,
        `lastname_user`     Varchar (255) NOT NULL ,
        `firstname_user`     Varchar (255) NOT NULL ,
        `email_user`       Varchar (255) NOT NULL ,
        `password_user`     Varchar(255) NOT NULL ,
        `token_user`        Varchar(255) NOT NULL ,
        `pseudo_user`      Varchar (255) NOT NULL ,
        `dateBirth_user`    Date NOT NULL ,
        `description_user`   Text ,
        `picture_user`       Varchar (255) ,
        `isMailValid`       tinyint(1) NOT NULL ,
        `phone_user`         Varchar (20) ,
        `secu_enabled_user` tinyint(1) NOT NULL
	,CONSTRAINT user_PK PRIMARY KEY (id_user)

	,CONSTRAINT user_role_FK FOREIGN KEY (id_role) REFERENCES role(id_role)
	,CONSTRAINT user_address0_FK FOREIGN KEY (id_address) REFERENCES address(id_address)
	,CONSTRAINT user_twoFA1_FK FOREIGN KEY (id_authentification) REFERENCES twoFA(id_authentification)
)ENGINE=InnoDB;

CREATE TABLE room(
        id_room      Int  Auto_increment  NOT NULL ,
        title_room   Varchar (255) NOT NULL ,
        date_room    Date NOT NULL ,
        content_room Text NOT NULL
	,CONSTRAINT room_PK PRIMARY KEY (id_room)
)ENGINE=InnoDB;

CREATE TABLE resetPswd(
        id_resetPswd     Int  Auto_increment  NOT NULL ,
        id_user          Int NOT NULL ,
        hashedToken_pswd Varchar (255) NOT NULL ,
        sendToken_pswd   Datetime NOT NULL ,
        expDate_pswd     Datetime NOT NULL
	,CONSTRAINT resetPswd_PK PRIMARY KEY (id_resetPswd)

	,CONSTRAINT resetPswd_user_FK FOREIGN KEY (id_user) REFERENCES user(id_user)
)ENGINE=InnoDB;

CREATE TABLE platform(
        id_platform   Int  Auto_increment  NOT NULL ,
        name_platform Varchar (255) NOT NULL
	,CONSTRAINT platform_PK PRIMARY KEY (id_platform)
)ENGINE=InnoDB;

CREATE TABLE development(
        id_development   Int  Auto_increment  NOT NULL ,
        name_development Varchar (255) NOT NULL
	,CONSTRAINT development_PK PRIMARY KEY (id_development)
)ENGINE=InnoDB;

CREATE TABLE `game`(
        `id_game`          Int  Auto_increment  NOT NULL ,
        `id_promo`         Int NOT NULL,
        `id_development`   Int NOT NULL ,
        `id_edition`       Int NOT NULL ,
        `id_pegi`          Int NOT NULL ,
        `name_game`        Varchar (255) NOT NULL ,
        `releaseDate_game` Date NOT NULL ,
        `picture_game`     Varchar (255) NOT NULL ,
        `price_game`       Float NOT NULL ,
        `note_game`        Float ,
        `isAvailable`      tinyint(1) NOT NULL
	,CONSTRAINT game_PK PRIMARY KEY (id_game)

	,CONSTRAINT game_promo_FK FOREIGN KEY (id_promo) REFERENCES promo(id_promo)
	,CONSTRAINT game_development0_FK FOREIGN KEY (id_development) REFERENCES development(id_development)
	,CONSTRAINT game_edition1_FK FOREIGN KEY (id_edition) REFERENCES edition(id_edition)
	,CONSTRAINT game_pegi2_FK FOREIGN KEY (id_pegi) REFERENCES pegi(id_pegi)
)ENGINE=InnoDB;

CREATE TABLE `mod`(
        `id_mod`   Int  Auto_increment  NOT NULL ,
        `name_mod` Varchar (255) NOT NULL
	,CONSTRAINT mod_PK PRIMARY KEY (id_mod)
)ENGINE=InnoDB;

CREATE TABLE `order`(
        `id_order`            Int  Auto_increment  NOT NULL ,
        `id_user`             Int NOT NULL ,
        `status_order`        tinyint(1) NOT NULL ,
        `date_order`          Date NOT NULL ,
        `required_date_order` Date NOT NULL
	,CONSTRAINT order_PK PRIMARY KEY (id_order)

	,CONSTRAINT order_user_FK FOREIGN KEY (id_user) REFERENCES user(id_user)
)ENGINE=InnoDB;

CREATE TABLE user__room(
        id_room    Int NOT NULL ,
        id_user    Int NOT NULL ,
        commentary Text NOT NULL ,
        date       Datetime NOT NULL
	,CONSTRAINT user__room_PK PRIMARY KEY (id_room,id_user)

	,CONSTRAINT user__room_room_FK FOREIGN KEY (id_room) REFERENCES room(id_room)
	,CONSTRAINT user__room_user0_FK FOREIGN KEY (id_user) REFERENCES user(id_user)
)ENGINE=InnoDB;

CREATE TABLE `user__game`(
        `id_user`   Int NOT NULL ,
        `id_game`   Int NOT NULL ,
        `id_order`  Int NOT NULL ,
        `id_promo`  Int NOT NULL ,
        `wish`      tinyint(1) NOT NULL ,
        `fav`       tinyint(1) NOT NULL ,
        `recommand` tinyint(1) NOT NULL
	,CONSTRAINT user__game_PK PRIMARY KEY (`id_user`,`id_game`,`id_order`,`id_promo`)

	,CONSTRAINT user__game_user_FK FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`)
	,CONSTRAINT user__game_game0_FK FOREIGN KEY (`id_game`) REFERENCES `game`(`id_game`)
	,CONSTRAINT user__game_order1_FK FOREIGN KEY (`id_order`) REFERENCES `order`(`id_order`)
	,CONSTRAINT user__game_promo2_FK FOREIGN KEY (`id_promo`) REFERENCES `promo`(`id_promo`)
)ENGINE=InnoDB;

CREATE TABLE game__category(
        id_category Int NOT NULL ,
        id_game     Int NOT NULL
	,CONSTRAINT game__category_PK PRIMARY KEY (id_category,id_game)

	,CONSTRAINT game__category_category_FK FOREIGN KEY (id_category) REFERENCES category(id_category)
	,CONSTRAINT game__category_game0_FK FOREIGN KEY (id_game) REFERENCES game(id_game)
)ENGINE=InnoDB;

CREATE TABLE game__platform(
        id_platform Int NOT NULL ,
        id_game     Int NOT NULL
	,CONSTRAINT game__platform_PK PRIMARY KEY (id_platform,id_game)

	,CONSTRAINT game__platform_platform_FK FOREIGN KEY (id_platform) REFERENCES platform(id_platform)
	,CONSTRAINT game__platform_game0_FK FOREIGN KEY (id_game) REFERENCES game(id_game)
)ENGINE=InnoDB;

CREATE TABLE `game__mod`(
        `id_mod`  Int NOT NULL ,
        `id_game` Int NOT NULL
	,CONSTRAINT game__mod_PK PRIMARY KEY (`id_mod`,`id_game`)

	,CONSTRAINT game__mod_mod_FK FOREIGN KEY (id_mod) REFERENCES `mod`(`id_mod`)
	,CONSTRAINT game__mod_game0_FK FOREIGN KEY (id_game) REFERENCES `game`(`id_game`)
)ENGINE=InnoDB;

CREATE TABLE `game__order`(
        `id_game`  Int NOT NULL ,
        `id_order` Int NOT NULL
	,CONSTRAINT game__order_PK PRIMARY KEY (`id_game`,`id_order`)

	,CONSTRAINT game__order_game_FK FOREIGN KEY (id_game) REFERENCES `game`(`id_game`)
	,CONSTRAINT game__order_order0_FK FOREIGN KEY (id_order) REFERENCES `order`(`id_order`)
)ENGINE=InnoDB;