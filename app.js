//Checken of de username al bestaat wanneer je uit het textveld gaat
document.querySelector("#InputUsername").addEventListener("blur", (event) => {
  let text = document.querySelector("#InputUsername").value;

  let formData = new FormData();
  formData.append("text", text);
  //Ajax uitvoeren naar nieuwe php pagina en de text meesturen.
  fetch("ajax/controlusername.php", {
    method: "POST",
    body: formData,
  }) //Als het resultaat succes is dan is de username hetzelfde als een bestaande username.
    .then((response) => response.json())
    .then((result) => {
      //We zetten een bootstrap alert bovenaan de pagina met message dat username niet mogelijk is.
      let new_row = document.createElement("div");
      new_row.className = "alert alert-danger";
      new_row.innerText = result.message;
      document
        .getElementById("register")
        .insertBefore(
          new_row,
          document.getElementById("register").childNodes[0]
        );
      //De kader rond de username rood maken
      let input = document.getElementById("InputUsername");
      input.className = "form-control is-invalid";
    })
    .catch((error) => {
      console.log(error);
    });
});
//Checken of het email al bestaat wanneer je uit het textveld gaat
document.querySelector("#InputEmail").addEventListener("blur", (event) => {
  let text = document.querySelector("#InputEmail").value;

  let formData = new FormData();
  formData.append("text", text);

  //Ajax uitvoeren naar nieuwe php pagina en de text meesturen.
  fetch("ajax/controlemail.php", {
    method: "POST",
    body: formData,
  }) //Als het resultaat succes is dan is het emailadres hetzelfde als een bestaande email.
    .then((response) => response.json())
    .then((result) => {
      //We zetten een bootstrap alert bovenaan de pagina met message dat email niet mogelijk is.
      let new_row = document.createElement("div");
      new_row.className = "alert alert-danger";
      new_row.innerText = result.message;
      document
        .getElementById("register")
        .insertBefore(
          new_row,
          document.getElementById("register").childNodes[0]
        );
      //De kader rond de email rood maken
      let input = document.getElementById("InputEmail");
      input.className = "form-control is-invalid";
    })
    .catch((error) => {
      console.log(error);
    });
});
