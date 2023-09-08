// collecting DOM Elements
const imageSlides = document.querySelectorAll(".image-slideshow-slide");
const imageProgressBar = document.querySelectorAll(
  ".image-slideshow-progress div"
);
// imageSlide index
let slideIndex = 1;
imageSlider(slideIndex);

setInterval(() => {
  slideIndex++;
  imageSlider(slideIndex);
}, 2000);

function imageSlider(indexNumber) {
  if (indexNumber > imageSlides.length) slideIndex = 1;

  imageSlides.forEach((slide) => {
    slide.style.display = "none";
  });

  imageProgressBar.forEach((bar) => {
    bar.classList.remove("active-image-slide");
  });

  imageSlides[slideIndex - 1].style.display = "block";
  imageProgressBar[slideIndex - 1].classList.add("active-image-slide");
}
