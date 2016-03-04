<html>
    <head>
        <title>Bank M Service portal Reminder</title>
    </head>
    <body>
    <div style="border:#366 solid thin">
        <div style="background-color:#0f74b8;padding:5px;color:#fff">Title:{{$reminder->rm_title}}</div>
        <table style="color:#000" cellpadding="10px">
            <tr>
                <td>Description</td>
                <td>{{$reminder->description}}</td>
            </tr>
            <tr>
                <td>Instruction Date</td>
                <td>{{date("d-M-Y",strtotime($reminder->instruction_date))}}</td>
            </tr>
        </table>
        <div style="background-color:#0f74b8;padding:5px;color:#fff">Reminder Notification:-Do not reply this email</div>
    </div>

    </body>
    </html>