<html>
    <body>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,300' rel='stylesheet' type='text/css'>
        <table width="614" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:'Open Sans',Arial,Helvetica,sans-serif;font-size:12px;color:#656565;background: #0a0a0a;border: 1px solid #D6D5D5;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;-webkit-box-shadow: 0px -1px 5px #DDD;-moz-box-shadow: 0px -1px 3px #DDD;box-shadow: 0px -1px 5px #DDD;width: 168px;">
            <tbody>
                <tr>
                    <td style="border-radius: 8px 8px 0 0; position: relative; text-align:center;background: #020202;">
                        <a href="<?php echo '#'; ?>" target="_blank">
                            <img src="<?php echo url("/")."/resources/assets/images/". 'logo-blue.png' ?>" alt="London Hot right now" width="600" border="0" style="padding:0px">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="padding:10px; background: #fff;">
                        <table width="576" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#656565">
                            <tbody>
                                <tr>
                                    <td style="padding:0 10px 10px 10px;">
                                        <table width="554" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tbody>                                                  
                                                <tr>
                                                  <td colspan="2" >Dear {{ $name }},</td>
                                                </tr>
                                                <tr>
                                                  <td colspan="2" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td colspan="2">
                                                    <p>Forgott password? Don't worry. Here is the temporary password. You can login trough this password and later on you can update it from your profile. We recommed update it once you logged in using this temporary password.</p>
                                                  </td>                                                  
                                                </tr>
                                                <tr>
                                                  <td colspan="2" >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td colspan="2">
                                                    <p>{{$code}}</p>
                                                  </td>                                                  
                                                </tr>
                                                <tr>
                                                  <td colspan="2" >&nbsp;
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td>
                                                    <p>From,</p>
                                                  </td>
                                                  <td>                                                    
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td>
                                                    <p>Team London HRN</p>
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
                <tr>
                    <td style="font-family:'Open Sans',Arial,Helvetica,sans-serif; font-size:11px; line-height:16px; padding:15px 18px; text-align:center; border-radius: 0 0 8px 8px; background-color: #020202; border-top: 3px solid #6c6c6c; color: #fff;">
                        <?php //echo $this->config->item('front_footer'); ?>&copy; LONDON HOT RIGHT NOW
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>