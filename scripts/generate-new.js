const createNewLetter = document.getElementById("create-new-letter");

console.log(createNewLetter)

createNewLetter.addEventListener("click", () => {
    window.location.href = "pages/new-letter.html";
})