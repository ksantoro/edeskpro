<html>
<head></head>
<body>
    <div style='max-width:600px;border: 1px solid #e8e8e8;margin: 0 auto;font-family:Arial, sans-serif;'>
        <div style='width:560px;background:#36454f;padding:30px 20px 20px 20px;'>
            <div style='max-width:280px;float:left'>
                <img src='https://elasticbeanstalk-us-east-2-899413643241.s3.us-east-2.amazonaws.com/resources/images/edesk_logo_white.png' style='border:0;width:250px;'>
            </div>
            <div style="max-width:280px;float:right">
                <h3 style='color:#00cccc;font-weight:100;'>{{ $title }}</h3>
            </div>
            <div style='clear:both;'></div>
        </div>

        <div style='width:560px;background:#fff;padding:40px 20px 50px 20px;'>

            @yield('email_content')

        </div>

        <div style='width:560px;background:#dfe5e8;padding:30px 20px 20px 20px;'>
            <p style='text-align:center;font-size:0.8em;color:#555;'>
                Email sent by <a href='#'>eDeskPro Software</a>. Copyright &copy; {{ date('Y') }}. All Rights Reserved.
            </p>
        </div>

    </div>
</body>
</html>
