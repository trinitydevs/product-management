CREATE TABLE IF NOT EXISTS products (
    idProduct INTEGER PRIMARY KEY AUTOINCREMENT,
    nameProduct VARCHAR(50) NOT NULL,
    descProduct VARCHAR(500) NOT NULL,
    priceProduct FLOAT NOT NULL,
    stockProduct INTEGER NOT NULL,
    userInsert INTEGER NOT NULL,
    dateHour DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS logs (
    idLog INTEGER PRIMARY KEY AUTOINCREMENT,
    actionLog VARCHAR(20) NOT NULL,
    dateHour DATETIME NOT NULL,
    userInsert INTEGER NOT NULL,
    idProduct INTEGER NOT NULL
);