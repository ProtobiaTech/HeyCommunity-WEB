<?php

//
// system info
try {
    $system = \App\System::first();
} catch (Exception $e) {
    $system = new stdClass();
    $system->site_title = 'HeyCommunity';
    $system->site_subheading = 'A New HeyCommunity Site';
    $system->site_description = 'This Is A New HeyCommunity Site';
    $system->site_keywords = 'HeyCommunity, Social Site, Open Software';
    $system->site_analytic_code = null;
}
view()->share('system', $system);


//
// wechat js
try {
    $wechat = new \EasyWeChat\Foundation\Application(config('wechat'));
    $wechatJs = $wechat->js;
    $wechatJsConfig = $wechatJs->config(array('onMenuShareTimeline', 'onMenuShareAppMessage'));
    view()->share('wechatJsConfig', $wechatJsConfig);
} catch (Exception $e) {
    Log::alert($e->getMessage());
    view()->share('wechatJsConfig', '{}');
}
