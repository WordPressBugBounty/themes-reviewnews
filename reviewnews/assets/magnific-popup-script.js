(function (e) {
  'use strict';
  var n = window.AFTHRAMPES_JS || {};    

  (n.MagnificPopup = function () {
    e('div.zoom-gallery').magnificPopup({
      delegate: 'a.insta-hover',
      type: 'image',
      closeOnContentClick: false,
      closeBtnInside: false,
      mainClass: 'mfp-with-zoom mfp-img-mobile',
      image: {
        verticalFit: true,
        titleSrc: function (item) {
          return item.el.attr('title');
        },
      },
      gallery: {
        enabled: true,
      },
      zoom: {
        enabled: true,
        duration: 300,
        opener: function (element) {
          return element.find('img');
        },
      },
    });
    e('.gallery').each(function () {
      e(this).magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
          enabled: true,
        },
        zoom: {
          enabled: true,
          duration: 300,
          opener: function (element) {
            return element.find('img');
          },
        },
      });
    });

    e('.wp-block-gallery').each(function () {
      e(this).magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
          enabled: true,
        },
        zoom: {
          enabled: true,
          duration: 300,
          opener: function (element) {
            return element.find('img');
          },
        },
      });
    });
  })

  e(document).ready(function () {
    
      n.MagnificPopup()
      
  });
})(jQuery);
