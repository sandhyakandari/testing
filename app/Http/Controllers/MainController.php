<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Academy;
use App\Models\Draw;
use App\Models\InterimDraw;
use App\Models\InterimDrawPlayerTournament;
use App\Models\ManualRegister;
use App\Models\Player;
use App\Models\PlayerRegisterTournament;
use App\Models\Rank;
use App\Models\RankDate;
use App\Models\Slide;
use App\Models\State;
use App\Models\Tournament;
use App\Models\TournamentImage;
use App\Models\UploadAcademyImage;
use App\Models\UploadPlayerImage;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class MainController extends Controller
{
    // home
    public function home(Request $request)
    {
        $fetchUpcomingTournaments = $this->fetchUpcomingTournament();

        $fetchacademic_datas = $this->academiesData($request);
        $recent_tournament_data = $this->recentTournamentData($request);

        $ranking_date = RankDate::latest()->first();

        $slides = Slide::select('title', 'img_path')->get();

        $girlsUnder12 = $this->rankofcat("Girl's", 'Under 12');
        $boysUnder12 = $this->rankofcat("Boy's", 'Under 12');
        $girlsUnder14 = $this->rankofcat("Girl's", 'Under 14');
        $boysUnder14 = $this->rankofcat("Boy's", 'Under 14');
        $girlsUnder16 = $this->rankofcat("Girl's", 'Under 16');
        $boysUnder16 = $this->rankofcat("Boy's", 'Under 16');
        $girlsUnder18 = $this->rankofcat("Girl's", 'Under 18');
        $boysUnder18 = $this->rankofcat("Boy's", 'Under 18');

        $mens = $this->rankofcat('Seniors', 'Men');
        $womens = $this->rankofcat('Seniors', 'Women');

        return view('home', [
            'fetchUpcomingTournaments' => $fetchUpcomingTournaments,
            'fetchacademic_datas' => $fetchacademic_datas,
            'recent_tournament_data' => $recent_tournament_data,
            'ranking_date' => $ranking_date,
            'mens' => $mens,
            'womens' => $womens,
            'girlsUnder12' => $girlsUnder12,
            'boysUnder12' => $boysUnder12,
            'girlsUnder14' => $girlsUnder14,
            'boysUnder14' => $boysUnder14,
            'girlsUnder16' => $girlsUnder16,
            'boysUnder16' => $boysUnder16,
            'girlsUnder18' => $girlsUnder18,
            'boysUnder18' => $boysUnder18,
            'slides' => $slides,
        ]);
    }

    private function rankofcat($category, $sub_category)
    {
        $ranks = Rank::select('ranking.*', 'states.name as statename', 'players.player_id'
            , 'players.photo', 'players.ita_number', 'players.dob', 'players.gender')
            ->where('ranking.category', '=', $category)
            ->where('ranking.sub_category', '=', $sub_category)
            ->where('players.show_on_home', 'yes')
            ->join('states', 'ranking.state_id', '=', 'states.state_id')
            ->join('players', 'ranking.aita_number', '=', 'players.ita_number')
            ->orderBy('ranking.rank', 'ASC')
            ->limit(10)
            ->get();
        Log::info($category);
        Log::info($sub_category);
        Log::info($ranks);
        return $ranks;
    }
    private function createQuery($sub_category, $age, $gender, $junior)
    {
        if ($junior) {
            $data = DB::table('ranking')
                ->join('players', 'ranking.aita_number', '=', 'players.ita_number')
                ->where('players.gender', $gender)
                ->where('ranking.sub_category', $sub_category)
                ->where('players.show_on_home', 'yes')
                ->whereRaw("TIMESTAMPDIFF(YEAR, players.dob, CURDATE()) < ?", [$age])
                ->select('ranking.*', 'players.*')
                ->orderBy('ranking.rank', 'asc') // Adjust the selected columns as needed
                ->get();
        } else {
            $data = DB::table('ranking')
                ->join('players', 'ranking.aita_number', '=', 'players.ita_number')
                ->where('players.gender', $gender)
            // ->where('ranking.sub_category',$sub_category)
                ->where('players.show_on_home', 'yes')
                ->whereRaw("TIMESTAMPDIFF(YEAR, players.dob, CURDATE()) > ?", [$age])
                ->select('ranking.*', 'players.*')
                ->orderBy('ranking.rank', 'asc') // Adjust the selected columns as needed
                ->get();
        }
        return $data;
    }

    // about us
    public function aboutUs()
    {

        return view('about_us');

    }

    // terms & conditions
    public function termsCondition()
    {

        return view('terms_condition');

    }

    // important policy
    public function importantPolicy()
    {

        return view('important-policy');

    }

    // tournament page
    public function tournamentCalendar()
    {

        $tournaments = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentCategory', 'tournaments.tournamentName', 'tournaments.city', 'tournaments.category', 'tournaments.subCategory', 'tournaments.surface', 'tournaments.fromDate', 'tournaments.toDate', 'tournaments.lastDate', 'tournaments.city', 'tournaments.status', 'tournaments.stay', 'tournaments.factsheet', 'academies.name', 'academies.academy_id')
            ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')
            ->where('tournaments.status', '=', 'pending')
            ->whereDate('tournaments.fromDate', '>', now()->toDateString())
            ->orderBy('tournaments.tournament_id', 'ASC')
            ->paginate(30);

        $upcoming_tournament_city = Tournament::select('city')
            ->where('status', '=', 'pending')
            ->DISTINCT()
            ->orderBy('city', 'ASC')
            ->get();

        $upcoming_tournament_years = Tournament::select(DB::raw('YEAR(fromDate) as year'))
            ->where('status', '=', 'pending')
            ->distinct()
            ->orderBy('year', 'ASC')
            ->get();
        // dd($upcoming_tournament_years);

        $past_tournament = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentCategory', 'tournaments.tournamentName', 'tournaments.city', 'tournaments.category', 'tournaments.subCategory', 'tournaments.surface', 'tournaments.fromDate', 'tournaments.toDate', 'tournaments.lastDate', 'tournaments.city', 'tournaments.status', 'tournaments.stay', 'tournaments.factsheet', 'academies.name', 'academies.academy_id')
            ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')
            ->where('tournaments.status', '=', 'done')
            ->whereDate('tournaments.toDate', '<', now()->toDateString())
            ->orderBy('tournaments.tournament_id', 'ASC')
            ->paginate(30);

        $past_tournament_cities = Tournament::select('city')
            ->where('status', '=', 'done')
            ->distinct()
            ->orderBy('city', 'ASC')
            ->get();

        $past_tournament_years = Tournament::select(DB::raw('YEAR(fromDate) as year'))
            ->where('status', '=', 'done')
            ->distinct()
            ->orderBy('year', 'ASC')
            ->get();
        // dd($past_tournament_years);s

        $current_tournaments = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentCategory', 'tournaments.tournamentName', 'tournaments.city', 'tournaments.category', 'tournaments.subCategory', 'tournaments.surface', 'tournaments.fromDate', 'tournaments.toDate', 'tournaments.lastDate', 'tournaments.city', 'tournaments.status', 'tournaments.stay', 'tournaments.factsheet', 'academies.name', 'academies.academy_id')
            ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')
            ->where('tournaments.status', '=', 'running')
            ->where(function ($query) {
                $query->where('tournaments.fromDate', '<=', Carbon::today()->toDateString())
                    ->where('tournaments.toDate', '>=', Carbon::today()->toDateString());
            })
            ->orderBy('tournaments.tournament_id', 'ASC')
            ->paginate(30);

        $current_tournament_years = Tournament::select(DB::raw('YEAR(fromDate) as year'))
            ->where('status', '=', 'running')
            ->distinct()
            ->orderBy('year', 'ASC')
            ->get();

        $current_tournament_cities = Tournament::select('city')
            ->where('status', '=', 'running')
            ->distinct()
            ->orderBy('city', 'ASC')
            ->get();

        return view('tournaments',
            [
                'tournaments' => $tournaments,
                'upcoming_tournament_city' => $upcoming_tournament_city,
                'upcoming_tournament_years' => $upcoming_tournament_years,
                'past_tournaments' => $past_tournament,
                'past_tournament_years' => $past_tournament_years,
                'past_tournament_cities' => $past_tournament_cities,
                'current_tournaments' => $current_tournaments,
                'current_tournament_years' => $current_tournament_years,
                'current_tournament_cities' => $current_tournament_cities,
            ]
        );
    }

    // academies page

    public function academies()
    {
        $academies = Academy::where('publish', '=', 1)->orderBy('academy_id', 'DESC')->paginate(30);
        return view('academies', ['academies' => $academies]);
    }

    // players page
    public function players(Request $request)
    {

        $date = RankDate::latest()->first();
        $players = Player::select('players.player_id', 'players.first_name', 'players.middle_name', 'players.last_name', 'players.photo', 'players.ita_number', 'players.dob', 'players.gender', 'ranking.rank')
            ->leftJoin('ranking', 'players.ita_number', '=', 'ranking.aita_number')
            ->where('players.publish', '=', 1)
            ->orderByRaw('CASE WHEN ranking.rank IS NOT NULL THEN 0 ELSE 1 END, ranking.rank ASC')
        // ->whereNotNull('ranking.rank')
        //->orderBy('ranking.rank', 'asc')
            ->paginate(30);
        // dd($players);

        return view('players',

            [
                'date' => $date,
                'players' => $players,
                // 'player_ranking' => $player_ranking,
                // 'result' => $result,
            ]

            // $player_ranking = Player::select('players.ita_number', 'ranking.rank')
            //     ->join('ranking', 'players.ita_number', '=', 'ranking.aita_number')
            //     ->where('players.publish', '=', 1)
            //     ->orderBy('ranking.rank', 'ASC')
            //     ->paginate(10);

            // $result = [];
            // foreach ($player_ranking as $player) {
            //     $aita_number = $player->ita_number;
            //     $ranks = Rank::where('aita_number', '=', $aita_number)->orderBy('rank', 'ASC')->get();
            //     foreach ($ranks as $rank) {
            //         $result[] = $rank->aita_number;
            //     }
            // }
            // dd($result, $players);
        );
    }

    // rank page
    public function rank($category, $sub_category)
    {
        $original_sub_category = $this->convertToOriginalSubString($sub_category);
        $original_category = $this->convertToOriginalString($category);
        Log::info($sub_category);
        Log::info($original_sub_category);
        Log::info($category);
        // dd($original_category, $original_sub_category);
        $ranks = Rank::select('ranking.*')
            ->where('ranking.category', '=', $original_category)
            ->where('ranking.sub_category', '=', $original_sub_category)
        // ->join('states', 'ranking.state_id', '=', 'states.state_id')
            ->orderBy('ranking.rank', 'ASC')
            ->get();
        // dd($ranks);

        return view('rank', ['ranks' => $ranks]);

    }

    public function convertToOriginalString($str)
    {

        if ($str === 'boys') {
            return str_replace('boys', 'Boy\'s', $str);
        }

        if ($str === 'boy') {
            return str_replace('boy', 'Boy\'s', $str);
        }
        if ($str === 'girls') {
            // dd(str_replace('girls', 'Girl\'s', $str));

            return str_replace('girls', 'Girl\'s', $str);

        }

        if ($str === 'girl') {
            // dd(str_replace('girls', 'Girl\'s', $str));

            return str_replace('girl', 'Girl\'s', $str);

        }

        if ($str === 'seniors') {

            return str_replace('seniors', 'Senior\'s', $str);

        }
        if ($str === 'senior') {
            return str_replace('senior', 'Seniors', $str);
        }

    }

    public function convertToOriginalSubString($str)
    {

        if ($str === 'under-12') {

            $str = str_replace('-', ' ', $str);

            $str = ucwords($str);

            return $str;

        }

        if ($str === 'under-14') {

            $str = str_replace('-', ' ', $str);

            $str = ucwords($str);

            return $str;

        }

        if ($str === 'under-16') {

            $str = str_replace('-', ' ', $str);

            $str = ucwords($str);

            return $str;

        }

        if ($str === 'under-18') {

            $str = str_replace('-', ' ', $str);

            $str = ucwords($str);

            return $str;

        }

        if ($str === 'men') {

            return str_replace('mens', 'Men', $str);

        }

        if ($str === 'women') {

            return str_replace('womens', 'Women', $str);

        }

        if ($str === 'men') {

            return str_replace('men', 'Men', $str);

        }

        if ($str === 'women') {

            return str_replace('women', 'Women', $str);

        }
    }

    // academyDetail.blade.php
    public function academyDetail(Request $request)
    {
        $academy_id = $request->id;
        $academy = Academy::where('academy_id', '=', $academy_id)
            ->where('publish', '=', 1)
            ->first();

        $academy_img = UploadAcademyImage::where('academy_id', '=', $academy_id)->get();
        $upcoming_tournament = Tournament::where('tournaments.fromDate', '>', Carbon::now())->take(10)->get();
        $recent_tournaments = Tournament::where('toDate', '<', now()->toDateString())
            ->where('academy_id', '=', $academy_id)
            ->get();
        return view('academyDetail',
            [
                'academy' => $academy,
                'academy_imgs' => $academy_img,
                'upcoming_tournaments' => $upcoming_tournament,
                'recent_tournaments' => $recent_tournaments,
            ]

        );

    }

    // playerDetail.blade.php
    public function playerDetail(Request $request)
    {
        $player_id = $request->id;

        $players = Player::select('players.first_name', 'players.middle_name', 'players.last_name', 'players.guardian_name', 'players.dob', 'players.gender', 'players.phone', 'players.email', 'players.ita_number', 'players.address_1', 'players.address_2', 'players.district', 'players.pin', 'players.state', 'players.country', 'players.photo', 'ranking.rank')
            ->leftJoin('ranking', 'players.ita_number', '=', 'ranking.aita_number')
            ->where('players.player_id', '=', $player_id)
            ->where('players.publish', '=', 1)
            ->first();

        $rankings = Rank::where('aita_number', $players->ita_number)->get();
        $player_imgs = UploadPlayerImage::where('player_id', '=', $player_id)->get();

        $tournaments = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.fromDate', 'tournaments.imageOne', 'tournaments.imageTwo', 'tournaments.imageThree', 'tournaments.city', 'tournaments.winner_id')
            ->join('player_register_tournament', function ($join) use ($player_id) {
                $join->on('tournaments.tournament_id', '=', 'player_register_tournament.tournament_id');
                $join->where('player_register_tournament.player_id', '=', $player_id);
                $join->where('player_register_tournament.status', '=', 'approved');
            })
            ->where('tournaments.status', '=', 'done')
            ->get();

        $win_count = Tournament::where('winner_id', $player_id)->count();
        $recent_tournament = Tournament::where('fromDate', '>', Carbon::now())->take(10)->get();

        return view('playerDetail',
            [
                'player' => $players,
                'tournaments' => $tournaments,
                'recent_tournaments' => $recent_tournament,
                'player_imgs' => $player_imgs,
                'win_count' => $win_count,
                'ranking' => $rankings,
            ]
        );
    }

    // tournamentDetail.blade.php

    public function tournamentDetail(Request $request)
    {
        $tournament_id = $request->id;

        $tournament = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.fromDate', 'tournaments.toDate', 'tournaments.lastDate', 'tournaments.city', 'tournaments.stay', 'tournaments.price', 'tournaments.surface', 'tournaments.whatsapp', 'tournaments.imageOne', 'tournaments.imageTwo', 'tournaments.imageThree', 'tournaments.captionOne', 'tournaments.captionTwo', 'tournaments.captionThree', 'tournaments.category', 'tournaments.subCategory', 'tournaments.factsheet', 'academies.name', 'academies.address', 'academies.city as academy_city', 'academies.pin', 'academies.state')
            ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')
            ->where('tournaments.tournament_id', '=', $tournament_id)
            ->first();

        $tournament_images = TournamentImage::where('tournament_id', '=', $tournament_id)->get();
        $upcoming_tournaments = Tournament::where('tournaments.fromDate', '>', Carbon::now())->take(10)->get();
        $get_entries = Player::select('players.player_id', 'players.first_name', 'players.middle_name', 'players.last_name', 'players.photo')
            ->join('player_register_tournament', function ($join) use ($tournament_id) {
                $join->on('player_register_tournament.player_id', '=', 'players.player_id')
                    ->where('player_register_tournament.status', '=', 'approved')
                    ->where('player_register_tournament.tournament_id', '=', $tournament_id);
            })
            ->get();
        // dd($get_entries);
        return view('tournamentDetail',
            [
                'tournament' => $tournament,
                'tournament_images' => $tournament_images,
                'upcoming_tournaments' => $upcoming_tournaments,
                'get_entries' => $get_entries,
            ]
        );
    }

    // contact us page

    public function contactUs(Request $request)
    {

        # code...

        return view('pages.contactus');

    }
    //submit contact us form
    public function contacuUsdata(Request $request)
    {
        $mailData = [
            'title' => 'contact us form',
            'username' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message,

        ];
        try {
            Mail::to(env('MAIL_USERNAME'))->send(new SendMail($mailData));
            Alert::Info('success', 'Form sumbitted successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('error', 'Something went wrong');
            return redirect()->back();
        }
    }

    // player dashboard

    public function playerDashboard(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') == 'Player') {

                $id = session('id');

                $role = session('role');

                $player_data = Player::select('players.player_id', 'players.dob', 'players.district', 'players.ita_number')

                    ->where('players.id', '=', $id)

                    ->where('players.publish', '=', 1)

                    ->first();

                if ($player_data) {

                    $get_player = Player::where('id', '=', $id)->first();

                    $player_id = $get_player->player_id;

                    $aita = $get_player->ita_number;

                    $rank = Rank::where('aita_number', '=', $aita)->first();

                    $check_images = UploadPlayerImage::where('user_id', '=', $id)->where('player_id', '=', $player_id)->get();

                    $played_tournaments = PlayerRegisterTournament::where('player_id', '=', $player_id)

                        ->where('status', '=', 'approved')->get();

                    if ($rank) {

                        return view('player.dashboard', [

                            'player_data' => $player_data,

                            'rank' => $rank,

                            'images' => $check_images,

                            'played_tournaments' => $played_tournaments,

                        ]);

                    } else {

                        return view('player.dashboard', [

                            'player_data' => $player_data,

                            'rank' => null,

                            'images' => $check_images,

                            'played_tournaments' => $played_tournaments,

                        ]);

                    }

                } else {

                    $request->session()->flush();

                    Auth::logout();

                    Alert::info('Information', 'Admin Not approved now. Please wait until admin  approved!', 3500);

                    return redirect()->route('home');

                }

            } else {

                $request->session()->flush();

                Auth::logout();

                Alert::info('Information', 'Page access only player!', 3500);

                return redirect()->back();

            }

        } else {

            Alert::info('Information', 'Something want wrong!', 3500);

            return redirect()->back();

        }

    }

    // player-profile page

    public function myProfile(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') == 'Player') {

                $id = session('id');

                $details = Player::select('players.*', 'users.name')

                    ->join('users', 'players.id', '=', 'users.id')

                    ->where('players.id', '=', $id)

                    ->where('players.publish', '=', 1)->first();

                if ($details) {

                    $states = State::get();

                    return view('player.myProfile', ['details' => $details, 'states' => $states]);

                } else {

                    $request->session()->flush();

                    Auth::logout();

                    Alert::info('Information', 'Admin Not approved now. Please wait until admin  approved!', 3500);

                    return redirect()->route('home');

                }

            }

        }

    }

    // player/uploadImages.blade.php

    public function playerUploadImages(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') === "Player") {

                $id = session('id');

                $check_player = Player::where('id', '=', $id)->where('publish', '=', 1)->first();

                if ($check_player) {

                    $player_id = $check_player->player_id;

                    $player_name = $check_player->name;

                    $player_photo = $check_player->photo;

                    $check_images = UploadPlayerImage::where('user_id', '=', $id)->where('player_id', '=', $player_id)->get();

                    return view('player.uploadImages', [

                        'images' => $check_images,

                        'name' => $player_name,

                        'player_img' => $player_photo,

                    ]);

                } else {

                    $request->session()->flush();

                    Auth::logout();

                    Alert::info('Information', 'Admin Not approved now. Please wait until admin  approved!', 3500);

                    return redirect()->route('home');

                }

            } else {

                Alert::info('Important', 'Something wants wrong.', 3500);

                return redirect()->back();

            }

        } else {

            Alert::info('Important', 'Something wants wrong.', 3500);

            return redirect()->back();

        }

    }

    // player/change-password

    public function changePassword(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') === "Player") {

                $id = session('id');

                $check_player = Player::where('id', '=', $id)->where('publish', '=', 1)->first();

                if ($check_player) {

                    return view('player.changePassword');

                } else {

                    $request->session()->flush();

                    Auth::logout();

                    Alert::info('Information', 'Admin Not approved now. Please wait until admin  approved!', 3500);

                    return redirect()->route('home');

                }

            }

        }

    }

    // player/upcoming-tournaments
    // public function upcomingTournaments(Request $request)
    // {
    //     if (Session()->has('id') && Session()->has('role')) {

    //         if (Session()->get('role') == 'Player') {

    //             $id = session('id');

    //             $get_player = Player::where('id', '=', $id)->where('publish', '=', 1)->first();

    //             if ($get_player) {

    //                 $player_id = $get_player->player_id;
    //                 $player_dob = $get_player->dob;

    //                 $player_gender = $get_player->gender;
    //                 // dd($player_gender);
    //                 $birthDate = new DateTime($player_dob);

    //                 $currentDate = new DateTime('today');

    //                 $age = $birthDate->diff($currentDate)->y;

    //                 // dd(now()->toDateString());

    //                 $tournament_query = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.category', 'tournaments.subCategory', 'tournaments.surface', 'tournaments.city', 'tournaments.fromDate', 'tournaments.lastDate', 'tournaments.tournamentName', 'academies.name as academy_name')
    //                     ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')
    //                     ->whereDate('tournaments.fromDate', '>', now()->toDateString())
    //                     ->where('tournaments.status', '=', 'pending');

    //                 if ($player_gender === 'Male' && $age > 18) {
    //                     $tournament_query->where('tournaments.category', '=', 'Seniors')->orWhere('tournaments.subCategory', '=', 'Men');
    //                 } else if ($player_gender === 'Female' && $age > 18) {
    //                     $tournament_query->where('tournaments.category', '=', 'Seniors')->orWhere('tournaments.subCategory', '=', 'Women');
    //                     Log::info('inside women');
    //                 } else if ($player_gender === 'Male' && $age <= 18) {
    //                     if ($age > 6 && $age < 8) {
    //                         $tournament_query->where('tournaments.subCategory', '=', 'Under 12');
    //                     } else if ($age > 8 && $age < 10) {

    //                         $tournament_query->where('tournaments.subCategory', '=', 'Under 12')
    //                             ->orWhere('tournaments.subCategory', '=', 'Under 14');
    //                     } else if ($age > 10 && $age < 12) {
    //                         $tournament_query->where('tournaments.subCategory', '=', 'Under 12')
    //                             ->orWhere('tournaments.subCategory', '=', 'Under 14')
    //                             ->orWhere('tournaments.subCategory', '=', 'Under 16');
    //                     } else if ($age > 12 && $age < 14) {
    //                         $tournament_query->where('tournaments.subCategory', '=', 'Under 14')
    //                             ->orWhere('tournaments.subCategory', '=', 'Under 16')
    //                             ->orWhere('tournaments.subCategory', '=', 'Under 18');
    //                     } else if ($age > 14 && $age < 16) {
    //                         $tournament_query->where('tournaments.subCategory', '=', 'Under 16')
    //                             ->orWhere('tournaments.subCategory', '=', 'Under 18')
    //                             ->orWhere('tournaments.subCategory', '=', 'Men');
    //                     } else if ($age > 16 && $age <= 18) {
    //                         $tournament_query->where('tournaments.subCategory', '=', 'Under 18')
    //                             ->orWhere('tournaments.subCategory', '=', 'Men');
    //                     }
    //                 } else if ($player_gender === 'Female' && $age <= 18) {
    //                     if ($age > 6 && $age < 8) {
    //                         $tournament_query->where('tournaments.subCategory', '=', 'Under 12');
    //                     } else if ($age > 8 && $age < 10) {

    //                         $tournament_query->where('tournaments.subCategory', '=', 'Under 12')
    //                             ->orWhere('tournaments.subCategory', '=', 'Under 14');
    //                     } else if ($age > 10 && $age < 12) {
    //                         $tournament_query->where('tournaments.subCategory', '=', 'Under 12')
    //                             ->orWhere('tournaments.subCategory', '=', 'Under 14')
    //                             ->orWhere('tournaments.subCategory', '=', 'Under 16');
    //                     } else if ($age > 12 && $age < 14) {
    //                         $tournament_query->where('tournaments.subCategory', '=', 'Under 14')
    //                             ->orWhere('tournaments.subCategory', '=', 'Under 16')
    //                             ->orWhere('tournaments.subCategory', '=', 'Under 18');
    //                     } else if ($age > 14 && $age < 16) {
    //                         $tournament_query->where('tournaments.subCategory', '=', 'Under 16')
    //                             ->orWhere('tournaments.subCategory', '=', 'Under 18')
    //                             ->orWhere('tournaments.subCategory', '=', 'Women');
    //                     } else if ($age > 16 && $age <= 18) {
    //                         $tournament_query->where('tournaments.subCategory', '=', 'Under 18')
    //                             ->orWhere('tournaments.subCategory', '=', 'Women');
    //                     }
    //                 }

    //                 $tournament = $tournament_query->where('academies.publish', '=', 1)
    //                     ->where('tournaments.status', '!=', 'done')
    //                     ->orderBy('tournaments.fromDate', 'ASC')->paginate(30);
    //                 Log::info($tournament);
    //                 Log::info('tournamen');
    //                 // dd($tournament);
    //                 $cities = Tournament::select('city')->DISTINCT()->get();
    //                 $years = Tournament::select(DB::raw('YEAR(fromDate) as year'))
    //                     ->where('fromDate', '>', now()->toDateString())
    //                     ->DISTINCT()->orderBy('year', 'ASC')->get();
    //                 // dd($years);

    //                 $result = [];
    //                 foreach ($tournament as $tour) {
    //                     $tournament_id = $tour->tournament_id;
    //                     $registered_tournaments = PlayerRegisterTournament::where('tournament_id', '=', $tournament_id)
    //                         ->where('player_id', '=', $player_id)
    //                         ->get();
    //                     foreach ($registered_tournaments as $r_p) {
    //                         $result[] = $r_p->tournament_id;
    //                     }
    //                 }
    //                 Log::info($tournament);
    //                 return view('player.upcomingTournament',

    //                     [
    //                         'tournaments' => $tournament,
    //                         'is_registered' => $result,
    //                         'cities' => $cities,
    //                         'years' => $years,
    //                     ]);
    //             } else {
    //                 $request->session()->flush();
    //                 Auth::logout();
    //                 Alert::info('Information', 'Admin Not approved now. Please wait until admin  approved!', 3500);
    //                 return redirect()->route('home');
    //             }
    //         } else {
    //             Alert::info('Important', 'This page access only player.', 3500);
    //       f      return redirect()->back();
    //         }
    //     } else {
    //         Alert::info('Important', 'Something want wrong.', 3500);
    //         return redirect()->back();
    //     }
    // }
    public function upcomingTournaments(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') == 'Player') {

                $id = session('id');

                $get_player = Player::where('id', '=', $id)->where('publish', '=', 1)->first();

                if ($get_player) {

                    $player_id = $get_player->player_id;
                    $player_dob = $get_player->dob;

                    $player_gender = $get_player->gender;
                    // dd($player_gender);
                    $birthDate = new DateTime($player_dob);

                    $currentDate = new DateTime('today');

                    $age = $birthDate->diff($currentDate)->y;

                    // dd(now()->toDateString());

                    $tournament_query = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.category', 'tournaments.subCategory', 'tournaments.surface', 'tournaments.city', 'tournaments.fromDate', 'tournaments.lastDate', 'tournaments.tournamentName', 'academies.name as academy_name')
                        ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')
                        ->whereDate('tournaments.fromDate', '>', now()->toDateString())
                        ->where('tournaments.status', '=', 'pending');

                    $tournament = $tournament_query->where('academies.publish', '=', 1)
                        ->where('tournaments.status', '!=', 'done')
                        ->orderBy('tournaments.fromDate', 'ASC')->paginate(30);
                  
                    // dd($tournament);
                    $cities = Tournament::select('city')->DISTINCT()->get();
                    $years = Tournament::select(DB::raw('YEAR(fromDate) as year'))
                        ->where('fromDate', '>', now()->toDateString())
                        ->DISTINCT()->orderBy('year', 'ASC')->get();
                    // dd($years);

                    $result = [];
                    foreach ($tournament as $tour) {
                        $tournament_id = $tour->tournament_id;
                        $registered_tournaments = PlayerRegisterTournament::where('tournament_id', '=', $tournament_id)
                            ->where('player_id', '=', $player_id)
                            ->get();
                        foreach ($registered_tournaments as $r_p) {
                            $result[] = $r_p->tournament_id;
                        }
                    }
               
                    return view('player.upcomingTournament',

                        [
                            'tournaments' => $tournament,
                            'is_registered' => $result,
                            'cities' => $cities,
                            'years' => $years,
                        ]);
                } else {
                    $request->session()->flush();
                    Auth::logout();
                    Alert::info('Information', 'Admin Not approved now. Please wait until admin  approved!', 3500);
                    return redirect()->route('home');
                }
            } else {
                Alert::info('Important', 'This page access only player.', 3500);
                return redirect()->back();
            }
        } else {
            Alert::info('Important', 'Something want wrong.', 3500);
            return redirect()->back();
        }
    }

    // player/tournament-history
    public function tournamentHistory(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') === 'Player') {

                $id = session('id');

                $get_player = Player::where('id', '=', $id)->where('publish', '=', 1)->first();

                if ($get_player) {

                    $player_id = $get_player->player_id;

                    $applied_tournament = Tournament::select('tournaments.tournamentName', 'tournaments.category', 'tournaments.subCategory', 'tournaments.tournament_id', 'tournaments.city', 'winner_player.first_name as winner_first_name', 'winner_player.middle_name as winner_middle_name', 'winner_player.last_name as winner_last_name', 'runner_up_player.first_name as runner_up_first_name', 'runner_up_player.middle_name as runner_up_middle_name', 'runner_up_player.last_name as runner_up_last_name')

                        ->join('players as winner_player', 'tournaments.winner_id', '=', 'winner_player.player_id')

                        ->leftJoin('players as runner_up_player', 'tournaments.runnerup_id', '=', 'runner_up_player.player_id')

                        ->where('tournaments.fromDate', '<', Carbon::now())

                        ->whereIn('tournaments.tournament_id', function ($query) use ($player_id) {

                            $query->select('tournament_id')

                                ->from('player_register_tournament')

                                ->where('player_id', '=', $player_id);

                        })

                        ->paginate(30);
                    // dd($applied_tournament);
                    Log::info($applied_tournament);
                    return view('player.tournamentHistory', ['applied_tournaments' => $applied_tournament]);

                } else {

                    $request->session()->flush();

                    Auth::logout();

                    Alert::info('Information', 'Admin Not approved now. Please wait until admin  approved!', 3500);

                    return redirect()->route('home');

                }

            }

        }

    }

    // academy dashboard
    public function academyDashboard(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {
            if (Session()->has('role') == 'Academy') {
                $id = session('id');
                $academy_data = Academy::where('id', '=', $id)
                    ->where('publish', '=', 1)->first();
                if ($academy_data) {
                    $academy_id = $academy_data->academy_id;
                    $registered_players = PlayerRegisterTournament::whereIn('player_register_tournament.tournament_id',
                        DB::table('tournaments')->select('tournaments.tournament_id')->where('tournaments.academy_id', '=', $academy_id)
                    )->get();

                    $upcoming_tournaments = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.category', 'tournaments.surface', 'tournaments.city', 'tournaments.fromDate', 'tournaments.status', 'academies.no_of_court')
                        ->whereDate('fromDate', '>', now()->toDateString())
                        ->where('tournaments.academy_id', '=', $academy_id)
                        ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')
                        ->orderBy('tournaments.fromDate', 'ASC')
                        ->paginate(30);

                    return view('academy.dashboard', [
                        'academy_data' => $academy_data,
                        'registered_players' => $registered_players,
                        'upcoming_tournaments' => $upcoming_tournaments,
                    ]);
                } else {
                    $request->session()->flush();
                    Auth::logout();
                    Alert::info('Information', 'Admin Not approved now. Please wait until admin  approved!', 3500);
                    return redirect()->route('home');
                }
            }
        }
    }

    // academy/my-profile

    public function academyProfile(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->has('role') == 'Academy') {

                $id = session('id');

                $details = Academy::select('academies.*')

                    ->join('users', 'academies.id', '=', 'users.id')

                    ->where('academies.id', '=', $id)

                    ->where('academies.publish', '=', 1)->first();

                if ($details) {

                    $states = State::get();

                    return view('academy.myProfile', ['details' => $details, 'states' => $states]);

                } else {

                    $request->session()->flush();

                    Auth::logout();

                    Alert::info('Information', 'Admin Not approved now. Please wait until admin approved!', 3500);

                    return redirect()->route('home');

                }

            }

        }

    }

    // academy/change-password

    public function academyChangePassword(Request $request)
    {

        if (Session()->has('role') && Session()->has('id')) {

            if (Session()->get('role') == "Academy") {

                $id = session('id');

                $check_academy = Academy::where('id', '=', $id)->where('publish', '=', 1)->first();

                if ($check_academy) {

                    return view('academy.changePassword');

                } else {

                    $request->session()->flush();

                    Auth::logout();

                    Alert::info('Information', 'Admin Not approved now. Please wait until admin approved!', 3500);

                    return redirect()->route('home');

                }

            }

        }

    }

    // academy/registered-player

    public function academyRegisteredPlayer(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {
            if (Session()->get('role') == 'Academy') {
                $id = session('id');
                $academy = Academy::where('id', '=', $id)->where('publish', '=', 1)->first();
                if ($academy) {
                    $academy_id = $academy->academy_id;
                    // dd($academy_id);

                    $get_tournament = PlayerRegisterTournament::select(
                        'player_register_tournament.register_id',
                        'player_register_tournament.status',
                        'player_register_tournament.category',
                        'player_register_tournament.sub_category',
                        'players.player_id',
                        'players.first_name',
                        'players.middle_name',
                        'players.last_name',
                        'tournaments.tournament_id',
                        'tournaments.tournamentName',
                        'tournaments.surface',
                        'tournaments.city',
                        'ranking.rank'
                    )
                        ->join('players', 'player_register_tournament.player_id', '=', 'players.player_id')
                        ->join('tournaments', function ($join) use ($academy_id) {
                            $join->on('tournaments.tournament_id', '=', 'player_register_tournament.tournament_id')
                                ->where('tournaments.academy_id', '=', $academy_id);
                        })
                        ->leftJoin('ranking', 'players.ita_number', '=', 'ranking.aita_number')
                        ->orderBy('tournaments.tournament_id', 'DESC')
                        ->paginate(50);
                    // dd($get_tournament);

                    return view('academy.registerPlayer', ['register_players' => $get_tournament]);
                } else {
                    $request->session()->flush();
                    Auth::logout();
                    Alert::info('Information', 'Admin Not approved now. Please wait until admin approved!', 3500);
                    return redirect()->route('home');
                }
            } else {
                Alert::info('Information', 'Something wants wrong!', 3500);
                return redirect()->back();
            }
        } else {
            Alert::info('Information', 'Something wants wrong!', 3500);
            return redirect()->back();
        }
    }

    // academy/uploadImages
    public function academyUploadImages(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {
            if (Session()->get('role') === 'Academy') {
                $id = session('id');
                $role = session('role');
                $check_academy = Academy::where('id', '=', $id)->where('publish', '=', 1)->first();
                if ($check_academy) {
                    $academy_image = $check_academy->photo;
                    $academy_name = $check_academy->name;
                    $academy_id = $check_academy->academy_id;
                    $check_images = UploadAcademyImage::where('user_id', '=', $id)->where('academy_id', '=', $academy_id)->get();
                    return view('academy.uploadImages',
                        [
                            'images' => $check_images,
                            'academy_image' => $academy_image,
                            'academy_name' => $academy_name,
                        ]
                    );
                } else {
                    $request->session()->flush();
                    Auth::logout();
                    Alert::info('Information', 'Admin Not approved now. Please wait until admin approved!', 3500);
                    return redirect()->route('home');
                }
            } else {
                Alert::info('Important', 'Something wants wrong.', 3500);
                return redirect()->back();
            }
        } else {
            Alert::info('Important', 'Something wants wrong.', 3500);
            return redirect()->back();
        }
    }

    // academy/recentTournament

    public function recentTournament(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {
            if (Session()->has('role') == "Academy") {
                $id = session('id');
                $academy = Academy::where('id', '=', $id)->where('publish', '=', 1)->first();
                if ($academy) {
                    $academy_id = $academy->academy_id;
                    $tournaments = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.category', 'tournaments.surface', 'tournaments.city', 'winner_player.first_name as winner_first_name', 'winner_player.middle_name as winner_middle_name', 'winner_player.last_name as winner_last_name', 'runner_up_player.first_name as runner_up_first_name', 'runner_up_player.middle_name as runner_up_middle_name', 'runner_up_player.last_name as runner_up_last_name')
                        ->join('players as winner_player', function ($join) {
                            $join->on('tournaments.winner_id', '=', 'winner_player.player_id');
                        })
                        ->join('players as runner_up_player', function ($join) {
                            $join->on('tournaments.runnerup_id', 'runner_up_player.player_id');
                        })
                        ->where('fromDate', '<', Carbon::now())
                        ->where('academy_id', '=', $academy_id)
                        ->where('status', '=', 'done')
                        ->paginate(30);

                    // dd($tournaments);
                    return view('academy.recentTournament', ['tournaments' => $tournaments]);
                } else {
                    $request->session()->flush();
                    Auth::logout();
                    Alert::info('Information', 'Admin Not approved now. Please wait until admin approved!', 3500);
                    return redirect()->route('home');
                }
            }
        }
    }

    // academy/tournaments

    public function tournaments(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->has('role') == "Academy") {

                $id = session('id');

                $academy = Academy::where('id', '=', $id)->where('publish', '=', 1)->first();

                if ($academy) {

                    $academy_id = $academy->academy_id;

                    $upcoming_tournaments = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.category', 'tournaments.surface', 'tournaments.city', 'tournaments.fromDate')

                        ->whereDate('fromDate', '>', now()->toDateString())

                        ->where('academy_id', '=', $academy_id)

                        ->orderBy('tournaments.fromDate', 'ASC')

                        ->paginate(30);

                    return view('academy.tournaments', [

                        'upcoming_tournaments' => $upcoming_tournaments,

                    ]);

                } else {

                    $request->session()->flush();

                    Auth::logout();

                    Alert::info('Information', 'Admin Not approved now. Please wait until admin approved!', 3500);

                    return redirect()->route('home');

                }

            }

        }

    }

    // academyCreateTournament

    public function academyCreateTournament(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') === 'Academy') {

                $id = session('id');

                $academy = Academy::where('id', '=', $id)->where('publish', '=', 1)->first();

                if ($academy) {

                    return view('academy.createTournament', ['academy' => $academy]);

                } else {

                    $request->session()->flush();

                    Auth::logout();

                    Alert::info('Information', 'Admin Not approved now. Please wait until admin approved!', 3500);

                    return redirect()->route('home');

                }

            } else {

                Alert::info('Important', 'This page access only academy.', 3500);

                return redirect()->back();

            }

        } else {

            Alert::info('Important', 'Something want wrong.', 3500);

            return redirect()->back();

        }

    }

    // academy/editTournament.blade.php

    public function academyEditTournament(Request $request)
    {
        if (Session()->has('role') && Session()->has('id')) {
            if (Session()->get('role') == 'Academy') {
                $id = session('id');
                $tournament_id = $request->id;
                $academy = Academy::where('id', '=', $id)->where('publish', '=', 1)->first();
                if ($academy) {
                    $tournament = Tournament::where('tournament_id', '=', $tournament_id)->first();
                    Log::info($tournament);
                    return view('academy.editTournament', ['tournament' => $tournament, 'academy' => $academy]);
                } else {

                    $request->session()->flush();

                    Auth::logout();

                    Alert::info('Information', 'Admin Not approved now. Please wait until admin approved!', 3500);

                    return redirect()->route('home');

                }

            }

        }

    }

    // academy/manualRegisterPlayerList.blade.php
    public function manualRegisteredPlayer(Request $request)
    {
        if (Session()->has('role') && Session()->has('id')) {
            if (Session()->get('role') == 'Academy') {
                $id = session('id');
                $tournament_id = $request->id;
                $academy = Academy::where('id', '=', $id)->where('publish', '=', 1)->first();
                if ($academy) {
                    $academy_id = $academy->academy_id;
                    $manual_players = ManualRegister::select('manual_registration.name', 'manual_registration.gender', 'manual_registration.dob', 'manual_registration.aita_number', 'manual_registration.rank', 'states.name as state', 'tournaments.tournamentName', 'tournaments.tournament_id')
                        ->join('tournaments', 'manual_registration.tournament_id', 'tournaments.tournament_id')
                        ->leftJoin('states', 'manual_registration.state', '=', 'states.abbreviation')
                        ->where('manual_registration.academy_id', '=', $academy_id)
                        ->paginate(30);
                    return view('academy.manualRegisterPlayerList', ['register_players' => $manual_players]);
                } else {
                    $request->session()->flush();
                    Auth::logout();
                    Alert::info('Information', 'Admin Not approved now. Please wait until admin approved!', 3500);
                    return redirect()->route('home');
                }
            }
        }
    }

    // academy/academyPlayerRegistration.blade.php
    public function academyPlayerRegistration(Request $request)
    {
        if (Session()->has('role') && Session()->has('id')) {
            if (Session()->get('role') == 'Academy') {
                $user_id = session('id');
                $academy = Academy::where('id', '=', $user_id)->where('publish', '=', 1)->first();
                if ($academy) {
                    $states = State::all();
                    $tournament_id = $request->id;
                    $tournament = Tournament::where('tournament_id', '=', $tournament_id)->first();
                 
                    $sub_category = explode(',', $tournament->subCategory);
                    return view('academy.academyPlayerRegistration', [
                        'tournament' => $tournament,
                        'subcat' => $sub_category,
                        'states' => $states,
                    ]);
                } else {
                    $request->session()->flush();
                    Auth::logout();
                    Alert::info('Information', 'Admin Not approved now. Please wait until admin approved!', 3500);
                    return redirect()->route('home');
                }
            }
        }
    }

    // academy/currentTournaments.blade.php
    public function currentTournaments(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {
            if (Session()->get('role') == "Academy") {
                $id = session('id');
                $isAcademy = Academy::where('id', '=', $id)->where('publish', '=', 1)->first();
                if ($isAcademy) {
                    $academy_id = $isAcademy->academy_id;
                    $current_tournaments = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.category', 'tournaments.surface', 'tournaments.city')
                        ->where(function ($query) {
                            $query->where('tournaments.fromDate', '<=', Carbon::today()->toDateString())
                                ->where('tournaments.toDate', '>=', Carbon::today()->toDateString());
                        })
                        ->where('academy_id', '=', $academy_id)
                        ->paginate(30);
                    return view('academy.currentTournaments', ['current_tournaments' => $current_tournaments]);
                } else {
                    $request->session()->flush();
                    Auth::logout();
                    Alert::info('Information', 'Admin Not approved now. Please wait until admin approved!', 3500);
                    return redirect()->route('home');
                }
            }
        }
    }

    // academy/showRegisteredPlayerData.blade.php
    public function showRegisteredPlayerList(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {
            if (Session()->get('role') === 'Academy') {
                $user_id = Session('id');
                $is_academy = Academy::where('id', '=', $user_id)->where('publish', '=', 1)->first();

                if (!$is_academy) {
                    $request->session()->flush();
                    Auth::logout();
                    Alert::info('Information', 'Admin Not approved now. Please wait until admin approved!', 3500);
                    return redirect()->route('home');
                }

                $academy_id = $is_academy->academy_id;
                $portal_registered_players = PlayerRegisterTournament::select('player_register_tournament.category as player_register_tournament_category', 'player_register_tournament.sub_category as player_register_tournament_sub_category', 'tournaments.tournamentName', 'tournaments.tournament_id', 'tournaments.category', 'tournaments.subCategory', 'players.first_name', 'players.middle_name', 'players.last_name', 'players.player_id', 'players.dob', 'players.ita_number', 'players.gender', 'ranking.rank')
                    ->leftJoin('tournaments', 'player_register_tournament.tournament_id', '=', 'tournaments.tournament_id')
                    ->leftJoin('players', 'player_register_tournament.player_id', '=', 'players.player_id')
                    ->leftJoin('ranking', 'players.ita_number', '=', 'ranking.aita_number')
                    ->where('tournaments.academy_id', '=', $academy_id)
                    ->where('player_register_tournament.status', '=', 'approved')
                // ->whereNotIn('player_register_tournament.player_id', function ($query) {
                //     $query->select('draw.player_id')
                //         ->from('draw')
                //         ->whereColumn('draw.tournament_id', 'player_register_tournament.tournament_id')
                //         ->whereRaw("draw.player_id = CONCAT('p_', player_register_tournament.player_id)");
                // })
                    ->get();
                Log::info('protal registerplayer' . $portal_registered_players);
                // if (count($portal_registered_players) >0){

                $manual_registered_player = ManualRegister::where('academy_id', '=', $academy_id)
                // ->whereNotIn('manual_registration.tournament_id', function ($query) {
                //     $query->select('draw.tournament_id')
                //         ->from('draw')
                //         ->whereColumn('draw.tournament_id', '=', 'manual_registration.tournament_id');
                // })
                    ->get();

                $tournaments = Tournament::select('tournamentName', 'tournament_id', 'subCategory')
                    ->where('academy_id', '=', $academy_id)
                    ->where('status', '!=', 'done')
                //commentend 23-08 15:9;
                // ->whereNotIn('tournaments.tournament_id', function ($query) {
                //     $query->select('draw.tournament_id')
                //         ->from('draw')
                //         ->whereColumn('draw.tournament_id', '=', 'tournaments.tournament_id');
                // })
                    ->orderBy('tournamentName', 'ASC')
                    ->get();
                $tournamentval = [];
                foreach ($tournaments as $tournament) {
                    $arr = explode(',', $tournament->subCategory);

                    $count = 0;
                    foreach ($arr as $sub_category) {
                        $malecat = DB::table('draw')
                            ->join('interim_draw', 'draw.interim_draw_id', '=', 'interim_draw.id')
                            ->where('draw.tournament_id', $tournament->tournament_id)
                            ->where('interim_draw.subCategory', trim($sub_category))
                            ->where('interim_draw.gender', 'Male')
                            ->select('draw.draw_id')
                        //Log::info('SQL Query: ' . $malecat->toSql());
                        //Log::info('Bindings: ' . json_encode($malecat->getBindings()));

                            ->first();
                        $femalecat = DB::table('draw')
                            ->join('interim_draw', 'draw.interim_draw_id', '=', 'interim_draw.id')
                            ->where('draw.tournament_id', $tournament->tournament_id)
                            ->where('interim_draw.subCategory', trim($sub_category))
                            ->where('interim_draw.gender', 'Female')
                            ->select('draw.draw_id')
                            ->first();

                        if ($malecat != '' && $femalecat != '') {$count++;}
                    }

                    if ($count != count($arr)) {$tournamentval[] = $tournament;}
                }

                return view('academy.showRegisteredPlayerData', [
                    //'tournaments' => $tournaments,
                    'tournaments' => $tournamentval,
                    'portal_registered_players' => $portal_registered_players,
                    'manual_registered_player' => $manual_registered_player,
                ]);
            }
        }
    }

    // academy/drawPrepare.blade.php
    public function drawPrepare(Request $request)
    {
        if (!Session()->has('id') || !Session()->has('role')) {
            $request->session()->flush();
            Auth::logout();
            Alert::info('Information', 'Wrong URL!', 3500);
            return redirect()->route('home');
        }
        if (Session()->get('role') !== 'Academy') {
            $request->session()->flush();
            Auth::logout();
            Alert::info('Information', 'Wrong URL!', 3500);
            return redirect()->route('home');
        }

        $user_id = Session()->get('id');
        $is_academy = Academy::where('id', '=', $user_id)->where('publish', '=', 1)->first();

        if (!$is_academy) {
            $request->session()->flush();
            Auth::logout();
            Alert::info('Information', 'Wrong URL!', 3500);
            return redirect()->route('home');
        }
        $academy_id = $is_academy->academy_id;
        $drawGender = $request->input('gender');
        $subCategory = $request->input('sub-category');
        $tournament_id = $request->input('id');

        $drawGender = ucfirst($drawGender);
        if ($subCategory === 'men' || $subCategory === 'women') {
            $subCategory = ucfirst($subCategory);
        } else {
            $sub_category_array = explode('-', $subCategory);
            $upper_under = ucfirst($sub_category_array[0]);
            $subCategory = $upper_under . ' ' . $sub_category_array[1];
        }

        $drawid = DB::table('draw')
            ->join('interim_draw', 'draw.interim_draw_id', '=', 'interim_draw.id')
            ->where('draw.tournament_id', $tournament_id)
            ->where('interim_draw.subCategory', $subCategory)
            ->where('gender', $drawGender)
            ->select('draw.draw_id')
            ->first();

        if ($drawid) { /*
        $players = DB::table('players')
        ->join('player_register_tournament', 'players.id', '=', 'player_register_tournament.player_id')
        ->leftJoin('ranking', 'players.ita_number', '=', 'ranking.aita_number')
        ->where('player_register_tournament.tournament_id',$tournament_id)
        ->where('player_register_tournament.sub_category','LIKE',"%$subCategory%")
        ->where('players.gender', '=', $drawGender)
        ->whereNotIn('player_register_tournament.player_id', function($query) use ($drawid) {
        $query->select(DB::raw('CAST(SUBSTRING(draw_players_tournament.player_id, 3) AS UNSIGNED)'))
        ->from('draw_players_tournament')
        ->where('draw_players_tournament.draw_id', $drawid->draw_id);
        })
        ->select('players.player_id', 'players.first_name', 'players.middle_name', 'players.last_name', 'players.dob', 'players.gender', 'players.ita_number', 'ranking.rank')
        ->get();
        $manual_registered_player = ManualRegister::where('academy_id', '=', $academy_id)
        ->where('tournament_id', '=', $tournament_id)
        ->where('gender', '=', $drawGender)
        ->where('sub_category', 'LIKE', "%$subCategory%")
        ->whereNotIn('manual_registration.manual_register_id', function($query) use ($drawid) {
        $query->select(DB::raw('CAST(SUBSTRING(player_id, 3) AS UNSIGNED)'))
        ->from('draw_players_tournament')
        ->where('draw_id', $drawid->draw_id);
        })
        ->get();
        // dd($drawid);
        $subquery = DB::table('draw_players_tournament')
        ->select(DB::raw('CAST(SUBSTRING(player_id, 3) AS UNSIGNED)'))
        ->where('draw_id', $drawid->draw_id)
        ->get();
         */

            /*$manual_registered_player = ManualRegister::where('academy_id', '=', $academy_id)
            ->where('tournament_id', '=', $tournament_id)
            ->where('gender', '=', $drawGender)
            ->where('sub_category','LIKE',"%$subCategory%")
            ->whereNotIn('manual_register_id', function($query) use ($drawid) {
            $query->select(DB::raw('CAST(SUBSTRING(draw_players_tournament.player_id, 3) AS UNSIGNED)'))
            ->from('draw_players_tournament')
            ->where('draw_players_tournament.draw_id', $drawid->draw_id);
            })
            ->get();
             */
            Log::info('in draw ');
            $players = [];
            $manual_registered_player = [];
            $msg = 'Draw already created for this category';
        } else {
            $msg = '';
            $players = DB::table('players')
                ->join('player_register_tournament', 'players.player_id', '=', 'player_register_tournament.player_id')
                ->leftJoin('ranking', 'players.ita_number', '=', 'ranking.aita_number')
                ->where('player_register_tournament.status', 'approved')
                ->where('player_register_tournament.tournament_id', $tournament_id)
                ->where('player_register_tournament.sub_category', 'LIKE', "%$subCategory%")
                ->where('players.gender', '=', $drawGender)
                ->where('player_register_tournament.drawType', '=', 'Main')

                ->select('players.player_id', 'players.first_name', 'players.middle_name', 'players.last_name', 'players.dob', 'players.gender', 'players.ita_number', 'ranking.rank')
                ->get();

            $manual_registered_player = ManualRegister::where('academy_id', '=', $academy_id)
                ->where('tournament_id', '=', $tournament_id)
                ->where('gender', '=', $drawGender)
                ->where('sub_category', 'LIKE', "%$subCategory%")
                ->where('drawType', '=', 'Main')
                ->get();
        }

        $tournaments = Tournament::where('tournament_id', '=', $tournament_id)->first();

        // dd($drawGender, $manual_registered_player, $players, $tournaments);

        return view('academy.drawPrepare', [
            'drawGender' => $drawGender,
            'subCategory' => $subCategory,
            'players' => $players,
            'manual_registered_players' => $manual_registered_player,
            'tournament' => $tournaments,
            'msg' => $msg,
        ]);
    }

    // create draw page: academy/drawCreate.blade.php
    public function draw(Request $request)
    {
        $result = session('result');
        $user_id = session('id');
        // dd($result);

        if (!session()->has('id') || !session()->has('role')) {
            $request->session()->flush();
            Auth::logout();
            Alert::info('Information', 'Something wants wrong!', 3500);
            return redirect()->route('home');
        }
        if (Session()->get('role') !== 'Academy') {
            $request->session()->flush();
            Auth::logout();
            Alert::info('Information', 'Wrong URL!', 3500);
            return redirect()->route('home');
        }

        $academy = Academy::where('id', '=', $user_id)->where('publish', '=', 1)->first();
        if (!$academy) {
            $request->session()->flush();
            Auth::logout();
            Alert::info('Information', 'Admin Not approved now. Please wait until admin approved!', 3500);
            return redirect()->route('home');
        }

        foreach ($result as $index => $data) {
            $interim_draw_id = $data['interim_draw_id'];
            $interim_draw_player_tournament_id = $data['interim_draw_player_tournament_id'];
            // dd($interim_draw_id, $interim_draw_player_tournament_id);
            $interim_draw = InterimDraw::where('id', '=', $interim_draw_id)->first();
            // $interim_draw = InterimDraw::where('id', '=', $interim_draw_id)->first();
            $interim_draw_player_tournaments = InterimDrawPlayerTournament::select('interim_draw_players_tournament.id', 'interim_draw_players_tournament.player_id', 'interim_draw_players_tournament.player_name', 'interim_draw_players_tournament.dob', 'interim_draw_players_tournament.aita_number', 'interim_draw_players_tournament.rank', 'interim_draw_players_tournament.interim_draw_id', 'interim_draw.draw_type', 'interim_draw.player_num', 'interim_draw.subCategory', 'interim_draw.gender', 'tournaments.tournament_id', 'tournaments.tournamentName')
                ->leftJoin('interim_draw', 'interim_draw_players_tournament.interim_draw_id', '=', 'interim_draw.id')
                ->leftJoin('tournaments', 'interim_draw.tournament_id', '=', 'tournaments.tournament_id')
                ->where('interim_draw_players_tournament.id', '=', $interim_draw_player_tournament_id)
                ->get();

            $academy_name = $academy->name;

            foreach ($interim_draw_player_tournaments as $tournament) {
                $raw_data[] = [
                    'interim_draw_players_tournament_id' => $tournament->id,
                    'interim_draw_id' => $interim_draw_id,
                    'tournament_id' => $tournament->tournament_id,
                    'tournamentName' => $tournament->tournamentName,
                    'category' => $tournament->category,
                    'draw_type' => $tournament->draw_type,
                    'player_num' => $tournament->player_num,
                    'player_id' => $tournament->player_id,
                    'player_name' => $tournament->player_name,
                    'subCategory' => $tournament->subCategory,
                    'gender' => $tournament->gender,
                    'rank' => $tournament->rank,
                    'aita_number' => $tournament->aita_number,
                    'dob' => $tournament->dob,
                    'academy_name' => $academy_name,
                ];
            }
        }
        // dd($raw_data);
        Log::info('draw function');
        Log::info($raw_data);
        return view('academy.drawCreate', ['raw_data' => $raw_data]);
    }

    // academy/draw.blade.php
    public function drawPage(Request $request)
    {
        $user_id = session('id');

        if (!session()->has('id') || !session()->has('role')) {
            $request->session()->flush();
            Auth::logout();
            Alert::info('Information', 'Something wants wrong!', 3500);
            return redirect()->route('home');
        }
        if (Session()->get('role') !== 'Academy') {
            $request->session()->flush();
            Auth::logout();
            Alert::info('Information', 'Wrong URL!', 3500);
            return redirect()->route('home');
        }

        $academy = Academy::where('id', '=', $user_id)->where('publish', '=', 1)->first();
        if (!$academy) {
            $request->session()->flush();
            Auth::logout();
            Alert::info('Information', 'Admin Not approved now. Please wait until admin approved!', 3500);
            return redirect()->route('home');
        }

        $academy_id = $academy->academy_id;
        $fetch_tournaments = Draw::select('draw.draw_id', 'draw.player_num', 'tournaments.tournamentName', 'interim_draw.gender', 'interim_draw.subCategory','interim_draw.draw_type')
            ->join('tournaments', 'draw.tournament_id', '=', 'tournaments.tournament_id')
            ->join('interim_draw', 'draw.interim_draw_id', '=', 'interim_draw.id')
            ->whereIn('draw.tournament_id',
                DB::table('tournaments')
                    ->SELECT('tournaments.tournament_id')
                    ->WHERE('tournaments.academy_id', '=', $academy_id)
                    ->WHERE('tournaments.status', '!=', 'done')
            )
            ->WHERE('draw.winner', '=', null)
            ->WHERE('draw.runnerup', '=', null)
            ->get();
        // dd($fetch_tournaments);

        return view('academy.draw', ['fetch_tournaments' => $fetch_tournaments]);
    }

    // <-------------code by biswajeet start------------------------>

    # Academies section home page data

    public function academiesData(Request $request)
    {
        $fetchacademic_datas = Academy::where('show_on_home', 'yes')
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();

        return $fetchacademic_datas;
    }

    //end
    # fetch upcoming tournaments
    public function fetchUpcomingTournament()
    {
        $upcoming_tournament_data = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.fromDate', 'tournaments.city', 'tournaments.lastDate', 'tournaments.factsheet', 'tournaments.category', 'tournaments.subCategory', 'tournaments.stay', 'tournaments.toDate', 'tournaments.surface', 'academies.name', 'academies.academy_id')
            ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')
            ->where('tournaments.subCategory', 'Like', '%Under 12%')
            ->where('tournaments.status', '=', 'pending')
            ->where('tournaments.fromDate', '>', now()->toDateString())
            ->orderBy('tournaments.fromDate', 'ASC')->limit(10)->get();
        return $upcoming_tournament_data;
    }

    # fetch recent tournaments
    // public function recentTournamentData()
    // {

    //     $recent_tournament_data = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.fromDate', 'tournaments.imageOne', 'tournaments.city', 'winner_player.first_name as winner_first_name', 'winner_player.middle_name as winner_middle_name', 'winner_player.last_name as winner_last_name', 'runnerup_player.first_name as runnerup_first_name', 'runnerup_player.middle_name as runnerup_middle_name', 'runnerup_player.last_name as runnerup_last_name')

    //         ->join('players as winner_player', 'tournaments.winner_id', '=', 'winner_player.player_id')

    //         ->join('players as runnerup_player', 'tournaments.runnerup_id', '=', 'runnerup_player.player_id')

    //         ->where('tournaments.subCategory', '=', "Under 12")

    //         ->where('tournaments.status', '=', 'done')

    //         ->where('tournaments.fromDate', '<', now()->toDateString())

    //         ->orderBy('tournaments.fromDate', 'DESC')->limit(10)->get();

    // }

    public function recentTournamentData(Request $request)
    {
        $recent_tournament_data = DB::select('SELECT
        winner.first_name AS winner_first_name,
        winner.last_name AS winner_last_name,
        runnerup.first_name AS runnerup_first_name,
        runnerup.last_name AS runnerup_last_name,
        t.city,
        t.tournament_id,
        t.tournamentName,
        t.category,
        t.subCategory,
        t.imageOne,
        t.status,
        t.fromDate
        FROM
            tournaments t
        JOIN
            players winner ON t.winner_id = winner.player_id
        JOIN
            players runnerup ON t.runnerup_id = runnerup.player_id
        WHERE
            t.status = "done" order by t.fromDate desc;');
        return $recent_tournament_data;
    }



}
