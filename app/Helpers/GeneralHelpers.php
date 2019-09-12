<?php


if (! function_exists('getUserAddress')) {
    function getUserAddress($id)
    {

        $address = \Illuminate\Support\Facades\DB::table('countries')
            ->join('cities','countries.id','=','cities.country_id')
            ->where('cities.id',$id)->first();

        return $address;
    }


}



if (! function_exists('getUnreadMessages')) {
    function getUnreadMessages($id)
    {

        $messages = \Illuminate\Support\Facades\DB::table('user_chats')
            ->where('resever_id',$id)
            ->where('status',0)
            ->count();

        return $messages;
    }


}