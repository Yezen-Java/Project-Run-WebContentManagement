$(document).ready(function(){
    $("#addTour").click(function(){
        $("#createTourDialogue").modal('show');
    });

    $("#menu-toggle").click(function(e) {
      console.log("button");
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
});

// $("#file-manager").click(function(){
//         $("#file_manager_dialogue").modal('show');
//     });


$("#pointer1").click(function(){
  $("#myModal").modal('show');
  $('.sortable').sortable();
});


function compare (a,b){
  if(a.order < b.order)
    return -1;
  else if (a.order > b.order)
    return 1;
  else
    return 0;
}

function reorder(){
  files.sort(compare);
  console.table(files);

  for (var i = 0; i < files.length;i++){
    console.log(files[i].name);
    $("#myModal ul").append("<li>" +files[i].name);
  }
}


function Save(){

var array = [];
$('.sortable li').each(function(i, li) {
  array.push($(li));
});
for (var i = 0; i < array.length; i++) {
  console.log(array[i].text() + i);
};

}


if(window.File && window.FileReader && window.FileList && window.Blob){
  alert('The file API works on this browser.')
}else{
  alert('The File API is is not fully supported in this browser.')
}

function myFunction() {
  document.getElementById('notesArea').placeholder= Date();
}

function deleteTourLi(value){
  $(value).remove();
}

function addNoteFunc(){
    myFunction();
    ul = $('#sideBar');
    ul.find('li:first').clone(true).appendTo(ul);
}

function randomStringGenerator() {
  var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZ";
  var string_length = 6;
  var randomstring = '';
  for (var i=0; i<string_length; i++) {
    var rnum = Math.floor(Math.random() * chars.length);
    randomstring += chars.substring(rnum,rnum+1);
  }
  document.getElementById("randomfield").value = randomstring;
}

var TourCodeSelected ="";

function w3_open(value) {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
      var TourIdCode=value;
      TourCodeSelected = value;

      $(function() {
      var value1 = $('#tourButton').val();
       $.post('database/GetTourLocations.php',{value:TourIdCode}, function(data){
         $("#pointersDiv").html(data);
       });
       return false;
  });
}

function w3_close() {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
}

function createInput(){
  ul = $('#buttonsListTours');
  ul.find('li:first').clone(true).appendTo(ul);
}

function createTour(tourNameVar){
    var $input = $("<button type="+"button"+" class="+"list-group-item"+" id="+"tourOne"+" onclick="+"w3_open()"+">"+tourNameVar+"</button>");
    toursArray.push($input);
    $input.appendTo($("#buttonsListTours"));
}

/* createTourDialogueButton onclick method,
we should take the values inserted into the three text area's 
and append this value i.e. tour name to the tourOne button text*/

function createTourDetails(){
  var tourName = document.getElementById("tourNameField").value;
  //var tourFloor = document.getElementById("tourLevelField").value;
  //var tourName = document.getElementById("tourDateField").value;
  createTour(tourName);
}
//this function open the file model for specific locations.
function addLocationRes(value) {
  $("#myModal ul").empty();
  console.log("works");
  reorder();
  $("#myModal").modal();
  $('.sortable').sortable();
}


function addLocations(){
var  selectedTourId = TourCodeSelected;
var selectList = $('#selectLocation').val();
var skillsSelect = document.getElementById("selectLocation");
var selectedText = skillsSelect.options[skillsSelect.selectedIndex].text;

      console.log(selectedTourId);
      console.log(selectList);
      console.log(selectedText);

 $(function() {
       $.post('database/addLocationScript.php',{TourID:selectedTourId,LocationID:selectList}, function(data){
        alert(data);
        var addLocationsHtml = $("<a id="+selectedTourId+">"+selectedText+"</a>");
      $("#pointersDiv").append(addLocationsHtml);
       });
       return false;
  });


}

$(function(){
  
  var check = false;

  $("#deleteCheckedItems").click(function(){
    var Arrayofvlaues = new Array();;
    var array = getCheckedBoxes();
    if (check == false){
      $(".displayCheckBoxSpan").show("slow");
      check = true;
    }else if (check == true && array.length == 0){
      $(".displayCheckBoxSpan").hide("slow");
      check = false;
    } else {
      var stringBuldier ="45";
      for (var i = 0; i < array.length; i++) {
        Arrayofvlaues.push(array[i].value);

      };
      console.log(stringBuldier);
      console.log(Arrayofvlaues);

 // $.post('database/DeleteMedia.php',{Array:stringBuldier}, function(data){
 //        alert(data);
       
 //       });

     
//     $.ajax({
// url: "DeleteMedia.php",
// type: "POST",
// data: false,
// contentType: false,
// cache: false,
// processData:false,
// success: function(data){

// alert(data);

// },
// error: function(){}           
// });

    }
  });
});

function deleteLocationFromTour(){

}


function deleteLocationFromManager(){

}


// function deleteMediaFromManager(value){

//   var selected = new Array();

//   $("input:checkbox[name=type]:checked").each(function() {
//        selected.push($(this).val());
//   });

// }

function getCheckedBoxes() {
  var checkboxes = document.getElementsByName("checkboxmedia[]");
  var checkboxesChecked = [];
  // loop over them all
  for (var i=0; i<checkboxes.length; i++) {
     // And stick the checked ones onto an array...
     if (checkboxes[i].checked) {
        checkboxesChecked.push(checkboxes[i]);
     }
  }
  // Return the array if it is non-empty, or null
  return checkboxesChecked.length > 0 ? checkboxesChecked : null;
}


$(document).ready(function (e){
$("#uploadForm").on('submit',(function(e){
  e.preventDefault();
$.ajax({
url: "UploadScript.php",
type: "POST",
data: new FormData(this),
contentType: false,
cache: false,
processData:false,
success: function(data){

  $('#modalc').append(data);
},
error: function(){}           
});
}));
});


$(document).ready(function (e){
$("#deleteImage").on('submit',(function(e){
  e.preventDefault();
$.ajax({
url: "DeleteMedia.php",
type: "POST",
data: new FormData(this),
contentType: false,
cache: false,
processData:false,
success: function(data){

  $('#modalc').append(data);
},
error: function(){}           
});
}));
});






     
