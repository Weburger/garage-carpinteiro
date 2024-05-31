jQuery(document).ready(function($) {
    const seeMore = $('.seeMore');

    seeMore.click(function() {
        $('.moreFilters').slideToggle('slow');
        if (seeMore.text() === 'Voir plus') {
            seeMore.text('Voir moins');
        } else {
            seeMore.text('Voir plus');
        }
    });
});