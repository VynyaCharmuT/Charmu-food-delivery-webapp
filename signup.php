<!DOCTYPE html>
<html>

<head>

    <title>Signup</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>Create Account</h3>
                </div>

                <div class="card-body">

                    <form action="api/signup.php" method="POST">

                        <input type="text"
                               name="name"
                               class="form-control mb-3"
                               placeholder="Full Name"
                               required>

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

                        <select name="role" class="form-control mb-3">

                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="delivery">Delivery Agent</option>

                        </select>

                        <button class="btn btn-primary w-100">
                            Signup
                        </button>

                    </form>

                    <div class="text-center mt-3">
                        Already have an account?
                        <a href="login.php">Login</a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>