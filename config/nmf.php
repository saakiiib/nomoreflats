<?php
return [
 'admin_email'=>env('ADMIN_EMAIL',''),
 'admin_password_hash'=>env('ADMIN_PASSWORD_HASH',''),
 'whatsapp'=>env('NMF_WHATSAPP','447400799942'),
 'phone'=>env('NMF_PHONE','07400 799942'),
 'fees'=>['Emergency - ASAP'=>(int)env('NMF_FEE_EMERGENCY',95),'Today'=>(int)env('NMF_FEE_TODAY',95),'Tomorrow'=>(int)env('NMF_FEE_TOMORROW',71),'Choose a Date'=>(int)env('NMF_FEE_SCHEDULED',35)],
 'gtm_id'=>env('NMF_GTM_ID','GTM-T6TMZ4SL'),
];
