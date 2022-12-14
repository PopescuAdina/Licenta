	<?php 
       session_start();
       include 'php/conexiune.php';
	 ?>
	 <html>
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/dashboard.css">  
 
<style>
 *{
    margin: 0;
    padding: 0;
}
body{
    font-family: 'Montserrat', sans-serif;
    background-color: #e3ecf8;
    background-position: top center; 
    background-size: 980px 559px;
	overflow:scroll;
}
.sidebar {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #c2c9d3;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidebar a:hover {
  color: #f1f1f1;
}

.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #c2c9d3;
  color: #000000;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color: #444;
}
.p1 {
  font-family: 'Brush Script MT', cursive;
  align: center;
}

 </style>
</head>
<body>
<div>
    <nav class="navbar navbar-expand-sm navbar-light bg-muted" style="background-color: #c2c9d3;">
        <div class="container-fluid">
            <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">??</a>
            <a href="admindashboard.php">Acasa</a>
            <a href="adaugarecarte">Adaugare carte</a>
            <a href="carti.php">Carti</a>
            <a href="utilizatori.php">Utilizatori</a>
           </div>
           <div id="main">
           <button class="openbtn" onclick="openNav()">???</button>  
		   </div>
          <i class="fa-solid fa-books">DIGIbooks</i>
		  
                <ul class="nav navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Administrator</a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="dropdown-divider"></div>
                            <a href="deconectareadmin.php" class="dropdown-item">Deconectare</a>
                        </div>
                    </li>
                </ul>
        
        </div>
    </nav>    
</div>
	<form method="post" action="adaugarecarte.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>ISBN</th>
				<td><input type="text" name="ISBN" required size="13" required title="ISBN invalid. Format valid:x-xxxx-xxxx-x "></td>
			</tr>
			<tr>
				<th>Titlu</th>
				<td><input type="text" name="titlu" required ></td>
			</tr>
			<tr>
				<th>Autor</th>
				<td><input type="text" name="autor" required pattern="[a-zA-Z'-'\s]*" title="Nume invalid.Acest c??mp accept?? doar litere. "></td>
			</tr>
			<tr>
				<th>Coperta</th>
				<td><input type="file" name="imgcarte" accept="image/png, image/jpg, image/jpeg" required></td>
			</tr>
			<tr>
				<th>Limba</th>
				<td><input type="text" name="Limba" required pattern="[a-zA-Z'-'\s]*" title="Acest c??mp accept?? doar litere."></td>
			</tr>
			<tr>
				<th>Categorie</th>
				<td><input type="text" name="Categorie" required pattern="[a-zA-Z'-'\s]*" title="Acest c??mp accept?? doar litere."></td>
			</tr>
			<tr>
				<th>Descriere</th>
				<td><textarea name="descriere" cols="40" rows="5"></textarea></td>
			</tr>
			
			<tr>
				<th>Continut</th>
				<td><input type="file" name="continut" accept=".pdf " required></td>
			</tr>
		</table>
		<input type="submit" name="submit" value="Adaugare carte" class="btn btn-primary">
		<input type="reset" value="Stergere" class="btn btn-default">
	</form>

 <?php
 
            if (isset($_POST["submit"])) {

                $image_name=$_FILES['imgcarte']['name'];
                $file_name=$_FILES['continut']['name'];
                $temp = explode(".", $image_name);
                $temp2 = explode(".", $file_name);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                $newfilename2 = round(microtime(true)) . '.' . end($temp2);
                $imagepath="/licenta/img/".$newfilename;
                $filepath="/licenta/carte/".$newfilename2;
				$_SERVER["DOCUMENT_ROOT"]="C:/xampp/htdocs/licenta/";
                 $imagelocation=$_SERVER["DOCUMENT_ROOT"]."/img/".$newfilename;
                 $filelocation=$_SERVER["DOCUMENT_ROOT"]."/carte/".$newfilename2;
                move_uploaded_file($_FILES["imgcarte"]["tmp_name"],$imagelocation);
                move_uploaded_file($_FILES["continut"]["tmp_name"],$filelocation);
				mysqli_query($link, "insert into carti values('$_POST[ISBN]','$_POST[titlu]','$_POST[autor]','$imagepath','$_POST[Limba]','$_POST[Categorie]','$_POST[descriere]','$filepath')");
                
				mysqli_commit($link);
				
				 
            }
			
        ?>

			
           
        
<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
</body>
</html>
