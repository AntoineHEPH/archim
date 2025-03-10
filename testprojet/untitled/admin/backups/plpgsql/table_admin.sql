CREATE TABLE admin (
    id_admin SERIAL PRIMARY KEY,
    nom_admin VARCHAR(100) NOT NULL,
    login_admin VARCHAR(50) UNIQUE NOT NULL,
    password_admin VARCHAR(255) NOT NULL
);
