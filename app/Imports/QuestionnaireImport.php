<?php

namespace App\Imports;

use App\Models\Questionnaire;
use Maatwebsite\Excel\Concerns\ToModel;

class QuestionnaireImport implements ToModel
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!$row[0]){
            return null;
        }

        return new Questionnaire([
            'quiz_id' => $this->id,
            'question' => $row[0],
            'answer' => $row[1],
        ]);
    }
}
