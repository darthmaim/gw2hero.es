<?php

namespace GW2Heroes\Http\Controllers;

use GW2Heroes\Models\Account;
use GW2Heroes\Models\Character;
use GW2Heroes\Models\User;
use Illuminate\Support\Collection;

class SitemapController extends Controller {
    public function getIndex() {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>'.
            '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $sitemaps = [
            action('SitemapController@getStatic'),
            action('SitemapController@getUsers'),
            action('SitemapController@getAccounts'),
            action('SitemapController@getCharacters')
        ];

        foreach( $sitemaps as $url ) {
            $sitemap .= '<sitemap><loc>'.$url.'</loc></sitemap>';
        }

        $sitemap .= '</sitemapindex>';

        return $this->makeXmlResponse($sitemap);
    }

    public function getStatic() {
        $staticPages = [
            action('WelcomeController@index'),
            action('Auth\AuthController@getLogin'),
            action('Auth\AuthController@getRegister'),
            action('SupportController@getContact'),
            action('SearchController@getIndex')
        ];

        $sitemap = $this->makeSitemap($staticPages);
        return $this->makeXmlResponse($sitemap);
    }

    public function getUsers() {
        $sitemap = $this->makeSitemap($this->getUserPages());
        return $this->makeXmlResponse($sitemap);
    }

    public function getAccounts() {
        $sitemap = $this->makeSitemap($this->getAccountPages());
        return $this->makeXmlResponse($sitemap);
    }

    public function getCharacters() {
        $sitemap = $this->makeSitemap($this->getCharacterPages());
        return $this->makeXmlResponse($sitemap);
    }

    protected function makeSitemap($pages) {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>'.
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach( $pages as $page ) {
            $sitemap .= '<url><loc>'.$page.'</loc></url>';
        }

        $sitemap .= '</urlset>';

        return $sitemap;
    }

    protected function makeXmlResponse($response) {
        return response($response, 200, ['Content-Type' => 'application/xml']);
    }

    protected function getUserPages() {
        /** @var Collection|User[] $users */
        $users = User::all();

        foreach( $users as $user ) {
            yield action('UserController@getIndex', $user->getActionData());
            yield action('UserController@getAccounts', $user->getActionData());
            yield action('UserController@getActivities', $user->getActionData());
        }
    }

    protected function getAccountPages() {
        /** @var Collection|Account[] $accounts */
        $accounts = Account::all();

        foreach( $accounts as $account ) {
            yield action('AccountController@getIndex', $account->getActionData());
            yield action('AccountController@getActivities', $account->getActionData());
            yield action('AccountController@getCharacters', $account->getActionData());
        }
    }

    protected function getCharacterPages() {
        /** @var Collection|Character[] $characters */
        $characters = Character::all();

        foreach( $characters as $character ) {
            yield action('CharacterController@getIndex', $character->getActionData());
            yield action('CharacterController@getActivities', $character->getActionData());
            yield action('CharacterController@getEquipment', $character->getActionData());
            yield action('CharacterController@getSpecializations', $character->getActionData());
            yield action('CharacterController@getStory', $character->getActionData());
        }
    }
}
