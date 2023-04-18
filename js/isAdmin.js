const div = document.querySelector('#notAdmin');

let decompte = 3;

const timer = setInterval(function( ){
  div.innerHTML = decompte;
  decompte--;
   if (decompte === 0) {
      clearInterval(timer);
      location = "./index.php";
    }
}, 1000);