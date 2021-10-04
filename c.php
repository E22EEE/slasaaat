<?php
ob_start();
define('API_KEY', '1977123988:AAH7wHWEqHTjFlZZul_qlM8J96wshocxar4');
echo file_get_contents("https://api.telegram.org/bot" . API_KEY . "/setwebhook?url=" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['SCRIPT_NAME']);

function bot($method, $datas = [])
  {
  $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
  $res = curl_exec($ch);
  if (curl_error($ch))
    {
    var_dump(curl_error($ch));
    }
    else
    {
    return json_decode($res);
    }
  }

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id2 = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$from_id = $message->from->id;
$name = $update->message->from->first_name;
$from_id = $message->from->id;
$u = explode("\n",file_get_contents("memb.txt"));
$c = count($u)-1;
$modxe = file_get_contents("usr.txt");
$admin = 1792397908;
$username = $update->message->from->username;
$reply = $message->reply_to_message->message_id;
$list = file_get_contents("blocklist.txt");
$rep = $message->reply_to_message->forward_from; 
$id = $rep->id; 
$ch = "@e22ee2";
$join = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$ch&user_id=".$from_id);
if($message && (strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"'))!== false){
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"يجـب عليك الاشتراك في قناة البـوت؛◾️
ليتم تشغيل البـوت القناة » $ch ؛💕
ثمه ارسل /start مجداا؛ 😋🌜",
]);
  bot("sendmessage",[
    "chat_id"=>$admin,
    "text"=>"- العضو قام بألاشتراك في قناة البوت ، 📌
- معلومات العضو الذي قام بألاشتراك ؛

• الاسم ؛ $name 
• الايدي ؛ $from_id
• المعرف ؛ @$username
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎	",
    ]);
    die('مشيولي');
}

$ebu = explode("\n",$list);
if(in_array($from_id,$ebu)){
    bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"▪️ انت محظور من قبل صاحب البوت ،
▫️ لا يمكنك استخدام البوت ، 🚫
 ﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
[• اضغط هنا وتابع جديدنا 🌐؛](https://t.me/$ch)
 ",
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
      ]);
    
}


if($text && $from_id !== $admin){
bot('forwardMessage',[
'chat_id'=>$admin,
'from_chat_id'=>$chat_id,
'message_id'=>$update->message->message_id,
'text'=>$text,
]);
}

if ($text and $message->reply_to_message && $text!="/info" && $text!="/ban" && $text!="/unban" && $text!="/forward") {
  bot('sendMessage',[
'chat_id'=>$message->reply_to_message->forward_from->id,
    'text'=>$text,
    ]);
}

if ($text == '/start' && $chat_id != $list){
  bot('sendMessage', [
  'chat_id' => $chat_id, 
  'text' => "", 'parse_mode' => "MarkDown", 'disable_web_page_preview' => true, 'reply_markup' => json_encode(['inline_keyboard' => [[['text' => "• اضغط هنا وتابع جديدنا 🌈؛", 'url' => "https://t.me/$chs"]], ]]) ]);
  if ($update && !in_array($chat_id, $u)) {
    file_put_contents("memb.txt", $chat_id."\n",FILE_APPEND);
  }
  }

if ($text == "/start" and $chat_id == $admin ) {
    bot('sendMessage',[
        'chat_id'=>$chat_id,
      'text'=>"اهـلا بـك مديري : » ◾️
أليك الاوامر الخاصه : »🔻",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>'رسالةه للكل؛🍃🌜','callback_data'=>'ce']],[['text'=>'عـدد الاعضاء؛🍃🌛','callback_data'=>'co']],
[['text'=>'معلومات اضافيه','callback_data'=>'cr']],
            ]
            ])
        ]);
}

if ($message->reply_to_message && $text== "حظر") {
			$myfile2 = fopen("blocklist.txt", "a") or die("Unable to open file!");	
			fwrite($myfile2, "$id\n");
			fclose($myfile2);
			bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"📌┇تم حظر العضو من البوت ،
📃┇ايدي العضو ؛ $id .",
]);
			bot('sendmessage',[
'chat_id'=>$id,
'text'=>"⚠️┇عذرا عزيزي تم حظرك من هذا البوت ،
📮┇تابع قناة البوت ؛ @$ch .",
]);
		}
		
		if($message->reply_to_message && $text=="الغاء الحظر"){
			$newlist = str_replace($id,"",$list);
			file_put_contents("blocklist.txt",$newlist);
			bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"📌┇تم الغاء حظر العضو ،
📃┇ايدي العضو ؛ $id .",
]);
			bot('sendmessage',[
'chat_id'=>$id,
'text'=>"⚠️┇ عزيزي تم الغاء حظرك من هذا البوت ،
📮┇تابع قناة البوت ؛ @$ch .",
]);
}


if($data == "co" and $update->callback_query->message->chat->id == $admin ){ 
    bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"
        عدد مشتركين البوت📢 :- [ $c ] .
        ",
        'show_alert'=>true,
]);
}
if($data == "cr" and $update->callback_query->message->chat->id == $admin ){ 
    bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"حـظر » لحظر الشخص
الغاء الحظر » الغاء حذر الشخص
جمـيع الحقوق محفوظه ©
للاستفسار » @k5ot9",
        'show_alert'=>true,
]);
}
if($data == "ce" and $update->callback_query->message->chat->id == $admin){ 
    file_put_contents("usr.txt","yas");
    bot('EditMessageText',[
    'chat_id'=>$update->callback_query->message->chat->id,
    'message_id'=>$update->callback_query->message->message_id,
    'text'=>"▪️ ارسل رسالتك الان 📩 وسيتم نشرها لـ [ $c ] مشترك . 
   ",
    'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>' الغاء 🚫 •','callback_data'=>'off']]    
        ]
    ])
    ]);
}
if($data == "off" and $update->callback_query->message->chat->id == $admin){ 
bot('editMessageText',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id,
      'text'=>"اهـلا بـك مديري : » ◾️
أليك الاوامر الخاصه : »🔻",
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>'رسالةه للكل؛🍃🌜','callback_data'=>'ce']],[['text'=>'عـدد الاعضاء؛🍃🌛','callback_data'=>'co']],
            ]
            ])
]);
file_put_contents('usr.txt', '');
}

if($text and $modxe == "yas" and $chat_id == $admin ){
    for ($i=0; $i < count($u); $i++) { 
        bot('sendMessage',[
          'chat_id'=>$u[$i],
          'text'=>"
          $text
▪️﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎▪️",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,

]);
    file_put_contents("usr.txt","no");

} 
}


$update 	= json_decode(file_get_contents('php://input'));
$message 	= $update->message;
$text 	 	= $message->text;
$chat_id 	= $message->chat->id;
$name 		= $message->from->first_name;
$user 		= $message->from->username;
$message_id = $update->message->message_id;

if (isset($update->channel_post)) {
	$chat_id    = $update->channel_post->chat->id;
	$message_id = $update->channel_post->message_id;
	$message = $update->channel_post;
	$text       = $update->channel_post->text;
	if ($update->channel_post->message->caption) {
		$text = $update->channel_post->message->caption;
	}
}
$s = 548336814; //ايديك
$us = explode("\n", file_get_contents("us.txt"));
$bot = json_decode(file_get_contents("bot.json"),true);
if (!file_exists("bot.json")) {
	$put = [];
	file_put_contents("bot.json", json_encode($put));
}
if(preg_match('/^\/(add)(.*)/',$text) and $chat_id == $s){
    $text = explode(" ",str_replace("/add ","",$text));
    $bot[$text[0]] = $text[1];
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"تـمت اضافه الحمايه الـي القناه ❱💗"
        ]);
        file_put_contents("bot.json", json_encode($bot));
}
if($text == '/start' and isset($bot[$chat_id])){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"اهـلا بك يا مديري
في بـوت حمايه القنوات من المخربين؛◾️
لان وبكل سهوله اقفل جميع الوسائط؛🔒
من صور ومتحركات وروابط وغيرها؛🖇
تم عرض الاوامر في الاسفل حظا موفقا؛🧚‍♂",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'قـسم القفل ❱🔒'],
['text'=>'قـسم الفتح ❱🔓']],
[['text'=>'مساعده ❱☑️']]],
'resize_keyboard'=>true
])
]);
}

if($text == '/start' and $chat_id != isset($bot[$chat_id]))
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🕵‍♂¦ اهلا بك يا 👋🏻 ؛ صديقي
 🚸¦ في بوت حمايه القنوات من المخربين
✔️¦ يمكنك لان بكل سهوله قفل جميع الوسائط
🎉¦ التفعيل البوت راسل المطور",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,

'reply_to_message_id'=>$mid,
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>"المطور 🔱 -", "url"=>"https://t.me/k5ot9"]],

]])]);

if($text== 'رجـوع »💯' and isset($bot[$chat_id])){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"اهـلا بـك فـي اداره قنـاتك ❱💗
يمكنـك لان قفل الوسـائط ❱🔒
تم عرض الاوامر في الاسفل ❱💠",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'قـسم القفل ❱🔒'],
['text'=>'قـسم الفتح ❱🔓']],
[['text'=>'مساعده ❱☑️']]],
'resize_keyboard'=>true
])
]);
}
if($text== 'مساعده ❱☑️' and isset($bot[$chat_id])){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"اهـلا بـك في قـسم المساعده ❱✔️
اكتـب »قفل«القفل ما تريد »💯
اكتـب »فتح«الفتح ماتريد »💯
- الروابط
- المعرف
- التوجيه
- الملصقات
- الصور
- الفيديو
- المحادثه
- المتحركه
- الملفات
- جهات الاتصال
- الموسيقى
-الصوت
او يمكنك الاختيار مـטּ الاقسام ❱☑️💯",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'رجـوع »💯']]],
'resize_keyboard'=>true
])
]);
}
if($text== 'قـسم القفل ❱🔒' and isset($bot[$chat_id])){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"اقفـل احد الوسائط ❱📌",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'قفل الروابط'],
['text'=>'قفل التوجيه']],
[['text'=>'قفل المعرف'],
['text'=>'قفل الصور']],
[['text'=>'قفل الفيديو'],
['text'=>'قفل الملصقات']],
[['text'=>'قفل الملفات'],
['text'=>'قفل الصوت']],
[['text'=>'قفل الموسيقى'],
['text'=>'قفل جهات الاتصال']],
[['text'=>'قفل المحادثه'],
['text'=>'قفل المتحركه']],
[['text'=>'رجـوع »💯']]],
'resize_keyboard'=>true
])
]);
}
if($text== 'قـسم الفتح ❱🔓' and isset($bot[$chat_id])){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"افتح احد الوسائط ❱📌",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'فتح الروابط'],
['text'=>'فتح التوجيه']],
[['text'=>'فتح المعرف'],
['text'=>'فتح الصور']],
[['text'=>'فتح الفيديو'],
['text'=>'فتح الملصقات']],
[['text'=>'فتح الملفات'],
['text'=>'فتح الصوت']],
[['text'=>'فتح الموسيقى'],
['text'=>'فتح جهات الاتصال']],
[['text'=>'فتح المحادثه'],
['text'=>'فتح المتحركه']],
[['text'=>'رجـوع »💯']]],
'resize_keyboard'=>true
])
]);
}



if ($text== 'قفل الروابط' ) {
	if ($bot[$bot[$chat_id]]['links'] != true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل الروابط بنجاح »📎",
		]);
		$bot[$bot[$chat_id]]['links'] = true;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل الروابط مسبقا »🖇",
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'قفل التوجيه' ) {
	if ($bot[$bot[$chat_id]]['fwd'] != true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل التوجيه بنجاح »📝",
		]);
		$bot[$bot[$chat_id]]['fwd'] = true;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل التوجيه مسبقا »🔏",
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'قفل المعرف' ) {
	if ($bot[$bot[$chat_id]]['user'] != true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل المعرف بنجاح »📘",
		]);
		$bot[$bot[$chat_id]]['user'] = true;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل المعرف مسبقا »📙"
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'قفل الصور' ) {
	if ($bot[$bot[$chat_id]]['f1'] != true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل الصور بنجاح»🏞",
		]);
		$bot[$bot[$chat_id]]['f1'] = true;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل الصور مسبقا»🏞"
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'قفل الملصقات' ) {
	if ($bot[$bot[$chat_id]]['f2'] != true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل الملصقات بنجاح»🎡",
		]);
		$bot[$bot[$chat_id]]['f2'] = true;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل الملصقات مسبقا»🎡"
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'قفل الفيديو' ) {
	if ($bot[$bot[$chat_id]]['f3'] != true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل الفيديو بنجاح »🚀",
		]);
		$bot[$bot[$chat_id]]['f3'] = true;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل الفيديو مسبقا »🚀"
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'قفل الصوت' ) {
	if ($bot[$bot[$chat_id]]['f4'] != true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل الصوت بنجاح »🎵",
		]);
		$bot[$bot[$chat_id]]['f4'] = true;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل الصوت مسبقا »🎵"
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'قفل الموسيقى' ) {
	if ($bot[$bot[$chat_id]]['f5'] != true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل الموسيقى بنجاح »☑️",
		]);
		$bot[$bot[$chat_id]]['f5'] = true;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل الموسيقى مسبقا »✔️"
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'قفل الملفات' ) {
	if ($bot[$bot[$chat_id]]['f6'] != true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل الملفات بنجاح»📂",
		]);
		$bot[$bot[$chat_id]]['f6'] = true;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل الملفات مسبقا»📁"
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'قفل جهات الاتصال' ) {
	if ($bot[$bot[$chat_id]]['f7'] != true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل جهات الاتصال بنجاح»🗞",
		]);
		$bot[$bot[$chat_id]]['f7'] = true;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل جهات الاتصال مسبقا»📇"
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'قفل المحادثه' ) {
	if ($bot[$bot[$chat_id]]['f8'] != true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل محادثه القناة بنجاح»💟",
		]);
		$bot[$bot[$chat_id]]['f8'] = true;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل محادثه القناة مسبقا»♍️"
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'قفل المتحركه' ) {
	if ($bot[$bot[$chat_id]]['f9'] != true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل المتحركه بنجاح»♍️",
		]);
		$bot[$bot[$chat_id]]['f9'] = true;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم قفل المتحركه مسبقا»💯"
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}


///قسـم الفتح///
if ($text== 'فتح المعرف' ) {
	if ($bot[$bot[$chat_id]]['user'] == true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح المعرف بنجاح »🛰",
		]);
		$bot[$bot[$chat_id]]['user'] = false;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح المعرف مسبقا »🚧",
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'فتح الروابط' ) {
	if ($bot[$bot[$chat_id]]['links'] == true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الروابط بنجاح »🗽",
		]);
		$bot[$bot[$chat_id]]['links'] = false;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الروابط مسبقا »🎡",
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'فتح التوجيه' ) {
	if ($bot[$bot[$chat_id]]['fwd'] == true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح التوجيه بنجاح »🔱",
		]);
		$bot[$bot[$chat_id]]['fwd'] = false;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح التوجيه مسبقا »✨",
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'فتح الصور' ) {
	if ($bot[$bot[$chat_id]]['f1'] == true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الصور بنجاح »🔱",
		]);
		$bot[$bot[$chat_id]]['f1'] = false;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الصور مسبقا »✨",
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'فتح الملصقات' ) {
	if ($bot[$bot[$chat_id]]['f2'] == true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الملصقات بنجاح »🔱",
		]);
		$bot[$bot[$chat_id]]['f2'] = false;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الملصقا مسبقا »✨",
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'فتح الفيديو' ) {
	if ($bot[$bot[$chat_id]]['f3'] == true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الفيديو بنجاح »🔱",
		]);
		$bot[$bot[$chat_id]]['f3'] = false;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الفيديو مسبقا »✨",
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'فتح الصوت' ) {
	if ($bot[$bot[$chat_id]]['f4'] == true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الصوت بنجاح »🔱",
		]);
		$bot[$bot[$chat_id]]['f4'] = false;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الصوت مسبقا »✨",
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'قفل الموسيقى' ) {
	if ($bot[$bot[$chat_id]]['f5'] == true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الموسيقى بنجاح »🔱",
		]);
		$bot[$bot[$chat_id]]['f5'] = false;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الموسيقى مسبقا »✨",
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'فتح الملفات' ) {
	if ($bot[$bot[$chat_id]]['f6'] == true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الملفات بنجاح »🔱",
		]);
		$bot[$bot[$chat_id]]['f6'] = false;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الملفات مسبقا »✨",
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'فتح جهات الاتصال' ) {
	if ($bot[$bot[$chat_id]]['f7'] == true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الجهات بنجاح »🔱",
		]);
		$bot[$bot[$chat_id]]['f7'] = false;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح الجهات مسبقا »✨",
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'فتح المحادثه' ) {
	if ($bot[$bot[$chat_id]]['f8'] == true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح المحادثه بنجاح »🔱",
		]);
		$bot[$bot[$chat_id]]['f8'] = false;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح المحادثه مسبقا »✨",
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}
if ($text== 'فتح المتحركه' ) {
	if ($bot[$bot[$chat_id]]['f9'] == true) {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح المتحركه بنجاح »🔱",
		]);
		$bot[$bot[$chat_id]]['f9'] = false;
	} else {
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>"تـم فتح المتحركه مسبقا »✨",
		]);
	}	
	file_put_contents("bot.json", json_encode($bot));
}


if ($update->channel_post) {
	if($bot['@'.$update->channel_post->chat->username]['links'] == true and preg_match('/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me|(.*)telesco.me|telesco.me(.*)/i',$update->channel_post->text) ){
	       bot('deleteMessage',[
	         'chat_id'=>$chat_id,
	         'message_id'=>$message->message_id
	      ]);
	}
	if($bot['@'.$update->channel_post->chat->username]['user'] == true and  preg_match('/^(.*)@|@(.*)|(.*)@(.*)|(.*)#(.*)|#(.*)|(.*)#/',$text)){
       bot('deleteMessage',[
        'chat_id'=>$chat_id,
        'message_id'=>$message->message_id
       ]);
    }
    if($update->channel_post->forward_from_chat or $update->channel_post->forward_from && $bot['@'.$update->channel_post->chat->username]['fwd'] == true){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
}
if($message->photo && $bot['@'.$update->channel_post->chat->username]['f1'] == true){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
    if($message->sticker && $bot['@'.$update->channel_post->chat->username]['f2'] == true){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
    if($message->video && $bot['@'.$update->channel_post->chat->username]['f3'] == true){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
    if($message->voice && $bot['@'.$update->channel_post->chat->username]['f4'] == true){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
    if($message->audio && $bot['@'.$update->channel_post->chat->username]['f5'] == true){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
    if($message->document && $bot['@'.$update->channel_post->chat->username]['f6'] == true){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
    if($message->contact && $bot['@'.$update->channel_post->chat->username]['f7'] == true){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
    if($message->text && $bot['@'.$update->channel_post->chat->username]['f8'] == true){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
    if($message->gif && $bot['@'.$update->channel_post->chat->username]['f9'] == true){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
	
	
	
