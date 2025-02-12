$(document).ready(function() {
    $('#summernote').summernote({
        height: 200
    });
  });


  $(document).ready(function() {
    // Select/Deselect All Checkboxes
    $('#select_all_checkbox').click(function() {
        var isChecked = $(this).prop('checked'); // Get the state of the "Select All" checkbox
        $('.checkBoxes').each(function() {
            $(this).prop('checked', isChecked); // Set the state of each checkbox
        });
    });

    var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    $("body").prepend(div_box);

    $('#load-screen').delay(70).fadeOut(60, function(){
        $(this).remove();
    });
});



//   $(document).ready(function() {
//     $('#Bulk_option_container').click(function(event){
//         if(this.checked) {
//             $('.checkBoxes').each(function(){
//                 this.checked = true;
//             });
//         }else{
//             $('.checkBoxes').each(function(){
//                 this.checked = false;
//             });
//         }
//     });
//   });

// // auto load online users without refresh
// function loadUsersOnline(){
//     $.get("functions.php?onlineusers=result", function(data){
//         $(".usersonline").text(data);
//     });
// }

// setInterval(function(){
//     loadUsersOnline();
// },500);


    // Function to update online users count
    function updateOnlineUsers() {
        $.ajax({
            url: 'functions.php?onlineusers=true', // The PHP file to get online users
            type: 'GET',
            success: function(response) {
                // Update the span with the response (online user count)
                $('.usersonline').text(response);
            },
            error: function() {
                console.error('Failed to fetch online users.');
            }
        });
    }

    // Call the function to update the user count every 5 seconds
    setInterval(updateOnlineUsers, 5000);

    // Initial call to display the current count when the page loads
    updateOnlineUsers();