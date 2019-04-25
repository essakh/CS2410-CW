<?php
use App\Animal; //using eloquent, allows us to do database queries in other then SQL.
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'AnimalController@index'); // just incase anything redricts to '/'

    /**
     * Attaches a new column to the pivot table (animal_user), aka. user requested to adopt an animal
     *
     * @param  int  $id : animal_id
     * @return \Illuminate\Http\Response
     */
Route::get('/animal_user_change_status/{animal_id}/attach', function($id) {

    $animal = Animal::find($id);
    
    $user_id = auth()->user()->id;
    $user = User::find($user_id);

    
    $user->animals()->sync($animal);


    //$animal->user->sync([$user_id]);

    return view('animals.show')->with('success', 'Adoption request sent.')->with('animal', $animal);

});




Route::resource('Animal', 'AnimalController');
Route::resource('animal_users', 'animal_usersController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
