@include('frontend-source.emails.includes.header')
<div style="background-color:transparent;">
    <div class="block-grid"
         style="min-width: 320px; max-width: 680px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
        <div
            style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
            <div class="col num12"
                 style="min-width: 320px; max-width: 680px; display: table-cell; vertical-align: top; width: 680px;">
                <div class="col_cont" style="width:100% !important;">
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                        <table cellpadding="0" cellspacing="0" role="presentation"
                               style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                               valign="top" width="100%">
                            <tr style="vertical-align: top;" valign="top">
                                <td align="center"
                                    style="word-break: break-word; vertical-align: top; padding-bottom: 5px; padding-left: 30px; padding-right: 30px; padding-top: 5px; text-align: center; width: 100%;"
                                    valign="top" width="100%">
                                    <h1
                                        style="color:#000000;direction:ltr;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;font-size:20px;font-weight:normal;letter-spacing:normal;line-height:120%;text-align:center;margin-top:0;margin-bottom:0;">
                                        {{ $data['subject'] }}
                                    </h1>
                                </td>
                            </tr>
                        </table>
                        <div
                            style="color:#1d1d1b;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;line-height:1.5;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px;">
                            <div class="txtTinyMce-wrapper"
                                 style="line-height: 1.5; font-size: 12px; color: #1d1d1b; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 18px;">
                                <p
                                    style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; text-align: center; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;">
                                    <span style="font-size: 16px;">Dear {{ $data['guest_name'] }},<br />
                                    Your profile has been successfully approved by My medical mate. Now you can see your profile details on website</span>
                                </p>
                            </div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0" class="divider"
                               role="presentation"
                               style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                               valign="top" width="100%">
                            <tbody>
                                <tr style="vertical-align: top;" valign="top">
                                    <td class="divider_inner"
                                        style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;"
                                        valign="top">
                                        <table align="center" border="0" cellpadding="0"
                                               cellspacing="0" class="divider_content" height="20"
                                               role="presentation"
                                               style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 20px; width: 100%;"
                                               valign="top" width="100%">
                                            <tbody>
                                                <tr style="vertical-align: top;" valign="top">
                                                    <td height="20"
                                                        style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                                                        valign="top"><span></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend-source.emails.includes.footer')