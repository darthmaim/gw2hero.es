<?php namespace GW2Heroes\Http\Controllers;

use Cache;
use GW2Heroes\Models\Account;
use GW2Heroes\Models\Character;
use GW2Heroes\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Input;

class SearchController extends Controller {
    protected $tabs = ['characters', 'accounts', 'users'];

    /**
     * @param $searchTerm
     * @return Collection[]
     */
    protected function getSearchResults($searchTerm) {
        $searchTerm = mb_strtoupper(trim($searchTerm));
        $cacheKey = 'search:'.md5($searchTerm);

        return Cache::remember($cacheKey, 5, function() use ($searchTerm) {
            $characters = $this->rawLikeStatement( Character::query(), 'name', $searchTerm )->get();
            $accounts = $this->rawLikeStatement( Account::query(), 'name', $searchTerm )->get();
            $users = $this->rawLikeStatement( User::query(), 'name', $searchTerm )->get();

            return compact('users', 'accounts', 'characters');
        });
    }

    public function getIndex() {
        if( Input::has('q')) {
            $searchTerm = trim(Input::get('q'));
            $searchResults = $this->getSearchResults($searchTerm);

            $tab = Input::get('tab');

            if( is_null( $tab ) || !in_array( $tab, $this->tabs )) {
                foreach( $this->tabs as $tab ) {
                    if( $searchResults[$tab]->count() > 0 ) {
                        return redirect()->action('SearchController@getIndex', ['q' => $searchTerm, 'tab' => $tab]);
                    }
                }
                return redirect()->action('SearchController@getIndex', ['tab' => $this->tabs[0], 'q' => $searchTerm]);
            }

            return view('search.'.$tab, compact('searchTerm'))->with($searchResults);
        }

        return view('search.search');
    }

    /**
     * @param Builder $query
     * @param string  $column
     * @param string  $searchTerm
     * @return Builder
     *
     * @todo Refactor into common base model scope method.
     */
    protected function rawLikeStatement( Builder $query, $column, $searchTerm) {
        // escape like query param (don't use backslash because it gets really awkward with quadruple escapes...)
        $e = '=';
        $escapedParam = str_replace([$e, '%', '_'], [$e.$e, $e.'%', $e.'_'], $searchTerm);

        return $query->whereRaw("UPPER(`$column`) LIKE ? ESCAPE '$e'", ['%'.$escapedParam.'%']);
    }
}
