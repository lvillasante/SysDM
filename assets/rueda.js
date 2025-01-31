import $ from "jquery";
import 'bootstrap';
//import 'bootstrap-datepicker';
import moment from 'moment';
import './../node_modules/bootstrap-datetimepicker/src/js/bootstrap-datetimepicker';


/*import './js/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js';
import  './js/daterangepicker/daterangepicker.js';*/

$(document).ready(function () {
  // Get the ul that holds the collection of tags
  //var $tagsCollectionHolder = $('#auspiciadores');
  var $tagsCollectionHolder = $("#horarioevent");
  // count the current form inputs we have (e.g. 2), use that as the new
  // index when inserting a new item (e.g. 2)
  console.log("-->>>", $tagsCollectionHolder);
  $tagsCollectionHolder.data(
    "index",
    $tagsCollectionHolder.find("input").length
  );
  console.log("--->>>22", $tagsCollectionHolder);

  $("body").on("click", ".add_item_link", function (e) {
    var $collectionHolderClass = $(e.currentTarget).data(
      "collectionHolderClass"
    );
    console.log("--->>>>33", $collectionHolderClass);
    // add a new tag form (see next code block)
    addFormToCollection($collectionHolderClass);
  });

  var $tagsCollectionHolderAus = $("#auspiciadores");
  // count the current form inputs we have (e.g. 2), use that as the new
  // index when inserting a new item (e.g. 2)
  console.log("-->>>", $tagsCollectionHolderAus);
  $tagsCollectionHolderAus.data(
    "index",
    $tagsCollectionHolderAus.find("input").length
  );
  console.log("--->>>22", $tagsCollectionHolderAus);

  $("body").on("click", ".add_item_link_aus", function (e) {
    console.log("adicionando aus");
    var $collectionHolderClass = $(e.currentTarget).data(
      "collectionHolderClass"
    );
    console.log("--->>>>33", $collectionHolderClass);
    // add a new tag form (see next code block)
    addFormToCollection($collectionHolderClass);
  });
});
function addFormToCollection($collectionHolderClass) {
  // Get the ul that holds the collection of tags
  // var $collectionHolder = $('.' + $collectionHolderClass);
  var $collectionHolder = $("#" + $collectionHolderClass);

  // Get the data-prototype explained earlier
  var prototype = $collectionHolder.data("prototype");
  console.log("--->>>44", prototype);
  // get the new index
  var index = $collectionHolder.data("index");
  console.log("--->>>5", index);
  var newForm = prototype;
  console.log("newForm", newForm);
  // You need this only if you didn't set 'label' => false in your tags field in TaskType
  // Replace '__name__label__' in the prototype's HTML to
  // instead be a number based on how many items we have
  // newForm = newForm.replace(/__name__label__/g, index);

  // Replace '__name__' in the prototype's HTML to
  // instead be a number based on how many items we have
  newForm = newForm.replace(/__name__/g, index);
  console.log("newForm replaced", newForm);

  // increase the index with one for the next item
  $collectionHolder.data("index", index + 1);
  console.log("---->>>>66", $collectionHolder);

  // Display the form in the page in an li, before the "Add a tag" link li
  // var $newFormLi = $('<li></li>').append(newForm);
  var $newFormLi = $("<tr></tr>").append(newForm);
  // $newFormLi.append('<a href="#" class="remove-tag">x</a>');
  console.log("--->>>777", $newFormLi);
  // Add the new form at the end of the list
  $collectionHolder.find("tbody").append($newFormLi);
  //$collectionHolder.append($newFormLi);
  console.log("-->>>>888", $collectionHolder);
  addTagFormDeleteLink($newFormLi);
}
function addTagFormDeleteLink($tagFormLi) {
  var $removeFormButton = $('<button type="button">Eliminar</button>');
  $tagFormLi.append($removeFormButton);

  $removeFormButton.on("click", function (e) {
    // remove the li for the tag form
    $tagFormLi.remove();
  });
}

$(function () {
  //Initialize Select2 Elements
  //$(".select2").select2();

  //Initialize Select2 Elements
  /*$(".select2bs4").select2({
    theme: "bootstrap4",
  });*/

  //Date range picker
  /*  $("#reservationdate").datetimepicker({
    format: "L",
  });
  $("#reservationdate2").datetimepicker({
    format: "L",
  });
  $("#reservationdate3").datetimepicker({
    format: "L",
  });
  //Date range picker
  $("#reservation").daterangepicker();
  //Date range picker with time picker

  //Date range as a button

  //Timepicker
  $("#timepicker").datetimepicker({
    format: "LT",
  });
  $("#timepicker2").datetimepicker({
    format: "LT",
  });
*/
  
});
$(".datepicker").datetimepicker();
var form = $('#myForm'),
    checkbox = $('#changeShip'),
    chShipBlock = $('#changeShipInputs'),
	checkbox2 = $('#changeShip2'),
    chShipBlock2 = $('#changeShipInputs2'),
	checkbox3 = $('#changeShip3'),
    chShipBlock3 = $('#changeShipInputs3');

chShipBlock.hide();
chShipBlock2.hide();
chShipBlock3.hide();

checkbox.on('click', function() {
    if($(this).is(':checked')) {
      chShipBlock.show();
      chShipBlock.find('input').attr('required', true);
    } else {
      chShipBlock.hide();
      chShipBlock.find('input').attr('required', false);
    }
})
checkbox2.on('click', function() {
    if($(this).is(':checked')) {
      chShipBlock2.show();
      chShipBlock2.find('input').attr('required', true);
    } else {
      chShipBlock2.hide();
      chShipBlock2.find('input').attr('required', false);
    }
})
checkbox3.on('click', function() {
    if($(this).is(':checked')) {
      chShipBlock3.show();
      chShipBlock3.find('input').attr('required', true);
    } else {
      chShipBlock3.hide();
      chShipBlock3.find('input').attr('required', false);
    }
})

$('.custom-file-input').on('change',function(){
  let fileName= $(this).val().replace(/C:\\fakepath\\/i, '');
  $(this).next('.custom-file-label').html(fileName);
});
