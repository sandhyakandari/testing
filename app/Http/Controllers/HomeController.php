<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationMail;
use App\Mail\SendMail;
use App\Mail\UpdateEmailAita;
use App\Models\Academy;
use App\Models\ManualRegister;
use App\Models\Player;
use App\Models\PlayerRegisterTournament;
use App\Models\Rank;
use App\Models\State;
use App\Models\Tournament;
use App\Models\TournamentImage;
use App\Models\UploadAcademyImage;
use App\Models\UploadPlayerImage;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class HomeController extends Controller
{

    // fetch earliest girls under 12 tournament for Homepage

    public function fetchEarliestTournament(Request $request)
    {

        if ($request->ajax()) {

            try {

                $sub_category = urldecode($request->get('sub_category'));

                Log::info('Request Data:', $request->all());

                $tournament_query = $this->fetchUpcomingTournament($sub_category);

                foreach ($tournament_query as $tournament) {

                    $tournament->tournamentDetailUrl = route('tournamentDetail', ['id' => $tournament->tournament_id]);

                    $tournament->academyDetailUrl = route('academyDetail', ['id' => $tournament->academy_id]);

                    $tournament->tournament_register = route('players.upcomingTournaments');

                    $tournament->login_url = route('getLogin');

                }

                return response()->json([

                    'tournaments' => $tournament_query,

                ]);

            } catch (Exception $e) {

                Log::error('Error category tournament not found:', ['error' => $e->getMessage()]);

                return response()->json(['error' => 'Server Error'], 500);

            }

        }

    }

    // fetch upcoming tournaments for Homepage

    public function fetchUpcomingTournament($sub_category)
    {
        $upcoming_tournament_data = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.fromDate', 'tournaments.city', 'tournaments.lastDate', 'tournaments.factsheet', 'tournaments.category', 'tournaments.subCategory', 'tournaments.stay', 'tournaments.toDate', 'tournaments.surface', 'academies.name', 'academies.academy_id')
            ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')
            ->whereRaw('BINARY tournaments.subCategory LIKE ?', ['%' . $sub_category . '%'])
            ->where('tournaments.status', '=', 'pending')
            ->where('tournaments.fromDate', '>', now()->toDateString())
            ->orderBy('tournaments.fromDate', 'ASC')->limit(10)->get();
        Log::info($sub_category);
        Log::info($upcoming_tournament_data);
        return $upcoming_tournament_data;
        /* $upcoming_tournament_data = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.fromDate', 'tournaments.city', 'tournaments.lastDate', 'tournaments.factsheet', 'tournaments.category', 'tournaments.subCategory', 'tournaments.stay', 'tournaments.toDate', 'tournaments.surface', 'academies.name', 'academies.academy_id')

    ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')

    ->where('tournaments.subCategory', '=', $sub_category)

    ->where('tournaments.status', '=', 'pending')

    ->where('tournaments.fromDate', '>', now()->toDateString())

    ->orderBy('tournaments.fromDate', 'ASC')->limit(10)->get();

    return $upcoming_tournament_data; */

    }

    // fetch recent tournament result for homepage

    public function fetchRecentTournamentResult(Request $request)
    {

        if ($request->ajax()) {

            try {

                $sub_category = urldecode($request->get('sub_category'));

                Log::info('Request Data:', $request->all());

                $tournament_query = $this->fetchRecentTournament($sub_category);

                foreach ($tournament_query as $tournament) {
                    $tournament->tournamentDetailUrl = route('tournamentDetail', ['id' => $tournament->tournament_id]);
                }

                return response()->json([
                    'tournaments' => $tournament_query,
                ]);

            } catch (Exception $e) {
                Log::error('Error category tournament result not found:', ['error' => $e->getMessage()]);
                return response()->json(['error' => 'Server Error'], 500);
            }

        }

    }

    // fetch recent tournament result

    public function fetchRecentTournament($sub_category)
    {

        $upcoming_tournament_data = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.fromDate', 'tournaments.imageOne', 'tournaments.city', 'winner_player.first_name as winner_first_name', 'winner_player.middle_name as winner_middle_name', 'winner_player.last_name as winner_last_name', 'runnerup_player.first_name as runnerup_first_name', 'runnerup_player.middle_name as runnerup_middle_name', 'runnerup_player.last_name as runnerup_last_name')

            ->join('players as winner_player', 'tournaments.winner_id', '=', 'winner_player.player_id')

            ->join('players as runnerup_player', 'tournaments.runnerup_id', '=', 'runnerup_player.player_id')

            ->where('tournaments.subCategory', '=', $sub_category)

            ->where('tournaments.status', '=', 'done')

            ->where('tournaments.fromDate', '<', now()->toDateString())

            ->orderBy('tournaments.fromDate', 'DESC')->limit(10)->get();

        return $upcoming_tournament_data;

    }

    // academy search functionality

    public function academySearch(Request $request)
    {

        $search = $request->search;

        $academies = Academy::where('publish', '=', 1)->paginate(30);

        if (!empty($search) && $search != null && $search != "") {

            $academies = Academy::where('name', 'LIKE', '%' . $search . '%')

                ->orWhere('city', 'LIKE', '%' . $search . '%')

                ->orWhere('state', 'LIKE', '%' . $search . '%')

                ->paginate(30);

            $academies->appends($search);

            return view('academySearch', ['academies' => $academies])->with(['search' => $search]);

        }

        return view('academySearch', ['academies' => $academies, 'search' => $search]);

    }

    // player search functionality
    public function playerSearch(Request $request)
    {
        if ($request->ajax()) {

            try {

                $page = $request->get('page', 1);

                $name = $request->get('name');

                $category = $request->get('category');

                $subCategory = $request->get('subCategory');
                $playersQuery = Player::select('players.player_id', 'players.first_name', 'players.middle_name', 'players.last_name', 'players.photo', 'players.ita_number', 'players.dob', 'players.gender', 'ranking.rank')

                    ->leftJoin('ranking', 'players.ita_number', '=', 'ranking.aita_number')
                    ->leftJoin('users', 'players.id', '=', 'users.id')
                    ->where('players.publish', '=', 1);
                // ->whereNotNull('ranking.rank');

                // Apply search filters

                if ($name) {

                    $playersQuery->where(function ($query) use ($name) {

                        $query->where('players.first_name', 'LIKE', "%$name%")
                            ->orWhere('players.middle_name', 'LIKE', "%$name%")
                            ->orWhere('players.last_name', 'LIKE', "%$name%")
                            ->orWhere('users.name', 'LIKE', "%$name%")
                            ->orWhere('players.ita_number', '=', $name);

                    });
                }

                // Apply category and subcategory filters

                if ($category && $subCategory) {

                    if ($category === "Juniors") {

                        if ($subCategory === "Under 12") {

                            $playersQuery->whereBetween('players.dob', [now()->subYears(12), now()->subYears(6)]);

                        } elseif ($subCategory === "Under 14") {

                            $playersQuery->whereBetween('players.dob', [now()->subYears(14), now()->subYears(8)]);

                        } elseif ($subCategory === "Under 16") {

                            $playersQuery->whereBetween('players.dob', [now()->subYears(16), now()->subYears(10)]);

                        } elseif ($subCategory === "Under 18") {
                            // Log::info('inside 18');
                            $playersQuery->whereBetween('players.dob', [now()->subYears(18), now()->subYears(12)]);

                        }

                    } elseif ($category === "Seniors") {

                        if ($subCategory === "Men") {

                            $playersQuery->where('gender', '=', 'Male')

                                ->where('players.dob', '<=', now()->subYears(18));

                        } elseif ($subCategory === "Women") {

                            $playersQuery->where('gender', '=', 'Female')

                                ->where('players.dob', '<=', now()->subYears(18));

                        }

                    }

                }

                // Paginate results
                //Log::info($playersQuery->toSql(), $playersQuery->getBindings());
                $players = $playersQuery->orderByRaw('CASE WHEN ranking.rank IS NOT NULL THEN 0 ELSE 1 END, ranking.rank ASC')->paginate(30);

                //orderBy('ranking.rank', 'ASC')->paginate(30);
                // Log::info($players);
                foreach ($players as $player) {

                    $player->playerDetailUrl = route('playerDetail', ['id' => $player->player_id]);

                }

                return response()->json([

                    'players' => $players->items(),

                    'pagination' => (string) $players->links('layoutTwo.paginator'),

                ]);

            } catch (\Exception $e) {

                Log::error('Error in player search:', ['error' => $e->getMessage()]);

                return response()->json(['error' => 'Server Error'], 500);

            }

        }

    }

    // top ten player

    public function topTenPlayer(Request $request)
    {

        $players = $this->fetchTopPlayers(10);

        $player_ranking = Player::select('players.ita_number', 'ranking.rank')

            ->join('ranking', 'players.ita_number', '=', 'ranking.aita_number')

            ->where('players.publish', '=', 1)

            ->get();

        $result = [];

        foreach ($player_ranking as $player) {

            $aita_number = $player->ita_number;

            $ranks = Rank::where('aita_number', '=', $aita_number)->get();

            foreach ($ranks as $rank) {

                $result[] = $rank->aita_number;

            }

        }

        return response()->json(

            [

                'players' => $players,

                'player_ranking' => $player_ranking,

                'result' => $result,

            ]

        );

    }

    // top hundreds players

    public function topHundredPlayers(Request $request)
    {

        $players = $this->fetchTopPlayers(100);

        $player_ranking = Player::select('players.ita_number', 'ranking.rank')

            ->join('ranking', 'players.ita_number', '=', 'ranking.aita_number')

            ->where('players.publish', '=', 1)

            ->get();

        $result = [];

        foreach ($player_ranking as $player) {

            $aita_number = $player->ita_number;

            $ranks = Rank::where('aita_number', '=', $aita_number)->get();

            foreach ($ranks as $rank) {

                $result[] = $rank->aita_number;

            }

        }

        return response()->json(

            [

                'players' => $players,

                'player_ranking' => $player_ranking,

                'result' => $result,

            ]

        );

    }

    // fetch top players function

    public function fetchTopPlayers($limit)
    {

        return DB::table('players')

            ->select('players.*', 'ranking.rank')

            ->join('ranking', 'players.ita_number', '=', 'ranking.aita_number')

            ->orderBy('ranking.rank', 'asc')

            ->limit($limit)

            ->where('players.publish', '=', 1)

            ->get();

    }

    // ascendingUpcomingTournament

    public function ascendingUpcomingTournament(Request $request)
    {

        if ($request->ajax()) {

            try {

                $sort_by = $request->get('sortby');

                $sort_type = $request->get('sorttype');

                $page = $request->get('page', 1);

                $year = $request->get('tournamentFilterYearInput');

                $months = $request->get('tournamentFilterMonthInput');

                $city = $request->get('tournamentFilterCityInput');

                $category = $request->get('tournamentFilterCategoryInput');

                $sub_category = $request->get('tournamentFilterTourInput');

                //Log::info('Request Data:', $request->all());

                $query = Tournament::select(

                    'tournaments.tournament_id', 'tournaments.tournamentCategory', 'tournaments.tournamentName', 'tournaments.city', 'tournaments.category', 'tournaments.subCategory', 'tournaments.surface', 'tournaments.fromDate', 'tournaments.toDate', 'tournaments.lastDate', 'tournaments.city', 'tournaments.status', 'tournaments.stay', 'tournaments.factsheet', 'academies.name', 'academies.academy_id'

                )

                    ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')

                    ->where('tournaments.status', '=', 'pending')

                    ->whereDate('tournaments.fromDate', '>', now()->toDateString());

                if ($year !== 'Year') {

                    $query->whereYear('tournaments.fromDate', $year);

                }

                if ($months !== 'Months') {

                    $query->whereMonth('tournaments.fromDate', date('m', strtotime($months)));

                }

                if ($city !== 'City') {

                    $query->where('tournaments.city', '=', $city);

                }

                if ($category !== 'Player Category') {

                    $query->where('tournaments.category', '=', $category);

                }

                // if ($sub_category !== 'Sub Category') {

                //     // $query->where('tournaments.subCategory', '=', $sub_category);

                //     if (is_array($sub_category)) {

                //         // If sub_category is an array, use whereIn for exact matches

                //         $query->whereIn('tournaments.subCategory', $sub_category);

                //     } else {
                //         // Use LIKE for substring match

                //         $query->where('tournaments.subCategory', 'LIKE', '%' . $sub_category . '%');

                //     }

                // }

                if ($sub_category !== 'Sub Category') {

                    if (is_array($sub_category)) {

                        $query->whereIn('tournaments.subCategory', $sub_category);

                    } else {

                        // Handle single subcategory

                        // $query->where(function ($query) use ($sub_category) {

                        // Match exactly "Men\'s" or include "Men's" in broader categories

                        if ($sub_category === 'Men') {

                            $query->where('tournaments.subCategory', 'LIKE', '%Men%')

                                ->where(function ($query) {

                                    $query->where('tournaments.subCategory', '!=', 'Women');

                                });

                        } elseif ($sub_category === 'Women') {

                            $query->where('tournaments.subCategory', 'LIKE', '%Women%')

                                ->where(function ($query) {

                                    $query->where('tournaments.subCategory', '!=', 'Men');

                                });

                        } else {

                            // For other cases, include the subcategory as a substring

                            $query->where('tournaments.subCategory', 'LIKE', '%' . $sub_category . '%');

                        }

                        // });

                    }

                }

                $tournaments = $query->orderBy($sort_by, $sort_type)->paginate(30);

                foreach ($tournaments as $tournament) {

                    $tournament->tournament_url = route('tournamentDetail', ['id' => $tournament->tournament_id]);

                    $tournament->academy_url = route('academyDetail', ['id' => $tournament->academy_id]);

                    $tournament->login_url = route('getLogin');

                    $tournament->tournament_register = route('players.upcomingTournaments');

                };

                return response()->json([

                    'tournaments' => $tournaments->items(),

                    'pagination' => (string) $tournaments->links('layoutTwo.paginator'),

                ]);

            } catch (\Exception $e) {

                Log::error('Error in ascendingUpcomingTournament:', ['error' => $e->getMessage()]);

                return response()->json(['error' => 'Server Error'], 500);

            }

        }

    }

    // ascending-descending recent tournament

    public function ascendingRecentTournament(Request $request)
    {

        if ($request->ajax()) {

            try {

                $sort_by = $request->get('sortby', 'tournament_id');

                $sort_type = $request->get('sorttype', 'asc');

                $page = $request->get('page', 1);

                $year = $request->get('tournamentFilterYearInput', 'Year');

                $months = $request->get('tournamentFilterMonthInput', 'Months');

                $city = $request->get('tournamentFilterCityInput', 'City');

                $category = $request->get('tournamentFilterCategoryInput', 'Player Category');

                $sub_category = $request->get('tournamentFilterTourInput', 'Sub Category');

                Log::info('Request Data:', $request->all());

                $query = Tournament::select(

                    'tournaments.tournament_id', 'tournaments.tournamentCategory', 'tournaments.tournamentName', 'tournaments.city', 'tournaments.category', 'tournaments.subCategory', 'tournaments.surface', 'tournaments.fromDate', 'tournaments.toDate', 'tournaments.lastDate', 'tournaments.city', 'tournaments.status', 'tournaments.stay', 'tournaments.factsheet', 'academies.name', 'academies.academy_id'

                )

                    ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')

                    ->where('tournaments.status', '=', 'done')

                    ->whereDate('tournaments.toDate', '<', now()->toDateString());

                if ($year !== 'Year') {

                    $query->whereYear('tournaments.fromDate', $year);

                }

                if ($months !== 'Months') {

                    $query->whereMonth('tournaments.fromDate', date('m', strtotime($months)));

                }

                if ($city !== 'City') {

                    $query->where('tournaments.city', '=', $city);

                }

                if ($category !== 'Player Category') {

                    $query->where('tournaments.category', '=', $category);

                }

                // if ($sub_category !== 'Sub Category') {

                //     // $query->where('tournaments.subCategory', '=', $sub_category);

                //     if (is_array($sub_category)) {

                //         $query->whereIn('tournaments.subCategory', $sub_category);

                //     } else {

                //         $query->where('tournaments.subCategory', 'LIKE', '%' . $sub_category . '%');

                //     }

                // }

                if ($sub_category !== 'Sub Category') {

                    if (is_array($sub_category)) {

                        $query->whereIn('tournaments.subCategory', $sub_category);

                    } else {

                        if ($sub_category === 'Men') {

                            $query->where('tournaments.subCategory', 'LIKE', '%Men%')

                                ->where(function ($query) {

                                    $query->where('tournaments.subCategory', '!=', 'Women');

                                });

                        } elseif ($sub_category === 'Women') {

                            $query->where('tournaments.subCategory', 'LIKE', '%Women%')

                                ->where(function ($query) {

                                    $query->where('tournaments.subCategory', '!=', 'Men');

                                });

                        } else {

                            $query->where('tournaments.subCategory', 'LIKE', '%' . $sub_category . '%');

                        }

                    }

                }

                $tournaments = $query->orderBy($sort_by, $sort_type)->paginate(30);

                foreach ($tournaments as $tournament) {

                    $tournament->tournament_url = route('tournamentDetail', ['id' => $tournament->tournament_id]);

                    $tournament->academy_url = route('academyDetail', ['id' => $tournament->academy_id]);

                };

                return response()->json([

                    'tournaments' => $tournaments->items(),

                    'pagination' => (string) $tournaments->links('layoutTwo.paginator'),

                ]);

            } catch (\Exception $e) {

                Log::error('Error in ascendingRecentTournament:', ['error' => $e->getMessage()]);

                return response()->json(['error' => 'Server Error'], 500);

            }

        }

    }

    // ascending-descending current tournament

    public function ascendingCurrentTournament(Request $request)
    {

        if ($request->ajax()) {

            try {

                $sort_by = $request->get('sortby');

                $sort_type = $request->get('sorttype');

                $page = $request->get('page', 1);

                $year = $request->get('tournamentFilterYearInput');

                $months = $request->get('tournamentFilterMonthInput');

                $city = $request->get('tournamentFilterCityInput');

                $category = urldecode($request->get('tournamentFilterCategoryInput'));

                // dd($category);

                $sub_category = urldecode($request->get('tournamentFilterTourInput'));

                Log::info('Category: ' . $category);

                Log::info('Sub Category: ' . $sub_category);

                Log::info('Request Data:', $request->all());

                $query = Tournament::select(

                    'tournaments.tournament_id', 'tournaments.tournamentCategory', 'tournaments.tournamentName', 'tournaments.city', 'tournaments.category', 'tournaments.subCategory', 'tournaments.surface', 'tournaments.fromDate', 'tournaments.toDate', 'tournaments.lastDate', 'tournaments.city', 'tournaments.status', 'tournaments.stay', 'tournaments.factsheet', 'academies.name', 'academies.academy_id'

                )

                    ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')

                    ->where('tournaments.status', '=', 'running')

                    ->where(function ($query) {
                        $query->where('tournaments.fromDate', '<=', Carbon::today()->toDateString())
                            ->where('tournaments.toDate', '>=', Carbon::today()->toDateString());
                    });

                if ($year !== 'Year') {
                    $query->whereYear('tournaments.fromDate', $year);
                }
                if ($months !== 'Months') {
                    $query->whereMonth('tournaments.fromDate', date('m', strtotime($months)));
                }
                if ($city !== 'City') {
                    $query->where('tournaments.city', '=', $city);
                }
                if ($category && $category !== 'Player Category') {
                    $query->where('tournaments.category', '=', $category);
                }

                // if ($sub_category && $sub_category !== 'Sub Category') {
                //     // $query->where('tournaments.subCategory', '=', $sub_category);
                //     if (is_array($sub_category)) {
                //         // If sub_category is an array, use whereIn for exact matches
                //         $query->whereIn('tournaments.subCategory', $sub_category);
                //     } else {
                //         // Use LIKE for substring match
                //         $query->where('tournaments.subCategory', 'LIKE', '%' . $sub_category . '%');
                //     }
                // }
                if ($sub_category !== 'Sub Category') {

                    if (is_array($sub_category)) {

                        $query->whereIn('tournaments.subCategory', $sub_category);

                    } else {

                        if ($sub_category === 'Men') {

                            $query->where('tournaments.subCategory', 'LIKE', '%Men%')

                                ->where(function ($query) {

                                    $query->where('tournaments.subCategory', '!=', 'Women');

                                });

                        } elseif ($sub_category === 'Women') {

                            $query->where('tournaments.subCategory', 'LIKE', '%Women%')

                                ->where(function ($query) {

                                    $query->where('tournaments.subCategory', '!=', 'Men');

                                });

                        } else {

                            $query->where('tournaments.subCategory', 'LIKE', '%' . $sub_category . '%');

                        }

                    }

                }

                Log::info('SQL Query: ' . $query->toSql());

                Log::info('Bindings: ', $query->getBindings());

                $tournaments = $query->orderBy($sort_by, $sort_type)->paginate(30);

                foreach ($tournaments as $tournament) {

                    $tournament->tournament_url = route('tournamentDetail', ['id' => $tournament->tournament_id]);

                    $tournament->academy_url = route('academyDetail', ['id' => $tournament->academy_id]);

                };

                return response()->json([

                    'tournaments' => $tournaments->items(),

                    'pagination' => (string) $tournaments->links('layoutTwo.paginator'),

                ]);

            } catch (\Exception $e) {

                Log::error('Error in ascendingCurrentTournament:', ['error' => $e->getMessage()]);

                return response()->json(['error' => 'Server Error'], 500);

            }

        }

    }

    public function getLogin(Request $request)
    {

        # code...

        return view('pages.login');

    }

    public function getRegister(Request $request)
    {

        # code...

        return view('pages.register');

    }

    public function register(Request $request)
    {

        # code...

        // dd($request->input());

        $request->validate([

            'user-type' => 'required',

            'name' => 'required',

            'email' => 'required|email',

            'phone' => 'required|numeric',

            'password' => 'min:4|required_with:cpassword|same:cpassword',

            'cpassword' => 'required',

        ]);

        // dd('hi');

        $data = $request->input();

        $check_user = User::where('email', '=', $data['email'])->first();

        if ($check_user) {

            $responseData = [

                'status' => 'Failed',

                'message' => 'User already exist! Please try again with another mail.',

            ];

            Alert::Info('Important!', 'User already exist! Please try again with another mail.');

        } else {

            $user = new User;

            $user->name = $data['name'];

            $user->email = $data['email'];

            $user->phone = $data['phone'];

            $user->password = $data['password'];

            $user->role = $data['user-type'];

            $user->save();

            // dd($user->save());

            if ($user->save()) {

                $checkmail = User::where('email', $data['email'])->first();

                $mailData = [

                    'title' => 'Registration',

                    'name' => $checkmail->name,

                    'id' => $checkmail->id,

                ];

                Mail::to($data['email'])->send(new SendMail($mailData));

                $responseData = [

                    'status' => 'success',

                    'message' => 'Form submitted successfully! Please verify your email.',

                ];

                Alert::success('Success!', 'Form submitted successfully! Please verify your email.');

            } else {

                $responseData = [

                    'status' => 'Failed',

                    'message' => 'Form not submitted successfully! Please try again.',

                ];

                Alert::html('', '<img src="assets/images/error.png" class="backend-error" alt="Form not submitted successfully! Please try again." /><p style="color:#ff5e14;">Form not submitted successfully! Please try again.</p>', '');

                // Alert::Info('Success!', 'Form not submitted successfully! Please try again.');

            }

        }

        return redirect()->back()->with($responseData);

    }

    public function verifyMail(Request $request)
    {

        try {

            $id = $request->input('code');

            // DB::update('update users set email_verification="true" where user_id  = ?', [$id]);

            $date = Carbon::now();

            $formattedDate = $date->format('Y-m-d H:i:s');

            DB::table('users')->where('id', $id)->update(array(

                'email_verified_at' => $formattedDate,

            ));

            Alert::success('Success', 'Email Verified Successfully! You can login now.', 3500);

            return redirect()->route('login');

        } catch (Exception $e) {

            Alert::success('Error', 'Email not verified', 3500);

            return redirect('/');

        }

    }

    public function login(Request $request)
    {

        $request->validate([

            'email' => 'required|email',

            'password' => 'required',

            'user-type' => 'required',

        ]);

        $data = $request->input();

        $user = User::where('email', $data['email'])->where('role', $data['user-type'])->first();
        if ($user) {

            if ($user->email_verified_at) {

                if ($user && Hash::check($data['password'], $user->password)) {

                    if ($user->role === 'Player') {

                        $check_register_player = Player::where('id', '=', $user->id)->first();

                        if ($check_register_player) {

                            $request->session()->put('role', $user->role);

                            $request->session()->put('id', $user->id);

                            Alert::success('Success', 'You\'ve Successfully logged in.', 3500);

                            return redirect()->route('player.dashboard');

                        } else {

                            $request->session()->put('role', $user->role);

                            $request->session()->put('id', $user->id);

                            Alert::success('Success', 'You\'ve Successfully logged in.', 3500);

                            return redirect()->route('player.register');

                        }

                    } elseif ($user->role === 'Academy') {

                        $check_register_academy = Academy::where('id', '=', $user->id)->first();

                        if ($check_register_academy) {

                            $request->session()->put('role', $user->role);

                            $request->session()->put('id', $user->id);

                            Alert::success('Success', 'You\'ve Successfully logged in.', 3500);

                            return redirect()->route('academy.dashboard');

                        } else {

                            $request->session()->put('role', $user->role);

                            $request->session()->put('id', $user->id);

                            Alert::success('Success', 'You\'ve Successfully logged in.', 3500);

                            return redirect()->route('academy.register');

                        }

                    } else {

                        Alert::html('', '<img src="assets/images/error.png" class="backend-error" alt="Something want wrong." /><p style="color:#ff5e14;">Something want wrong.</p>', '');

                        // Alert::info('Important', 'Something want wrong.', 3500);

                        return redirect()->back();

                    }

                } else {

                    Alert::html('', '<img src="assets/images/error.png" class="backend-error" alt="Please enter valid password." /><p style="color:#ff5e14;">Please enter valid password.</p>', '');

                    // Alert::info('Important', 'Please enter valid password.', 3500);

                    return redirect()->back();

                }

            } else {

                Alert::html('', '<img src="assets/images/error.png" class="backend-error" alt="Please first verify your email to login." /><p style="color:#ff5e14;">Please first verify your email to login.</p>', '');

                // Alert::info('Important', 'Please first verify your email to login.', 3500);

                return redirect()->back();

            }

        } else {

            Alert::html('', '<img src="assets/images/error.png" class="backend-error" alt="Something went wrong, please check and try again." /><p style="color:#ff5e14;">Something went wrong, please check and try again.</p>', '');

            // Alert::info('Important', 'Something went wrong, please check and try again.', 3500);

            return redirect()->back();

        }

    }

    public function showLinkRequestForm(Request $request)
    {

        return view('pages.resetPasswordForm');

    }

    public function sendResetLinkEmail(Request $request)
    {

        $request->validate([

            'email' => 'required|email',

        ]);

        $user = User::where('email', $request->email)->first();

        $resetToken = Hash::make($user->id);

        $mailData = [

            'title' => "Forget Password",

            'name' => $user->name,

            'id' => $resetToken,

        ];

        Mail::to($user->email)->send(new SendMail($mailData));

        $affected = DB::table('password_reset_tokens')

            ->updateOrInsert(

                ['email' => $user->email],

                ['token' => $resetToken]

            );

        Alert::success('success', 'Please check your email to reset your password.', 3500);

        return redirect()->back()->with('success', "Please check your email to reset your password.");

    }

    public function showResetForm(Request $request)
    {

        return view('pages.changePasswordForm', ['token' => $request->token]);

    }

    public function reset(Request $request)
    {

        $affected = DB::table('password_reset_tokens')->where('token', '=', $request->input('token'))->first();

        $user = User::where('email', $affected->email);

        $user->update([

            'password' => Hash::make($request->password),

        ]);

        Alert::success('success', 'Your Password is updated successfully!', 3500);

        return redirect()->route('login')->with('success', "Your Password is updated successfully!");

    }

    // player register page

    public function playerRegister()
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') === 'Player') {

                $id = session('id');

                $role = session('role');

                $query = User::select('name', 'phone', 'email')->where('id', '=', $id)->where('role', '=', $role)->first();

                $states = State::get();

                return view('pages.player-register', ['query' => $query, 'states' => $states]);

            } else {

                Alert::info('Important', 'This page access only player.', 3500);

                return redirect()->back();

            }

        } else {

            Alert::info('Important', 'Something want wrong.', 3500);

            return redirect()->back();

        }

    }

    // player register functionality

    public function playerRegisterFun(Request $request)
    {

        # code...

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') === 'Player') {

                $rules = [

                    'firstName' => 'required',

                    'lastName' => 'required',

                    'guardianName' => 'required',

                    'dob' => 'required',

                    'gender' => 'required',

                    'phone' => 'required',

                    'email' => 'required|email',

                    'district' => 'required',

                    'pin' => 'required',

                    'address_line_1' => 'required',

                    'address_line_2' => 'required',

                    'state' => 'required',

                    'country' => 'required',

                    'photo' => 'required',

                    'hereBy' => 'required',

                    'abideTermsConditions' => 'required',

                    'disputeShall' => 'required',

                ];
                try {
                    $request->validate($rules);
                } catch (Exception $e) {
                    Log::info($e);
                }
                $id = session('id');

                $role = session('role');

                $input = $request->input();

                $date = Carbon::now();

                $formattedDate = $date->format('Y-m-d H:i:s');

                // dd($request->gender[0]);

                $check_player = User::where('id', '=', $id)->where('role', '=', $role)->first();

                $check_email = $check_player->email;

                $check_phone = $check_player->phone;

                $photo = $request->file('photo');

                $photoName = "player_" . time() . '.' . $photo->getClientOriginalExtension();

                $photoPath = public_path('assets/images/player_img/');

                !is_dir($photoPath) && mkdir($photoPath, 0777, true);

                $photo->move('assets/images/player_img/', $photoName);

                $photoUrl = "https://etechdemo.com/tennis/assets/images/player_img/" . $photoName;

                $player = new Player;

                $player->id = $id;

                $player->ita_number = $input['ita_number'];

                $player->first_name = $input['firstName'];

                $player->middle_name = $input['middleName'];

                $player->last_name = $input['lastName'];

                $player->guardian_name = $input['guardianName'];

                $player->dob = $input['dob'];

                $player->gender = $request->gender[0];

                $player->phone = $check_phone;

                $player->email = $check_email;

                $player->address_1 = $input['address_line_1'];

                $player->address_2 = $input['address_line_2'];

                $player->district = $input['district'];

                $player->pin = $input['pin'];

                $player->state = $input['state'];

                $player->country = $input['country'];

                $player->photo = $photoUrl;

                $player->register_at = $formattedDate;

                // dd($input);

                if ($player->save()) {

                    $new_player = Player::where("email", "=", $check_email)->first();

                    $fname = $new_player->first_name;

                    $mname = $new_player->middle_name;

                    $lname = $new_player->last_name;

                    $update_user = User::where('id', '=', $id)->first();
                    $username = $fname;
                    if ($mname) {
                        $username = $username . ' ' . $mname;
                    }
                    if ($lname) {
                        $username = $username . ' ' . $lname;
                    }
                    $update_user->update([
                        'name' => $username,
                        // 'name' => $fname . '' . $mname . '' . $lname,

                    ]);

                    $mail_data = [

                        "title" => "Player",

                        "first_name" => $fname,

                        "middle_name" => $mname,

                        "last_name" => $lname,

                    ];

                    Mail::to(env('MAIL_USERNAME'))->send(new RegistrationMail($mail_data));

                    $request->session()->flush();

                    Auth::logout();

                    Alert::success('Success', 'We have send your request with the admin. Once admin has approved it then you can access the dashboard!', 5000);

                    return redirect()->route('home');

                } else {

                    Alert::info('Important', 'Player data not saved.', 3500);

                    return redirect()->back();

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

    // academyRegister

    public function academyRegister()
    {

        #code...

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') === 'Academy') {

                $id = session('id');

                $role = session('role');

                // dd($id, $role);

                $query = User::select('name', 'email', 'phone')->where('id', '=', $id)->where('role', '=', $role)->first();

                $states = State::get();

                return view('pages.academy-register', ['query' => $query, 'states' => $states]);

            } else {

                Alert::info('Important', 'This page access only academy.', 3500);

                return redirect()->back();

            }

        } else {

            Alert::info('Important', 'Something want wrong.', 3500);

            return redirect()->back();

        }

    }

    // academy register function

    public function academyRegisterFun(Request $request)
    {

        #code...

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') === 'Academy') {

                $rules = [

                    'academyName' => 'required',

                    'ownerManagerName' => 'required',

                    'phone' => 'required',

                    // 'countryCode' => 'required',

                    'email' => 'required|email',

                    'courtsCount' => 'required',

                    'address' => 'required',

                    'city' => 'required',

                    'pin' => 'required',

                    'state' => 'required',

                    'hereBy' => 'required',

                    'abideTermsConditions' => 'required',

                    'disputeShall' => 'required',

                ];

                $request->validate($rules);

                $id = session('id');

                $role = session('role');

                $check_user = User::where('id', '=', $id)->where('role', '=', $role)->first();

                $user_email = $check_user->email;

                $user_phone = $check_user->phone;

                $input = $request->input();

                $date = Carbon::now();

                $formattedDate = $date->format('Y-m-d H:i:s');

                $photo = $request->file('photo');

                if ($photo !== null) {

                    $photoName = "academy_" . time() . '.' . $photo->getClientOriginalExtension();

                    $photoPath = public_path('assets/images/academy_img/');

                    !is_dir($photoPath) && mkdir($photoPath, 0777, true);

                    $photo->move('assets/images/academy_img/', $photoName);

                    $photoUrl = "https://etechdemo.com/tennis/assets/images/academy_img/" . $photoName;

                } else {

                    $photoUrl = "https://etechdemo.com/tennis/assets/images/avatar.png";

                }

                $academy = new Academy;

                $academy->id = $id;

                $academy->aita_number = $input['aita_number'];

                $academy->name = $input['academyName'];

                $academy->owner_name = $input['ownerManagerName'];

                // $academy->country_code = $input['countryCode'];

                $academy->phone = $user_phone;

                $academy->email = $user_email;

                $academy->stay = $input['stay'];

                $academy->no_of_court = $input['courtsCount'];

                $academy->hard = $input['hard'];

                $academy->clay = $input['clay'];

                $academy->grass = $input['grass'];

                $academy->address = $input['address'];

                $academy->city = $input['city'];

                $academy->pin = $input['pin'];

                $academy->state = $input['state'];

                $academy->photo = $photoUrl;

                $academy->web = $input['web'];

                $academy->geo_location = $input['geo_location'];

                $academy->register_at = $formattedDate;

                if ($academy->save()) {

                    $new_academy = Academy::where("email", "=", $user_email)->first();

                    $name = $new_academy->name;

                    $mail_data = [

                        "title" => "Academy",

                        "name" => $name,

                    ];

                    Mail::to(env('MAIL_USERNAME'))->send(new RegistrationMail($mail_data));

                    $request->session()->flush();

                    Auth::logout();

                    Alert::success('Success', 'We have send your request with the admin. Once admin has approved it then you can access the dashboard!', 5000);

                    return redirect()->route('home');

                } else {

                    Alert::info('Important', 'Player data not saved.', 3500);

                    return redirect()->back();

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

    // logout
    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        Alert::info('Success', 'Logged out successfully!', 3500);
        return redirect()->route('home');
    }

    // player/my-profile store
    public function storeMyProfile(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {
            $rules = [
                "userName" => "required",
                "firstName" => "required",
                "lastName" => "required",
                "guardianName" => "required",
                "email" => "required|email",
                "phone" => "required",
                "dob" => "required",
                "address_1" => "required",
                "address_2" => "required",
                "district" => "required",
                "pin" => "required",
                "state" => "required",
                "country" => "required",
            ];

            $request->validate($rules);

            $id = session('id');

            $query = Player::where('id', '=', $id)->update([

                'first_name' => $request->firstName,

                'middle_name' => $request->middleName,

                'last_name' => $request->lastName,

                'guardian_name' => $request->guardianName,

                'dob' => $request->dob,

                'phone' => $request->phone,

                'address_1' => $request->address_1,

                'address_2' => $request->address_2,

                'district' => $request->district,

                'pin' => $request->pin,

                'state' => $request->state,

                'ita_number' => $request->aita,

            ]);
            $username = $request->firstName;
            if ($request->middleName != null) {
                $username = $username . ' ' . $request->middleName;
            }
            if ($request->lastName != null) {
                $username = $username . ' ' . $request->lastName;
            }
            User::where('id', '=', $id)->update([
                'name' => $username,
                //'name' => $request->firstName . '' . $request->middleName . '' . $request->lastName,

            ]);

            Alert::success('Success', 'You profile have successfully updated!', 3500);

            return redirect()->route('player.dashboard');

        }

    }

    // player/changePassword store

    public function storeChangePassword(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            $rules = [

                'currentPassword' => 'required|string',

                'newPassword' => 'required|string',

            ];

            $request->validate($rules);

            $id = session('id');

            $currentPassword = $request->currentPassword;

            $newPassword = $request->newPassword;

            $checkUser = User::where('id', '=', $id)->first();

            // dd($checkUser);

            // exit;

            if ($checkUser && Hash::check($request->currentPassword, $checkUser->password)) {

                $checkUser->update([

                    'password' => $newPassword,

                ]);

                Alert::success('success', 'Password successfully updated.', 3500);

                return redirect()->back();

            } else {

                Alert::info('Important', 'Current password not matched.', 3500);

                return redirect()->back();

            }

        }

    }

    // player/uploadImages.blade.php

    public function playerUploadImagesStore(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            $rules = [

                "image" => "required",

            ];

            $request->validate($rules);

            $user_id = session('id');

            $image = $request->file('image');

            $caption = $request->caption;

            $check_player = Player::where('id', '=', $user_id)->get();

            if (count($check_player) > 0) {

                $player_id = $check_player[0]->player_id;

                $check_images = UploadPlayerImage::where('player_id', '=', $player_id)->get();

                if (count($check_images) > 9) {

                    Alert::info('Important', 'You have upload  up to 10 images!.', 3500);

                    return redirect()->back();

                } else {

                    $image_extension = $image->getClientOriginalExtension();

                    $unique_id = uniqid();

                    $image_name = "player_" . $unique_id . "_" . time() . "." . $image_extension;

                    $image_path = public_path('assets/images/player_img/');

                    !is_dir($image_path) && mkdir($image_path, 0777, true);

                    $image->move('assets/images/player_img/', $image_name);

                    $resource_url = "https://etechdemo.com/tennis/assets/images/player_img/" . $image_name;

                    $upload_image = new UploadPlayerImage;

                    $upload_image->user_id = $user_id;

                    $upload_image->player_id = $player_id;

                    $upload_image->image = $resource_url;

                    $upload_image->caption = $caption;

                    $upload_image->save();

                    Alert::success('success', 'Images successfully uploaded.', 3500);

                    return redirect()->back();

                }

            } else {

                Alert::info('Important', 'Player not available.', 3500);

                return redirect()->back();

            }

        }

    }

    // playerDeleteImagesStore

    public function playerDeleteImagesStore(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') == 'Player') {

                $image_id = $request->id;

                $player_id = $request->p_id;

                $image = UploadPlayerImage::where('upload_image_id', '=', $image_id)->where('player_id', '=', $player_id)->first();

                if (!$image) {

                    Alert::error('Error', 'Something wants error!', 3500);

                    return redirect()->back();

                }

                $image->delete();

                Alert::success('Success', 'Image has deleted!', 3500);

                return redirect()->back();

            }

        }

    }

    // player profile image update

    public function playerProfileImage(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {
            $rules = [
                "profileImage" => "required",
            ];
            $request->validate($rules);
            $id = session('id');
            $profileImage = $request->file('profileImage');
            $image_extension = $profileImage->getClientOriginalExtension();
            $unique_id = uniqid();
            $image_name = "academy_" . $unique_id . "_" . time() . "." . $image_extension;
            $image_path = public_path('assets/images/player_img/');
            !is_dir($image_path) && mkdir($image_path, 0777, true);
            $profileImage->move('assets/images/player_img/', $image_name);
            $resource_url = "https://etechdemo.com/tennis/assets/images/player_img/" . $image_name;
            $check_academy = Player::where('id', '=', $id)->first();
            if ($check_academy) {
                $check_academy->update([
                    'photo' => $resource_url,
                ]);

                Alert::success('success', 'Images updated successfully.', 3500);

                return redirect()->back();

            } else {

                Alert::info('Important', 'Player not available.', 3500);

                return redirect()->back();

            }

        }

    }

    // playerRegisterTournament
    // public function playerRegisterTournament(Request $request)
    // {
    //     if (!Session()->has('id') && !Session()->has('role')) {
    //         Alert::info('Important', 'Something went wrong.', 3500);
    //         return redirect()->back();
    //     }
    //     if (Session()->get('role') !== 'Player') {
    //         Alert::info('Important', 'This page is accessible only by players.', 3500);
    //         return redirect()->back();
    //     }
    //     $id = session('id');
    //     $get_player = Player::where('id', '=', $id)->first();

    //     if (!$get_player) {
    //         $request->session()->flush();
    //         Auth::logout();
    //         Alert::info('Information', 'Admin has not approved your account yet. Please wait until admin approval.', 3500);
    //         return redirect()->route('home');
    //     }

    //     $rules = [
    //         'tournament_id' => 'required',
    //         'category' => 'required',
    //         'subCategory' => 'required',
    //     ];
    //     $request->validate($rules);

    //     $player_id = $get_player->player_id;
    //     $player_gender = $get_player->gender;
    //     $player_dob = $get_player->dob;

    //     $date = Carbon::now()->format('Y-m-d H:i:s');

    //     $birthDate = new DateTime($player_dob);
    //     $today = new DateTime('today');
    //     $age = +$birthDate->diff($today)->y;

    //     $tournament_id = $request->input('tournament_id');
    //     $category = $request->category;
    //     $subCategory = $request->subCategory;
    //     $subCategory_array = explode(',', $subCategory);
    //     $eligible_sub_category = [];
    //     foreach ($subCategory_array as $index => $sub_cat) {
    //         // dd($index, $sub_cat);
    //         if ($age > 6 && $age < 8 && $sub_cat === 'Under 12') {
    //             array_push($eligible_sub_category, $sub_cat);
    //         }
    //         if ($age > 8 && $age < 10 && ($sub_cat === 'Under 12' || $sub_cat === 'Under 14')) {
    //             array_push($eligible_sub_category, $sub_cat);
    //         }
    //         if ($age > 10 && $age <= 12 && ($sub_cat === 'Under 12' || $sub_cat === 'Under 14' || $sub_cat === 'Under 16')) {
    //             array_push($eligible_sub_category, $sub_cat);
    //         }
    //         if ($age > 12 && $age <= 14 && ($sub_cat === 'Under 14' || $sub_cat === 'Under 16' || $sub_cat === 'Under 18')) {
    //             array_push($eligible_sub_category, $sub_cat);
    //         }
    //         if ($age > 14 && $age <= 16 && $player_gender === 'Male' && ($sub_cat === 'Under 16' || $sub_cat === 'Under 18' || $sub_cat === 'Men')) {
    //             array_push($eligible_sub_category, $sub_cat);
    //         }
    //         if ($age > 14 && $age <= 16 && $player_gender === 'Female' && ($sub_cat === 'Under 16' || $sub_cat === 'Under 18' || $sub_cat === 'Women')) {
    //             array_push($eligible_sub_category, $sub_cat);
    //         }
    //         if ($age > 16 && $age <= 18 && $player_gender === 'Male' && ($sub_cat === 'Under 18' || $sub_cat === 'Men')) {
    //             array_push($eligible_sub_category, $sub_cat);
    //         }
    //         if ($age > 16 && $age <= 18 && $player_gender === 'Female' && ($sub_cat === 'Under 18' || $sub_cat === 'Women')) {
    //             array_push($eligible_sub_category, $sub_cat);
    //         }
    //         if ($age > 18 && $player_gender === 'Male' && $sub_cat === 'Men') {
    //             array_push($eligible_sub_category, $sub_cat);
    //         }
    //         if ($age > 18 && $player_gender === 'Female' && $sub_cat === 'Women') {
    //             array_push($eligible_sub_category, $sub_cat);
    //         }
    //     }
    //     // dd($age, count($eligible_sub_category));
    //     $string_eligible_sub_category = implode(', ', $eligible_sub_category);
    //     // dd($string_eligible_sub_category);

    //     if (count($eligible_sub_category) === 0) {
    //         Alert::info('Important', 'Please select valid category.', 3500);
    //         return response()->json(['message' => 'Please select valid category.'], 409);
    //     }

    //     $is_player_register = PlayerRegisterTournament::where('tournament_id', '=', $tournament_id)
    //         ->where('player_id', '=', $player_id)->first();

    //     if ($is_player_register) {
    //         Alert::info('Important', 'You have already registered this tournament.', 3500);
    //         return response()->json(['message' => 'You have already registered for this tournament.'], 409);
    //     } else {
    //         $player_register = new PlayerRegisterTournament;
    //         $player_register->player_id = $player_id;
    //         $player_register->tournament_id = $tournament_id;
    //         $player_register->category = $category;
    //         $player_register->sub_category = $string_eligible_sub_category;
    //         $player_register->register_at = $date;

    //         if ($player_register->save()) {
    //             Alert::success('Success', "You have successfully registered this tournament.");
    //             return response()->json(['message' => "You have successfully registered this tournament."], 200);
    //         } else {
    //             return response()->json(['message' => 'Something went wrong.'], 500);
    //         }
    //     }
    // }
    public function playerRegisterTournament(Request $request)
    {
        if (!Session()->has('id') && !Session()->has('role')) {
            $request->session()->flush();
            Auth::logout();
            Alert::info('Important', 'Something went wrong.', 3500);
            return redirect()->back();
        }
        if (Session()->get('role') !== 'Player') {
            $request->session()->flush();
            Auth::logout();
            Alert::info('Important', 'This page is accessible only by players.', 3500);
            return redirect()->back();
        }
        $id = session('id');
        $get_player = Player::where('id', '=', $id)->first();

        if (!$get_player) {
            $request->session()->flush();
            Auth::logout();
            Alert::info('Information', 'Admin has not approved your account yet. Please wait until admin approval.', 3500);
            return redirect()->route('home');
        }

        $rules = [
            'tournament_id' => 'required',
            'category' => 'required',
            'subCategory' => 'required',
        ];
        $request->validate($rules);

        $player_id = $get_player->player_id;
        $player_gender = $get_player->gender;
        $player_dob = $get_player->dob;

        $date = Carbon::now()->format('Y-m-d H:i:s');

        $birthDate = new DateTime($player_dob);
        $today = new DateTime('today');
        $age = +$birthDate->diff($today)->y;

        $tournament_id = $request->input('tournament_id');
        $category = $request->category;
        $subCategory = $request->subCategory;

        $is_player_register = PlayerRegisterTournament::where('tournament_id', '=', $tournament_id)
            ->where('player_id', '=', $player_id)->first();

        if ($is_player_register) {
            Alert::info('Important', 'You have already registered this tournament.', 3500);
            return response()->json(['message' => 'You have already registered for this tournament.'], 409);
        } else {
            
           // $sub=explode(',',$subCategory);
           
          //  foreach($sub as $cat)
           // {
            $player_register = new PlayerRegisterTournament;
            $player_register->player_id = $player_id;
            $player_register->tournament_id = $tournament_id;
            $player_register->category = $category;
            $player_register->sub_category = $subCategory;
            //$player_register->sub_category = $cat;
            
            $player_register->register_at = $date;

            $player_register->drawType = "Main";
           // $player_register->save();
           // }
            if ($player_register->save()) {
                Alert::success('Success', "You have successfully registered this tournament.");
                return response()->json(['message' => "You have successfully registered this tournament."], 200);
            } else {
                return response()->json(['message' => 'Something went wrong.'], 500);
            }
        }
    }

    // player/playerEmailUpdate functionality send mail to admin
    public function playerEmailUpdate(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {
            if (Session()->get('role') === 'Player') {
                $rules = [
                    "currentEmail" => "required|email",
                    "newEmail" => "required|email",
                    "message" => "required",
                ];

                $request->validate($rules);
                $player_id = $request->player_id;
                $user_id = session('id');
                $player = Player::where('id', '=', $user_id)->where('player_id', '=', $player_id)->first();
                $player_email = $player->email;
                if ($request->currentEmail != $player_email) {
                    Alert::info('Important', 'Current email not valid');
                    return redirect()->back();
                }

                $items = [
                    "title" => "Email",
                    "type" => "Player",
                    "currentEmail" => $request->currentEmail,
                    "newEmail" => $request->newEmail,
                    "message" => $request->message,
                ];

                Mail::to(env('MAIL_USERNAME'))->send(new UpdateEmailAita($items));
                Alert::success('Success', 'Your request has been send to admin.', 3500);
                return redirect()->back();
            }
        }
    }

    // player/playerAITANumberUpdate functionality and send mail to admin

    public function playerAITANumberUpdate(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') === 'Player') {

                $rules = [

                    "currentAita" => "required",

                    "newAita" => "required",

                    "message" => "required",

                ];

                $request->validate($rules);

                $player_id = $request->player_id;

                $user_id = session('id');

                $player = Player::where('id', '=', $user_id)->where('player_id', '=', $player_id)->first();

                $player_aita = $player->ita_number;

                if ($request->currentAita != $player_aita) {

                    Alert::info('Important', 'Current aita number not valid');

                    return redirect()->back();

                }

                $items = [

                    "title" => "Aita",

                    "type" => "Player",

                    "currentAita" => $request->currentAita,

                    "newAita" => $request->newAita,

                    "message" => $request->message,

                ];

                Mail::to(env('MAIL_USERNAME'))->send(new UpdateEmailAita($items));

                Alert::success('Success', 'Your request has been send to admin.', 3500);

                return redirect()->back();

            }

        }

    }

    // player/playerWithdrawTournament functionality

    public function playerWithdrawTournament(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session('role') === 'Player') {

                $id = session('id');

                $player = Player::where('id', '=', $id)->where('publish', '=', 1)->first();

                if ($player) {
                    $rules = [
                        'tournament_id' => 'required',
                        'category' => 'required',
                    ];
                    $request->validate($rules);

                    $player_id = $player->player_id;
                    $tournament_id = $request->tournament_id;
                    $category = $request->category;

                    $check_tournament = Tournament::where('tournament_id', '=', $tournament_id)->first();

                    $tournament_last_apply_date = $check_tournament->lastDate;

                    // dd($tournament_last_apply_date);
                    $today = Carbon::now()->format('Y-m-d');

                    // dd($tournament_last_apply_date, $today);
                    // dd($today < $tournament_last_apply_date ? 'Yes' : 'No');
                    if ($today < $tournament_last_apply_date) {
                        $check_register = PlayerRegisterTournament::where('tournament_id', '=', $tournament_id)
                            ->where('player_id', '=', $player_id)
                            ->where('category', '=', $category)->first();
                        Log::info($check_register);
                        // dd($check_register);
                        if ($check_register) {
                            Log::info('inside delete');
                            $check_register->delete();
                            Alert::success('Success', 'You are withdraw to tournament!', 3500);
                            return response()->json(['message' => 'You are withdraw to tournament.'], 200);
                        } else {
                            Alert::error('Error', 'Something want error!', 3500);
                            return response()->json(['message' => 'Something want wrong.'], 200);
                        }
                    } else {

                        Alert::info('Important', 'Last date has been gone, you do not withdraw yet!', 3500);
                        return response()->json(['message' => 'Last date has been gone, you do not withdraw yet!.'], 200);

                    }

                } else {

                    $request->session()->flush();

                    Auth::logout();

                    Alert::info('Information', 'Admin Not approved now. Please wait until admin  approved!', 3500);

                    return redirect()->route('home');

                }
            }
        }
    }

    // player/playerUpcomingTournamentSearch functionality
    // public function playerUpcomingTournamentSearch(Request $request)
    // {
    //     $id = session('id');
    //     $player = Player::where('id', '=', $id)->first();
    //     $player_id = $player->player_id;
    //     $dob = $player->dob;
    //     $player_gender = $player->gender;
    //     $birthDate = new DateTime($dob);
    //     $todayDate = new DateTime('today');
    //     $age = $birthDate->diff($todayDate)->y;
    //     // dd($age);

    //     $year = $request->input('year', '');
    //     $month = $request->input('month', '');
    //     $city = $request->input('city', '');
    //     $category = $request->input('category', '');
    //     $subCategory = $request->input('subCategory', '');
    //     $stay = $request->input('stay', '');
    //     // dd($category);

    //     $tournamentsQuery = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.category', 'tournaments.subCategory', 'tournaments.surface', 'tournaments.city', 'tournaments.fromDate', 'tournaments.lastDate', 'tournaments.tournamentName', 'academies.name as academy_name')
    //         ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')
    //         ->where('tournaments.status', '!=', 'done')
    //         ->where('academies.publish', '=', 1)
    //         ->whereDate('tournaments.fromDate', '>', now()->toDateString());

    //     if ($category === 'Seniors' && $subCategory === 'Men' && $age > 18) {
    //         $tournamentsQuery->where('tournaments.category', '=', 'Seniors')->where('tournaments.subCategory', 'LIKE', '%Men%');
    //     } else if ($category === 'Women' && $age > 18) {
    //         $tournamentsQuery->where('tournaments.category', '=', 'Seniors')->where('tournaments.subCategory', 'LIKE', '%Women%');
    //     } else if ($player_gender === 'Male' && $age <= 18) {
    //         if ($age > 6 && $age < 8) {
    //             $tournamentsQuery->where('tournaments.category', '=', 'Juniors')->where('tournaments.subCategory', '=', 'Under 12');
    //         } else if ($age > 8 && $age < 10) {

    //             $tournamentsQuery->where('tournaments.category', '=', 'Juniors')->where('tournaments.subCategory', '=', 'Under 12')
    //                 ->orWhere('tournaments.subCategory', '=', 'Under 14');
    //         } else if ($age > 10 && $age < 12) {
    //             $tournamentsQuery->where('tournaments.category', '=', 'Juniors')->where('tournaments.subCategory', '=', 'Under 12')
    //                 ->orWhere('tournaments.subCategory', '=', 'Under 14')
    //                 ->orWhere('tournaments.subCategory', '=', 'Under 16');
    //         } else if ($age > 12 && $age < 14) {
    //             $tournamentsQuery->where('tournaments.category', '=', 'Juniors')->where('tournaments.subCategory', '=', 'Under 14')
    //                 ->orWhere('tournaments.subCategory', '=', 'Under 16')
    //                 ->orWhere('tournaments.subCategory', '=', 'Under 18');
    //         } else if ($age > 14 && $age < 16) {
    //             $tournamentsQuery->where('tournaments.subCategory', '=', 'Under 16')
    //                 ->orWhere('tournaments.subCategory', '=', 'Under 18')
    //                 ->orWhere('tournaments.subCategory', '=', 'Men');
    //         } else if ($age > 16 && $age <= 18) {
    //             $tournamentsQuery->where('tournaments.subCategory', '=', 'Under 18')
    //                 ->orWhere('tournaments.subCategory', '=', 'Men');
    //         }
    //     } else if ($player_gender === 'Female' && $age <= 18) {
    //         if ($age > 6 && $age < 8) {
    //             $tournamentsQuery->where('tournaments.category', '=', 'Juniors')->where('tournaments.subCategory', '=', 'Under 12');
    //         } else if ($age > 8 && $age < 10) {

    //             $tournamentsQuery->where('tournaments.category', '=', 'Juniors')->where('tournaments.subCategory', '=', 'Under 12')
    //                 ->orWhere('tournaments.subCategory', '=', 'Under 14');
    //         } else if ($age > 10 && $age < 12) {
    //             $tournamentsQuery->where('tournaments.category', '=', 'Juniors')->where('tournaments.subCategory', '=', 'Under 12')
    //                 ->orWhere('tournaments.subCategory', '=', 'Under 14')
    //                 ->orWhere('tournaments.subCategory', '=', 'Under 16');
    //         } else if ($age > 12 && $age < 14) {
    //             $tournamentsQuery->where('tournaments.category', '=', 'Juniors')->where('tournaments.subCategory', '=', 'Under 14')
    //                 ->orWhere('tournaments.subCategory', '=', 'Under 16')
    //                 ->orWhere('tournaments.subCategory', '=', 'Under 18');
    //         } else if ($age > 14 && $age < 16) {
    //             $tournamentsQuery->where('tournaments.subCategory', '=', 'Under 16')
    //                 ->orWhere('tournaments.subCategory', '=', 'Under 18')
    //                 ->orWhere('tournaments.subCategory', '=', 'Women');
    //         } else if ($age > 16 && $age <= 18) {
    //             $tournamentsQuery->where('tournaments.subCategory', '=', 'Under 18')
    //                 ->orWhere('tournaments.subCategory', '=', 'Women');
    //         }
    //     }

    //     // if ($age > 6 && $age < 8) {
    //     //     $tournamentsQuery->where('tournaments.subCategory', '=', 'Under 12');
    //     // }

    //     // if ($age > 8 && $age < 10) {
    //     //     $tournamentsQuery->where('tournaments.subCategory', '=', 'Under 12')
    //     //         ->orWhere('tournaments.subCategory', '=', 'Under 14');
    //     // }

    //     // if ($age > 10 && $age <= 12) {
    //     //     $tournamentsQuery->where('tournaments.subCategory', '=', 'Under 12')
    //     //         ->orWhere('tournaments.subCategory', '=', 'Under 14')
    //     //         ->orWhere('tournaments.subCategory', '=', 'Under 16');
    //     // }

    //     // if ($age > 12 && $age <= 14) {
    //     //     $tournamentsQuery->where('tournaments.subCategory', '=', 'Under 14')
    //     //         ->orWhere('tournaments.subCategory', '=', 'Under 16')
    //     //         ->orWhere('tournaments.subCategory', '=', 'Under 18');
    //     // }

    //     // if ($age > 14 && $age <= 16) {
    //     //     $tournamentsQuery->where('tournaments.subCategory', '=', 'Under 16')
    //     //         ->orWhere('tournaments.subCategory', '=', 'Under 18')
    //     //         ->orWhere('tournaments.subCategory', '=', 'Men')
    //     //         ->orWhere('tournaments.subCategory', '=', 'Women');
    //     // }

    //     // if ($age > 16 && $age <= 18) {
    //     //     $tournamentsQuery->where('tournaments.subCategory', '=', 'Under 18')
    //     //         ->orWhere('tournaments.subCategory', '=', 'Men')
    //     //         ->orWhere('tournaments.subCategory', '=', 'Women');
    //     // }

    //     // if ($age > 18) {
    //     //     $tournamentsQuery->where('tournaments.subCategory', '=', 'Men')
    //     //         ->orWhere('tournaments.subCategory', '=', 'Women');
    //     // }

    //     if (!empty($year)) {
    //         $tournamentsQuery->whereYear('tournaments.fromDate', '=', $year);
    //     }

    //     if (!empty($month)) {
    //         $tournamentsQuery->whereMonth('tournaments.fromDate', '=', date('m', strtotime($month)));
    //     }

    //     if (!empty($city)) {
    //         $tournamentsQuery->where('tournaments.city', '=', $city);
    //     }

    //     if (!empty($category)) {
    //         $tournamentsQuery->where('tournaments.category', '=', $category);
    //     }

    //     if (!empty($subCategory)) {
    //         //$tournamentsQuery->where('tournaments.subCategory', '=', $subCategory);
    //         $tournamentsQuery->where(function ($query) use ($subCategory) {
    //             $query->where('tournaments.subCategory', '=', $subCategory)
    //                 ->orWhere('tournaments.subCategory', 'LIKE', '%' . $subCategory . '%');
    //         });
    //     }

    //     if (!empty($stay)) {
    //         $tournamentsQuery->where('tournaments.stay', '=', $stay);
    //     }

    //     $tournaments = $tournamentsQuery->orderBy('tournaments.fromDate', 'ASC')->paginate(30);
    //     $result = [];
    //     foreach ($tournaments as $tour) {
    //         $tournament_id = $tour->tournament_id;
    //         $registered_tournaments = PlayerRegisterTournament::where('tournament_id', '=', $tournament_id)
    //             ->where('player_id', '=', $player_id)
    //             ->get();
    //         foreach ($registered_tournaments as $r_p) {
    //             $result[] = $r_p->tournament_id;
    //         }
    //     }

    //     foreach ($tournaments as $tournament) {
    //         $tournament->detail_url = route('tournamentDetail', ['id' => $tournament->tournament_id]);
    //         $tournament->withdraw_url = route('player.playerWithdrawTournament', ['id' => $tournament->tournament_id]);
    //         $tournament->register_url = route('player.playerRegisterTournament', ['id' => $tournament->tournament_id]);
    //     }

    //     return response()->json([
    //         'data' => $tournaments->items(),
    //         'is_registered' => $result,
    //         'pagination' => (string) $tournaments->links('layoutTwo.paginator'),
    //     ]);
    // }
    public function playerUpcomingTournamentSearch(Request $request)
    {
        $id = session('id');
        $player = Player::where('id', '=', $id)->first();
        $player_id = $player->player_id;
        $dob = $player->dob;
        $player_gender = $player->gender;
        $birthDate = new DateTime($dob);
        $todayDate = new DateTime('today');
        $age = $birthDate->diff($todayDate)->y;
        // dd($age);

        $year = $request->input('year', '');
        $month = $request->input('month', '');
        $city = $request->input('city', '');
        $category = $request->input('category', '');
        $subCategory = $request->input('subCategory', '');
        $stay = $request->input('stay', '');
        // dd($category);

        $tournamentsQuery = Tournament::select('tournaments.tournament_id', 'tournaments.tournamentName', 'tournaments.category', 'tournaments.subCategory', 'tournaments.surface', 'tournaments.city', 'tournaments.fromDate', 'tournaments.lastDate', 'tournaments.tournamentName', 'academies.name as academy_name')
            ->join('academies', 'tournaments.academy_id', '=', 'academies.academy_id')
            ->where('tournaments.status', '!=', 'done')
            ->where('academies.publish', '=', 1)
            ->whereDate('tournaments.fromDate', '>', now()->toDateString());

        if (!empty($year)) {
            $tournamentsQuery->whereYear('tournaments.fromDate', '=', $year);
        }

        if (!empty($month)) {
            $tournamentsQuery->whereMonth('tournaments.fromDate', '=', date('m', strtotime($month)));
        }

        if (!empty($city)) {
            $tournamentsQuery->where('tournaments.city', '=', $city);
        }

        if (!empty($category)) {
            $tournamentsQuery->where('tournaments.category', '=', $category);
        }

        if (!empty($subCategory)) {
            $tournamentsQuery->where(function ($query) use ($subCategory) {
                $query->where('tournaments.subCategory', '=', $subCategory)
                    ->orWhere('tournaments.subCategory', 'LIKE', '%' . $subCategory . '%');
            });
        }

        if (!empty($stay)) {
            $tournamentsQuery->where('tournaments.stay', '=', $stay);
        }

        $tournaments = $tournamentsQuery->orderBy('tournaments.fromDate', 'ASC')->paginate(30);
        $result = [];
        foreach ($tournaments as $tour) {
            $tournament_id = $tour->tournament_id;
            $registered_tournaments = PlayerRegisterTournament::where('tournament_id', '=', $tournament_id)
                ->where('player_id', '=', $player_id)
                ->get();
            foreach ($registered_tournaments as $r_p) {
                $result[] = $r_p->tournament_id;
            }
        }

        foreach ($tournaments as $tournament) {
            $tournament->detail_url = route('tournamentDetail', ['id' => $tournament->tournament_id]);
            $tournament->withdraw_url = route('player.playerWithdrawTournament', ['id' => $tournament->tournament_id]);
            $tournament->register_url = route('player.playerRegisterTournament', ['id' => $tournament->tournament_id]);
        }

        return response()->json([
            'data' => $tournaments->items(),
            'is_registered' => $result,
            'pagination' => (string) $tournaments->links('layoutTwo.paginator'),
        ]);
    }

    // academy/myProfile.blade.php

    public function storeAcademyProfile(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {
            if (Session()->get('role') === 'Academy') {
                $rules = [
                    "name" => "required",
                    "owner_name" => "required",

                    "email" => "required",
                    "phone" => "required",

                    "no_of_courts" => "required",

                    "address" => "required",

                    "city" => "required",

                    "pin" => "required",

                    "state" => "required",

                ];
                try {
                    $request->validate($rules);
                    Log::info('Validation passed.');
                } catch (ValidationException $e) {
                    Log::error('Errors:', $e->errors());
                    return redirect()->back();
                }

                $id = session('id');

                $academy_id = $request->academy_id;

                $check_academy = Academy::where('id', '=', $id)

                    ->where('email', '=', $request->email)

                    ->where('academy_id', '=', $academy_id)->get();

                if (count($check_academy) > 0) {

                    Academy::where('id', '=', $id)->where('email', '=', $request->email)->update([

                        "name" => $request->name,

                        "owner_name" => $request->owner_name,
                        "phone" => $request->phone,

                        "no_of_court" => $request->no_of_courts,

                        "hard" => $request->hard,

                        "clay" => $request->clay,

                        "grass" => $request->grass,

                        "address" => $request->address,

                        "city" => $request->city,

                        "pin" => $request->pin,

                        "state" => $request->state,

                        "stay" => $request->stay,
                        "aita_number" => $request->aita,
                        "web" => $request->web,
                        "geo_location" => $request->geo_location,
                        "aboutAcademy" => $request->aboutAcademy,
                        "aboutDescription" => $request->aboutDescription,
                        "our_team" => $request->ourTeam,
                        "training_programmes" => $request->trainingProgrammes,
                        "our_achievements" => $request->ourAchievements,
                    ]);

                    User::where('id', '=', $id)->update([
                        'name' => $request->name,
                    ]);

                    Alert::success('Success', 'You profile have successfully updated!', 3500);

                    return redirect()->route('academy.dashboard');

                } else {

                    Alert::info('Important', 'Academy not available.', 3500);

                    return redirect()->back();

                }

            } else {

                Alert::info('Important', 'This resource access only academy.', 3500);

                return redirect()->back();

            }

        } else {

            Alert::info('Important', 'Something want error.', 3500);

            return redirect()->back();

        }

    }

    // academy/changePassword.blade.php

    public function storeAcademyChangePassword(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            $rules = [

                'currentPassword' => 'required|string',

                'newPassword' => 'required|string',

            ];

            $request->validate($rules);

            $id = session('id');

            $currentPassword = $request->currentPassword;

            $newPassword = $request->newPassword;

            $checkUser = User::where('id', '=', $id)->first();

            if ($checkUser && Hash::check($request->currentPassword, $checkUser->password)) {

                $checkUser->update([

                    'password' => $newPassword,

                ]);

                Alert::success('success', 'Password successfully updated.', 3500);

                return redirect()->back();

            } else {

                Alert::info('Important', 'Current password not matched.', 3500);

                return redirect()->back();

            }

        }

    }

    // academy/uploadImages.blade.php

    public function uploadImages(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            $rules = [

                "image" => "required",

            ];

            $request->validate($rules);

            $user_id = session('id');

            $images = $request->file('image');

            $caption = $request->caption;

            $check_academy = Academy::where('id', '=', $user_id)->get();

            if (count($check_academy) > 0) {

                $academy_id = $check_academy[0]->academy_id;

                $check_academy_images = UploadAcademyImage::where('academy_id', '=', $academy_id)->get();

                if (count($check_academy_images) > 9) {

                    Alert::info('Important', 'You have upload  up to 10 images!.', 3500);

                    return redirect()->back();

                } else {

                    $image_extension = $images->getClientOriginalExtension();

                    $unique_id = uniqid();

                    $image_name = "academy_" . $unique_id . "_" . time() . "." . $image_extension;

                    $image_path = public_path('assets/images/academy_img/');

                    !is_dir($image_path) && mkdir($image_path, 0777, true);

                    $images->move('assets/images/academy_img/', $image_name);

                    $resource_url = "https://etechdemo.com/tennis/assets/images/academy_img/" . $image_name;

                    $upload_image = new UploadAcademyImage;

                    $upload_image->user_id = $user_id;

                    $upload_image->academy_id = $academy_id;

                    $upload_image->image = $resource_url;

                    $upload_image->caption = $caption;

                    $upload_image->save();

                    Alert::success('success', 'Images successfully uploaded.', 3500);

                    return redirect()->back();

                }

            } else {

                Alert::info('Important', 'Academy not available.', 3500);

                return redirect()->back();

            }

        }

    }

    // academyDeleteImages

    public function academyDeleteImages(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') === "Academy") {

                $id = $request->id;

                $academy_id = $request->a_id;

                $check_image = UploadAcademyImage::where('upload_academy_images_id', '=', $id)->where('academy_id', '=', $academy_id)->first();

                if (!$check_image) {

                    Alert::info('Important', 'Image is not available.', 3500);

                    return redirect()->back();

                }

                $check_image->delete();

                Alert::success('success', 'Image deleted successfully!.', 3500);

                return redirect()->back();

            }

        }

    }

    // academy profile image update

    public function academyProfileImage(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            $rules = [

                "profileImage" => "required",

            ];

            $request->validate($rules);

            $id = session('id');

            $profileImage = $request->file('profileImage');

            $image_extension = $profileImage->getClientOriginalExtension();

            $unique_id = uniqid();

            $image_name = "academy_" . $unique_id . "_" . time() . "." . $image_extension;

            $image_path = public_path('assets/images/academy_img/');

            !is_dir($image_path) && mkdir($image_path, 0777, true);

            $profileImage->move('assets/images/academy_img/', $image_name);

            $resource_url = "https://etechdemo.com/tennis/assets/images/academy_img/" . $image_name;

            $check_academy = Academy::where('id', '=', $id)->first();

            if ($check_academy) {

                $check_academy->update([

                    'photo' => $resource_url,

                ]);

                Alert::success('success', 'Images updated successfully.', 3500);

                return redirect()->back();

            } else {

                Alert::info('Important', 'Academy not available.', 3500);

                return redirect()->back();

            }

        }

    }

    // academy/createTournament.blade.php

    public function storeTournament(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') === 'Academy') {

                $rules = [

                    "tournamentCategory" => "required",

                    "tournamentName" => "required",

                    "academyName" => "required",

                    "category" => "required",

                    "subCategory.*" => "required",

                    "surface" => "required",

                    "city" => "required",

                    "date" => "required",

                    'stay' => 'required',

                ];

                $request->validate($rules);

                $id = session('id');

                $date = Carbon::now()->format('Y-m-d H:i:s');

                $academy = Academy::where('id', '=', $id)->first();

                $academy_id = $academy->academy_id;

                $sub_category = implode(',', $request->subCategory);

                // dd($sub_category);

                $tournament_img = $request->file('imageOne');

                $tournament_img_two = $request->file('imageTwo');

                $tournament_img_three = $request->file('imageThree');

                $factsheet = $request->file('factsheet');

                if ($tournament_img !== null) {

                    $image_extension = $tournament_img->getClientOriginalExtension();

                    $unique_id = uniqid();

                    $image_name = "tournament_" . $unique_id . "_" . time() . "." . $image_extension;

                    $image_path = public_path('assets/images/tournament_img/');

                    !is_dir($image_path) && mkdir($image_path, 0777, true);

                    $tournament_img->move('assets/images/tournament_img/', $image_name);

                    $tournament_img_one_url = "https://etechdemo.com/tennis/assets/images/tournament_img/" . $image_name;

                } else {

                    $tournament_img_one_url = "https://etechdemo.com/tennis/assets/images/avb_academy.jpg";

                }

                if ($tournament_img_two !== null) {

                    $image_two_extension = $tournament_img_two->getClientOriginalExtension();

                    $unique_id_two = uniqid();

                    $image_two_name = "tournament_" . $unique_id_two . "_" . time() . "." . $image_two_extension;

                    $image_two_path = public_path('assets/images/tournament_img/');

                    !is_dir($image_two_path) && mkdir($image_two_path, 0777, true);

                    $tournament_img_two->move('assets/images/tournament_img/', $image_two_name);

                    $tournament_img_two_url = "https://etechdemo.com/tennis/assets/images/tournament_img/" . $image_two_name;

                } else {

                    $tournament_img_two_url = null;

                }

                if ($tournament_img_three !== null) {

                    $image_three_extension = $tournament_img_three->getClientOriginalExtension();

                    $unique_id_three = uniqid();

                    $image_three_name = "tournament_" . $unique_id_three . "_" . time() . "." . $image_three_extension;

                    $image_three_path = public_path('assets/images/tournament_img/');

                    !is_dir($image_three_path) && mkdir($image_three_path, 0777, true);

                    $tournament_img_three->move('assets/images/tournament_img/', $image_three_name);

                    $tournament_img_three_url = "https://etechdemo.com/tennis/assets/images/tournament_img/" . $image_three_name;

                } else {

                    $tournament_img_three_url = null;

                }

                if ($factsheet !== null) {

                    $factsheet_extension = $factsheet->getClientOriginalExtension();

                    $unique_id_fact = uniqid();

                    $factsheet_name = "tournament_" . $unique_id_fact . "_" . time() . "." . $factsheet_extension;

                    $factsheet_path = public_path('assets/images/factsheet/');

                    !is_dir($factsheet_path) && mkdir($factsheet_path, 0777, true);

                    $factsheet->move('assets/images/factsheet/', $factsheet_name);

                    $factsheet_url = "https://etechdemo.com/tennis/assets/images/factsheet/" . $factsheet_name;

                } else {

                    $factsheet_url = null;

                }

                // dd($tournament_img_one_url, $tournament_img_two_url, $tournament_img_three_url);

                try {

                    $tournament = new Tournament;

                    $tournament->tournamentCategory = $request->tournamentCategory;

                    $tournament->tournamentName = $request->tournamentName;

                    $tournament->academy_id = $academy_id;

                    $tournament->category = $request->category;

                    $tournament->subCategory = $sub_category;

                    $tournament->surface = $request->surface;

                    $tournament->city = $request->city;

                    $tournament->fromDate = $request->date;

                    $tournament->toDate = $request->toDate;

                    $tournament->lastDate = $request->lastDate;

                    $tournament->stay = $request->stay;

                    $tournament->price = $request->price;

                    $tournament->whatsapp = $request->whatsapp;

                    $tournament->imageOne = $tournament_img_one_url;

                    $tournament->captionOne = $request->captionOne;

                    $tournament->imageTwo = $tournament_img_two_url;

                    $tournament->captionTwo = $request->captionTwo;

                    $tournament->imageThree = $tournament_img_three_url;

                    $tournament->captionThree = $request->captionThree;

                    $tournament->factsheet = $factsheet_url;

                    $tournament->added_at = $date;

                    if ($tournament->save()) {

                        Alert::success('Success', 'Tournament successfully registered!', 3500);

                        return redirect()->route('academy.tournaments');

                    }

                } catch (Exception $e) {

                    Alert::error('Error', 'Tournament not registered!', 3500);

                    return redirect()->back();

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

    // academy approved player

    public function approvedPlayer(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') == 'Academy') {

                $register_id = $request->id;

                $check_player_register = PlayerRegisterTournament::find($register_id);

                if (!$check_player_register) {

                    Alert::info("Information", "Registration not available there!");

                    return redirect()->back();

                }

                $check_player_register->update([

                    'status' => "approved",

                ]);

                // dd($check_player_register);

                Alert::success('Success', 'Player status updated!');

                return redirect()->back();

            } else {

                Alert::info('Information', 'Page access only academy!', 3500);

                return redirect()->back();

            }

        } else {

            Alert::info('Information', 'Something wants wrong!', 3500);

            return redirect()->back();

        }

    }
    //academy dissapprove player
    public function dissapprovePlayer(Request $request)
    {

        if (Session()->has('id') && Session()->has('role')) {

            if (Session()->get('role') == 'Academy') {

                $register_id = $request->id;

                $check_player_register = PlayerRegisterTournament::find($register_id);

                if (!$check_player_register) {

                    Alert::info("Information", "Registration not available there!");

                    return redirect()->back();

                }

                $check_player_register->update([

                    'status' => "unapprove",

                ]);

                // dd($check_player_register);

                Alert::success('Success', 'Player status updated!');

                return redirect()->back();

            } else {

                Alert::info('Information', 'Page access only academy!', 3500);

                return redirect()->back();

            }

        } else {

            Alert::info('Information', 'Something wants wrong!', 3500);

            return redirect()->back();

        }

    }
    // academy/tournamentImages.blade.php

    public function storeTournamentImage(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {
            if (Session()->get('role') == 'Academy') {
                $rules = [
                    'tournamentImage' => 'required',
                ];
                $request->validate($rules);

                $tournament_id = $request->id;
                $image = TournamentImage::where('tournament_id', '=', $tournament_id)->get();
                if (count($image) > 9) {
                    Alert::info("Important", "You have upload only 10 images!", 3500);
                    return redirect()->back();
                } else {
                    $date = Carbon::now()->format('Y-m-d H:i:s');
                    $tournament_img = $request->file('tournamentImage');
                    $image_extension = $tournament_img->getClientOriginalExtension();
                    $unique_id = uniqid();
                    $image_name = "tournament_" . $unique_id . "_" . time() . "." . $image_extension;
                    $image_path = public_path('assets/images/tournament_img/');
                    !is_dir($image_path) && mkdir($image_path, 0777, true);
                    $tournament_img->move('assets/images/tournament_img/', $image_name);
                    $tournament_url = "https://etechdemo.com/tennis/assets/images/tournament_img/" . $image_name;
                    $tournament_img = new TournamentImage;
                    $tournament_img->image = $tournament_url;
                    $tournament_img->tournament_id = $tournament_id;
                    $tournament_img->added_at = $date;
                    if ($tournament_img->save()) {
                        Alert::success('Success', 'Image added successfully!', 3500);
                        return redirect()->back();
                    } else {
                        Alert::error('Error', 'Something wants wrong!', 3500);
                        return redirect()->back();
                    }
                }
            }
        }
    }

    // academy/editTournament.blade.php
    public function storeEditTournament(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {
            if (Session()->get('role') === 'Academy') {
                $rules = [
                    "academyName" => "required",
                    "category" => "required",
                    "subCategory.*" => "required",
                    "surface" => "required",
                    "city" => "required",
                    "date" => "required",
                    'stay' => 'required',
                ];

                $request->validate($rules);
                $id = session('id');

                $tournament_id = $request->id;

                $date = Carbon::now()->format('Y-m-d H:i:s');

                $sub_category = implode(',', $request->subCategory);

                // dd($sub_category);

                $tournament_img = $request->file('imageOne');

                $tournament_img_two = $request->file('imageTwo');

                $tournament_img_three = $request->file('imageThree');

                $factsheet = $request->file('factsheet');

                if ($tournament_img !== null) {

                    $image_extension = $tournament_img->getClientOriginalExtension();

                    $unique_id = uniqid();

                    $image_name = "tournament_" . $unique_id . "_" . time() . "." . $image_extension;

                    $image_path = public_path('assets/images/tournament_img/');

                    !is_dir($image_path) && mkdir($image_path, 0777, true);

                    $tournament_img->move('assets/images/tournament_img/', $image_name);

                    $tournament_img_one_url = "https://etechdemo.com/tennis/assets/images/tournament_img/" . $image_name;

                } else {

                    $tournament_img_one_url = "https://etechdemo.com/tennis/assets/images/avb_academy.jpg";

                }

                if ($tournament_img_two !== null) {

                    $image_two_extension = $tournament_img_two->getClientOriginalExtension();

                    $unique_id_two = uniqid();

                    $image_two_name = "tournament_" . $unique_id_two . "_" . time() . "." . $image_two_extension;

                    $image_two_path = public_path('assets/images/tournament_img/');

                    !is_dir($image_two_path) && mkdir($image_two_path, 0777, true);

                    $tournament_img_two->move('assets/images/tournament_img/', $image_two_name);

                    $tournament_img_two_url = "https://etechdemo.com/tennis/assets/images/tournament_img/" . $image_two_name;

                } else {

                    $tournament_img_two_url = null;

                }

                if ($tournament_img_three !== null) {

                    $image_three_extension = $tournament_img_three->getClientOriginalExtension();

                    $unique_id_three = uniqid();

                    $image_three_name = "tournament_" . $unique_id_three . "_" . time() . "." . $image_three_extension;

                    $image_three_path = public_path('assets/images/tournament_img/');

                    !is_dir($image_three_path) && mkdir($image_three_path, 0777, true);

                    $tournament_img_three->move('assets/images/tournament_img/', $image_three_name);

                    $tournament_img_three_url = "https://etechdemo.com/tennis/assets/images/tournament_img/" . $image_three_name;

                } else {

                    $tournament_img_three_url = null;

                }

                if ($factsheet !== null) {

                    $factsheet_extension = $factsheet->getClientOriginalExtension();

                    $unique_id_fact = uniqid();

                    $factsheet_name = "tournament_" . $unique_id_fact . "_" . time() . "." . $factsheet_extension;

                    $factsheet_path = public_path('assets/images/factsheet/');

                    !is_dir($factsheet_path) && mkdir($factsheet_path, 0777, true);

                    $factsheet->move('assets/images/factsheet/', $factsheet_name);

                    $factsheet_url = "https://etechdemo.com/tennis/assets/images/factsheet/" . $factsheet_name;

                } else {

                    $factsheet_url = null;

                }

                $tournament = Tournament::where('tournament_id', '=', $tournament_id)->first();

                $tournament->update([

                    "tournamentCategory" => $request->tournamentCategory,

                    "tournamentName" => $request->tournamentName,

                    "category" => $request->category,

                    "subCategory" => $sub_category,

                    "surface" => $request->surface,

                    "city" => $request->city,

                    "fromDate" => $request->date,

                    "toDate" => $request->toDate,

                    "lastDate" => $request->lastDate,

                    "stay" => $request->stay,

                    "price" => $request->price,

                    "whatsapp" => $request->whatsapp,

                    "imageOne" => $tournament_img_one_url,

                    "captionOne" => $request->captionOne,

                    "imageTwo" => $tournament_img_two_url,

                    "captionTwo" => $request->captionTwo,

                    "imageThree" => $tournament_img_three_url,

                    "captionThree" => $request->captionThree,

                    "factsheet" => $factsheet_url,

                    "edited_at" => $date,

                ]);

                try {

                    Alert::success('Success', 'Tournament updated successfully!', 3500);

                    return redirect()->route('academy.tournaments');

                } catch (Exception $e) {

                    Alert::error('Error', 'Tournament not updated!', 3500);

                    return redirect()->back();

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

    // academy/academyEmailUpdate functionality send mail to admin

    public function academyEmailUpdate(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {
            if (Session()->get('role') === 'Academy') {
                $rules = [
                    "currentEmail" => "required|email",
                    "newEmail" => "required|email",
                    "message" => "required",
                ];

                $request->validate($rules);
                $academy_id = $request->academy_id;
                $user_id = session('id');
                $academy = Academy::where('id', '=', $user_id)->where('academy_id', '=', $academy_id)->first();
                $academy_email = $academy->email;
                if ($request->currentEmail != $academy_email) {
                    Alert::info('Important', 'Current email not valid');
                    return redirect()->back();
                }

                $items = [
                    "title" => "Email",
                    "type" => "Academy",
                    "currentEmail" => $request->currentEmail,
                    "newEmail" => $request->newEmail,
                    "message" => $request->message,
                ];

                Mail::to(env('MAIL_USERNAME'))->send(new UpdateEmailAita($items));
                Alert::success('Success', 'Your request has been send to admin.', 3500);
                return redirect()->back();
            }
        }
    }

    // academy/academyAITANumberUpdate functionality and send mail to admin

    public function academyAITANumberUpdate(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {
            if (Session()->get('role') === 'Academy') {
                $rules = [
                    "currentAita" => "required",
                    "newAita" => "required",
                    "message" => "required",
                ];
                $request->validate($rules);
                $academy_id = $request->academy_id;
                $user_id = session('id');
                $academy = Academy::where('id', '=', $user_id)->where('academy_id', '=', $academy_id)->first();
                $academy_aita = $academy->aita_number;
                if ($request->currentAita != $academy_aita) {
                    Alert::info('Important', 'Current aita number not valid');
                    return redirect()->back();
                }

                $items = [
                    "title" => "Aita",
                    "type" => "Academy",
                    "currentAita" => $request->currentAita,
                    "newAita" => $request->newAita,
                    "message" => $request->message,
                ];

                Mail::to(env('MAIL_USERNAME'))->send(new UpdateEmailAita($items));
                Alert::success('Success', 'Your request has been send to admin.', 3500);
                return redirect()->back();
            }
        }
    }

    // academy/playerRegisterByAcademy functionality
    public function playerRegisterByAcademy(Request $request)
    {
        if (Session()->has('id') && Session()->has('role')) {
            if (Session()->get('role') === 'Academy') {
                $rules = [
                    "tournament_id" => "required",
                    "name" => "required",
                    "dob" => "required",
                    "state" => "required",
                    "category" => "required",
                ];
                $request->validate($rules);
                // dd($request->all());

                $id = session('id');
                $academy = Academy::where('id', '=', $id)->first();
                $academy_id = $academy->academy_id;
                $date = Carbon::now()->format('Y-m-d H:i:s');
                $manual_register = new ManualRegister;
                $manual_register->academy_id = $academy_id;
                $manual_register->tournament_id = $request->tournament_id;
                $manual_register->name = $request->name;
                $manual_register->category = $request->category;
                $manual_register->gender = $request->category === "Seniors" ? ($request->subCategories[0] === "Men" ? "Male" : "Female") : $request->gender;
                $manual_register->dob = $request->dob;
                $manual_register->aita_number = $request->aita_number;
                $manual_register->rank = $request->rank_number;
                $manual_register->state = $request->state;
                $manual_register->register_at = $date;
                $playersubcat = implode(',', $request->subCategories);
                $manual_register->sub_category = $playersubcat;

                $manual_register->drawType = "Main";
                if ($manual_register->save()) {
                    Alert::success("Success", "congratulations, New player registered with us!", 3500);
                    return redirect()->back();
                } else {
                    Alert::info("Important", "Something want error!", 3500);
                    return redirect()->back();
                }
            }
        }
    }

    // academy/academy.academyDeleteTournament
    public function academyDeleteTournament(Request $request)
    {
        $id = session('id');
        $tournament_id = $request->id;
        $is_academy = Academy::where('id', '=', $id)->first();
        if ($is_academy) {
            $academy_id = $is_academy->academy_id;
            $isTournament = Tournament::where('tournament_id', '=', $tournament_id)->where('academy_id', '=', $academy_id)->first();
            // dd($isTournament);
            if ($isTournament) {
                $isTournament->delete();
                Alert::success("Success", "Tournament deleted successfully!");
                return redirect()->back();
            } else {
                Alert::info("Important", "Something want wrong!");
                return redirect()->back();
            }
        }
    }

}
