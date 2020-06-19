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
                            <!-- <h1>Welcome</h1> -->

                        </td>
                    </tr>
                    <tr>
                        <td class="content">
                            <h2>hi, <?= $nama_user ?></h2>
                            <p>
                                <h4>
                                    Silahkan login
                                </h4>
                            </p>
                            <table>
                                <tr>
                                    <td align="center">
                                        <a href="<?= site_url("login") ?>">Link</a></br>
                                        dengan password
                                        <h4>
                                            <?= $password_generated ?>
                                        </h4>
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
        

                        </td>

                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>



</html>