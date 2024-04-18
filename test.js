function checkFileExtension(filename) {
   // Lấy phần mở rộng của tên tệp
   let fileExtension = filename.split('.').pop().toLowerCase();

   // Danh sách các phần mở rộng bạn muốn kiểm tra
   let allowedExtensions = ['jpeg', 'jpg', 'webp', 'png'];

   // Kiểm tra xem phần mở rộng có trong danh sách cho phép hay không
   if (allowedExtensions.includes(fileExtension)) {
       return true; // Phần mở rộng hợp lệ
   } else {
       return false; // Phần mở rộng không hợp lệ
   }
}

// Thử nghiệm hàm với tên tệp tin
let filename = 'example.webp';
console.log(checkFileExtension(filename)); // Kết quả: true