const config = {
    // paramètres de connexion à la base de données
    mysqlHost:     '127.0.0.1',
    mysqlDatabase: 'bddforum',
    charset:       'utf8',
    mysqlLogin:    'root',
    mysqlPassword: '%FnvQcYZs9!2Jf',

    // les noms des tables
    mysqlCours:    'cours',
    mysqlTopic:   'topic',
    mysqlPost:     'post',
    mysqlUser:     'utilisateur'
};

// on exporte la config. En l'exportant comme ci-dessous, on pourra utiliser la
// syntaxe suivante pour la charger dans d'autres fichiers :
// const config = require ('./config');
module.exports = config;

