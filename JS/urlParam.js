function getAllUrlParams(url) {

    // obtenir la chaîne de requête à partir de l'URL ou de la fenêtre
    var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

    // nous allons stocker les paramètres ici
    var obj = {};

    // Si queryString existe
    if (queryString) {

        // On suprime toute les chose qui ne font pas partie de la chaine de requete
        queryString = queryString.split('#')[0];

        // On divise notre chaine de requete pour separer chaque propriété envoyer dans l'url
        var arr = queryString.split('&');

        for (var i = 0; i < arr.length; i++) {
            // On sépare les clés et les valeurs
            var a = arr[i].split('=');

            //  On défini le nom et la valeur du paramètre ( et on utilise 'true' si c'est vide)
            var paramName = a[0];
            var paramValue = typeof (a[1]) === 'undefined' ? true : a[1];

            // C'est optionnel mais on conserve la cohérence de la casse
            paramName = paramName.toLowerCase();
            if (typeof paramValue === 'string') paramValue = paramValue.toLowerCase();

            // si le paramName se termine par des crochets, par ex. couleurs[] ou couleurs[2]
            if (paramName.match(/\[(\d+)?\]$/)) {

                // On créer une clé si elle n'existe pas
                var key = paramName.replace(/\[(\d+)?\]/, '');
                if (!obj[key]) obj[key] = [];

                // s'il s'agit d'un tableau indexé, par ex. couleurs[2]
                if (paramName.match(/\[\d+\]$/)) {
                    // On stocke la valeur de l'index et on ajoute l'entrée à la position appropriée
                    var index = /\[(\d+)\]/.exec(paramName)[1];
                    obj[key][index] = paramValue;
                } else {
                    // sinon On ajoute la valeur à la fin du tableau
                    obj[key].push(paramValue);
                }
            } else {
                //  Si on a affaire à une chaîne
                if (!obj[paramName]) {
                    // Et si elle n'existe pas, on crée une propriété
                    obj[paramName] = paramValue;
                } else if (obj[paramName] && typeof obj[paramName] === 'string') {
                    // si la propriété existe et qu'il s'agit d'une chaîne, on la converti en un tableau
                    obj[paramName] = [obj[paramName]];
                    obj[paramName].push(paramValue);
                } else {
                    // sinon on ajoute la propriété
                    obj[paramName].push(paramValue);
                }
            }
        }
    }

    return obj;
}

/*Exemple d'utilisation*/
/*
getAllUrlParams().product; // 'shirt'
getAllUrlParams().color; // 'blue'
getAllUrlParams().newuser; // true
getAllUrlParams().nonexistent; // undefined
getAllUrlParams('http://test.com/?a=abc').a; // 'abc'
*/