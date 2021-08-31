class RechercheAjax {
    /**
     * @param {objet du DOM} dom_input input type texte
     * @param {int} nbcarmax nombre de caractère qu'il faut taper pour déclencher l'appel ajax
     * @param {string} url le fichier qui sera appeler par l'appel ajax
     * @param {objet du DOM} divreponse div qui affichera la réponse
     */
    constructor(dom_input, nbcarmax, url, divreponse) {
        //objet pour faire un appel ajax
        this.ajax = new XMLHttpRequest();
        //gestionnaire d'événement clavier
        this.dom_input = dom_input;
        this.dom_input.addEventListener("input", () => this.clavier(), true);
        this.nbcarmax = nbcarmax;
        this.url = url;
        this.divreponse = divreponse;
    }

    clavier() {
        if (this.dom_input.value.length >= this.nbcarmax) {
            this.ajax.open("get", this.url + "?chaine=" + this.dom_input.value, true);
            this.ajax.addEventListener("readystatechange", () => this.afficher());
            this.ajax.send();
        } else {
            this.divreponse.innerHTML = "";
        }
    }

    afficher() {
        if (this.ajax.readyState == 4 && this.ajax.status == 200) {
            this.divreponse.innerHTML = this.ajax.responseText;
        }
    }
}