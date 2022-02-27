<?php
    include('./controller/calendar_controller.php');
    //phpinfo();
    $controller = new CalendarController();
    $controller->render_calendar();
?>