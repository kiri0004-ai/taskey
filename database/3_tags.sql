CREATE TABLE tags (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT
);

INSERT INTO tasks (title) VALUES
 ('Dragon'),
 ('Ninja'),
 ('Dwarf');

CREATE TABLE  task_tags (
    tag_id INTEGER,
    task_id INTEGER,
    PRIMARY KEY (tag_id,task_id),
    FOREIGN KEY (task_id) REFERENCES tasks,
    FOREIGN KEY (tag_id) REFERENCES tags
)