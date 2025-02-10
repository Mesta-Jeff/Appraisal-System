
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkaiMount Staff Appraisal System</title>
    
    <style>
      
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 0 auto;
            max-width: 800px;
            padding: 20px;
            margin-top: 15px;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #e31b23;
            padding-bottom: 10px;
        }

        .header-title {
            width: 100%;
        }

        .header-title h2 {
            color: #030558;
            margin: 0;
            padding-left: 100px;
            letter-spacing: 5.5px;
            font-family: 'Impact', Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }

        .header-panel {
            display: flex;
            align-items: center;
            background-color: #030558;
            color: white;
            padding: 5px;
            padding-right: 0px !important;
            width: 100%;
        }

        .header-panel img {
            height: 80px;
            margin-right: 20px;
        }

        .header-panel div h3 {
            color: #ffffff;
            margin: 0;
        }

        .header-panel div h4 {
            color: #c5bebe;
            margin: 0;
        }

        .contact-info {
            margin: 2px;
            margin-left: 0 !important;
            color: #c5bebe;
        }
        .contact-info span {
            font-size: 14px;
        }

        .content {
            padding-top: 20px;
            line-height: 1.6;
        }

        .content h2 {
            border-bottom: 1px solid #383838;
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-transform: uppercase;
        }

        .footer {
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #e31b23;
        }

        .footer-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-stripes {
            display: flex;
            height: 20px;
        }

        .footer-stripes div {
            width: 5px;
        }

        .footer-stripes .blue {
            background-color: #030558;
        }

        .footer-stripes .red {
            background-color: #e31b23;
        }

        .footer-stripes .white {
            background-color: #ffffff;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            justify-content: right;
            background-color: #030558;
            width: 100%;
            height: 20px;
        }

        .footer-logo img {
            margin-right: 5px;
            height: 13px;
            vertical-align: middle;
        }

        .footer-logo p {
            margin-right: 20px;
            font-size: 14px;
            vertical-align: middle;
            color: #ffffff;
        }
        .endorser {
            text-transform: uppercase;
            margin-top: -10px;
        }

        .position{
            text-transform: uppercase;
            font-size: 14px;
        }

        .button {
            display: inline-block;
            padding: 5px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #25bdd8;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-left: 3px;
            margin-right: 3px;
        }

        .button:hover {
            background-color: #0a7588;
        }

        .link {
            color: #18a8c2;
            text-decoration: none;
            margin-left: 3px;
            margin-right: 3px;
        }
        .link:hover{
            color: #0a7588;
            text-decoration: underline;
        }

    </style>

</head>

<body>
    <div class="container">
        
        <div class="header">
            <div class="header-title">
                <h2>UNIVERSITY OF EDUCATION, WINNEBA</h2>
                <div class="header-panel">
                    <img src="https://www.uew.edu.gh/themes/custom/pinaman/images/logos/logo-default.png" alt="UEW Logo">
                    <div>
                        <h3>QUALITY AND ASSURANCE UNIT</h3>
                        <h4>OFFICE OF THE DIRECTOR</h4>
                        <p class="contact-info">
                            <span> P.O. Box 25, Winneba, Ghana</span> |
                            <span> info@uew.edu.gh</span> |
                            <span> +233 (0) 303 938 714</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <p id="reference" style="margin: 0;">Our Ref: FSE/ DO/ 37/VOL.2/214</p>
            <p style="text-align: right; margin: 0;">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>

            <p>To: <br><strong>{{ $recipientName }}</strong><br>As ({{ $recipientRole }})<br>University of Education, Winneba<br>Winneba</p>

            <p><strong>Dear Sir/Madam,</strong></p>
            <h2>{{ $letterHeading }}</h2>
            <p id="letter-content">
                {{ $letterContent }}
            </p>
            <p>We count on your usual co-operation.</p>
            <p>Yours sincerely,</p>
            <img style="height: 50px;" src="https://cdn.prod.website-files.com/61d7de73eec437f52da6d699/62161cf7328ad280841f653f_esignature-signature.png">
            <p id="endorser"> <strong>{{ $endorserName }}<br> <b class="position">{{ $endorserPosition }}</b></strong></p>
        </div>

        <div class="footer">
            <div class="footer-content">
                <div class="footer-stripes">
                    <div class="blue" style="width: 35px;"></div>
                    <div class="red"></div>
                    <div class="white"></div>
                    <div class="blue"></div>
                    <div class="white"></div>
                    <div class="red"></div>
                    <div class="blue"></div>
                    <div class="white"></div>
                    <div class="red"></div>
                    <div class="blue"></div>
                    <div class="white"></div>
                    <div class="red"></div>
                    <div class="blue"></div>
                    <div class="white"></div>
                    <div class="red"></div>
                    <div class="blue"></div>
                    <div class="white"></div>
                </div>
                <div class="footer-logo">
                    <img src="https://www.uew.edu.gh/themes/custom/pinaman/images/logos/logo-default.png" alt="Logo">
                    <p>www.uew.edu.gh</p>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
