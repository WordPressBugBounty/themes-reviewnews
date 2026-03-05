(function (e) {
  'use strict';
  var n = window.AFTHRAMPES_JS || {};    

  (n.jQueryMarquee = function () {
    e('.marquee.aft-flash-slide').marquee({
      //duration in milliseconds of the marquee
      speed: 80000,
      //gap in pixels between the tickers
      gap: 0,
      //time in milliseconds before the marquee will start animating
      delayBeforeStart: 0,
      //'left' or 'right'
      // direction: 'right',
      //true or false - should the marquee be duplicated to show an effect of continues flow
      duplicated: true,
      pauseOnHover: true,
      startVisible: true,
    });
  })

  e(document).ready(function () {
    
      n.jQueryMarquee()
      
  });
})(jQuery);
