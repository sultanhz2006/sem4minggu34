<?php
session_start();
include 'config.php';

// AUTO LOGIN DARI COOKIE
if(!isset($_SESSION['login']) && isset($_COOKIE['login'])){
    $_SESSION['login'] = true;
    header("location:index.php");
    exit();
}

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $data = $result->fetch_assoc();

        if(password_verify($password,$data['password'])){
            $_SESSION['login'] = true;

            if(isset($_POST['remember'])){
                setcookie("login", $username, time()+86400, "/");
            }

            header("location:index.php");
            exit();
        } else {
            $error = "Password salah!";
        }

    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:"Segoe UI",sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;

background:
radial-gradient(circle at 20% 30%,#1e293b,transparent 40%),
radial-gradient(circle at 80% 70%,#0f172a,transparent 50%),
#020617;

color:white;
}

/* CARD */
.login-box{
width:350px;
padding:30px;

background:rgba(20,20,25,0.6);
backdrop-filter:blur(20px);

border-radius:12px;
border:1px solid rgba(255,255,255,0.08);

box-shadow:0 20px 50px rgba(0,0,0,0.7);
}

/* TITLE */
.login-box h2{
text-align:center;
margin-bottom:20px;
font-weight:500;
}

/* INPUT */
.input-group{
margin-bottom:15px;
}

.input-group label{
font-size:13px;
opacity:0.8;
}

.input-group input{
width:100%;
padding:10px;
margin-top:5px;

border:none;
border-radius:6px;

background:rgba(255,255,255,0.06);
color:white;
}

.input-group input:focus{
outline:none;
background:rgba(255,255,255,0.12);
}

/* REMEMBER TEXT BUTTON */
.remember{
margin:10px 0 15px;
font-size:14px;
cursor:pointer;
color:#aaa;
user-select:none;
transition:0.3s;
}

.remember.active{
color:#22c55e;
font-weight:600;
}

/* BUTTON */
button{
width:100%;
padding:11px;
border:none;
border-radius:6px;

background:#4f46e5;
color:white;

cursor:pointer;
transition:0.2s;
}

button:hover{
background:#6366f1;
}

/* ERROR */
.error{
color:#ef4444;
text-align:center;
margin-bottom:15px;
}

/* FOOTER */
.footer{
margin-top:15px;
text-align:center;
font-size:13px;
}

.footer a{
color:#60a5fa;
text-decoration:none;
}
</style>

</head>

<body>

<div class="login-box">

<h2>Login</h2>

<?php if(isset($error)){ ?>
<p class="error"><?= $error ?></p>
<?php } ?>

<form method="POST">

<div class="input-group">
<label>Username</label>
<input type="text" name="username" required>
</div>

<div class="input-group">
<label>Password</label>
<input type="password" name="password" required>
</div>

<!-- 🔥 REMEMBER TEXT BUTTON -->
<div class="remember" onclick="toggleRemember(this)">
Remember Me
</div>

<input type="hidden" name="remember" id="rememberInput">

<button type="submit" name="login">Login</button>

<div class="footer">
Belum punya akun? <a href="register.php">Daftar</a>
</div>

</form>

</div>

<script>
function toggleRemember(el){
    el.classList.toggle("active");

    let input = document.getElementById("rememberInput");
    input.value = el.classList.contains("active") ? "1" : "";
}
</script>

</body>
</html>