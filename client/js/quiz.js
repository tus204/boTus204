// Lấy phần tử p có class 'quiz-time'
var quizTimeElement = document.querySelector('.quiz-time');

// Lấy phần tử span bên trong phần tử p
var countdownElement = quizTimeElement.querySelector('span');

// Lấy giá trị ban đầu từ nội dung của thẻ span
var initialTime = countdownElement.textContent; // hoặc initialTime = countdownElement.innerText;

// Chuyển đổi giá trị thời gian thành số giờ và phút (đối với ví dụ "10:00")
var initialTimeArray = initialTime.split(':');
var initialMinutes = parseInt(initialTimeArray[0], 10);
var initialSeconds = parseInt(initialTimeArray[1], 10);

// Tính tổng thời gian ban đầu tính bằng giây
var initialTimeInSeconds = (initialMinutes * 60) + initialSeconds;

// Thiết lập thời gian ban đầu cho đồng hồ đếm ngược
var timeLeft = initialTimeInSeconds;

// Cập nhật giá trị đồng hồ đếm ngược
function updateCountdown() {
  var minutes = Math.floor(timeLeft / 60);
  var seconds = timeLeft % 60;

  // Định dạng thời gian hh:mm
  var countdownValue = ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);

  countdownElement.textContent = countdownValue;
  timeLeft--;

  // Kiểm tra nếu đồng hồ đếm ngược đã đạt đến 0
  if (timeLeft < 0) {
    clearInterval(countdownTimer);
    countdownElement.innerHTML = "Đếm ngược đã kết thúc!";
  }
}

// Cập nhật đồng hồ đếm ngược sau mỗi giây
var countdownTimer = setInterval(updateCountdown, 1000);


function submitQuiz() {
  var answers = {};
  var questions = document.querySelectorAll('input[type="radio"]:checked');

  questions.forEach(function (question) {
      answers[question.name] = question.value;
  });

  // In ra console hoặc xử lý dữ liệu ở đây
  console.log(answers);
}
