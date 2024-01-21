const questionModel = document.querySelector(".question-model");
const btnAddQuestion = document.querySelector(".addQuestion");
const btnSave = document.querySelector(".btnSave");
const formContainer = document.querySelector(".question");

btnAddQuestion.addEventListener("click", function () {
    questionModel.classList.add("active");
});

questionModel.addEventListener("click", function (event) {
    // Kiểm tra xem phần tử được nhấp có là phần tử form hay không
    if (!event.target.closest(".question")) {
        questionModel.classList.remove("active");
    }
});

btnSave.addEventListener("click", function () {
    questionModel.classList.remove("active");
});

const radioButtons = document.querySelectorAll('.answer-item input[type="radio"]');

// Lặp qua từng radio button và thêm sự kiện change
radioButtons.forEach((radio) => {
    radio.addEventListener("change", (event) => {
        // Bỏ chọn tất cả các radio button trừ radio button được chọn
        radioButtons.forEach((otherRadio) => {
            if (otherRadio !== event.target) {
                otherRadio.checked = false;
            }
        });
    });
});
