<?php

namespace App\Http\Controllers;

use App\Imports\ImportRanking;
use App\Mail\PublishMail;
use App\Mail\UpdateEmailAita;
use App\Models\Academy;
use App\Models\Player;
use App\Models\PlayerRegisterTournament;
use App\Models\Rank;
use App\Models\RankDate;
use App\Models\Slide;
use App\Models\Tournament;
use App\Models\TournamentImage;
use App\Models\UniqueVisitors;
use App\Models\UploadAcademyImage;
use App\Models\UploadPlayerImage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class AdminController extends Controller
{

    // admin login
    //sandhya
    public function admin(Request $req)
    {

        if (session()->has('ADMIN')) {

            $players = Player::count();

            $academies = Academy::count();

            $tournaments = Tournament::count();
            $visitors = UniqueVisitors::count();
            Log::info($visitors);
            return view('admin.adminDashboard',

                [

                    'players' => $players,

                    'academies' => $academies,

                    'tournaments' => $tournaments,
                    'visitors' => $visitors,

                ]

            );

        } else {

            return view('admin.admin');

        }

    }
    //end

    // admin auth
    public function adminAuth(Request $req)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        $req->validate($rules);

        $email = $req->email;
        $password = $req->password;

        if ($email == 'admin') {

            if ($password == '123') {

                $req->session()->put('ADMIN', true);

                $req->session()->put('panel', $email);

                return redirect()->route('admin.adminDashboard');

            } else {

                Session::flash('error', 'Wrong password.');

                return redirect()->back();

            }

        } else {

            Session::flash('error', 'Wrong user ID.');

            return redirect()->back();

        }

    }

    // adminDashboard

    public function adminDashboard()
    {

        $players = Player::count();

        $academies = Academy::count();

        $tournaments = Tournament::count();
        $visitors = UniqueVisitors::count();
        Log::info($visitors);
        return view('admin.adminDashboard',

            [

                'players' => $players,

                'academies' => $academies,

                'tournaments' => $tournaments,
                'visitors' => $visitors,

            ]

        );

    }

    // player list
    public function playerList(Request $request)
    {
        $category = $request->input('category', 'all');
        $players = Player::all()->map(function ($player) {
            $player->age = Carbon::parse($player->dob)->age;
            return $player;
        });

        if ($category !== 'all') {
            $players = $players->filter(function ($player) use ($category) {
                if ($category === 'boys_under_12' && $player->age <= 12 && $player->gender == 'Male') {
                    return true;
                }

                if ($category === 'boys_under_14' && $player->age > 12 && $player->age <= 14 && $player->gender == 'Male') {
                    return true;
                }

                if ($category === 'boys_under_16' && $player->age > 14 && $player->age <= 16 && $player->gender == 'Male') {
                    return true;
                }

                if ($category === 'boys_under_18' && $player->age > 16 && $player->age <= 18 && $player->gender == 'Male') {
                    return true;
                }

                if ($category === 'girls_under_12' && $player->age <= 12 && $player->gender == 'Female') {
                    return true;
                }

                if ($category === 'girls_under_14' && $player->age > 12 && $player->age <= 14 && $player->gender == 'Female') {
                    return true;
                }

                if ($category === 'girls_under_16' && $player->age > 14 && $player->age <= 16 && $player->gender == 'Female') {
                    return true;
                }

                if ($category === 'girls_under_18' && $player->age > 16 && $player->age <= 18 && $player->gender == 'Female') {
                    return true;
                }

                if ($category === 'men' && $player->age > 18 && $player->gender == 'Male') {
                    return true;
                }

                if ($category === 'women' && $player->age > 18 && $player->gender == 'Female') {
                    return true;
                }

                return false;
            });
        }

        return view('admin.players.playersList', ['players' => $players]);
    }

    // player/playerDetail.blade.php
    public function playerDetail(Request $req)
    {
        $id = $req->id;
        $details = Player::where('player_id', '=', $id)->first();
        $player_images = UploadPlayerImage::where('player_id', '=', $id)->get();

        return view('admin.players.playerDetail', [
            'details' => $details,
            'player_images' => $player_images,
        ]);
    }

    // player/playerPublish

    public function playerPublish(Request $req)
    {

        $id = $req->id;

        $unCheckedCheckbox = $req->unCheckedCheckbox;

        try {

            $player = Player::find($id);

            if (!$player) {

                Alert::error('Error', 'Player not found!');

                return redirect()->back();

            }

            $email = $player->email;

            $fname = $player->first_name;

            $mname = $player->middle_name;

            $lname = $player->last_name;

            $data = [

                "title" => "Player",

                "fname" => $fname,

                "mname" => $mname,

                "lname" => $lname,

            ];

            $player->update(['publish' => true]);

            Mail::to($email)->send(new PublishMail($data));

            Alert::success('Success', 'Player approved successfully!');

            return redirect()->route('admin.playerList');

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            Alert::error('Error', 'Something went wrong!');

            return redirect()->route('admin.playerList');

        }

    }

    // player/playerUnpublish

    public function playerUnpublish(Request $req)
    {

        $id = $req->id;

        $checkedCheckbox = $req->checkedCheckbox;

        try {

            $player = Player::find($id);

            if (!$player) {

                Alert::error('Error', 'Player not found!');

                return redirect()->back();

            }

            // $email = $player->email;

            // $fname = $player->first_name;

            // $mname = $player->middle_name;

            // $lname = $player->last_name;

            // $data = [

            //     "title" => "Player",

            //     "fname" => $fname,

            //     "mname" => $mname,

            //     "lname" => $lname,

            // ];

            $player->update(['publish' => false, 'show_on_home' => "no"]);

            // Mail::to($email)->send(new PublishMail($data));

            Alert::success('Success', 'Player unpublished successfully!');

            return redirect()->route('admin.playerList');

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            Alert::error('Error', 'Something went wrong!');

            return redirect()->route('admin.playerList');

        }

    }

    // player/playerShowHomepage

    public function playerShowHomepage(Request $req)
    {

        $player_id = $req->id;

        $player = Player::where('player_id', '=', $player_id)->where('show_on_home', '=', 'no')->first();

        $player_publish = $player->publish;

        if (!$player) {

            Alert::error('Error', 'Player not found!');

            return redirect()->back();

        }

        if ($player_publish === 0) {

            Alert::error('Error', 'Please approve player!');

            return redirect()->back();

        }

        $show_player = Player::where('show_on_home', '=', 'yes')->get();

        if (count($show_player) === 10) {

            Alert::error('Error', 'You only 10 player!');

            return redirect()->back();

        }

        $player->update([

            "show_on_home" => "yes",

        ]);

        Alert::success('Success', 'Player show on the home page!');

        return redirect()->back();

    }

    // player/playerHideHomepage
    public function playerHideHomepage(Request $req)
    {

        $player_id = $req->id;

        $player = Player::where('player_id', '=', $player_id)->where('show_on_home', '=', 'yes')->first();

        if (!$player) {

            Alert::error('Error', 'Player not found!');

            return redirect()->back();

        }

        $player->update([

            "show_on_home" => "no",

        ]);

        Alert::success('Success', 'Player does not show on the home page!');

        return redirect()->back();

    }

    // player/updates.blade.php
    public function playerUpdates(Request $req)
    {

        $player_id = $req->id;

        $player = Player::where('player_id', '=', $player_id)->first();

        return view('admin.players.updates', ['player' => $player]);

    }

    // player/playerEmailUpdate functionality
    public function playerEmailUpdate(Request $req)
    {
        $rules = [

            "cEmail" => "required|email",

            "nEmail" => "required|email",

        ];

        $req->validate($rules);

        $player_id = $req->player_id;

        $cEmail = $req->cEmail;

        $nEmail = $req->nEmail;

        $player = Player::where('player_id', '=', $player_id)->where('email', '=', $cEmail)->first();

        if ($player) {

            $user_id = $player->id;
            $user = User::where('id', '=', $user_id)->where('email', '=', $cEmail)->first();

            $user->update([

                'email' => $nEmail,

                // 'email_verified_at' => null,

            ]);

            $player->update([

                'email' => $nEmail,

            ]);

            $data = Player::where('player_id', '=', $player_id)->first();

            $data_mail = $data->email;

            $mailData = [

                'title' => 'Email',

                'type' => 'Admin',

                'name' => $user->name,

            ];

            Mail::to($data_mail)->send(new UpdateEmailAita($mailData));

            Alert::success('Success', 'Email has updated!');

            return redirect()->route('admin.playerList');

        } else {

            Alert::info('Important', 'Player not available!');

            return redirect()->back();

        }

    }

    // player/playerAitaUpdate functionality
    public function playerAitaUpdate(Request $req)
    {
        $rules = [

            "Cita_number" => "required",

            "nita_number" => "required",

        ];

        $req->validate($rules);

        $player_id = $req->player_id;

        $Cita_number = $req->Cita_number;

        $nita_number = $req->nita_number;

        $player = Player::where('player_id', '=', $player_id)->where('ita_number', '=', $Cita_number)->first();

        if ($player) {

            $id = $player->id;

            $data_mail = $player->email;

            // dd($player);

            $user = User::where('id', '=', $id)->first();

            $isUpdated = $player->update([

                'ita_number' => $nita_number,

            ]);

            $player->refresh();

            // dd($player);

            if ($isUpdated) {

                $mailData = [

                    'title' => 'Aita',

                    'type' => 'Admin',

                    'name' => $user->name,

                ];

                Mail::to($data_mail)->send(new UpdateEmailAita($mailData));

                Alert::success('Success', 'Aita number has updated!');

                return redirect()->route('admin.playerList');

            } else {

                echo "error";

            }

        } else {

            Alert::info('Important', 'Player not available!');

            return redirect()->back();

        }

    }

    // player/playerDownloadCsv functionality
    public function playerDownloadCsv()
    {
        $players = DB::table('players')->select('player_id', 'first_name', 'middle_name', 'last_name', 'guardian_name', 'dob', 'gender', 'phone', 'email', 'ita_number', 'address_1', 'address_2', 'district', 'pin', 'state', 'country', 'photo')->get();

        $csvData = "\"Player ID\",\"First Name\", \"Middle Name\", \"Last Name\", \"Guardian Name\", \"DOB\",\"Gender\",\"Phone\",\"Email\",\"AITA Number\",\"Address Line One\",\"Address Line Two\",\"District\",\"Pin\", \"State\", \"Country\",\"Photo\"\n";

        foreach ($players as $player) {

            $csvData .= "\"{$player->player_id}\",\"{$player->first_name}\",\"{$player->middle_name}\",\"{$player->last_name}\",\"{$player->guardian_name}\",\"{$player->dob}\",\"{$player->gender}\",\"{$player->phone}\",\"{$player->email}\",\"{$player->ita_number}\",\"{$player->address_1}\",\"{$player->address_2}\",\"{$player->district}\",\"{$player->pin}\",\"{$player->state}\",\"{$player->country}\",\"{$player->photo}\"\n";

        }

        $headers = array(

            'Content-Type' => 'text/csv',

            'Content-Disposition' => 'attachment; filename="players.csv"',

        );

        return Response::make(rtrim($csvData, "\n"), 200, $headers);

    }

    // academies/academyList.blade.php
    public function academyList()
    {
        $academies = Academy::orderBy('academy_id', 'DESC')->get();

        return view('admin.academies.academieList', ['academies' => $academies]);

    }

    // academies/academyDetail.blade.php
    public function academyDetail(Request $req)
    {
        $id = $req->id;

        $details = Academy::where('academies.academy_id', '=', $id)->first();
        $academy_images = UploadAcademyImage::where('academy_id', '=', $id)->get();
        $host_tournaments = Tournament::where('academy_id', '=', $id)->get();
        $registered_players = PlayerRegisterTournament::whereIn('player_register_tournament.tournament_id',
            DB::table('tournaments')->select('tournaments.tournament_id')->where('tournaments.academy_id', '=', $id)
        )->get();

        return view('admin.academies.academyDetail', [
            'details' => $details,
            'academy_images' => $academy_images,
            'host_tournaments' => $host_tournaments,
            'registered_players' => $registered_players,
        ]);
    }

    // academyPublish
    public function academyPublish(Request $req)
    {
        $id = $req->id;

        $unCheckedCheckbox = $req->unCheckedCheckbox;

        try {

            $academy = Academy::find($id);

            if (!$academy) {

                Alert::error('Error', 'Academy not found!');

                return redirect()->back();

            }

            $email = $academy->email;

            $name = $academy->name;

            $data = [

                "title" => "Academy",

                "name" => $name,

            ];

            $academy->update(['publish' => $unCheckedCheckbox == false ? true : false]);

            Mail::to($email)->send(new PublishMail($data));

            Alert::success('Success', 'Academy approved successfully!');

            return redirect()->route('admin.academyList');

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            Alert::error('Error', 'Something went wrong!');

            return redirect()->route('admin.academyList');

        }

    }

    // academy/academyUnpublish functionality
    public function academyUnpublish(Request $req)
    {
        $id = $req->id;

        $checkedCheckbox = $req->checkedCheckbox;

        try {

            $academy = Academy::find($id);

            if (!$academy) {

                Alert::error('Error', 'Academy not found!');

                return redirect()->back();

            }

            // $email = $academy->email;

            // $name = $academy->name;

            // $data = [

            //     "title" => "Academy",

            //     "name" => $name,

            // ];

            $academy->update(['publish' => false, 'show_on_home' => 'no']);

            // Mail::to($email)->send(new PublishMail($data));

            Alert::success('Success', 'Academy unpublished successfully!');

            return redirect()->route('admin.academyList');

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            Alert::error('Error', 'Something went wrong!');

            return redirect()->route('admin.academyList');

        }

    }

    // academyShowHomepage
    public function academyShowHomepage(Request $req)
    {
        $academy_id = $req->id;

        $academy = Academy::where('academy_id', '=', $academy_id)->where('show_on_home', '=', 'no')->first();

        $academy_publish = $academy->publish;

        if (!$academy) {

            Alert::error('Error', 'Academy not found!');

            return redirect()->back();

        }

        if ($academy_publish === 0) {

            Alert::error('Error', 'Please approve academy!');

            return redirect()->back();

        }

        $show_academy = Academy::where('show_on_home', '=', 'yes')->get();

        if (count($show_academy) === 10) {

            Alert::error('Error', 'You only 10 academy!');

            return redirect()->back();

        }

        $academy->update([

            "show_on_home" => "yes",

        ]);

        Alert::success('Success', 'Academy show on the home page!');

        return redirect()->back();

    }

    // academyHideHomepage
    public function academyHideHomepage(Request $req)
    {
        $academy_id = $req->id;

        $academy = Academy::where('academy_id', '=', $academy_id)->where('show_on_home', '=', 'yes')->first();

        if (!$academy) {

            Alert::error('Error', 'Academy not found!');

            return redirect()->back();

        }

        $academy->update([

            "show_on_home" => "no",

        ]);

        Alert::success('Success', 'Academy does not show on the home page!');

        return redirect()->back();

    }

    // academies/updates.blade.php
    public function academyUpdates(Request $req)
    {
        $academy_id = $req->id;

        $academy = Academy::where('academy_id', '=', $academy_id)->first();

        return view('admin.academies.updates', ['academy' => $academy]);

    }

    // academies/academyEmailUpdate functionality
    public function academyEmailUpdate(Request $req)
    {
        $rules = [

            "cEmail" => "required|email",

            "nEmail" => "required|email",

        ];

        $req->validate($rules);

        $academy_id = $req->academy_id;

        $cEmail = $req->cEmail;

        $nEmail = $req->nEmail;

        $academy = Academy::where('academy_id', '=', $academy_id)->where('email', '=', $cEmail)->first();

        if ($academy) {

            $user_id = $academy->id;

            $user = User::where('id', '=', $user_id)->where('email', '=', $cEmail)->first();

            $user->update([

                'email' => $nEmail,

                // 'email_verified_at' => null,

            ]);

            $academy->update([

                'email' => $nEmail,

            ]);

            $data = Academy::where('academy_id', '=', $academy_id)->first();

            $data_mail = $data->email;

            $mailData = [

                'title' => 'Email',

                'type' => 'Admin',

                'name' => $user->name,

            ];

            Mail::to($data_mail)->send(new UpdateEmailAita($mailData));

            Alert::success('Success', 'Email has updated!');

            return redirect()->route('admin.academyList');

        } else {

            Alert::info('Important', 'Academy not available!');

            return redirect()->back();

        }

    }

    // academies/academyAitaUpdate functionality
    public function academyAitaUpdate(Request $req)
    {
        $rules = [

            "Caita_number" => "required",

            "naita_number" => "required",

        ];

        $req->validate($rules);

        $academy_id = $req->academy_id;

        $Caita_number = $req->Caita_number;

        $naita_number = $req->naita_number;

        $player = Academy::where('academy_id', '=', $academy_id)->where('aita_number', '=', $Caita_number)->first();

        if ($player) {

            $id = $player->id;

            $data_mail = $player->email;

            // dd($player);

            $user = User::where('id', '=', $id)->first();

            $isUpdated = $player->update([

                'aita_number' => $naita_number,

            ]);

            $player->refresh();

            // dd($player);

            if ($isUpdated) {

                $mailData = [

                    'title' => 'Aita',

                    'type' => 'Admin',

                    'name' => $user->name,

                ];

                Mail::to($data_mail)->send(new UpdateEmailAita($mailData));

                Alert::success('Success', 'Aita number has updated!');

                return redirect()->route('admin.academyList');

            } else {

                echo "error";

            }

        } else {

            Alert::info('Important', 'Player not available!');

            return redirect()->back();

        }

    }

    // academy/academyDownloadCsv functionality
    public function academyDownloadCsv()
    {
        $academies = DB::table('academies')->select('academy_id', 'name', 'owner_name', 'aita_number', 'country_code', 'phone', 'email', 'stay', 'no_of_court', 'hard', 'clay', 'grass', 'address', 'city', 'pin', 'state', 'web', 'geo_location', 'photo')->get();

        $csvData = "\"Academy ID\",\"Name\", \"Owner Name\", \"AITA Number\", \"Country Code\", \"Phone\",\"Email\",\"Stay\",\"Number Of Courts\",\"Hard\",\"Clay\",\"Grass\",\"Address\",\"City\",\"Pin\", \"State\", \"Web URL\", \"Geo Location\",\"Photo\"\n";

        foreach ($academies as $academy) {

            $csvData .= "\"{$academy->academy_id}\",\"{$academy->name}\",\"{$academy->owner_name}\",\"{$academy->aita_number}\",\"{$academy->country_code}\",\"{$academy->phone}\",\"{$academy->email}\",\"{$academy->stay}\",\"{$academy->no_of_court}\",\"{$academy->hard}\",\"{$academy->clay}\",\"{$academy->grass}\",\"{$academy->address}\",\"{$academy->city}\",\"{$academy->pin}\",\"{$academy->state}\",\"{$academy->web}\",\"{$academy->geo_location}\",\"{$academy->photo}\"\n";

        }

        $headers = array(

            'Content-Type' => 'text/csv',

            'Content-Disposition' => 'attachment; filename="academies.csv"',

        );

        return Response::make(rtrim($csvData, "\n"), 200, $headers);

    }

    // rankList.blade.php
    public function rankList(Request $req)
    {
        $rank_data = Rank::SELECT('ranking.*')->orderBy('rank_id', 'DESC')->get();

        return view('admin.Rank.rankList', ['ranks' => $rank_data]);

    }

    // rank import
    public function importRankings(Request $req)
    {
        Excel::import(new ImportRanking, $req->file('file')->store('files'));
        return redirect()->back();
    }

    //changes by sandhya
    // update ranking
    public function updateRanking(Request $req)
    {
        $rank_id = $req->r_id;
        $data = Rank::select('ranking.*', 'players.player_id', 'players.first_name', 'players.middle_name', 'players.last_name')
            ->join('players', 'ranking.aita_number', '=', 'players.ita_number')
            ->where('ranking.rank_id', '=', $rank_id)
            ->first();

        // dd($data);
        if (!$data) {
            Alert::info('erro', ' not found in player list');
            return redirect()->back();
        }
        return view('admin.Rank.updateRanking', ['data' => $data]);
    }
    //delete ranking
    public function deleteRanking(Request $req)
    {
        $rank_id = $req->r_id;
        $data = Rank::where('rank_id', $rank_id)->first();
        if ($data) {
            $data->delete();
            Alert::info('success', 'Rank deleted successfully');
            return redirect()->back();

        }
        Alert::info('message', 'No rank found');
        return redirect()->back();
    }

    //end changes
    // store ranking data
    public function storeRankingData(Request $req)
    {
        $rank_id = $req->rank_id;

        $rank = $req->rank;

        $score = $req->score;

        $rank_update = Rank::where('rank_id', '=', $rank_id)->first();

        if ($rank_update) {

            $rank_update->update([

                'rank' => $rank,

                'score' => $score,

            ]);

            Alert::success('Success', 'Rank has updated successfully!');

            return redirect()->route('admin.rankList');

        } else {

            Alert::info('Important', 'Data not available there!');

            return redirect()->back();

        }

    }

    // rank added date
    public function rankAddedDate(Request $req)
    {
        $rules = [
            "date" => 'required',
        ];

        $req->validate($rules);

        $now = Carbon::now()->format('Y-m-d');

        $date = new RankDate;

        $date->date = $req->date;

        $date->added_at = $now;

        $date->save();

        Alert::success('Success', 'Date has updated!');

        return redirect()->back();

    }

    // rank page delete all data
    public function deleteRankAllData(Request $req)
    {
        $delete_data = $req->delete_data;
        if ($delete_data === 'delete') {
            $deleted_data = Rank::get();
            if ($deleted_data) {
                Rank::truncate();
                Alert::success('Success', 'Data deleted successfully!', 3500);
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    // admin/tournaments/tournamentList.blade.php
    public function tournamentsList()
    {
        $tournaments = Tournament::orderBy('tournament_id', 'DESC')->get();
        return view('admin.tournaments.tournamentList', ['tournaments' => $tournaments]);
    }

    // admin/tournaments/tournamentDetail.blade.php
    public function tournamentDetail(Request $req)
    {
        $id = $req->id;
        $tournament = Tournament::select('tournaments.tournamentName', 'tournaments.tournamentCategory', 'tournaments.category', 'tournaments.subCategory', 'tournaments.surface', 'tournaments.city', 'tournaments.fromDate', 'tournaments.toDate', 'tournaments.lastDate', 'tournaments.stay', 'tournaments.price', 'tournaments.whatsapp', 'tournaments.imageOne', 'tournaments.imageTwo', 'tournaments.imageThree', 'tournaments.captionOne', 'tournaments.captionTwo', 'tournaments.captionThree', 'tournaments.factsheet', 'tournaments.status', 'academies.name')
            ->where('tournaments.tournament_id', '=', $id)
            ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')
            ->first();

        $get_tournament_images = TournamentImage::where('tournament_id', '=', $id)->get();
        return view('admin.tournaments.tournamentDetail', [
            'tournament' => $tournament,
            'get_tournament_images' => $get_tournament_images,
        ]);
    }

    // admin/tournamentDownloadCsv functionality
    public function tournamentDownloadCsv()
    {
        $tournaments = DB::table('tournaments')->select('tournament_id', 'tournamentCategory', 'tournamentName', 'academy_id', 'category', 'subCategory', 'surface', 'city', 'fromDate', 'toDate', 'lastDate', 'stay', 'price', 'whatsapp', 'imageOne', 'imageTwo', 'imageThree', 'factsheet', 'status')
            ->get();

        $csvData = "\"Tournament ID\",\"Tournament Category\", \"Tournament Name\", \"Academy ID\", \"Category\", \"Sub Category\",\"Surface\",\"City\",\"Start Date\",\"End Date\",\"Last Date To Apply\",\"Stay\",\"Price\",\"WhatsApp\",\"Image One\", \"Image Two\", \"Image Three\", \"Fact Sheet\",\"Status\"\n";

        foreach ($tournaments as $tournament) {
            $csvData .= "\"{$tournament->tournament_id}\",\"{$tournament->tournamentCategory}\",\"{$tournament->tournamentName}\",\"{$tournament->academy_id}\",\"{$tournament->category}\",\"{$tournament->subCategory}\",\"{$tournament->surface}\",\"{$tournament->city}\",\"{$tournament->fromDate}\",\"{$tournament->toDate}\",\"{$tournament->lastDate}\",\"{$tournament->stay}\",\"{$tournament->price}\",\"{$tournament->whatsapp}\",\"{$tournament->imageOne}\",\"{$tournament->imageTwo}\",\"{$tournament->imageThree}\",\"{$tournament->factsheet}\",\"{$tournament->status}\"\n";
        }

        $headers = array(

            'Content-Type' => 'text/csv',

            'Content-Disposition' => 'attachment; filename="tournaments.csv"',

        );

        return Response::make(rtrim($csvData, "\n"), 200, $headers);

    }

    // admin/tournamentDelete functionality
    public function tournamentDelete(Request $req)
    {
        $tournament_id = $req->id;

        $tournament = Tournament::where('tournament_id', '=', $tournament_id)->first();

        if ($tournament) {

            $tournament->delete();

            Alert::success('Success', 'Tournament has successfully deleted!', 3500);

            return redirect()->back();

        } else {

            Alert::error('Error', 'Something wants error!', 3500);

            return redirect()->back();

        }

    }

    //code by sandhya
    //add banner page
    public function AddBanner()
    {
        $silders = Slide::select('title', 'img_path', 'id')->get();

        return view('admin.Banner.addbanner', ['slides' => $silders]);

    }

    public function storeSlider(Request $req)
    {
        if ($req->has('id')) {

            $slid = Slide::where('id', $req->id)->first();

            if ($req->bannertitle != '') {

                $slid->title = $req->bannertitle;

                $slid->save();

            }

            if ($req->image != '') {

                $oldimg = public_path('assets/' . $slid->img_path);
                // Log::info($oldimg);

                //if (file_exists($oldimg)) {

                //unlink($oldimg);

                $extension = $req->file('image')->getClientOriginalExtension();

                $fileName = 'banner_' . time() . '.' . $extension;

                $imagePath = 'images/main-slider/' . $fileName;
                $req->file('image')->move('assets/images/main-slider/', $fileName);

                //$imgpath = $req->file('image')->storeAs('images/main-slider', $filename, 'public');

                $slid->img_path = $imagePath;

                $slid->save();

                // }

            }

            $slid->save();

            Alert::info('success', 'Updated successfully');

            return redirect()->route('admin.Banner');

        } else {

            try {

                $req->validate([

                    'bannertitle' => 'required|string',

                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

                ]);

                $extension = $req->file('image')->getClientOriginalExtension();

                $fileName = 'banner_' . time() . '.' . $extension;

                $imagePath = 'images/main-slider/' . $fileName;
                $req->file('image')->move('assets/images/main-slider/', $fileName);

                //$imagePath = $req->file('image')->storeAs('/images/main-slider', $fileName);

                Slide::create([

                    'title' => $req->bannertitle,

                    'img_path' => $imagePath,

                ]);

                Alert::info('Success', 'Slider added successfully!', 3500);

                return redirect()->back();

            } catch (\Exception $e) {

                Log::info($e);

                Alert::info('Error', 'Error while adding slider');

                return redirect()->back();

            }

        }

    }

    //end
    //edit slider

    public function editslider(Request $req)
    {Log::info('inside edit');
        $id = $req->id;

        Log::info($id);

        $slide = Slide::where('id', $id)->select('id', 'title', 'img_path')->first();

        return view('admin.Banner.editBanner', ["slide" => $slide]);}

    //delete slider

    public function deleteSlider(Request $req)
    {
        Log::info('inside delt');
        $count = Slide::count();

        if ($count <= 1) {

            Alert::info('error', 'You cannot delete the slider');

            return redirect()->back();

        }

        if ($req->id) {

            $slider = Slide::where('id', $req->id)->first();

            $imgpath = $slider->img_path;

            $oldimg = public_path('assets/' . $imgpath);
            Log::info($oldimg);
            //unlink($oldimg);

            $slider->delete();

            Alert::info('success', 'Slider deleted successfully');

            return redirect()->back();

        }

        Alert::info('error', 'Oops there is some error');

        return redirect()->back();

    }

    //sandhya
    public function UniqueVisitors()
    {
        $visitors = UniqueVisitors::all();
        return view('admin.visitor', ['visitors' => $visitors]);
    }

    // admin logout

    public function adminLogOut(Request $req)
    {

        $req->session()->forget('ADMIN', true);

        $req->session()->forget('panel');

        $req->session()->flash('error', 'Logout Successfully!');

        return redirect('/admin');

    }

}
