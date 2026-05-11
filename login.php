<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>Login</h3>
                </div>

                <div class="card-body">

                    <form action="api/login.php" method="POST">

                        <input type="email"
                               name="email"
                               class="form-control mb-3"
                               placeholder="Email"
                               required>

                        <input type="password"
                               name="password"
                               class="form-control mb-3"
                               placeholder="Password"
                               required>

                        <button class="btn btn-success w-100">
                            Login
                        </button>

                    </form>

                    <div class="text-center mt-3">
                        Don't have an account?
                        <a href="signup.php">Signup</a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>