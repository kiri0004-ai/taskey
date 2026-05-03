CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    user_name TEXT,
    password TEXT,
    role TEXT ON DELETE CASCADE
);
