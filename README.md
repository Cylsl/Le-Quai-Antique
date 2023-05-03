# Le-Quai-Antique

Voir branche master pour les fichiers

Pour se connecter en local

 DATABASE_URL="mysql://root@127.0.0.1:3306/quaiantique?serverVersion=mariadb-10.4.11"
 http://localhost/phpmyadmin/index.php?route=/database/structure&db=quaiantique
 
 Pour créer un administrateur : il faut se rendre sur la page admin du site qui gérée par EasyAdmin et aller dans "Utilisateur". Ici vous avez la liste des utilisateurs, en cliquant sur les trois points et sur edit, il est possible de choisir le rôle de l'utilisateur. Soit Administrateur, soit utilisateur ou les deux.
 
 
 
 liste des requêtes SQL exécutées :
 
 CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
 
 ALTER TABLE user ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)
 
 CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
 
 CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, illustration VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
 ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)
 
 ALTER TABLE product ADD is_best TINYINT(1) NOT NULL
 
 CREATE TABLE header (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, btn_title VARCHAR(255) NOT NULL, btn_url VARCHAR(255) NOT NULL, illustration VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
 
 CREATE TABLE reset_password (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B9983CE5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
 
 ALTER TABLE reset_password ADD CONSTRAINT FK_B9983CE5A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)
 
 CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, time TIME NOT NULL, num_people INT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, allergy VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
 
 ALTER TABLE reservation ADD name VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD phone INT NOT NULL, ADD guests INT NOT NULL, ADD time TIME NOT NULL, ADD allergy VARCHAR(255) NOT NULL, CHANGE created_at date DATETIME NOT NULL
 
 ALTER TABLE reservation ADD content LONGTEXT NOT NULL
 
 ALTER TABLE reservation ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, DROP name, CHANGE time time VARCHAR(255) NOT NULL
 
 ALTER TABLE reservation ADD fullname VARCHAR(255) NOT NULL
 ALTER TABLE user ADD fullname VARCHAR(255) NOT NULL
 
 CREATE TABLE allergies (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, allergies VARCHAR(255) DEFAULT NULL, INDEX IDX_8D19BF1BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
ALTER TABLE allergies ADD CONSTRAINT FK_8D19BF1BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)

ALTER TABLE allergies ADD reservation_id INT DEFAULT NULL')
  ALTER TABLE allergies ADD CONSTRAINT FK_8D19BF1BB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)
  CREATE INDEX IDX_8D19BF1BB83297E7 ON allergies (reservation_id)
  
ALTER TABLE reservation ADD state INT NOT NULL, CHANGE user_id user_id INT NOT NULL  

CREATE TABLE limit_reservation (id INT AUTO_INCREMENT NOT NULL, limite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB

ALTER TABLE limit_reservation ADD time INT NOT NULL
ALTER TABLE reservation CHANGE time time VARCHAR(255) NOT NULL
 
ALTER TABLE user CHANGE id id INT AUTO_INCREMENT NOT NULL
  
 
 
