//Check is the user already exist
document.querySelector("#InputUsername").addEventListener("blur", (event) => {
  let text = document.querySelector("#InputUsername").value;

  let formData = new FormData();
  formData.append("text", text);
  //Doing Ajax to new php page and sending text with it
  fetch("ajax/controlusername.php", {
    method: "POST",
    body: formData,
  }) //If the result is succes then the username is the same as an existing username.
    .then((response) => response.json())
    .then((result) => {
      //We set a bootstrap alert with the messeage that the username isn't correct
      let new_row = document.createElement("div");
      new_row.className = "alert alert-danger";
      new_row.innerText = result.message;
      document
        .getElementById("register")
        .insertBefore(
          new_row,
          document.getElementById("register").childNodes[0]
        );
      //Making border around username red
      let input = document.getElementById("InputUsername");
      input.className = "form-control is-invalid";
    })
    .catch((error) => {
      console.log(error);
    });
});
//Check if email exist when you go out of the textfield
document.querySelector("#InputEmail").addEventListener("blur", (event) => {
  let text = document.querySelector("#InputEmail").value;

  let formData = new FormData();
  formData.append("text", text);

  //Doing Ajax to new php page and sending text with it
  fetch("ajax/controlemail.php", {
    method: "POST",
    body: formData,
  }) //If the result is succes then the email is the same as an existing email.
    .then((response) => response.json())
    .then((result) => {
      //We set a bootstrap alert with the messeage that the email isn't correct
      let new_row = document.createElement("div");
      new_row.className = "alert alert-danger";
      new_row.innerText = result.message;
      document
        .getElementById("register")
        .insertBefore(
          new_row,
          document.getElementById("register").childNodes[0]
        );
      //Making border around email red
      let input = document.getElementById("InputEmail");
      input.className = "form-control is-invalid";
    })
    .catch((error) => {
      console.log(error);
    });
});
