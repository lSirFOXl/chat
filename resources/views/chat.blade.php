@extends('layouts.app')

@section('content')

<?php
    use \App\User;
?>



<div class="chat">
    @if (Auth::guest())
        Для работы с чатом необходима авторизация!
    @else
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <?php
            if((isset($isAdminShow) && $isAdminShow == false) || !isset($isAdminShow)){
                DB::table('messages')
                    ->where([
                        ['sender', '=', $userIDOther],
                        ['recipient', '=', $userID]])
                    ->update(['checked' => true]);
            }
        ?>
        <script>
            $(document).ready(function(){
                
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                
                $(".messageForm-btn").click(function(){
                    $.ajax({

                        url: '/sendMessage',
                        type: 'POST',

                        data: {
                            _token: CSRF_TOKEN, 
                            message:$(".messageForm-message").val(), 
                            sender: "{{$userID}}",  
                            receiver: "{{$userIDOther}}"},

                        success: function (data) { 
                            $(".chat-window_messages").append(data);
                            $(".messageForm-message").val("");
                        }
                    }); 
                });
            }); 
        </script>
        <?php 
        
        /*DB::table('messages')->insert(
                ['sender' => 2, 'recipient' => 5, 'message' => "asd", 'checked' => false]
            );*/
            
            ?>
        <div class="chat-head">
            <div class="chat-head_recipient">
                <?php 
                    try {
                        $user = User::findOrFail($userIDOther);
                        echo $user['attributes']['name'];
                    }
                    catch (\Exception $e) {
                        return redirect('/');
                    }
                    
                ?>
            </div>
            <div   class="chat-head_sender">
                <?php 
                    $user = User::findOrFail($userID);
                    echo $user['attributes']['name'] ;
                ?>
            </div>
        </div>
        <div class="chat-window">
            <div class="chat-window_messages">
                <div class="chat-window_messages-inner">
                    <?php 
                        $messages = DB::table('messages')
                            ->where([
                                ['sender', '=', $userID],
                                ['recipient', '=', $userIDOther]])
                            ->orWhere([
                                ['sender', '=', $userIDOther],
                                ['recipient', '=', $userID]])
                            ->orderBy('created_at', 'asc')->get();
                        
                        foreach ($messages as $key => $value) {
                            ?>
                                <div class="messageItem {{ $value->sender == $userID ? 'messageItemSender' : '' }}">
                                    <div class="messageItem-head">
                                        <span class="messageItem-head_name">
                                            {{User::findOrFail($value->sender)['attributes']['name']}}
                                        </span>
                                        |
                                        <span class="messageItem-head_date">
                                            {{$value->created_at}}
                                        </span>
                                    </div>
                                    <div class="messageItem-bottom">
                                        {{$value->message}}
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
            
            <div class="chat-window_input">
                <div id="messageForm">
                    <textarea class="messageForm-message"></textarea>
                    <div class="chat-window_input-btn">
                        <button type="submit" class="btn btn-primary messageForm-btn">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
        <script>$(".chat-window_messages").scrollTop($(".chat-window_messages").height());</script>
    @endif

    <!--
        Вы в чате
    -->
</div>



@endsection
