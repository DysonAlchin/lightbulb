create  table IF NOT EXISTS messaging
(
    message_id INTEGER not null PRIMARY KEY AUTOINCREMENT,
    sender TEXT,
    recipient int,
    message TEXT,
    dateSubmitted DATETIME
);