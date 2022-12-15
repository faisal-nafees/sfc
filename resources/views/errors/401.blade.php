<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 Custom Error Page Example</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style type="text/css">
        body {

            margin-top: 150px;

            background-color: #C4CCD9;

        }

        .error-main {

            background-color: #fff;

            box-shadow: 0px 10px 10px -10px #5D6572;

        }

        .error-main h1 {

            font-weight: bold;

            color: #444444;

            font-size: 100px;


        }

        .error-main h6 {

            color: #42494F;

        }

        .error-main p {

            color: #9897A0;

            font-size: 14px;

        }

    </style>
</head>

<body>
    <div class="container">

        <div class="row text-center">

            <div class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-12 p-3 error-main">

                <div class="row">

                    <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1">

                        <h1 class="m-0">401</h1>

                        <h6>Unauthorised</h6>
                    </div>

                </div>

            </div>

        </div>

    </div>
</body>

</html>
