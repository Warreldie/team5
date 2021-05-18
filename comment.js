let posts = document.querySelectorAll("#post");
posts.forEach((e) => {
  e.querySelector("#btnAddComment").addEventListener("click", function (f) {
    f.preventDefault();
    let postId = this.dataset.postid;
    let text = e.querySelector("#commentText").value;

    //Ajax
    let formData = new FormData();

    formData.append("text", text);
    formData.append("postId", postId);

    fetch("ajax/savecomment.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((result) => {
        console.log("Success:", result);
        let newComment = document.createElement("li");
        newComment.innerHTML = result.body;
        e.querySelector(".post__comments__list").appendChild("test");
      })
      .catch((error) => {
        console.log("Error:", error);
      });
  });
});
