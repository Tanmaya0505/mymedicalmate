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
                                    <span style="font-size: 16px;">We now need to verify your email address. We have sent an email to {{ $data['email'] }} to verify your address.<br /><br />
Please click the link in that email to continue.</span>
                                </p>
                            </div>
                        </div>
                        <div align="center" class="button-container"
                             style="padding-top:15px;padding-right:0px;padding-bottom:20px;padding-left:0px;">
                            <a
                                href="{{ $data['verify_url'] }}"
                                style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #000000; background-color: transparent; border-radius: 30px; -webkit-border-radius: 30px; -moz-border-radius: 30px; width: auto; width: auto; border-top: 2px solid #000000; border-right: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; padding-top: 5px; padding-bottom: 5px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;"
                                target="_blank"><span
                                    style="padding-left:40px;padding-right:40px;font-size:16px;display:inline-block;letter-spacing:undefined;"><span
                                        style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;">Click Now</span></span></a>
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