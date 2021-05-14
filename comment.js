
let posts = document.querySelectorAll(".post");
//let btns = document.querySelectorAll("#btnAddComment");

posts.forEach((e) => {
    e.querySelector("#btnAddComment").addEventListener('click', function(f){
    //btn.addEventListener("click", function(e){
    //alert("hi!"); //test
    f.preventDefault();

   //postid?           ok
   //comment text?     ok
   let postId = this.dataset.postid;
   let text = e.querySelector("#commentText").value;

       console.log(postId); // test
       console.log(text);   // test

   //post to database (ajax)
       let formData = new FormData();

       formData.append('text', text);
       formData.append('postId', postId);

      

        fetch("ajax/savecomment.php", { 
           method: "POST",
           body: formData
       })
           .then(response => response.json())
           .then(result => {
               //console.log('Success:', result);

               let newComment = document.createElement("li");
               newComment.innerHTML = result.body;
               e.querySelector(".post__comments__list").appendChild("test");

           })
           
           .catch(error => {
               console.error('Error:', error);
           });



})



/*document.querySelectorAll("#btnAddComment").addEventListener("click", function(e){
        //alert("hi!"); //test
        e.preventDefault();

    //postid?           ok
    //comment text?     ok
    let postId = this.dataset.postid;
    let text = document.querySelector("#commentText").value;

        //console.log(postId); // test
       // console.log(text);   // test

    //post to database (ajax)
        let formData = new FormData();

        formData.append('text', text);
        formData.append('postId', postId);

       

         fetch("ajax/savecomment.php", { 
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(result => {
                //console.log('Success:', result);

                let newComment = document.createElement('li');
                newComment.innerHTML = result.body.text;
                document
                    .querySelector(".post__comments__list")
                    .appendChild(newComment);

            })
            
            .catch(error => {
                console.error('Error:', error);
            });
             

    //answer*/


});