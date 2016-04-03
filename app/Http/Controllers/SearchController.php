<?php namespace GW2Heroes\Http\Controllers;

use Cache;
use GW2Heroes\Models\Account;
use GW2Heroes\Models\Character;
use GW2Heroes\Models\Guild;
use GW2Heroes\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Input;

class SearchController extends Controller {
    const RESULTS_PER_PAGE = 15;

    protected $tabs = ['characters', 'accounts', 'users', 'guilds'];

    /**
     * @param $searchTerm
     * @return LengthAwarePaginator[]
     */
    protected function getSearchResults($searchTerm) {
        $searchTerm = mb_strtoupper(trim($searchTerm));

        $appendParameters = Arr::except(Input::query(), 'page');

        $characters = Character::whereStringContains( 'name', $searchTerm )->paginate(self::RESULTS_PER_PAGE)->appends($appendParameters);
        $accounts = Account::whereStringContains( 'name', $searchTerm )->paginate(self::RESULTS_PER_PAGE)->appends($appendParameters);
        $users = User::whereStringContains( 'name', $searchTerm )->paginate(self::RESULTS_PER_PAGE)->appends($appendParameters);
        $guilds = Guild::whereStringContains( 'name', $searchTerm )->paginate(self::RESULTS_PER_PAGE)->appends($appendParameters);

        return compact('users', 'accounts', 'characters', 'guilds');
    }

    public function getIndex() {
        if( Input::has('q')) {
            $searchTerm = trim(Input::get('q'));
            $searchResults = $this->getSearchResults($searchTerm);

            $tab = Input::get('tab');

            if( is_null( $tab ) || !in_array( $tab, $this->tabs )) {
                foreach( $this->tabs as $tab ) {
                    if( $searchResults[$tab]->total() > 0 ) {
                        return redirect()->action('SearchController@getIndex', ['q' => $searchTerm, 'tab' => $tab]);
                    }
                }

                return redirect()->action('SearchController@getIndex', ['tab' => $this->tabs[0], 'q' => $searchTerm]);
            }

            return view('search.'.$tab, compact('searchTerm'))->with($searchResults);
        }

        return view('search.search');
    }
}
