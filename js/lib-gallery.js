/**
 *  This function formats and starts a gallery slide show
 *
 * @param None
 *
 * @return Nothing
 * @throws - Nothing
 * @global - None
 * @notes  - Calls galleryDisplay()
 * @example - galleryDisplay()
 * @author - Patches
 * @version - 1.0
 * @history - Created 08/02/2015
 */
function galleryDisplay() {
    $('#gallery a').css({opacity: 0.0});
    $('#gallery a:first').css({opacity: 1.0});
    $('#gallery .caption').css({opacity: 0.8});
    $('#gallery .content').html($('#gallery a:first').find('img').attr('alt')).animate({opacity: 0.9}, 4);
    $('#gallery .caption').animate({opacity: 0.9},1 ).animate({height: '60px'},500 );
    $('#gallery .img').animate({opacity: 0.8},1 ).animate({width: 'auto'},500 );
    setInterval('galleryRunSlideShow()',6000);
}

/**
 *  This function runs the slide show on a timer
 *
 * @param None
 *
 * @return Nothing
 * @throws - Nothing
 * @global - None
 * @notes  - Used internally by galleryDisplay()
 * @example - galleryRunSlideShow()
 * @author - Patches
 * @version - 1.0
 * @history - Created 08/02/2015
 */
function galleryRunSlideShow() {
    var current = ($('#gallery a.show')?  $('#gallery a.show') : $('#gallery a:first'));
    var next = ((current.next().length) ? ((current.next().hasClass('caption'))? $('#gallery a:first') :current.next()) : $('#gallery a:first'));
    var caption = next.find('img').attr('alt');

    next.css({opacity: 0.0})
        .addClass('show')
        .animate({opacity: 1.0}, 500);

    current.animate({opacity: 0.0}, 100)
        .removeClass('show');


    $('#gallery .caption').animate({opacity: 0.0}, { queue:false, duration:0 }).animate({height: '1px'}, { queue:true, duration:300 });
    $('#gallery .caption').animate({opacity: 0.9},1 ).animate({height: '60px'},500 );
    $('#gallery .img').animate({opacity: 0.8},1 ).animate({width: 'auto'},500 );
    $('#gallery .content').html(caption);
}