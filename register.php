<?php
include 'config.php';

if(isset($_POST['daftar'])){

    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    // VALIDASI
    if(empty($username) || empty($password)){
        $error = "Semua field wajib diisi!";
    } elseif($password !== $confirm){
        $error = "Konfirmasi password tidak sama!";
    } else {

        // CEK USERNAME
        $cek = $conn->prepare("SELECT * FROM users WHERE username=?");
        $cek->bind_param("s",$username);
        $cek->execute();
        $result = $cek->get_result();

        if($result->num_rows > 0){
            $error = "Username sudah digunakan!";
        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username,password) VALUES (?,?)");
            $stmt->bind_param("ss",$username,$hash);

            if($stmt->execute()){
                $success = "Akun berhasil dibuat!";
            } else {
                $error = "Terjadi kesalahan!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>

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
.box{
width:360px;
padding:30px;

background:rgba(20,20,25,0.6);
backdrop-filter:blur(20px);

border-radius:12px;
border:1px solid rgba(255,255,255,0.08);

box-shadow:0 20px 50px rgba(0,0,0,0.7);
}

/* TITLE */
.box h2{
text-align:center;
margin-bottom:20px;
font-weight:500;
}

/* INPUT */
.group{
margin-bottom:15px;
}

.group label{
font-size:13px;
opacity:0.8;
}

.group input{
width:100%;
padding:10px;
margin-top:5px;

border:none;
border-radius:6px;

background:rgba(255,255,255,0.06);
color:white;
}

.group input:focus{
outline:none;
background:rgba(255,255,255,0.12);
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

/* MESSAGE */
.error{
color:#ef4444;
text-align:center;
margin-bottom:12px;
}

.success{
color:#22c55e;
text-align:center;
margin-bottom:12px;
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

<div class="box">

<h2>Buat Akun</h2>

<?php if(isset($error)){ ?>
<p class="error"><?= $error ?></p>
<?php } ?>

<?php if(isset($success)){ ?>
<p class="success"><?= $success ?></p>
<?php } ?>

<form method="POST">

<div class="group">
<label>Username</label>
<input type="text" name="username" required>
</div>

<div class="group">
<label>Password</label>
<input type="password" name="password" required>
</div>

<div class="group">
<label>Konfirmasi Password</label>
<input type="password" name="confirm" required>
</div>

<button type="submit" name="daftar">Daftar</button>

<div class="footer">
Sudah punya akun? <a href="login.php">Login</a>
</div>

</form>

</div>

</body>
</html>