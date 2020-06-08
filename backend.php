<?php
// Sicherheit -----------------------------------------------------------------
session_name("NFC");
session_start();
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
    // session_gc();(PHP 7 >= 7.1.0)
    session_destroy();
    exit;
}
// ----------------------------------------------------------------------------
?>
<!doctype html>
<html lang="de">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/backend.css">
    <link rel="stylesheet" href="css/mobile.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a7b6339581.js"></script>


    <title>Setup!</title>
    <!-- JavaScript -->
    <script src="js/backend.min.js"></script>
  </head>

  <body id="backendBody">

    <div id="processing" class="fullBlank">    
        <!-- <div class="classProcessingInner">  -->
            <div class="lds-roller lds-roller-pos"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        <!-- </div>  -->
    </div>


        <!----------------------------------------NAV---------->
    <nav class="navbar navbar-dark fixed-top bg-light flex-md-nowrap p-0" style="background: white!important;">

          <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="./index.php"><img src="img/senator.png" alt="">  </a>
           <ul class="navbar-nav px-3">        
            <li class="nav-item text-nowrap">
              <a id="openStammDatenBtn" class="nav-link" href="#">Stammdaten bearbeiten</a>
            </li>
          </ul>

          <ul class="navbar-nav px-3">        
            <li class="nav-item text-nowrap">
              <a id="signOutBtn" class="nav-link" href="#">Sign out</a>
            </li>
          </ul>

    </nav>

<!-----------------STAMMDATEN POPUP, soll Display: none sein, bei Click auf "Stammdaten bearbeiten" dann Display:block. Soll verschwinden bei Click ausserhalb des Containers---------->
    <div id="stammDatenDialogClickAway" class="stammDatenDialogClickAway">
                    
        <div id="stammDatenDialog" class="classStammDatenContainer">

            <div class="classUserWrapper">

                <div class="row m-bottom05">

                    <div class="col-sm">
                        Username
                    </div>

                    <div class="col-sm">
                        <input id="userName" type="text" value="">   
                    </div>

                </div>

                <div class="row m-bottom05">

                    <div class="col-sm">
                        Passwort
                    </div>

                    <div class="col-sm">
                        <button id="changeUserPwBtn">Passwort ändern</button>   
                    </div>

                </div>

                <!-----Passwort ändern---->
                <div id="pwDialog" class="classPasswordWrapper">

                    <div class="row m-bottom05">

                        <div class="col-sm">
                            Altes Passwort
                        </div>

                        <div class="col-sm">
                            <input id="oldPw" type="password">   
                        </div>

                    </div>

                    <div class="row m-bottom05">

                        <div class="col-sm">
                            Neues Passwort
                        </div>

                        <div class="col-sm">
                            <input id="newPw" type="password">   
                        </div>

                    </div>

                    <div class="row m-bottom05">

                        <div class="col-sm">
                            Neues Passwort wiederholen
                        </div>

                        <div class="col-sm">
                            <input id="newConfirmPw" type="password">   
                        </div>

                    </div>

                </div>

                <!-----Passwort ändern----> 
                <div class="row m-bottom05">

                    <div class="col-sm">
                        Email
                    </div>

                    <div class="col-sm">
                        <input id="userMail" type="text" value="">   
                    </div>
                    
                </div>
            </div>

            <button id="saveStammDatenBtn" class="classSave2 mt-4">Speichern</button>

            <div class="error error_msg">   
                <p>Bitte füllen Sie die markierten Felder aus</p>   <!---Error Message Box -->
            </div>

        </div>
    </div>
<!-----------------STAMMDATEN POPUP ENDE ------------------------------>

    <div class="container-fluid">

        <div class="row">

            <nav class="sidebar d-md-block">         
                
            <div class="sidebar-sticky">


                <div id="textAddBtn" class="classMainWrapper">
                    <div id="textBtnBorder" data-type="1" class="classMainBtn"><i class="fas fa-align-justify"></i> &nbsp;<p>Text <span class="add">hinzufügen</span></p></div>
                    <div id="urlBtnBorder" data-type="2" class="classMainBtn"><i class="fab fa-internet-explorer"></i> &nbsp;<p>URL <span class="add">hinzufügen</span></p></div>
                    <div id="phoneBtnBorder" data-type="3" class="classMainBtn"><i class="fas fa-mobile-alt"></i> &nbsp;<p>Telefonnr.<span class="add"> hinzufügen</span></p></div>
                    <div id="emailBtnBorder" data-type="4" class="classMainBtn"><i class="fas fa-envelope"></i> &nbsp;<p>Email<span class="add"> hinzufügen</span></p></div>
                    <div id="dateiBtnBorder" data-type="5" class="classMainBtn"><i class="fas fa-file"></i> &nbsp;<p>Datei<span class="add"> hinzufügen</span></p></div>

                </div> 

            </div>
           
          </nav>


            <main role="main" class="col-md-12 ml-sm-auto col-lg-12 classMarginTop5em classPL5">

                    <div class="row d-flex justify-content-center">
                        <!---Fields -->
                        <div id="boxField" class="col-md-12 col-xl-6">
                            <div id="platzhalter" class="classDefaultField">
                                <p>...</p>
                            </div>
                            <!---Boxes -->
                        </div>

                        <div class="clearfix"></div>

<!---------------------------------------------------------RIGHT SIDBAR -->

                        <div class="col-md-5 classBg ">

<!---------------------------------------------------------LOGO UPLOAD -->

                            <div class="classWrapper">

                                <div class="classLogoUpload">
                                    <div class="col-ms">
                                        <h2 class="mbottom05">Titel der Seite</h2>
                                         <input id="title" type="text" value="" size="">            
                                        <hr>
                                    </div>
                                    <div class="col-ms">
                                             <h2 class="mbottom05">Logo hochladen</h2>
                                                <label class="btn btn-default classBrowseBtn">
                                                Datei auswählen <input id="logoInputFile" class="inputfield" type="file" hidden>
                                                </label>
                                          <img id="logo" src="" alt="" height="75">
                                    </div>
                                </div>
<!---------------------------------------------------------KONTAKTDATEN -->
                                <hr>

                                <h2 class="classh2">Kontaktdaten</h2>
                                <div class="col-sm">Firma</div>
                                <div class="col-sm">
                                          <input id="kontaktFirma" type="text" class="inputfield" value="">
                                </div>

                                <div class="col-sm">Name</div>
                                <div class="col-sm">
                                          <input id="kontaktName" type="text" class="inputfield" value="">
                                </div>

                                <div class="col-sm">Straße</div>
                                <div class="col-sm">
                                          <input id="kontaktStrasse" type="text" class="inputfield" value="">
                                </div>

                                <div class="col-sm">PLZ</div>
                                <div class="col-sm">
                                          <input id="kontaktPlz" type="text" class="inputfield" value="">
                                </div>

                                <div class="col-sm">Ort</div>
                                <div class="col-sm">
                                          <input id="kontaktOrt" type="text" class="inputfield" value="">
                                </div>

                                <div class="col-sm">Land</div>
                                <div class="col-sm">
                                          <input id="kontaktLand" type="text" class="inputfield" value="">
                                </div>

                                 <div class="col-sm">Telefon</div>
                                <div class="col-sm">
                                          <input id="kontaktTelefon" type="text" class="inputfield" value="">
                                </div>
                                
                                <div class="col-sm">Email</div>
                                <div class="col-sm">
                                          <input id="kontaktEmail" type="text" class="inputfield" value="">
                                </div>

                                 <div class="col-sm">Website</div>
                                <div class="col-sm">
                                          <input id="kontaktWebsite" type="text" class="inputfield" value="">
                                </div>

                            </div>

                        </div>
                    </div>
<!---------------------------------------------------------SAVE Button -->
                            <div class="row d-flex justify-content-center">
                                <div class="container"> 
                                    <div class="row">
                                <div class="col-12 d-flex justify-content-center"><button id="saveBtn" class="classSave">Speichern</button> </div>
                                <!-- <div class="col-1"> -->
                                </div>
                            </div>
                    </div>          </div></div>
            </main> 
        </div>
    </div>
    </body>
</html>


<?php
