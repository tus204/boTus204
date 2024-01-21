
    document.querySelector('input[type="text"]').addEventListener("blur", function(event){
            if(!event.target.value){
                alert ("* Please enter complete information !");
            }
         });
 

function val_category(){
    document.getElementById('add-category').addEventListener('submit', function(event){
        var category_name= document.getElementById('category_name').value.trim();

        var category_name_error = document.getElementById('category_name_error');
        
        category_name_error.innerText= '';
        var isValid = true;
             if(category_name ===""){
             category_name_error.innerText = '* Please enter complete information !';
             isValid = false;

             }
             if(!isValid){
             event.preventDefault();
             }
        });
}
function val_post(){
    document.getElementById('add-post').addEventListener('submit', function(event){
        var post_title = document.getElementById('post_title').value.trim();
        var post_content = document.getElementById('post_content').value.trim();
        var post_image = document.getElementById('post_image').value.trim();
    
        // Khai báo biến báo lỗi
        var post_title_error = document.getElementById('post_title_error');
        var post_content_error = document.getElementById('post_content_error');
        var post_image_error = document.getElementById('post_image_error');
    
        post_title_error.innerText = '';
        post_content_error.innerText = '';
        post_image_error.innerText = '';
    
        var isValid = true;
    
        if(post_title === ""){
            post_title_error.innerText = '* Please enter complete information for the post title!';
            isValid = false;
        }
    
        if(post_content === ""){
            post_content_error.innerText = '* Please enter complete information for the post content!';
            isValid = false;
        }
    
        if(post_image === ""){
            post_image_error.innerText = '* Please enter complete information for the post image!';
            isValid = false;
        }
    
        if (!isValid) {
            event.preventDefault(); // Ngăn chặn gửi form nếu dữ liệu không hợp lệ
        }
    });
}
function val_course(){
    document.getElementById('add-course').addEventListener('submit', function(event) {
        var courseName = document.getElementById('course_name').value.trim();
        var courseTitle = document.getElementById('course_title').value.trim();
        var video = document.getElementById('course_video').value.trim();
        var courseContent = document.getElementById('course_content').value.trim();
        var courseDesc = document.getElementById('course_desc').value.trim();
        var image = document.getElementById('course_image').value.trim();

        var courseNameError = document.getElementById('courseName_error');
        var courseTitleError = document.getElementById('courseTitle_error');
        var videoError = document.getElementById('video_error');
        var courseContentError = document.getElementById('courseContent_error');
        var courseDescError = document.getElementById('courseDesc_error');
        var imageError = document.getElementById('image_error');

        // Xóa thông báo lỗi cũ
        courseNameError.innerText = '';
        courseTitleError.innerText = '';
        videoError.innerText = '';
        courseContentError.innerText = '';
        courseDescError.innerText = '';
        imageError.innerText = '';

        var isValid =true;

        // Kiểm tra từng trường và hiển thị thông báo lỗi khi cần
        if (!courseName || !courseTitle || !video || !courseContent || !courseDesc || !image) {
            if (courseName ==="") {
                courseNameError.innerText = 'Please complete all information';
                isValid =false;
            }
            if (courseTitle==="") {
               courseTitleError.innerText = 'Please complete all information';
               isValid =false;

            }
            if (video==="") {
               videoError.innerText = 'Please complete all information';
               isValid =false;

            }
            if (courseContent==="") {
               courseContentError.innerText = 'Please complete all information';
               isValid =false;

            }
            if (courseDesc==="") {
               courseDescError.innerText = 'Please complete all information';
               isValid =false;

            }
            if (image==="") {
               imageError.innerText = 'Please complete all information';
               isValid =false;

            }
            // Tương tự kiểm tra các trường khác và hiển thị thông báo lỗi
         
        }
         if(!isValid){
          event.preventDefault();
         }

    });
}
function val_quiz(){
    document.getElementById('add-quiz').addEventListener('submit', function(event){
        var quizName = document.getElementById('quizName').value.trim();
        var quizTime = document.getElementById('quizTime').value.trim();
        var quizImage = document.getElementById('quizImage').value.trim();
        // Hàm báo lỗi
        var quizName_error = document.getElementById('quizName_error');
        var quizTime_error = document.getElementById('quizTime_error');
        var quizImage_error = document.getElementById('quizImage_error');
        
        quizName_error.innerText ='';
        quizTime_error.innerText='';
        quizImage_error.innerText='';
        var isValid =true;
        if(!quizName || !quizTime || !quizImage){
            if(!quizName){
                quizName_error.innerText ='* You need to enter quiz name !';
                isValid =false;
            }
            if(!quizTime){
                quizTime_error.innerText='* You need to enter quiz time !';
                isValid =false;
            }
            if(!quizImage){
                quizImage_error.innerText='* You need to enter quiz image !';
                isValid =false;
            }
            if(!isValid){
                event.preventDefault(); 
            }
        }
    
      });
    
}