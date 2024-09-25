public function showDrawToAcademy(Request $request)
    {
        if ($request->ajax()) {
            try {
                $user_id = session('id');

                $check_academy = Academy::where('id', '=', $user_id)->first();
                if (!$check_academy) {
                    $request->session()->flush();
                    Auth::logout();
                    Alert::info("Important", "Something want error!", 3500);
                    return redirect()->route('home');
                }

                $draw_id = (int) $request->draw_id;
 /*               $is_draw = DB::table('draw_players_tournament')
    ->distinct()
    ->select(
        'draw.player_num', 
        'draw_players_tournament.player_id', 
        'draw_players_tournament.seed', 
        'draw_players_tournament.by', 
        'idpt.player_name', 
        'idpt.rank', 
        'interim_draw.subCategory', 
        'interim_draw.gender',
        
    )
    ->leftJoin('draw', 'draw_players_tournament.draw_id', '=', 'draw.draw_id')
    ->leftJoin('interim_draw', 'draw.interim_draw_id', '=', 'interim_draw.id')
    ->leftJoin('interim_draw_players_tournament as idpt', 'draw_players_tournament.player_id', '=', 'idpt.player_id')
    ->where('draw_players_tournament.draw_id', $draw_id)
    ->orderBy('draw_players_tournament.id', 'asc')
    ->get();
 */
            
                
                /*DB::table('draw_players_tournament')
                    ->distinct()
                    ->select('draw.player_num', 'draw_players_tournament.player_id', 'draw_players_tournament.seed', 'draw_players_tournament.by', 
                    'idpt.player_name', 'idpt.rank', 'interim_draw.subCategory', 'interim_draw.gender')
                    ->leftJoin('draw', 'draw_players_tournament.draw_id', '=', 'draw.draw_id')
                    ->leftJoin('interim_draw', 'draw.interim_draw_id', '=', 'interim_draw.id')
                    ->leftJoin('interim_draw_players_tournament as idpt', 'draw_players_tournament.player_id', '=', 'idpt.player_id')
                    ->where('draw_players_tournament.draw_id', $draw_id)
                    ->orderBy('draw_players_tournament.id', 'asc')
                    ->get(); */
                    $is_draw=DB::table('matches')
                            ->distinct()
                            ->select('matches.*','draw.interim_draw_id','draw.player_num','interim_draw.subCategory','interim_draw.gender')
                            ->leftJoin('draw','matches.draw_id','=','draw.draw_id')
                            ->leftJoin('interim_draw','draw.interim_draw_id','=','interim_draw.id')
                            ->where('matches.draw_id',$draw_id)
                            ->get();
                          
                        
                    foreach($is_draw as $index => $data)
                    {   $player1_id=$data->player1_id;
                        $player2_id=$data->player2_id;  
                        $interim_draw_id=$data->interim_draw_id;
                        if($player1_id!='bye')
                        {
                            $playerdetails=/*DB::table('draw_players_tournament')
                            ->distinct()
                            ->select( 'draw_players_tournament.seed', 'draw_players_tournament.by','idpt.player_name', 'idpt.rank')
                            ->leftJoin('interim_draw_players_tournament as idpt', 'draw_players_tournament.player_id', '=', 'idpt.player_id')
                            ->where('draw_players_tournament.draw_id', $draw_id)
                            ->where('draw_players_tournament.player_id',$player1_id)
                            ->first();*/
                            DB::table('draw_players_tournament')
                            ->distinct()
                            ->select('draw_players_tournament.seed', 'draw_players_tournament.by', 'idpt.player_name', 'idpt.rank')
                            ->leftJoin('interim_draw_players_tournament as idpt', function($join) use ( $interim_draw_id) {
                                $join->on('draw_players_tournament.player_id', '=', 'idpt.player_id')
                                    ->where('idpt.interim_draw_id', '=', $interim_draw_id); 
                            })
                            ->where('draw_players_tournament.draw_id', $draw_id)
                            ->where('draw_players_tournament.player_id', $player1_id)
                            ->first();
                            $byeplayer='no';
                            if($data->score=='bye')
                            {
                                $byeplayer='yes';
                            }
                                //Log::info($playerdetails);
                         
                            $result[] = [
                            'player_num' => $data->player_num,
                            'player_id' => $player1_id,
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
                            ];
                        }
                        if($player2_id!='bye')
                        {
                            $playerdetails=/*DB::table('draw_players_tournament')
                            ->distinct()
                            ->select( 'draw_players_tournament.seed', 'draw_players_tournament.by','idpt.player_name', 'idpt.rank')
                            ->leftJoin('interim_draw_players_tournament as idpt', 'draw_players_tournament.player_id', '=', 'idpt.player_id')
                            ->where('draw_players_tournament.draw_id', $draw_id)
                            ->where('draw_players_tournament.player_id',$player1_id)
                            ->first();*/
                            DB::table('draw_players_tournament')
                            ->distinct()
                            ->select('draw_players_tournament.seed', 'draw_players_tournament.by', 'idpt.player_name', 'idpt.rank')
                            ->leftJoin('interim_draw_players_tournament as idpt', function($join) use ( $interim_draw_id) {
                                $join->on('draw_players_tournament.player_id', '=', 'idpt.player_id')
                                    ->where('idpt.interim_draw_id', '=', $interim_draw_id); 
                            })
                            ->where('draw_players_tournament.draw_id', $draw_id)
                            ->where('draw_players_tournament.player_id', $player2_id)
                            ->first();
                            $byeplayer='no';
                            if($data->score=='bye')
                            {
                                $byeplayer='yes';
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
                            ];
                        }
                    }
                
                //     $is_draw = DB::select("
                //     SELECT DISTINCT `draw`.`player_num`, `draw_players_tournament`.`player_id`,
                //     `draw_players_tournament`.`seed`, `draw_players_tournament`.`by`,
                //     `idpt`.`player_name`
                //     FROM `draw_players_tournament`
                //     LEFT JOIN `draw` ON `draw_players_tournament`.`draw_id` = `draw`.`draw_id`
                //     LEFT JOIN `interim_draw` ON `draw`.`interim_draw_id` = `interim_draw`.`id`
                //     LEFT JOIN `interim_draw_players_tournament` AS `idpt`
                //     ON `draw_players_tournament`.`player_id` = `idpt`.`player_id`
                //     WHERE `draw_players_tournament`.`draw_id` = 1
                //     ORDER BY `draw_players_tournament`.`id` ASC
                // ");
                // dd($is_draw->toSql());
                // dd($is_draw);
                    /*
                foreach ($is_draw as $index => $data) {
                    
                    $result[] = [
                        'player_num' => $data->player_num,
                        'player_id' => $data->player_id,
                        'seed' => $data->seed,
                        'bye' => $data->by,
                        'player_name' => $data->player_name,
                        'rank' => $data->rank,
                        'subCategory' => $data->subCategory,
                        'gender' => $data->gender,
                        'total_player' => $total_player,
                    ];
                }*/
                // dd($result);

                return response()->json([
                    'is_draw' => $result,
                ]);
            } catch (Exception $e) {
                Log::error('Error tournament draw not found:', ['error' => $e->getMessage()]);
                return response()->json(['error' => 'Server Error'], 500);
            }
        }
    }
