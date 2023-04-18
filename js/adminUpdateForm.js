const updateIcons = Array.from(document.querySelectorAll('[id^="updateIcon"]'))
  .sort((a, b) => a.id.localeCompare(b.id));

const updateOperatorForms = Array.from(document.querySelectorAll('[id^="updateOperatorForm"]'))
  .sort((a, b) => a.id.localeCompare(b.id));

const operatorDivs = Array.from(document.querySelectorAll('[id^="operatorDiv"]'))
  .sort((a, b) => a.id.localeCompare(b.id));

const updateOperatorFormCancelButtons = Array.from(document.querySelectorAll('[id^="updateOperatorFormCancelButton"]'))
  .sort((a, b) => a.id.localeCompare(b.id));




updateIcons.forEach((button, index) => {

  button.addEventListener('click', (event) => {
    updateOperatorForms[index].style.display = 'block';
    operatorDivs[index].style.display = 'none';
    console.log(button);
    console.log(updateOperatorForms[index]);
    console.log(operatorDivs[index]);
    event.stopPropagation()
  });
});

updateOperatorFormCancelButtons.forEach((buttonCancel, index) => {
  buttonCancel.addEventListener('click', (event) => {
    updateOperatorForms[index].style.display = 'none';
    operatorDivs[index].style.display = 'block';
    event.stopPropagation()
  });
});