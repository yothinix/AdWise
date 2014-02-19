    var tricker = true;
    function ans(choice)
    {
        if(tricker)
        {
            tricker = false;
            document.getElementById("ans").value = choice;
            document.getElementById("question-form").submit();
        }
    }
