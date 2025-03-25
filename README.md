# MDWP Optimize  
MDWP Optimize is a code snippet designed to optimize websites using the WordPress CMS, making them faster, lighter, and improving overall performance.  

## ✔️ Usage :  
This code should be added to the `functions.php` file located in the theme folder. Place the code at the bottom to avoid conflicts with other scripts.  

## 🚨 Important :  
Please note that some code may not be compatible with your theme or plugins. This can cause:  
- The theme layout to break  
- A blank screen (White Screen of Death)  
- Errors or malfunctions  

Therefore, it is recommended to:  
✅ Test each piece of code one by one  
✅ Create a backup before applying the code  
✅ Test in a staging environment before deploying to the live site  

## ⚡ Key Features  
MDWP Optimize includes various features to improve WordPress performance and security:  

### 🚀 **Performance Optimization**  
- 🔹 Remove query strings from static resources for better caching  
- 🔹 Disable WP-Cron to reduce server load  
- 🔹 Schedule daily and weekly database optimization  
- 🔹 Remove unnecessary elements from `wp_head` for faster page loading  
- 🔹 Disable autosave to reduce database load  

### 🔐 **Security Enhancements**  
- 🔹 Disable XML-RPC to prevent security exploits  
- 🔹 Remove WordPress version info from headers to hide system details  
- 🔹 Disable pingbacks and self-pingbacks to avoid DDoS attacks  
- 🔹 Limit login attempts to prevent brute force attacks  
- 🔹 Display a custom login error message to hide user details  

### 🛠️ **Admin & Backend Optimization**  
- 🔹 Disable Heartbeat API on the frontend to save server resources  
- 🔹 Disable oEmbed to speed up page loading  
- 🔹 Remove emoji and dashicons for non-logged-in users  
- 🔹 Disable REST API for users who are not logged in  

### 🔎 Tested On  
![](https://img.shields.io/badge/WordPress-Version%206.7.1-informational?style=flat&logo=wordpress&logoColor=white&color=0082f8)  

---

# MDWP Optimize  
MDWP Optimize adalah kode yang dibuat untuk membantu mengoptimalkan situs web berbasis CMS WordPress agar lebih cepat, ringan, dan memiliki performa lebih baik.  

## ✔️ Penggunaan :  
Kode ini ditulis ke dalam file `functions.php` yang terletak di folder tema. Letakkan kode di bagian bawah untuk menghindari konflik dengan kode lainnya.  

## 🚨 Penting :  
Harap dicatat bahwa beberapa kode mungkin tidak kompatibel dengan tema atau plugin yang Anda gunakan. Ini dapat menyebabkan:  
- Tampilan tema menjadi berantakan  
- Layar kosong (White Screen of Death)  
- Error atau malfungsi tertentu  

Oleh karena itu, disarankan untuk:  
✅ Mencoba setiap potongan kode satu per satu  
✅ Melakukan backup sebelum menerapkan kode  
✅ Menguji terlebih dahulu di staging site sebelum diterapkan ke situs utama  

## ⚡ Fitur Utama  
MDWP Optimize memiliki berbagai fitur untuk meningkatkan performa dan keamanan situs WordPress:  

### 🚀 **Optimasi Performa**  
- 🔹 Menghapus query string dari sumber daya statis untuk caching yang lebih baik  
- 🔹 Menonaktifkan WP-Cron untuk mengurangi beban server  
- 🔹 Menjadwalkan optimasi database harian dan mingguan  
- 🔹 Menghapus elemen tidak perlu dari `wp_head` untuk loading lebih cepat  
- 🔹 Menonaktifkan autosave untuk mengurangi beban database  

### 🔐 **Keamanan**  
- 🔹 Menonaktifkan XML-RPC untuk mencegah eksploitasi keamanan  
- 🔹 Menghapus versi WordPress dari header untuk menyembunyikan informasi sistem  
- 🔹 Menonaktifkan pingback dan self-pingback untuk menghindari serangan DDoS  
- 🔹 Membatasi percobaan login untuk mencegah serangan brute force  
- 🔹 Menampilkan pesan error login khusus untuk menyembunyikan informasi pengguna  

### 🛠️ **Optimasi Admin & Backend**  
- 🔹 Menonaktifkan Heartbeat API di frontend untuk menghemat resource server  
- 🔹 Menonaktifkan oEmbed untuk mempercepat loading halaman  
- 🔹 Menonaktifkan emoji dan dashicons untuk non-logged-in users  
- 🔹 Menonaktifkan REST API untuk pengguna yang tidak login  

### 🔎 Teruji Pada  
![](https://img.shields.io/badge/WordPress-Version%206.7.1-informational?style=flat&logo=wordpress&logoColor=white&color=0082f8)  
