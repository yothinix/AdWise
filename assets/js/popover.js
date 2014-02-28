$(function() {
    $('#signup-form').validate_popover({onsubmit: false, popoverPosition: 'top'});

    $(".submit-btn").click(function(ev) {
        ev.preventDefault();

        $('#signup-form').validate().form();

        return false;
    });

    $(window).resize(function() {
        $.validator.reposition();
    });
});