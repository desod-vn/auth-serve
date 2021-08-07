<table 
    align="center" 
    border="0"
    cellpadding="0"
    cellspacing="0"
    width="400"
>
    <tr>
        <td align="center" bgcolor="#70bbd9" style="padding: 10px 0 30px 0;">
            <img src="https://i.imgur.com/dZW6ydi.png" alt="Creating Email Magic" width="300" height="auto" style="display: block;" />
        </td>
    </tr>

    <tr>
        <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td>
                        <h2>Xin chào {{ $user->name ?? 'Thắng' }} đã tham gia cùng chúng tôi
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px 0 30px 0;">
                        Dưới đây là những thông tin cơ bản để phục vụ việc đăng nhập vào dịch vụ của chúng tôi.
                        <p>Tài khoản của bạn được tạo vào <b>{{ $user->created_at ?? 'hôm nay'}}</b></p>
                        <p>Địa chỉ email: <b>{{ $user->email ?? 'example@gmail.com' }}</b></p>
                        <p>Họ và tên: <b>{{ $user->name ?? 'Thắng' }}</b></p>
                        <p>
                            Các thông tin như địa chỉ, số điện thoại, ngày sinh ... 
                            sẽ dễ dàng được cập nhật ngay khi bạn đăng nhập vào dịch vụ của chúng tôi
                        </p>

                    </td>
                </tr>
            </table>
        </td>
    </tr>
                
    <tr>
        <td bgcolor="#323422" style="padding: 30px 30px 30px 30px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%">
                    </td>
                       <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                        &reg; 2021 Thắng Vương<br/>
                        Tác giả 
                        <a href="https://desod.media" style="color: #ffffff;">
                            <font color="#ffffff">DESOD.MEDIA</font>
                        </a>
                       </td>
                </tr>
               </table>
           </td>
    </tr>
</table>