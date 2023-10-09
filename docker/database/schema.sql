DROP TABLE IF EXISTS failed_jobs;

CREATE TABLE failed_jobs (
  id int unsigned NOT NULL AUTO_INCREMENT,
  uuid varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  connection text COLLATE utf8mb4_unicode_ci NOT NULL,
  queue text COLLATE utf8mb4_unicode_ci NOT NULL,
  payload longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  exception longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  failed_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY failed_jobs_uuid_unique (uuid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS lib_tipo_midia;

CREATE TABLE lib_tipo_midia (
  id int unsigned NOT NULL AUTO_INCREMENT,
  descricao varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NOW(),
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO lib_tipo_midia (descricao)
VALUES ('Imagem'),
('Vídeo'),
('N/A');

DROP TABLE IF EXISTS lib_vertical;

CREATE TABLE lib_vertical (
  id int unsigned NOT NULL AUTO_INCREMENT,
  tipo_midia_id int unsigned NOT NULL,
  descricao varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  status tinyint(1) DEFAULT '1',
  created_at timestamp NULL DEFAULT NOW(),
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY lib_vertical_tipo_midia_id_foreign (tipo_midia_id),
  CONSTRAINT lib_vertical_tipo_midia_id_foreign FOREIGN KEY (tipo_midia_id) REFERENCES lib_tipo_midia (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO lib_vertical (
tipo_midia_id, descricao, status
) VALUES (2,'DOOH Embarcado',1),
(3,'Navee',0),
(1,'Sinalização Interna',0),
(1,'OOH',1),
(2,'DOOH Terminais',1),
(3,'Serviços e Experiênciais',0);

DROP TABLE IF EXISTS lib_produto;

CREATE TABLE lib_produto (
  id int unsigned NOT NULL AUTO_INCREMENT,
  vertical_id int unsigned NOT NULL,
  tipo_midia_id int NOT NULL,
  descricao varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  area_lar decimal(8,2) unsigned NOT NULL,
  area_alt decimal(8,2) unsigned NOT NULL,
  visual_lar decimal(8,2) unsigned NOT NULL,
  visual_alt decimal(8,2) unsigned NOT NULL,
  palco_lar int DEFAULT NULL,
  palco_alt int DEFAULT NULL,
  status_palco tinyint(1) NOT NULL DEFAULT '0',
  status tinyint(1) DEFAULT '1',
  created_at timestamp NULL DEFAULT NOW(),
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY lib_produto_vertical_id_foreign (vertical_id),
  CONSTRAINT lib_produto_vertical_id_foreign FOREIGN KEY (vertical_id) REFERENCES lib_vertical (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO lib_produto (
vertical_id, tipo_midia_id, descricao, area_lar, area_alt,
visual_lar, visual_alt, palco_lar, palco_alt, status_palco, status
) VALUES (4,1,'Bilheteria (Frente)',1.55,2.92,1.55,2.92,NULL,NULL,0,1),
(4,1,'Bilheteria (Lateral)',3.70,2.92,3.70,2.92,NULL,NULL,0,1),
(4,1,'Bilheteria (Traseira)',2.92,1.65,2.92,1.65,NULL,NULL,0,1),
(4,1,'MUB Vertical',1.19,1.79,1.12,1.72,NULL,NULL,0,1),
(4,1,'Painel Plataforma Vertical / Painel Bilheteria',1.23,2.34,1.15,2.26,NULL,NULL,0,1),
(4,1,'Painel Plataforma Horizontal',2.34,1.23,2.26,1.15,NULL,NULL,0,1),
(4,1,'Painel Entrada',2.93,1.43,2.87,1.37,NULL,NULL,0,1),
(4,1,'Painel Entrada Adesivo',2.93,1.43,2.93,1.43,NULL,NULL,0,1),
(4,1,'Catracas (Comum)',0.00,0.00,0.00,0.00,NULL,NULL,0,0),
(4,1,'Catracas (Cadeirante)',0.00,0.00,0.00,0.00,NULL,NULL,0,0),
(4,1,'Catracas (Estreita)',0.00,0.00,0.00,0.00,NULL,NULL,0,0),
(4,1,'Mega Coluna',1.36,3.96,1.30,3.90,NULL,NULL,0,1),
(4,1,'Painel Quadrado (Antigo Painel Muro)',2.35,2.35,2.30,2.30,NULL,NULL,0,1),
(4,1,'Testeira BB',3.95,0.75,3.90,0.70,NULL,NULL,0,1),
(4,1,'Painel Aéreo',3.95,1.45,3.90,1.40,NULL,NULL,0,1),
(4,1,'Painel Placa',3.80,2.50,3.80,2.50,NULL,NULL,0,1),
(4,1,'Mega Painel 1 e 2',16.83,2.43,16.76,2.36,NULL,NULL,0,1),
(4,1,'Testeira',4.04,0.49,4.04,0.49,NULL,NULL,0,1),
(4,1,'Painel Passarela',4.80,3.00,4.80,3.00,NULL,NULL,0,1),
(4,1,'Painel Externo',3.00,1.00,3.00,1.00,NULL,NULL,0,1),
(4,1,'Testeiras',3.12,0.84,3.12,0.84,NULL,NULL,0,1),
(4,1,'Testeira Escada',3.72,0.67,3.72,0.67,NULL,NULL,0,1),
(4,1,'Painel Subida Escada',2.30,2.15,2.24,2.09,NULL,NULL,0,1),
(4,1,'Painel Quadrado',2.35,2.35,2.30,2.30,NULL,NULL,0,1),
(4,1,'Painel Giga',22.78,4.19,22.78,4.19,NULL,NULL,0,1),
(4,1,'Painel Fundão',5.00,2.50,5.00,2.50,NULL,NULL,0,1),
(4,1,'Lycra Modelo 1',3.50,4.40,3.50,4.40,NULL,NULL,0,1),
(4,1,'Lycra Modelo 2',4.40,5.00,4.40,5.00,NULL,NULL,0,1),
(4,1,'Lycra Modelo 3',2.90,2.60,2.90,2.60,NULL,NULL,0,1),
(4,1,'Lycra Modelo 4',6.20,4.20,6.20,4.20,NULL,NULL,0,1),
(4,1,'Lycra Modelo 5',6.90,4.20,6.90,4.20,NULL,NULL,0,1),
(4,1,'Painel Aéreo',6.00,1.30,6.00,1.30,NULL,NULL,0,1),
(4,1,'Painel Placa Horizontal Interna',5.00,3.00,5.00,3.00,NULL,NULL,0,1),
(4,1,'Painel Placa Horizontal Externa',4.00,2.00,4.00,2.00,NULL,NULL,0,1),
(3,1,'Custo Backseat',0.00,0.00,0.00,0.00,NULL,NULL,0,0),
(4,1,'Painel Plataforma com Assento Acoplado',2.30,1.00,2.40,1.10,NULL,NULL,0,1),
(4,1,'Envelopamento Fachada Sala Vip 1',3.10,2.03,3.10,2.03,NULL,NULL,0,1),
(4,1,'Envelopamento Fachada Sala Vip 2',3.20,2.03,3.20,2.03,NULL,NULL,0,1),
(4,1,'Envelopamento Fachada Sala Vip 3',1.60,2.03,1.60,2.03,NULL,NULL,0,1),
(4,1,'Envelopamento Fachada Sala Vip 4',2.96,2.03,2.96,2.03,NULL,NULL,0,1),
(4,1,'Envelopamento Fachada Sala Vip 5',3.15,2.03,3.15,2.03,NULL,NULL,0,1),
(4,1,'Envelopamento Fachada Sala Vip 6',3.05,2.03,3.05,2.03,NULL,NULL,0,1),
(4,1,'Painel de Coluna',0.60,2.70,0.68,2.78,NULL,NULL,0,1),
(4,1,'Painel Master Backlight',2.86,1.35,2.93,1.43,NULL,NULL,0,1),
(4,1,'Painel de Coluna Backlight Embarque',0.56,1.10,0.59,1.13,NULL,NULL,0,1),
(4,1,'Painel de Coluna Clássico',0.72,1.13,0.72,1.13,NULL,NULL,0,1),
(4,1,'Painel Coluna Backlight',0.70,2.00,0.68,1.98,NULL,NULL,0,1),
(4,1,'Painel Coluna Desembarque',0.68,1.94,0.68,1.94,NULL,NULL,0,1),
(4,1,'Painel Master Backlight',2.86,1.35,2.93,1.43,NULL,NULL,0,1),
(4,1,'Mub',1.10,1.70,1.20,1.80,NULL,NULL,0,1),
(4,1,'Mub Backlight',1.10,1.70,1.20,1.80,NULL,NULL,0,1),
(4,1,'Totem de Plataforma',0.61,1.35,0.63,1.37,NULL,NULL,0,1),
(4,1,'Testeiras Backlight',3.90,0.90,3.98,0.98,NULL,NULL,0,1),
(1,2,'DOOH (TV Ônibus)',1366.00,768.00,1366.00,768.00,1366,768,0,1),
(5,2,'Mega Aéreo (Alvorada)',686.00,342.00,686.00,342.00,1366,768,0,1),
(5,2,'Picolé (Alvorada)',170.00,342.00,170.00,342.00,1366,768,0,1),
(5,2,'Mega Aéreo (Campo Grande)',550.00,270.00,550.00,270.00,1366,768,0,1),
(5,2,'Testeiras (Campo Grande)',410.00,140.00,410.00,140.00,1366,768,0,1),
(5,2,'CDT (Paulo Portela)',1440.00,144.00,1440.00,144.00,1920,1080,0,1),
(5,2,'Telão P6 (Duque de Caxias)',572.00,304.00,572.00,304.00,1366,768,1,1),
(5,2,'Painel Marquise P6 (Duque de Caxias)',510.00,204.00,510.00,204.00,1366,768,1,1),
(5,2,'Totem Digital 42\" e 49\" (Duque de Caxias)',1366.00,768.00,1366.00,768.00,1366,768,0,1),
(5,2,'Telas 40\" (Duque de Caxias)',1366.00,768.00,1366.00,768.00,1366,768,0,1),
(5,2,'Dispenser de Álcool em Gel (Duque de Caxias)',1366.00,768.00,1366.00,768.00,1366,768,0,1),
(5,2,'Telão LED P4 (Nilópolis)',768.00,510.00,768.00,510.00,1366,768,1,1),
(5,2,'TV 32\" (Nilópolis)',1366.00,768.00,1366.00,768.00,1366,768,0,1),
(5,2,'TV 40\" (Menezes Cortes)',1366.00,768.00,1366.00,768.00,1366,768,0,1),
(5,2,'Dispenser de Álcool em Gel (Menezes Cortes)',768.00,1366.00,768.00,1366.00,1366,768,0,1),
(5,2,'Carregador Digital 32\" (Menezes Cortes)',768.00,1366.00,768.00,1366.00,1366,768,0,1),
(5,2,'Telão LED P4 Full Color (Nova Iguaçu)',288.00,586.00,288.00,586.00,1366,768,1,1),
(5,2,'TV 32\" (Nova Iguaçu)',1366.00,768.00,1366.00,768.00,1366,768,0,1),
(4,1,'Painel Saída da Passarela',2.10,0.85,2.10,0.85,NULL,NULL,0,1);

DROP TABLE IF EXISTS migrations;

CREATE TABLE migrations (
  id int unsigned NOT NULL AUTO_INCREMENT,
  migration varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  batch int NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id int unsigned NOT NULL AUTO_INCREMENT,
  name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  email varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  email_verified_at timestamp NULL DEFAULT NULL,
  password varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  remember_token varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY users_email_unique (email)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS oauth_access_tokens;

CREATE TABLE oauth_access_tokens (
  id varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  user_id int unsigned DEFAULT NULL,
  client_id int unsigned NOT NULL,
  name varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  scopes text COLLATE utf8mb4_unicode_ci,
  revoked tinyint(1) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  expires_at datetime DEFAULT NULL,
  PRIMARY KEY (id),
  KEY oauth_access_tokens_user_id_index (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS oauth_auth_codes;

CREATE TABLE oauth_auth_codes (
  id varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  user_id int unsigned NOT NULL,
  client_id int unsigned NOT NULL,
  scopes text COLLATE utf8mb4_unicode_ci,
  revoked tinyint(1) NOT NULL,
  expires_at datetime DEFAULT NULL,
  PRIMARY KEY (id),
  KEY oauth_auth_codes_user_id_index (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS oauth_clients;

CREATE TABLE oauth_clients (
  id int unsigned NOT NULL AUTO_INCREMENT,
  user_id int unsigned DEFAULT NULL,
  name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  secret varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  provider varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  redirect text COLLATE utf8mb4_unicode_ci NOT NULL,
  personal_access_client tinyint(1) NOT NULL,
  password_client tinyint(1) NOT NULL,
  revoked tinyint(1) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY oauth_clients_user_id_index (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS oauth_personal_access_clients;

CREATE TABLE oauth_personal_access_clients (
  id int unsigned NOT NULL AUTO_INCREMENT,
  client_id int unsigned NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS oauth_refresh_tokens;

CREATE TABLE oauth_refresh_tokens (
  id varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  access_token_id varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  revoked tinyint(1) NOT NULL,
  expires_at datetime DEFAULT NULL,
  PRIMARY KEY (id),
  KEY oauth_refresh_tokens_access_token_id_index (access_token_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS password_reset_tokens;

CREATE TABLE password_reset_tokens (
  email varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  token varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS personal_access_tokens;

CREATE TABLE personal_access_tokens (
  id int unsigned NOT NULL AUTO_INCREMENT,
  tokenable_type varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  tokenable_id int unsigned NOT NULL,
  name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  token varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  abilities text COLLATE utf8mb4_unicode_ci,
  last_used_at timestamp NULL DEFAULT NULL,
  expires_at timestamp NULL DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY personal_access_tokens_token_unique (token),
  KEY personal_access_tokens_tokenable_type_tokenable_id_index (tokenable_type,tokenable_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
