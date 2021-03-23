const queries = require('./mysqlQuery');
const {sendError,sendMessage} = require('./message');
const auth = require('./auth');


async function getTopics(req,res){
    const session = auth.getSession(req);

    auth.setSessionCookie(req,res,session);

    if(typeof req.body.idCours==='undefined')
        return sendError(res,"Vous n'avez pas envoyé l'idCours");

    const idCours = req.body.idCours;

    const getTopicsCours = await queries.getTopicsCours(idCours);

    sendMessage(res,getTopicsCours);
}

module.exports = getTopics;