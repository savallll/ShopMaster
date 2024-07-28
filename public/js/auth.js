// fetch('/register', {
//     method: 'POST',
//     body: JSON.stringify({
//         // Dữ liệu từ form
//     }),
//     headers: {
//         'Content-Type': 'application/json',
//         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//     }
// })
// .then(response => response.json())
// .then(data => {
//     // Xử lý response từ server
//     if (data.redirect) {
//         window.location.href = data.redirect; // Chuyển hướng
//     } else if (data.message) {
//         alert(data.message); // Hiển thị thông báo
//     } else {
//         // Xử lý dữ liệu khác nếu cần
//     }
// })
// .catch(error => {
//     // Xử lý lỗi nếu có
//     console.error('Error:', error);
// });
