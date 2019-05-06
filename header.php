<style>
    .header a:hover
    {

    }
</style>

<div id="header">
<link rel="icon" href="Golestan.png">
    <div style="float: right; width: 7%; height: 100px;">
        <a href="http://10.75.48.183/nezam/"><img src="Golestan.png"></a>
    </div>
    <div id="golestan" style="padding-right: 10px; float: right; direction: rtl; width: 65%; height: 100px;line-height: 100px;">مرکز آموزش های کوتاه مدت دانشگاه گلستان</div>
    <div id="golestan" style="float: left; direction: rtl; width: 15%; height: 100px;line-height: 100px;">
        <?php
        if(isset($_SESSION['username'])) {
            echo $_SESSION['lastname'];
            ?>
            <a href="index.php?logout=1" class="header"
               style="color: black;text-align: center;text-decoration: none; float: left;height: 100px;width: 100px; ">خروج</a>
            <?php
        }
        ?>
    </div>
</div>
