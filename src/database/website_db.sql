DROP TABLE IF EXISTS User;

DROP TABLE IF EXISTS Password;

DROP TABLE IF EXISTS Story;

DROP TABLE IF EXISTS Image;

DROP TABLE IF EXISTS Comment;

DROP TABLE IF EXISTS Reply;

DROP TABLE IF EXISTS Rented;

DROP TRIGGER IF EXISTS Rate;

CREATE TABLE User(
    username TEXT PRIMARY KEY,
    name TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    profile_image INTEGER REFERENCES Image,
    birthday DATE NOT NULL,
    nationality TEXT,
    password TEXT NOT NULL
);


CREATE TABLE Image(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    url TEXT NOT NULL,
    story INTEGER REFERENCES Story
);

CREATE TABLE Story(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    country TEXT NOT NULL,
    city TEXT NOT NULL,
    address TEXT NOT NULL,
    main_image INTEGER REFERENCES Image UNIQUE,
    details TEXT NOT NULL,
    number_ratings INTEGER NOT NULL,
    sum_ratings INTEGER NOT NULL,
    owner TEXT REFERENCES User,
    post_date date NOT NULL,
    price_per_night FLOAT NOT NULL,
    capacity INTEGER NOT NULL
);

CREATE TABLE Comment(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT REFERENCES User,
    story INTEGER REFERENCES Story,
    comment_date DATE NOT NULL,
    content TEXT NOT NULL,
    rate INTEGER
);

CREATE TABLE Reply(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    comment INTEGER REFERENCES Comment,
    username TEXT REFERENCES User,
    comment_date DATE NOT NULL,
    content TEXT NOT NULL
);

CREATE TABLE Rented(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    renter TEXT REFERENCES User,
    story INTEGER REFERENCES Story,
    stay_start date NOT NULL,
    stay_end date NOT NULL,
    number_of_people INTEGER NOT NULL,
    total_price FLOAT NOT NULL
);

--Rating Trigger
CREATE TRIGGER IF NOT EXISTS Rate 
AFTER INSERT ON Comment
WHEN (new.rate is not null)
	BEGIN
		UPDATE Story
		SET sum_ratings = sum_ratings + new.rate,
            number_ratings = number_ratings + 1
	WHERE id = new.story;
	END;

--Defaul Avatar Image
INSERT INTO
    Image
VALUES
    (1, 'default_avatar', 'avatar_male.png', NULL);
