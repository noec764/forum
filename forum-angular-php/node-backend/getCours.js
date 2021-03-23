const queries = require('./mysqlQuery');
const {sendError, sendMessage} = require ("./message");
const auth = require ('./auth');


async function getCours(req,res){
    const session = auth.getSession(req);
    const userId = auth.getUserId(session);

    if (userId == -1)
        return sendError (res, 'not authenticated');

    auth.setSessionCookie (req, res, session);

    if(typeof req.body.idUtilisateur === 'undefined')
        return sendError(res,"Vous n'avez pas envoyé l'idUtilisateur");

    const idUtilisateur = req.body.idUtilisateur;

    const getCoursUser = await queries.getCoursUser(idUtilisateur);

    sendMessage(res, getCoursUser);

}

module.exports = getCours;