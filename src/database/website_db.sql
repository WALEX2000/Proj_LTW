DROP TABLE IF EXISTS User;

DROP TABLE IF EXISTS Password;

DROP TABLE IF EXISTS Story;

DROP TABLE IF EXISTS Image;

DROP TABLE IF EXISTS Comment;

DROP TABLE IF EXISTS Rented;

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
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    url TEXT NOT NULL,
    story INTEGER REFERENCES Story
);

CREATE TABLE Story(
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    country TEXT NOT NULL,
    city TEXT NOT NULL,
    address TEXT NOT NULL,
    main_image TEXT REFERENCES Image UNIQUE,
    details TEXT NOT NULL,
    average_rating FLOAT NOT NULL,
    owner TEXT REFERENCES User,
    post_date date NOT NULL,
    price_per_night FLOAT NOT NULL
);

CREATE TABLE Comment(
    id INTEGER PRIMARY KEY,
    username TEXT REFERENCES User,
    story INTEGER REFERENCES Story,
    comment_date DATE NOT NULL,
    content TEXT NOT NULL
);

CREATE TABLE Rented(
    id INTEGER PRIMARY KEY,
    renter TEXT REFERENCES User,
    story INTEGER REFERENCES Story,
    stay_start date NOT NULL,
    stay_end date NOT NULL,
    --check if start after end
    rating INTEGER CHECK(
        rating >= 1
        and rating <= 5
    ),
    number_of_people INTEGER NOT NULL,
    total_price FLOAT NOT NULL
);

/*
INSERT INTO
    User
VALUES
    (
        'scarletJoe',
        'Scarlett Johansson',
        'scarletJoe@gmail.com',
        'scarlet_pic',
        '1980-09-10',
        'American'
    );

INSERT INTO
    User
VALUES
    (
        'walex',
        'Lafao',
        'walex@gmail.com',
        'alex_pic',
        '2000-01-06',
        'American'
    );*/

INSERT INTO
    Story
VALUES
    (
        1,
        'Quarto romantico',
        'Austria',
        'Vienna',
        'Vultkestein, 420',
        'qrom_image',
        'muito botino',
        5.0,
        'scarletJoe',
        '2019-01-06',
        90
    );

INSERT INTO
    Story
VALUES
    (
        2,
        'Quarto do amorrr',
        'Slovakia',
        'Bratislava',
        'Rua do Leitao, 101',
        'qamor_image',
        'muito botino',
        0,
        'scarletJoe',
        '2019-01-06',
        80
    );

INSERT INTO
    Comment
VALUES
    (
        1,
        'walex',
        1,
        '2019-01-06',
        'muito botino memo'
    );

INSERT INTO
    Rented
VALUES
    (
        1,
        'walex',
        1,
        '2019-01-06',
        '2019-01-16',
        5,
        1,
        90
    );

INSERT INTO
    Rented
VALUES
    (
        2,
        'walex',
        2,
        '2019-02-06',
        '2019-02-16',
        5,
        1,
        90
    );

INSERT INTO
    Image
VALUES
    (1, 'scarlet_pic', 'profilePic.jpg', NULL);

INSERT INTO
    Image
VALUES
    (2, 'alex_pic', 'url1', NULL);

INSERT INTO
    Image
VALUES
    (3, 'qrom_image', 'profilePic.jpg', 1);

    
INSERT INTO
    Image
VALUES
    (4, 'qamor_image', 'url3', 1);