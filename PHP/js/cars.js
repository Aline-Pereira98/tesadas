import Validations from "./Validations.js"

const validations = new Validations()
const inputsForm = document.querySelectorAll("[data-type]")
console.log(inputsForm)

inputsForm.forEach(inputForm => {
    inputForm.addEventListener('blur', event => {
        event.preventDefault()
        validations.validity(inputForm)
    })
})