document.querySelector("#btnFollow").addEventListener("click", function (e) {
  e.preventDefault();
  //This user should come from url but now it is on button follow userid=6
  let userid = this.dataset.userid;

  //Posten to the database
  let formData = new FormData();
  formData.append("following_id", userid);

  fetch("ajax/savefollow.php", {
    method: "POST",
    body: formData,
  })
    .then(response => response.json())
    .then(result => {
        console.log(result.body);
        document.querySelector("#btnFollow").innerHTML = result.body;
    })
    .catch(error => {
        console.log('Error:', error);
    });
});
