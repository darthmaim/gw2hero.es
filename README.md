<p align="center">
  <a href="https://gw2hero.es/">
    <img src="https://gw2hero.es/assets/images/logo.png" width="500">
  </a>
</p>

# Setup

1. Clone this repository.
2. Run `composer install --dev`.
3. Run `npm install`
4. Make sure the directory `storage` is writeable.
5. Copy `.env.example` to `.env`.
6. Run `./artisan key:generate` (`artisan key:generate` on windows).
7. Update the contents of `.env` with your database config (Create a new database and a new user if you haven't already).
8. Run `./artisan migrate` (`artisan migrate` on windows).
9. Run `gulp build`
