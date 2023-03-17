@extends('layouts.app')
   
    

@section('content')



<div class="container" style="margin-top: 90px;">
    <div class="row chats">
        <div class="col-lg-4 col-md-5">
            <div class="user-list-container card">
                @if(isset($GetUserInfo))
                @foreach($GetUserInfo as $uinfo)
                <div class="user-pic">
                    @if($uinfo->profpic != '')
                    <img src="{{ url('./images/'.$uinfo->profpic)}}" class="user-dp">
                    @else
                    <img src="{{ url('./images/logo2.png')}}" class="user-dp">
                    @endif
                    <p>{{$uinfo->fname}} {{$uinfo->lname}}</p>
                </div>
                @endforeach
                @endif
                <hr>
                
                <div class="user-list">
                    @if(isset($GetUserMessages))
                        @foreach($GetUserMessages as $GetUserMessage)
                            @if($GetUserMessage->userid != Auth::user()->id)
                            <div class="user-to-msg" onclick="chatMenuToggle()" data-touserid="{{$GetUserMessage->userid}}" data-fromuserid="{{Auth::user()->id}}">
                                @if($GetUserMessage->profpic != '')
                                <img src="{{ url('./images/'.$GetUserMessage->profpic)}}" class="user-dp">
                                @else
                                <img src="{{ url('./images/logo2.png')}}" class="user-dp">
                                @endif
                                <p>{{$GetUserMessage->fname}} {{$GetUserMessage->lname}}</p>
                            </div>
                            @endif
                        @endforeach
                    @endif

                    @if(isset($GetDirectUserMessages))
                        @foreach($GetDirectUserMessages as $GetDirectUserMessage)
                            @if($GetDirectUserMessage->userid != Auth::user()->id)
                            <div class="user-to-directmsg" onclick="chatMenuToggle()" data-touserid="{{$GetDirectUserMessage->userid}}" data-fromuserid="{{Auth::user()->id}}">
                                @if($GetDirectUserMessage->profpic != '')
                                <img src="{{ url('./images/'.$GetDirectUserMessage->profpic)}}" class="user-dp">
                                @else
                                <img src="{{ url('./images/logo2.png')}}" class="user-dp">
                                @endif
                                <p>{{$GetDirectUserMessage->fname}} {{$GetDirectUserMessage->lname}}</p>
                            </div>
                            @endif
                        @endforeach
                    @endif
      
                </div>
                


            </div>
        </div>
        <div class="col-lg-5 col-md-6">
            <div class="chat-menu card">
                <div class="chat-menu-inner p-3 mb-0">
                    <div class="chat-acc">
                    </div>
                </div>
                <hr>
                <div class="chat-box-msgs p-3">

                    <!-- <div class="other-user-msg">                   
                        <img src="{{ url('./images/logo2.png')}}" class="user-dp">
                        <div class="other-user-chat card">asdasdasd</div>
                    </div> -->

                    <!-- <div class="user-profile">
                        <div class="user-chat card">dsasdasdsadasdas</div>
                        <img src="{{ url('./images/logo2.png')}}" class="user-dp">
                    </div> -->

                </div>
                <hr>
                <div class="user-chat-box">
                    <!-- <input type="textarea" class="user-text-chat" onfocus="this.value=''; this.style.color='violet'" id="user-text-chat" placeholder="Write message...">
                    <input type="button" class="btn chat-submit" value="Send"></input> -->
                </div>
            </div>
        </div>
    </div>
</div> 

@endsection