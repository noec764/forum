const queries = require('./mysqlQuery');
const {sendError, sendMessage} = require ("./message");
const auth = require ('./auth');


async function getPost(req,res){
    const session = auth.getSession(req);
    const userId = auth.getUserId(session);

    if (userId == -1)
        return sendError (res, 'not authenticated');

    auth.setSessionCookie (req, res, session);

    if(typeof req.body.idTopic === 'undefined')
        return sendError(res,"Vous n'avez pas envoyé l'idTopic");

    const idTopic = req.body.idTopic;

    const getPostTopic = await queries.getPostTopic(idTopic);

    sendMessage(res, getPostTopic);

}

module.exports = getPost;