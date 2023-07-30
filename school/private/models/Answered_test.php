<?php

/** 
 * Tests Model
 */
class Answered_test extends Model
{
    protected  $table = "answered_tests";
    protected $allowedColumns = [];
    protected $beforeInsert = [];
    protected $afterSelect = [
        'get_user',
        'get_test',
    ];


    public function get_user($data)
    {
        $user = new User();
        foreach ($data as $key => $row) {
            $result = $user->where('user_id', $row->user_id);
            $data[$key]->user = is_array($result) ? $result[0] : false;
        }

        return $data;
    }
    public function get_test($data)
    {
        $test = new Tests_model();
        foreach ($data as $key => $row) {
            if (!empty($row->test_id)) {

                $result = $test->where('test_id', $row->test_id);
                $data[$key]->test = is_array($result) ? $result[0] : false;
            }
        }

        return $data;
    }
}
