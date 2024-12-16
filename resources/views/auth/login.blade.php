<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/B.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Jost', sans-serif;
            background: linear-gradient(to bottom, rgb(41, 12, 12), rgb(99, 43, 43), rgb(62, 36, 36));
            overflow: hidden;
        }

        .main {
            width: 550px;
            height: 500px;
            background: red;
            overflow: hidden;
            background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover;
            border-radius: 10px;
            box-shadow: 5px 20px 50px #000;
        }

        #chk {
            display: none;
        }

        .signup {
            position: relative;
            width: 100%;
            height: 100%;
        }

        label {
            color: #fff;
            font-size: 2.3em;
            justify-content: center;
            display: flex;
            margin: 50px;
            font-weight: bold;
            cursor: pointer;
            transition: .5s ease-in-out;
        }

        input {
            width: 60%;
            height: 10px;
            background: #e0dede;
            justify-content: center;
            display: flex;
            margin: 20px auto;
            padding: 12px;
            border: none;
            outline: none;
            border-radius: 25px;
        }

        button {
            width: 64%;
            height: 40px;
            margin: 10px auto;
            justify-content: center;
            display: block;
            color: #fff;
            background: rgb(138, 59, 59);
            font-size: 1em;
            font-weight: bold;
            margin-top: 10px;
            outline: none;
            border: none;
            border-radius: 25px;
            transition: .2s ease-in;
            cursor: pointer;
        }

        button:hover {
            background: rgb(184, 68, 68);
        }

        .login {
            height: 460px;
            background: #eee;
            border-radius: 60% / 10%;
            transform: translateY(-180px);
            transition: .8s ease-in-out;
        }

        .login label {
            color: rgb(138, 59, 59);
            transform: scale(.6);
        }

        #chk:checked~.login {
            transform: translateY(-500px);
        }

        #chk:checked~.login label {
            transform: scale(1);
        }

        #chk:checked~.signup label {
            transform: scale(.6);
        }

        .back-home-link {
            margin-left: 110px;
            margin-top: 15px;
        }

        .back-home-link a {
            color: rgb(253, 206, 0);
            text-decoration: none;
            font-family: 'Jost', sans-serif;
        }

        .back-home-link a:hover {
            color: rgb(166, 161, 139);
        }

        .no-account-link {
            color: #fff;
            font-size: 0.9em;
            text-align: left;
            display: block;
            margin-left: 20%;
            margin-top: -10px;
            margin-bottom: 0px;
            cursor: pointer;
        }

        .logo-container {
            margin-bottom: 20px;
            /* Tambahkan jarak dengan main */
            text-align: center;
            /* Pastikan logo berada di tengah */
        }

        .logo-bfashion {
            max-width: 300px;
            width: 100%;
            height: auto;
        }

        @media (max-width: 768px) {
            body {
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                min-height: 100vh;
                font-family: 'Jost', sans-serif;
                background: linear-gradient(to bottom, rgb(41, 12, 12), rgb(99, 43, 43), rgb(62, 36, 36));
                overflow: hidden;
            }

            .main {
                width: 90%;
                height: 685px;
                background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center / cover;
                border-radius: 10px;
                box-shadow: 5px 20px 50px #000;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .logo-container {
                display: none;
            }

            #chk:checked~.login {
                transform: translateY(-650px);
            }

            .login {
                height: 660px;
                background: #eee;
                border-radius: 60% / 10%;
                transform: translateY(-180px);
                transition: .8s ease-in-out;
            }
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <img src="{{asset('img/logo.png')}}" alt="Logo" class="logo-bfashion">
    </div>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true" @if(session('error')) checked @endif>
        <!-- Sign up form -->
        <div class="signup">
            <script>
                @if ($errors->has('username'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Email is already!',
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                @endif
                @if ($errors->has('name'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Please enter a name without symbols!',
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                @endif
            </script>
            <form method="POST" action="{{ route('user.storeregister') }}">
                @csrf
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    placeholder="JhonDoe" value="{{ old('name') }}" required>
                <input type="email" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" placeholder="JhonDoe@example.com" value="{{ old('username') }}" required>
                <input type="text" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="passwordJhonDoe123" value="{{ old('password') }}" required>
                <input type="hidden" name="role" value="user">
                <div class="back-home-link">
                    <p><a href="{{ route('landing.index') }}">Back to Home?</a></p>
                </div>
                <button type="submit">Sign up</button>
            </form>
        </div>
        <!-- Login form -->
        <div class="login">
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        text: '{{ session('success') }}',
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000
                    });
                </script>
            @endif

            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        text: '{{ session('error') }}',
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 5000
                    });
                </script>
            @endif
            <form method="POST" action="{{ route('login') }}" class="form-mobile">
                @csrf
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" class="form-control" id="username" name="username" placeholder="JhonDoe@example.com"
                    required>
                <input type="password" class="form-control" id="password" name="password" placeholder="example123"
                    required>
                <label class="no-account-link" for="chk">Don't have an account?</label>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

</body>


</html>