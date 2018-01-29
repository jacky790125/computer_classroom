<?php
if (! function_exists('get_stud_money')) {
    function get_stud_money(){
        $stud_money_things = [];
        $stud_moneys = \App\StudMoney::where('user_id','=',auth()->user()->id)
            ->orderBy('id','DESC')
            ->paginate(4);
        if(!empty($stud_moneys)){
            foreach($stud_moneys as $stud_money) {
                $stud_money_things[$stud_money->id]['stud_money'] = $stud_money->stud_money;
                if ($stud_money->stud_money > 0) {
                    $stud_money_things[$stud_money->id]['icon'] = "fa-long-arrow-up";
                    $stud_money_things[$stud_money->id]['pm'] = "+";
                    $stud_money_things[$stud_money->id]['color'] = "text-success";
                } else {
                    $stud_money_things[$stud_money->id]['icon'] = "fa-long-arrow-down";
                    $stud_money_things[$stud_money->id]['pm'] = "-";
                    $stud_money_things[$stud_money->id]['color'] = "text-danger";

                }
                $stud_money_things[$stud_money->id]['updated_at'] = $stud_money->updated_at;
                $stud_money_things[$stud_money->id]['title'] = $stud_money->description;

            }
        }
        return $stud_money_things;
    }
}

if (! function_exists('get_stud_total_money')) {
    function get_stud_total_money(){
        $total_money = 0;
        $stud_moneys = \App\StudMoney::where('user_id','=',auth()->user()->id)
            ->orderBy('id','DESC')
            ->get();
        foreach($stud_moneys as $stud_money) {
            if (!empty($stud_moneys)) {
                $total_money = $total_money + $stud_money->stud_money;
            }
        }
        return $total_money;
    }
}

if (! function_exists('mb_str_split')) {
    function mb_str_split($str){
        return preg_split('/(?<!^)(?!$)/u', $str );
    }
}