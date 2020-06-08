<?php
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="js/frontend.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/frontend.css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <title></title>
  </head>

  <body id="template1">
    <iframe id="iFrame" src="" frameborder="0" style="    height: 100%;
    display:none;
    width: 100%;
    position: absolute;
    z-index: 99999;">


    </iframe>
  <div class="btnwrapper">
    <div class="frontWrappers">
    <img src="./img/senator.png" class="mb-5" alt="">
  <!-- <a id="derlink" href="https://www.senator.com" onclick="changeLink();" target="_blank"> -->
  <button id="weiter" style="display: block!important">Falls Sie nicht zu <span id="dieUrl"></span> weitergeleitet werden, klicken sie bitte hier</button>
<!-- </a> --></div>
  <!-- <span id="url">Sie werden zu <span id="wo"></span> weitergeleitet.</span> -->
</div>
  <div class="overlay"></div>
  <div id="processing" class="fullBlank">    
      <!-- <div class="classProcessingInner">  -->
          <div class="lds-roller lds-roller-pos"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
      <!-- </div>  -->
  </div>


 <!---------------------LOGIN---------------------------------->


    <div class="classLoginMenu">         
          <a href="login.php"><i class="fas fa-unlock-alt"></i>&nbsp;Login</a>   
    </div>

    <div class="container">

<!--------------------------LOGO------------------->

      <div class="row ">
        <div class="col">
           <div class="classImageWrapper">
              <img id="logo" src="" alt="">
            
             </div>
         </div>    
      </div>
  <hr>

<!--------------KONTAKTDATEN---------------------------->

      <div class="row classRowP">
        <div class="col-sm">
           <div id="firma" class="classKontakt"></div>
         </div>   

         <div class="col-sm">
           <div id="name" class="classKontakt"></div>
         </div>      
       
  
      <div class="classOrtWrapper">

        <div class="col-sm">
           <div id="strasse" class="classKontakt"></div>
         </div>
         <div class="col-sm">
           <div id="ort" class="classKontakt"></div>
         </div>
          <div class="col-sm">
           <div id="land" class="classKontakt"></div>
         </div>

       </div>


      <div class="classPhoneWrapper">

        <div class="col-sm">
           <div id="tel" class="classKontakt"></div>
         </div>
         <div class="col-sm">
           <div class="classKontakt"><a id="mail" href=""></a></div>
         </div>
         

       </div>
      
      <div class="col-sm">
      <a href="vcf/data.vcf"><button class="classFrontBtn">Kontakt speichern</button></a>
      </div>
</div>

 <hr>

 <!---------------------FIELDS---------------------------------->
      
    <div id="boxField" class="classWrapper">


 <!---------------------TITEL---------------------------------->


        <div class="row classRowP classRowMbottom">
        <div id="title" class="col-sm-4 classTextTitle classTextTitleMain">
        </div>
      </div>

      </div>
  </div>
  <!-- Footer -->
  <footer class="page-footer font-small unique-color-dark pt-4 fixed-bottom">
      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2019 Copyright:
        <a href="https://www.sabocon.com"> sabocon.com</a>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- echo '<script type="text/javascript">
    window.addEventListener('load', function () {
    let URL = document.getElementById("boxField");
    // let URLNeu = Array.from(document.getElementsByTagName("a"))[3].innerHTML;
    let URLnu = Array.from(URL.children)[1];
    let URL2 = document.getElementsByClassName("size");
    let final = URL2[0].innerText;
      console.log(final)
      window.open(final,"_self")

    });
    </script>'; -->
  </body>
  <script src="js/link.js"></script>
</html>

<?php
