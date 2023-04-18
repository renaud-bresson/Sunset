const $reviewsButton = document.querySelectorAll('[id^="reviewsButton"]');
const $reviewsDivs = document.querySelectorAll('[id^="reviewsDiv"]');
const $reviewsArrow = document.querySelectorAll('[class^="reviewsArrow"]');

let clickCount=0

$reviewsButton.forEach((button, index) => {
  button.addEventListener('click', (event) => {
    clickCount++;

    if (clickCount%2 != 0) {
      $reviewsDivs[index].style.display = 'flex';
      $reviewsArrow[index].classList.remove("fa-arrow-down");
      $reviewsArrow[index].classList.add("fa-arrow-up");
      event.stopPropagation()
    } else {
      $reviewsDivs[index].style.display = 'none';
      $reviewsArrow[index].classList.remove("fa-arrow-up");
      $reviewsArrow[index].classList.add("fa-arrow-down");
      event.stopPropagation()
      clickCount = 0;
    }
    
  });
});
