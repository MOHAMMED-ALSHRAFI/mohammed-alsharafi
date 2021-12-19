<?php
$page="about";
 include "header.php"; ?>
<br>
<div class="container-fluid " style="text-align:right;margin-top: 60px;max-width: 40%;">
    <h2 class="text-light " style="text-align: center; font-size: 4vw; ">لتواصل معنا</h2>
    <p class="text-light" style="text-align: center; font-size: 1.4vw;"> سجل بياناتك في الحقول التالية و هدف التواصل في
        الحقل الأخير</p>
    <form action="https://www.w3schools.com/action_page.php">
        <div class="form-group  text-light">
            <label for="usr">الاسم:</label>
            <input type="text" class="form-control" id="usr" name="username">
        </div>
        <div class="form-group  text-light">
            <label for="pwd">كلمة السر:</label>
            <input type="password" class="form-control" id="pwd" name="password">
        </div>
        <div class="form-group text-light">
            <label for="comment">تعليق:</label>
            <textarea class="form-control" rows="5" id="comment"></textarea>
        </div>
        <button type="submit" class="btn btn-warning">إرسال</button>
    </form>
</div>

<br>
<br>
<br>
<?php include "footer.php"; ?>