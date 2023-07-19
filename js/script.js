const myModal = document.getElementById('myModal')
const myInput = document.querySelectorAll('bi-pencil')

console.log(myInput);

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})
