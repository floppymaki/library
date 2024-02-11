// console.log(authors);
document.getElementById('bio').value = '';

// toggleForm(document.getElementById('showAuthor'));
// toggleForm(document.getElementById('showBook'));

function autocomplete(input, authors) {
    input.addEventListener('input', function () {
        closeList();
        

        if(input.value == '') {
            updateAuthorButton(input.value);
            document.getElementById('bio').value = '';
        }


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

                    updateAuthorButton(this.innerHTML);
                    


                    closeList();
                });
                suggestion.style.cursor = 'pointer';

                suggestions.appendChild(suggestion);
            }
        }

    });
}



function updateAuthorButton(name) {
    // todo: edit route as well and add delete author btn

    var authorDiv = document.getElementById('authorDiv');
    var form = document.getElementById('authorForm');
    var authorBtn = document.getElementById('submitAuthor');
    var authorExists = false;

    var authorID = authors.filter(author => author.name.includes(name))[0]['id'];

    if (authors.filter(author => author.name == (name)).length !== 0) {
        authorExists = true;
    }

    if (authorExists) {
        authorBtn.textContent = 'Edit author';
        form.action = editRoute + '/' + authorID;
        var bioText = authors.filter(author => author.name.includes(name))[0]['biography'];
        document.getElementById('bio').value = bioText;

    } else {
        authorBtn.textContent = 'Add author';
        form.action = addRoute;
    }
}

function closeList() {
    let suggestions = document.getElementById('suggestions');
    if (suggestions) {
        suggestions.parentNode.removeChild(suggestions);
    }
}

autocomplete(document.getElementById("add_author_name"), authors);

function toggleForm(btn) {
    const bookForm = document.getElementById('bookForm')
    const authorForm = document.getElementById('authorForm');
    const bookBtn = document.getElementById('showBook')
    const authorBtn = document.getElementById('showAuthor');

    if(btn.id === 'showBook') {
        authorDiv.classList.remove('flex');
        authorDiv.classList.add('hidden')
        bookForm.classList.remove('hidden');
        bookForm.classList.add('flex')

        bookBtn.classList.remove('bg-indigo-300');
        bookBtn.classList.add('bg-indigo-500');

        authorBtn.classList.remove('bg-indigo-500');
        authorBtn.classList.add('bg-indigo-300');
    } else {
        authorDiv.classList.remove('hidden');
        authorDiv.classList.add('flex')
        bookForm.classList.remove('flex');
        bookForm.classList.add('hidden')

        authorBtn.classList.remove('bg-indigo-300');
        authorBtn.classList.add('bg-indigo-500');

        bookBtn.classList.remove('bg-indigo-500');
        bookBtn.classList.add('bg-indigo-300');
    }

}

function fillForm(author) {
    document.getElementById('add_author_name').value = author['name'];
    document.getElementById('bio').value = author['biography'];

    updateAuthorButton(author['name']);
}
