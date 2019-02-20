@extends('layouts.app')

@section('content')

<?php
    use \App\User;
    use \App\Helpers\AppHelper;
?>

<div class="row">
    <div class="col-md-12">
        @if (Auth::guest())
            Для работы с чатом необходима авторизация!
        @else
            
                <?php
                    $newChats = appGlobal::getChatsWithUser($userID);

                    $alreadyUse = [];

                    if(Count($newChats) > 0){
                        ?><h2>
                            Список чатов
                            @if((isset($isAdminShow) && $isAdminShow == true))
                                {{'('.User::findOrFail($userID)['attributes']['name'].')'}}
                            @endif
                        </h2> 
                        <div class="row userList"><?php

                        foreach ($newChats as $key => $value) {
                            ?>
                                <div class="col-md-4 col-sm-6 userList-item">
                                    <div class="userList-item_inner">
                                        <span class="userList-item_name">
                                            <?php
                                                if($value->sender == $userID) echo User::findOrFail($value->recipient)['attributes']['name'];
                                                else echo User::findOrFail($value->sender)['attributes']['name'];
                                            ?> 
                                            |                                         
                                            <?php
                                                if($value->sender != $userID) echo $value->uncheckedcount;
                                                else echo 0;
                                            ?>
                                        </span>
                                        <a href="<?php 
                                            if((isset($isAdminShow) && $isAdminShow == false) || !isset($isAdminShow)){
                                                echo '/chat/';
                                                if($value->sender == $userID) echo $value->recipient;
                                                else echo $value->sender;
                                            }
                                            else{
                                                echo '/chat/';
                                                if($value->sender == $userID) echo $value->recipient.'/'.$value->sender;
                                                else echo $value->sender.'/'.$value->recipient;
                                            }
                                        ?>" role="button" class="btn btn-primary userList-item_button">
                                            Войти в чат
                                        </a>
                                        
                                    </div>
                                        
                                </div>
                            <?php
                            
                        }

                        echo '</div>';
                    }
                ?>
            @if((isset($isAdminShow) && $isAdminShow == false) || !isset($isAdminShow))
            <h2>Список пользователей</h2>
                <div class="row userList userList-all">
                    <?php 
                        $users = DB::table('users')->get(); 
                        foreach ($users as $key => $value) {
                            if($value->id != $userID && User::findOrFail($value->id)['attributes']['privilege'] != 0){
                                ?>
                                    <div class="col-md-4 col-sm-6 userList-item">
                                        <div class="userList-item_inner">
                                            <span class="userList-item_name">
                                                {{ $value->name }}
                                            </span>

                                            @if(User::findOrFail($userID)['attributes']['privilege'] == 0)
                                                <a href="/userChats/{{ $value->id }}" role="button" class="btn btn-warning userList-item_button userList-item_buttonChats">
                                                    Чаты
                                                </a>
                                                <a href="/delete/{{ $value->id }}" role="button" class="btn btn-danger userList-item_button userList-item_buttonDel">
                                                    Удалить
                                                </a>
                                            @else
                                                <a href="/chat/{{ $value->id }}" role="button" class="btn btn-primary userList-item_button">
                                                    Начать общение
                                                </a>
                                            @endif
                                        </div>
                                        
                                    </div>
                                <?php
                            }
                            
                        }
                    ?>
                </div>
            @endif
        @endif
    </div>
</div>



@endsection
