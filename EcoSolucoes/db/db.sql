-- Create Database
CREATE DATABASE IF NOT EXISTS negocio_eletronico;

-- Use the database
USE negocio_eletronico;

-- -------------------------
-- Create Table: categories
-- -------------------------
CREATE TABLE IF NOT EXISTS categories (
                                          id INT AUTO_INCREMENT PRIMARY KEY,
                                          name VARCHAR(50) NOT NULL UNIQUE,
                                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- -----------------------------
-- Create Table: products
-- -----------------------------
CREATE TABLE IF NOT EXISTS products (
                                        id INT AUTO_INCREMENT PRIMARY KEY,

                                        name VARCHAR(100) NOT NULL,
                                        description TEXT,
                                        price DECIMAL(10, 2) NOT NULL CHECK (price >= 0),
                                        stock INT UNSIGNED DEFAULT 0,
                                        image VARCHAR(255),
                                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- --------------------------------
-- Create Table: product_categories
-- --------------------------------
CREATE TABLE IF NOT EXISTS product_categories (
                                                  product_id INT NOT NULL,
                                                  category_id INT NOT NULL,
                                                  PRIMARY KEY (product_id, category_id),
                                                  FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE ON UPDATE CASCADE,
                                                  FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- -------------------------
-- Create Table: users
-- -------------------------
-- Corrigir a tabela users
DROP TABLE IF EXISTS users;

CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(50) NOT NULL UNIQUE,
                       email VARCHAR(100) NOT NULL UNIQUE,
                       password CHAR(60) NOT NULL,
                       role ENUM('admin', 'user', 'moderator') DEFAULT 'user',
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ------------------------------
-- Create Table: product_ratings
-- ------------------------------
CREATE TABLE IF NOT EXISTS product_ratings (
                                               id INT AUTO_INCREMENT PRIMARY KEY,
                                               product_id INT NOT NULL,
                                               user_id INT NOT NULL,
                                               rating TINYINT NOT NULL CHECK (rating BETWEEN 1 AND 5),
                                               created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                               FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE ON UPDATE CASCADE,
                                               FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- ------------------------
-- Create Table: comments
-- ------------------------


-- --------------------
-- Create Table: jobs
-- --------------------
CREATE TABLE IF NOT EXISTS jobs (
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    title VARCHAR(100) NOT NULL,
                                    description TEXT NOT NULL,
                                    posted_date DATE NOT NULL,
                                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ------------------------------
-- Create Table: site_visits
-- ------------------------------
CREATE TABLE IF NOT EXISTS site_visits (
                                           id INT AUTO_INCREMENT PRIMARY KEY,
                                           visit_count INT UNSIGNED DEFAULT 0,
                                           visit_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ------------------------
-- Create Table: orders
-- ------------------------
CREATE TABLE IF NOT EXISTS orders (
                                      id INT AUTO_INCREMENT PRIMARY KEY,
                                      user_id INT NOT NULL,
                                      total_price DECIMAL(10, 2) NOT NULL CHECK (total_price >= 0),
                                      order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                      FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- --------------------------------
-- Create Table: order_details
-- --------------------------------
CREATE TABLE IF NOT EXISTS order_details (
                                             id INT AUTO_INCREMENT PRIMARY KEY,
                                             order_id INT NOT NULL,
                                             product_id INT NOT NULL,
                                             quantity INT UNSIGNED NOT NULL,
                                             price DECIMAL(10, 2) NOT NULL CHECK (price >= 0),
                                             FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE ON UPDATE CASCADE,
                                             FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- ------------------------------
-- Create Table: user_preferences
-- ------------------------------
CREATE TABLE IF NOT EXISTS user_preferences (
                                                user_id INT PRIMARY KEY,
                                                theme VARCHAR(20) DEFAULT 'light',
                                                language VARCHAR(5) DEFAULT 'pt',
                                                FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- ------------------------------
-- Create Table: activity_logs
-- ------------------------------
CREATE TABLE IF NOT EXISTS activity_logs (
                                             id INT AUTO_INCREMENT PRIMARY KEY,
                                             user_id INT,
                                             action VARCHAR(255) NOT NULL,
                                             log_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                             FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE SET NULL
);

INSERT INTO products (id, name, description, price, image) VALUES
                                                           (1,'Garrafa Reutilizável', 'Uma garrafa reutilizável ecológica.', 10.00, 'garrafa_reutilizavel.jpg'),
                                                           (2,'Saco de Compras Ecológico', 'Saco reutilizável feito de materiais sustentáveis.', 5.00, 'Saco_de_Compras_Bio_Darwin.png'),
                                                           (3,'Canudo de Bambu', 'Canudo reutilizável feito de bambu.', 1.50, 'Canudo_de_Bambu.png'),
                                                           (4,'Escova de Dentes de Madeira', 'Escova ecológica feita de madeira.', 3.00, 'Escova_de_Dentes_de_Madeira.png'),
                                                           (5,'Sabão Natural Artesanal', 'Sabão feito à mão com ingredientes naturais.', 4.80, 'Sabao_Natural_Artesanal.png');

CREATE TABLE comments (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          product_id INT NOT NULL,
                          user_id INT NOT NULL,
                          comment TEXT NOT NULL,
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                          FOREIGN KEY (product_id) REFERENCES products(id),
                          FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB;

SHOW ENGINES;

SHOW TABLES;
DESCRIBE products;

SELECT * FROM comments WHERE product_id = 1;
SELECT id FROM products WHERE id = 1;

SELECT id, name FROM products;

SELECT MAX(id) FROM products;
SELECT id FROM products WHERE id = 1;


