<?php

// maincontroller.php

// show registered player list
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
            // ->whereNotIn('draw.interim_draw_id',
            //     DB::table('interim_draw')->select('interim_draw.interim_draw_id')->where('interim_draw.tournament_id', '=', $academy_id)
            // )
                ->where('tournaments.academy_id', '=', $academy_id)
                ->where('player_register_tournament.status', '=', 'approved')
                ->get();

            // if (count($portal_registered_players) >0){
            // $tournament_id = $portal_registered_players[0]->tournament_id;

            $manual_registered_player = ManualRegister::where('academy_id', '=', $academy_id)
            // ->where('tournament_id', '=', $tournament_id)
                ->get();
            $tournaments = Tournament::select('tournamentName', 'tournament_id')
                ->where('academy_id', '=', $academy_id)
                ->where('status', '!=', 'done')
                ->orderBy('tournamentName', 'ASC')
                ->get();

            return view('academy.showRegisteredPlayerData', [
                'tournaments' => $tournaments,
                'portal_registered_players' => $portal_registered_players,
                'manual_registered_player' => $manual_registered_player,
            ]);
        }
    }

}

// homeController.php
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
                        ->whereNotIn('player_register_tournament.player_id', function ($query) use ($tournament_id) {
                            $query->select('draw.player_id')
                                ->from('draw')
                                ->where('draw.tournament_id', '=', $tournament_id)
                                ->whereRaw("draw.player_id = CONCAT('p_', player_register_tournament.player_id)");
                        })
                        ->get();

                    // Manual Registered Players
                    $manual_registered_player = ManualRegister::where('manual_registration.academy_id', '=', $academy_id)
                        ->where('manual_registration.tournament_id', '=', $tournament_id)
                        ->whereNotIn('manual_registration.player_id', function ($query) use ($tournament_id) {
                            $query->select('draw.player_id')
                                ->from('draw')
                                ->where('draw.tournament_id', '=', $tournament_id);
                        })
                        ->get();

                    // Tournaments
                    $tournaments = Tournament::where('tournament_id', '=', $tournament_id)
                        ->whereNotIn('tournament_id', DB::table('draw')->select('tournament_id')->where('tournament_id', '=', $tournament_id))
                        ->first();

                    Log::info('Tournament ID: ' . $tournament_id);
                    Log::info('SQL Query: ' . $portal_registered_players->toSql());

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
// ******************
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
        ];
        $request->validate($rules);
        // dd($request->all());

        $interim_draw_ides = $request->input('interim_draw_id.*');
        $seeds = $request->input('seed.*');
        $bys = $request->input('by.*');
        $player_nums = $request->input('player_num.*');
        $player_ides = $request->input('player_id.*');
        $tournament_ides = $request->input('tournament_id.*');
        // dd($tournament_ides[0]);

        $new_draw = new Draw;
        $new_draw->player_num = $player_nums[0];
        $new_draw->interim_draw_id = (int) $interim_draw_ides[0];
        $new_draw->tournament_id = (int) $tournament_ides;

        if ($new_draw->save()) {
            $draw_id = $new_draw->draw_id;
            foreach ($interim_draw_ides as $index => $interim_draw_id) {
                $seed = $seeds[$index] ?? null;
                $by = $bys[$index] ?? null;
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
                    $new_round->roundTwo = $by === 'yes' ? "yes" : null;

                    if ($new_round->save()) {
                        $round_id = $new_round->id;
                        $new_match = new MatchModel;
                        $new_match->draw_id = $draw_id;
                        $new_match->round_id = $round_id;
                        $new_match->player_id = $player_id;
                        $new_match->save();
                    }
                }
            }
            $request->session()->forget('result');
            Alert::success("Success", "Draw has been created successfully!", 3500);
            return redirect()->route('academy.drawPage');
        }
    }

    // drawController.php

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

                    if ($new_round->save()) {
                        $round_id = $new_round->id;
                        $new_match = new MatchModel;
                        $new_match->draw_id = $draw_id;
                        $new_match->round_id = $round_id;
                        $new_match->player_id = $player_id;
                        $new_match->save();
                    }
                }
            }
            $request->session()->forget('result');
            Alert::success("Success", "Draw has been created successfully!", 3500);
            return redirect()->route('academy.drawPage');
        }
    }
