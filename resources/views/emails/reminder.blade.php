<html>
  <title>Bank M Service portal Reminder</title>
  <head></head>
<body>
  <table width="80%">
      <thead>
      <tr>
          <th bgcolor="005DAD" style="color: #FFFFFF" allign="center" colspan="2">{{$reminder->rm_title}}</th>
      </tr>
      </thead>
       <tbody>
         <tr>
             <td>{{$reminder->start_date}}</td>
             <td>{{$reminder->description}}</td>
         </tr>
       </tbody>
      <tfoot>
          <tr>
              <th bgcolor="005DAD" style="color: #FFFFFF" colspan="2"></th>
          </tr>
      </tfoot>
  </table>
</body>
</html>