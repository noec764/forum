const queries = require('./mysqlQuery');
const {sendError, sendMessage} = require ("./message");
const auth = require ('./auth');


async function saveNewTopic(req, res) {
    const session = auth.getSession(req);
    const userId = auth.getUserId(session);
    auth.setSessionCookie(req, res, session);

    if (typeof req.body.idCours === 'undefined')
        return sendError(res, 'Vous n\'avez pas envoyé la donnée idCours');
    if (typeof req.body.newTopic === 'undefined')
        return sendError(res, 'Vous n\'avez pas envoyé la donnée nomSujet');

    const newTopic = req.body.newTopic;
    const idCours = req.body.idCours;

    let coursCpt = 0;
    let coursg = await queries.getCoursUser(userId);
    coursg.forEach(cours => {
        if (cours.idCours === idCours) coursCpt = 1
    });
    if (coursCpt) {
        let topicCpt = 0;
        const topicsg = await queries.getTopicsCours(idCours);
        topicsg.forEach(topic => {
            if (topic.newTopic === newTopic) topicCpt++;
        })
        if (!topicCpt) {
            const newid = await queries.saveNewTopicQueries(newTopic, idCours);
            const nbTopic = await queries.updateNbTopic(idCours);
            sendMessage(res, newid);
            sendMessage(res,nbTopic);
        } else {
            sendError(res, "Un topic existe déjà avec ce nom.");
        }
    } else {
        sendError(res, "Vous ne suivez pas le cours dans lequel vous essayez de créer un topic.");
    }
}

module.exports = saveNewTopic;





