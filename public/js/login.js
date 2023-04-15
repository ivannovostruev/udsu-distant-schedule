
$(function() {
    infoModal();
});


//// Functions ////

function infoModal() {
    const infoButtonSelector        = '#info-button';
    const infoModalSelector         = '#info-modal';
    const animationClassesOnShow    = 'animate__animated animate__bounceIn';
    const animationClassesOnHide    = 'animate__animated animate__bounceOut';

    let infoModal = $(infoModalSelector);
    let infoButton = $(infoModalSelector);

    $(infoButtonSelector).click(function() {
        if (infoModal.is(':hidden')) {
            infoModal.toggle().addClass(animationClassesOnShow);
            setTimeout(customShow, 800, infoModal);
        } else if (infoModal.is(':visible')) {
            infoModal.addClass(animationClassesOnHide);
            setTimeout(customHide,700, infoModal);
        }
    });

    $(document).mouseup(function(e) {
        // if the target of the click isn't the container nor a descendant of the container
        if (!infoModal.is(e.target)
            && infoModal.has(e.target).length === 0
            && !infoButton.is(e.target)
        ) {
            if (infoModal.is(':visible')) {
                infoModal.addClass(animationClassesOnHide);
                setTimeout(customHide,700, infoModal);
            }
        }
    });

    function customShow(element) {
        element.removeClass(animationClassesOnShow);
    }

    function customHide(element) {
        element.hide();
        element.removeClass(animationClassesOnHide);
    }
}
