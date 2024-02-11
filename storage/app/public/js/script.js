// console.log(authors);

function autocomplete(input, authors) {
    input.addEventListener('input', function () {
        //Close the existing list if it is open
        closeList();
       
        //If the input is empty, exit the function
        if (!this.value){
            return;
        }

        //Create a suggestions <div> and add it to the element containing the input field
        suggestions = document.createElement('div');
        suggestions.setAttribute('id', 'suggestions');
        this.after(suggestions);

        //Iterate through all entries in the list and find matches
        for (let i = 0; i < authors.length; i++) {
            if (authors[i]['name'].toUpperCase().includes(this.value.toUpperCase())) {
                //If a match is found, create a suggestion <div> and add it to the suggestions <div>
                suggestion = document.createElement('div');
                suggestion.innerHTML = authors[i]['name'];
                
                suggestion.addEventListener('click', function () {
                    input.value = this.innerHTML;               

                    closeList();
                });
                suggestion.style.cursor = 'pointer';

                suggestions.appendChild(suggestion);
            }
        }

    });
}


function closeList() {
    let suggestions = document.getElementById('suggestions');
    if (suggestions) {
        suggestions.parentNode.removeChild(suggestions);
    }
}

autocomplete(document.getElementById("author_name"), authors);



document.getElementById('overlay').addEventListener('click', function () {
    document.getElementById('newCoverInput').click();
});

function updateCoverImage(input) {
    const coverImage = document.getElementById('coverImage');
    const reader = new FileReader();

    reader.onload = function (e) {
        coverImage.src = e.target.result;
    };

    reader.readAsDataURL(input.files[0]);
}
