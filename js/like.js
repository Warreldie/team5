let likeButtons = document.querySelectorAll(".likes > button");

likeButtons.forEach((button) => {

    button.addEventListener("click", (evt) => {
        evt.preventDefault();
        let button = evt.target;

        let likeStatus = button.dataset.liked;
        
        let buttonParent = button.parentElement;
        let likeCounter = buttonParent.querySelector("#likes__counter");
        let likeText = buttonParent.querySelector(".like__text");
        let postId = button.dataset.postid;

        let formData = new FormData();
        formData.append("postId", postId);
        formData.append("status", likeStatus);

        fetch("ajax/updatelike.php", {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then((data) => {

                console.log(data.message);

                if(likeStatus === "true") {
                    button.innerText = "Like";
                    button.classList = "btn btn-outline-light";
                    button.dataset.liked = "false";
        
                    let likeCounterValue = Number(likeCounter.innerText);
                    likeCounterValue--;
                    updateText(likeCounter, likeText, likeCounterValue);
                } else if(likeStatus === "false" || likeStatus === "null") {
                    button.innerText = "Liked";
                    button.classList = "btn btn-light";
                    button.dataset.liked = "true";
        
                    let likeCounterValue = Number(likeCounter.innerText);
                    likeCounterValue++;
                    updateText(likeCounter, likeText, likeCounterValue);
                }

            })
            .catch(error => {
                console.error("Error: " + error);
            });

    });

});

const updateText = (likeCounter, likeText, likeCounterValue) => {
    likeCounter.innerText = likeCounterValue;
    console.log(likeText);

    if(likeCounterValue === 1) {
        likeText.innerText = "person likes this";
    } else {
        likeText.innerText = "people like this";
    }
}