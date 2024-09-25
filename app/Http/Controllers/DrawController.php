<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Draw;
use App\Models\DrawPlayerTournament;
use App\Models\InterimDraw;
use App\Models\InterimDrawPlayerTournament;
use App\Models\ManualRegister;
use App\Models\MatchModel;
use App\Models\Player;
use App\Models\PlayerRegisterTournament;
use App\Models\QualifyMatch;
use App\Models\Rank;
use App\Models\Round;
use App\Models\Tournament;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class DrawController extends Controller
{
    // tournamentDetail.blade.php check draw is created or not
    public function hasDraw(Request $request)
    {
        if ($request->ajax()) {
            if (!session()->has('id') || !session()->has('role')) {
                $request->session()->flush();
                Auth::logout();
                Alert::info('Information', 'Something wants wrong!', 3500);
                return redirect()->route('home');
            }
            $tournament_id = (int) $request->tournament_id;
            $subCategory_str = $request->subCategory;
            // dd($tournament_id, $subCategory_str);
            $is_draw = Draw::select('draw.draw_id', 'draw.tournament_id', 'interim_draw.id', 'interim_draw.subCategory', 'interim_draw.player_num', 'interim_draw.draw_type', 'interim_draw.gender')
                ->leftJoin('interim_draw', 'draw.interim_draw_id', '=', 'interim_draw.id')
                ->where('draw.tournament_id', '=', $tournament_id)
                ->get();
            return response()->json(['is_draw' => $is_draw]);
        }
    }

    // tournamentDetail.blade.php click any category button check type of draw
    public function checkTypeOfDraw(Request $request)
    {
        if ($request->ajax()) {
            if (!session()->has('id') || !session()->has('role')) {
                $request->session()->flush();
                Auth::logout();
                Alert::info('Information', 'Something wants wrong!', 3500);
                return redirect()->route('home');
            }
            $tournament_id = (int) $request->tournament_id;
            $subCategory = $request->subCategory;
            $draw_id = (int) $request->draw_id;
            $interim_draw_id = (int) $request->interim_draw_id;
            $gender = $request->gender;
            // dd($request->all());

            $check_type_draw = Draw::select('interim_draw.id', 'interim_draw.draw_type', 'interim_draw.gender', 'interim_draw.subCategory', 'draw.draw_id')
                ->leftJoin('interim_draw', function ($join) use ($gender) {
                    $join->on('draw.interim_draw_id', '=', 'interim_draw.id');
                    $join->where('interim_draw.gender', '=', $gender);
                })
                ->where('draw.draw_id', '=', $draw_id)
                ->get();
            // dd($check_type_draw);

            return response()->json(['check_draw_type' => $check_type_draw]);
        }
    }

    // tournamentDetail.blade.php clicked Main or Qualify draw button show draw data
    public function fetchDrawData(Request $request)
    {
        if ($request->ajax()) {
            if (!session()->has('id') || !session()->has('role')) {
                $request->session()->flush();
                Auth::logout();
                Alert::info('Information', 'Something wants wrong!', 3500);
                return redirect()->route('home');
            }

            $draw_id = (int) $request->draw_id;
            $gender = $request->gender;
            $subCategory = $request->subCategory;
            $draw_type = $request->draw_type;
            $interim_draw_id = (int) $request->interim_draw_id;
            // dd($draw_id, $gender, $subCategory, $draw_type, $interim_draw_id);

            $show_draw = DB::table('draw')
                ->distinct()
                ->select('draw.draw_id', 'draw.player_num', 'dpt.by', 'dpt.player_id', 'dpt.seed', 'interim_draw.id', 'interim_draw.subCategory', 'interim_draw.gender', 'interim_draw.draw_type')
                ->leftJoin('draw_players_tournament as dpt', function ($join) {
                    $join->on('draw.draw_id', '=', 'dpt.draw_id');
                })
                ->leftJoin('interim_draw', function ($join) use ($interim_draw_id) {
                    $join->on('draw.interim_draw_id', '=', 'interim_draw.id')
                        ->where('interim_draw.id', '=', $interim_draw_id);
                })
                ->where('draw.draw_id', '=', $draw_id)
                ->get();

            foreach ($show_draw as $index => $data) {
                $player_id = $data->player_id;
                $idi = $data->id;
                $show_player_data = InterimDrawPlayerTournament::select('interim_draw_players_tournament.player_name', 'interim_draw_players_tournament.rank', 'interim_draw_players_tournament.aita_number', 'interim_draw_players_tournament.dob')
                    ->where('interim_draw_id', '=', $idi)
                    ->where('player_id', '=', $player_id)
                    ->first();

                // dd(strpos($player_id, 'p_'));
                $player_state = '';
                if (strpos($player_id, 'p_') === 0) {
                    $player_id_explode = explode('_', $player_id);
                    $u_player_id = $player_id_explode = $player_id_explode[1];
                    // dd($u_player_id);
                    $players = Player::select('states.abbreviation as state')
                        ->leftJoin('states', 'players.state', '=', 'states.name')
                        ->where('player_id', '=', $u_player_id)
                        ->first();
                    $player_state = $players->state;
                    // dd($player_state);
                }
                if (strpos($player_id, 'm_') === 0) {
                    $player_id_explode = explode('_', $player_id);
                    $u_player_id = $player_id_explode = $player_id_explode[1];
                    $players = ManualRegister::select('state')
                        ->where('manual_register_id', '=', $player_id)->first();
                    $player_state = $players->state;
                }

                $check_rounds = Round::where('draw_id', '=', $draw_id)->where('player_id', '=', $player_id)->first();

                $result[] = [
                    'player_id' => $player_id,
                    'interim_draw_id' => $idi,
                    'player_name' => $show_player_data->player_name,
                    'rank' => $show_player_data->rank,
                    'aita_number' => $show_player_data->aita_number,
                    'dob' => $show_player_data->dob,
                    'draw_id' => $data->draw_id,
                    'player_num' => $data->player_num,
                    'bye' => $data->by,
                    'seed' => $data->seed,
                    'subCategory' => $data->subCategory,
                    'gender' => $data->gender,
                    'state' => $player_state,
                    'draw_type' => $data->draw_type,
                    'roundOne' => $check_rounds->roundOne,
                    'roundTwo' => $check_rounds->roundTwo,
                    'roundThree' => $check_rounds->roundThree,
                    'roundFour' => $check_rounds->roundFour,
                    'roundFive' => $check_rounds->roundFive,
                    'roundSix' => $check_rounds->roundSix,
                    'semifinal' => $check_rounds->semifinal,
                    'final' => $check_rounds->final,
                ];
            }

            return response()->json(['show_draw' => $result]);
        }
    }

    // academy/showRegisteredPlayerData.blade.php form submit functionality
    public function fetchRegisteredPlayerDataOnTournament(Request $request)
    {
        if ($request->ajax()) {
            try {
                $user_id = Session('id');
                $get_academy = Academy::where('id', '=', $user_id)->where('publish', '=', 1)->first();
                if ($get_academy) {
                    $academy_id = (int) $get_academy->academy_id;
                    $tournament_id = (int) $request->tournament_id;
                    if ($tournament_id) {
                        // dd($academy_id, $tournament_id);
                        $portal_registered_players = PlayerRegisterTournament::select('player_register_tournament.category as player_register_tournament_category', 'player_register_tournament.sub_category as player_register_tournament_sub_category', 'tournaments.tournamentName', 'tournaments.tournament_id', 'tournaments.category', 'tournaments.subCategory', 'players.first_name', 'players.middle_name', 'players.last_name', 'players.player_id', 'players.dob', 'players.ita_number', 'players.gender', 'ranking.rank')
                            ->leftJoin('tournaments', 'player_register_tournament.tournament_id', '=', 'tournaments.tournament_id')
                            ->leftJoin('players', 'player_register_tournament.player_id', '=', 'players.player_id')
                            ->leftJoin('ranking', 'players.ita_number', '=', 'ranking.aita_number')
                            ->where('player_register_tournament.tournament_id', '=', $tournament_id)
                            ->where('player_register_tournament.status', '=', 'approved')
                            ->get();

                        // Manual Registered Players
                        $manual_registered_player = ManualRegister::where('academy_id', '=', $academy_id)
                            ->where('tournament_id', '=', $tournament_id)
                            ->get();

                        // Tournaments
                        $tournaments = Tournament::where('tournament_id', '=', $tournament_id)
                            ->first();

                        return response()->json([
                            'tournaments' => $tournaments,
                            'portal_registered_players' => $portal_registered_players,
                            'manual_registered_player' => $manual_registered_player,
                        ]);

                    } else {
                        $portal_registered_players = PlayerRegisterTournament::select('player_register_tournament.category as player_register_tournament_category', 'player_register_tournament.sub_category as player_register_tournament_sub_category', 'tournaments.tournamentName', 'tournaments.tournament_id', 'tournaments.category', 'tournaments.subCategory', 'players.first_name', 'players.middle_name', 'players.last_name', 'players.player_id', 'players.dob', 'players.ita_number', 'players.gender', 'ranking.rank')
                            ->leftJoin('tournaments', 'player_register_tournament.tournament_id', '=', 'tournaments.tournament_id')
                            ->leftJoin('players', 'player_register_tournament.player_id', '=', 'players.player_id')
                            ->leftJoin('ranking', 'players.ita_number', '=', 'ranking.aita_number')
                            ->where('tournaments.academy_id', '=', $academy_id)
                            ->where('player_register_tournament.status', '=', 'approved')
                            ->get();

                        $manual_registered_player = ManualRegister::where('academy_id', '=', $academy_id)
                            ->get();

                        return response()->json([
                            'portal_registered_players' => $portal_registered_players,
                            'manual_registered_player' => $manual_registered_player,
                        ]);
                    }
                }
            } catch (Exception $e) {
                Log::error('Error category tournament result not found:', ['error' => $e->getMessage()]);
                return response()->json(['error' => 'Server Error'], 500);
            }
        }
    }

/*
// academy/showRegisteredPlayerData.blade.php form submit functionality
public function fetchRegisteredPlayerDataOnTournament(Request $request)
{
if ($request->ajax()) {
try {
$user_id = Session('id');
$get_academy = Academy::where('id', '=', $user_id)->where('publish', '=', 1)->first();
if ($get_academy) {
$academy_id = (int) $get_academy->academy_id;
$tournament_id = (int) $request->tournament_id;

if ($tournament_id) {
// dd($academy_id, $tournament_id);
//new change 23-08
$portal_registered_players = PlayerRegisterTournament::select('player_register_tournament.category as player_register_tournament_category', 'player_register_tournament.sub_category as player_register_tournament_sub_category', 'tournaments.tournamentName', 'tournaments.tournament_id', 'tournaments.category', 'tournaments.subCategory', 'players.first_name', 'players.middle_name', 'players.last_name', 'players.player_id', 'players.dob', 'players.ita_number', 'players.gender', 'ranking.rank')
->leftJoin('tournaments', 'player_register_tournament.tournament_id', '=', 'tournaments.tournament_id')
->leftJoin('players', 'player_register_tournament.player_id', '=', 'players.player_id')
->leftJoin('ranking', 'players.ita_number', '=', 'ranking.aita_number')
->leftJoin('draw', function($join) use ($tournament_id) {
$join->on(DB::raw("CONCAT('p_', player_register_tournament.player_id)"), '=', 'draw.player_id')
->where('draw.tournament_id', '=', $tournament_id);
})
->where('player_register_tournament.tournament_id', '=', $tournament_id)
->where('player_register_tournament.status', '=', 'approved')
->whereNull('draw.player_id')
->get();
Log::info('ins'.$portal_registered_players);
// Manual Registered Players
$manual_registered_player = ManualRegister::where('academy_id', '=', $academy_id)

->leftJoin('draw', function($join) use ($tournament_id) {
$join->on(DB::raw("CONCAT('m_', manual_registration.manual_register_id)"), '=', 'draw.player_id')
->where('draw.tournament_id', '=', $tournament_id);
})
->where('manual_registration.tournament_id', '=', $tournament_id)
->whereNull('draw.player_id')
->get();

// Tournaments
$tournaments = Tournament::where('tournament_id', '=', $tournament_id)
->first();

return response()->json([
'tournaments' => $tournaments,
'portal_registered_players' => $portal_registered_players,
'manual_registered_player' => $manual_registered_player,
]);

} else {
$portal_registered_players = PlayerRegisterTournament::select('player_register_tournament.category as player_register_tournament_category', 'player_register_tournament.sub_category as player_register_tournament_sub_category', 'tournaments.tournamentName', 'tournaments.tournament_id', 'tournaments.category', 'tournaments.subCategory', 'players.first_name', 'players.middle_name', 'players.last_name', 'players.player_id', 'players.dob', 'players.ita_number', 'players.gender', 'ranking.rank')
->leftJoin('tournaments', 'player_register_tournament.tournament_id', '=', 'tournaments.tournament_id')
->leftJoin('players', 'player_register_tournament.player_id', '=', 'players.player_id')
->leftJoin('ranking', 'players.ita_number', '=', 'ranking.aita_number')
->where('tournaments.academy_id', '=', $academy_id)
->where('player_register_tournament.status', '=', 'approved')
->get();

$manual_registered_player = ManualRegister::where('academy_id', '=', $academy_id)
->get();

return response()->json([
'portal_registered_players' => $portal_registered_players,
'manual_registered_player' => $manual_registered_player,
]);
}
}
} catch (Exception $e) {
Log::error('Error category tournament result not found:', ['error' => $e->getMessage()]);
return response()->json(['error' => 'Server Error'], 500);
}
}
}
 */

    // academy/drawPrepare.blade.php
    public function drawCreate(Request $request)
    {
        // dd($request->all());
        $tournament_id = $request->input('tournament_id');
        $drawType = $request->input('drawType');
        $playerNum = $request->input('playerNum');
        $gender = $request->input('gender.*');
        $subCategory = $request->input('subCategory');
        $selectedCheckboxes_m = [];
        $selectedCheckboxes_p = [];

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'checkbox_m_') === 0) {
                $selectedCheckboxes_m[] = $value;
            }
        }

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'checkbox_p_') === 0) {
                $selectedCheckboxes_p[] = $value;
            }
        }
        // dd($selectedCheckboxes_p);

        $interim_draw = new InterimDraw();
        $interim_draw->tournament_id = $tournament_id;
        $interim_draw->draw_type = $drawType;
        $interim_draw->player_num = $playerNum;
        $interim_draw->subCategory = $subCategory;
        $interim_draw->gender = $gender[0];

        if ($interim_draw->save()) {
            $latest_interim_draw = InterimDraw::where('tournament_id', '=', $tournament_id)
                ->where('player_num', '=', $playerNum)
                ->latest()
                ->first();
            $latest_interim_draw_id = $latest_interim_draw->id;

            if (!empty($selectedCheckboxes_m)) {
                foreach ($selectedCheckboxes_m as $checkboxValue) {
                    if (strpos($checkboxValue, 'm_') === 0) {
                        $id_with_under_score = $checkboxValue;
                        $manualRegisterId = str_replace('m_', '', $checkboxValue);
                        // dd('Manual Register ID:', $manualRegisterId);
                        $remove_underscore_manual_player_id = $manualRegisterId;

                        $manual_registered_players = ManualRegister::where('manual_register_id', '=', $remove_underscore_manual_player_id)
                            ->where('tournament_id', '=', $tournament_id)->first();
                        $update_manual_registered_players = DB::table('manual_registration')
                            ->where('manual_register_id', $remove_underscore_manual_player_id)
                            ->where('tournament_id', '=', $tournament_id)
                            ->update(['drawType' => $drawType]);
                        $interim_draw_player_tournament = new InterimDrawPlayerTournament();
                        $interim_draw_player_tournament->player_id = $id_with_under_score;
                        $interim_draw_player_tournament->player_name = $manual_registered_players->name;
                        $interim_draw_player_tournament->dob = $manual_registered_players->dob;
                        $interim_draw_player_tournament->aita_number = $manual_registered_players->aita_number;
                        $interim_draw_player_tournament->rank = $manual_registered_players->rank;
                        $interim_draw_player_tournament->interim_draw_id = $latest_interim_draw_id;
                        if ($interim_draw_player_tournament->save()) {
                            $interim_draw_player_tournament_id = $interim_draw_player_tournament->id;
                            $result[] = [
                                'interim_draw_id' => $latest_interim_draw_id,
                                'interim_draw_player_tournament_id' => $interim_draw_player_tournament_id,
                            ];
                        }
                    }
                }
            }

            if (!empty($selectedCheckboxes_p)) {
                foreach ($selectedCheckboxes_p as $checkboxValue) {
                    if (strpos($checkboxValue, 'p_') === 0) {
                        $id_with_under_score = $checkboxValue;
                        $playerId = str_replace('p_', '', $checkboxValue);
                        // dd('checkbox value: ', $checkboxValue, 'Player ID:', $playerId);
                        $remove_underscore_player_id = $playerId;
                        $registered_players = Player::select('players.player_id', 'players.first_name', 'players.middle_name', 'players.last_name', 'players.dob', 'players.gender', 'ranking.aita_number', 'ranking.rank')
                            ->leftJoin('ranking', 'players.ita_number', '=', 'ranking.aita_number')
                            ->whereIn('players.player_id',
                                DB::table('player_register_tournament')->select('player_register_tournament.player_id')
                                    ->where('player_register_tournament.tournament_id', '=', $tournament_id)
                                    ->where('player_register_tournament.status', '=', 'approved')
                            )
                            ->where('players.player_id', '=', $remove_underscore_player_id)
                            ->where('players.gender', '=', $gender)
                            ->first();
                       
                        $update_player_register_tournament = DB::table('player_register_tournament')
                            ->where('player_id', $remove_underscore_player_id)
                            ->where('tournament_id', '=', $tournament_id)
                            ->update(['drawType' => $drawType]);

                        $name = $registered_players->first_name . ' ' . $registered_players->middle_name . ' ' . $registered_players->last_name;

                        $interim_draw_player_tournament = new InterimDrawPlayerTournament();
                        $interim_draw_player_tournament->player_id = $id_with_under_score;
                        $interim_draw_player_tournament->player_name = $name;
                        $interim_draw_player_tournament->dob = $registered_players->dob;
                        $interim_draw_player_tournament->aita_number = $registered_players->aita_number;
                        $interim_draw_player_tournament->rank = $registered_players->rank;
                        $interim_draw_player_tournament->interim_draw_id = $latest_interim_draw_id;
                        if ($interim_draw_player_tournament->save()) {
                            $interim_draw_player_tournament_id = $interim_draw_player_tournament->id;
                            $result[] = [
                                'interim_draw_id' => $latest_interim_draw_id,
                                'interim_draw_player_tournament_id' => $interim_draw_player_tournament_id,
                            ];
                        }
                    }
                }
            }
        }

        // dd($result);
        session([
            'result' => $result,
        ]);

        return redirect()->route('academy.createDraw');
    }

    // press browser back button result session end: academy/drawCreate.blade.php
    public function resultSessionExpire(Request $request)
    {
        $request->session()->forget('result');
        return response()->json(['message' => 'Session data cleared']);
    }

    // academy/drawCreate.blade.php: store a draw
    public function storeDraw(Request $request)
    {
        $user_id = session('id');
        $check_academy = Academy::where('id', '=', $user_id)->first();
        if (!$check_academy) {
            $request->session()->flush();
            Auth::logout();
            Alert::info("Important", "Something want error!", 3500);
            return redirect()->route('home');
        }

        $rules = [
            "interim_draw_id.*" => "required",
            "player_num.*" => "required",
            "player_id.*" => "required",
            "tournament_id.*" => "required",
            'interim_draw_players_tournament_id.*' => 'required',
        ];
        $request->validate($rules);

        $interim_draw_ides = $request->input('interim_draw_id.*');
        $seeds = $request->input('seed.*');
        $bys = $request->input('by.*');
        $player_nums = $request->input('player_num.*');
        $player_ides = $request->input('player_id.*');
        $tournament_ides = $request->input('tournament_id.*');
        $interim_draw_players_tournament_ides = $request->input('interim_draw_players_tournament_id.*');
        // dd($interim_draw_players_tournament_ides);
        // dd($bys);

        $new_draw = new Draw;
        $new_draw->player_num = $player_nums[0];
        $new_draw->interim_draw_id = (int) $interim_draw_ides[0];
        $new_draw->tournament_id = (int) $tournament_ides[0];

        if ($new_draw->save()) {
            $draw_id = $new_draw->draw_id;
            foreach ($interim_draw_players_tournament_ides as $index => $interim_draw_players_tournament_id) {
                $seed = $seeds[$index] ?? null;
                $by = $bys[$index] ?? "no";
                $player_num = $player_nums[$index];
                $player_id = $player_ides[$index];
                $tournament_id = $tournament_ides[$index];

                $new_draw_player_tournament = new DrawPlayerTournament;
                $new_draw_player_tournament->seed = $seed;
                $new_draw_player_tournament->by = $by;
                $new_draw_player_tournament->draw_id = $draw_id;
                $new_draw_player_tournament->player_id = $player_id;

                if ($new_draw_player_tournament->save()) {
                    $new_round = new Round;
                    $new_round->draw_id = $draw_id;
                    $new_round->player_id = $player_id;
                    $new_round->roundOne = "yes";
                    $new_round->roundTwo = $by === 'yes' ? "yes" : 'no';
                    $new_round->save();

                    // if ($new_round->save()) {
                    //     $round_id = $new_round->id;
                    //     $new_match = new MatchModel;
                    //     $new_match->draw_id = $draw_id;
                    //     $new_match->round_id = $round_id;
                    //     $new_match->player_id = $player_id;
                    //     $new_match->save();
                    // }
                }
            }

            $players = DrawPlayerTournament::where('draw_id', $draw_id)->get();
            $interim_draw = Draw::select('interim_draw_id')->where('draw_id', $draw_id)->first();
            $draw_type = InterimDraw::select('draw_type')->where('id', $interim_draw->interim_draw_id)->first();
            $playersWithoutSeed = $players->filter(function ($player) {
                return $player->by === 'no'; // Players without bye
            });

            $playersWithSeed = $players->filter(function ($player) {
                return $player->by === 'yes'; // Players with bye
            });

            // Convert the collections to arrays for easier pairing
            $playersWithoutSeed = $playersWithoutSeed->values();
            $playersWithSeed = $playersWithSeed->values();
            Log::info($playersWithoutSeed);
            Log::info($playersWithSeed);
            // Pair up players without bye and create matches
            for ($i = 0; $i < $playersWithoutSeed->count(); $i += 2) {
                // Ensure that there is a pair of players to create a match
                if (isset($playersWithoutSeed[$i]) && isset($playersWithoutSeed[$i + 1])) {
                    // Player 1
                    $player1 = $playersWithoutSeed[$i];
                    // Player 2
                    $player2 = $playersWithoutSeed[$i + 1];

                    // Save the match in the 'matches' table
                    if ($draw_type == 'Main') {
                      
                        MatchModel::create([
                            'draw_id' => $draw_id,
                            'round_id' => 1,
                            'player1_id' => $player1->player_id, // Assuming 'id' is the primary key for 'rounds' table
                            'player2_id' => $player2->player_id,
                        ]);
                    } else {
                        $qualifyDraw = new QualifyMatch();
                        $qualifyDraw->interim_draw_id = $interim_draw->interim_draw_id;
                        $qualifyDraw->qualify_round_id = 1;
                        $qualifyDraw->player1_id = $player1->player_id;
                        $qualifyDraw->player2_id = $player2->player_id;
                        $qualifyDraw->save();
                    }

                }
            }

            // Create matches for players with seeds (who receive a bye)
            foreach ($playersWithSeed as $playerWithSeed) {
                // Save the match with only player1_id and no player2_id (null)
                MatchModel::create([
                    'draw_id' => $draw_id,
                    'round_id' => 1,
                    'player1_id' => $playerWithSeed->player_id, // Seed player who gets a bye
                    'player2_id' => 'bye', // No opponent for the match (bye)
                    'status' => $playerWithSeed->player_id,
                    'score' => 'bye',
                ]);

            }

            $request->session()->forget('result');
            Alert::success("Success", "Draw has been created successfully!", 3500);
            return redirect()->route('academy.drawPage');
        }
    }

    // academy/draw.blade.php: show draw to academy
    public function showDrawToAcademy(Request $request)
    {
        if ($request->ajax()) {
            try
            {

                $user_id = session('id');

                $check_academy = Academy::where('id', '=', $user_id)->first();
                if (!$check_academy) {
                    $request->session()->flush();
                    Auth::logout();
                    Alert::info("Important", "Something want error!", 3500);
                    return redirect()->route('home');
                }

                $draw_id = (int) $request->draw_id;
               
                $draw_details = Draw::where('draw_id', $draw_id)
                    ->join('interim_draw', 'draw.interim_draw_id', '=', 'interim_draw.id')
                    ->select('interim_draw.draw_type', 'draw.interim_draw_id')
                    ->first();
               
                $interim_drawid = $draw_details->interim_draw_id;
                if ($draw_details->draw_type == 'Qualify') {
                    $is_draw = DB::table('qualify_matches')
                        ->distinct()
                        ->select('qualify_matches.*', 'interim_draw.id As interim_draw_id', 'interim_draw.player_num', 'interim_draw.subCategory', 'interim_draw.gender')
                        ->leftJoin('interim_draw', 'qualify_matches.interim_draw_id', '=', 'interim_draw.id')
                        ->where('qualify_matches.interim_draw_id', $interim_drawid)
                        ->get();
                    foreach ($is_draw as $index => $data) {
                        $player1_id = $data->player1_id;
                        $player2_id = $data->player2_id;
                        $interim_draw_id = $data->interim_draw_id;
                        if ($player1_id != 'bye') {
                            $playerdetails = DB::table('draw_players_tournament')
                                ->distinct()
                                ->select('draw_players_tournament.seed', 'draw_players_tournament.by', 'idpt.player_name', 'idpt.rank')
                                ->leftJoin('interim_draw_players_tournament as idpt', function ($join) use ($interim_draw_id) {
                                    $join->on('draw_players_tournament.player_id', '=', 'idpt.player_id')
                                        ->where('idpt.interim_draw_id', '=', $interim_draw_id);
                                })
                                ->where('draw_players_tournament.draw_id', $draw_id)
                                ->where('draw_players_tournament.player_id', $player1_id)
                                ->first();
                            $byeplayer = 'no';
                            if ($data->score == 'bye') {
                                $byeplayer = 'yes';
                            }
                            $result[] = [
                                'player_num' => $data->player_num,
                                'player_id' => $player1_id,
                                'seed' => $playerdetails->seed,
                                'bye' => $byeplayer,
                                'player_name' => $playerdetails->player_name,
                                'rank' => $playerdetails->rank,
                                'subCategory' => $data->subCategory,
                                'gender' => $data->gender,
                                'match_id' => $data->id,
                                'round_id' => $data->qualify_round_id,
                                'score' => $data->score,
                                'winner' => $data->status,
                                'draw_type' => 'Qualify',
                                'interim_draw' => $interim_drawid,
                            ];
                        }
                        if ($player2_id != 'bye') {
                            $playerdetails =
                            DB::table('draw_players_tournament')
                                ->distinct()
                                ->select('draw_players_tournament.seed', 'draw_players_tournament.by', 'idpt.player_name', 'idpt.rank')
                                ->leftJoin('interim_draw_players_tournament as idpt', function ($join) use ($interim_draw_id) {
                                    $join->on('draw_players_tournament.player_id', '=', 'idpt.player_id')
                                        ->where('idpt.interim_draw_id', '=', $interim_draw_id);
                                })
                                ->where('draw_players_tournament.draw_id', $draw_id)
                                ->where('draw_players_tournament.player_id', $player2_id)
                                ->first();
                            $byeplayer = 'no';
                            if ($data->score == 'bye') {
                                $byeplayer = 'yes';
                            }

                            $result[] = [
                                'player_num' => $data->player_num,
                                'player_id' => $player2_id,
                                'seed' => $playerdetails->seed,
                                'bye' => $byeplayer,
                                'player_name' => $playerdetails->player_name,
                                'rank' => $playerdetails->rank,
                                'subCategory' => $data->subCategory,
                                'gender' => $data->gender,
                                'match_id' => $data->id,
                                'round_id' => $data->qualify_round_id,
                                'score' => $data->score,
                                'winner' => $data->status,
                                'draw_type' => 'Qualify',
                                'interim_draw' => $interim_drawid,
                            ];
                        }
                    }
                } else {
                    $is_draw = DB::table('matches')
                        ->distinct()
                        ->select('matches.*', 'draw.interim_draw_id', 'draw.player_num', 'interim_draw.subCategory', 'interim_draw.gender')
                        ->leftJoin('draw', 'matches.draw_id', '=', 'draw.draw_id')
                        ->leftJoin('interim_draw', 'draw.interim_draw_id', '=', 'interim_draw.id')
                        ->where('matches.draw_id', $draw_id)
                        ->get();
                   
                    foreach ($is_draw as $index => $data) {
                        $player1_id = $data->player1_id;
                        $player2_id = $data->player2_id;
                        $interim_draw_id = $data->interim_draw_id;
                        if ($player1_id != 'bye') {
                            $playerdetails = DB::table('draw_players_tournament')
                                ->distinct()
                                ->select('draw_players_tournament.seed', 'draw_players_tournament.by', 'idpt.player_name', 'idpt.rank')
                                ->leftJoin('interim_draw_players_tournament as idpt', function ($join) use ($interim_draw_id) {
                                    $join->on('draw_players_tournament.player_id', '=', 'idpt.player_id')
                                        ->where('idpt.interim_draw_id', '=', $interim_draw_id);
                                })
                                ->where('draw_players_tournament.draw_id', $draw_id)
                                ->where('draw_players_tournament.player_id', $player1_id)
                                ->first();
                            $byeplayer = 'no';
                            if ($data->score == 'bye') {
                                $byeplayer = 'yes';
                            }

                            $result[] = [
                                'player_num' => $data->player_num,
                                'player_id' => $player1_id,
                                'seed' => $playerdetails->seed,
                                'bye' => $byeplayer,
                                'player_name' => $playerdetails->player_name,
                                'rank' => $playerdetails->rank,
                                'subCategory' => $data->subCategory,
                                'gender' => $data->gender,
                                'match_id' => $data->id,
                                'round_id' => $data->round_id,
                                'score' => $data->score,
                                'winner' => $data->status,
                                'draw_type' => 'Main',
                                'interim_draw' => $interim_drawid,
                            ];
                        }
                        if ($player2_id != 'bye') {
                            $playerdetails =
                            DB::table('draw_players_tournament')
                                ->distinct()
                                ->select('draw_players_tournament.seed', 'draw_players_tournament.by', 'idpt.player_name', 'idpt.rank')
                                ->leftJoin('interim_draw_players_tournament as idpt', function ($join) use ($interim_draw_id) {
                                    $join->on('draw_players_tournament.player_id', '=', 'idpt.player_id')
                                        ->where('idpt.interim_draw_id', '=', $interim_draw_id);
                                })
                                ->where('draw_players_tournament.draw_id', $draw_id)
                                ->where('draw_players_tournament.player_id', $player2_id)
                                ->first();
                            $byeplayer = 'no';
                            if ($data->score == 'bye') {
                                $byeplayer = 'yes';
                            }

                            $result[] = [
                                'player_num' => $data->player_num,
                                'player_id' => $player2_id,
                                'seed' => $playerdetails->seed,
                                'bye' => $byeplayer,
                                'player_name' => $playerdetails->player_name,
                                'rank' => $playerdetails->rank,
                                'subCategory' => $data->subCategory,
                                'gender' => $data->gender,
                                'match_id'=>$data->id,
                                'round_id'=>$data->round_id,
                                'score'=>$data->score,
                                'winner'=>$data->status,
                                'draw_type'=>'Main',
                                'interim_draw'=>$interim_drawid
                            ];
                        }
                    }
                }
                return response()->json([
                    'is_draw' => $result,
                ]);
            } catch (Exception $e) {
                Log::error('Error tournament draw not found:', ['error' => $e->getMessage()]);
                return response()->json(['error' => 'Server Error'], 500);
            }
        }
    }

    // academy/draw.blade.php action on result/score button
    public function getMatchScore(Request $request)
    {
        $user_id = session('id');

        $check_academy = Academy::where('id', '=', $user_id)->first();

        if (!$check_academy) {
            $request->session()->flush();
            Auth::logout();
            Alert::info("Important", "Something want error!", 3500);
            return redirect()->route('home');
        }

        $rules = [
            "match_id" => "required",
            "score" => "required",
            "player_id" => "required",
            'draw_type' => 'required',
        ];
        $request->validate($rules);

        $match_id = $request->input('match_id');

        if ($request->input('draw_type') == 'Qualify') {
            $match = QualifyMatch::find($match_id);

            $match->score = $request->input('score');
            $match->status = $request->input('player_id');
            $match->save();

            if ($match->save()) {

                $draw = InterimDraw::find($match->interim_draw_id);

                // Split the string by space
                $total_players = explode(' ', $draw->player_num);

                // Extract the number convert it to an integer
                $numberOfPlayers = (int) $total_players[0];
                $rounds = log($numberOfPlayers, 2);

                $level = $match->qualify_round_id;

                if ($level < $rounds) {

                    if ($level === 1) {
                        $nextLevel = 'roundTwo';
                    } elseif ($level === 2) {
                        $nextLevel = 'roundThree';
                    } elseif ($level === 3) {
                        $nextLevel = 'roundFour';
                    } elseif ($level === 4) {
                        $nextLevel = 'roundFive';
                    } elseif ($level === 5) {
                        $nextLevel = 'roundSix';
                    }
                    $group = $level + 1;
                } elseif ($level == $rounds) {
                    $nextLevel = 'semifinal';
                    $group = 8;
                } elseif ($level === 8) {
                    $nextLevel = 'final';
                    $group = 9;
                } elseif ($level === 9) {

                    $winner = $match->status;
                    $runnerup = ($winner == $match->player1_id) ? $match->player2_id : $match->player1_id;

                    $final = DB::table('draws')
                        ->where('interim_draw_id', $match->interim_draw_id)
                        ->update([
                            'winner' => $winner, 'runner_up' => $runnerup,
                        ]);
                }
                $newround='';
                $draw_id = Draw::where('interim_draw_id', $match->interim_draw_id)->first();
                //dd($draw_id);
                $round = DB::table('rounds')
                            ->where('draw_id', $draw_id->draw_id)
                            ->where('player_id',  $match->status)
                            ->update([$nextLevel => 'yes']);
                $checkStatus=QualifyMatch::where('interim_draw_id',$match->interim_draw_id)->whereNull('status')->get();
                if(count($checkStatus)==0)
                { $newround='true';}
            }
            return response()->json(['winner'=>'user','newround'=>$newround]);
   
        }
        else
        {
            $match = MatchModel::find($match_id);
            $match->score = $request->input('score');
            $match->status = $request->input('player_id');
            $match->save();

            if ($match->save()) {

                $draw = Draw::find($match->draw_id);

                // Split the string by space
                $total_players = explode(' ', $draw->player_num);

                // Extract the number convert it to an integer
                $numberOfPlayers = (int) $total_players[0];
                $rounds = log($numberOfPlayers, 2) - 2;

                $level = $match->round_id;
                $nextLevel = '';

                if ($level < $rounds) {

                    if ($level === 1) {
                        $nextLevel = 'roundTwo';
                    } elseif ($level === 2) {
                        $nextLevel = 'roundThree';
                    } elseif ($level === 3) {
                        $nextLevel = 'roundFour';
                    } elseif ($level === 4) {
                        $nextLevel = 'roundFive';
                    } elseif ($level === 5) {
                        $nextLevel = 'roundSix';
                    }
                    $group = $level + 1;
                } elseif ($level == $rounds) {
                    $nextLevel = 'semifinal';
                    $group = 8;
                } elseif ($level === 8) {
                    $nextLevel = 'final';
                    $group = 9;
                } elseif ($level === 9) {

                    $winner = $match->status;
                    $runnerup = ($winner == $match->player1_id) ? $match->player2_id : $match->player1_id;
                    $playername = InterimDrawPlayerTournament::where('player_id', $winner)->first();

                    $final = DB::table('draw')
                        ->where('draw_id', $match->draw_id)
                        ->update([
                            'winner' => $winner, 'runnerup' => $runnerup,
                        ]);
                    //Alert::success("Success", "Score updated!");

                    return response()->json(['winner' => $playername->player_name]);
                    // return redirect()->back();
                }

                $round = DB::table('rounds')
                    ->where('draw_id', $match->draw_id)
                    ->where('player_id', $match->status)
                    ->update([$nextLevel => 'yes']);

                $checkStatus = MatchModel::where('draw_id', $match->draw_id)->whereNull('status')->get();

                $newround = '';
                if (count($checkStatus) == 0) {

                    $players = Round::where('draw_id', $match->draw_id)
                        ->where($nextLevel, 'yes')
                        ->get();

                    //dd($players);
                    $total_matches = intdiv($players->count(), 1); // Calculate the total number of matches
                    //dd($total_matches);
                    for ($i = 0; $i < $total_matches; $i += 2) {

                        if (isset($players[$i]) && isset($players[$i + 1])) {

                            // Player 1
                            $player1 = $players[$i];
                            // Player 2
                            $player2 = $players[$i + 1];

                            // Save the match in the 'matches' table
                            MatchModel::create([
                                'draw_id' => $match->draw_id, // Assuming $draw_id should be $match->draw_id
                                'round_id' => $group, // Assuming $level is correctly defined elsewhere
                                'player1_id' => $player1->player_id, // Adjusted to use player_id
                                'player2_id' => $player2->player_id, // Adjusted to use player_id
                            ]);
                        }
                    }
                    $newround = 'true';
                }
            }
            $winner = $request->input('player_id');
            $playername = InterimDrawPlayerTournament::where('player_id', $winner)->first();
            //dd($playername);
            //Alert::success("Success", "Score updated!");
        }
        return response()->json(['winner' => $playername->player_name, 'newround' => $newround]);
        //return redirect()->back();
    }

    // get Qualify Matches score
    public function getQualifyMatchScore(Request $request)
    {
        $user_id = session('id');
        $check_academy = Academy::where('id', '=', $user_id)->first();
        if (!$check_academy) {
            $request->session()->flush();
            Auth::logout();
            Alert::info("Important", "Something want error!", 3500);
            return redirect()->route('home');
        }
        $winner = $request->input('player_id');
        $playername = InterimDrawPlayerTournament::where('player_id', $winner)->first();
        //dd($playername);
        //Alert::success("Success", "Score updated!");

        $rules = [
            "match_id" => "required",
            "score" => "required",
            "player_id" => "required",
        ];
        $request->validate($rules);

        $match_id = $request->input('match_id');

        $match = QualifyMatch::find($match_id);
     
        $match->score = $request->input('score');
        $match->status = $request->input('player_id');
        $match->save();

        if ($match->save()) {

            $draw = InterimDraw::find($match->interim_draw_id);

            // Split the string by space
            $total_players = explode(' ', $draw->player_num);

            // Extract the number convert it to an integer
            $numberOfPlayers = (int) $total_players[0];
            $rounds = log($numberOfPlayers, 2);

            $level = $match->qualify_round_id;

            if ($level < $rounds) {

                if ($level === 1) {
                    $nextLevel = 'roundTwo';
                } elseif ($level === 2) {
                    $nextLevel = 'roundThree';
                } elseif ($level === 3) {
                    $nextLevel = 'roundFour';
                } elseif ($level === 4) {
                    $nextLevel = 'roundFive';
                } elseif ($level === 5) {
                    $nextLevel = 'roundSix';
                }
                $group = $level + 1;
            } elseif ($level == $rounds) {
                $nextLevel = 'semifinal';
                $group = 8;
            } elseif ($level === 8) {
                $nextLevel = 'final';
                $group = 9;
            } elseif ($level === 9) {

                $winner = $match->status;
                $runnerup = ($winner == $match->player1_id) ? $match->player2_id : $match->player1_id;
                $playername = InterimDrawPlayerTournament::where('player_id', $winner)->first();

                $final = DB::table('draws')
                    ->where('interim_draw_id', $match->interim_draw_id)
                    ->update([
                        'winner' => $winner, 'runner_up' => $runnerup,
                    ]);
            }

            $draw_id = Draw::where('interim_draw_id', $match->interim_draw_id)->first();
            //dd($draw_id);
            $round = DB::table('rounds')
                ->where('draw_id', $draw_id->draw_id)
                ->where('player_id', $match->status)
                ->update([$nextLevel => 'yes']);

        }

        Alert::success("Success", "Score updated!");
        return redirect()->back();
    }

    public function nextQualifyRound(Request $request)
    {
       
        $rules = [
            "interim_draw_id" => "required",
            "round" => "required",
        ];
        $request->validate($rules);
      
        $interim_draw_id = $request->interim_draw_id;
        $nextRound = $request->round;

        $checkStatus = QualifyMatch::where('interim_draw_id', $interim_draw_id)->whereNull('status')->get();
      
        if (count($checkStatus) == 0) {

            $draw_id = Draw::where('interim_draw_id',$interim_draw_id)->first();
            $level='';
            if($nextRound=='roundOne'){
                $level=1;
                $nextRound='RoundTwo';
            }
            if($nextRound=='roundTwo'){
                $level=2;
                $nextRound=='roundThree';
            }
            if($nextRound=='roundThree'){
                $level=3;
                $nextRound=='roundFour';
            }
            if($nextRound=='roundFour'){
                $level=4;
                $nextRound=='roundFive';
            }
            if($nextRound=='roundFive'){
                $level=5;
                $nextRound=='roundSix';
            }
            
            if($nextRound=='roundSix'){
                $level=6;
                $nextRound=='semifinal';
            }
            if($nextRound=='semifinal'){
                $level=8;
                $nextRound=='final';
            }
            if($nextRound=='final'){
                $level=9;
            }
            $players = Round::where('draw_id', $draw_id->draw_id)
                ->where($nextRound, 'yes')
                ->get();

            $total_matches = intdiv($players->count(), 1); // Calculate the total number of matches
     
            
            if($total_matches > 2 && ($total_matches % 2) == 0) {
                for ($i = 0; $i < $total_matches; $i += 2) {

                    if (isset($players[$i]) && isset($players[$i + 1])) {

                        // Player 1
                        $player1 = $players[$i];
                        // Player 2
                        $player2 = $players[$i + 1];

                        // Save the match in the 'matches' table
                        QualifyMatch::create([
                            'interim_draw_id' => $draw_id->draw_id,    // Assuming $draw_id should be $match->draw_id
                            'qualify_round_id' => $level+1,            // Assuming $level is correctly defined elsewhere
                            'player1_id' => $player1->player_id, // Adjusted to use player_id
                            'player2_id' => $player2->player_id, // Adjusted to use player_id
                            
                        ]);
                    }
                }
                return response()->json(['msg'=>'Next Round created Successfully'],200);
            } else {
               // Alert::info("Important", "Round can't be made, it is not meeting the prerequisites!");
               // return redirect()->back();
                return response()->json(['error'=>"Round can't be made, it is not meeting the prerequisites!"],400);
            }

        } else {

            return response()->json(['error'=>"next round can't be made, some matches are remaining"],400);
           // Alert::info("Important", "Next round can't be made, some matches are remaining!");
            return redirect()->back();
        }
    }

    public function moveToMainDraw(Request $request)
    {
        Log::info('call move to main ');
        $rules = [
            "interim_draw_id" => "required",
            "last_round" => "required",
        ];
        $request->validate($rules);

        $last_round = $request->last_round;
        if($last_round=='roundOne'){
            $level=1;
            $last_round='RoundTwo';
        }
        if($last_round=='roundTwo'){
            $level=2;
            $last_round=='roundThree';
        }
        if($last_round=='roundThree'){
            $level=3;
            $last_round=='roundFour';
        }
        if($last_round=='roundFour'){
            $level=4;
            $last_round=='roundFive';
        }
        if($last_round=='roundFive'){
            $level=5;
            $last_round=='roundSix';
        }
        
        if($last_round=='roundSix'){
            $level=6;
            $last_round=='semifinal';
        }
        if($last_round=='semifinal'){
            $level=8;
            $last_round=='final';
        }
        if($last_round=='final'){
            $level=9;
        }

        $draw = Draw::where('interim_draw_id', $request->interim_draw_id)->first();

        $players = Round::where('draw_id', $draw->draw_id)
            ->where($last_round, 'yes')
            ->get();

        foreach ($players as $key => $player) {

            $id_with_under_score = $player->player_id;

            if (strpos($id_with_under_score, 'm_') === 0) {

                $manualRegisterId = str_replace('m_', '', $id_with_under_score);

                $update_manual_registered_players = DB::table('manual_registration')
                    ->where('manual_register_id', $manualRegisterId)
                    ->where('tournament_id', '=', $draw->tournament_id)
                    ->update(['drawType' => "Main"]);
            } elseif (strpos($id_with_under_score, 'p_') === 0) {

                $normalRegisterId = str_replace('p_', '', $id_with_under_score);

                $update_player_register_tournament = DB::table('player_register_tournament')
                    ->where('player_id', $normalRegisterId)
                    ->where('tournament_id', '=', $draw->tournament_id)
                    ->update(['drawType' => "Main"]);
            }

        }
        Alert::success("Success", "Qualified players moved to Main draw!");
        return redirect()->back();


    }

}
