$(document).ready(function() {
  //ajax image ingredient
  $('#submitIg').remove();


  $('#choix_ingredient').change(function () {
    let id_ingredient = $(this).val();
    let parametre = "id_ingredient=" + id_ingredient;
    let retour = $.ajax({
      type: 'GET',
      data: parametre,
      dataType: 'json',
      url: './admin/lib/php/ajax/ajaxGetIngredient.php',
      success: function (data) {
        console.log(data[0]);
        $('#description_ingredient').show();
        //$('#image_fleur').html('<img src="./admin/images/'+data[0].image_fleur+'" alt="aaa">')
        $('#image_ingredient').text("Nom : " + data[0].nom_ingredient);
      }

    });
    console.log(parametre);

  });
  $("td[id]").click(function () {
    let valeur1 = $.trim($(this).text());
    let id = $(this).attr("id");
    let name = $(this).attr("name");
    $(this).blur(function () {
      let valeur2 = $.trim($(this).text());
      if (valeur1 != valeur2) {
        let parametre = "champ=" + name + "&id=" + id + "&nouveau=" + valeur2;
        console.log(parametre);
        $.ajax({
          type: "GET",
          data: parametre,
          dataType: "text",
          url: "./lib/php/ajax/ajaxUpdateIngredient.php",
          success: function (data) {
            //alert("La mise à jour a été effectuée avec succès.");
          }
        });
      }
    });
  });
  $(".delete").click(function () {
    let effacer = $(this).attr('id');
    console.log("effacer = " + effacer);
    if (confirm("Supprimer ?")) {
      let ligne = $(this).closest("tr");
      ligne.css("background-color", "lightpink");
      parametre = "id_ingredient=" + effacer;
      console.log(parametre);
      retour = $.ajax({
        type: 'GET',
        data: parametre,
        datatype: 'json',
        url: './lib/php/ajax/ajaxDeleteIngredient.php',
        success: function () {
          console.log("Supprimé");
          ligne.fadeOut();
          //ligne.css("background-color", "white");
        },
        error: function () {
          ligne.css("background-color", "white");
          console.log("Échec de la suppression");
          // Afficher un message d'erreur à l'utilisateur
          alert("La suppression a échoué, contrainte d'integrité !.");
        }
      });

    }
  });
  $('#ajouter_ingredient').click(function(){
    let html = "<tr id='nouvel'><th scope=\"row\"> * </th>";
    html += "<td contenteditable='true' id='nom_ingredient' name='nom_ingredient'></td></tr>";
    $("table tbody").prepend(html);
    $('td[id]').blur(function(){
      let valeur = $(this).text();
      let champ = $(this).attr('id');
      let flag = true;
      $('table tr:gt(1)').each(function() { //"greater than" indice 1 (qui est la nouvelle ligne créée)
        let autre = $(this).find('td:eq(1)').text();
        console.log(autre);
        // utilise la méthode :eq() [= EQual] pour sélectionner la cellule et la méthode text() pour récupérer son contenu
        if(autre === valeur) {
          if ($('td[id]').attr('name') == 'nom_ingredient') {
            flag = false;
          }
        }
        if(flag == false){
          return false;
        }
      });
      if(flag == false){
        $('#nouveau_td').html("<span class='txtRed txtGras'>Ingredient déjà encodé</span>")
        $('#nouvel').fadeOut(2000);
      } else {
        $('#nouveau_td').hide();
        let parametre = "champ=" + champ + "&nouveau=" + valeur;
        console.log(parametre);
        let retour = $.ajax({
          type: 'GET',
          data: parametre,
          datatype: 'json',
          url: './lib/php/ajax/ajaxInsertIngredient.php',
          success: function () {
            console.log("Ajouté");
          }
        })
      }
    });
  });
  $("#filtrer").keyup(function () {
    let filtre = $(this).val().toLowerCase();
    $("#tab tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(filtre) > -1)
      //indexOf retourne -1 si la valeur ne correspond pas au filtre
    })
  });
  //EDITER INSERER
  function sendCheckboxValues(id) {
    let checkboxValues = [];
    $('input[type="checkbox"]:checked').each(function() {
      checkboxValues.push(parseInt($(this).val(), 10));
    });

    // Ajouter l'id en première position dans le tableau des valeurs des cases à cocher
    checkboxValues.unshift(id);

    // Envoie des valeurs des cases à cocher dans une requête AJAX
    $.ajax({
      type: 'GET',
      data: { checkboxValues: checkboxValues },
      dataType: 'json',
      url: './lib/php/ajax/ajaxInsertIntoComposition.php',
      success: function(response) {
        console.log('Requête AJAX réussie');
        $('input[type="checkbox"]').prop('checked', false);
        // Traitez la réponse de la requête AJAX ici
      },
      error: function(xhr, status, error) {
        console.log('Erreur lors de la requête AJAX');
        console.log(error);
      }
    });
  }



  //insertion (suite ajout ou édition)
  $('#editer_ajouter').click(function (event) {
    event.preventDefault();
    event.stopPropagation();
    let nom_plat = $('#nom_plat').val();
    let prix_plat = $('#prix_plat').val();
    let photo_plat = $('#photo_plat').val();
    let type_plat = $('#type_plat').val();
    //console.log(type_plat);
    //récupérer le texte du bouton
    let bouton = $(this).text();
    //let checkbox_values = getCheckboxValues();
    let parametre = "nom_plat=" + nom_plat + "&prix_plat=" + prix_plat + "&photo_plat=" + photo_plat + '&type_plat='+type_plat ;
    if (bouton != "Editer") {
      $.ajax({
        type: 'GET',
        data: parametre,
        dataType: 'json',
        url: './lib/php/ajax/ajaxAjoutPlat.php',
        success: function (data) {
          // Appeler la fonction sendCheckboxValues() avec l'ID du plat
          sendCheckboxValues(data);
          console.log("Ajouté");
          $('#nom_plat').val('');
          $('#prix_plat').val('');
          $('#photo_plat').val('');
          $('#inBD').html("<span class='txtGras'>Insertion effectuée</span>");
        }
      });
    }
  });

  //insertion du texte du bouton
  $('#editer_ajouter').text('Insérer');
  let id_plat_edition;
  //Recherche de la présence d'une décoration en BD
  $('#nom_plat').blur(function () { //quand perte de focus
    let nom_plat = $(this).val();
    if (nom_plat != '') {
      var parametre = "nom_plat=" + nom_plat;
      $.ajax({
        type: 'GET',
        data: parametre,
        dataType: 'json',
        url: './lib/php/ajax/ajaxRecherchePlat.php',
        success: function (data) {
          console.log("success");
          console.log(data);
          //console.log(data[0][2]);
          //console.log(data[0][2]);
          //insertion d'une des données dans une zone de formulaire
          $('#photo_plat').val(data[0][2]);
          //si la zone contient la donnée  le produit existe
          if ($('#photo_plat').val() != '') {
            console.log(data[0][3]);
            $('#prix_plat').val(data[0][3]);
            $('#type_plat').val(data[0][4]);
            //changement du texte du bouton d'envoi
            $('#editer_ajouter').text("Editer");
            id_plat_edition = data [0][0];
            console.log("id plat edition : "+ id_plat_edition);
            checkCheckBox(data[0][0]);
          }


        }
      });
    }
  });

  function checkCheckBox(id) {
    var parametre = "id=" + id;
    $.ajax({
      type: 'GET',
      data: parametre,
      dataType: 'json',
      url: './lib/php/ajax/ajaxGetIngredientId.php',
      success: function(data) {
        //console.log('Requête AJAX réussie');
        //console.log(data); // Vérifier les données renvoyées
        $('input[type="checkbox"]').prop('checked', false);
        // Parcourir les données et cocher les cases correspondantes
        data.forEach(function(ingredientId) {
          $('input[type="checkbox"][value="' + ingredientId + '"]').prop('checked', true);
        });
      },
      error: function(xhr, status, error) {
        console.log('Erreur lors de la requête AJAX');
        console.log(error);
      }
    });
  }
  function editIngredient(id) {
    var parametre = "id=" + id;
    $.ajax({
      type: 'GET',
      data: parametre,
      dataType: 'json',
      url: './lib/php/ajax/ajaxDeleteComposition.php',
      success: function(data) {
        console.log('Requête AJAX réussie');
        console.log(data); // Vérifier les données renvoyées

      },
      error: function(xhr, status, error) {
        console.log('Erreur lors de la requête AJAX');
        console.log(error);
      }
    });
  }
  $('#editer_ajouter').click(function (event) {
    event.preventDefault();
    event.stopPropagation();
    let nom_plat = $('#nom_plat').val();
    let prix_plat = $('#prix_plat').val();
    let photo_plat = $('#photo_plat').val();
    let type_plat = $('#type_plat').val();
    //console.log(type_plat);
    //récupérer le texte du bouton
    let bouton = $(this).text();
    //let checkbox_values = getCheckboxValues();
    let parametre = "nom_plat=" + nom_plat + "&prix_plat=" + prix_plat + "&photo_plat=" + photo_plat + '&type_plat='+type_plat+ '&id='+id_plat_edition ;
    if (bouton == "Editer") {
      $.ajax({
        type: 'GET',
        data: parametre,
        dataType: 'json',
        url: './lib/php/ajax/ajaxUpdatePlat.php',
        success: function (data) {
          console.log("test");
          editIngredient(id_plat_edition);
          sendCheckboxValues(id_plat_edition);
          console.log("Modifié");
          $('#nom_plat').val('');
          $('#prix_plat').val('');
          $('#photo_plat').val('');
          $('#inBD').html("<span class='txtGras'>Modif effectuée</span>");
        },
        error: function(xhr, status, error) {
          console.log('Erreur lors de la requête AJAX');
          console.log(error);
        }
      });
    }
  });
  $(".deletePlat").click(function () {
    let effacer = $(this).attr('id');
    console.log("effacer = " + effacer);
    if (confirm("Supprimer ?")) {
      let ligne = $(this).closest("tr");
      ligne.css("background-color", "lightpink");
      parametre = "id_plat=" + effacer;
      console.log(parametre);
      retour = $.ajax({
        type: 'GET',
        data: parametre,
        datatype: 'json',
        url: './lib/php/ajax/ajaxDeletePlat.php',
        success: function () {
          console.log("Supprimé");
          ligne.fadeOut();
          //ligne.css("background-color", "white");
        },
        error: function () {
          ligne.css("background-color", "white");
          console.log("Échec de la suppression");
          // Afficher un message d'erreur à l'utilisateur
          alert("La suppression a échoué, contrainte d'integrité !.");
        }
      });

    }
  });
  $(document).on('click', '#table_plat', function() {
    let nom_plat = $(this).text();
    var parametre = "nom_plat=" + nom_plat;
    console.log(nom_plat);
    $.ajax({
      type: 'GET',
      data: parametre,
      dataType: 'json',
      url: './lib/php/ajax/ajaxRecherchePlat.php',
      success: function (data) {
        console.log("success");
        console.log(data);
        $('#nom_plat').val(data[0][1]);
        $('#photo_plat').val(data[0][2]);
        //si la zone contient la donnée  le produit existe
        if ($('#photo_plat').val() != '') {
          console.log(data[0][3]);
          $('#prix_plat').val(data[0][3]);
          $('#type_plat').val(data[0][4]);
          //changement du texte du bouton d'envoi
          $('#editer_ajouter').text("Editer");
          id_plat_edition = data [0][0];
          console.log("id plat edition : "+ id_plat_edition);
          checkCheckBox(data[0][0]);
        }


      }
    });

  });

});

