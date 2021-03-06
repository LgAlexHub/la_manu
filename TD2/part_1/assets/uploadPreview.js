/*
_________________________________________________________________________________________________________________________

-------------------------------------------------------------------------------------------------------------------------
Il faut créer au préalable un élément de type <img id="imgPreview"> dans votre code html.
Celui-ci vous permettra d'afficher l'aperçu de l'image.
Vous allez pouvoir modifier les dimensions de l'aperçu via un css respectif : "uploadPreview.css" fourni dans le dossier.

Il faut également que votre input soit de cette forme :
<input type="file" name="fileToUpload" id="fileToUpload">
-------------------------------------------------------------------------------------------------------------------------
_________________________________________________________________________________________________________________________
*/

fileToUpload.addEventListener("change", function () {
	let input = this;
	let oFReader = new FileReader(); // on créé un nouvel objet FileReader
	oFReader.readAsDataURL(this.files[0]);
	oFReader.onload = function (oFREvent) {
		imgPreview.setAttribute('src', oFREvent.target.result);
	};
})