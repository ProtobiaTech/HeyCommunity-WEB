<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
@if (empty($wxShareDisable) || !$wxShareDisable)
    <script type="text/javascript" charset="utf-8">
      var shareTitle = "{{ trim($__env->yieldContent('title', $system->site_title . ' - ' . $system->site_subheading)) }}";
      var shareDesc = "{{ strToOneline(trim($__env->yieldContent('description', $system->site_description))) }}";
      var shareLink = '{{ request()->url() }}';
      var shareImgUrl = "{{ trim($__env->yieldContent('avatar', url('/images/icon.png'))) }}";

      setTimeout(function() {
        console.info('wx share content');
        console.info('title', shareTitle);
        console.info('desc', shareDesc);
        console.info('link', shareLink);
        console.info('img', shareImgUrl);
      }, 1000);

      /**
       * wechat
       */
      wx.config({!! $wechatJsConfig !!});

      wx.ready(function() {
        /**
         * wechat share timeline
         */
        wx.onMenuShareTimeline({
          title: shareTitle,
          link: shareLink,
          imgUrl: shareImgUrl,
          success: function () {
          },
          cancel: function () {
          }
        });

        /**
         * wechat share app message
         */
        wx.onMenuShareAppMessage({
          title: shareTitle,
          link: shareLink,
          imgUrl: shareImgUrl,
          desc: shareDesc,
          success: function () {
          },
          cancel: function () {
          }
        });
      });
    </script>
@endif
