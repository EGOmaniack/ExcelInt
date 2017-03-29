// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("btn_modal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

$('#new_repair_btn').click(function(){
    var n_rep_date = $('#rep_start').val();
    var n_rep_type = $('#rep_type').val();
    var platf_number = $('.change_pl').attr('platform');
    // alert(platf_number);

    $.post("./ajax/insert_repair.php", {
        n_rep_date: n_rep_date,
        n_rep_type: n_rep_type,
        platf_number: platf_number
        },function (data) {
        if(data != undefined){
            var modal = document.getElementById('myModal');
            modal.style.display = "none";
            location.href = "/platformDocs/index.php";
            console.log(data);
            //$('body').html('');
            //$('body').append(data);
        }
    });
    
});