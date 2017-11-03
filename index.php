<?php
ob_start();
include 'Class.php';
$button_manage = json_encode(['keyboard'=>[
[['text'=>'↩️منوی اصلی']],
[['text'=>'📪پیام همگانی'],['text'=>'📮فوروارد همگانی']],
[['text'=>'💰سکه همگانی'],['text'=>'🔖پیگیری سفارش']],
[['text'=>'📊آمار'],['text'=>'🆓تعیین کد رایگان']],
],'resize_keyboard'=>true]);
$button_official = json_encode(['keyboard'=>[
[['text'=>'☢جمع آوری سکه رایگان در ربات'],['text'=>'📣جمع آوری سکه رایگان در چنل']],
[['text'=>'📍قوانین'],['text'=>'🔸فروشگاه'],['text'=>'↕️انتقال سکه']],
[['text'=>'👥حساب کاربری'],['text'=>'✅ثبت تبلیغ'],['text'=>'▪️کد رایگان']],
[['text'=>'📇پیگیری سفارشات'],['text'=>'⭕️زیرمجموعه گیری'],['text'=>'🗳ارتباط با ما']],
],'resize_keyboard'=>true]);
$button_back = json_encode(['keyboard'=>[
[['text'=>'↩️منوی اصلی']],
],'resize_keyboard'=>true]);
$update = json_decode(file_get_contents('php://input'));
$data = $update->callback_query->data;
$chatid = $update->callback_query->message->chat->id;
$fromid = $update->callback_query->message->from->id;
$frmid = $update->callback_query->from->id;
$messageid = $update->callback_query->message->message_id;
$data_id = $update->callback_query->id;
$txt = $update->callback_query->message->text;
$chat_id = $update->message->chat->id;
$from_id = $update->message->from->id;
$from_username = $update->message->from->username;
$from_first = $update->message->from->first_name;
$forward_id = $update->message->forward_from->id;
$forward_chat = $update->message->forward_from_chat;
$forward_chat_username = $update->message->forward_from_chat->username;
$forward_chat_msg_id = $update->message->forward_from_message_id;
$text = $update->message->text;
$message_id = $update->message->message_id;
$stickerid = $update->message->sticker->file_id;
$videoid = $update->message->video->file_id;
$voiceid = $update->message->voice->file_id;
$fileid = $update->message->document->file_id;
$photo = $update->message->photo;
$photoid = $photo[count($photo)-1]->file_id;
$musicid = $update->message->audio->file_id;
$caption = $update->message->caption;
$cde = time();
$code = "$from_id$cde";
$command = file_get_contents('user/'.$from_id."/command.txt");
$gold = file_get_contents('user/'.$from_id."/gold.txt");
$coin = file_get_contents('user/'.$from_id."/coin.txt");
$wait = file_get_contents('user/'.$from_id."/wait.txt");
$coin_wait = file_get_contents('user/'.$wait."/coin.txt");
$pay = file_get_contents('user/'.$from_id."/pay.txt");
$tr = file_get_contents('user/'.$from_id."/tr.txt");
$nmber = file_get_contents('user/'.$from_id."/nmber.txt");
$tarikh = file_get_contents('user/'.$from_id."/tarikh.txt");
$spam = file_get_contents('user/'.$from_id."/spam.txt");
$Member = file_get_contents('admin/Member.txt');
$NZR = file_get_contents('admin/NZR.txt');
$Tedad_Nazar = file_get_contents('admin/Tedad Nazar.txt');
$ads = file_get_contents('ads/Ads.txt');
$ads_end = file_get_contents('ads/Ads End.txt');
$ads_all = file_get_contents('ads/Ads All.txt');
$dt = json_decode(file_get_contents("http://api.mostafa-am.ir/date-time/"));
$date = $dt->date_fa;
$time = $dt->time_fa;
$block = file_get_contents('admin/block.txt');
// start source
    if (strpos($block , "$from_id") !== false) {
	return false;
	}
	elseif ($from_id != $chat_id and $chat_id != $feed) {
	LeaveChat($chat_id);
	}
	elseif (strpos($data , "sabtbazdid-") !== false) {
	$data = str_replace("sabtbazdid-",'',$data);
	$adn = file_get_contents("ads/ads admin/$data.txt");
	$usr = file_get_contents("ads/ads tally/$data.txt");
    $pmembersid = explode("\n",$usr);
	$member_id = explode("\n",$usr);
    $mmemcount = count($member_id);
	$tdd = file_get_contents("ads/ads tedad/$data.txt");
	if($adn == $frmid){
	AnswerCallbackQuery($data_id,'شما ادمین این پست هستید.');
	}
	elseif(file_get_contents("ads/ads etmam/$data.txt") == 'true'){
	AnswerCallbackQuery($data_id,'بازدید این پست تمام شده است.');
	}
	elseif(in_array($frmid,$pmembersid)){
	AnswerCallbackQuery($data_id,'شما قبلا از این پست دیدن کرده اید.');
	}
	else{
	if (!in_array($frmid,$pmembersid)){
	$aaddd = file_get_contents("ads/ads tally/$data.txt");
    $aaddd .= $frmid."\n";
	file_put_contents("ads/ads tally/$data.txt",$aaddd);
    }
	AnswerCallbackQuery($data_id,'بازدید شما ثبت شد.');
	file_put_contents("user/$frmid/coin.txt",(file_get_contents("user/$frmid/coin.txt") + 1) );
	if($mmemcount >= $tdd){
	SendMessage($adn,"☢ سفارش تبلیغ با کد پیگیری $data در $date | $time تموم شد.","html","true");
	file_put_contents("ads/ads ok/$data.txt",'اتمام');
	file_put_contents("ads/Ads End.txt","$ads_end\n$data");
	file_put_contents("ads/ads end/$data.txt","$date | $time");
	file_put_contents("ads/ads etmam/$data.txt","true");
	$str = str_replace("$data\n",'',$ads);
	$str = str_replace("\n\n","\n",$ads);
	$str = str_replace("\n$data",'',$ads);
	$str = str_replace("$data",'',$ads);
	file_put_contents("ads/Ads.txt",$str);
	}
	}
	}
	elseif($data){
	$ex = explode("|",$data);
	if($ex[0] == 'taiid'){
	$txxt = file_get_contents('ads/Ads.txt');
    $pmembersid= explode("\n",$txxt);
    if (!in_array($ex[2],$pmembersid)){
      $aaddd = file_get_contents('ads/Ads.txt');
      $aaddd .= $ex[2]."\n";
		file_put_contents('ads/Ads.txt',$aaddd);
    }
	unlink("ads/ads etmam/$ex[2].txt");
	$msg_id = file_get_contents("ads/ads msg id/$ex[2].txt");
    $msg_user = file_get_contents("ads/ads username/$ex[2].txt");
	$for = bot('ForwardMessage',['chat_id'=>$Channel,'from_chat_id'=>$msg_user,'message_id'=>$msg_id]);
	bot('sendMessage',[
	'chat_id'=>$Channel,
	'text'=>"🔘 جهت ثبت بازدید و دریافت سکه روی (✅ ثبت بازدید) کلیک کنید.",
	'parse_mode'=>"html",
	'reply_to_message_id'=>$for->result->message_id,
	'reply_markup'=>json_encode(['inline_keyboard'=>[
	[['text'=>'✅ ثبت بازدید','callback_data'=>"sabtbazdid-$ex[2]"],['text'=>'📣تایگن تک','url'=>"http://telegram.me/TigenTech"]],
	],'resize_keyboard'=>true])
	]);
	AnswerCallbackQuery($data_id,'✅ پست مورد نظر تایید شد');
	file_put_contents("ads/ads ok/$ex[2].txt",'در حال اجرا...');
    EditMessageText($chatid,$messageid,"✅ پست مورد نظر تایید شد
	
	📇 کد پیگیری: $ex[2]",'html','true');
	SendMessage($ex[1],"✅ پست شما توسط مدیران تایید شد.
	
	📇 کد پیگیری: $ex[2]","html","true");
	}
	else{
	file_put_contents('user/'.$chatid."/command.txt","rad post");
	file_put_contents('user/'.$chatid."/wait.txt","$ex[1]|$ex[2]");
	AnswerCallbackQuery($data_id,'💢 پست مورد نظر رد شد');
	SendMessage($chatid,"❌ دلیل رد پست رو وارد کنید:","html","true",$button_back);
	}
	}
	elseif($command == 'rad post'){
	file_put_contents('user/'.$from_id."/command.txt","none");
	$ex = explode("|",$wait);
	file_put_contents("ads/ads ok/$ex[1].txt",'تایید نشده');
	file_put_contents("ads/ads rad/$ex[1].txt",$text);
	SendMessage($ex[0],"❌ پست شما توسط مدیران رد شد.
	
	📇 کد پیگیری: $ex[1]
	
	💢 بدلیل: $text","html","true");
	SendMessage($from_id,"❌ پست مورد نظر رد شد.
	
	📇 کد پیگیری: $ex[1]
	
	💢 بدلیل: $text","html","true",$button_official);
	}
  //===============
	elseif(preg_match('/^\/([Ss]tart)(.*)/',$text)){
	preg_match('/^\/([Ss]tart)(.*)/',$text,$match);
	$match[2] = str_replace(" ","",$match[2]);
	$match[2] = str_replace("\n","",$match[2]);
	if($match[2] != null){
	if (strpos($Member , "$from_id") == false){
	if($match[2] != $from_id){
	if (strpos($gold , "$from_id") == false){
	$txxt = file_get_contents('user/'.$match[2]."/gold.txt");
    $pmembersid= explode("\n",$txxt);
    if (!in_array($from_id,$pmembersid)){
      $aaddd = file_get_contents('user/'.$match[2]."/gold.txt");
      $aaddd .= $from_id."\n";
		file_put_contents('user/'.$match[2]."/gold.txt",$aaddd);
    }
	$mtch = file_get_contents('user/'.$match[2]."/coin.txt");
	file_put_contents("user/".$match[2]."/coin.txt",($mtch+10) );
	SendMessage($match[2],"🆕 یک نفر با لینک اختصاصی شما وارد ربات شد.","html","true");
	}
	}
	}
	}
	SendMessage($chat_id,"📍 سلام به ربات افزایش بازدید پست های تلگرامی با کاربران واقعی خوش اومدی

👈 نحوه کار:
▪️ پست های تلگرامی به شما نمایش داده میشن، شما با بازدید از اونا سکه دریافت میکنید و با همون سکه ها میتونید پستتون رو به معرض نمایش بزارین.

🔸 با این ربات در چالشهای تلگرامی میتونید بازدید پست اختصاصی خود را بالا ببرید و از رقبا پیشی بگیرید.

🆔 @TigenTech","html","true",$button_official);
	}
  //===============
  elseif($text == '↩️منوی اصلی' || preg_match('/^\/([Cc]ancel)/',$text)){
  file_put_contents('user/'.$from_id."/command.txt","none");
  SendMessage($chat_id,"↩️ شما به منوی اصلی برگشتید","html","true",$button_official);
  }
  //===============
  elseif($text == '🔸فروشگاه'){
  SendMessage($chat_id,"🔸 فروشگاه فعلا تعطیل است...","html","true");
  return false;
  file_put_contents('user/'.$from_id."/command.txt","buy");
  SendMessage($chat_id,"میخواهید چه مقدار حساب کاربری تون رو شارژ کنید.
  مقدار سکه مورد نظر رو وارد کنید","html","true",$button_back);
  }
  //===============
  elseif($command == 'buy'){
  if(preg_match('/^([0-9])/',$text) and $text >= 20){
  file_put_contents('user/'.$from_id."/command.txt","none");
  $mny = $text*5;
  $mnyfor = number_format($mny);
  $rial = $mny*10;
  SendMessage($chat_id,"مقدار سکه: $text
  مبلغ قابل پرداخت: $mnyfor تومان
  
  پس از پرداخت حساب شما اتومات شارژ میشه","html","true",json_encode(['inline_keyboard'=>[
[['text'=>'پرداخت','url'=>"http://domain/pay/seenbot/$from_id/$rial"]],
],'resize_keyboard'=>true]));
SendMessage($chat_id,"یک گزینه انتخاب کنید:","html","true",$button_official);
  }else{
  SendMessage($chat_id,"لطفا به عدد وارد کنید و کمتر از 20 سکه نمیتونید حسابتون رو شارژ کنید:","html","true",$button_back);
  }
  }
  //===============
  elseif($text == '⭕️زیرمجموعه گیری'){
  $member_id = explode("\n",$gold);
  $mmemcount = count($member_id) -1;
  SendMessage($chat_id,"خیلی آسون چالش هارو برنده بشید، یازدید پست هاتون رو بالا ببرین و ممبر های کانالتون رو زیاد کنید😎
  حتما ربات بازدید بگیر رو تست کنید !
  http://telegram.me/Tigenviewbot?start=$from_id","html","true",$button_official);
  SendMessage($chat_id,"⭕️ با انتشار پست بالا ، به ازای هر فردی که با لینک شما به ربات دعوت شود، 50 سکه به حساب شما اضافه خواهد شد.
  
  🎗 لینک اختصاصی شما:
  🌐 http://telegram.me/Tigenviewbot?start=$from_id
  
  🔖 تعداد زیرمجموعه های شما: <b>$mmemcount</b>","html","true",$button_official);
  }
  //===============
  elseif($text == '📣جمع آوری سکه رایگان در چنل'){
  SendMessage($chat_id,"✅ شما با رفتن به کانال ما و زدن روی دکمه (ثبت بازدید) میتونید بازدید رو ثبت کنید و سکه مورد نظر رو همون موقع دریافت کنید.","html","true",json_encode(['inline_keyboard'=>[
[['text'=>'📣 رفتن به کانال مورد نظر','url'=>"http://t.me/TigenView".str_replace("@",'',$Channel)]],
],'resize_keyboard'=>true]));
  }
  //===============
  elseif($text == '📍قوانین'){
  SendMessage($chat_id,"▪️ افرادی که درخواست بازدید برای پست هاشون ثبت میکنند، شرایط زیر را پذیرفته اند:
  
📍 1. پست ها در صورت رعایت قوانین تایید و نمایش داده میشوند.

📍 2. پست های زیر پذیرفته نمیشوند:
- پست های دارای محتوای سیاسی یا ضد نظام جمهوری اسلامی ایران
- پست های دارای محتوای غیر اخلاقی
- پست های منتشر کننده نرم افزار های تجاری (پولی) ایرانی بصورت دانلود رایگان
- در صورت ثبت پستی مغایر قوانین، صاحب پست از ربات مسدود و امکان برگشت هزینه یا سکه های فرد وجود ندارد
- در صورت مغایرت محتوای پست با عنوان و تبلیغات آن یا هر گونه سوء استفاده، تقلب یا فریب کاربران عواقب قانونی آن متوجه کسی که پست رو ثبت کرده میباشد.

🆔 @TigenTech","html","true",$button_official);
  }
  //===============
  elseif($text == '👥حساب کاربری'){
  $member_id = explode("\n",$gold);
  $mmemcount = count($member_id) -1;
  $member_id2 = explode("\n",$pay);
  $mmemcount2 = count($member_id2) -1;
  SendMessage($chat_id,"👥حساب کاربری
  
  💰 موجودی شما تا این لحظه: <b>$coin</b> سکه
  🔢 شماره کاربری شما: <code>$from_id</code>
  🔖 تعداد زیر مجموعه های شما: <code>$mmemcount</code> نفر
  🗳 کل تبلیغات ثبت شده توسط شما: <code>$mmemcount2</code> عدد","html","true",$button_official);
  }
  //===============
  elseif($text == '↕️انتقال سکه'){
  file_put_contents('user/'.$from_id."/command.txt","send coin");
  SendMessage($chat_id,"↕️ شماره کاربری مقصد رو وارد کنید:","html","true",$button_back);
  }
  elseif($command == 'send coin'){
  $explode = explode("\n",$Member);
  if($text != $from_id && in_array($text,$explode)){
  file_put_contents('user/'.$from_id."/command.txt","send coin2");
  file_put_contents('user/'.$from_id."/wait.txt",$text);
  SendMessage($chat_id,"↕️ مقدار سکه شما: $coin
  ↕️ میخواهید چه تعداد سکه انتقال بدید:","html","true",$button_back);
  }else{
  SendMessage($chat_id,"↕️ شناسه کاربری نا معتبره یا شناسه کاربری خودتون رو وارد کردید","html","true",$button_back);
  }
  }
  elseif($command == 'send coin2'){
  if(preg_match('/^([0-9])/',$text)){
  if($text > $coin){
  SendMessage($chat_id,"↕️ مقدار سکه شما $coin میباشد.
  ↕️ به اندازه سکه خودتون میتونید انتقال بدید","html","true",$button_back);
  }else{
  file_put_contents("user/$wait/coin.txt",($coin_wait+$text) );
  file_put_contents("user/$from_id/coin.txt",($coin-$text) );
  file_put_contents('user/'.$from_id."/command.txt","none");
  SendMessage($chat_id,"↕️ مقدار $text به $wait انتقال داده شد.","html","true",$button_official);
  }
  }else{
  SendMessage($chat_id,"↕️ لطفا عددی وارد کنید","html","true",$button_back);
  }
  }
  //===============
  elseif($text == '🗳ارتباط با ما'){
  SendMessage($chat_id,"🗳 دوست عزیز تمام نظراتتون رو میتونید به ربات زیر بفرستید.
  🆔 @Tigentechbotbot","html","true");
  }
  //===============
  elseif($text == '✅ثبت تبلیغ'){
  if($coin < 20){
  SendMessage($chat_id,"✅ حداقل سکه برای سفارش تبلیغ 20 سکه میباشد.","html","true");
  }else{
  file_put_contents('user/'.$from_id."/command.txt","set ads");
  if( ($coin%2) == 0){
  $coin = $coin;
  }else{
  $coin = $coin-1;
  }
  $cn = $coin / 2;
  $btn = [];
  $btn[] = [['text'=>"↩️منوی اصلی"]];
  if($cn >= 10){ $btn[] = [['text'=>'10 بازدید / 20 سکه']]; }
  if($cn >= 20){ $btn[] = [['text'=>'20 بازدید / 40 سکه']]; }
  if($cn >= 50){ $btn[] = [['text'=>'50 بازدید / 100 سکه']]; }
  if($cn >= 100){ $btn[] = [['text'=>'100 بازدید / 200 سکه']]; }
  if($cn >= 200){ $btn[] = [['text'=>'200 بازدید / 400 سکه']]; }
  if($cn >= 300){ $btn[] = [['text'=>'300 بازدید / 600 سکه']]; }
  if($cn >= 400){ $btn[] = [['text'=>'400 بازدید / 800 سکه']]; }
  if($cn >= 500){ $btn[] = [['text'=>'500 بازدید / 1000 سکه']]; }
  
  SendMessage($chat_id,"✅ یکی از بسته های زیر رو انتخاب کنید","html","true",json_encode(['keyboard'=>$btn,'resize_keyboard'=>true]));
  }
  }
  //===============
  elseif($command == 'set ads'){
  if( ($coin%2) == 0){
  $coin = $coin;
  }else{
  $coin = $coin-1;
  }
  $cn = $coin / 2;
  if($text == "10 بازدید / 20 سکه" and $cn >= 10){
  file_put_contents('user/'.$from_id."/wait.txt",10);
  file_put_contents('user/'.$from_id."/command.txt","set ads2");
  SendMessage($chat_id,"✅ شما بسته 10 بازدید رو انتخاب کردید
  ✅ با توجه به قوانین پیام مورد نظر رو از یک کانال عمومی فوروارد کنید","html","true",$button_back);
  }
  elseif($text == "20 بازدید / 40 سکه" and $cn >= 20){
  file_put_contents('user/'.$from_id."/wait.txt",20);
  file_put_contents('user/'.$from_id."/command.txt","set ads2");
  SendMessage($chat_id,"✅ شما بسته 20 بازدید رو انتخاب کردید
  ✅ با توجه به قوانین پیام مورد نظر رو از یک کانال عمومی فوروارد کنید","html","true",$button_back);
  }
  elseif($text == "50 بازدید / 100 سکه" and $cn >= 50){
  file_put_contents('user/'.$from_id."/wait.txt",50);
  file_put_contents('user/'.$from_id."/command.txt","set ads2");
  SendMessage($chat_id,"✅ شما بسته 50 بازدید رو انتخاب کردید
  ✅ با توجه به قوانین پیام مورد نظر رو از یک کانال عمومی فوروارد کنید","html","true",$button_back);
  }
  elseif($text == "100 بازدید / 200 سکه" and $cn >= 100){
  file_put_contents('user/'.$from_id."/wait.txt",100);
  file_put_contents('user/'.$from_id."/command.txt","set ads2");
  SendMessage($chat_id,"✅ شما بسته 100 بازدید رو انتخاب کردید
  ✅ با توجه به قوانین پیام مورد نظر رو از یک کانال عمومی فوروارد کنید","html","true",$button_back);
  }
  elseif($text == "200 بازدید / 400 سکه" and $cn >= 200){
  file_put_contents('user/'.$from_id."/wait.txt",200);
  file_put_contents('user/'.$from_id."/command.txt","set ads2");
  SendMessage($chat_id,"✅ شما بسته 200 بازدید رو انتخاب کردید
  ✅ با توجه به قوانین پیام مورد نظر رو از یک کانال عمومی فوروارد کنید","html","true",$button_back);
  }
  elseif($text == "300 بازدید / 600 سکه" and $cn >= 300){
  file_put_contents('user/'.$from_id."/wait.txt",300);
  file_put_contents('user/'.$from_id."/command.txt","set ads2");
  SendMessage($chat_id,"✅ شما بسته 300 بازدید رو انتخاب کردید
  ✅ با توجه به قوانین پیام مورد نظر رو از یک کانال عمومی فوروارد کنید","html","true",$button_back);
  }
  elseif($text == "400 بازدید / 800 سکه" and $cn >= 400){
  file_put_contents('user/'.$from_id."/wait.txt",400);
  file_put_contents('user/'.$from_id."/command.txt","set ads2");
  SendMessage($chat_id,"✅ شما بسته 400 بازدید رو انتخاب کردید
  ✅ با توجه به قوانین پیام مورد نظر رو از یک کانال عمومی فوروارد کنید","html","true",$button_back);
  }
  elseif($text == "500 بازدید / 1000 سکه" and $cn >= 500){
  file_put_contents('user/'.$from_id."/wait.txt",500);
  file_put_contents('user/'.$from_id."/command.txt","set ads2");
  SendMessage($chat_id,"✅ شما بسته 500 بازدید رو انتخاب کردید
  ✅ با توجه به قوانین پیام مورد نظر رو از یک کانال عمومی فوروارد کنید","html","true",$button_back);
  }
  else{
  SendMessage($chat_id,"✅ لطفا یکی از بسته های باز شده رو انتخاب کنید","html","true");
  }
  }
  //===============
  elseif($command == 'set ads2'){
  $cd = $code;
  if($forward_chat_username != null){
	  $cdo = file_get_contents("ads/ads log/@$forward_chat_username|$forward_chat_msg_id.txt");
	  if($cdo != null and file_get_contents("ads/ads admin/$cdo.txt") == $from_id){  
		  file_put_contents('user/'.$from_id."/command.txt","none");
		  $tddd = file_get_contents("ads/ads tedad/$cdo.txt");
		  file_put_contents("ads/ads tedad/$cdo.txt",($tddd+$wait) );
		  file_put_contents("user/$from_id/coin.txt",($coin - ($wait*2)) );
		  file_put_contents("ads/ads ok/$cdo.txt",'در انتظار تایید مدیران...');
		  SendMessage($chat_id,"✅ سفارش شما ثبت شد و تا 24 ساعت دیگر بازدید مورد نظر رو دریافت میکند. پس از دریافت کامل بازدید ها به شما اطلاع داده میشود همچنین میتونید با مراجعه به پیگیری سفارشات روند کار رو مشاهده کنید.
  
  ✅ کد پیگیری این سفارش (شما قبلا این پیام رو ثبت کردین بنابراین کد سفارش همان خواهد بود):
  $cdo","html","true",$button_official);
  ForwardMessage($admin,$chat_id,$message_id);
  SendMessage($admin,"🎗 پیام بالا با مشخصات زیر تایید شود؟
  
  🔖 کد پیگیری: $cdo
  👤 نام ادمین تبلیغ: $from_first
  🔢 یوزر ادمین تبلیغ: $from_id","html","true",json_encode(['inline_keyboard'=>[
[['text'=>'تایید پست','callback_data'=>"taiid|$from_id|$cdo"]],
[['text'=>'رد پست','callback_data'=>"rad|$from_id|$cdo"]],
],'resize_keyboard'=>true]));
	  }else{
  file_put_contents('user/'.$from_id."/command.txt","none");
  file_put_contents('user/'.$from_id."/pay.txt","$pay\n🔖 @$forward_chat_username | $forward_chat_msg_id");
  file_put_contents("ads/ads msg id/$cd.txt",$forward_chat_msg_id);
  file_put_contents("ads/ads tedad/$cd.txt",$wait);
  file_put_contents("ads/ads username/$cd.txt","@$forward_chat_username");
  file_put_contents("ads/ads log/@$forward_chat_username|$forward_chat_msg_id.txt",$cd);
  file_put_contents("ads/ads tally/$cd.txt",'');
  file_put_contents("ads/ads ok/$cd.txt",'در انتظار تایید مدیران...');
  file_put_contents("ads/Ads All.txt","$cd\n$ads_all");
  file_put_contents("ads/ads admin/$cd.txt",$from_id);
  file_put_contents("ads/ads start/$cd.txt","$date | $time");
  file_put_contents("user/$from_id/coin.txt",($coin - ($wait*2)) );
  SendMessage($chat_id,"✅ سفارش شما ثبت شد و تا 24 ساعت دیگر بازدید مورد نظر رو دریافت میکند. پس از دریافت کامل بازدید ها به شما اطلاع داده میشود همچنین میتونید با مراجعه به پیگیری سفارشات روند کار رو مشاهده کنید.
  
  ✅ کد پیگیری این سفارش:
  $cd","html","true",$button_official);
  
  ForwardMessage($admin,$chat_id,$message_id);
  SendMessage($admin,"🎗 پیام بالا با مشخصات زیر تایید شود؟
    
  🔖 کد پیگیری: $cd
  👤 نام ادمین تبلیغ: $from_first
  🔢 یوزر ادمین تبلیغ: $from_id","html","true",json_encode(['inline_keyboard'=>[
[['text'=>'تایید پست','callback_data'=>"taiid|$from_id|$cd"]],
[['text'=>'رد پست','callback_data'=>"rad|$from_id|$cd"]],
],'resize_keyboard'=>true]));
	  }
  }else{
  SendMessage($chat_id,"✅ پیام فوروارد شده از کانال عمومی نمیباشد","html","true");
  }
  }
  //===============
  elseif($text == '📇پیگیری سفارشات'){
  if($pay == null){
  SendMessage($chat_id,"📇 شما تا به حال هیچ سفارشی نداشتید","html","true");
  }else{
  file_put_contents('user/'.$from_id."/command.txt","pay");
  $exp = explode("\n",$pay);
  $bttn = [];
  $bttn[] = [['text'=>"↩️منوی اصلی"]];
  foreach($exp as $explode){
  $bttn[] = [['text'=>$explode]];
  }
  SendMessage($chat_id,"📇 یکی از سفارش هاتون رو انتخاب کنید","html","true",json_encode(['keyboard'=>$bttn,'resize_keyboard'=>true]));
  }
  }
  elseif($command == 'pay'){
  $text = str_replace("🔖",'',$text);
  $text = str_replace(" ",'',$text);
  $text = file_get_contents("ads/ads log/$text.txt");  
  if(file_exists("ads/ads admin/$text.txt")){
  $fl = file_get_contents("ads/ads admin/$text.txt");
  if($from_id == $fl){
  $ed = file_get_contents("ads/ads end/$text.txt");
  $sta = file_get_contents("ads/ads start/$text.txt");
  $tdad = file_get_contents("ads/ads tedad/$text.txt");
  $tlly = file_get_contents("ads/ads tally/$text.txt");
  $msg_id = file_get_contents("ads/ads msg id/$text.txt");
  $msg_user = file_get_contents("ads/ads username/$text.txt");
  ForwardMessage($chat_id,$msg_user,$msg_id);
  $ej = file_get_contents("ads/ads ok/$text.txt");
  if($ej == 'تایید نشده'){
  $ej2 = file_get_contents("ads/ads rad/$text.txt");
  $ej3 = file_get_contents("ads/ads ok/$text.txt");
  $ej = "توسط مدیران تایید نشده\n💢بدلیل: $ej2";
  }
  $member_id = explode("\n",$tlly);
  $mmemcount = count($member_id)-1;
  if($ed == null or $ed == " | "){
  $ed = "---";
  }
  if($sta == null){
  $sta = "---";
  }
  SendMessage($chat_id,"⭕️کد پیگیری:
$text

📈 وضعیت: $ej
📜زمان شروع: $sta
📆زمان اتمام: $ed
🔢 مقدار سفارش: <b>$tdad</b>
⤵️ مقدار دریافتی: <b>$mmemcount</b>","html","true");
  }else{
  SendMessage($chat_id,"📇 شما این پست رو سفارش ندادین","html","true");
  }
  }else{
  SendMessage($chat_id,"📇 کد نا معتبر است","html","true");
  }
  }
  //===============
  elseif($text == '☢جمع آوری سکه رایگان در ربات'){
  file_put_contents('user/'.$from_id."/rand.txt",null);
  $all_member = fopen( "ads/Ads.txt", 'r');
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			$user = str_replace(" ",'',$user);
			$user = str_replace("\n",'',$user);
			$adn = file_get_contents("ads/ads admin/$user.txt");
			$tl = file_get_contents("ads/ads tally/$user.txt");
			$ex = explode("\n",$tl);
			if(!in_array($from_id,$ex) && $user != null && $user != '' && $user != "\n" && $from_id != $adn){
			file_put_contents('user/'.$from_id."/rand.txt",$user);
			break;
			}else{
			file_put_contents('user/'.$from_id."/rand.txt",null);
			}
		}
		$rand = file_get_contents("user/".$from_id."/rand.txt");
  if($rand == null){
  SendMessage($chat_id,"☢ دوست عزیز تبلیغی پیدا نشد. لطفا دوباره امتحان کنید:","html","true");
  file_put_contents("user/$from_id/tr.txt","$tr\ntrue" );
  }else{
  $msg_id = file_get_contents("ads/ads msg id/$rand.txt");
  $msg_user = file_get_contents("ads/ads username/$rand.txt");
  ForwardMessage($chat_id,$msg_user,$msg_id);
  file_put_contents("user/$from_id/coin.txt",($coin + 1) );
   $usr = file_get_contents("ads/ads tally/$rand.txt");
    $pmembersid = explode("\n",$usr);
    if (!in_array($from_id,$pmembersid)){
		$aaddd = file_get_contents("ads/ads tally/$rand.txt");
        $aaddd .= $from_id."\n";
		file_put_contents("ads/ads tally/$rand.txt",$aaddd);
    }
    $member_id = explode("\n",$usr);
    $mmemcount = count($member_id);
	$tdd = file_get_contents("ads/ads tedad/$rand.txt");
	if($mmemcount >= $tdd){
	SendMessage($adn,"☢ سفارش تبلیغ با کد پیگیری $rand در $date | $time تموم شد.","html","true");
	file_put_contents("ads/ads ok/$rand.txt",'اتمام');
	file_put_contents("ads/Ads End.txt","$ads_end\n$rand");
	file_put_contents("ads/ads end/$rand.txt","$date | $time");
	file_put_contents("ads/ads etmam/$rand.txt","true");
	$str = str_replace("$rand\n",'',$ads);
	$str = str_replace("\n\n","\n",$ads);
	$str = str_replace("\n$rand",'',$ads);
	$str = str_replace("$rand",'',$ads);
	file_put_contents("ads/Ads.txt",$str);
	}
	}
  }
  elseif($text == '▪️کد رایگان'){
  file_put_contents('user/'.$from_id."/command.txt","free code");
  SendMessage($chat_id,"▪️ کد مورد نظر رو وارد کنید:","html","true",$button_back);
  }
  elseif($command == 'free code'){
  if(file_exists("admin/code/$text.txt")){
  $cde = file_get_contents("admin/code/$text.txt");
  if($cde == 'true'){
  SendMessage($chat_id,"▪️ این کد قبلا استفاده شده است.","html","true",$button_official);
  }else{
  SendMessage("@TigenTech","☢️ مقدار <b>($cde)</b> سکه توسط کد <b>(".number_format($text).")</b> به <b>($from_id)</b> اضافه شد.
  
  👁‍🗨 ربات افزایش بازدید پست های تلگرامی
  
  🤖 @Tigenviewbot
  🆔 @TigenTech","html","true");
  file_put_contents('user/'.$from_id."/coin.txt",($coin+$cde));
  file_put_contents("admin/code/$text.txt",'true');
  SendMessage($chat_id,"▪️ مقدار $cde سکه به شما اضافه شد.","html","true",$button_official);
  }
  }else{
  SendMessage($chat_id,"▪️ کد مورد نظر وجود ندارد","html","true",$button_official);
  }
  file_put_contents('user/'.$from_id."/command.txt","none");
  }
  //===============
  elseif($text == '/manage' and $from_id == $admin){
  SendMessage($chat_id,"به پنل مدیریت خوش اومدی:","html","true",$button_manage);
  }
  elseif($text == '📊آمار' and $from_id == $admin){  
	$txtt = file_get_contents('admin/Member.txt');
    $member_id = explode("\n",$txtt);
    $mmemcount = count($member_id) -1;

	$bots = file_get_contents("admin/UserName.txt");
	$exbot = explode("@",$bots);
	$c = count($exbot)-2;
	$botsss = '';
	if($exbot[$c-(-1)] != null){
	$botsss = $botsss."@".$exbot[$c-(-1)];
	}if($exbot[$c] != null){
	$botsss = $botsss."@".$exbot[$c];
	}if($exbot[$c-1] != null){
	$botsss = $botsss."@".$exbot[$c-1];
	}if($exbot[$c-2] != null){
	$botsss = $botsss."@".$exbot[$c-2];
	}if($exbot[$c-3] != null){
	$botsss = $botsss."@".$exbot[$c-3];
	}if($exbot[$c-4] != null){
	$botsss = $botsss."@".$exbot[$c-4];
	}if($exbot[$c-5] != null){
	$botsss = $botsss."@".$exbot[$c-5];
	}if($exbot[$c-6] != null){
	$botsss = $botsss."@".$exbot[$c-6];
	}if($exbot[$c-7] != null){
	$botsss = $botsss."@".$exbot[$c-7];
	}if($exbot[$c-8] != null){
	$botsss = $botsss."@".$exbot[$c-8];
	}
	$botsss = str_replace("\n",' | ',$botsss);
  SendMessage($chat_id,"👥 اعضا ربات: $mmemcount
  
  🅾 اعضا جدید:
  $botsss","html","true");
  }
	elseif($text == '🔖پیگیری سفارش' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","pay admn");
	SendMessage($chat_id,"🔖 کد سفارش و وارد کنید:","html","true",$button_back);
	}
	elseif($command == 'pay admn' and $from_id == $admin){
		$text = str_replace("🔖",'',$text);
	  $text = str_replace(" ",'',$text);
	  $text = file_get_contents("ads/ads log/$text.txt");
	file_put_contents("user/".$from_id."/command.txt","none");
	if(file_exists("ads/ads admin/$text.txt")){
	$ed = file_get_contents("ads/ads end/$text.txt");
  $sta = file_get_contents("ads/ads start/$text.txt");
  $tdad = file_get_contents("ads/ads tedad/$text.txt");
  $tlly = file_get_contents("ads/ads tally/$text.txt");
  $msg_id = file_get_contents("ads/ads msg id/$text.txt");
  $msg_user = file_get_contents("ads/ads username/$text.txt");
  ForwardMessage($chat_id,$msg_user,$msg_id);
  $ej = file_get_contents("ads/ads ok/$text.txt");
  if($ej == 'تایید نشده'){
  $ej2 = file_get_contents("ads/ads rad/$text.txt");
  $ej3 = file_get_contents("ads/ads ok/$text.txt");
  $ej = "توسط مدیران تایید نشده\n💢بدلیل: $ej2";
  }
  $member_id = explode("\n",$tlly);
  $mmemcount = count($member_id)-1;
 if($ed == null or $ed == " | "){
  $ed = "---";
  }
  if($sta == null){
  $sta = "---";
  }
  SendMessage($chat_id,"⭕️کد پیگیری:
$text

📈 وضعیت: $ej
📜زمان شروع: $sta
📆زمان اتمام: $ed
🔢 مقدار سفارش: <b>$tdad</b>
⤵️ مقدار دریافتی: <b>$mmemcount</b>","html","true");
  }else{
  SendMessage($chat_id,"🔖 کد نا معتبر است.","html","true");
  }
	}
	elseif($text == '💰سکه همگانی' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","s2a seke");
	SendMessage($chat_id,"💰 مقدار سکه مورد نظر رو وارد کنید:","html","true",$button_back);
	}
	elseif($command == 's2a seke' and $from_id == $admin){
	if(preg_match('/^([0-9])/',$text)){
	file_put_contents("user/".$from_id."/command.txt","none");
	SendMessage($chat_id,"💰 مقدار سکه به زودی به همه اضافه میشود.","html","true",$button_manage);
	$all_member = fopen( "admin/Member.txt", 'r');
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			$user = str_replace(" ",'',$user);
			$user = str_replace("\n",'',$user);
			
			$cn = file_get_contents('user/'.$user."/coin.txt");
			file_put_contents('user/'.$user."/coin.txt",($cn+$text) );
			
		}
		SendMessage($chat_id,"💰 تعداد $text سکه به همه اعضا اضافه شد.","html","true");
	}else{
	SendMessage($chat_id,"💰 لطفا به عدد وارد کنید در غیر اینصورت مشکل بزرگی پیش خواهد آمد.","html","true",$button_back);
	}
	}
	
  elseif($text == '📮فوروارد همگانی' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","s2a fwd");
	SendMessage($chat_id,"📮 پیام مورد نظر را فوروارد کنید:","html","true",$button_back);
	}
	elseif($command == 's2a fwd' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","none");
	SendMessage($chat_id,"📮 پیام شما در صف ارسال قرار گرفت.","html","true",$button_manage);
	$all_member = fopen( "admin/Member.txt", 'r');
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			ForwardMessage($user,$admin,$message_id);
		}
	}
	
	elseif($text == '🆓تعیین کد رایگان' and $from_id == $admin){
  file_put_contents('user/'.$from_id."/command.txt","code free2");
  SendMessage($chat_id,"🆓 کد مورد نظر رو وارد کنید:","html","true",$button_back);
  }
  elseif($command == 'code free2' and $from_id == $admin){
  file_put_contents("user/".$from_id."/wait.txt",$text);
  file_put_contents("user/".$from_id."/command.txt","code free3");
  SendMessage($chat_id,"🆓 مقدار سکه رو وارد کنید:","html","true",$button_back);
  }
  elseif($command == 'code free3' and $from_id == $admin){
  file_put_contents("user/".$from_id."/command.txt","none");
  file_put_contents("admin/code/$wait.txt",$text);
  SendMessage($chat_id,"🆓 کد ($wait) برای استفاده یک نفر قابل استفاده است. مقدار سکه رایگان این کد $text میباشد.","html","true",$button_manage);
  }
	elseif($text == '📪پیام همگانی' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","s2a");
	SendMessage($chat_id,"📪 پیامتون رو وارد کنید:","html","true",$button_back);
	}
	elseif($command == 's2a' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","none");
	SendMessage($chat_id,"📪 پیام شما در صف ارسال قرار گرفت.","html","true",$button_manage);
	$all_member = fopen( "admin/Member.txt", 'r');
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			if($sticker_id != null){
			SendSticker($user,$stickerid);
			}
			elseif($videoid != null){
			SendVideo($user,$videoid,$caption);
			}
			elseif($voiceid != null){
			SendVoice($user,$voiceid,'',$caption);
			}
			elseif($fileid != null){
			SendDocument($user,$fileid,'',$caption);
			}
			elseif($musicid != null){
			SendAudio($user,$musicid,'',$caption);
			}
			elseif($photoid != null){
			SendPhoto($user,$photoid,'',$caption);
			}
			elseif($text != null){
			SendMessage($user,$text,"html","true",$button_official);
			}
		}
	}
  // End Source
  if($tarikh != date("YMDm")){
	  file_put_contents('user/'.$from_id."/coin.txt",($coin+10));
	  file_put_contents('user/'.$from_id."/tarikh.txt",date("YMDm") );
	  SendMessage($chat_id,"💰 برای شروع امروزت 10 سکه رایگان به شما تعلق گرفت.","html","true");
  }
  if(!file_exists('user/'.$from_id)){
  mkdir('user/'.$from_id);
  }
  if(!file_exists('user/'.$from_id."/coin.txt")){
  file_put_contents('user/'.$from_id."/coin.txt","20");
  }
  if(!file_exists('user/'.$from_id."/nmber.txt")){
  file_put_contents('user/'.$from_id."/nmber.txt","0");
  }
  $txxt = file_get_contents('admin/Member.txt');
    $pmembersid= explode("\n",$txxt);
    if (!in_array($chat_id,$pmembersid)){
      $aaddd = file_get_contents('admin/Member.txt');
      $aaddd .= $chat_id."\n";
		file_put_contents('admin/Member.txt',$aaddd);
    }
	$txxt = file_get_contents('admin/UserName.txt');
    $pmembersid= explode("\n",$txxt);
    if (!in_array("@$from_username",$pmembersid)){
      $aaddd = file_get_contents('admin/UserName.txt');
      $aaddd .= "@$from_username"."\n";
	  if($from_username != null){
		file_put_contents('admin/UserName.txt',$aaddd);
    }
	}
	unlink('error_log');
	?>