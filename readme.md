# GridMap Research Tool

This is used in a research project into graphical GridMap passwords at the University of Twente. It can freely be used and edited for follow-up research.

## Installation instructions

First you'll have to clone the repository somewhere in the vicinity of your public web folder using git:

```
git clone git@github.com:jonathanjuursema/gridmap.git
```

In the repository you'll find a file called `.env.example`. Make a copy of this file called `.env`:

```
cp .env.example .env
```

Change `.env` to suit your needs.

Now we need to initialize the program:

```
php artisan down
composer install
php artisan migrate
php artisan up
```

Now you have set-up the tool correctly. The only thing that remains is pointing your web directory to the `public` directory of the website. This is where the front-facing controllers reside. The rest of the project is then shielded from public access. You could do this using symlinks. An example command on a webserver running DirectAdmin could like like this:

```
ln -s /home/user/domains/example.gridmap.nl/saproto/public /home/user/domains/example.gridmap.nl/public_html
```

That's it, everything should be up and running!
