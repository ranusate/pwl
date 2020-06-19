<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />

    <!-- For development, pass document through inliner -->
    <link rel="stylesheet" href="assets/mail/css/simple.css">

    <style type="text/css">
    /* Your custom styles go here */
    </style>
</head>

<body>
    <table class="body-wrap">
        <tr>
            <td class="container">

                <!-- Message start -->
                <table>
                    <tr>
                        <td align="center" class="masthead">
                            <h1>Aktifkan akun anda</h1>

                        </td>
                    </tr>
                    <tr>
                        <td class="content">
                            <!-- <h1>hi, <?= $user["nama"] ?></h1> -->
                            <p>Kielbasa venison ball tip shankle. Boudin prosciutto landjaeger, pancetta jowl turkey
                                tri-tip porchetta beef pork loin drumstick. Frankfurter short ribs kevin pig ribeye
                                drumstick bacon kielbasa. Pork loin brisket biltong, pork belly filet mignon ribeye
                                pig

                                <table>
                                    <tr>
                                        <td align="center">
                                            <p> Silahkan klik link berikut untuk mengaktivasi akun anda</p> <br>
                                            <a
                                                href="' . base_url() . 'au/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>;
                                        </td>
                                    </tr>
                                </table>

                        </td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr>
            <td class="container">

                <!-- Message start -->
                <table>
                    <tr>
                        <td class="content footer" align="center">
                            <!-- <p>Sent by <a href="#"> <?= $customer["name_p"] ?></a>, Nim : <?= $customer["nim"] ?> -->


                        </td>

                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>



</html>