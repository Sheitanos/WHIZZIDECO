var author = "Daniel Pennac";
var nb_cara = author.length;
var tab = author.split("");
text = new Array;
var txt = '';
var nbr_msg = nb_cara - 1;
for (i=0; i<nb_cara; i++) {
    text[i] = txt+tab[i];
    var txt = text[i];
}

actual_text = 0;
function changeMessageAuthor()
{
    document.getElementById("text-machine-author").innerHTML = text[actual_text];
    actual_text++;
    if(actual_text >= text.length)
        actual_text = nbr_msg;
}
if(document.getElementById)

    setTimeout("setInterval(\"changeMessageAuthor()\",50)", 3500) /* la vitesse de defilement (plus on a une valeur faible plus
texte s'affiche rapidement) */