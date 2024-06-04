class Accordion {   
    constructor(accordionListQuestions){
        this.accordionListQuestion = document.querySelectorAll(accordionListQuestions);
        this.activeItemClass = "active";
    }

    toggleAccordion(item){
        item.classList.toggle(this.activeItemClass);
        item.nextElementSibling.classList.toggle(this.activeItemClass);
    }

    addAccordionEvent(){
        this.accordionListQuestions.forEach((question) => {
            question.addEventListener("click", () => this.toggleAccordion(question));
        });
    }

    init(){
        if(this.accordionListQuestion.length){
            this.addAccordionEvent();
        }
        return this;
    }
}

const accordion = new Accordion(".faq-question");
accordion.init();


function showMore(event) {
    const data = event.target.getAttribute('data-id');
    const answer = document.querySelector(`.faq-answer[data-id='${data}']`);
    answer.classList.toggle('open');
}