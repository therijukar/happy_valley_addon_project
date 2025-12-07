<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket</title>
    <style>
        body{ font-family: Arial; color: #999; }
    </style>
</head>
<body>

<div style="width:350px; margin: 0 auto; background: #efefef">
    <div>
        <img src="https://gohappyvalley.com/web/assets/images/video-img.jpg" alt="" width="100%;">
    </div>
    <div style="padding:4% 2%;"><h3 style="padding: 0; margin: 0; font-weight: 600;">Happy Valley Park | <b style="color: #000;"><?php echo $model->ticket_no; ?></b></h3></div>
    <hr>
    <div style="padding: 4% 2%">
        <div style="display: inline-block; width: 48%">Date<br><h3 style="padding: 0; margin: 0;"><?php echo $model->date; ?></h3></div>
        <div style="display: inline-block; width: 48%">Time<br><h3 style="padding: 0; margin: 0;">10:00am Onwards</h3></div>
    </div>
    <hr>
    <div style="padding: 4% 2%">
        <div style="display: inline-block; width: 48%; font-weight: 600; line-height: 22px;"><?php echo $model->name; ?><br><?php echo $model->phone ?></div>
        <div style="display: inline-block; width: 48%; font-weight: 600; line-height: 22px;">Qty: <?php echo $model->no_of_units.'X20' ?><br>Rs. <?php echo $model->amount; ?></div>
    </div>
</div>

</body>
</html>
