<?php

use Carbon\Carbon;
use App\Models\Weather;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
$locdata            = json_decode(file_get_contents(Request::ip() != "127.0.0.1" ? "http://ipinfo.io/".Request::ip()."/json" : "http://ipinfo.io/json"));
    list($lat, $lng)    = explode(',', $locdata->loc);

    $locdata->lat = $lat;
    $locdata->lng = $lng;

    $date = Carbon::now(new DateTimeZone($locdata->timezone));

    $decision = "";

    if($date->hour >= 7 && $date->hour < 11){
        $decision = "Dès le réveil ? Non, non prends plutôt un café...";
    }else if($date->hour >= 11 && $date->hour < 12){
        $decision = "Allez, un petit coup avant le repas... Apéro!";
    }else if($date->hour >= 13 && $date->hour < 14){
        $decision = "Juste après avoir mangé ? Pas raisonnable!";
    }else if($date->hour >= 14 && $date->hour < 17){
        $decision = "Maintenant, il va falloir attendre la fin d'après midi!";
    }else if($date->hour >= 17 && $date->hour < 18){
        $decision = "Tic-tac Tic-tac... Prépare les verres, c'est bientôt bon!";
    }else if($date->hour >= 18 && $date->hour < 20){
        if(in_array($date->dayOfWeek, [1,2,3,4])){
            $decision = "La journée a été rude ? Il et temps de décompresser... Apéro !";
        }elseif($date->dayOfWeek == 5){
            $decision = "La semaine est finie, ça se fête... Apéro!";
        }elseif($date->dayOfWeek == 6){
            $decision = "C'est le weekend, on se lâche un peu... Apéro!";
        }elseif($date->dayOfWeek == 7){
            $decision = "On se donne du courage pour rattaquer la semaine... Apéro!";
        }
    }else if($date->hour >= 20 && $date->hour < 22){
        $decision = "Un dernier verre pour pas finir bancal!";
    }else if($date->hour >= 22 && $date->hour <= 23){
        $decision = "Un peu en retard non ? Dernière chance pour boire un verre";
    }else if($date->hour >= 0 && $date->hour < 4){
        if (in_array($date->dayOfWeek, [1,2,3,4])) {
            $decision = "J'en connais un qui va faire semblant au boulot... Vaudrait mieux se coucher !";
        }else{
            $decision = "L'Apéro? C'est plutôt l'after les gars !";
        }
    }

    ## Weather
    $weather = new Weather($lat, $lng);

    return view('welcome', [
        'date'      => $date,
        'weather'   => $weather->getCurrent(),
        'location'  => $locdata,
        'decision'  => $decision,
    ]);
});


Route::get('/weather/{lat}/{lng}', function ($lat, $lng) {
    return (new Weather($lat, $lng))->getCurrent();
});
