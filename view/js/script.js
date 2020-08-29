// barre de progression horizontale
$(function horizontalScroll()
{
	$(document).on('scroll', function()
	{	
		var hauteur = $(document).height()-$(window).height();
		var position = $(document).scrollTop();
		var largeur = $(window).width();	
		var barre = position / hauteur * largeur;	
		$("#scroll-line").css("width", barre);
	});
});

	// Modification de l'article affiché
function loadDetails()
{
	$.getJSON("index.php","action=RecupArticle&id="+$(this).val(), showDetails) ;
}
function showDetails(data)
{
	var recupAjax = data;
	$("#articleVisible").empty();
	$("#articleVisible").append("<h3>"+data["title"]+"</h3>"+"<img src=view/img/articles/"+data["picture"]+">"+"<p>"+data["content"] +"</p><p>"+data["date"]+"</p>");
}                       

	// Test de saisie du formulaire d'envoi de message (on vérifie que tous les champs soient bien remplis)
function formContact(event)
{
	var champsForms = document.getElementById("form_Contact");
	var tousChampsOk = true;
	for (var i = 0; i < champsForms.length; i++)
	{
		if (champsForms[i].value == ""){
		    tousChampsOk = false;
			break;
		}
	}
	if (tousChampsOk == true)
	{
		alert('Message envoyé avec succès');
	}
	else
	{
		alert("Merci de remplir tous les champs");
		event.preventDefault();
	}
}

	// gestionnaire d'evenements
$(function()
	{
		$(".executer").on("click",loadDetails);
		$("#send_Contact").on("click",formContact);
	}
);