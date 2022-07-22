<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
   <meta name="viewport" content="">
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title>CIAP </title>
   <style type="text/css">
      @media (max-width: 620px) {
         table {
            width: 100% !important;
            max-width: 100% !important;
         }
      }
   </style>
</head>

<body bgcolor="#ffffff" style="margin:0; padding:0; font-family: Calibri;">





   <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f9f9f9" class="wrapper" role="presentation"
      align="center">
      <tr>
         <td valign="top" align="center">
            <table cellspacing="0" width="600" cellpadding="0" border="0" align="center"
               style="background:#fff; color:#888;width:600px; font-family: Calibri, Helvetica, sans-serif;">
               <tbody>
                  <tr>
                     <td valign="top" bgcolor="#fff"
                        style="background:#fff; box-shadow:0px 3px 15px 0px rgba(174, 174, 174, 0.15);" align="center">
                        <table class="emailwrapto90pc" style="width:100%;" cellspacing="0" cellpadding="0" border="0"
                           align="left">
                           <tbody>
                              <tr>
                                 <td style="padding:15px 0px;" valign="top" align="center"> <a href="" target="_blank">
                                       <img src="http://travander.in/efa17e8310b09f571108.png" alt=""></a> </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td align="left" style="padding: 20px 25px; text-align: left; font-size: 16px; line-height: 20px;">
                        <table cellspacing="0" cellpadding="0" width="100%">
                           <tbody>
                              <tr>
                                 <td> <b
                                       style="color:#444444; font-weight: normal; font-family: Calibri, Helvetica, sans-serif;">Hi{{namewithcoma}}</b>
                                 </td>
                              </tr>
                              <tr>
                                 <td style="padding: 20px 0 0 0;color:#444444;"> We are sending you this email following
                                    your recent request to update your password. </td>
                              </tr>
                              <tr>
                                 <td style="padding: 20px 0 0 0;color:#444444;"> To proceed with updateting your password
                                    please click <a style="color:#3075c6; font-weight:600; text-decoration:underline;"
                                       href="{{env('APP_URL').'/'.$user->email}}">here </a> </td>
                              </tr>
                              <tr>
                                 <td style=" color:#444444;padding-top:20px; line-height:20px; " valign="top"
                                    align="left"> Kind regards,<br><strong>Travander Team</strong> </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>

               </tbody>
            </table>
         </td>
      </tr>
      </tbody>
   </table>
   </td>
   </tr>
   </table>



</body>

</html>