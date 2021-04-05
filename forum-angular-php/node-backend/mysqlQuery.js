const config = require('./config');
const db = require('./mysqlConnect');


function getCoursUser(idUtilisateur) {
    const query = `
        SELECT * FROM ${config.mysqlCours} c WHERE c.idCours IN 
        (SELECT r.idCours FROM cours_relation r WHERE r.idUtilisateur =?)`;
    const data = [idUtilisateur];

    return new Promise((resolve, reject) => {
        db.query(query, data, (err, rows) => {
            if (err) return reject(err);
            resolve(rows);
        });
    });
}

function getTopicsCours(idCours) {
    const query = `
        SELECT * FROM ${config.mysqlTopic} WHERE idCours=?`;
    const data = [idCours];

    return new Promise((resolve, reject) => {
        db.query(query, data, (err, rows) => {
            if (err) return reject(err);
            resolve(rows);
        });
    });
}


function getPostTopic(idTopic) {
    const query = `
        SELECT * FROM ${config.mysqlPost} WHERE idTopic=?`;
    const data = [idTopic];

    return new Promise((resolve, reject) => {
        db.query(query, data, (err, rows) => {
            if (err) return reject(err);
            resolve(rows);
        });
    });
}

function saveNewTopicQueries(newTopic, idCours) {
    const query = `
        INSERT INTO ${config.mysqlTopic} (idTopic, titreTopic, nbPosts,dateDernierMessage, idCours) VALUES (NULL,?,?,?,?)
        `;
    const data = [newTopic, 0, '2009-05-18', idCours];
    return new Promise((resolve, reject) => {
        db.query(query, data, (err, rows) => {
            if (err) return reject(err);
            resolve(rows.insertId);

        });
    })

}

function updateNbTopic(idCours) {
    const query = `
                UPDATE ${config.mysqlCours} SET nbTopics = (SELECT COUNT(*) from ${config.mysqlTopic} WHERE idCours=?) WHERE idCours=?`;
    const data = [idCours, idCours];
    return new Promise((resolve, reject) => {
        db.query(query, data, (err, rows) => {
            if (err){
                return reject(err);
            } resolve();
        });
    });
}


function checkLoginSes(login,password){
    const query = `
        SELECT login,password,idUtilisateur FROM ${config.mysqlUser} WHERE login=? AND password=?`;
    const data = [login, password];

    return new Promise((resolve, reject) => {
        db.query(query, data, (err, rows) => {
            if (err) return reject(err);
            resolve(rows)
        });
    });
}

module.exports.updateNbTopic = updateNbTopic;
module.exports.saveNewTopicQueries = saveNewTopicQueries;
module.exports.getCoursUser = getCoursUser;
module.exports.getTopicsCours = getTopicsCours;
module.exports.getPostTopic = getPostTopic;
module.exports.checkLoginSes = checkLoginSes;