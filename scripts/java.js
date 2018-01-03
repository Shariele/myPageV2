//Main navigation
function changePageJs(page){
    $.ajax({
        type: "POST",
        url: "scripts/php.php",
        data: {
            c: page,
            action: "changePage"
        },
        success:  function(data){
            $('#projects-content').html(data);
            console.log("changePageJs");
        }
    });
}

function changeModalJs(modal){
    $.ajax({
        type: "POST",
        url: "scripts/php.php",
        data: {
            c: modal,
            action: "changeModal"
        },
        success:  function(data){
            $('#modalHandler').html(data);
            console.log("changeModalJs");
        }
    });
}
