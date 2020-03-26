<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
 <style>
				u + #body a {
    color: inherit;
    text-decoration: none;
    font-size: inherit;
    font-family: inherit;
    font-weight: inherit;
    line-height: inherit;
}
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
<body id="body">
   

    <table  class="wrapper" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0">

                  <tr>

                  </tr>

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                                <!-- Body content -->


                                <td>
                              </td>
                                  {{--}}<td>{{$public_name }}</td>
                                  <td>{{$sender_citizen }}</td>
                                  <td>{{$public_email }}</td>
                                  <td>{{$member_id }}</td>
                                  <td>{{$public_mobile }}</td>--}}


                                </tr>
                            {{--}}    @foreach ($messagetypes as $m)
                                <tr>

                                      <p>  {{$m->message_default}} </p>

									@break
                @endforeach--}}

                                </tr>

                                <tr>

                                  @foreach ($sender as $s)
                                    <p>ทาง wealth thai ขอแจ้งให้ท่านทราบว่า มี ข้อความใหม่ ส่งถึงท่าน โดยมีเนื้อหาดังนี้</p>
                                      <p>
                                        ข้อความถูกส่งมาจาก : {{$s->sender_name}}
                                      </p>
                                      <p>
                                       Sender Public ID  : {{$s->sender_id}}
                                      </p>
                                      <p style=" color: #000001 !important;">
                                        Marketing E-mail  : {{$s->sender_email}}
                                      </p>
                                      <p>
                                      Marketing Mobile  :   {{$s->sender_mobile}}
                                      </p>
                                      @break
                                      @endforeach
                                      <p>โดยมีข้อความดังนี้ :  {{$messages}} </p>
                                    </tr>
                              <br>
                            </table>
                        </td>
                    </tr>

                    <p style="text-align:center;">&copy; {{ date('Y') }} Total Wealth Solution Thailand  All rights reserved.</p>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
