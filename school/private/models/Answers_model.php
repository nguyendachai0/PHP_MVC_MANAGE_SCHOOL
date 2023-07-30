<?php

/** 
 * Questions Model
 */
class Answers_model extends Model
{
    protected  $table = "answers";
    protected $allowedColumns = [

        'user_id',
        'test_id',
        'question_id',
        'date',
        'answer',
        'answer_mark',
        'answer_comment'

    ];
    protected $beforeInsert = [
        'trim_spaces',
    ];
    protected $afterSelect = [];

    public function validate($DATA)
    {
        $this->errors = array();
        // check for question name

        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }
    public function trim_spaces($data)
    {

        foreach ($data as $key => $value) {
            //code...
        }
        $data[$key] = trim($value);
        return $data;
    }


    public function get_user($data)
    {
        $user = new User();
        foreach ($data as $key => $row) {
            $result = $user->where('user_id', $row->user_id);
            $data[$key]->user = is_array($result) ? $result[0] : false;
        }

        return $data;
    }
}
