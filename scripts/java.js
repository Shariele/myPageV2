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
