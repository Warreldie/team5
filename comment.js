document.querySelector("#btnAddComment").addEventListener("click", function(e){
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
                newComment.innerHTML = result.body;
                document
                    .querySelector(".post__comments__list")
                    .appendChild(newComment);

            })
            
            .catch(error => {
                console.error('Error:', error);
            });
             

    //answer


});