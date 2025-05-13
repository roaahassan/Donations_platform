<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>جارٍ التوجيه...</title>
</head>
<body>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const wasInDonatePage = localStorage.getItem('was_in_donate_page');
            const needId = localStorage.getItem('pending_donation_need_id');
            const role = localStorage.getItem('role'); // تحقق مما إذا كان المستخدم إداريًا

            if (role === 'admin') {
                // إذا كان المستخدم إداريًا، وجهه إلى صفحة الإدمن الرئيسية
                window.location.href = '/admin/dashboard';
            } else if (wasInDonatePage === 'true' && needId) {
                // امسح البيانات بعد الاستخدام
                localStorage.removeItem('was_in_donate_page');
                localStorage.removeItem('pending_donation_need_id');

                window.location.href = '/donate/' + needId;
            } else {
                window.location.href = '/';
            }
        });
    </script>
</body>
</html>