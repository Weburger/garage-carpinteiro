console.log('coucou');
jQuery(document).ready(function($) {
    const seeMore = $('.seeMore');

    seeMore.click(function() {
        $('.moreFilters').slideToggle('slow');
    });
});