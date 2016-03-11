<?php

error_reporting(E_ALL & ~E_NOTICE);
session_start();

if(isset($_SESSION['id'])){
    $userId= $_SESSION['id'];
    $username= $_SESSION['username'];
    echo "Please Wait ...";
}else{
    header('location: login.php');
    die();
}

include 'database/Connect.php';
include 'database/LoadDataOnstart.php';

?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
   

    <!--CSS LINK-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
    <!--JS LINK-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
   
    <!--QUnit testing LINK-->
    <link rel="stylesheet" href="https://code.jquery.com/qunit/qunit-1.22.0.css">
    <script src="//code.jquery.com/qunit/qunit-1.14.0.js"></script>
    
    <script src="jquery.sortable.js"></script>
    <script src="js/CreateTour.js"></script>
    <script src="tests.js"></script>
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="myJquery.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript">

    </script>

</head>

<body onload="myFunction()">

<!--The main Rapper that keeps the left nav bar, middle list of tours and right notes nav bar-->
<div id="wrapperLeft"> 

      <!--Below we have the left nav bar, this nav bar will contain the pointers the user creates for each
      tour, so when the user clicks a tour from the middle list, this left nav bar should appear with the
      tour pointer items, when the user clicks Delete or Add, the last item should disappear or a new item
      should be added to the end, currently we have only one item called "Link 1"-->
      <div id="leftBar">
        <nav class="w3-sidenav w3-white w3-card-2" style="display:none" id="leftBarId">
          <a href="javascript:void(0)" onclick="w3_close()" class="w3-closenav w3-large">Close &times;</a>
         <div>
         <?php GetLocationQuery();?>
          </div>
          <div id="pointersDiv">Locations</div>
          <div class="btn-group" role="group" aria-label="Basic example" id="buttonGroupPointer">
            <button id="addPointer" type="button" class="btn btn-success" onclick="addLocations()"><strong>Add</strong></button>
          </div>    
        </nav>
      </div>
      <!--Below we have a list-group which includes pre-made tours, we must add functionality to the Add 
      tour button so that when we click the button, a function should add a new button to the end of the
      list group-->
      <div id="middleContainer" class="container">
        <div class="list-group" id="tourList">
            <ul id="buttonsListTours">  
        <?php
             getTourList();
          ?>
          </ul>
          </div>
        
        
        <div class="btn-group" role="group" aria-label="Basic example" id="tourButtonGroup">
          <button id="deleteTour" type="button" class="btn btn-danger"><strong>Delete</strong></button>
          <button id="addTour" type="button" class="btn btn-success"><strong>Add</strong></button>
        </div>
            </div>

    <!--Below we have the notes nav bar wrapped, here we should be able to add new notes, delete notes and
    so forth.-->
    
    <div id="wrapper">
        <div id="sidebar-wrapper">
          <ul class="sidebar-nav" id="sideBar">  
                <li class="sidebar-brand" style="padding-top:10px;">
                  <div id="container">
                    <form name="form1" method="post" action="">
                      <input type="text" name="toDoTextArea" id="toDoTextArea" autofocus>
                      <button type="button" class="btn-success" name="addBtn" id="addBtn" autofocus>Add</button>
                    </form>
                    <ul id="myList" class="sortable list"></ul>
                    <button class="btn btn-danger" id="btnClear"><a id="clearAll" href="javascript:void();">Delete All</a></button>
                  </div>
                </li>
          </ul>
        </div>
    </div>
</div>

<div class="container">
  <nav class="navbar navbar-default navbar-fixed-top" id="topNavbarDefault">
    <div class="container">
      <div class="navbar-header" id="topNavbar">
      	<div class=".col-md-9" id="topNavbarContainer">
        	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          		<span class="sr-only">Toggle navigation</span>
          		<span class="icon-bar"></span>
          		<span class="icon-bar"></span>
          		<span class="icon-bar"></span>
        	</button>
      	</div>
      	<div class=".col-md-3" id="bottomNavbarContainer">
      		<a class="navbar-brand"><strong>Hive</strong> Dashboard</a> 
      	</div>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="#" id="menu-toggle">Note</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Manager<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#locationManagerModel" data-toggle="modal">Edit Locations</a></li>
            </ul>
          </li>
          <li><a href="#file_manager_dialogue" id="file-manager" data-toggle="modal">File Manager</a></li>
          <li><a href="#" id="generateCode" onclick="randomStringGenerator();">Generate Code</a></li>
          <li id="codeGenerateCssLi"><input type="text" class="form-control" placeholder="Code" id="randomfield" readonly="readonly"></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
  </div>

  <!--Create tour dialogue box-->
  <div class="modal fade" id="createTourDialogue" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Tour</h4>
        </div>

        <div class="modal-body" id="tourTextFields">
          <input type="text" class="form-control" id="tourNameField" placeholder="Name of tour" value="" >
          <input type="text" class="form-control" id="tourDateField" placeholder="Date">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="createTourDetails();" 
          id="createTourDialogueButton" >Create</button>
        </div>
      </div>
    </div>
  </div>
  <!--Create tour dialogue box-->

  
  <div class="modal fade" id="file_manager_dialogue" role="dialog">
    <div class="modal-dialog" id="fileContent">
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">File Manager</h4>
        </div>
<form id="deleteImage" method="post">
        <div id= "fileManagerDiv" class="modal-body">
            <div class = "list-group" id="modalc">
        <?php  
           mediaResultsFucntion();
        ?>
        </div>
          </div>
<input type="submit" class="btn btn-warning" id="deleteCheckedItems" value"Delete"/>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</form>
        <div class="modal-footer">
        <form id = 'uploadForm' action="" method="post" enctype="multipart/form-data">
<div style='margin:10px'><input type='file'  name='file[]' multiple=""/> <input type ='submit' value='Upload Image'/>
</div>
</form>
        
        </div>
      </div>
    </div>
  </div> 
  <!--File manager dialogue box-->

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
          <?php
          MediaSelectFucntion();
          ?>
        </div>
    	<div class="modal-body">
			<h1>Upload Files</h1>
        	<ul id ="listMedia" class="sortable">
        	</ul>
    	</div>
        <div class="modal-footer">

          <button type ="button" class="btn btn-default" onclick = "function_name()">Save</button>
          <button type ="button" class="btn btn-default" onclick = "DeleteCircle()">Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<div class="modal fade" id="locationManagerModel" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Locations</h4>
        </div>
      <div class="modal-body">
      <h1>Edit Locations</h1>
      <?php 
      getLocationList();
          ?>
 
      </div>
        <div class="modal-footer">
          <button type ="button" class="btn btn-default" onclick = "DeleteCircle()">Delete All</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>



  <!--QUnit test results are displayed here!-->
  	<div id="qunit"></div>
    <div id="qunit-fixture"></div>
</body>
</html>