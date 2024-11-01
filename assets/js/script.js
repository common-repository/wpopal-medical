jQuery(document).ready(function($) {
  $(document).ready(function() {
   
    var $medical_slick = $('.elementor-medical-slick-slider');
    var slideCount = null;

    $medical_slick.each( function(i, el){

        var $this = $(el),
        //Setters
        setSlidesToShow = $this.data('slides-show'),
        setSlidesToScroll = $this.data('slides-scroll'),
        setDot = $this.data('pagination'),
        setAutoplay = $this.data('autoplay'),
        setAnimation = $this.data('animation'),
        setEasing = $this.data('easing'),
        setFade = $this.data('fade'),
        setSpeed = $this.data('speed'),
        setSlidesRows = $this.data('rows'),
        setCenterMode = $this.data('center-mode'),
        setCenterPadding = $this.data('center-padding'),
        setPauseOnHover = $this.data('pause-hover'),
        setVariableWidth = $this.data('variable-width'),
        setVertical = $this.data('vertical'),
        setRtl = $this.data('rtl'),
        setFocusOnSelect = $this.data('focus-on-select'),
        setLazyLoad = $this.data('lazy-load'),
        setTabletColumns = $this.data('table-columns'),
        setMobileColumns = $this.data('mobile-columns')

        $this.slick({

          autoplay: setAutoplay ? true : false,
          autoplaySpeed: setSpeed ? setSpeed : 3000,
      
          cssEase: setAnimation ? setAnimation : 'ease',
          easing: setEasing ? setEasing : 'linear',
          fade: setFade ? true : false,
      
          infinite:  true ,
          slidesToShow: setSlidesToShow ? setSlidesToShow : 3,
          slidesToScroll: setSlidesToScroll ? setSlidesToScroll : 1,
          centerMode: setCenterMode ? true : false,
          variableWidth: setVariableWidth ? true : false,
          pauseOnHover: setPauseOnHover ? true : false,
          rows: setSlidesRows ? setSlidesRows : 1,
          vertical: setVertical ? true : false,
          verticalSwiping: setVertical ? true : false,
          rtl: setRtl ? true : false,
          centerPadding: setCenterPadding ? setCenterPadding : 0,
          focusOnSelect: setFocusOnSelect ? true : false,
          lazyLoad: setLazyLoad ? setLazyLoad : true,
          dots: setDot ? true : false,
          adaptiveHeight: true,
          responsive: [
            {
              breakpoint: 1023,
              settings: {
              slidesToShow: setTabletColumns ? setTabletColumns : 2 ,
              infinite: true,
              }
            },
            {
              breakpoint: 767,
              settings: {
              slidesToShow: setMobileColumns ? setMobileColumns : 1 ,
              }
            },
            ]
        });      
    });
    if ( window.elementorFrontend ) {
        
      elementorFrontend.hooks.addAction('frontend/element_ready/opal-medicalcarousel.default', ($scope) => { 
       
        if( $scope.find(".elementor-medical-slick-slider").length > 0 ){ 
            var $medical_slick = $('.elementor-medical-slick-slider'); 
            

            $medical_slick.each( function(i, el){
                var $this = $(el),
                //Setters
                setSlidesToShow = $this.data('slides-show'),
                setSlidesToScroll = $this.data('slides-scroll'),
                setDot = $this.data('pagination'),
                setAutoplay = $this.data('autoplay'),
                setAnimation = $this.data('animation'),
                setEasing = $this.data('easing'),
                setFade = $this.data('fade'),
                setSpeed = $this.data('speed'),
                setSlidesRows = $this.data('rows'),
                setCenterMode = $this.data('center-mode'),
                setCenterPadding = $this.data('center-padding'),
                setPauseOnHover = $this.data('pause-hover'),
                setVariableWidth = $this.data('variable-width'),
                setVertical = $this.data('vertical'),
                setRtl = $this.data('rtl'),
                setFocusOnSelect = $this.data('focus-on-select'),
                setLazyLoad = $this.data('lazy-load'),
                setTabletColumns = $this.data('table-columns'),
                setMobileColumns = $this.data('mobile-columns')

                $this.slick({

                  autoplay: setAutoplay ? true : false,
                  autoplaySpeed: setSpeed ? setSpeed : 3000,
              
                  cssEase: setAnimation ? setAnimation : 'ease',
                  easing: setEasing ? setEasing : 'linear',
                  fade: setFade ? true : false,
              
                  infinite:  true ,
                  slidesToShow: setSlidesToShow ? setSlidesToShow : 3,
                  slidesToScroll: setSlidesToScroll ? setSlidesToScroll : 1,
                  centerMode: setCenterMode ? true : false,
                  variableWidth: setVariableWidth ? true : false,
                  pauseOnHover: setPauseOnHover ? true : false,
                  rows: setSlidesRows ? setSlidesRows : 1,
                  vertical: setVertical ? true : false,
                  verticalSwiping: setVertical ? true : false,
                  rtl: setRtl ? true : false,
                  centerPadding: setCenterPadding ? setCenterPadding : 0,
                  focusOnSelect: setFocusOnSelect ? true : false,
                  lazyLoad: setLazyLoad ? setLazyLoad : true,

                  dots: setDot ? true : false,
                  adaptiveHeight: true,
                  responsive: [
                    {
                      breakpoint: 1023,
                      settings: {
                      slidesToShow: setTabletColumns ? setTabletColumns : 2 ,
                      infinite: true,
                      }
                    },
                    {
                      breakpoint: 767,
                      settings: {
                      slidesToShow: setMobileColumns ? setMobileColumns : 1 ,
                      }
                    },
                  ]
              });

            });
          }
         // carouselFuncs( $scope );
      });
    }
  });
      
});
