var icons = false;

$( ".row" ).hover( function(){
  if (icons == false) {
    $(this).children('.icons').css('visibility', 'visible');
  } else {
    $('.icons').css('visibility', 'hidden');
  }
  icons=!icons;
}
);





/*Delete user*/
function deleteUser(username) {
    $.ajax({
      url: "http://localhost/sudoku/back-end/user/"+username,
      type: 'DELETE',
      success: function(result) {
          console.log(result);
      },
      error:  function(result) {
        console.log(result);
    }
  });
}

/*Edit user */
function editUser(id) {
  window.location.href = "edit-profile.php?id="+id;
}