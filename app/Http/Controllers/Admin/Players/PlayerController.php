<?php

namespace App\Http\Controllers\Admin\Players;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlayerController extends Controller
{
    public function filterByAgeGroup(Request $request)
    {
        // return $request;
        $gender = $request->input('gender');
        $ageGroup = $request->input('ageGroup');

        if ($ageGroup !== 'all') {
            $ageLimitDate = Carbon::now()->subYears($ageGroup)->toDateString();
        }
        $staticAgeLimitDate = Carbon::now()->subYears(18)->toDateString();

        // Logic to fetch players based on gender and age group
        if (!$request->has('gender')) {
            $players = Player::orderBy('player_id', 'DESC')->paginate(10);
        } elseif ($request->has('ageGroup')) {
            $players = Player::where('gender', $gender)->where('dob', '>', $ageLimitDate)->orderBy('player_id', 'DESC')->paginate(10);
        } else {
            $players = Player::where('gender', $gender)->where('dob', '<', $staticAgeLimitDate)->orderBy('player_id', 'DESC')->paginate(10);
        }
        Log::info($players);
        return response()->json([
            'players' => $players->items(),
            'pagination' => (string) $players->links('admin.pagination.paginator'),
        ]);
    }

    public function filterByGender(Request $request)
    {
        $gender = $request->input('gender');

        // Logic to fetch players based on gender
        $players = Player::where('gender', $gender)->get();

        return response()->json($players);
    }
}
