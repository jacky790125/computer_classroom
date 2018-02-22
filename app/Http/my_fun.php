<?php
if (! function_exists('get_stud_money')) {
    function get_stud_money(){
        $stud_money_things = [];
        $stud_moneys1 = \App\StudMoney::where('user_id','=',auth()->user()->id)
            ->orderBy('id','DESC');
        $stud_moneys = $stud_moneys1->paginate(4);
        $total_num = $stud_moneys1->count();

        if(!empty($stud_moneys)){
            foreach($stud_moneys as $stud_money) {
                $stud_money_things[$stud_money->id]['stud_money'] = $stud_money->stud_money;
                if ($stud_money->stud_money > 0) {
                    $stud_money_things[$stud_money->id]['icon'] = "fa-long-arrow-up";
                    $stud_money_things[$stud_money->id]['pm'] = "+";
                    $stud_money_things[$stud_money->id]['color'] = "text-success";
                    $stud_money_things[$stud_money->id]['title'] = "得到點數 ";
                } else {
                    $stud_money_things[$stud_money->id]['icon'] = "fa-long-arrow-down";
                    $stud_money_things[$stud_money->id]['pm'] = "-";
                    $stud_money_things[$stud_money->id]['color'] = "text-danger";
                    $stud_money_things[$stud_money->id]['title'] = "失去點數 ";

                }
                $stud_money_things[$stud_money->id]['updated_at'] = $stud_money->updated_at;
                $stud_money_things[$stud_money->id]['description'] = $stud_money->description;
                $stud_money_things[$stud_money->id]['total'] = $total_num;

            }
        }
        return $stud_money_things;
    }
}

if (! function_exists('get_stud_total_money')) {
    function get_stud_total_money($user_id){
        $total_money = 0;
        $stud_moneys = \App\StudMoney::where('user_id','=',$user_id)
            ->orderBy('id','DESC')
            ->get();
        foreach($stud_moneys as $stud_money) {
            if (!empty($stud_moneys)) {
                $total_money = $total_money + $stud_money->stud_money;
            }
        }
        if(auth()->check()) {
            $stud_money = auth()->user()->money;
            if ($stud_money != $total_money) {
                $att['money'] = $total_money;
                \App\User::where('id', '=', auth()->user()->id)->update($att);
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

if (! function_exists('get_stud_message')) {
    function get_stud_message(){
        $stud_messages = \App\StudMessage::where('to','=',auth()->user()->username)
            ->where('read','=',"0")->paginate(4);

        $messages=[];

        if(!empty($stud_messages)){
            foreach($stud_messages as $stud_message){
                $messages[$stud_message->id]['date'] = substr($stud_message->created_at,0,10);
                $user = \App\User::where('username','=',$stud_message->from)->first();
                $messages[$stud_message->id]['from'] = $user->name;
                $messages[$stud_message->id]['title'] = $stud_message->title;
            }
        }

        return $messages;

    }
}

if (! function_exists('get_stud_total_message')) {
    function get_stud_total_message(){
        $total_message = \App\StudMessage::where('to','=',auth()->user()->username)
        ->where('read','=',"0")
        ->count();
        return $total_message;
    }
}