<?php

namespace App\Imports;

use App\Models\Rank;
use App\Models\State;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportRanking implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (is_numeric($row[0]) && is_numeric($row[2])) {
            $state = State::where('abbreviation', '=', $row[4])->first();
            $state ? $state_id = $state->state_id : null;
            $formattedDate = date('Y-m-d', strtotime($row[3]));
            return new Rank([
                'rank' => $row[0],
                'name' => $row[1],
                'aita_number' => $row[2],
                'dob' => $formattedDate,
                'state' => $row[4],
                'score' => $row[5],
                'category' => $row[6],
                'sub_category' => $row[7],
                'state_id' => $state_id ?? null,
            ]);
        }
    }
}
