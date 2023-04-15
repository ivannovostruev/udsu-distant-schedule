$(function() {
    const previousButtonSelector = '#previous-day';
    const nextButtonSelector     = '#next-day';

    activateTooltips();
    getRoomHelperData();
    setInterval(getRoomHelperData, 60000);
    dateSubmitByChange();
    changeDate(previousButtonSelector);
    changeDate(nextButtonSelector);
    todayByClick();
    fastLessonButtonsToggle();
});
