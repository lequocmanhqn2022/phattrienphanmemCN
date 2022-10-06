// nút ẩn/hiện mật khẩu
const btnShowHideElement = document.querySelector('.btn-show-hide');
const passwordInputElement = document.querySelector('.input-box .password');
const openEyeElement = document.querySelector('.btn-show-hide i:first-child');
const closeEyeElement = document.querySelector('.btn-show-hide i:last-child');

btnShowHideElement.addEventListener('click', () => {
    if(passwordInputElement.attributes.type.value == "password"){
        passwordInputElement.attributes.type.value =  "text";
        openEyeElement.style.display = "block";
        closeEyeElement.style.display = "none";
    }
    else{
        passwordInputElement.attributes.type.value =  "password";
        openEyeElement.style.display = "none";
        closeEyeElement.style.display = "block";
    }
});
//chuyển đổi ảnh ở trang đăng nhập
var index = 1;
changeImage = function changeImage(){
    var imgs = ["image/images1.png","image/images2.png","image/images3.png","image/images4.png"];
    document.getElementById('img').src = imgs[index];
    index++;
    if(index==4)
    {
        index=0;
    }
}
setInterval(changeImage,4000);
