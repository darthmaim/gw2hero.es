<p align="center">
  <a href="https://gw2hero.es/">
    <img src="https://gw2hero.es/assets/images/logo.png" width="500">
  </a>
</p>

# Requirements

[![Join the chat at https://gitter.im/chillerlan/gw2hero.es](https://badges.gitter.im/chillerlan/gw2hero.es.svg)](https://gitter.im/chillerlan/gw2hero.es?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

- **[PHP](http://php.net/)** >=5.5
- **[MySQL](http://www.mysql.com/)** or **[MariaDB](https://mariadb.org/)**
- **[composer](https://getcomposer.org/)** for PHP dependency management.
- **[node](https://nodejs.org/)**
- **[npm](https://www.npmjs.com/)** (comes bundled with node) for frontend dependency management.

# Installation

1. Clone this repository*.
2. Run `composer install --dev` to install all php dependencies.
3. Run `npm install` to install all frontend dependencies.
4. Make sure the directory `storage` is writeable.
5. Copy `.env.example` to `.env`.
6. Run `./artisan key:generate` (`artisan key:generate` on windows).
7. Update the contents of `.env` with your database config (Create a new database and a new user if you haven't already).
8. Run `./artisan migrate` (`artisan migrate` on windows) to create all needed tables in your database.
9. Run `gulp build` to build all frontend assets.

*) If you want to use a local web server (for example apache or nginx), it's recommended to create a new vhost, otherwise place the repository in your web root. Make sure the server is configured to run PHP. If you don't want to use a locally installed web server you can run `artisan serve` after the installation to create a new temporary server that is accessible at [http://localhost:8000/](http://localhost:8000/).

# License

[MIT](LICENSE) © 2015 gw2hero.es
