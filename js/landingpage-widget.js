/**
 * Created by Andreas on 12.10.2015.
 */
(function($){
    $(document).ready(function($)
    {
        if($('#ambitionchild_landingpage_widget-2').length > 0) {
            landingPageCalcHeight();

            $(window).on('resize', function () {
                landingPageCalcHeight();
            });
            scrollToOnReadMoreBtn();
        }
    });

    function landingPageCalcHeight()
    {
        var windowHeight = $(window).height();
        var navHeight = $('#masthead > .hgroup-wrap').height();
        //$('#ambitionchild_landingpage_widget-2').height(windowHeight-navHeight);
        $('#ambitionchild_landingpage_widget-2').css('min-height', windowHeight-navHeight + 'px');
        var landingpage_bar_content = $('#ambitionchild_landingpage_widget-2 > .landingpage_bar_content');

    }

    function scrollToOnReadMoreBtn() {
        $('#landingpage_first_btn').click(function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: ($('#ambitionchild_landingpage_widget-2').next().offset().top)}, 1000);
        })
    }
})(jQuery);
