<?php
if(empty($_POST['user'])){
    echo "ユーザー名を入力してください。";
    exit;
}
if(!preg_match('/\A[[:^cntrl:]]{1,255}\z/u',$_POST['user'])){
    echo "ユーザー名は255文字までです。";
    exit;
}

if(!preg_match('/\A[[:^cntrl:]]{0,255}\z/u',$_POST['password'])){
    echo "パスワードは255文字以内で入力してください。";
    exit;
}

