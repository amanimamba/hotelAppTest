<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="anime.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/admi.css">

</head>
<body>
   <!---mon source script---->


    <!---custom cursors-->
    <div class="cursor-1"></div>
    <div class="cursor-2"></div>
    
    <div id="menu-bars" class="fa fa-bars"></div>

<!----header section starts------>

<header>
   <img src="img/go.jpg" alt="" style="width: 30%;height: 15%;margin-top: -60px; border-radius: 150%;box-shadow:5px 5px 5px rgba(0, 0, 0, 0.452);">
  <a href="#" class="logo"> <span>G</span>KM</a>
    <nav class="navbar">
         <a href="/liste_admin"><i class="fas fa-address-card">Admin</i></a>
        <a href="/liste_bible"><i class="fas fa-home">Bible</i></a>
        <a href="/liste_evenementl"><i class="fas fa-newspaper">Evenement</i></a>
        <a href="/liste_news"><i class="fas fa-bible"></i>Annonce</a>
        <a href="/liste_emision"><i class="fas fa-calendar-alt">Emission</i></a>
       
        <a href="/"><i class="fas fa-address-card">Deconnexion</i></a>

</nav>
<div class="follow">
      <a href="#" class="fab fa-facebook-f"></a>
      <a href="#" class="fab fa-twitter"></a>
      <a href="#" class="fab fa-instagram"></a>
      <a href="#" class="fab fa-linkedin"></a>
</div>
</header>
<!---header section enfds-->
<section class="home" id="home">
        <div class="content">
           <section>
            <!-- Button to open the modal -->
        <?=$link_btn?>
                    

            <!-- The Modal (contains the Sign Up form) -->
            <div id="id01" class="modal">
                <form class="modal-content" method="POST" action="<?=$link?>">
                    <div class="container">
                        <h1 style="color: white; font-size: 30px;"><?=$titre?></h1>
                        <?=$formulaire?>
                        <div class="clearfix">
                            
                            <button type="submit" class="btn">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>

            </div>
            </div>
            </div>
        </section>
        </section>
        
<script>

let menu = document.querySelector('#menu-bars');
let header = document.querySelector('header');

menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    header.classList.toggle('active'); 
}


window.onscroll = () =>{
    menu.classList.remove('fa-=times');
    header.classList.remove('active');
}

let cursor1 = document.querySelector('.cursor-1')
let cursor2 = document.querySelector('.cursor-2')

window.onmousemove = (e) =>{
    cursor1.style.top = e.pageY + 'px';
    cursor1.style.left = e.pageX + 'px';
    cursor2.style.top = e.pageY + 'px';
    cursor2.style.left = e.pageX + 'px';
}

document.querySelectorAll('a').forEach(links =>{

links.onmouseenter = () =>{
    cursor1.classList.add('active');
    cursor2.classList.add('active')
}
links.onmouseleave = () =>{
    cursor1.classList.remove('active');
    cursor2.classList.remove('active')
}

});

</script>
 <style>
 #btn-link{
    padding: 12px;
    color: white;
    font-weight: 800;
    font-size: 20px;

 }
            input[type=text],
            input[type=password] {
                width: 100%;
                padding: 15px;
                margin: 5px 0 22px 0;
                display: inline-block;
                border: none;
                background: #f1f1f1;
            }
            /* Add a background color when the inputs get focus */
            
            input[type=text]:focus,
            input[type=password]:focus {
                background-color: #ddd;
                outline: none;
            }
            /* Set a style for all buttons */
            
            button {
                color: rgba(255, 255, 255, 0.898);
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                opacity: 0.9;
            }
            
            button:hover {
                opacity: 1;
            }
            </style>

</body>
</html>