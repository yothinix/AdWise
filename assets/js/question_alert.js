bootstrap_alert = function() {}
bootstrap_alert.warning = function() {
            $('#alert_placeholder').html('<div class="alert alert-block alert-error fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><h4 class="alert-heading">Warning! You submit question more than limit!</h4><p>This warning popup because you submit the question more than total question you entered. To change the limit please visit Assessment Info. If you want to change question that already added please go to Review Q&A and select question you want to edit.</p></div>')
        }

$('#clickme').on('click', function() {
            bootstrap_alert.warning('Your text goes here');
});

