document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.querySelector('.star-rating');
  
    stars.forEach(star => {
        star.addEventListener('mouseover', function() {
            const value = star.getAttribute('data-value');
            highlightStars(value);
        });
  
        star.addEventListener('click', function() {
            const value = star.getAttribute('data-value');
            ratingInput.setAttribute('data-rating', value);
        });   
    });
  
    function highlightStars(value) {
        if(value == null) {
            return;
        }

        document.getElementById('rating_value').value = value;

        stars.forEach(star => {
            const starValue = star.getAttribute('data-value');

            if (starValue <= value) {
                star.classList.remove('text-gray-500');
                star.classList.add('text-rose-300');
            } else {          
                star.classList.remove('text-rose-300');
                star.classList.add('text-gray-500');
            }
        });
    }
  });