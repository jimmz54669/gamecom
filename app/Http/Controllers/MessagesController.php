<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Message;

class MessagesController extends Controller
{
    //
    public function FetchUserMessages($fromuserid, $touserid){
    
        //Get all User Message
        $FetchUserMessage = DB::table('messages')
        ->select('messages.id', 'messages.message', 'messages.fromuserid', 'messages.touserid', 'messages.status', 'users.id AS userid', 'users.fname', 'users.lname', 'users.profpic')
        ->leftJoin('users', 'users.id', '=', 'messages.fromuserid')
        ->where(function($query) use($fromuserid, $touserid)
            {
                $query->where('messages.fromuserid', '=', $fromuserid);
                $query->where('messages.touserid', '=', $touserid);
            })
        ->orWhere(function($query) use($fromuserid, $touserid)
            {
                $query->where('messages.touserid', '=', $fromuserid);
                $query->where('messages.fromuserid', '=', $touserid);
            })
        ->orderBy('messages.id')
        ->get();
      
        $GetUserInfo = DB::table('users')
        ->where('id', '=', $touserid)
        ->get();

        if(sizeof($FetchUserMessage) > 0){
            //Update Status of Message
            $updateStatus = DB::table('messages')
            ->where('fromuserid', '=', $fromuserid)
            ->where('touserid', '=', $touserid)
            ->where('status', '=', '1')
            ->update([
                'status' => '0'            
                ]);
       
            return response()->json(array('FetchUserMessage'=>$FetchUserMessage, 'GetUserInfo'=>$GetUserInfo));
        }else{
            return response()->json(['error' => 'error']);
        }

        
    }//End Function


    public function GetUserMessages(){
        $userid = Auth::user()->id;
        
        $GetUserMessages = DB::table('messages')
        ->select('users.profpic', 'users.fname', 'users.lname', 'users.id AS userid')
        ->leftJoin('users', function($join){
            $join->on('users.id', '=', 'messages.fromuserid')
                 ->orOn('users.id', '=', 'messages.touserid');
        })
        ->where('messages.fromuserid', '=', $userid)
        ->orWhere('messages.touserid', '=', $userid)
        ->groupBy('users.id')
        ->get();



        $GetUserInfo = DB::table('users')
        ->where('id', '=', $userid)
        ->get();
    
        return view('messages', compact('GetUserMessages', 'GetUserInfo'));
    }//End Function



    public function SendMessage(Request $request){
        $fromuserid = $request->fromuserid;
        $touserid = $request->touserid;
        $message = $request->message;

        $SendMessage = New Message;
        $SendMessage->fromuserid = $fromuserid;
        $SendMessage->touserid = $touserid;
        $SendMessage->message = $message;
        $SendMessage->status = 1;
        $SendMessage->save();

        $FetchUserMessage = $this->FetchUserMessages($fromuserid, $touserid);

        $GetUserInfo = DB::table('users')
        ->where('id', '=', $touserid)
        ->get();

        return response()->json(array('FetchUserMessage'=>$FetchUserMessage, 'GetUserInfo'=>$GetUserInfo));
    }// End Function



    public function DirectMessage($touserid){

        $userid = Auth::user()->id;
        
        $GetDirectUserMessages = DB::table('users')
        ->select('id as userid', 'fname', 'lname', 'profpic')
        ->where('id', '=', $touserid)
        ->get();



        $GetUserInfo = DB::table('users')
        ->where('id', '=', $userid)
        ->get();

        return view('messages', compact('GetDirectUserMessages', 'GetUserInfo'));
    }





    public function FetchDirectMessage($touserid){
        $fromuserid = Auth::user()->id;        
        //Get all User Message
        $FetchUserMessage = DB::table('messages')
        ->select('messages.id', 'messages.message', 'messages.fromuserid', 'messages.touserid', 'messages.status', 'users.id AS userid', 'users.fname', 'users.lname', 'users.profpic')
        ->leftJoin('users', 'users.id', '=', 'messages.fromuserid')
        ->where(function($query) use($fromuserid, $touserid)
            {
                $query->where('messages.fromuserid', '=', $fromuserid);
                $query->where('messages.touserid', '=', $touserid);
            })
        ->orWhere(function($query) use($fromuserid, $touserid)
            {
                $query->where('messages.touserid', '=', $fromuserid);
                $query->where('messages.fromuserid', '=', $touserid);
            })
        ->orderBy('messages.id')
        ->get();
      
        $GetUserInfo = DB::table('users')
        ->where('id', '=', $touserid)
        ->get();

        
        return response()->json(array('FetchUserMessage'=>$FetchUserMessage, 'GetUserInfo'=>$GetUserInfo));
       
        
    }//End Function


}//End Class
