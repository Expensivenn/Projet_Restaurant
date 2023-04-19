$(document).ready(function(){
  //ajax image ingredient
  //$('#submit').remove();
  $('#choix_ingredient').change(function (){
    let id_ingredient = $(this).val();
    let parametre = "id_ingredient="+id_ingredient;
    let retour = $.ajax({
      type: 'GET',
      data: parametre,
      dataType:'json',
      url:'./admin/lib/php/ajax/ajaxGetIngredient.php',
      success:function(data){
        console.log(data[0]);
        $('#description_ingredient').show();
        //$('#image_fleur').html('<img src="./admin/images/'+data[0].image_fleur+'" alt="aaa">')
        $('#image_ingredient').text("Nom : "+data[0].nom_ingredient);
      }

    });
    console.log(parametre);

  });


  $('#vie').hide();
  $('#para1').hide();
  $('#deuxieme').hide();
  $('#troisieme').hide();
  $('#quatrieme').hide();
  $('#cinquieme').hide();
  $('#cacher').hide();
  $('#montrer_image').hide();
  $('#nom').click(function() {
    // Changer la couleur du texte en rouge
    $(this).css('color', 'red');

    // Afficher ou masquer la bio
    $('#vie').toggle();
  });
  $('#vie').mouseover(function() {
    // Mettre la bio en gras et en italique, et la colorer en bleu
    $(this).css({
      'font-weight': 'bold',
      'font-style': 'italic',
      'color': 'blue'
    });
  }).mouseout(function() {
    // Remettre la bio à son état initial
    $(this).css({
      'font-weight': 'normal',
      'font-style': 'normal',
      'color': 'black'

    });
    $('#para1').toggle();
  });
  $('#para1').click(function (){
    $('#deuxieme').slideDown(2000);
  });
  $('#para2').click(function (){
    $('#troisieme').fadeIn(2000);
  });
  $('#para3').click(function (){
    $('#quatrieme').slideDown(2000);
    $('#cinquieme').slideDown(2000);
    $('#cacher').slideDown(2000);
  });
  $('#cacher').click(function (){
    $('#montrer_image').slideDown(2000);
  });
});